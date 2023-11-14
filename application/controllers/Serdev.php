<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serdev extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MSerdev','ms');
	}
    
	public function list_document()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/serdev/document',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => 'List Document',
				'data' => [
					['nama' => 'List Document','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dtDocument()
	{
		echo $this->ms->dt();
	}

	public function add_document()
	{
		$d = [
			'title' => 'Add Document',
			'linkView' => 'page/serdev/add_document',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => 'Add Document',
				'data' => [
					['nama' => 'List Document','link' => site_url('Sharedev/list_document'),'active' => ''],
					['nama' => 'Add Document','link' => '','active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function work_order()
	{
		$d = [
			'title' => 'Work Order',
			'linkView' => 'page/serdev/work_order',
			'fileScript' => 'serdev/work_order.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function datek()
	{
		$d = [
			'title' => 'Detail Datek',
			'linkView' => 'page/serdev/datek',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function detail_datek()
	{
		$d = [
			'title' => 'Detail Datek',
			'linkView' => 'page/serdev/detail_datek',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function project_summary()
	{
		$d = [
			'title' => 'Detail Datek',
			'linkView' => 'page/serdev/project_summary',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function detail_project()
	{
		$d = [
			'title' => 'Detail Datek',
			'linkView' => 'page/serdev/detail_project',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}



	public function detail_project_new()
	{
		$d = [
			'title' => 'Detail Project',
			'linkView' => 'page/serdev/detail_project_new',
			'fileScript' => 'serdev/detail_project_new.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}

	// Work Order
	public function dt_wo()
	{
		echo $this->ms->dt_wo();
	}

	public function get_wo_activity()
	{
		$id = $this->input->get('id');
		$this->ms->see = "id,activity,remarks"; 
		$q = $this->ms->get_wo($id)->row();
		echo json_encode($q);
	}
	
	public function get_sdv_wo_dvc()
	{
		$id = $this->input->get('wo_id');
		$grp = $this->input->get('grp');
		$type_id = $this->input->get('type_id');

		$q = $this->ms->get_sdv_wo_dvc($id,$grp,$type_id)->result();
		echo json_encode($q);
	}
	
	public function get_device_for_install()
	{
		$id = $this->input->get('wo_id');

		$q = $this->ms->get_device_for_install($id)->result();
		echo json_encode($q);
	}

	public function in_sdv_wo_activity()
	{
		$obj = [];
		$s = false;
		$m = "Gagal mengubah activity";

		$id = $this->input->post('id');
		$activity = $this->input->post('activity');
		$remarks = $this->input->post('remarks');

		$in = $this->ms->in_sdv_wo_activity($activity,$remarks,$id);
		if($in) {
			$s = true;
			$m = "Berhasil mengubah activity";
		}	

		$data = [
			'status' => $s,
			'msg' => $m
		];

		echo json_encode($data);
	}

	// Detal Projek Work Order
	public function get_sdv_projek_detail()
	{
		$wo_id = $this->input->get('id');
	}

	public function get_device_by_wo()
	{
		$id = $this->input->get('wo_id');
		$q = $this->ms->get_device_by_wo($id)->result();
		echo json_encode($q);
	}

	public function in_installation_form()
	{
		$obj = [];
		$s = false;
		$m = "Gagal mengubah data form instalasi";
		$this->load->library('upload');

		$id = $this->input->post('id');
		$sdv_wo_id = $this->input->post('sdv_wo_id');
		$pic = $this->input->post('pic');
		$exec_id = $this->input->post('exec_id');
		$status = $this->input->post('status');
		$status_exec = $this->input->post('status_exec');
		$install_date = $this->input->post('install_date');
		$device_id = $this->input->post('device_id');
		
		$file_bai = '';
		$file_bast = '';
		$mu = [];
		$install_dvc = [];

	
			// cover_image is empty (and not an error)
			$config['upload_path']  	= './data/sdv/bai/';
			$config['allowed_types']    = 'xlsx|xls|word|pdf';
			$config['remove_spaces'] = TRUE;
			
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('bai')){
				$file_bai='';
				array_push($mu,$this->upload->display_errors());
			}else{
				$file_bai=$this->upload->data('file_name');
			}
		
			$config2['upload_path']   = './data/sdv/bast/';
			$config2['allowed_types'] = 'xlsx|xls|word|pdf';
			$config2['remove_spaces'] = TRUE;
			
			$this->upload->initialize($config2);
			
			if (!$this->upload->do_upload('bast')){
				$file_bast='';
				array_push($mu,$this->upload->display_errors());
			}else{
				$file_bast=$this->upload->data('file_name');
			}

			$config3['upload_path']   = './data/sdv/snmp/';
			$config3['allowed_types'] = 'xlsx|xls|word|pdf';
			$config3['remove_spaces'] = TRUE;
			
			$this->upload->initialize($config3);
			
			if (!$this->upload->do_upload('snmp')){
				$file_snmp='';
				array_push($mu,$this->upload->display_errors());
			}else{
				$file_snmp=$this->upload->data('file_name');
			}
		
		$obj = [
			'status_exec' => $status_exec ,
			'exec_id' => $exec_id ,
			'status' => $status,
			'install_date' => $install_date ,
		];

		if ($file_bai != '') $obj['file_bai'] = $file_bai;
		if ($file_bast != '') $obj['file_bast'] = $file_bast;
		if ($file_snmp != '') $obj['file_snmp'] = $file_snmp;

		$up = $this->ms->up_install($obj,$id);

		if($up) {
			$xi = $this->ms->inb_install_dvc($id,$device_id);
			if ($xi){
				$s = true;
				$m = "Berhasil mengubah data form instalasi";
				$this->upd_status_wo($sdv_wo_id);
			}
		}	

		$data = [
			'status' => $s,
			'msg' => $m,
			'msg_upload' => $mu
		];

		echo json_encode($data);
	}

	// Update Status Wo
	public function upd_status_wo($sdv_wo_id="")
	{
		$task_all = $this->db->get_where('sdv_install', ['sdv_wo_id' => $sdv_wo_id])->num_rows();
		$task_done = $this->db->get_where('sdv_install', ['sdv_wo_id' => $sdv_wo_id,'status' => '3'])->num_rows();
		$total = $task_done/$task_all*100;
		if ($total == 100) {
			$this->db->update('sdv_wo', ['status' => 3],['id' => $sdv_wo_id]);
		}else{
			$this->db->update('sdv_wo', ['status' => 1],['id' => $sdv_wo_id]);
		}
		return false;
	}

	// Install
	public function dt_install()
	{
		// Tampilkan lokasi yang ingin dipasangkan perangkatnya
		$id = $this->input->post('id_wo');
		echo $this->ms->dt_install($id);
	}

	public function get_install()
	{
		$id = $this->input->get('id');
		$this->ms->see = "si.id,location,pic,status_exec,exec_id,si.status,install_date,file_bai,file_bast"; 
		$q = $this->ms->get_install($id)->row();
		echo json_encode($q);
	}

	// Install device
	public function get_install_dvc_scm()
	{
		$id = $this->input->get('id'); //sdv_install_id
		$q = $this->ms->get_install_dvc_scm($id)->result();
		echo json_encode($q);
	}

	// Get Information about project work order Serdev
	public function get_info_project()
	{
		$this->load->model('MKaryawan','mk');
		$sales = '-';
		$pm = '-';
		$team_lead = '-';
		$id = $this->input->get('id');

		$this->ms->see = "sw.id,pk.start_date,pk.end_date,pk.qty,p.service,team_lead,no_po,pk.qty,customer,custend,sales_id,pm";
		$v = $this->ms->get_info_project($id)->row();
		if($v->team_lead != '' || $v->team_lead != '0') $team_lead = $this->mk->get($v->team_lead)->row()->nama; 
		
		$sales1 = $this->mk->get('',['id' => $v->sales_id]);
		$pm1 = $this->mk->get('',['id' => $v->pm]);

		if($sales1->num_rows() > 0) $sales = $sales1->row()->nama;
		if($pm1->num_rows() > 0) $pm = $pm1->row()->nama;

		$persen = 0;
		$this->ms->see = "*";
		$jml_install_done = $this->ms->get_install('',$id,'3')->num_rows();
        $jml_task = $this->ms->get_install('',$id)->num_rows();
        $persen = '0%';
        if ($jml_task > 0) {
            $persen = @((float)$jml_install_done/(int)$jml_task*100).'%';
        }

		$jml_install_device = $this->ms->get_install_dvc('',$id,'1')->num_rows();

		$data = [
			'service' => $v->service,
			'no_po' => $v->no_po,
			'qty' => (float)$v->qty,
			'cust' => $v->customer,
			'custend' => $v->custend,
			'no_po' => $v->no_po,
			'sales' => $sales,
			'pm' => $pm,
			'masa_kontrak' => $this->bantuan->tgl_indo($v->start_date).' - '.$this->bantuan->tgl_indo($v->end_date),
			'jml_task' => $jml_task,
			'jml_install_device' => $jml_install_device,
			'team_lead' => $team_lead,
			'persen_task' => $persen
		];

		echo json_encode($data);
		
	}

	// Upload Datek Serdev

	public function pilih_datek()
	{
		$ds = [];
		$head = [];
		$data = [];
		$file = '';
        $msg = '';
        
        $id = $this->input->post('id');
        $file_inp = $this->input->post('file');
		
		if ($file_inp != '') @unlink('./sample/upload/'.$file_inp);

        $this->load->library('upload');
        
        $config['upload_path']          = './sample/upload/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_datek')){
        //    var_dump($this->upload->display_errors());
        }else{
           $file = $this->upload->data()['file_name'];
		}

        if ($file != '') {

            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
           
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./sample/upload/'.$file); // Load file yang telah diupload ke folder excel
            $getSheet = $loadexcel->getSheetNames();
			$AZ = range('A', 'Z');

            foreach ($getSheet as $rows) {
                $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
                $data = [];
                $numrow = 0;
                foreach ($sheet as $row) {
                    	if ($numrow == 0) {
							foreach ($AZ as $v) {
								if (@$row[$v] != '') {
									array_push($head,[
										'key' => $v,
										'value' => $row[$v]
									]);
								}
							}
						}

                    //    array_push($ds,$d);
                    $numrow++; // Tambah 1 setiap kali looping
                }
			}
			
        }
        
        // $rsp['data'] = $ds;

        // if (count($ds) > 0) {

        //     $this->db->insert_batch('scm_devices', $ds);

        //     $rsp['status'] = true;
        //     $rsp['msg'] = "Berhasil import device";
        //     @unlink('./sample/upload/'.$file);
        // }else{
        //     $rsp['status'] = false;
        //     $rsp['msg'] = "Gagal import device";
		// }
		
		$data = [
			'data' => $head,
			'file' => $file
		];

        echo json_encode($data);
	}

	public function import_datek()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		
		$file = $this->input->post('file');
		$lokasi = $this->input->post('lokasi');
		$pic = $this->input->post('pic');
		$id_wo = $this->input->post('id_wo');

		$d = [
			'status' => false,
			'msg' => ' Gagal mengimport data teknis'
		];

		$di = [];
		
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('./sample/upload/'.$file); // Load file yang telah diupload ke folder excel
        $getSheet = $loadexcel->getSheetNames();
		
        foreach ($getSheet as $rows) {
            $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
            $data = [];
            $numrow = 1;
            foreach ($sheet as $row) {
                	if ($numrow > 1) {
						$cek = $this->db->get_where('sdv_install si', ['location' => $row[$lokasi], 'sdv_wo_id' => $id_wo]);
						if ($cek->num_rows() == 0) {
							$device_install = [
								'location' => $row[$lokasi],
								'pic' => $row[$pic],
								'status' => 0,
								'ctddate' => date('Y-m-d'),
								'ctdby' => $this->session->userdata('karyawan_id'),
								'sdv_wo_id' => $id_wo
							];
							array_push($di,$device_install);
						}
					}
                $numrow++; // Tambah 1 setiap kali looping
            }
		}
		if(@count($di) > 0 ){
			$q = $this->db->insert_batch('sdv_install', $di);
			$jml = $this->db->affected_rows();
			if ($jml > 0) {
				$d = [
					'status' => true,
					'msg' => 'Berhasil mengimport '.$jml.' data teknis'
				];
			}
		}

		unlink('./sample/upload/'.$file);

		echo json_encode($d);
	}

	public function dt_cek_dvc_projek()
	{
	  $this->load->model('MSCMDevice','msd');
	  $id_wo = $this->input->post('id_wo');
	  $pk_id = $this->ms->get_wo($id_wo)->row()->pk_id;
	  echo $this->msd->dt_cek_dvc_projek($pk_id);
	}

	// View Laporan/Report

	public function report()
	{
		$d = [
			'title' => 'Report',
			'linkView' => 'page/serdev/report',
			'fileScript' => 'serdev/report.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}
	
	// View Obstacle Project

	public function obstacle_project()
	{
		$d = [
			'title' => 'Obstacle Project',
			'linkView' => 'page/serdev/obstacle_project',
			'fileScript' => 'serdev/obstacle_project.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dt_wo_report()
	{
		echo $this->ms->dt_wo_report();
	}

	public function get_grafik_progress()
	{
		$label = [];
		$persentase = [];
		
		$jml_d_all = 0;
		$jml_d_done = 0;

		$qgrafik_all = $this->ms->get_grafik_progress();

		foreach ($qgrafik_all->result() as $k => $v) {

			$label[] = $v->service;
			$rsp['label'] = $label;

			$persen = $v->jml_done > 0 ? ((float) $v->jml_done / (float) $v->jml_all) * 100 : 0;
			$persentase[] = $persen;
			$rsp['persentase'] = $persentase;
		}

		echo json_encode($rsp);
	}

	public function get_grafik_status()
	{
		$label = [];
		$jml = [];
		$color = [];
		
		$jml_d_all = 0;
		$jml_d_done = 0;

		$qgrafik_all = $this->ms->get_grafik_status();
		
		foreach ($qgrafik_all->result() as $k => $v) {

			$label[] = $v->status_name;
			$rsp['label'] = $label;

			$jml[] = (float)$v->jml;
			$rsp['jml'] = $jml;
			
			$color[] = $v->color;
			$rsp['color'] = $color;
		}

		echo json_encode($rsp);
	}

	public function get_grafik_obstacle()
	{
		$label = [];
		$jml = [];
		
		$jml_d_all = 0;
		$jml_d_done = 0;

		$qgrafik_all = $this->ms->get_grafik_obstacle();
		
		foreach ($qgrafik_all->result() as $k => $v) {

			$label[] = $v->obstacle_name;
			$rsp['label'] = $label;

			$jml[] = (float)$v->jml;
			$rsp['jml'] = $jml;
		}

		echo json_encode($rsp);
	}

	public function get_projek_wo()
	{
		$id = $this->input->get('id');
		$this->ms->see = "id,priority,team_lead";
		$q = $this->ms->get_wo($id)->row();
		echo json_encode($q);
	}

	public function up_wo()
	{
		$obj = [];
		$s = false;
		$m = "Gagal edit projek";

		$id = $this->input->post('id');
		$tech_lead = $this->input->post('tech_lead');
		$priority = $this->input->post('priority');

		$in = $this->ms->up_wo([
			'priority' => $priority,
			'team_lead' => $tech_lead
		],$id);

		if($in) {
			$s = true;
			$m = "Berhasil mengubah Project";
		}	

		$data = [
			'status' => $s,
			'msg' => $m
		];

		echo json_encode($data);
	}
	
}
