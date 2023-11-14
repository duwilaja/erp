<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MTraining','t');
		$this->load->model('MKaryawan','mk');
		$this->load->helper(array('form', 'url'));
	}

	public function dt()
    {
        echo ($this->t->dt());
    }
    
	public function list_training()
	{
		$d = [
			'title' => 'Training',
			'linkView' => 'page/training/list_training',
			// 'linkView' => 'fixing',
			'fileScript' => 'training.js',
			'bread' => [
				'nama' => 'List Training',
				'data' => [
					['nama' => 'List Training','link' => site_url('Training/list_training'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function add_training()
	{
		$d = [
			'title' => 'Training',
			'linkView' => 'page/training/add_training',
			'fileScript' => 'training.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Training/add_training'),'active' => 'active'],
				]
			],
			'val' => [
				'karyawan' => $this->mk->get()->result()
			]
		];
		$this->load->view('_main',$d);
	}

	public function detail_training($id='')
	{
		if($id != ''){
			$d = [
				'title' => 'Training',
				'linkView' => 'page/training/detail_training',
				'fileScript' => 'training.js',
				'bread' => [
					'nama' => '',
					'data' => [
						['nama' => '','link' => site_url('Training/detail_training'),'active' => 'active'],
					]
				],
				'dt' => $this->t->getTrainingId($id)->row(),
				'stat' => $this->t->setStatus($this->t->getTrainingId($id)->row()->status), 
			];
			$this->load->view('_main',$d);
		}else{
			redirect('training/list_training');
		}
		
	}
	public function uploadCv(){
		
		$config['upload_path']          ='./data/sertifikat';
		$config['allowed_types']        = '|jpg|png|pdf|doc';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('sertifikat'))
		{
				echo $this->upload->display_errors();
		}
		else
		{
				$b = $this->upload->data()['file_name'];
				
				$id = $this->input->post('id');
				$this->db->update('pelatihan', ['sertifikasi' => $b], ['id' => $id]);

				$this->session->set_flashdata('success', 'Success upload data');
      			redirect($_SERVER['HTTP_REFERER']);
				
		}
	}
	public function inTraining()
	{
		foreach ($this->input->post('karyawan') as $v) {
			$data = [ 
				"pelatihan" => $this->input->post("pelatihan"),
				"karyawan_id" => $v,
				"tgl_mulai" => $this->input->post("tgl_mulai"),
				"tgl_akhir" => $this->input->post("tgl_akhir"),
				"status" => 1,
				"created_date" => date('Y-m-d H:i:s'),
				"craetad_by" => $this->session->userdata('karyawan_id'),
				"alamat" => $this->input->post("tempat"),
				"budget" => $this->input->post("budget"),
				"keterangan" => $this->input->post("keterangan"),
			];

			$this->db->insert('pelatihan',$data);
		}
		
		$this->session->set_flashdata('success', 'Success to add data training');
		redirect($_SERVER['HTTP_REFERER']);
	
	}

	public function getTrainingId($id='')
	{
		$data = '';
		if ($id != '') {
			$data = $this->t->get($id)->row();
		}

		echo json_encode($data);
	}

	public function upStatusTraining()
	{
		$data = [];

		$id = $this->input->post('idp');
		$this->db->update('pelatihan', ['status' => $this->input->post('status')],['id' => $id]);
		$ok = $this->db->affected_rows();
		
		if ($ok > 0) {
			$data = [
				'msg' => 'Success to change status',
				'status' => 1
			];
		}

		echo json_encode($data);
	}

}
