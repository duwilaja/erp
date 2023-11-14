<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MCustomers','mc');
		$this->load->model('MProject','mp');
		$this->load->model('MPartner','mpart');
		$this->load->model('MAreas','ma');
	}
	
	public function dt($menu='')
	{
		echo ($this->mp->dt($menu));
	}

	public function get_projek_all()
	{
		$this->mp->see = "pk.id,ce.custend,p.service";
		$q = $this->mp->getProjek()->result();
		echo json_encode($q);
	}

	public function getProjek($id='')
	{
		$status = false;
		$qr = [];
		$data = [];

		$q = $this->mp->getProjek($id);
		if ($q->num_rows() > 0) {
			if ($id != '') {
				$qr = $q->row();
			}else{
				$qq = $q->result();
				foreach ($qq as $v) {
					array_push($qr,[
						'id' => $v->projek_id,
						'service' => $v->no_kontrak.' - '.$v->service.' - '.$v->custend
					]);
				}
			}
			$status = true;
		}

		$data = [
			'status' => $status,
			'data' => $qr
		];
		echo json_encode($data);
	}

	public function list_project()
	{
		$d = [
			'title' => 'Project List',
			'linkView' => 'page/projek/projek',
			'fileScript' => 'projek.js',
			'bread' => [
				'nama' => 'Project List',
				'data' => [
					['nama' => 'Project List','link' => site_url('main/projek'),'active' => 'active']
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function profitability_plan()
	{
		$d = [
			'title' => 'Profitability Plan',
			'linkView' => 'page/projek/tambah_projek',
			'fileScript' => 'tambah_projek.js',
			'bread' => [
				'nama' => 'Profitablitiy Plan',
				'data' => [
					['nama' => 'List Project','link' => site_url('main/projek'),'active' => ''],
					['nama' => 'Profitability Plan','link' => site_url('main/tambah_projek'),'active' => 'active'],
				]
			],
			'customers' => $this->mc->get()->result(),
			'partners' => $this->mpart->get()->result(),
			'areas' => $this->ma->get()->result(),
		];
		$this->load->view('_main',$d);
	}

	public function project_archive()
	{
		$d = [
			'title' => 'Project Archive',
			'linkView' => 'page/projek/project_archive',
			'fileScript' => 'project_archive.js',
			'bread' => [
				'nama' => 'Project Archive',
				'data' => [
					['nama' => 'List Project','link' => site_url('main/projek'),'active' => ''],
					['nama' => 'Project Archive','link' => site_url('main/project_archive'),'active' => 'active'],
				]
			],
			'customers' => $this->mc->get()->result(),
		];
		$this->load->view('_main',$d);
	}

	public function request_invoicing()
	{
		$d = [
			'title' => 'Request for Invoicing',
			'linkView' => 'page/projek/req_invoicing',
			'fileScript' => 'req_invoicing.js',
			'bread' => [
				'nama' => 'Request for invoicing',
				'data' => [
					['nama' => 'List Project','link' => site_url('main/projek'),'active' => ''],
					['nama' => 'Request For Invocing','link' => site_url('main/req_invoicing'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function inProfitability_plan()
	{
		$pricing = [];
		$software = [];
		$hardware = [];


		$dataProject = [
			"project_name" => $this->input->post("project_name"),
			"end_costumer" => $this->input->post("end_costumer"),
			"end_costumer_pic" => $this->input->post("end_costumer_pic"),
			"project_duration" => $this->input->post("project_duration"),
			"start_date" => $this->input->post("estimate_start_date"),
			"end_date" => $this->input->post("estimate_cdd"),
			"total_margin" => $this->input->post("i_total_margin"),
			"total_project" => $this->input->post("total_project"),
			"costumer_id" => $this->input->post("costumer"),
			"costumer_pic" => $this->input->post("costumer_pic"),
			"created_date" => date('Y-m-d H:i:s'),
			"created_by" => 1,
			"status_project" => $this->input->post("status_project"),
			"est_v_on" => $this->input->post("estimate_value_on"),
			"project_quality" => $this->input->post("project_quality"),
			"renewal_project" => $this->input->post("renewal_project"),
			"hard_ownerd" => $this->input->post("by_matrik"),
			"partner_id" => $this->input->post("by_partner"),
			"deliv_location_id" => $this->input->post("delivery_location"),
		];

		$inp = $this->mp->in($dataProject);
		
		if ($inp[1] == 1 ) {
			
			foreach ($this->input->post("amount_hardware") as $k => $v ) {
				$p = [
					"hardware_id" => $this->input->post("hardware")[$k],
					"amount_h" => $this->input->post("amount_hardware")[$k],
					"project_id" => $inp[1],
					"created_by" => 1,
					"created_date" => date('Y-m-d H:i:s'),
				];
				array_push($hardware,$p);
			}
	
			foreach ($this->input->post("amount_software") as $k => $v ) {
				$p = [
					"software_id" => $this->input->post("software")[$k],
					"amount_s" => $this->input->post("amount_software")[$k],
					"project_id" => $inp[1],
					"created_by" => 1,
					"created_date" => date('Y-m-d H:i:s'),
				];
				array_push($software,$p);
			}
	
			foreach ($this->input->post("amount_pricing") as $k => $v ) {
				$p = [
					"product" => $this->input->post("product")[$k],
					"amount" => $this->input->post("amount_pricing")[$k],
					"project_id" => $inp[1],
					"created_by" => 1,
					"created_date" => date('Y-m-d H:i:s'),
				];
				array_push($pricing,$p);
			}
	
			$this->db->insert_batch('pricing_hardware', $hardware);
			$this->db->insert_batch('pricing_software', $software);
			$this->db->insert_batch('pricing', $pricing);

			$this->session->set_flashdata('success', 'Success to add Project');

		}
				
		redirect('project/list_project');
	}
	// Projek Kontrak

	public function dt_cust_projek_kontrak()
	{
		echo $this->mp->dt_cust_projek_kontrak();
	}	

	public function get_projek($id='')
	{
		$this->mp->see = 'pk.id,service,ce.custend';
		echo json_encode($this->mp->getProjek('','',$id)->row());
	}

}
