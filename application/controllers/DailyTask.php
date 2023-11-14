<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyTask extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MDaily','dt');
		$this->load->model('MKaryawan','mk');
		$this->load->helper('custom');
		
	}

    public function all(){
        echo $this->dt->getAll();
	}

	public function getDaily($id='')
	{
		echo ctojson($this->dt->getDaily($id),1,'Berhasil menampilkan data');
	}
	
	public function dtListTask()
	{
		$karyawan = $this->input->post('karyawan');
		$tanggal = $this->input->post('tanggal');
		echo $this->dt->dtDt($karyawan,$tanggal);
	}

    public function list_task()
	{
		$this->load->model('MKaryawan','mk');
		$this->mk->see = "k.id, nama";
		$d = [
			'title' => 'Daily Task',
			'linkView' => 'page/oprations/daily_task',
            'fileScript' => 'dTask.js',
			'dtRahasia' => 'dtTicket',
			'kary' => $this->mk->getKarJab()->result(),
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            
		];
		$this->load->view('_main',$d);
	}
	
	public function inDailyTask()
	{
		$task = $this->input->post('task');

		$obj = [
			'pekerjaan' => $task,
			'karyawan_id' => $this->session->userdata('karyawan_id'),
			'tanggal' => $this->input->post('tgl'),
			'created_date' => date('Y-m-d'),
			'craeted_by' => $this->session->userdata('karyawan_id'),
			'status' => 1 
		];

		$q = $this->dt->inDailyTask($obj);
		$d = [
			'msg' => 'Success add task',
			'status' => 1
		];
		echo json_encode($d);
	}

	public function upDaily()
	{
		$obj = [
			'pekerjaan' => $this->input->post('e_task'),
			'tanggal' => $this->input->post('e_tgl'),
		];

		$x = $this->dt->upDaily($obj,$this->input->post('e_id'));
		if ($x) {
			echo ctojson($obj,1,'Berhasil mengedit data');
		}else{
			echo ctojson($obj,0,'Gagal mengedit data');
		}
	}

}
