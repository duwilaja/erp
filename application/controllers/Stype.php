
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stype extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MStype','mc');
	}


	public function dt()
	{
		echo $this->mc->dt();
	}
	
    
    public function list_stype()
	{
		$d = [
			'title' => 'List Staff Type',
			'linkView' => 'page/office/list_stype',
			'fileScript' => 'office/office.js',
			'bread' => [
				'nama' => 'List Staff Type',
				'data' => [
					['nama' => 'List Staff Type','link' => site_url('office/list_stype'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function sv()
	{
		$arr = [];

		$data=$this->input->post();
		$data['updatedAt'] = date('Y-m-d H:i:s');
		
		if($data['id']==0){
			$data['createdAt'] = date('Y-m-d H:i:s');
			$inCost = $this->mc->in($data);
		}else{
			$inCost = $this->mc->up($data,['id' => $this->input->post('id')]);			
		}
		if ($inCost[1] == 1) {
			$arr = [
				'msg' => 'Success',
				'status' => 1
			];	
		}else{
			$arr = [
				'msg' => 'Error',
				'status' => 0
			];
		}

		echo json_encode($arr);
	}
	
	public function get($id=0){
		$ret=$this->mc->get($id)->row();
		
		echo json_encode($ret);
	}
	
	public function del($id=0){
		$ret=$this->mc->del("id=$id");
		if ($ret[1] == 1) {
			$arr = [
				'msg' => 'Success',
				'status' => 1
			];	
		}else{
			$arr = [
				'msg' => 'Error',
				'status' => 0
			];
		}
		echo json_encode($arr);
	}
	
	public function map()
	{
		$data['lat'] = $this->input->get("lat");
		$data['lng'] = $this->input->get("lng");
		$data['latfld'] = $this->input->get("latfld");
		$data['lngfld'] = $this->input->get("lngfld");
		$this->load->view('map',$data);
	}
}
