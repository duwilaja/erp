<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datek extends MY_controller {
    
    
    public function __construct()
    {
		parent::__construct();
		$this->load->model('MDatek','md');
		$this->load->helper('custom');
	}

	public function index()
	{
		$d = [
			'title' => 'Data Teknis Projek',
			'linkView' => 'page/datek/datek.php',
	        'fileScript' => 'datek/datek.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
	          ],
		];
		$this->load->view('_main',$d);
	}

	public function dtDatekProjek()
	{
		echo $this->md->dtDatekProjek();
	}

	public function detail_datek()
	{
		$pk_id= $this->input->get('pk');

		$dtk = [
			"pk_id" => $pk_id
		];
		
		$cek_dtk = $this->md->get_dtk('',['pk_id' => $pk_id]); 
		if ($cek_dtk->num_rows() == 0) {
			
			$this->md->in_dtk($dtk);
			$id_dtk = $this->db->insert_id();
			
		}else {
			$id_dtk = $cek_dtk->row()->id;
		}
		
		$d = [
			'title' => 'Detail Data Teknis Projek',
			'linkView' => 'page/datek/detail_datek.php',
	        'fileScript' => 'datek/detail_datek.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
	          ],
			  'projek' => $this->md->getProjekK($pk_id)->row(),
			  'datek_id' => $id_dtk
		];
		$this->load->view('_main',$d);
	}

    public function dtDatekList($pk_id='')
	{
		echo $this->md->dtDatekList($pk_id);
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

		$x = $this->md->in_dtk_list($data);


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
           $q = $this->md->getDtkList($id)->row();
        }else{
            $q = $this->md->getDtkList()->result();
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
		$up = $this->md->up_dtk_list($obj,['id' => $id]);
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


