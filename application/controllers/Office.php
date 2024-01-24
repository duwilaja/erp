
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MOffice','mc');
	}


	public function dt()
	{
		echo $this->mc->dt();
	}
	
    
    public function list_office()
	{
		$d = [
			'title' => 'List Office',
			'linkView' => 'page/office/list_office',
			'fileScript' => 'list_office.js',
			'bread' => [
				'nama' => 'List Office',
				'data' => [
					['nama' => 'List Office','link' => site_url('office/list_office'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function add_office()
	{
		$d = [
			'title' => 'List Office',
			'linkView' => 'page/office/add_office',
			'fileScript' => 'add_office.js',
			'bread' => [
				'nama' => 'Add Office',
				'data' => [
					['nama' => 'List Office','link' => site_url('office/list_office'),'active' => ''],
					['nama' => 'Add Office','link' => '','active' => 'active'],
				]
			],

		];
		$this->load->view('_main',$d);
	}

	public function inOffice()
	{
		$arr = [];

		$cost = [
			'customer' => $this->input->post('customer'),
			'ctdBy' => $this->session->userdata('karyawan_id'),
			'ctdDate' => date('Y-m-d H:i:s'),
			'last_update' => date('Y-m-d'),
		];
		
		$inCost = $this->mc->in($cost);
		if ($inCost[1] == 1) {
			$arr = [
				'msg' => 'Success add customer',
				'status' => 1
			];	
		}

		echo json_encode($arr);
	}


	public function upOffice()
	{
		$arr = [];

		$cost = [
			'customer' => $this->input->post('e_customer'),
			'ctdDate' => date('Y-m-d H:i:s'),
			'last_update' => date('Y-m-d'),
		];
		
		$inCost = $this->db->update('cust',$cost,['id' => $this->input->post('e_id')]);
		if ($inCost) {
			$arr = [
				'msg' => 'Success edit customer',
				'status' => 1
			];	
		}

		echo json_encode($arr);
	}
}
