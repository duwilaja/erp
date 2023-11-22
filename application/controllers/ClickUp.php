<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClickUp extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
	}
	
	public function oprlvl2(){
		$list_id='901600280460';
		$token='pk_60882308_DSF68Y6K5L6BY5WGZVR53OSVMURK75LL';
		$r=$this->db->where("listid",$list_id)->get("clickup")->result();
		$lst=array('x');
		foreach($r as $x){
			$lst[]=$x->ticketid;
		}
		$r=$this->db->where(array("status"=>"new","grp"=>"oprlvl2"))->where_not_in("id",$lst)->get("tickets")->row();
		$res="No data found";
		if(count($r)>0){
			$la="";
			$r2=$this->db->where(array("id"=>$r->tic_layanan_id))->get("tic_layanan")->row();
			if(count($r2)>0){
				$la=$this->layanan($r2->layanan_id);
			}
			$data = '{
				  "name": "'.$r->node_id.'",
				  "description": "'.$r->body.'",
				  "status": "'.$r->status.'",
				  "priority": 3,
				  "due_date": '.strtotime('+24 hours').',
				  "due_date_time": false,
				  "time_estimate": 8640000,
				  "start_date": '.strtotime('now').',
				  "start_date_time": false,
				  "custom_fields": [
					{
					  "id": "e8b83914-ea5e-4792-9492-437b7c9dd3a7",'. //kategori
					  '"value": ["'.$this->kategori($r->tic_ktg_id).'"]
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
					  '"value": "'.$r->id.'"
					}
				  ]
				}';
			echo $data;
			$res = $this->clickup($list_id,$token,$data,$r->id);
		}
		echo $res;
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
	
	private function layanan($param){
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
                            }
                        ]
                    },
                    "date_created": "1700381694312",
                    "hide_from_guests": false,
                    "required": false
                }';
		$layanan=json_decode($lay);
		$ret="";
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
}