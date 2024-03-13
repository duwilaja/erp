<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClickUp extends CI_Controller {
    
    public function __construct()
    { 
        parent::__construct();
	}
	
	public function oprupdstatus(){
		$token='pk_60882308_DSF68Y6K5L6BY5WGZVR53OSVMURK75LL';
		$r=$this->db->select("status,clickupid")->from("clickup")->join("tickets","tickets.id=clickup.ticketid","left")->where(array("upd"=>1))->get()->row();
		$res="No data found";
		if($r!=null){
			$data = '{"status": "'.$r->status.'"}';
			echo $data;
			$res = $this->clickupdate($r->clickupid,$token,$data);
		}
		echo $res;
	}
	public function oprlvl2(){
		$list_id='901600280460';
		$token='pk_60882308_DSF68Y6K5L6BY5WGZVR53OSVMURK75LL';
		$r=$this->db->where("listid",$list_id)->get("clickup")->result();
		$lst=array('x');
		foreach($r as $x){
			$lst[]=$x->ticketid;
		}
		//normal
		$whin=array("new","progress","resolve","done");
		$r=$this->db->select("tickets.*,tic_node.node")->from("tickets")->join("tic_node","tic_node.id=tickets.tic_node_id","left")->where(array("pic"=>62))->where_in("status",$whin)->where_not_in("tickets.id",$lst)->get()->row();
		
		//closed only
		//$whr="status='closed' and year(dtm)=2024";
		//$r=$this->db->select("tickets.*,tic_node.node")->from("tickets")->join("tic_node","tic_node.id=tickets.tic_node_id","left")->where($whr)->where_not_in("tickets.id",$lst)->get()->row();
		
		$res="No data found";
		if($r!=null){
			$la="51837652-2741-4ff9-93b8-90aa83f1d6d4"; $node=(trim($r->node_id)=="")?$r->node:$r->node_id;
			$node=trim($node)==""||$node==null?"No Location":$node;
			$r2=$this->db->where(array("id"=>$r->tic_layanan_id))->get("tic_layanan")->row();
			if($r2!=null){
				$la=$this->layanan($r2->layanan_id,$la);
			}
			$data = '{
				  "name": "'.$this->cleanup($node).'",
				  "description": "'.$this->cleanup($r->body).'",
				  "status": "'.$r->status.'",
				  "priority": 3,
				  "due_date": '.strtotime('+24 hours').',
				  "due_date_time": false,
				  "time_estimate": 8640000,
				  "start_date": '.strtotime('now').',
				  "start_date_time": false,
				  "assignees": [60898731],
				  "custom_fields": [
					{
					  "id": "e8b83914-ea5e-4792-9492-437b7c9dd3a7",'. //kategori
					  '"value": ["'.$this->kategori($r->tic_ktg_id).'"]
					},
					{
					  "id": "8d73abef-b040-4a87-ac7a-b9b135cf1976",'. //subkategori
					  '"value": "'.$this->subkategori($r->tic_subject_id).'"
					},
					{
					  "id": "58259a09-cfe5-4ac5-861b-3277d6489fe1",'. //layanan
					  '"value": ["'.$la.'"]
					},
					{
					  "id": "777d0c10-715d-4d74-b80b-e27df3a1d66b",'. //pelanggan
					  '"value": '.$this->pelanggan($r->customer).'
					},
					{
					  "id": "1305667d-8759-4f77-99e4-f1f8ae031a94",'. //ticketno
					  '"value": "'.$r->ticketno.'"
					}
				  ]
				}';
			echo $data;
			$res = $this->clickup($list_id,$token,$data,$r->id);
		}
		echo $res;
	}
	private function cleanup($s){
		$r=str_ireplace('"','',$s);
		$r=str_ireplace("'","",$r);
		$r=str_ireplace("\n","",$r);
		$r=str_ireplace("\r","",$r);
		$r=str_ireplace("\t","",$r);
		
		return $r;
	}
    //send to clickup
	private function clickup($list_id,$token,$data,$tid){
		
		$url = 'https://api.clickup.com/api/v2/list/'.$list_id.'/task';
		//$postdata = json_encode($data);

		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: '.$token));
		$result = curl_exec($ch);
		curl_close($ch);
		
		$jres=json_decode($result);
		if(isset($jres->id)){
			$this->db->insert("clickup",array("listid"=>$list_id,"ticketid"=>$tid,"clickupid"=>$jres->id));
		}
		
		return $result;
	}
	private function clickupdate($task_id,$token,$data){
		$url = 'https://api.clickup.com/api/v2/task/'.$task_id.'?custom_task_ids=true';
		//$postdata = json_encode($data);

		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: '.$token));
		$result = curl_exec($ch);
		curl_close($ch);
		
		$jres=json_decode($result);
		if(isset($jres->id)){
			$this->db->update("clickup",array("upd"=>0),array("clickupid"=>$task_id));
		}
		
		return $result;
	}
	
	private function layanan($param,$ret=""){
		$lay='  {
                    "id": "58259a09-cfe5-4ac5-861b-3277d6489fe1",
                    "name": "Layanan",
                    "type": "labels",
                    "type_config": {
                        "options": [
                            {
                                "id": "98b220ae-8b7b-4951-9a3c-f87efdb055ff",
                                "label": "JARKOM",
                                "color": "2"
                            },
                            {
                                "id": "3ce533af-e467-4196-b08a-e152c264df08",
                                "label": "CCTV",
                                "color": "3"
                            },
                            {
                                "id": "936836be-b231-4d21-a945-a0642802b861",
                                "label": "SIMLING",
                                "color": "4"
                            },
                            {
                                "id": "f693dcb5-1a18-4821-8b72-a429aac4bde1",
                                "label": "SBST",
                                "color": "5"
                            },
                            {
                                "id": "604c2b6b-75f6-4fe2-8cf2-a560336f5c2c",
                                "label": "SDWAN",
                                "color": "6"
                            },
                            {
                                "id": "59433633-cf52-49b8-9856-e52d235dcf29",
                                "label": "NMS",
                                "color": "7"
                            },
                            {
                                "id": "64ea4114-0bb1-4c46-a492-becfda50960b",
                                "label": "M2M",
                                "color": "13"
                            },
                            {
                                "id": "6afb2c4a-92a4-4c10-a002-263027109699",
                                "label": "Penguat Signal",
                                "color": "15"
                            },
                            {
                                "id": "9640fd83-41a5-4ef2-a6ec-8327a604c6df",
                                "label": "MLOG",
                                "color": "16"
                            },
                            {
                                "id": "c4198800-21fc-4472-be32-6e8d7ccb7ae9",
                                "label": "WIRO",
                                "color": "17"
                            },
                            {
                                "id": "93249b23-1a90-4165-af64-cafa97607539",
                                "label": "Security",
                                "color": "24"
                            },
                            {
                                "id": "18bd90da-18d3-45c8-8837-23579b34d06a",
                                "label": "Network",
                                "color": "25"
                            },
                            {
                                "id": "e9317bb0-7c93-42dd-80bd-eab09d509ffa",
                                "label": "Multimedia",
                                "color": "26"
                            },
                            {
                                "id": "882bc2b4-11d2-4e6e-bb0c-c91b126fad2d",
                                "label": "Harwat 2 Polda+1 TMC",
                                "color": "31"
                            },
                            {
                                "id": "7c2ab841-457f-4add-b6f5-b9efc4081899",
                                "label": "Algoritma Kewilayahan",
                                "color": "32"
                            },
                            {
                                "id": "04aac386-4d7f-4d80-9bb4-07fc7433d395",
                                "label": "Upgrade 3 Polda ( KODAL )",
                                "color": "33"
                            },
                            {
                                "id": "06767a1c-3335-42d5-8790-fc9d0e010553",
                                "label": "SMART CITY SOLO",
                                "color": "34"
                            },
                            {
                                "id": "3fa13954-c72a-48d2-9731-65e3867ac788",
                                "label": "SMART CITY BALI",
                                "color": "35"
                            },
                            {
                                "id": "2aef8996-8c25-4b3d-8f6e-fbbc41afbdf4",
                                "label": "SMART CITY MEDAN",
                                "color": "36"
                            },
							{
								"id": "49eafa76-e1a7-49d5-849b-21aefcd89ad1",
								"label": "SMART CITY YOGYAKARTA",
								"color": "38"
							},
							{
								"id": "2f0d443e-78d5-4a28-b48d-03a24c66512c",
								"label": "CALL CENTER",
								"color": "37"
							}
                        ]
                    },
                    "date_created": "1700381694312",
                    "hide_from_guests": false,
                    "required": false
                }';
		$layanan=json_decode($lay);
		foreach($layanan->type_config->options as $layan)
		{
			if($layan->color==$param) $ret=$layan->id;
		}
		
		return $ret;

	}
	
	private function kategori($param){
          $kat='{
                    "id": "e8b83914-ea5e-4792-9492-437b7c9dd3a7",
                    "name": "Kategori",
                    "type": "labels",
                    "type_config": {
                        "options": [
                            {
                                "id": "6cfd07f2-f572-4cd7-b297-cc60a3c94c62",
                                "label": "Change Request",
                                "color": "3"
                            },
                            {
                                "id": "6f64dd88-437c-4005-8702-14305f8bf454",
                                "label": "Problem",
                                "color": "4"
                            },
                            {
                                "id": "6dc882d8-77d8-4390-9d6f-1d81fdf02383",
                                "label": "Dismantle",
                                "color": "5"
                            },
                            {
                                "id": "2c9fa350-31a4-4458-84f7-7b163d0770a3",
                                "label": "Information",
                                "color": "6"
                            },
                            {
                                "id": "9d37aa2c-6346-4f26-8418-6e2587b68539",
                                "label": "Report Request",
                                "color": "7"
                            }
                        ]
                    },
                    "date_created": "1700381556566",
                    "hide_from_guests": false,
                    "required": false
                }';
				
		$kategori=json_decode($kat);
		$ret="";
		foreach($kategori->type_config->options as $kate)
		{
			if($kate->color==$param) $ret=$kate->id;
		}
		
		return $ret;
	}
	private function pelanggan($param){
			$plg='{
                    "id": "777d0c10-715d-4d74-b80b-e27df3a1d66b",
                    "name": "Pelanggan",
                    "type": "drop_down",
                    "type_config": {
                        "default": 0,
                        "placeholder": null,
                        "options": [
                            {
                                "id": "9a1c053a-f23a-4d23-a9fb-964daf0af03f",
                                "name": "Bank Indonesia",
                                "color": "12",
                                "orderindex": 0
                            },
                            {
                                "id": "9bc02bb0-012c-4e69-8f58-be20e2c8b289",
                                "name": "Bank Mandiri",
                                "color": "13",
                                "orderindex": 1
                            },
                            {
                                "id": "7dc35632-0905-4048-bc50-d38aeaafd3e8",
                                "name": "BANK MANTAP",
                                "color": "17",
                                "orderindex": 2
                            },
                            {
                                "id": "39d54986-297c-4bda-ad2d-f08ec871ae0d",
                                "name": "Best Westrent Palu",
                                "color": "18",
                                "orderindex": 3
                            },
                            {
                                "id": "ef03dc33-d27f-47ce-8219-33f2f2c52b29",
                                "name": "BIN",
                                "color": "19",
                                "orderindex": 4
                            },
                            {
                                "id": "2ec9c8cb-6357-41d0-ae2e-2fdb807ea069",
                                "name": "ICE BSD",
                                "color": "35",
                                "orderindex": 5
                            },
                            {
                                "id": "47e8d36c-ba6f-4cfa-adae-dbb54bf0338b",
                                "name": "Ijen Suites",
                                "color": "36",
                                "orderindex": 6
                            },
                            {
                                "id": "747bc467-566a-4c18-98f6-3441c191cf08",
                                "name": "IMIGRASI",
                                "color": "79",
                                "orderindex": 7
                            },
                            {
                                "id": "b050897c-7802-4734-863f-83c2d055a31b",
                                "name": "Jasa Raharja",
                                "color": "82",
                                "orderindex": 8
                            },
                            {
                                "id": "5e9b8e9a-5c5e-4500-8142-7c6e88ecca91",
                                "name": "Kemdikbud - Pusdatin",
                                "color": "42",
                                "orderindex": 9
                            },
                            {
                                "id": "d92352fe-e9ee-4c26-8759-a7154ff78815",
                                "name": "Kemendikbud - Telstra",
                                "color": "43",
                                "orderindex": 10
                            },
                            {
                                "id": "70362ada-2147-4937-8938-ff1b535c286b",
                                "name": "Kemenkes",
                                "color": "44",
                                "orderindex": 11
                            },
                            {
                                "id": "b70c7440-6571-4e7d-86e0-44f77597ec2f",
                                "name": "Kepolisian RI",
                                "color": "45",
                                "orderindex": 12
                            },
                            {
                                "id": "d7a44183-99e7-448f-abaf-4239b71e0eff",
                                "name": "Korlantas",
                                "color": "78",
                                "orderindex": 13
                            },
                            {
                                "id": "a8b4faa8-730b-4206-84ca-e47f9579fcc5",
                                "name": "KSEI",
                                "color": "85",
                                "orderindex": 14
                            },
                            {
                                "id": "5debf1d7-dfba-47d8-97d4-499bb412453e",
                                "name": "LION-AIR",
                                "color": "62",
                                "orderindex": 15
                            },
                            {
                                "id": "93942444-53da-4a44-9066-721bd8e0b4a3",
                                "name": "MADINA MITRA TEKNIK",
                                "color": "87",
                                "orderindex": 16
                            },
                            {
                                "id": "369f9efd-94e4-4e3d-90ea-dcd3d43cdaad",
                                "name": "Novotel Suite Yogyakarta",
                                "color": "53",
                                "orderindex": 17
                            },
                            {
                                "id": "5981f368-e51c-43de-9775-58024a389c15",
                                "name": "Pegadaian",
                                "color": "54",
                                "orderindex": 18
                            },
                            {
                                "id": "a15671bb-b0fb-46e3-a6c0-439197fba605",
                                "name": "Pertamina",
                                "color": "55",
                                "orderindex": 19
                            },
                            {
                                "id": "da3b512c-ae7a-4106-bc39-89636479e9b4",
                                "name": "Perum Jamkrindo",
                                "color": "56",
                                "orderindex": 20
                            },
                            {
                                "id": "a6d0ecd5-51a1-4ff5-a7fa-470b00841468",
                                "name": "Polda Metro Jaya",
                                "color": "103",
                                "orderindex": 21
                            },
                            {
                                "id": "1567cd91-162f-41a6-bed6-87665ac53a95",
                                "name": "Polda Sumatera Barat",
                                "color": "57",
                                "orderindex": 22
                            },
                            {
                                "id": "3e7de38c-24f6-4225-baa8-4acc592237b3",
                                "name": "PT. Permodalan Nasional Madanid",
                                "color": "63",
                                "orderindex": 23
                            },
                            {
                                "id": "bfad563d-849c-48dc-841d-73c5e94c3e00",
                                "name": "PT. Sanatel",
                                "color": "64",
                                "orderindex": 24
                            },
                            {
                                "id": "893361f4-ce0c-4dcb-9180-8e457e1ab91e",
                                "name": "PT. Teltranet Aplikasi Solusi",
                                "color": "65",
                                "orderindex": 25
                            },
                            {
                                "id": "133467e9-3228-459f-9f14-7d1ecd6201c1",
                                "name": "PT.KSEI",
                                "color": "84",
                                "orderindex": 26
                            },
                            {
                                "id": "ddce6a6a-ae30-4417-907e-ee0da4a43357",
                                "name": "SANATEL",
                                "color": "83",
                                "orderindex": 27
                            },
                            {
                                "id": "8abdc852-98bd-4189-b976-1c05af83cb80",
                                "name": "Sultan Raja Hotel",
                                "color": "67",
                                "orderindex": 28
                            },
                            {
                                "id": "59087cd4-ae32-47eb-ae03-bc3cd07a4afe",
                                "name": "Telkom - Kemenparekraf (Desa Wisata)",
                                "color": "102",
                                "orderindex": 29
                            },
                            {
                                "id": "056dcd5d-7cce-4c9c-8c39-153c18013e47",
                                "name": "TNI AD",
                                "color": "104",
                                "orderindex": 30
                            },
                            {
                                "id": "ad5623c3-e7e7-4760-9e4e-65de8d0c45db",
                                "name": "TRANS JAKARTA",
                                "color": "88",
                                "orderindex": 31
                            }
                        ]
                    },
                    "date_created": "1700381254493",
                    "hide_from_guests": false,
                    "value": 13,
                    "required": false
                }';
				
		$pelanggan=json_decode($plg);
		$ret="";
		foreach($pelanggan->type_config->options as $pela)
		{
			if($pela->color==$param) $ret=$pela->orderindex;
		}
		
		return $ret;                
	}
	
	private function subkategori($param){
          $kat='{
				  "id": "8d73abef-b040-4a87-ac7a-b9b135cf1976",
				  "name": "Sub Kategori",
				  "type": "drop_down",
				  "type_config": {
					"default": 0,
					"placeholder": null,
					"options": [
					  {
						"id": "cc7454a1-9237-4611-9bee-0e064434448c",
						"name": "Relokasi",
						"color": 4,
						"orderindex": 0
					  },
					  {
						"id": "cea4f42c-6564-4264-926b-c74e61ac839e",
						"name": "Change IP",
						"color": 5,
						"orderindex": 1
					  },
					  {
						"id": "32ff3ca8-d804-4761-8fc3-c8781132a07e",
						"name": "Change SSID",
						"color": 6,
						"orderindex": 2
					  },
					  {
						"id": "5d3d8653-5a6c-4a66-93af-b2ec021208d2",
						"name": "Bypass Macc Address",
						"color": 7,
						"orderindex": 3
					  },
					  {
						"id": "ad0a1c34-4527-47af-bb76-4909f72b5e06",
						"name": "Link Problem",
						"color": 8,
						"orderindex": 4
					  },
					  {
						"id": "2fc6127f-5493-4c4f-809d-2e558cdfbb0c",
						"name": "Device Problem",
						"color": 9,
						"orderindex": 5
					  },
					  {
						"id": "2010f366-6090-4116-a14b-b803cb743d99",
						"name": "Config Problem",
						"color": 11,
						"orderindex": 6
					  },
					  {
						"id": "5f9e5083-9f5e-4902-b8da-9f840f579f69",
						"name": "Firmware Problem",
						"color": 12,
						"orderindex": 7
					  },
					  {
						"id": "cd6710e1-ac48-407e-93e8-e832beafe01e",
						"name": "Kontrak Habis",
						"color": 13,
						"orderindex": 8
					  },
					  {
						"id": "f5c66a70-e5bd-4685-93ff-e00b54b5f033",
						"name": "Rollback",
						"color": 14,
						"orderindex": 9
					  },
					  {
						"id": "dd0eb143-6d3e-43d9-aaf3-0f0993a8ded1",
						"name": "Intermitten",
						"color": 15,
						"orderindex": 10
					  },
					  {
						"id": "d474b9a5-008d-47b1-83eb-0f8d3b52feb5",
						"name": "Change config",
						"color": 16,
						"orderindex": 11
					  },
					  {
						"id": "5b7c9bfb-0d53-4615-8400-a1003fe2b489",
						"name": "Add IP",
						"color": 17,
						"orderindex": 12
					  },
					  {
						"id": "5aa0b2bd-ca34-464d-a785-a11c5e895446",
						"name": "Cable Problem",
						"color": 18,
						"orderindex": 13
					  },
					  {
						"id": "8a276eab-0c0f-4cc8-9730-ed111e838076",
						"name": "Add User",
						"color": 19,
						"orderindex": 14
					  },
					  {
						"id": "8372e04d-27df-4ab6-9943-4ee8551843cf",
						"name": "License Issue",
						"color": 20,
						"orderindex": 15
					  },
					  {
						"id": "e04f2c0e-f623-4206-855b-7cb95bdc9a44",
						"name": "Other Problem",
						"color": 21,
						"orderindex": 16
					  },
					  {
						"id": "9bf6d91a-fc07-4665-8f99-9f8f9e72d322",
						"name": "Informasi",
						"color": 22,
						"orderindex": 17
					  },
					  {
						"id": "cd81c040-e398-4ead-bea0-38dd57db629c",
						"name": "Report",
						"color": 23,
						"orderindex": 18
					  },
					  {
						"id": "075ed3b0-de38-44c2-9090-7e0ca1a04a3f",
						"name": "Report Data",
						"color": 24,
						"orderindex": 19
					  },
					  {
						"id": "0649c089-bf6b-4db4-ab4d-c35b72cc58ce",
						"name": "Sim Card Problem",
						"color": 25,
						"orderindex": 20
					  },
					  {
						"id": "f40436ad-220f-475c-9ba5-10f8b3039349",
						"name": "Device User Problem",
						"color": 26,
						"orderindex": 21
					  },
					  {
						"id": "b3ae7317-473f-43e7-83a7-212ed59c24da",
						"name": "Electrical Problem",
						"color": 27,
						"orderindex": 22
					  },
					  {
						"id": "d4685f39-0b1d-4ec3-9fed-14930ce70472",
						"name": "Delete Data",
						"color": 28,
						"orderindex": 23
					  },
					  {
						"id": "8013c7d2-4990-4e30-a7e5-aeb060506185",
						"name": "Bug Aplikasi",
						"color": 29,
						"orderindex": 24
					  }
					]
				  },
				  "date_created": "1700381832528",
				  "hide_from_guests": false,
				  "required": false
				}';
				
		$kategori=json_decode($kat);
		$ret="";
		foreach($kategori->type_config->options as $kate)
		{
			if($kate->color==$param) $ret=$kate->id;
		}
		
		return $ret;
	}
}