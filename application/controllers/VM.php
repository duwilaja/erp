<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class VM extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MVm','vm');
		$this->load->helper('custom');
	}
	
	// Category Partner

	public function getCategory()
	{
		$jsn = ctojson($this->vm->getCategory()->result(),1,'Sukses menampilkan data');
		echo $jsn;
	}

	// Partner List

	public function partner_list()
	{
		$d = [
			'title' => 'Partner List',
			'linkView' => 'page/vm/partner_list',
			'fileScript' => 'vm/partner_list.js',
			'bread' => [
				'nama' => 'Partner List',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
			'category' => $this->vm->getCategory()->result() 
		];
		$this->load->view('_main',$d);
	}
	public function report_partner()
    {

        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=report-".date('YmdHis').".xls");

        
        $kategori = $this->input->get('search');
        $nama = $this->input->get('search');
        $area = $this->input->get('search');
        $lokasi = $this->input->get('search');
        $kontak = $this->input->get('search');
        
        $html = '<style>table tr td {border:solid 1px;text-transform: uppercase;font-size:14px;width:100%;text-align:center;}</style>';

        $html .= '<table style="width:100%;border:solid 1px #DDD;">';
        $html .= '<tr><td colspan="6" style="text-align:center;background:#ffeb3b;">PARTNER REPORT</td></tr>';
        $html .= '<tr>';
            $html .= '<td>No</td>';
            $html .= '<td>Kategori</td>';
            $html .= '<td>Nama</td>';
            $html .= '<td>Area</td>';
            $html .= '<td>Lokasi</td>';
            $html .= '<td>Kontak</td>';
        $html .= '</tr>';
       
        $q = $this->vm->getReportPartner($kategori,$nama,$area,$lokasi,$kontak);
        $no = 1; 
        // foreach ($q->result() as $v) {
	    foreach ($q as $v) {
            $html .= '<tr>';
                $html .= '<td>'.$no++.'</td>';
                $html .= '<td>'.$v->kategori.'</td>';
				$html .= '<td>'.$v->name.'</td>';
				$html .= '<td>'.$v->area.'</td>';
				$html .= '<td>'.$v->location.'</td>';
				$html .= '<td>'.$v->phone.'</td>';
                // $html .= '<td></td>';
            $html .= '</tr>';
          }

        $html .= '</table>';

        echo $html;
    }
	
	public function dtPartner()
	{
		echo $this->vm->dtPartner();
	}

	public function inPartner()
	{
		$var = [
			"name" => $this->input->post("name"),
			"kategori" => $this->input->post("kategori"),
			"aktif" => 1,
			"phone" => $this->input->post("phone"),
			"address" => $this->input->post("address"),
			// "cp_id" => $this->input->post("cp_id"),
			"area" => $this->input->post("area"),
			"location" => $this->input->post("location"),
			"remaks" => $this->input->post("remaks"),
			// "prov_id" => $this->input->post("prov_id"),
			// "kota_id" => $this->input->post("kota_id"),
			"status" => $this->input->post("status"),
			"created_date" => date('Y-m-d'),
			"created_by" => $this->session->userdata('karyawan_id'),
			"jobs_id" => $this->input->post("jobs_id")
		];

		$q = $this->db->insert('vnd_partner',$var);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal menambahkan data baru');
		}

		echo $jsn;
	}

	public function upPartner()
	{
		$var = [
			"name" => $this->input->post("e_name"),
			"kategori" => $this->input->post("e_kategori"),
			"aktif" => $this->input->post("e_aktif"),
			// "cp_id" => $this->input->post("e_cp_id"),
			"phone" => $this->input->post("e_phone"),
			"address" => $this->input->post("e_address"),
			// "prov_id" => $this->input->post("e_prov_id"),
			// "kota_id" `=> $this->input->post("e_kota_id"),
			"area" => $this->input->post("e_area"),
			"location" => $this->input->post("e_location"),
			"status" => $this->input->post("e_status"),
			"remaks" => $this->input->post("e_remaks"),
			"created_date" => date('Y-m-d'),
			"created_by" => $this->session->userdata('karyawan_id'),
			"jobs_id" => $this->input->post("jobs_id")
		];

		$q = $this->db->update('vnd_partner',$var,['id' => $this->input->post('e_id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data baru');
		}

		echo $jsn;
	}

	public function dePartner()
	{
		$id = $this->input->post('id');
		$g = $this->db->delete('vnd_partner',['id' => $id]);
		
		echo ctojson('',1,'Sukses menghapus data');
	}

	public function get_partner()
	{
		$id = $this->input->get('id');

		if ($id != '') {
			$g = $this->db->get_where('vnd_partner',['id' => $id])->row();
		}else{
			$g = $this->db->get('vnd_partner')->result();
		}
		echo json_encode($g);
	}
    
    public function work_order()
	{
		$d = [
			'title' => 'Work Order',
			'linkView' => 'page/vm/work_order',
			'fileScript' => 'vm/work_order.js',
			'bread' => [
				'nama' => 'Work Order',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function detail_wo()
	{
		$d = [
			'title' => 'Detail Work Order',
			'linkView' => 'page/vm/detail_wo',
			'fileScript' => 'vm/detail_wo.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}
	
	public function wo_scope()
	{
		$d = [
			'title' => 'Work Order',
			'linkView' => 'page/vm/wo_scope',
			'fileScript' => 'work_order.js',
			'bread' => [
				'nama' => 'Work Order',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}
	
	public function wo_datek()
	{
		$d = [
			'title' => 'Work Order',
			'linkView' => 'page/vm/wo_datek',
			'fileScript' => 'work_order.js',
			'bread' => [
				'nama' => 'Work Order',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}
	
	public function get_partner_wo()
	{
		echo json_encode($this->vm->get_partner_wo(1)->result());
	}
	
    public function partner_req()
	{
		$d = [
			'title' => 'Partner Request',
			'linkView' => 'page/vm/partner_req',
			'fileScript' => 'partner_req.js',
			'bread' => [
				'nama' => 'Partner Request',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }
    
    public function invoice()
	{
		$d = [
			'title' => 'Invoice',
			'linkView' => 'page/vm/invoice',
			'fileScript' => 'invoice.js',
			'bread' => [
				'nama' => 'Invoice',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function history_invoice()
	{
		$d = [
			'title' => 'History Invoice',
			'linkView' => 'page/vm/history_invoice',
			'fileScript' => 'invoice.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function jobs()
	{
		$d = [
			'title' => 'Jobs',
			'linkView' => 'page/vm/jobs',
			'fileScript' => 'vm/jobs.js',
			'bread' => [
				'nama' => 'Jobs Board',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				],
			],
		];
		$this->load->view('_main',$d);
	}

	public function dt_wo()
	{
		echo $this->vm->dt_wo();
	}

	// Get Information about project work order Serdev
	public function get_info_project()
	{
		$this->load->model('MSerdev','ms');
		
		$sales = '-';
		$pm = '-';
		$id = $this->input->get('id');

		$this->ms->see = "p.service,customer,custend,start_date,end_date";
		$v = $this->ms->get_info_project($id)->row();

		$jml_partner = $this->vm->get_partner_wo($id)->num_rows();
		$jml_partner_op = $this->vm->get_partner_wo($id,'0')->num_rows();
		$jml_partner_d = $this->vm->get_partner_wo($id,'1')->num_rows();

		$data = [
			'service' => $v->service,
			'cust' => $v->customer,
			'custend' => $v->custend,
			'jml_partner' => $jml_partner == '0' ? 0 : $jml_partner,
			'jml_partner_op' => $jml_partner_op == '0' ? 0 : $jml_partner_op ,
			'jml_partner_d' => $jml_partner_d == '0' ? 0 : $jml_partner_d,
			'start_date' =>$v->start_date,
			'end_date' =>$v->end_date,
		];

		echo json_encode($data);
		
	}

	public function dt_detail_wo()
	{
		$id = $this->input->post('id');
		echo $this->vm->dt_detail_wo($id);
	}

	// Import partner list
	public function import_partner()
	{
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		
		$d = [
			'status' => false,
			'msg' => ' Gagal mengimport partner'
		];

		$di = [];
		
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('./sample/upload/partner.xlsx'); // Load file yang telah diupload ke folder excel
        $getSheet = $loadexcel->getSheetNames();
		
        foreach ($getSheet as $rows) {
            $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
            $data = [];
            $numrow = 1;
            foreach ($sheet as $row) {
                	if ($numrow > 1 && $row['G'] != '') {
							$partner_arr = [
								'kategori' => @$row['C'],
								'area' => @$row['D'],
								'location' => @$row['E'],
								'pekerjaan' => @$row['F'],
								'name' => @$row['G'],
								'phone' => @$row['H'],
								'created_date' => date('Y-m-d'),
								'created_by' => $this->session->userdata('karyawan_id'),
							];
							array_push($di,$partner_arr);
					}
				$numrow++; // Tambah 1 setiap kali looping
				if ($numrow >= 89) {
					break;
				}
            }
		}
		
		if(@count($di) > 0 ){
			$q = $this->db->insert_batch('vnd_partner', $di);
			$jml = $this->db->affected_rows();
			if ($jml > 0) {
				$d = [
					'status' => true,
					'msg' => 'Berhasil mengimport '.$jml.' partner'
				];
			}
		}

		echo json_encode($di);
	}

	public function getJobs($id='')
    {
        $data = '';
        if ($id != '') {
           $q = $this->vm->getJobs($id)->row();
        }else{
            $q = $this->vm->getJobs()->result();
        }

        $data = [
			'jobs' => $q,
        ];

        echo json_encode($data);
	}

	public function partner_job()
	{
		$d = [
			'title' => 'Partner Job',
			'linkView' => 'page/vm/partner_job',
			'fileScript' => 'vm/partner_job.js',
			'bread' => [
				'nama' => 'Partner Job',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }

	public function dtPartnerJob()
	{
		echo $this->vm->dtPartnerJob();
	}

	public function inPartnerJob()
	{
		$data = [
			"jobs" => $this->input->post("jobs"),
			"ctdDate" => date('Y-m-d'),
			"ctdTime" => date('H:i:s'),
			"ctdBy" => $this->session->userdata('karyawan_id'),
			"status" => 1,
		];

		$q = $this->db->insert('partner_job',$data);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($data,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($data,0,'Gagal menambahkan data baru');
		}

		echo $jsn;
	}

	public function get_partnerJob()
	{
		$id = $this->input->get('id');

		if ($id != '') {
			$g = $this->db->get_where('partner_job',['id' => $id])->row();
		}else{
			$g = $this->db->get('partner_job')->result();
		}
		echo json_encode($g);
	}

	public function upPartnerJob()
	{
		$var = [
			"jobs" => $this->input->post("jobs"),
			"ctdBy" => $this->session->userdata('karyawan_id')
		];

		$q = $this->db->update('partner_job',$var,['id' => $this->input->post('id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data');
		}

		echo $jsn;
	}

	public function setNPartnerJob()
	{
		$var = [
			"status" => 0,
			"ctdBy" => $this->session->userdata('karyawan_id')
		];

		$q = $this->db->update('partner_job',$var,['id' => $this->input->post('id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses menghapus data');
		}else{
			$jsn = ctojson($var,0,'Gagal menghapus data');
		}

		echo $jsn;
	}

	public function export_data_partner()
    {

        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=report_partner.xls");
        
        $html = '<style>table tr td {border:solid 1px;text-transform: uppercase;font-size:14px;width:100%;text-align:center;}</style>';

        $html .= '<table style="width:100%;border:solid 1px #DDD;">';
        $html .= '<tr><td colspan="5" style="text-align:center;background:#ffeb3b;">PARTNER REPORT</td></tr>';
        $html .= '<tr>';
            $html .= '<td>No</td>';
            $html .= '<td>Location</td>';
            $html .= '<td>PIC</td>';
            $html .= '<td>Partner</td>';
            $html .= '<td>Status</td>';
        $html .= '</tr>';
       
        $q = $this->vm->get_sdv_install()->result();
        $no = 1; 
        // foreach ($q->result() as $v) {
	    foreach ($q as $v) {
            $html .= '<tr>';
                $html .= '<td>'.$no++.'</td>';
                $html .= '<td>'.$v->location.'</td>';
				$html .= '<td>'.$v->pic.'</td>';
				$html .= '<td>'.$v->name.'</td>';
				$html .= '<td>'.$this->vm->set_status_install2($v->status).'</td>';
                // $html .= '<td></td>';
            $html .= '</tr>';
          }

        $html .= '</table>';

        echo $html;
    }

	public function get_vnd_prt_job()
	{
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$search = $this->input->post('search');
		$location = $this->input->post('location');
		$id = $this->input->get('id');
		$x = $this->vm->get_vnd_prt_job($search,$location,$limit,$start,$id)->result_array();
		echo json_encode($x);
	}

	public function getProvinsi()
	{
		$g = $this->db->get('provinsi')->result();
		echo json_encode($g);
	}

	public function getKota()
	{
		$id_p = $this->input->get('id_p');
		if ($id_p != '') {
			$g = $this->db->get_where('kota',['province_id' => $id_p])->result();
		}else{
			$g = $this->db->get('kota')->result();
		}
		echo json_encode($g);
	}

	public function inVndJob()
	{
		$data = [
			"job_name" => $this->input->post("job_name"),
			"price" => str_replace('.', '', $this->input->post("price")),
			"addreas" => $this->input->post("addreas"),
			"description" => $this->input->post("description"),
			"provinsi_id" => $this->input->post("provinsi"),
			"kota_id" => $this->input->post("kota"),
			"ctdDate" => date('Y-m-d H:i:s'),
			"ctdBy" => $this->session->userdata('karyawan_id'),
			"status" => 1,
		];

		$q = $this->db->insert('vnd_partner_jobs',$data);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($data,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($data,0,'Gagal menambahkan data baru');
		}

		echo $jsn;
	}

	public function delVndJob()
	{
		$var = [
			"status" => 0,
		];

		$q = $this->db->update('vnd_partner_jobs',$var,['id' => $this->input->post('id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data');
		}

		echo $jsn;
	}

	public function upVndJob()
	{
		$var = [
			"job_name" => $this->input->post("job_name"),
			"price" => str_replace('.', '', $this->input->post("price")),
			"addreas" => $this->input->post("addreas"),
			"description" => $this->input->post("description"),
			"provinsi_id" => $this->input->post("provinsi"),
			"kota_id" => $this->input->post("kota"),
			"ctdBy" => $this->session->userdata('karyawan_id'),
			"status" => 1,
		];

		$q = $this->db->update('vnd_partner_jobs',$var,['id' => $this->input->post('id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data');
		}

		echo $jsn;
	}
}
