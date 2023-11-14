<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SelMa extends MY_controller {
    
    
    public function __construct()
    {
		parent::__construct();
		$this->load->model('MSelma','ms');
		$this->load->model('MTagihan','mt');
		$this->load->model('MCustomers','mc');
		$this->load->helper('custom');
	}
	

	public function getStatAct($pipe_id='',$d='')
	{
		$acts = false;
		$data = [];
		$ac = [];

		$a = @$this->input->get('act');
		if ($a != '') {
			$s = $a;
		}

		if($a == '') $s = 1;
		
		if ($s == 1) {
			$ac = [
				['note'=>'','v' => 0,'no' => 1,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_co','nama' => 'Contact Potential'],
				['note'=>'','v' => 0,'no' => 2,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_presentation','nama' => 'Persentation'],
				['note'=>'','v' => 0,'no' => 3,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_tp','nama' => 'Technical Persentation'],
				['note'=>'','v' => 0,'no' => 4,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_poc','nama' => 'POC'],
				['note'=>'','v' => 0,'no' => 5,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_sph','nama' => 'SPH'],
				['note'=>'','v' => 0,'no' => 8,'w' =>['id' => $pipe_id,'agree' => 2],'data'=> [],'t'=>'pipeline','nama' => 'LOST'],
				['note'=>'','v' => 0,'no' => 9,'w' =>['id' => $pipe_id,'agree' => 1],'data'=> [],'t'=>'pipeline','nama' => 'Close Deal'],
			];	
		}else if($s == 2){
			$ac = [
			['note' => '','v' => 0,'no' => 6,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_bakn','nama' => 'BAKN'],
            ['note' => '','v' => 0,'no' => 7,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_po','nama' => 'PO'],
            ['note' => '','v' => 0,'no' => 10,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_kontrak','nama' => 'KL'],
			];
		}

		// $ac = [
        //     ['v' => 0,'no' => 1,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_co','nama' => 'Contact Potential'],
        //     ['v' => 0,'no' => 2,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_presentation','nama' => 'Persentation'],
        //     ['v' => 0,'no' => 3,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_tp','nama' => 'Technical Persentation'],
        //     ['v' => 0,'no' => 4,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_poc','nama' => 'POC'],
        //     ['v' => 0,'no' => 5,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_sph','nama' => 'SPH'],
        //     ['v' => 0,'no' => 6,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_bakn','nama' => 'BAKN'],
        //     ['v' => 0,'no' => 7,'w' =>['pipeline_id' => $pipe_id ],'data'=> [],'t'=>'act_po','nama' => 'PO'],
        //     ['v' => 0,'no' => 8,'w' =>['id' => $pipe_id,'activity' => 8],'data'=> [],'t'=>'pipeline','nama' => 'LOST'],
        //     ['v' => 0,'no' => 9,'w' =>['id' => $pipe_id,'activity' => 9],'data'=> [],'t'=>'pipeline','nama' => 'Close Deal'],
		// ];	
		if (@count($ac) > 0) {
			$note = '';
			foreach ($ac as $k => $v ) {
				$act = $this->db->get_where($v['t'],@$v['w']);
				if ($act->num_rows() > 0){
					$ac[$k]['v'] = 1;
					if ($d == 'allow') {
						$ac[$k]['data'] = $act->last_row();
					}
				}
				$nt = $this->db->get_where('act_note',['act_id' => $v['no']]);
				if ($nt->num_rows() > 0) {
					$note = $nt->last_row()->note;
					$ac[$k]['note'] = $note;
				}
			}
		}	
		
		
		if ($d == 'allow') {
			return $ac;
		}else{
			echo json_encode($ac);
		}
	}

	 //new customer
	 public function new_cust()
	 {
		 $d = [
			 'title' => 'New Customers',
			 'linkView' => 'page/selma/new_customer',
			 'fileScript' => 'sales/new_customer.js',
			 'bread' => [
				 'nama' => '',
				 'data' => [
					 ['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				 ]
			 ],
		 ];
		 $this->load->view('_main',$d);
	 }
	 
	  //ncustomer exist
	  public function cust_existing()
	  {
		  $d = [
			  'title' => 'Customer Existing',
			  'linkView' => 'page/selma/cust_exist',
			  'fileScript' => 'sales/cust_exist.js',
			  'bread' => [
				  'nama' => '',
				  'data' => [
					  ['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				  ]
			  ],
		  ];
		  $this->load->view('_main',$d);
	  }

	  public function detail_kontrak()
	 {
		 $id = $this->input->get('id');
		 if($this->ms->getProjek($id)->num_rows() == 0){
			show_404();
		 }

		 $d = [
			 'title' => 'Detail Kontrak',
			 'linkView' => 'page/selma/detail_kontrak',
			 'fileScript' => 'sales/detail_kontrak.js',
			 'dt' => $this->apiGetDetailKontrak(false)['data'],
			 'bread' => [
				 'nama' => '',
				 'data' => [
					 ['nama' => '','link' => '','active' => 'active'],
				 ]
			 ],
		 ];
		 $this->load->view('_main',$d);

	 }

	 public function dtProjekKontrak()
	 {
		 $id = $this->input->post('id');
		 echo $this->ms->dtProjekKontrak($id,'','1');
	 }

	 public function addKontrak()
	 {
		echo json_encode($this->ms->inKontrak());
	 }

	//   API
	
	public function get_pipeline()
	{
		$id = $this->input->get('id');
		$this->ms->see = "id,cust_id,end_cust_id,solution_id,product_id,category,projek,note";
		$q = $this->ms->get($id)->row();
		echo json_encode($q);
	}
	  
	 public function apiGetKontrak()
	 {
		$status = false; 
		$msg = "Gagal meload data"; 
		$data = [];

		$tgh = $this->mt->getProjekTgh();
		if (count($tgh) > 0) {
			$status = true;
			$msg = "Berhasil meload data";
		}
		$data = [
			'status' => $status,
			'data' => $tgh,
			'msg' => $msg,
 		];
		echo json_encode($data);
	 } 

	 public function apiGetDetailKontrak($json=true)
	 {
		$status = false; 
		$msg = "Gagal meload data"; 
		$data = [];
		$id = $this->input->get('id');
		
		$tgh = $this->mt->getProjekTgh($id);
		if (count($tgh) > 0) {
			$status = true;
			$msg = "Berhasil meload data";
			$tgh = [
				'projek_id' => $tgh['projek_id'],
                'service' => $tgh['service'],
                'category' => categ($tgh['category']),
                'customer' => $tgh['customer'],
                'custend' => $tgh['custend'],
                'custendcust' => $tgh['customer'] != '' ? $tgh['customer'].' - '.$tgh['custend'] : $tgh['custend'],
                'masa_kontrak' => $tgh['masa_kontrak'],
                'no_kontrak' => $tgh['no_kontrak'],
                'sales' => $tgh['sales'],
                'start_date' => $this->bantuan->tgl_indo($tgh['start_date']),
                'end_date' => $this->bantuan->tgl_indo($tgh['end_date']),
			];
		}
		$data = [
			'status' => $status,
			'data' => $tgh,
			'msg' => $msg,
		 ];
	
		 if ($json) {
			 echo json_encode($data);
		 }else{
			 return $data;
		 }
	 }

	 public function getProjekKontrak()
	 {
		$id = $this->input->get('id');
		$id_pk = $this->input->get('id_pk');
		$tgh = $this->ms->getProjekKontrak($id_pk,$id)->result();
		$dta = [];
		
		if (count($tgh) > 0) {
			$status = true;
			$msg = "Berhasil meload data";
			foreach ($tgh as $v) {
				$tg = [
					'id' => $v->id,
					'jenis' => $v->jenis,
					'projek_id' => $v->projek_id,
					'masa_kontrak' => $v->masa_kontrak,
					'no_kontrak' => $v->no_kontrak,
					'nominal' => torp($v->total_kon_ppn),
					'tt' => $v->total_kon_ppn,
					'start_date' => $this->bantuan->tgl_indo($v->start_date),
					'sd' => $v->start_date,
					'end_date' => $this->bantuan->tgl_indo($v->end_date),
					'ed' => $v->end_date,
				];

				array_push($dta,$tg);
			}
		}

		$data = [
			'status' => $status,
			'data' => $dta,
			'msg' => $msg,
		 ];
		 
		echo json_encode($data);
	 }

	 public function upKontrak()
	 {
		$this->load->library('upload');

		$msg = "Berhasil mengedit kontrak";
		$kontrak = '';
		
		$data = [
			'no_kontrak' => $this->input->post('no_kontrak_e'),
			'jenis' => $this->input->post('jenis_e'),
			'masa_kontrak' => $this->input->post('masa_kontrak_e'),
			'start_date' => $this->input->post('start_date_e'),
			'end_date' => $this->input->post('end_date_e'),
			'total_kon_ppn' => $this->input->post('nominal_e'),
		];

		$config['upload_path']          ='./data/sls/kontrak';
		$config['allowed_types']        = 'pdf|PDF';
		$config['encrypt_name']        = true;
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('kontrak_e')){
			$msg = $this->upload->display_errors();
		}else{
			$kontrak = $this->upload->data()['file_name'];
        }
		
		if ($kontrak != '') {
			$this->db->insert('projek_k_file',[
				'pk_id' => $this->input->post('id_e'),
				'ctdDate' => date('Y-m-d'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'file' => $kontrak,
				'status' => 1,
			]);
		}

		$this->db->update('projek_kontrak',$data,['id' => $this->input->post('id_e') ]);
		
		$data = [
			'status' => true,
			'msg' => $msg,
		 ];
		 
		echo json_encode($data);
	 }

	 public function delKontrak()
	 {
		$id = $this->input->post('id');
		$this->db->update('projek_kontrak',['status' => 0,'aktif' => 0,'updDate' => date('Y-m-d H:i:s'),'ctdBy' => $this->session->userdata('karyawan_id')],['id' => $id]);
		$data = [
			
			'status' => true,
			'msg' => "Berhasil menghapus kontrak",
		 ];
		 
		echo json_encode($data);
	 }

	//  Projek Exsiting

	public function add_project_existing()
	{
		$this->load->library('upload');
		$this->load->model('MSerdev','msd');
		
		$qty = $this->input->post('qty');

		$projek = [
			'cust_id' => $this->input->post('customer'),
			'cust_end_id' => $this->input->post('endcust'),
			'service' => $this->input->post('projek'),
			'aktif' => 1,
			'status' => 1,
			'ctdBy' => $this->session->userdata('karyawan_id'),
			'ctdDate' => date('Y-m-d'),
			'existing' => '1'
		];

		$p = $this->db->insert('projek', $projek);
		$p_id = $this->db->insert_id();
			
		$pk = [
			'projek_id' => $p_id,
			'no_kontrak' => $this->input->post('no_kontrak'),
			'masa_kontrak' => $this->input->post('masa_kontrak'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'jenis' => $this->input->post('jenis'),
			'total_kon_ppn' => $this->input->post('nominal'),
			'ctdBy' => $this->session->userdata('karyawan_id'),
			'aktif' => 1,
			'status' => 1,
			'status_kontrak' => '1',
		];

		$this->db->insert('projek_kontrak', $pk);
		$pk_id = $this->db->insert_id();

		$wo = [
			'status' => '2',
			'qty' => $qty,
			'pk_id' => $pk_id
		];

		$this->msd->in_wo($wo);
			
		$kontrak = '';
		$config['upload_path']          ='./data/sls/kontrak';
		$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('kontrak')){
			$msg = $this->upload->display_errors();
		}else{
			$kontrak = $this->upload->data()['file_name'];
			if ($kontrak != '') {
				$this->db->insert('projek_k_file', [
					'file' => $kontrak,
					'status' => 1,
					'ctdBy' => $this->session->userdata('karyawan_id'),
					'ctdDate' => date('Y-m-d H:i:s'),
					'pk_id' => $pk_id,
				]);
			}
		}

		$data = [
			'msg' => "Berhasil menambahkan Projek Eksiting",
			'status' => true
		];

		echo json_encode($data);
	}

    //master Data v
    public function data_customers()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/data_customer',
            'fileScript' => 'selma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
	}


    public function end_customers()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/end_customer',
            'fileScript' => 'selma.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

	// Data Sales

    public function data_sales()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/data_sales',
            'fileScript' => 'selma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
	}
	
	public function dtSales()
	{
		echo $this->ms->dtSales();
	}

	// Solution

    public function data_solution()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/data_solution',
            'fileScript' => 'selma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
	}
	
	public function dtSolution()
	{
		echo $this->ms->dtSolution();
	}

	public function getSolution($id='')
	{
		$product = $this->input->get('product');
		
		if ($id != '') {
			$g = $this->ms->getSolution($id)[0]->row();
		}else if ($product != '') {
			$g = $this->ms->getSolution('',$product)[0]->result();
		}else{
			$g = $this->ms->getSolution($id)[0]->result();
		}
		echo json_encode($g);
	}

	public function upSolution()
	{
		$msg = 'Failed Edit Solution';
		$status = 0;
		$id = $this->input->post('e_id');

		$obj = [
			'solution' => $this->input->post('e_solution'),
			'product_id' => $this->input->post('e_product'),
		];

		$x = $this->ms->upSolution($obj,$id);
		if ($x > 0) {
			$msg = "Success edit solution";
			$status = 1;
		}

		$arr = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($arr);
	}

	public function inSolution($id='')
	{
		$msg = 'Failed add Solution';
		$status = 0;

		$obj = [
			'solution' => $this->input->post('solution'),
			'product_id' => $this->input->post('product'),
			'created_date' => date('Y-m-d'),
			'created_by' => $this->session->userdata('karyawan_id'),
		];

		$x = $this->ms->inSolution($obj);
		if ($x > 0) {
			$msg = "Success add solution";
			$status = 1;
		}

		$arr = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($arr);
	}

	// public function delSolution()
	// {
	// 	$id = $this->input->post('id');
	// 	$g = $this->ms->deSolution($id);

	// 	$msg = "Success delete solution";
	// 	$status = 1;

	// 	$arr = [
	// 		'msg' => $msg,
	// 		'status' => $status
	// 	];

	// 	echo json_encode($arr);
	// }

	// Sales Production

    public function data_products()
	{
		$d = [
			'title' => 'Data Product',
			'linkView' => 'page/selma/data_product',
            'fileScript' => 'Sproduct.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
			],
			'solution' => $this->db->get('sales_solution')->result()
		];
		$this->load->view('_main',$d);
	}
	
	public function dtProduct()
	{
		echo $this->ms->dtProduct();
	}

	public function getProduct($id='')
	{
		if ($id != '') {
			$g = $this->ms->getProduct($id)[0]->row();
		}else{
			$id_s = $this->input->get('id_solution');
			if ($id_s != '') {
				$g = $this->ms->getProduct('',$id_s)[0]->result();
			}else{
				$g = $this->ms->getProduct()[0]->result();
			}
		}

		echo json_encode($g);
	}

	public function upProduct()
	{
		$msg = 'Failed Edit Product';
		$status = 0;
		$id = $this->input->post('e_id');

		$obj = [
			'product' => $this->input->post('e_product'),
		];

		$x = $this->ms->upProduct($obj,$id);
		if ($x > 0) {
			$msg = "Success edit solution";
			$status = 1;
		}

		$arr = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($arr);
	}

	public function inProduct($id='')
	{
		$msg = 'Failed add Product';
		$status = 0;

		$obj = [
			'product' => $this->input->post('product'),
			'created_date' => date('Y-m-d'),
			'created_by' => $this->session->userdata('karyawan_id'),
		];

		$x = $this->ms->inProduct($obj);
		if ($x > 0) {
			$msg = "Success add solution";
			$status = 1;
		}

		$arr = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($arr);
	}
	
	public function delProduct(){
		$id = $this->input->post('id');
		$del = $this->ms->delProduct($id);

			$pesan = 'success delete product';
			$status = 1;

		$msg = [
			'msg' => $pesan,
			'status' => $status
		];

		echo json_encode($msg);

	}


    //Pipeline v

    public function pipeline()
	{
		$d = [
			'title' => 'Pipeline',
			'linkView' => 'page/selma/pipeline',
            'fileScript' => 'selma.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
			],
			'customers' => $this->db->get('cust')->result(), 
			'end_cust' => $this->db->get('cust_end')->result(), 
			'solution' => $this->db->get('sales_solution')->result(), 
			'product' => $this->db->get('sales_product')->result(), 
		];
		$this->load->view('_main',$d);
	}

	public function editPipeline()
	{
		$id_pip = $this->input->post('e_eid');
		
		$pipeline = [
			'projek' => $this->input->post('e_projek'),
			'cust_id' => $this->input->post('e_customer'),
			'end_cust_id' => $this->input->post('e_end_cust'), 
			'solution_id' => $this->input->post('e_solution'), 
			'product_id' => $this->input->post('e_product'), 
			'category' => $this->input->post('e_category'), 
			'note' => $this->input->post('e_note'), 
		];
		
		$this->db->update('pipeline',$pipeline,['id' => $id_pip ]);
		
		$data = [
			'msg' => "Berhasil edit pipeline",
			'status' => true
		];

		echo json_encode($data);
	}
	
	public function pipeline_activity($id='')
	{
		$act = $this->input->get('act');
		
		if ($act == '') {
			$act = 1;
			$bread = [
				['nama' => 'Pipeline','link' => site_url('SelMa/pipeline'),'active' => ''],
				['nama' => 'Pipeline Activity','link' => '','active' => 'active'],
			];
		}else{
			$bread = [
				['nama' => 'New Customer','link' => site_url('SelMa/new_cust'),'active' => ''],
				['nama' => 'Pipeline Activity','link' => '','active' => 'active'],
			];
		}	

		$pa = $this->ms->getPactivity($id)->row();
		$d = [
			'title' => 'Activity Pipeline',
			'linkView' => 'page/selma/pipeline_activity',
            'fileScript' => 'sales/pipeline_activity.js',
			'bread' => [
				'nama' => 'Pipeline Activity',
				'data' => $bread
			],
			'pa' => [
				'category' => $this->ms->categ($pa->category),
				'customer' => $pa->customer,
				'note' => $pa->note,
				'custend' => $pa->custend,
				'product' => $pa->product,
				'solution' => $pa->solution,
				'act' => $pa->activity

			],
			'act' =>  $this->getStatAct($id,'allow')
		];
		$this->load->view('_main',$d);
	}

	public function dtPipeline()
	{
		$act = $this->input->post('activity');
		$agree = $this->input->post('agree');

		echo $this->ms->dtPipeline($act,$agree);
	}

	public function inPipelineActivity()
	{
		$this->load->library('upload');

		$msg = '';
		$f = '';

		$id_pip = $this->input->post('id');
		$activity = $this->input->post('activity');
		$note = $this->input->post('note');
		$persen = $this->input->post('persen');

		// Note

		if ($note != '') {
			$notes = [
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'act_id' => $activity,
				'note' => $note,
				'pipeline_id' => $id_pip,
			];
	
			$this->db->insert('act_note',$notes);
		}
		

		if ($activity == 8) {
			$agree = 2;
		}else if ($activity == 9) {
			$agree = 1;
		}

		if ($activity == 8 || $activity == 9) {
			$pipeline = [
				'activity' => @$activity, 
				'agree' => @$agree, 
				'date' => date('Y-m-d'), 
			];
	
			$this->db->update('pipeline', $pipeline, ['id' => $id_pip]);
		}
		 
		if($activity == '') $activity = 0;
		
		$pipeline = [
			'activity' => @$activity, 
			'persen' => @$persen, 
			'date' => date('Y-m-d'), 
		];

		$this->db->update('pipeline', $pipeline, ['id' => $id_pip]);
		
		if ($activity == '1') {
			$data = [
				'start_date' => $this->input->post('start_date'),
				'created_date' => date('Y-m-d'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'pipeline_id' => $id_pip,
			];

			$this->db->insert('act_co',$data);

		}elseif ($activity == '2') {	
			
			$ceking = $this->db->get_where('act_presentation',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$mom = $ceking->last_row()->mom;
				$cust_need = $ceking->last_row()->cust_need;
			}else{
				$mom = '';
				$cust_need = '';	
			}
				
			$config['upload_path']          ='./data/sls/mom';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('mom')){
				$msg = $this->upload->display_errors();
			}else{
				$mom = $this->upload->data()['file_name'];
			}

			$config['upload_path']          ='./data/sls/cust_need';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('cust_need')){
				$msg = $this->upload->display_errors();
			}else{				
				$cust_need = $this->upload->data()['file_name'];
			}
				
			$data = [
				'present_date' => $this->input->post('present_date'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'mom' => $mom,
				'cust_need' => $cust_need,
				'req_presales' => $this->input->post('req_presales') == '' ? 0 : 1,
				'pipeline_id' => $id_pip,
			];
			
			$this->db->insert('act_presentation',$data);
			

		}elseif ($activity == '3') {			
			
			$ceking = $this->db->get_where('act_tp',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$mom = $ceking->last_row()->mom;
				$cust_need = $ceking->last_row()->cust_need;
			}else{
				$mom = '';
				$cust_need = '';	
			}

			$config['upload_path']          ='./data/sls/mom';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('mom')){
				$msg = $this->upload->display_errors();
			}else{
				$mom = $this->upload->data()['file_name'];
			}

			$config['upload_path']          ='./data/sls/cust_need';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('cust_need')){
				$msg = $this->upload->display_errors();
			}else{
				$cust_need = $this->upload->data()['file_name'];
			}
				
			$data = [
				'present_date' => $this->input->post('present_date'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'mom' => $mom,
				'cust_need' => $cust_need,
				'pipeline_id' => $id_pip,
			];

			$this->db->insert('act_tp',$data);

		}else if ($activity == '4') {

			$ceking = $this->db->get_where('act_poc',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$mom = $ceking->last_row()->mom;
			}else{
				$mom = '';
			}

			$msg = '';
			$config['upload_path']          ='./data/sls/mom';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('mom')){
				$msg = $this->upload->display_errors();
			}else{
				$mom = $this->upload->data()['file_name'];
			}

			$data = [
				'created_date' => $this->input->post('present_date'),
				'mom' => $mom,
				'created_by' => $this->session->userdata('karyawan_id'),
				'pipeline_id' => $id_pip,
			];

			$this->db->insert('act_poc',$data);

		}else if ($activity == '5') {
			
			$ceking = $this->db->get_where('act_sph',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$sph = $ceking->last_row()->sph;
			}else{
				$sph = '';
			}

			$config['upload_path']          ='./data/sls/sph/';
			$config['allowed_types']        = 'xls|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('sph')){
				$msg = $this->upload->display_errors();
			}else{
				$sph = $this->upload->data()['file_name'];
			}

			// $opex = '';	
			// $config['upload_path']          ='./data/sls/sph_opex/';
			// $config['allowed_types']        = 'xls|xlsx|doc|docx|pdf';
			// $config['max_size']             = 0;
			// $config['max_width']            = 0;
			// $config['max_height']           = 0;

			// $this->upload->initialize($config);

			// if (!$this->upload->do_upload('fopex')){
			// 	$msg = $this->upload->display_errors();
			// }else{
			// 	$opex = $this->upload->data()['file_name'];
			// }

			$data = [
				'no' => $this->input->post('no_sph'),
				'judul_p' => $this->input->post('jdl_pek'),
				// 'fcapex' => $capex,
				'ccapex' => $this->input->post('ccapex'),
				// 'fopex' => $opex,
				'copex' => $this->input->post('copex'),
				'sph' => $sph,
				'date' => date('Y-m-d'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'pipeline_id' => $id_pip,
			];

			$this->db->insert('act_sph',$data);

			$this->ms->inprojek_n_kontrak($id_pip);

		}else if ($activity == '6') {
			
			$ceking = $this->db->get_where('act_bakn',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$bakn = $ceking->last_row()->bakn;
			}else{
				$bakn = '';
			}

			$config['upload_path']          ='./data/sls/bakn';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bakn')){
				$msg = $this->upload->display_errors();
			}else{
				$bakn = $this->upload->data()['file_name'];
			}
				
			$data = [
				'service_title' => $this->input->post('service_title'),
				'nominal' => $this->input->post('nominal'),
				'created_date' => date('Y-m-d'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'bakn' => $bakn,
				'pipeline_id' => $id_pip,
			];

			$this->ms->inprojek_n_kontrak($id_pip,[
				'total_kon_ppn' => $this->input->post('nominal'),
			],'pk');

			$this->ms->inprojek_n_kontrak($id_pip,[
				'service' => $this->input->post('service_title'),
			],'p');

			$this->db->insert('act_bakn',$data);

		}else if ($activity == '7') {
			$ceking = $this->db->get_where('act_po',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$po = $ceking->last_row()->po;
			}else{
				$po = '';
			}

			$config['upload_path']          ='./data/sls/po';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('po')){
				$msg = $this->upload->display_errors();
			}else{
				$po = $this->upload->data()['file_name'];
			}
				
			$data = [
				'no' => $this->input->post('no_po'),
				'service_title' =>$this->input->post('service_title'),
				'nominal' =>$this->input->post('nominal'),
				'masa_kontrak' =>$this->input->post('masa_kontrak'),
				'jml' =>$this->input->post('jml'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'created_date' => date('Y-m-d'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'po' => $po,
				'pipeline_id' => $id_pip,
			];

			$this->db->insert('act_po',$data);

			$this->ms->inprojek_n_kontrak($id_pip,[
				'no_kontrak' => $this->input->post('no_po'),
				'masa_kontrak' => $this->input->post('masa_kontrak'),
				'total_kon_ppn' => $this->input->post('nominal'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				'aktif' => 1,
				'status' => 1,
			],'pk');

			$this->ms->inprojek_n_kontrak($id_pip,[
				'service' => $this->input->post('service_title'),
			],'p');

		}else if ($activity == '10') {
			$ceking = $this->db->get_where('act_kontrak',['pipeline_id' => $id_pip]);
			if ($ceking->num_rows() > 0) {
				$kontrak = $ceking->last_row()->kontrak;
			}else{
				$kontrak = '';
			}

			$config['upload_path']          ='./data/sls/kontrak/';
			$config['allowed_types']        = 'xls|xlsx|doc|docx|pdf';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('kontrak')){
				$msg = $this->upload->display_errors();
			}else{
				$kontrak = $this->upload->data()['file_name'];
			}

			$data = [
				'kontrak' => $kontrak,
				'ctdDate' => date('Y-m-d'),
				'no_kontrak' =>$this->input->post('no_kontrak'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'pipeline_id' => $id_pip,
			];

			$this->ms->inprojek_n_kontrak($id_pip,[
				'no_kontrak' => $this->input->post('no_kontrak'),
				'aktif' => 1,
				'status' => 1,
			],'pk');

			$this->db->insert('act_kontrak',$data);
		}

		// $this->ms->inHPipeline($pipeline,$id_pip);

		$arr = [
			'msg' => "Success add pipeline",
			'status' => 1
		];

		echo json_encode($arr);
	}

	public function inPipeline()
	{
		$this->load->library('upload');

		$msg = '';
		$f = '';

		$cust_id = $this->input->post('customer');
		$endcust_id = $this->input->post('end_cust');

		$cu = $this->mc->get($this->input->post('customer'));		
		if ($cu->num_rows() == 0) {
			$cust_id = $this->mc->in([
				'pic' => $this->input->post('pic'),
				'customer' => $this->input->post('tcustomer'),
				'email' => $this->input->post('email'),
				'kontak_cus' => $this->input->post('telp'),
				'alamat' => $this->input->post('address')
				]
			)[2];
		}

		$endcu = $this->mc->getEnd($this->input->post('end_cust'));		
		if ($endcu->num_rows() == 0) {
			$endcust_id = $this->mc->inEnd([
				'pic' => $this->input->post('pic_end'),
				'custend' => $this->input->post('tcustend'),
				'email' => $this->input->post('email_end'),
				'kontak_cus' => $this->input->post('telp_end'),
				'alamat' => $this->input->post('address_end')
				]
			)[2];
		}
		
		$activity = $this->input->post('activity');
		if($activity == '') $activity = 0;
		$pipeline = [
			'cust_id' => $cust_id,
			'end_cust_id' => $endcust_id, 
			'sales_id' => $this->session->userdata('karyawan_id'),
			'projek' => $this->input->post('projek'), 
			'pic' => $this->input->post('pic'), 
			'telp' => $this->input->post('telp'), 
			'address' => $this->input->post('address'), 
			'solution_id' => $this->input->post('solution'), 
			'product_id' => $this->input->post('product'), 
			'category' => $this->input->post('category'), 
			'note' => $this->input->post('note'), 
			'activity' => @$activity, 
			'date' => date('Y-m-d'), 
		];
		$this->db->insert('pipeline',$pipeline);
		$id_pip = $this->db->insert_id();

		$this->ms->inHPipeline($pipeline,$id_pip);

		$arr = [
			'msg' => "Success add pipeline",
			'status' => 1
		];
		
		echo json_encode($arr);
	}

	public function upPipeline()
	{
		$this->load->library('upload');

		$msg = '';
		$f = '';

		$activity = $this->input->post('activity');
		if($activity == '') $activity = 0;
		$id_pip = $this->input->post('id');
		$pipeline = [
			'cust_id' => $this->input->post('customer'),
			'end_cust_id' => $this->input->post('end_cust'), 
			'sales_id' => $this->session->userdata('karyawan_id'),
			'pic' => $this->input->post('pic'), 
			'telp' => $this->input->post('telp'), 
			'address' => $this->input->post('address'), 
			'solution_id' => $this->input->post('solution'), 
			'product_id' => $this->input->post('product'), 
			'category' => $this->input->post('category'), 
			'activity' => $activity, 
			'date' => date('Y-m-d'), 
		];
		$this->db->update('pipeline',$pipeline,['id' => $id_pip ]);

		if ($activity == '1') {
				
			$data = [
				'start_date' => $this->input->post('start_date'),
				'created_by' => $this->session->userdata('karyawan_id'),
			];

			$this->db->update('act_co',$data,['pipeline_id' => $id_pip]);

		}elseif ($activity == '2') {

			// // Required
			$gpre = $this->db->get('act_presentation',['pipeline_id' => $id_pip]);
			if ($gpre->num_rows() > 0) {
				$g = $gpre->row();

				$present_date = $this->input->post('present_date');

				if (!$present_date) {
					$present_date = $g->present_date;
				}

				$req_presales = $this->input->post('req_presales');
				if (!$req_presales) {
					$req_presales = $g->req_presales;
				}	
				
				$mom = '';	
				$config['upload_path']          ='./data/mom';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('mom')){
					$msg = $this->upload->display_errors();
					$mom = $g->mom;
				}else{
					$mom = $this->upload->data()['file_name'];
				}

				$cust_need = '';	
				$config['upload_path']          ='./data/cust_need';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cust_need')){
					$msg = $this->upload->display_errors();
					$cust_need = $g->cust_need;
				}else{
					$cust_need = $this->upload->data()['file_name'];
				}
					
				$data = [
					'present_date' => $present_date,
					'created_by' => $this->session->userdata('karyawan_id'),
					'mom' => $mom,
					'cust_need' => $cust_need,
					'req_presales' => $req_presales,
				];

				$this->db->update('act_presentation',$data,['pipeline_id' => $id_pip]);	
			}else{
				$mom = '';	
				$config['upload_path']          ='./data/mom';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('mom')){
					$msg = $this->upload->display_errors();
				}else{
					$mom = $this->upload->data()['file_name'];
				}

				$cust_need = '';	
				$config['upload_path']          ='./data/cust_need';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cust_need')){
					$msg = $this->upload->display_errors();
				}else{
					$cust_need = $this->upload->data()['file_name'];
				}
					
				$data = [
					'present_date' => $this->input->post('present_date'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'mom' => $mom,
					'cust_need' => $cust_need,
					'req_presales' => $this->input->post('req_presales'),
					'pipeline_id' => $id_pip,
				];

				$this->db->insert('act_presentation',$data);
				
			}

		}else if ($activity == '3') {
			// // Required
			$gpre = $this->db->get('act_poc',['pipeline_id' => $id_pip]);
			if ($gpre->num_rows() > 0) {

				$data = [
					'created_date' => $this->input->post('present_date'),
					'created_by' => $this->session->userdata('karyawan_id'),
				];
	
				$this->db->update('act_poc',$data,['pipeline_id' => $id_pip]);
				
			}else{
				$data = [
					'created_date' => $this->input->post('present_date'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'pipeline_id' => $id_pip,
				];
	
				$this->db->insert('act_poc',$data);
			}

		}else if ($activity == '4') {
			// // Required
			$gpre = $this->db->get('act_sph',['pipeline_id' => $id_pip]);
			$g = $gpre->row();
			if ($gpre->num_rows() > 0) {

				$sph = '';	
				$config['upload_path']          ='./data/sph';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('sph')){
					$msg = $this->upload->display_errors();
					$sph = $g->sph;
				}else{
					$sph = $this->upload->data()['file_name'];
				}

				$data = [
					'no' => $this->input->post('no_sph'),
					'judul_p' => $this->input->post('judul_p'),
					'sph' => $sph,
					'date' => date('Y-m-d'),
					'created_by' => $this->session->userdata('karyawan_id'),
				];

				$this->db->update('act_sph',$data,['pipeline_id' => $id_pip]);
			}else{
				$sph = '';	
				$config['upload_path']          ='./data/sph';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('sph')){
					$msg = $this->upload->display_errors();
				}else{
					$sph = $this->upload->data()['file_name'];
				}

				$data = [
					'no' => $this->input->post('no_sph'),
					'judul_p' => $this->input->post('judul_p'),
					'sph' => $sph,
					'date' => date('Y-m-d'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'pipeline_id' => $id_pip,
				];

				$this->db->insert('act_sph',$data);
			}

		}else if ($activity == '5') {
			// // Required
			$gpre = $this->db->get('act_bakn',['pipeline_id' => $id_pip]);
			$g = $gpre->row();

			if ($gpre->num_rows() > 0) {
				$bakn = '';
				$config['upload_path']          ='./data/bakn';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('bakn')){
					$msg = $this->upload->display_errors();
					$bakn = $g->bakn;
				}else{
					$bakn = $this->upload->data()['file_name'];
				}
					
				$data = [
					'nominal' => $this->input->post('no'),
					'service_title' => $this->input->post('service_title'),
					'nominal' => $this->input->post('nominal_bkan'),
					'created_date' => date('Y-m-d'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'bakn' => $bakn,
				];

				$this->db->update('act_bakn',$data,['pipeline_id' => $id_pip]);
			}else{					
				$bakn = '';
				$config['upload_path']          ='./data/bakn';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('bakn')){
					$msg = $this->upload->display_errors();
				}else{
					$bakn = $this->upload->data()['file_name'];
				}
					
				$data = [
					'nominal' => $this->input->post('no'),
					'service_title' => $this->input->post('service_title'),
					'nominal' => $this->input->post('nominal_bkan'),
					'created_date' => date('Y-m-d'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'bakn' => $bakn,
					'pipeline_id' => $id_pip,
				];

				$this->db->insert('act_bakn',$data);
			}


		}else if ($activity == '6') {

			// // Required
			$gpre = $this->db->get('act_po',['pipeline_id' => $id_pip]);
			$g = $gpre->row();

			if ($gpre->num_rows() > 0) {
				$po = '';
				$config['upload_path']          ='./data/po';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('po')){
					$msg = $this->upload->display_errors();
					$po = $g->po;
				}else{
					$po = $this->upload->data()['file_name'];
				}
					
				$data = [
					'no' => $this->input->post('no_po'),
					'service_title' =>$this->input->post('service_title'),
					'nominal' =>$this->input->post('nominal'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
					'created_date' => date('Y-m-d'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'po' => $po,
					'pipeline_id' => $id_pip,
				];

				$this->db->insert('act_po',$data);

			}else{

				$po = '';
				$config['upload_path']          ='./data/po';
				$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
				$config['max_size']             = 0;
				$config['max_width']            = 0;
				$config['max_height']           = 0;

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('po')){
					$msg = $this->upload->display_errors();
				}else{
					$po = $this->upload->data()['file_name'];
				}
					
				$data = [
					'no' => $this->input->post('no_po'),
					'service_title' =>$this->input->post('service_title'),
					'nominal' =>$this->input->post('nominal'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
					'created_date' => date('Y-m-d'),
					'created_by' => $this->session->userdata('karyawan_id'),
					'po' => $po,
					'pipeline_id' => $id_pip,
				];

				$this->db->insert('act_po',$data);
			}

		}

		$this->ms->inHPipeline($pipeline,$id_pip);

		$arr = [
			'msg' => "Success add pipeline",
			'status' => 1
		];
		
		echo json_encode($arr);
	}

	public function getPipeline($id='')
	{
		if ($id != '') {
			$q = $this->ms->getDetail($id)->row();
			echo json_encode($q);
		}
	}

    public function detail_pipeline($id='')
	{
		$act = $this->input->get('act');
		
		if ($act == '') {
			$act = 1;
			$bread = [
				['nama' => 'Pipeline','link' => site_url('SelMa/pipeline'),'active' => ''],
				['nama' => 'Detail Pipeline','link' => '','active' => 'active'],
			];
		}else{
			$bread = [
				['nama' => 'New Customer','link' => site_url('SelMa/new_cust'),'active' => ''],
				['nama' => 'Detail Pipeline','link' => '','active' => 'active'],
			];
		}	

		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/detail_pipeline',
            'fileScript' => 'sales/detail_pipeline.js',
			'bread' => [
				'nama' => '  ',
				'data' => $bread,
			],
			'd' => $this->ms->getDetail($id)->row(),
			'act' => $this->getStatAct($id,'allow'),
			'category' => $this->ms->categ($this->ms->getDetail($id)->row()->category)
		];
		$this->load->view('_main',$d);
	}

	//pipeline ^
	
	// Acivity

	public function getAct()
	{
		$pipe_id = $this->input->get('pipe_id');
		$act_id = $this->input->get('act');
		// $act_id = $this->input->get('act_id');
		$acts = [
			'mom' => '',
			'cust_need' => '',
			'req_presales' => 0,
			'next_p' => 0,
			'fcapex' => '',
			'fopex' => '',
			'ccapex' => 0,
			'copex' => 0,
			'judul_p' => '',
			'no' => '',
			'service_title' => '',
			'bakn' => '',
			'masa_kontrak' => '',
			'nominal' => '',
			'kontrak' => '',
			'start_date' => '',
			'end_date' => '',
			'act' => '',
			'po' => '',
		];	

		if ($act_id == '') {
			$act_id = $this->db->get('pipeline',['id' => $pipe_id])->row()->activity;
		}
		
		if ($act_id == '1') {
			$act = $this->db->get_where('act_co',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '2') {
			$act = $this->db->get_where('act_presentation',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '3') {
			$act = $this->db->get_where('act_tp',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '4') {
			$act = $this->db->get_where('act_poc',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '5') {
			$act = $this->db->get_where('act_sph',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '6') {
			$act = $this->db->get_where('act_bakn',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '7') {
			$act = $this->db->get_where('act_po',['pipeline_id' => $pipe_id ]);
		}else if ($act_id == '8') {
			$acts = 'LOST';
		}else if ($act_id == '9') {
			$acts = 'Close Deal';
		}else if ($act_id == '10') {
			$act = $this->db->get_where('act_kontrak',['pipeline_id' => $pipe_id ]);
		}
		
		if ($act_id != '8' && $act_id != '9') {
			if ($act->num_rows() > 0) {
				$acts = $act->last_row();
			}
		}

		echo json_encode($acts);
	}

    //marketing program v

    public function marketing_program()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/marketing_program',
            'fileScript' => 'selma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

	//Marketing program ^
	
	public function detail_contract()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/detail_contract',
            'fileScript' => 'selma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
	}
	
	public function detail_mutation()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/detail_mutation',
            'fileScript' => 'selma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

    //Billing process v

    public function contract_list()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/contract_list',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

    public function invoice()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/invoice',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }


	public function detail_invoice()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/detail_invoice',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

    //Billing process ^

    //Form v

    public function mutation()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/mutation',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

    public function dismantle()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/dismantle',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

	//Marketing Program
	
	public function dtMarkProg()
	{
		echo $this->ms->dtMarkProg();
	}

	public function getMarProg($id='')
	{
		if ($id != '') {
			$q = $this->db->get_where('mar_prog',['id' => $id]);
		}else{
			$q = $this->db->get('mar_prog');
		}

		echo json_encode($q->result());
	}

	public function delMarProg($id=''){
		if($id != ''){ 
			$del = $this->db->delete('mar_prog',['id' => $id]);
			
			$pesan = 'Success delete Marketing Program';
			$status = 1;

			$msg = [
				'msg' => $pesan,
				'status' => $status
			];

			echo json_encode($msg);
		}

	}

	public function upMarkProg()
	{
		$id = $this->input->post('e_id');
		$data = [
			"title" => $this->input->post("e_title"),
			"start_date" => $this->input->post("e_start_date"),
			"created_by" => $this->session->userdata('karyawan_id'),
			"end_date" => $this->input->post("e_end_date"),
			"desc" => $this->input->post("e_description"),
		];

		$this->db->update('mar_prog',$data,['id' => $id]);

		$arr = [
			'msg' => 'Success update Marketing Program',
			'status' => 1
		];
		
		echo json_encode($arr);
	}

	public function inMarkProg()
	{
		$data = [
			"title" => $this->input->post("title"),
			"start_date" => $this->input->post("start_date"),
			"end_date" => $this->input->post("end_date"),
			"desc" => $this->input->post("description"),
			"created_by" => $this->session->userdata('karyawan_id'),
		];

		$this->db->insert('mar_prog',$data);

		$arr = [
			'msg' => 'Success add Marketing Program',
			'status' => 1
		];
		
		echo json_encode($arr);
	}

	// Schedule

	public function sales_schedule()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/selma/sales_schedule',
	        'fileScript' => 'sales/sales_schedule.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
	          ],
		];
		$this->load->view('_main',$d);
	}

	public function dtSalesSchedule()
	{
		echo $this->ms->dtSalesSchedule();
	}

	public function inSchedule()
	{
		$var = [
			"title" => $this->input->post("title"),
			"date" => $this->input->post("date"),
			"location" => $this->input->post("location"),
			"description" => $this->input->post("description"),
			"created_by" => $this->session->userdata('karyawan_id'),
		];

		$q = $this->db->insert('sales_schedule',$var);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal menambahkan data baru');
		}

		echo $jsn;
	}

	public function upSchedule()
	{
		$var = [
			"title" => $this->input->post("e_title"),
			"date" => $this->input->post("e_date"),
			"location" => $this->input->post("e_location"),
			"description" => $this->input->post("e_description"),
			"created_by" => $this->session->userdata('karyawan_id'),
		];

		$q = $this->db->update('sales_schedule',$var,['id' => $this->input->post('e_id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data baru');
		}

		echo $jsn;
	}

	public function deSchedule()
	{
		$id = $this->input->get('id');
		$g = $this->db->delete('sales_schedule',['id' => $id]);
		
		echo ctojson('',1,'Sukses menghapus sales schedule');
	}

	public function getSchedule()
	{
		
		$id = $this->input->get('id');
		$g = $this->db->get_where('sales_schedule',['id' => $id]);
		if ($g->num_rows() > 0) {
			$data = $g->row();
			$jsn = ctojson($data,1,'Sukses menampilkan data sales schedule');
		}else{
			$jsn = ctojson('',0,'Gagal menampilkan data sales schedule');
		}

		echo $jsn;
	}

	// Projek PO

	public function projek_po()
	{
		$d = [
			'title' => 'Projek PO',
			'linkView' => 'page/selma/projek_po',
	        'fileScript' => 'sales/projek_po.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
	          ],
		];
		$this->load->view('_main',$d);
	}
    
	public function dtProjekPo()
	{
		echo $this->ms->dtProjekPo();
	}

	public function detail_projek_po()
	{
		$pk_id= $this->input->get('pk');

		$dtk = [
			"pk_id" => $pk_id
		];
		
		$cek_dtk = $this->ms->get_dtk('',['pk_id' => $pk_id]); 
		if ($cek_dtk->num_rows() == 0) {
			
			$this->ms->in_dtk($dtk);
			$id_dtk = $this->db->insert_id();
			
		}else {
			$id_dtk = $cek_dtk->row()->id;
		}
		
		$d = [
			'title' => 'Projek PO',
			'linkView' => 'page/selma/detail_projek_po',
	        'fileScript' => 'sales/detail_projek_po.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
	          ],
			  'projek' => $this->ms->getProjekPo($pk_id)->row(),
			  'datek_id' => $id_dtk
		];
		$this->load->view('_main',$d);
	}

	public function dtDetailProjekPo($pk_id='')
	{
		echo $this->ms->dtDetailProjekPo($pk_id);
	}

	public function import_datek()
    {
        $file = '';
        $msg = '';
        $ds = [];
        
		
        $pk_id = $this->input->post('pk_id');
        $datek_id = $this->input->post('datek_id');
        

        $this->load->library('upload');
        
        $config['upload_path']          = './sample/upload/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('datek')){
        //    var_dump($this->upload->display_errors());
        }else{
           $file = $this->upload->data()['file_name'];
        }

        if ($file != '') {

            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./sample/upload/'.$file); // Load file yang telah diupload ke folder excel
            $getSheet = $loadexcel->getSheetNames();

            foreach ($getSheet as $rows) {
                $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
                $data = [];
                $numrow = 1;
                foreach ($sheet as $row) {

                    if ($numrow > 1) {
                        $d = [
							'datek_id' => $datek_id,
							'pk_id' => $pk_id,
							'ctddate' => date('Y-m-d'),
							'ctdtime' => date('H:i:s'),
                            'layanan' => $row['A'],	
                            'lokasi' => $row['B'],	
                            'provinsi' => $row['C'],	
                            'alamat' => $row['D'],	
                            'sid' => $row['E'],	
                            'status' => $row['F'],	
                            'masa_layanan' => $row['G'],
                       ];

                       array_push($ds,$d);

                    }

                    $numrow++; // Tambah 1 setiap kali looping
                }
            }
        }

        $rsp['data'] = $ds;

        if (count($ds) > 0) {

            $this->db->insert_batch('datek_list', $ds);

            $rsp['status'] = true;
            $rsp['msg'] = "Berhasil import datek";
            @unlink('./sample/upload/'.$file);
        }else{
            $rsp['status'] = false;
            $rsp['msg'] = "Gagal import datek";
        }

        echo json_encode($rsp);
    }

	public function addDatekList()
	{
		$datek_id = $this->input->post('datek_id');
		$pk_id = $this->input->post('pk_id');
		$layanan = $this->input->post('layanan');
		$lokasi = $this->input->post('lokasi');
		$provinsi = $this->input->post('provinsi');
		$alamat = $this->input->post('alamat');
		$sid = $this->input->post('sid');
		$status = $this->input->post('status');
		$masa_layanan = $this->input->post('masa_layanan');
		
		$data = [
			'datek_id' => $datek_id,
			'pk_id' => $pk_id,
			'layanan' => $layanan,
			'lokasi' => $lokasi,
			'provinsi' => $provinsi,
			'alamat' => $alamat,
			'sid' => $sid,
			'status' => $status,
			'masa_layanan' => $masa_layanan,
			'ctddate' => date('Y-m-d'),
			'ctdtime' => date('H:i:s')
		];

		$x = $this->ms->in_dtk_list($data);


		if ($x) {
			$status = true;
			$msg = "Berhasil menambahkan datek";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);

	}

	public function getDtkList($id='')
    {
        $data = '';
        if (!empty($id)) {
           $q = $this->ms->getDtkList($id)->row();
        }else{
            $q = $this->ms->getDtkList()->result();
        }

        $data = [
			'data' => $q,
        ];

        echo json_encode($data);
	}

	public function editDtkList()
    {
		$msg = 'Gagal mengedit data';
		$status = false;

		$id = $this->input->post('id_dtk_list');
		$layanan = $this->input->post('layanan');
		$lokasi = $this->input->post('lokasi');
		$provinsi = $this->input->post('provinsi');
		$alamat = $this->input->post('alamat');
		$sid = $this->input->post('sid');
		$status = $this->input->post('status');
		$masa_layanan = $this->input->post('masa_layanan');

		$obj = [
			'layanan' => $layanan,
			'lokasi' => $lokasi,
			'provinsi' => $provinsi,
			'alamat' => $alamat,
			'sid' => $sid,
			'status' => $status,
			'masa_layanan' => $masa_layanan,
		];
		$up = $this->ms->up_dtk_list($obj,['id' => $id]);
		if ($up) {
			$status = true;
			$msg = "Berhasil mengupdate data";
		}else{
			$status = false;
			$msg = "Gagal menambahkan data";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);
	}
}


