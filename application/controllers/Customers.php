
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MCustomers','mc');
		$this->load->model('MSegment','msg');
	}

	public function cex()
	{
		$d = [
			'title' => 'Customer Existing',
			'linkView' => 'page/costumers/cex',
			'fileScript' => 'cust/cex.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'List Customer','link' => site_url('customers/list_costumer'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dt()
	{
		echo $this->mc->dt();
	}
	
	public function dtEnd()
	{
		echo $this->mc->dtEnd();
	}

	public function getCustomer($id='')
	{
		if ($id != '') {
			$q = $this->mc->get($id)->row();
		}else{
			$q = $this->mc->get()->result();
		}

		echo  json_encode($q);
	}

	public function getEndCustomer($id='')
	{
		if ($id != '') {
			$q = $this->db->get_where('cust_end',['id' => $id])->row();
		}else{
			$q = $this->db->get('cust_end')->result();
		}

		echo  json_encode($q);
	}
    
    public function list_customer()
	{
		$d = [
			'title' => 'List Customer',
			'linkView' => 'page/costumers/list_costumer',
			'fileScript' => 'list_costumer.js',
			'bread' => [
				'nama' => 'List Customer',
				'data' => [
					['nama' => 'List Customer','link' => site_url('customers/list_costumer'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function add_costumer()
	{
		$d = [
			'title' => 'List Costumer',
			'linkView' => 'page/costumers/add_costumer',
			'fileScript' => 'add_costumer.js',
			'bread' => [
				'nama' => 'Add Costumer',
				'data' => [
					['nama' => 'List Costumer','link' => site_url('customers/list_costumer'),'active' => ''],
					['nama' => 'Add Costumer','link' => '','active' => 'active'],
				]
			],
			'segment' => $this->msg->get()->result()

		];
		$this->load->view('_main',$d);
	}

	public function inCust()
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

	public function deCust($id='')
	{
		$de = $this->mc->deCust($id);
		if ($de) {
			$arr = [
				'msg' => 'Success remove customer',
				'status' => 1
			];
		}

		echo json_encode($arr);
	}

	public function upCust()
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

	// End Customer

	public function inEndCust()
	{
		$arr = [];

		$cost = [
			'custend' => $this->input->post('custend'),
			'ctdBy' => $this->session->userdata('karyawan_id'),
			'ctdDate' => date('Y-m-d H:i:s'),
			'last_update' => date('Y-m-d'),
		];
		
		$inCost = $this->db->insert('cust_end',$cost);
		if ($inCost) {
			$arr = [
				'msg' => 'Success add End Customer',
				'status' => 1
			];	
		}

		echo json_encode($arr);
	}

	public function deEndCust($id='')
	{
		$de = $this->db->delete('cust_end',['id' => $id]);
		if ($de) {
			$arr = [
				'msg' => 'Success remove End customer',
				'status' => 1
			];
		}

		echo json_encode($arr);
	}

	public function upEndCust()
	{
		$arr = [];

		$cost = [
			'custend' => $this->input->post('e_custend'),
			'ctdDate' => date('Y-m-d H:i:s'),
			'last_update' => date('Y-m-d'),
		];
		
		$inCost = $this->db->update('cust_end',$cost,['id' => $this->input->post('e_id')]);
		if ($inCost) {
			$arr = [
				'msg' => 'Success edit End customer',
				'status' => 1
			];	
		}

		echo json_encode($arr);
	}
	
}
