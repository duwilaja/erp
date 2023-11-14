<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SCM extends MY_controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model('MKaryawan','mk');
        $this->load->model('MProject','mprj');
        $this->load->model('MSelma','ms');
		$this->load->model('MSCMVendor','mv');
		$this->load->model('MSCMQuotation','mq');
		$this->load->model('MSCMPurchase','mp');
		$this->load->model('MSCMDevice','md');
		$this->load->model('MSCMRequest','mr');
		$this->load->model('MSCMInventory','mi');
		
		
		// model pengajuan pinjaman mobil created by: teguh 21-10-2020
		$this->load->model('MSCMMobil','mb');
	}

	public function index()
	{
		// $this->mp->see = 'spi.id,spi.merek_id,spi.type_id';
		// $d = $this->mp->get_po_item(2)->row();
		// echo json_encode($d);
	}

	public function info()
	{
		$i = substr($_SERVER['PATH_INFO'],1);

		$this->db->join('menu m', 'm.id = ml.menu_id', 'inner');
		$this->db->like('level', ','.$this->session->userdata('level').',');
		$this->db->where('link', $i);
		$q = $this->db->get('menu_link ml');
		
		if ($q->num_rows() > 0) {
			echo "test";
		}else{
			echo "tidak bisa diakses";
		}
	}

	//vendor
    public function dt_vendor() //datatable
    {
        echo ($this->mv->dt());
	}
	
	public function get_vendor()
	{
		echo json_encode($this->mv->get()->result());
	}

	public function list_vendor()
	{
		$d = [
			'title' => 'List Vendor',
			'linkView' => 'page/scm/vendors',
			'fileScript' => 'scm_vendor.js',
			'bread' => [
				'nama' => 'List Vendor',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	public function form_vendor($id=0)
	{
		$action='add_vendor';
		$data = [
			'id' => '0',
            'kode' => '',
            'nama' => '',
            'attn' => '',
            'alamat' => ''
		];
		if($id>0){
			$dx = $this->mv->get($id);
			$data = $dx->row_array();
			$action = 'upd_vendor';
		}

		$d = [
			'title' => 'Add Vendor',
			'linkView' => 'page/scm/form_vendor',
			'fileScript' => 'scm_vendor.js',
			'titleForm' => "Form Vendor",
			'bread' => [
				'nama' => 'Add Vendor',
				'data' => [
					['nama' => 'List Vendor','link' => site_url('SCM/list_vendor'),'active' => ''],
					['nama' => 'Add Vendor','link' => site_url('SCM/form_vendor'),'active' => 'active'],
				]
			],
			'val' => $data,
			'action' => $action
		];
		$this->load->view('_main',$d);
    }
	// Action
    public function add_vendor(){
		$obj = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'attn' => $this->input->post('attn')
            ];
		
		$in = $this->mv->in($obj);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menambahkan vendor');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menambahkan vendor');
		}
		redirect('SCM/list_vendor');
	}
	public function upd_vendor(){
		$obj = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'attn' => $this->input->post('attn')
            ];
		$in = $this->mv->up($obj,['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil mengubah vendor');
		}else{
			$this->session->set_flashdata('failed', 'Gagal mengubah vendor');
		}
		redirect('SCM/list_vendor');
	}
	public function del_vendor(){
		$in = $this->mv->del(['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menghapus vendor');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menghapus vendor');
		}
		redirect('SCM/list_vendor');
	}
	//quotation
    public function dt_quotation($rpt=0) //datatable
    {
        echo ($this->mq->dt($rpt));
    }
	public function list_quotation()
	{
		$d = [
			'title' => 'List Quotation',
			'linkView' => 'page/scm/quotations',
			'fileScript' => 'scm_quotation.js',
			'bread' => [
				'nama' => 'List Quotation',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	public function form_quotation($id=0)
	{
		$ven = $this->mv->get()->result_array();
		$prj = $this->mprj->get()->result_array();
		$this->mprj->see = "pk.id,p.service";
		
		$action='add_quotation';
		$data = [
			'id' => '0',
            'quotnum' => '',
            'ket' => '',
            'project_id' => '',
            'dt' => '',
            'vendor_id' => '',
			'attc' => ''
		];
		if($id>0){
			$dx = $this->mq->get($id);
			$data = $dx->row_array();
			$action = 'upd_quotation';
		}

		$d = [
			'title' => 'Add Quotation',
			'linkView' => 'page/scm/form_quotation',
			'fileScript' => 'scm_quotation.js',
			'titleForm' => "Form Quotation",
			'bread' => [
				'nama' => 'Add Quotation',
				'data' => [
					['nama' => 'List Quotation','link' => site_url('SCM/list_quotation'),'active' => ''],
					['nama' => 'Add Quotation','link' => site_url('SCM/form_quotation'),'active' => 'active'],
				]
			],
			'val' => $data,
			'ven' => $ven,
			'prj' => $prj,
			'projek' => $this->mprj->getProjek()->result(),
			'action' => $action
		];
		$this->load->view('_main',$d);
    }
	// Action
    public function add_quotation(){
		$config['upload_path']  = './data/scm/quotations/';
		$config['allowed_types']        = 'pdf';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('userfile')){
			$attc='';
		}else{
			$attc=$this->upload->data('file_name');
		}
		$obj = [
                'quotnum' => $this->input->post('quotnum'),
                'ket' => $this->input->post('ket'),
                'dt' => $this->input->post('dt'),
                'project_id' => $this->input->post('project_id'),
                'vendor_id' => $this->input->post('vendor_id'),
				'attc' => $attc
            ];
		
		$in = $this->mq->in($obj);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menambahkan quotation');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menambahkan quotation');
		}
		redirect('SCM/list_quotation');
	}
	public function upd_quotation(){
		$config['upload_path']  = './data/scm/quotations/';
		$config['allowed_types']        = 'pdf';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('fattc')){
			$attc=$this->input->post('attc');
		}else{
			$attc=$this->upload->data('file_name');
		}
		$obj = [
                'quotnum' => $this->input->post('quotnum'),
                'ket' => $this->input->post('ket'),
                'dt' => $this->input->post('dt'),
                'project_id' => $this->input->post('project_id'),
                'vendor_id' => $this->input->post('vendor_id'),
				'attc' => $attc
            ];
		$in = $this->mq->up($obj,['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil mengubah quotation');
		}else{
			$this->session->set_flashdata('failed', 'Gagal mengubah quotation');
		}
		redirect('SCM/list_quotation');
	}
	public function del_quotation(){
		$in = $this->mq->del(['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menghapus quotation');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menghapus quotation');
		}
		redirect('SCM/list_quotation');
	}
	
	
	
	//purchase
	public function dt_purchase() //datatable
    {
        echo ($this->mp->dt());
    }
    public function dt_purchase_rpt() //datatable
    {
        echo ($this->mp->dt_rpt());
    }
    public function list_purchase()
	{
		$d = [
			'title' => 'List PO',
			'linkView' => 'page/scm/purchases',
			'fileScript' => 'scm_purchase.js',
			'bread' => [
				'nama' => 'List PO',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}	
	public function form_purchase($id=0)
	{
		$ven = $this->mv->get()->result_array();
		$prj = $this->mprj->get()->result_array();
		
		$this->mprj->see = "pk.id,p.service";

		$action='add_purchase';
		$data = [
			'id' => '0',
            'purchaseno' => '',
            'ket' => '',
            'project_id' => '',
            'dt' => '',
            'vendor_id' => '',
			'vname' => '',
			'subtot' => '',
			'tax' => '',
			'disc' => '',
			'tot' => '',
			'attc' => ''
		];
		if($id>0){
			$dx = $this->mp->get($id);
			$data = $dx->row_array();
			$action = 'upd_purchase';
		}

		$d = [
			'title' => 'Add PO',
			'linkView' => 'page/scm/form_purchase',
			'fileScript' => 'scm_purchase.js',
			'titleForm' => "Form PO",
			'bread' => [
				'nama' => 'Add PO',
				'data' => [
					['nama' => 'List PO','link' => site_url('SCM/list_purchase'),'active' => ''],
					['nama' => 'Add PO','link' => site_url('SCM/form_purchase'),'active' => 'active'],
				]
			],
			'val' => $data,
			'ven' => $ven,
			'prj' => $prj,
			'projek' => $this->mprj->getProjek()->result(),
			'action' => $action
		];
		$this->load->view('_main',$d);
	}
	
    //action
	public function add_purchase(){
		$config['upload_path']  = './data/scm/purchases/';
		$config['allowed_types']        = 'pdf';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('fattc')){
			$attc='';
		}else{
			$attc=$this->upload->data('file_name');
		}
		$obj = [
                'purchaseno' => $this->input->post('purchaseno'),
                'ket' => $this->input->post('ket'),
                'dt' => $this->input->post('dt'),
                'project_id' => $this->input->post('project_id'),
                'vendor_id' => $this->input->post('vendor_id'),
				'vname' => $this->input->post('vname'),
				'subtot' => $this->input->post('subtot'),
				'tax' => $this->input->post('tax'),
				'disc' => $this->input->post('disc'),
				'tot' => $this->input->post('tot'),
				'attc' => $attc
            ];
		
		$in = $this->mp->in($obj);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menambahkan quotation');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menambahkan quotation');
		}
		redirect('SCM/list_purchase');
	}

	public function upd_purchase(){
		$config['upload_path']  = './data/scm/purchases/';
		$config['allowed_types']        = 'pdf';
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('fattc')){
			$attc=$this->input->post('attc');
			//echo $this->upload->display_errors();
		}else{
			$attc=$this->upload->data('file_name');
		}
		$obj = [
                'purchaseno' => $this->input->post('purchaseno'),
                'ket' => $this->input->post('ket'),
                'dt' => $this->input->post('dt'),
                'project_id' => $this->input->post('project_id'),
                'vendor_id' => $this->input->post('vendor_id'),
				'vname' => $this->input->post('vname'),
				'subtot' => $this->input->post('subtot'),
				'tax' => $this->input->post('tax'),
				'disc' => $this->input->post('disc'),
				'tot' => $this->input->post('tot'),
				'attc' => $attc
            ];
		$in = $this->mp->up($obj,['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil mengubah quotation');
		}else{
			$this->session->set_flashdata('failed', 'Gagal mengubah quotation');
		}
		redirect('SCM/list_purchase');
	}
	public function del_purchase(){
		$in = $this->mp->del(['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menghapus quotation');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menghapus quotation');
		}
		redirect('SCM/list_purchase');
	}
	public function get_purchase_item($id=0){
		$dx = $this->mp->get_item($id)->result_array();
		echo json_encode($dx);
	}
	public function save_purchase_item(){
		$ti = $this->input->post('totitem');
		$id = $this->input->post('poid');
		$dd = $this->mp->del_item(['id' => $id]);
		$s=true;
		for($i=1;$i<=$ti;$i++){
			if($this->input->post('nr_'.$i)!=''){
				$obj = [
					'id' => $id,
					'nr' => $this->input->post('nr_'.$i),
					'partnr' => $this->input->post('partnr_'.$i),
					'dscr' => $this->input->post('dscr_'.$i),
					'qty' => $this->input->post('qty_'.$i),
					'unit' => $this->input->post('unit_'.$i),
					'price' => $this->input->post('price_'.$i),
					'curr' => $this->input->post('curr_'.$i),
					'status' => $this->input->post('status_'.$i)
				];
				$in = $this->mp->in_item($obj);
				if($in[1]==1 && $s){
					$s=true;
				}else{
					$s=false;
				}
			}
		}
		echo $s?"Berhasil":"Gagal";
	}

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'pdf',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }
	
	public function in_po()
	{
		$arr = [];
		$r = 0;
		$file = $this->upload_files('./data/scm/po/','po'.date('Ymdhis'),$_FILES['file_po']);
		
		if ($file) {
		
			foreach ($file as $k => $v) {
				$obj = [
					'purchaseno' => $this->input->post('no_po')[$k],
					'project_id' => $this->input->post('project_id'),
					'vendor_id' => $this->input->post('vendor')[$k],
					'date_receive' => $this->input->post('date_received')[$k],
					'dt' => $this->input->post('date')[$k],
					'ctddate' => date('Y-m-d'),
					'purchase_date' => date('Y-m-d'),
					'desc' => '-',
					'ctdby' => $this->session->userdata('karyawan_id'),
					'file' => $v
				];
				array_push($arr,$obj);
			}
			
			$this->db->insert_batch('scm_purchases', $arr);
			$r = $this->db->affected_rows();
		
		}
		 

		$rsp = [
			'status' => $r > 0 ? true : false,
			'msg' => $r > 0 ? 'Berhasil input PO' : 'Gagal input PO'
		];

		echo json_encode($rsp);
	}

	public function dt_po_project()
	{
		$projek = $this->input->post('project');
		echo $this->mp->dt_po_project($projek);
	}
	
	//Device
	public function getDeviceByProjek()
	{
		$id = $this->input->get('projek_id');

		$this->md->see = "id,model";
		$data = $this->md->get('',['project' => $id])->result();
		echo json_encode($data);
	}
	
    public function dt_device() //datatable
    {
        echo ($this->md->dt());
	}
	
	public function list_device()
	{
		$d = [
			'title' => 'List All Device',
			'linkView' => 'page/scm/devices',
			'fileScript' => 'scm_device.js',
			'bread' => [
				'nama' => 'List All Device',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
			],
			'device' => $this->get_device_grp_by('device'), 
			'project' => $this->get_device_grp_by('project'), 
			'status' => $this->get_device_grp_by('status'), 
			'used' => $this->get_device_grp_by('used'), 
			'allocation' => $this->get_device_grp_by('allocation'), 
		];
		$this->load->view('_main',$d);
	}
	public function list_by_device()
	{
		$d = [
			'title' => 'List By Device',
			'linkView' => 'page/scm/by_devices',
			'fileScript' => 'scm/by_devices.js',
			'bread' => [
				'nama' => 'List By Device',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	public function h_device()
	{
		$d = [
			'title' => 'History Device',
			'linkView' => 'page/scm/h_device',
			'fileScript' => 'scm/h_device.js',
			'bread' => [
				'nama' => 'History Device',
				'data' => [
					['nama' => 'List All Device','link' => site_url('SCM/list_device'),'active' => ''],
					['nama' => 'History Device','link' => '','active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	
	public function form_device($id=0)
	{
		$action='add_device';
		$data = [
			'id' => '0',
            'sn' => '',
            'model' => '',
            'po' => '',
            'item' => '',
			'price' => '',
			'received' => '',
			'project' => '',
			'allocation' => '',
			'delivered' => '',
			'status' => '',
			'ket' => ''
		];
		if($id>0){
			$dx = $this->md->get($id);
			$data = $dx->row_array();
			$action = 'upd_device';
		}

		$this->mprj->see = "pk.id,p.service";

		$d = [
			'title' => 'Add Device',
			'linkView' => 'page/scm/form_device',
			'fileScript' => 'scm/form_device.js',
			'titleForm' => "Form Device",
			'bread' => [
				'nama' => 'Add Device',
				'data' => [
					['nama' => 'List Device','link' => site_url('SCM/list_device'),'active' => ''],
					['nama' => 'Add Device','link' => site_url('SCM/form_device'),'active' => 'active'],
				]
			],
			'val' => $data,
			'projek' => $this->mprj->getProjek()->result(),
			'action' => $action
		];
		$this->load->view('_main',$d);
    }
	public function form_device_multi()
	{
		$action='save_device_multi';
		$data = [
			'id' => '0',
            'sn' => '',
            'model' => '',
            'po' => '',
            'item' => '',
			'price' => '',
			'received' => '',
			'project' => '',
			'delivered' => '',
			'status' => '',
			'ket' => ''
		];

		$d = [
			'title' => 'Multiple Device',
			'linkView' => 'page/scm/form_device_multi',
			'fileScript' => 'scm_device.js',
			'titleForm' => "Form Multiple Device",
			'bread' => [
				'nama' => 'Multiple Device',
				'data' => [
					['nama' => 'List Device','link' => site_url('SCM/list_device'),'active' => ''],
					['nama' => 'Multiple Device','link' => site_url('SCM/form_device_multi'),'active' => 'active'],
				]
			],
			'val' => $data,
			'action' => $action
		];
		$this->load->view('_main',$d);
    }
	// Action
    public function add_device(){
		$used = 'n';
		$allocation = $this->input->post('allocation');
		$project = $this->input->post('project');
		if ($project != '') {
			$used = 'y';
			$allocation = 'client';
		} 

		$obj = [
                'sn' => $this->input->post('sn'),
                'model' => $this->input->post('model'),
                'po' => $this->input->post('po'),
                'item' => $this->input->post('item'),
                'price' => $this->input->post('price'),
                'received' => $this->input->post('received'),
                'project' => $project,
                'delivered' => $this->input->post('delivered'),
                'status' => $this->input->post('status'),
                'allocation' => $allocation,
                'used' => $used,
				'ket' => $this->input->post('ket'),
				'ctddate' => date('Y-m-d'),
				'ctdby' => $this->session->userdata('karyawan_id')
            ];
		
		$in = $this->md->in($obj);
		if($in[1]==1){
			$this->md->in_h_device('Device baru saja dibuat',$this->db->insert_id());
			$this->session->set_flashdata('success', 'Berhasil menambahkan device');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menambahkan device');
		}
		redirect('SCM/list_device');
	}
	public function upd_device(){

		$used = 'n';
		$allocation = $this->input->post('allocation');
		$project = $this->input->post('project');
		if ($project != '') {
			$used = 'y';
			$allocation = 'client';
		} 

		$obj = [
                'sn' => $this->input->post('sn'),
                'model' => $this->input->post('model'),
                'po' => $this->input->post('po'),
                'item' => $this->input->post('item'),
                'price' => $this->input->post('price'),
                'received' => $this->input->post('received'),
                'project' => $project,
                'delivered' => $this->input->post('delivered'),
				'status' => $this->input->post('status'),
				'used' => $used,
				'allocation' => $allocation,
				'ket' => $this->input->post('ket'),
				];
		
		$qdevice = $this->md->get($this->input->post('id'));
		if ($qdevice->num_rows() > 0) {
			$qd = $qdevice->row();
			if ($allocation != $qd->allocation) {
				$this->md->in_h_device('Device berada di '.$allocation,$this->input->post('id'));
			}

			if ($this->input->post('status') != $qd->status) {
				$this->md->in_h_device('Device dalam kondisi '.$this->input->post('status'),$this->input->post('id'));
			}
		}

		$in = $this->md->up($obj,['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil mengubah device');
		}else{
			$this->session->set_flashdata('failed', 'Gagal mengubah device');
		}
		redirect('SCM/list_device');
	}
	public function del_device(){
		$in = $this->md->del(['id' => $this->input->post('id')]);
		if($in[1]==1){
			$this->session->set_flashdata('success', 'Berhasil menghapus vendor');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menghapus vendor');
		}
		redirect('SCM/list_device');
	}
	public function save_device_multi(){
		
		$flag = $this->input->post('flag');
		$sn_multi = $this->input->post('sn_multi');
		$sns = explode("\n",$sn_multi);
		
		$s="";
		for($i=0;$i<count($sns);$i++){
			$sn=$sns[$i];
			if($sn!=''){
				$obj = [
					'sn' => $sn,
					'model' => $this->input->post('model'),
					'po' => $this->input->post('po'),
					'item' => $this->input->post('item'),
					'price' => $this->input->post('price'),
					'received' => $this->input->post('received'),
					'project' => $this->input->post('project'),
					'delivered' => $this->input->post('delivered'),
					'status' => $this->input->post('status'),
					'ket' => $this->input->post('ket')
				];
				switch($flag){
					case 'insert': $r=$this->md->in($obj); break;
					case 'update': $r = $this->md->up($obj,['sn' => $sn]); break;
					case 'delete': $r = $this->md->del(['sn' => $sn]); break;
				}
				
				if($r[1]==1){
					$s.="Baris ke : " .($i+1)." $flag $sn berhasil <br />";
				}else{
					$s.="Baris ke : " .($i+1)." $flag $sn gagal <br />";
				}
			}
		}
		echo $s;
	}
	
	//report
	public function rpt_device() //datatable
    {
        $d = [
			'title' => 'Device Report',
			'linkView' => 'page/scm/rpt_device',
			'fileScript' => 'scm_device.js',
			'bread' => [
				'nama' => 'Device Report',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
    }
	public function rpt_purchase() //datatable
    {
        $d = [
			'title' => 'Purchase Report',
			'linkView' => 'page/scm/rpt_purchase',
			'fileScript' => 'scm_purchase.js',
			'bread' => [
				'nama' => 'Purchase Report',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
    }
	public function rpt_quotation() //datatable
    {
        $d = [
			'title' => 'Quotation Report',
			'linkView' => 'page/scm/rpt_quotation',
			'fileScript' => 'scm_quotation.js',
			'bread' => [
				'nama' => 'Quotation Report',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
    }
	
    public function upKaryawan()
    {
        $id = $this->input->post('id');
        $nip = $this->input->post('nip');
        $pass = $this->input->post('password');
        $cek_nip = $this->mk->get('',['nip' => $nip,'id !=' => $id ]);

        if ($pass != '') {
            $password = md5($this->input->post('password'));
        }else{
            $password = $this->mu->getUser($id)->row()->password;
        }

        if ($cek_nip->num_rows() > 0) {
            $this->session->set_flashdata('gagal', 'NIP sudah digunakan, silahkan masukan NIP lain');
        }else{
            $obj = [
                'nama' => $this->input->post('nama_karyawan'),
                'nip' => $nip,
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'alamat_tinggal' => $this->input->post('alamat'),
                'no_rekening' => $this->input->post('no_rekening'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'jabatan_id' => $this->input->post('jabatan'),
                'jk' => $this->input->post('jk'),
                'status_karyawan' => $this->input->post('status_pegawai'),
            ];
            
            $up = $this->mk->up($obj,['id' => $id]);
            if ($up) {
                
                $data_user = [
                    'username' => $this->input->post('username'),
                    'password' => $password,
                    'email' => $this->input->post('email'),
                ];
                
                $inUser = $this->mu->up($data_user,['karyawan_id' => $id]);
                if ($inUser[1] == 1) {
                    $this->session->set_flashdata('success', 'Berhasil menambahkan karyawan baru');
                }
                
            }else{
                $this->session->set_flashdata('failed', 'Gagal menambahkan karyawan baru');
            }
        }
        
        redirect('karyawan/daftar_karyawan');
    }

    public function getKaryawan($id='')
    {
        $q = '';
        $msg = '';
        $status = 0;

        if ($id != '') {
            $kar = $this->mk->get($id);
            if ($kar->num_rows() > 0) {
                $q = $kar->row();
                $msg = "Data ditemukan";
                $status = 1;
            }else{
                $msg = "Data tidak ditemukan";
            }
        }   

        $arr = [
            'data' => $q,
            'msg' => $msg,
            'status'=>$status
        ];

        echo json_encode($arr);
	}
	
	// API

	public function down_sd()
    {
        redirect('./sample/sempel_excel_device.xlsx');
    }

    public function import_sd()
    {
        $file = '';
        $msg = '';
        $ds = [];
        
        $id = $this->input->post('id');
        

        $this->load->library('upload');
        
        $config['upload_path']          = './sample/upload/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('device')){
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

                    if ($numrow > 1 && $row['B'] != '') {
                        $d = [
                            'model' => $row['A'],	
                            'device' => $row['A'],	
                            'sn' => $row['B'],	
                            'po' => $row['C'],	
                            'price' => $row['D'],	
                            'received' => date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($row['E'])),
                            'delivered' => date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($row['F'])),	
                            'status' => $row['G'],	
                            'allocation' => $row['H'],	
                            'ket' => $row['I'],
                            'ctddate' => date('Y-m-d'),
                            'ctdby' => $this->session->userdata('karyawan_id'),
                       ];

                       array_push($ds,$d);
                }
                    $numrow++; // Tambah 1 setiap kali looping
                }
            }
        }
        
        $rsp['data'] = $ds;

        if (count($ds) > 0) {

            $this->db->insert_batch('scm_devices', $ds);

            $rsp['status'] = true;
            $rsp['msg'] = "Berhasil import device";
            @unlink('./sample/upload/'.$file);
        }else{
            $rsp['status'] = false;
            $rsp['msg'] = "Gagal import device";
        }

        echo json_encode($rsp);
	}

	public function get_device_grp_by($key='')
	{
		$d = null;
		
		if ($key =='device') {
			$this->md->see = 'model as val';
			$d = $this->md->get_device_grp_by('model');
		}else if ($key =='project') {
			$this->md->see = 'p.service as val,d.project';
			$d = $this->md->get_device_grp_by('project');
		}else if ($key =='status') {
			$this->md->see = 'status as val';
			$d = $this->md->get_device_grp_by('status');
		}else if ($key =='used') {
			$this->md->see = 'used as val';
			$d = $this->md->get_device_grp_by('used');
		}else if ($key =='allocation') {
			$this->md->see = 'allocation as val';
			$d = $this->md->get_device_grp_by('allocation');
		}
		
		return $d;
	}

	// Dt by device

	public function dt_by_device()
	{
		echo $this->md->dt_by_device();
	}

	// Dt History device

	public function dt_h_device()
	{
		echo $this->md->dt_h_device();
	}
	
	// Dt Stock device Opr

	public function dt_stock_device_opr()
	{
		echo $this->md->dt_stock_device_opr();
	}

	//Get Device
	public function get_device($id='',$ops_rsl='')
	{
		if($id == '') return show_404();

		$this->md->see = '*';
		$d =  $this->md->get($id);
		if ($ops_rsl == 'return'){
			return $d->row();
		}else{
			echo json_encode($d->row());
		}
	}

	//Get Device by Allocation
	public function get_device_by_allo_baik($allo='')
	{
		$this->md->see = 'id,model,sn';
		$d =  $this->md->get('',['allocation' => $allo,'status' => 'baik']);
		echo json_encode($d->result());
	}

	// Update Manage Device
	public function up_manage_device()
	{
		$pilih = $this->input->post('pilih');
		$condition = $this->input->post('condition');
		$device_id = $this->input->post('device_id');
		$device_new = $this->input->post('device_new');
		$sn_old = $this->input->post('sn_old');
		$sn_new = $this->input->post('sn_new');
		$pk_id = $this->input->post('pk_id');
		$action = $this->input->post('action');
		$status = $this->input->post('status');
		$ket = $this->input->post('ket');

		if ($pilih == 'edit') {
			$this->db->update('scm_devices', [
				'status' => $status,
				'ket' => $ket
			],['id' => $device_id]);
			
			if ($status == 'rusak') {
				$this->md->in_rma_device($device_id);
			}
			$this->md->in_h_device('Edit Device : '.$ket,$device_id);
		}else if($pilih == 'replace'){
			
			$this->db->insert('scm_dvc_replace', [
				'device_new' => $device_new,
				'device_old' => $device_id,
				'sn_old' => $sn_old,
				'sn_new' => $sn_new,
				'pk_id' => $pk_id,
				'ctddate' => date('Y-m-d'),
				'ctdby' => $this->session->userdata('karyawan_id'),
				'ket' => $ket,
			]);

			$this->db->update('scm_devices', [
				'used' => 'n',
				'allocation' => 'operation',
				'status' => 'rusak',
				'project' => '',
			],['id' => $device_id]);

			$this->db->update('scm_devices', [
				'used' => 'y',
				'allocation' => 'client',
				'status' => 'baik',
				'project' => $pk_id,
			],['id' => $device_new]);

			$this->md->in_h_device('Replace  : Device dengan SN#'.$sn_old.' diganti dengan Device baru SN#'.$sn_new.' | Ket : '.$ket,$device_id);
		}else if($pilih == 'rma'){
			$this->db->insert('scm_dvc_rma', [
				'device_id' => $device_id,
				'status' => $action,
				// 'device_new' => $device,
				// 'sn_new' => $sn_new,
				'ctddate' => date('Y-m-d'),
				'ctdby' => $this->session->userdata('karyawan_id'),
				'ket' => $ket,
			]);
			

			$this->db->update('scm_devices', [
				'used' => 'n',
				'allocation' => 'operation',
				'status_broken' => $action,
			],['id' => $device_id]);

			$this->md->in_h_device('Device di RMA| Status Device : '.$action.' | Ket : '.$ket,$device_id);
		}
		
		$data = [
			'status' => true,
			'msg' => "Success changed data"
		];

		echo json_encode($data);
		
	}

	// Replace Device
	public function dt_device_replace()
	{
	 echo $this->md->dt_device_replace();
	}

	public function cek_device_by_cust($id='')
	{
		if($id == '') show_404();

		$this->md->see = 'sd.id,sd.model,sd.sn';
		$q = $this->md->cek_device_by_cust($id)->result();
		echo json_encode($q);
	}

	public function in_replace_device()
	{
		$status = false;
		$msg = 'Gagal replace device';

		$device_old = $this->input->post('device_old');
		$device_new = $this->input->post('device_new');
		$date_replace = $this->input->post('date_replace');

		$in = $this->md->in_replace_device($device_old,$device_new,$date_replace);
		if ($in) {
			$status = true;
			$msg = "Berhasil Replace Device";
		}

		$data = [
			'status'  => $status,
			'msg'  => $msg
		];

		echo json_encode($data);
	}

	// RMA Device

	public function dt_device_rma()
	{
	 	echo $this->md->dt_device_rma();
	}

	public function up_rma_device()
	{
		$s = false;
		$msg = 'Gagal RMA';

		$device_id = $this->input->post('device_id');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$date_rma = $this->input->post('date_rma');
		$ket = $this->input->post('ket');

		$in = $this->md->up_rma_device($device_id,$status,$date_rma,$ket);
		if ($in) {
			$s = true;
			$msg = "Berhasil mengubah status RMA";
			$this->md->in_h_device('Edit Device : '.$ket,$device_id);
		}

		$data = [
			'status'  => $s,
			'msg'  => $msg
		];

		echo json_encode($data);
	}

	public function get_device_rma($id='',$ops_rsl='')
	{
		if($id == '') return show_404();

		$this->md->see = 'scr.device_id as id,sd.ket,model,sn,scr.status';
		$d =  $this->md->get_device_rma($id);
		if ($ops_rsl == 'return'){
			return $d->row();
		}else{
			echo json_encode($d->row());
		}
	}

	// Work Order

	public function work_order()
	{
		$d = [
			'title' => 'Work Order',
			'linkView' => 'page/scm/work_order',
			'fileScript' => 'scm/work_order.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	// dt_projek_by_po

	public function dt_projek_by_po()
	{
		echo $this->ms->dt_projek_by_po();
	}

	// Create PO

	public function create_po()
	{
		$id = $this->input->get('id');
		if(empty($id)) redirect($_SERVER['HTTP_REFERER']); 
		$d = [
			'title' => 'Create PO',
			'linkView' => 'page/scm/create_po',
			'fileScript' => 'scm/create_po.js',
			'projek' => $this->mprj->getProjek('','',$id)->row(),
			'file' => [
				'kontrak' => 'data/sls/kontrak/'.@$this->mprj->get_file_kontrak($id)->row()->file,
				'po' => @$this->mprj->get_po_by_projek($id)->num_rows() > 0 ? 'data/sls/po/'.@$this->mprj->get_po_by_projek($id)->row()->po : ''
			],
			'bread' => [
				'nama' => '',
				'data' => [
				]
            ]
		];

		$this->load->view('_main',$d);
	}

	// Request List

	public function request_list()
	{
		$d = [
			'title' => 'Request List',
			'linkView' => 'page/scm/request_list',
			'fileScript' => 'scm/request_list.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	// Request List

	public function inventory()
	{
		$d = [
			'title' => 'Inventory',
			'linkView' => 'page/scm/inventory',
			'fileScript' => 'scm/inventory.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	// Form Inventory

	public function form_inventory()
	{
		$d = [
			'title' => 'form_inventory',
			'linkView' => 'page/scm/form_inventory',
			'fileScript' => 'scm/form_inventory.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
				],
			'titleForm'=>'Form Inventory',
			'action'=>'Form Inventory',
			'val'=>'Form Inventory',
		];
		$this->load->view('_main',$d);
	}
	
	public function in_form_inventory()
	{
		$obj_po_item = [];
		$msg = "Gagal menyimpan invoices ke inventory";
		$status = false;

		$file = '';
		$err = '';
		$this->load->library('upload');
		
		$config['upload_path']          = './data/scm/po/';
        $config['allowed_types']        = 'pdf|xlsx|xls';
        $config['max_size']             = 0;
        $config['encrypt_name']         = true;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_receipt')){
           $err = $this->upload->display_errors();
        }else{
           $file = $this->upload->data()['file_name'];
		}
		

		$purchaseno = $this->input->post('purchaseno');
		$category = $this->input->post('category');
		$merek = $this->input->post('merek_id');
		$desc = $this->input->post('desc');
		$qty = $this->input->post('qty');
		$price = $this->input->post('price');
		$type = $this->input->post('type_id');
		$purchase_date = $this->input->post('purchase_date');

		$obj_p = [
			'purchaseno' => $purchaseno,
			'purchase_date' => $purchase_date,
			'desc' => $desc,
			'category' => $category,
			'file' => $file,
			'ctddate' => date('Y-m-d'),
			'ctdby' => $this->session->userdata('karyawan_id')
		];

		$sp = $this->db->get_where('scm_purchases',['purchaseno' => $purchaseno]);
		if ($sp->num_rows() > 0) {
			$msg = "Gagal menyimpan invoices ke inventory, number purchase sudah ada.";
		}else{
			$this->db->insert('scm_purchases', $obj_p);
			$po_id = $this->db->insert_id();

			for ($i=0; $i < count($qty); $i++) { 
				$obj_d = [
					'po_id' => $po_id,
					'qty' => $qty[$i],
					'merek_id' => $merek[$i],
					'type_id' => @$type[$i],
					'price' => $price[$i],
					'total_price' => $price[$i]*$qty[$i],
					'ctddate' => date('Y-m-d'),
					'ctdby' => $this->session->userdata('karyawan_id')
				];

				array_push($obj_po_item,$obj_d);
			}

			$this->db->insert_batch('scm_purchase_items', $obj_po_item);
			$jml = $this->db->affected_rows();
			if ($jml > 0) {
				$msg = "Berhasil menyimpan invoices ke inventory";
				$status = true;
			}
		}
		
		$rsp = [
			'msg' => $msg,
			'err' => $err,
			'status' => $status,
		];

		echo json_encode($rsp);
	}

	// Detail Inventory

	public function detail_inventory()
	{
		$d = [
			'title' => 'detail_inventory',
			'linkView' => 'page/scm/detail_inventory',
			'fileScript' => 'scm/detail_inventory.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	public function down_sample_device(){
		
		$o = $this->device_sample();
		echo $o;

		// echo json_encode(
		// 	[
		// 		'status' => true,
		// 		'file' => '../data/sample/'.$o[1]
		// 	]
		// );

		// Get the content that is in the buffer and put it in your file //
		
	}

	public function  device_sample()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$items = [];

		$sheet->setCellValue('A1', 'SN');
		$sheet->setCellValue('B1', 'Merek');
		$sheet->setCellValue('C1', 'Type');
		$sheet->setCellValue('D1', 'Price');
		$sheet->setCellValue('E1', 'Merek ID');
		$sheet->setCellValue('F1', 'Type ID');
		$sheet->setCellValue('G1', 'Item ID');
			
		// $siswa = $this->siswa_model->getAll();
		// $no = 1;
		// $x = 2;
		// foreach($siswa as $row)
		// {
			$xx= 2;
			for ($i=0; $i < @count($this->input->post('merek')); $i++) { 
				$items = [
					'qty' => $this->input->post('qty')[$i],
					'price' => $this->input->post('price')[$i],
					'po_id' => $this->input->post('po_id'),
					'ctddate' => date('Y-m-d'),
					'ctdby' => $this->session->userdata('karyawan_id'),
					'merek_id' => $this->input->post('merek')[$i],
					'type_id' => $this->input->post('type')[$i],
				];

				$this->db->insert('scm_purchase_items', $items);
				$po_item_id = $this->db->insert_id();

				for ($x=0; $x < $this->input->post('qty')[$i]; $x++) { 
					$sheet->setCellValue('A'.$xx,'');
					$sheet->setCellValue('B'.$xx,$this->md->get_dvc_merek(['id' => $this->input->post('merek')[$i]])->row()->merek );
					$sheet->setCellValue('C'.$xx,$this->md->get_dvc_type(['id' => $this->input->post('type')[$i]])->row()->type );
					$sheet->setCellValue('D'.$xx,$this->input->post('price')[$i]);
					$sheet->setCellValue('E'.$xx,$this->input->post('merek')[$i] );
					$sheet->setCellValue('F'.$xx,$this->input->post('type')[$i]);
					$sheet->setCellValue('G'.$xx,$po_item_id);
					
					$xx++;
				}
			}
		// 	$x++;
		// }

		$writer = new Xlsx($spreadsheet);
		$filename = 'device_'.date('Ymdhis');
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}


	// All Inventory
	public function all_inventory()
	{
		$d = [
			'title' => 'All Inventory',
			'linkView' => 'page/scm/all_inventory',
			'fileScript' => 'scm/all_inventory.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	// Merek
	public function get_dvc_merek()
	{
		echo json_encode($this->md->get_dvc_merek()->result());
	}

	// Type
	public function get_dvc_type($merek='')
	{
		echo json_encode($this->md->get_dvc_type(['merek_id' => $merek])->result());
	}

	// Import Device
	public function import_device()
    {
        $file = '';
        $msg = '';
        $ds = [];
		$this->load->library('upload');
		
        $id = $this->input->post('id');

		$config['upload_path']          = './data/sample/';
        $config['allowed_types']        = 'xlsx';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_device')){
           var_dump($this->upload->display_errors());
        }else{
           $file = $this->upload->data()['file_name'];
        }
		
        if ($file != '') {

            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./data/sample/'.$file); // Load file yang telah diupload ke folder excel
            $getSheet = $loadexcel->getSheetNames();
            foreach ($getSheet as $rows) {
                $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
                $data = [];
				$numrow = 1;
                foreach ($sheet as $row) {
                    if ($numrow > 1 && $row['B'] != '') {
						$d = [
							'sn' => $row['A'],	
							'po_id' => $this->input->post('po_id'),	
							'project' => $this->input->post('p_id'),	
							'merek_id' => $row['E'],	
							'category' => '3',	
							'type_id' => $row['F'],	
							'price' => $row['D'],	
							'po_item_id' => $row['G'],	
							'ctddate' => date('Y-m-d'),
							'ctdby' => $this->session->userdata('karyawan_id'),
						];
					   	array_push($ds,$d);
					   }
					
                    $numrow++; 
                }
            }
        }
        
        $rsp['data'] = $ds;
        $rsp['file'] = $file;

        if (count($ds) > 0) {
            $this->db->insert_batch('scm_devices', $ds);
            $rsp['status'] = true;
            $rsp['msg'] = "Berhasil import device";
            @unlink('./data/sample/'.$file);
        }else{
            $rsp['status'] = false;
            $rsp['msg'] = "Gagal import device";
        }

        echo json_encode($rsp);
	}

	// Detail Request

	public function detail_req()
	{
		$d = [
			'title' => 'detail_req',
			'linkView' => 'page/scm/detail_req',
			'fileScript' => 'scm/list_req.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	// Inventory
	public function dt_inventory_invoice()
	{
		echo $this->mp->dt_inventory_invoice();
	}

	public function dt_inventory()
	{
		echo $this->md->dt_inventory();
	}
	
	public function dt_all_inventory()
	{
		$c = $this->input->post('category');
		echo $this->md->dt_all_inventory($c);
	}

	public function dt_inventory_items()
	{
		$po_id = $this->input->post('id');
		echo $this->mp->dt_inventory_items($po_id);
	}

	public function get_po_item_id()
	{
		$id = $this->input->get('id');
		$q = $this->mp->get_po_item_id($id);
		echo json_encode($q->row());
	}

	public function dt_detail_inv_device()
	{
		$type = $this->input->post('type');
		echo $this->md->dt_inventory($type);
	}

	public function in_dvc_inv()
	{
		$obj = [];
		$s = false;
		$m = "Gagal menambahkan device ke inventory";
		$mto = '';

		$sn = $this->input->post('sn');
		$status = $this->input->post('status');
		$mutasi = $this->input->post('mutasi');
		$type = $this->input->post('type');
		$merek = $this->input->post('merek');
		$categ = $this->input->post('category');
		$mutasi_to = $this->input->post('mutasi_to');
		$alokasi = $this->input->post('alokasi');
		$handover_date = $this->input->post('handover_date');
		
		for ($i=0; $i < @count($sn); $i++) { 
			
			if ($status[$i] != '4' || $status[$i] != '5') {
				$mto = $mutasi_to[$i];
			}

			$arr = [
				'sn' => $sn[$i],
				'type_id' => $type,
				'merek_id' => $merek,
				'category' => $categ[$i],
				'status' => $status[$i],
				'mutation' => $mutasi[$i],
				'mutation_to' => $mto,
				'alokasi_dvc' => $alokasi[$i],
				'handover_date' => $handover_date[$i],
			];

			array_push($obj,$arr);
		}

		$this->db->insert_batch('scm_devices', $obj);
		$c = $this->db->affected_rows();
		if($c > 0) {
			$s = true;
			$m = "Berhasil menambahkan device ke inventory";
		}	

		$data = [
			'status' => $s,
			'msg' => $m
		];

		echo json_encode($data);
	}

	public function up_dvc_inv()
	{
		$obj = [];
		$s = false;
		$m = "Gagal mengubah data";
		$mto = '';

		$id = $this->input->post('e_id');
		$sn = $this->input->post('e_sn');
		$status = $this->input->post('e_status');
		$mutasi = $this->input->post('e_mutation');
		$type = $this->input->post('e_type');
		$merek = $this->input->post('e_merek');
		$categ = $this->input->post('e_category');
		$mutasi_to = $this->input->post('e_mutasi_to');
		$alokasi = $this->input->post('e_alokasi_dvc');
		$purchase_date = $this->input->post('e_purchase_date');
		$handover_date = $this->input->post('e_handover_date');
		$return_date = $this->input->post('e_return_date');

		if ($mutasi < 4) {
			$mto = $mutasi_to;
		}

		$arr = [
			'sn' => $sn,
			'type_id' => $type,
			'merek_id' => $merek,
			'category' => $categ,
			'status' => $status,
			'mutation' => $mutasi,
			'mutation_to' => $mto,
			'alokasi_dvc' => $alokasi,
			'purchase_date' => $purchase_date,
			'handover_date' => $handover_date,
			'return_date' => $return_date,
		];

		$this->db->update('scm_devices',$arr,['id' => $id]);
		$c = $this->db->affected_rows();
		if($c > 0) {
			$s = true;
			$m = "Berhasil mengubah data";
		}	

		$data = [
			'status' => $s,
			'msg' => $m
		];

		echo json_encode($data);
	}

	// Request Device
	public function dt_req_list()
	{
		echo $this->mr->dt_req_list();
	}

	public function ubs_req_t()
	{
		$rql_id = $this->input->post('req_list_id');
		$s = $this->input->post('status');
		$alasan = $this->input->post('alasan');
		$status = false;
		$msg = "Request ditolak";

		if ($rql_id == '') show_404();
		$r = $this->mr->ubah_status_req($rql_id,$s,$alasan);
		if($r) {
			$status = true;
			$msg = "Berhasil melakukan approved request";
		}

		$rsl = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($rsl);
	}

	public function get_req_dvc($req_list_id='')
	{
		$q = $this->mr->get_req_dvc($req_list_id);
		echo json_encode($q->result());
	}

	public function handover_date()
	{
		$status = false;
		$msg = "Gagal menyerahkan device ke pemohon";

		$rql_id = $this->input->post('req_list_id');
		$handover_date = $this->input->post('handover_date');

		$r = $this->mr->handover_date($rql_id,$handover_date);
		
		if($r) {
			$status = true;
			$msg = "Device berhasil diserahkan ke pemohon ";
		}
		
		$rsl = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($rsl);
	}

	// Inventory_new
	public function inventory_new()
	{
		$d = [
			'title' => 'Inventory',
			'linkView' => 'page/scm/inventory_new',
			'fileScript' => 'scm/inventory_new.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	// Detail_Inventory_New
	public function detail_inventory_new()
	{
		$d = [
			'title' => 'Detail Inventory',
			'linkView' => 'page/scm/detail_inventory_new',
			'fileScript' => 'scm/detail_inventory_new.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	

	
	// fungsi peminjaman mobil
	
	public function dt_mobil() //datatable
    {
        echo ($this->mb->dt_daftar_mobil());
	}

	public function dt_pengajuan_mobil() //datatable
    {
        echo ($this->mb->dt_pengajuan());
	}
	public function dt_pengajuan_mobil_all() //datatable
    {
        echo ($this->mb->dt_pengajuan_all());
	}


	public function dt_persetujuan_peminjaman_mobil() //datatable
    {
        echo ($this->mb->dt_persetujuan());
	}


	// tentang master data mobil (View,Create,Update,Delete)
	public function data_mobil()
	{
		$d = [
			'title' => 'Daftar Mobil',
			'linkView' => 'page/scm/data_mobil',
			'fileScript' => 'data_mobil.js',
			'bread' => [
				'nama' => 'Daftar Mobil',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	public function form_mobil($pnjm_id_mobil='')
	{
		// 
		$query = $this->db->get('pnjm_mobil');
		$last_id = 0;
		foreach ($query->result() as $row)
		{
			$last_id = $row->pnjm_id_mobil;
		}
	
		$action='add_mobil';
		$data = [
			'pnjm_id_mobil' => ($last_id+1),
            'pnjm_merek_mobil' => '',
			'pnjm_plat_mobil' => '',
			'pnjm_mesin_mobil' => '',
            'pnjm_status_pemakaian' => '',
            'pnjm_status_keterangan' => ''
		];
		if($pnjm_id_mobil != ""){
			$dx = $this->mb->get_id_mobil($pnjm_id_mobil);
			$data = $dx->row_array();
			$action = 'upd_mobil';
		}

		$d = [
			'title' => 'Form Mobil',
			'linkView' => 'page/scm/form_mobil',
			'fileScript' => 'data_mobil.js',
			'titleForm' => "Form Mobil",
			'bread' => [
				'nama' => 'Form Mobil',
				'data' => [
					['nama' => 'List Mobil','link' => site_url('SCM/list_vendor'),'active' => ''],
					['nama' => 'Add Mobil','link' => site_url('SCM/form_vendor'),'active' => 'active'],
				]
			],
			'val' => $data,
			'action' => $action,
		];
		$this->load->view('_main',$d);
	}
	
	public function add_mobil(){
		$dt = array(
			'pnjm_id_mobil' => $this->input->post('pnjm_id_mobil'),
			'pnjm_merek_mobil' => $this->input->post('pnjm_merek_mobil'),
			'pnjm_plat_mobil' => $this->input->post('pnjm_plat_mobil'),
			'pnjm_mesin_mobil' => $this->input->post('pnjm_mesin_mobil')
		);	
		$this->db->insert('pnjm_mobil', $dt);
		$this->session->set_flashdata('success', 'Berhasil menambahkan Mobil');
		redirect('SCM/data_mobil');
	}

	public function upd_mobil(){
		$dt = array(
			'pnjm_merek_mobil' => $this->input->post('pnjm_merek_mobil'),
			'pnjm_plat_mobil' => $this->input->post('pnjm_plat_mobil'),
			'pnjm_mesin_mobil' => $this->input->post('pnjm_mesin_mobil')
		);	
		$this->db->where('pnjm_id_mobil', $this->input->post('pnjm_id_mobil'));
        $this->db->update('pnjm_mobil', $dt);
		if(!empty($this->input->post('pnjm_id_mobil'))){
			$this->session->set_flashdata('success', 'Berhasil mengubah mobil');
		}else{
			$this->session->set_flashdata('failed', 'Gagal mengubah mobil');
		}
		redirect('SCM/data_mobil');
	}

	public function del_mobil(){

		$this->db->delete('pnjm_mobil', array('pnjm_id_mobil' => $this->input->post('pnjm_id_mobil')));
		if(!empty($this->input->post('pnjm_id_mobil'))){
			$this->session->set_flashdata('success', 'Berhasil menghapus mobil');
		}else{
			$this->session->set_flashdata('failed', 'Gagal menghapus mobil');
		}
		redirect('SCM/data_mobil');
	}

	// end tentang master data mobil
	public function pengajuan_peminjaman_mobil()
	{
		$extend = $this->mb->get_extend();
		$change = $this->mb->get_change();
		$d = [
			'title' => 'Daftar Pengajuan Saya',
			'linkView' => 'page/scm/peminjaman_mobil',
			'fileScript' => 'peminjaman_mobil.js',
			'bread' => [
				'nama' => 'Daftar Pengajuan Saya',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
				],
			'get_extend' => $extend,
			'get_change' => $change
		];
		$this->load->view('_main',$d);
	}
	public function extend($pnjm_id = '')
	{
		// var_dump($_POST);
		// cek apakah sudah ada extend
		$pk_pnjm_id =  $_POST['pnjm_id'];
		// $tmp =  $_POST['tmp'];
		$pnjm_mobil_id =  $_POST['pnjm_mobil_id'];
		$get_extend =  $_POST['get_extend'];
		$extend =  $_POST['extend'];
		if (empty($_POST['get_extend'])) {
			// echo "belom pernah isi extend";
			if ($extend <= $_POST['tsp']) {
				$this->session->set_flashdata('error', 'Field extend harus lebih besar waktu selesai Pemakaian');
				redirect('SCM/pengajuan_peminjaman_mobil');
			}else{
				$dt_update_batal_extend = array(
					'status_pengajuan' => '7' // status pembatalan Extend
				);
				$dt_update_extend = array(
					'status_pengajuan' => '2', // status pembatalan Extend
					'extend' => $extend,
				);
				// $where = "pnjm_mobil_id='$pnjm_mobil_id' and status_pengajuan IN(1,2) AND tmp BETWEEN '$tmp' and '$extend' OR tsp BETWEEN '$tmp' and '$extend' OR '$tmp' BETWEEN tmp and tsp OR '$extend' BETWEEN tmp AND tsp";
				$where = "img_start IS NOT NULL AND pnjm_mobil_id ='$pnjm_mobil_id' AND status_pengajuan IN(1,2) AND tmp <= '$extend'";
				$this->db->select('*');
				$this->db->from('pnjm_pengajuan');
				$this->db->where($where);
				$pembatalan_extend = $this->db->get()->result();
				
				foreach ($pembatalan_extend as $btl) {
					$this->db->where('pnjm_id',$btl->pnjm_id);
					$this->db->update('pnjm_pengajuan', $dt_update_batal_extend);

					$pnjm_id = $btl->pnjm_id;
					$user = $this->session->userdata('karyawan_id');
					$status = 5;
					$aktifitas = "Batal extend, ada prioritas extend kendaraan oleh id: ".$pk_pnjm_id." sampai: ".$extend;
					$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
				}
	
				
				$this->db->where('pnjm_id',$pk_pnjm_id);
				$this->db->update('pnjm_pengajuan', $dt_update_extend);
				
				// // log extend 
				$pnjm_id = $pk_pnjm_id;
				$user = $this->session->userdata('karyawan_id');
				$status = 5;
				$aktifitas = "Extend waktu Peminjaman kendaraan sampai :".$extend;
				$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
				// // end log
				
				$this->session->set_flashdata('success', 'Berhasil Melakukan Request Pengajuan Extend Peminjaman Mobil');
				redirect('SCM/pengajuan_peminjaman_mobil');
			}
		}else{
			
			if ($extend <= $get_extend) {
				$this->session->set_flashdata('error', 'Field New extend harus lebih besar dari Pengajuan Extend Sebelumnya');
				redirect('SCM/pengajuan_peminjaman_mobil');
			}else{
				$dt_update_batal_extend = array(
					'status_pengajuan' => '7' // status pembatalan Extend
				);
				$dt_update_extend = array(
					'status_pengajuan' => '2', // status pembatalan Extend
					'extend' => $extend,
				);
				
				$where = "img_start IS NOT NULL AND pnjm_mobil_id ='$pnjm_mobil_id' AND status_pengajuan IN(1,2) AND tmp <= '$get_extend'";
				$this->db->select('*');
				$this->db->from('pnjm_pengajuan');
				$this->db->where($where);
				$pembatalan_extend = $this->db->get()->result();
				
				foreach ($pembatalan_extend as $btl) {
					$this->db->where('pnjm_id',$btl->pnjm_id);
					$this->db->update('pnjm_pengajuan', $dt_update_batal_extend);

					$pnjm_id = $btl->pnjm_id;
					$user = $this->session->userdata('karyawan_id');
					$status = 5;
					$aktifitas = "Batal extend, ada prioritas extend kendaraan oleh id: ".$pk_pnjm_id." sampai: ".$get_extend;
					$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
				}
				

				$this->db->where('pnjm_id',$pk_pnjm_id);
				$this->db->update('pnjm_pengajuan', $dt_update_extend);
				
				// // log extend 
				$pnjm_id = $pk_pnjm_id;
				$user = $this->session->userdata('karyawan_id');
				$status = 5;
				$aktifitas = "Perpanjangan Extend waktu Peminjaman kendaraan sampai :".$get_extend;
				$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
				// end log
				
				$this->session->set_flashdata('success', 'Berhasil Melakukan Request Pengajuan Update Extend Peminjaman Mobil');
				redirect('SCM/pengajuan_peminjaman_mobil');
			}
		}
	}

	public function change_kendaraan()
	{
		//  new req bang adi 7/5/21
		$user = $this->session->userdata('karyawan_id');
		$change_id = $this->input->post('change_id');
		$mobil_old = $this->input->post('mobil_old');
		$mobil_new = $this->input->post('mobil_new');

		$update_mobil_old = array(
			'pnjm_status_pemakaian' => 0,
		);
		$this->db->where('pnjm_id_mobil', $mobil_old);
		$this->db->update('pnjm_mobil', $update_mobil_old);

		$update_mobil_new = array(
			'pnjm_status_pemakaian' => 1
		);
		$this->db->where('pnjm_id_mobil', $mobil_new);
		$this->db->update('pnjm_mobil', $update_mobil_new);
		
		$update_peminjaman = array(
			'pnjm_mobil_id' => $mobil_new
		);
		$this->db->where('pnjm_id', $change_id);
		$this->db->update('pnjm_pengajuan', $update_peminjaman);

        $get_nama = $this->mk->get('',['id' => $user])->row()->nama;
		$update_log = array(
					'pnjm_id' => $change_id,
					'user' => $get_nama,
					'status' => 8,
					'aktifitas' => "Change Kendaraan Mobil Id: ".$mobil_old. " Dengan Mobil Id: " . $mobil_new
		 );
		 $this->db->insert('pnjm_log_kendaraan',$update_log);
		 if ($mobil_new != "") {
			redirect('SCM/persetujuan_peminjaman_mobil');
		 }



		// old
		// $new_id = $this->input->post('new');
		// $old_id = $this->input->post('old');
		// if ($_POST['new'] != '') {
		// 	$kendaraan_old = $this->db->get_where('pnjm_pengajuan',['pnjm_id' => $_POST['old']])->row()->pnjm_mobil_id;
		// 	$kendaraan_new = $this->db->get_where('pnjm_pengajuan',['pnjm_id' => $_POST['new']])->row()->pnjm_mobil_id;

		// 	$update_kendaraan_new = array(
		// 			'pnjm_mobil_id' => $kendaraan_old, // Update dari mobil B ke mobil A 
		// 	);
		// 	$this->db->where('pnjm_id', $_POST['new']);
		// 	$this->db->update('pnjm_pengajuan', $update_kendaraan_new);
		// 	$update_kendaraan_old = array(
		// 			'pnjm_mobil_id' => $kendaraan_new, // update dari mobil A ke mobil B
		// 	);
		// 	$this->db->where('pnjm_id',$_POST['old']);
		// 	$this->db->update('pnjm_pengajuan', $update_kendaraan_old);
		// 	$pnjm_id='';
		// 	$user = $this->session->userdata('karyawan_id');
		// 	$status = 8;
		// 	$aktifitas='';
		// 	$change_ida= $new_id;
		// 	$change_idb= $old_id;
		// 	$aktifitasa = "Change Kendaraan dengan id_pengajuan :".$change_idb;
		// 	$aktifitasb = "Change Kendaraan dengan id_pengajuan :".$change_ida;
		// 	$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas,$aktifitasa,$aktifitasb,$change_ida,$change_idb);	
		// 	$this->session->set_flashdata('success', 'Change Kendaraan Berhasil');
		// 	redirect('SCM/persetujuan_peminjaman_mobil');
		// }else{
		// 	$this->session->set_flashdata('error', 'Pilih Kendaraan Harus di isi');
		// 	redirect('SCM/persetujuan_peminjaman_mobil');
		// }

	}
	public function pengajuan_peminjaman_mobil_all()
	{
		$d = [
			'title' => 'Daftar Pengajuan All',
			'linkView' => 'page/scm/peminjaman_mobil_all',
			'fileScript' => 'peminjaman_mobil_all.js',
			'bread' => [
				'nama' => 'Daftar Pengajuan All',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	public function persetujuan_peminjaman_mobil()
	{
		if ($this->session->userdata('level') != 71) { // akses level approval proses persetujuan pinjaman mobil
			$this->session->set_flashdata('gagal', 'Maaf, anda tidak memiliki akses Approval peminjaman Mobil');
			redirect('/');
		}else{
			$change = $this->mb->get_change();
			$d = [
				'title' => 'Daftar Persetujuan Peminjaman',
				'linkView' => 'page/scm/persetujuan_peminjaman_mobil',
				'fileScript' => 'persetujuan_pinjaman_mobil.js',
				'bread' => [
					'nama' => 'Daftar Persetujuan Peminjaman',
					'data' => [
						//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
					],
					],
					'get_change' => $change
			];
			$this->load->view('_main',$d);
		}
		
	}
	public function setStatusKendaraan($status_kendaraan='')
    {
        $s = 'Tidak Diketahui';
        if ($status_kendaraan != '') {
            if ($status_kendaraan == 1) {
                $s = "<span class='lbl lbl-primary'>Kondisi Bagus</span>";
            }else if ($status_kendaraan == 2) {
                $s = "<span class='lbl lbl-'>Ada kerusakan</span>";
            }else{
				$s = "<span class='lbl lbl-primary'>Error .404</span>";
			}
            
           return $s; 
        }
	}
	public function setStatusProjek($projek='')
    {
		$s = 'Tidak Diketahui';
        if ($projek != '') {
            if ($projek == 1) {
                $s = "Opty";
            }else if($projek == 2){
                $s = "Lelang / Bid";
            }else if($projek == 3){
                $s = "Running</span";
            }else if($projek == 4){
                $s = "Other </span";
            }else{
                $s = "$projek";
            }
            
            return $s; 
        }
    }
	public function detail_peminjaman_mobil($pnjm_id='')
	{
		$this->db->select('pk.extend,pk.pnjm_tujuan,pk.projek,fk.nama,ck.pnjm_merek_mobil,pk.pnjm_waktu_pengajuan,pk.pnjm_keterangan,pk.km_start,pk.km_end,pk.bensin_start,pk.bensin_end,pk.status_kendaraan,pk.img_start,pk.img_end,pk.status_pengajuan,pk.tmp,pk.tsp');
		$this->db->from('pnjm_pengajuan pk');
		$this->db->join('karyawan fk','fk.id=pk.pnjm_nip_pengajuan','inner');
		$this->db->join('pnjm_mobil ck','pk.pnjm_mobil_id=ck.pnjm_id_mobil','left');
		$this->db->where('pk.pnjm_id', $pnjm_id);
		$test = $this->db->get();
		$dt=[];
		foreach ($test->result() as $row) {
			$details = [
				'nama' => $row->nama,
				'pnjm_merek_mobil'=> $row->pnjm_merek_mobil,
				'pnjm_waktu_pengajuan' => $row->pnjm_waktu_pengajuan,
				'extend' => $row->extend,
				'tmp' => $row->tmp,
				'tsp' => $row->tsp,
				'tujuan'=> $row->pnjm_tujuan,
				'projek'=> $this->setStatusProjek($row->projek),
				'pnjm_keterangan'=> $row->pnjm_keterangan,
				'km_start'=> $row->km_start,
				'km_end'=> $row->km_end,
				'bensin_start'=> $row->bensin_start,
				'bensin_end'=> $row->bensin_end,
				'status_kendaraan'=> $this->setStatusKendaraan($row->status_kendaraan),
				'status_pengajuan'=> $row->status_pengajuan,
				'img_start'=> $row->img_start,
				'img_end'=> $row->img_end
			
			];
			array_push($dt,$details);
		}
		if($this->mb->cek_pengajuan_mobil($pnjm_id)->num_rows() == 0) show_404();

		$hpeng = [];
		foreach ($this->mb->get_pengajuan_peminjaman_mobil($pnjm_id)[0] as $v) { 
			$ok = [
				'nama' => $v->nama,
				'status' => $v->status_pengajuan,
				'pnjm_status_keterangan' =>$v->pnjm_status_keterangan,
				'keterangan_status' =>$v->pnjm_persetujuan_keterangan,
				'tanggal_persetujuan' =>$v->pnjm_tanggal_persetujuan

				// 'approve' => $this->mb->setApprove($v->approve),
				// 'status' => $this->mb->setStatus($v->status),
				// 'tgl' => $this->bantuan->tgl_indo($v->created_date),
				// 'alasan' => $v->alasan
			];

			array_push($hpeng,$ok);
		}
		$log = [];
		foreach ($this->mb->get_log_kendaraan($pnjm_id)[0] as $v) { 
			$ok = [
				'user' => $v->user,
				'tanggal' => $v->tanggal,
				'aktifitas' =>$v->aktifitas,

			];

			array_push($log,$ok);
		}
		
		if ($pnjm_id != '') {
			$d = [
				'title' => 'Detail Pengajuan Peminjaman Mobil',
				'linkView' => 'page/scm/detail_peminjaman_mobil',
				'fileScript' => 'detail_peminjaman_mobil.js',
				'bread' => [
					'nama' => '',
					'data' => [
						['nama' => '','link' => site_url('main/hcm'),'active' => ''],
					]
				],
				// 'k' => $this->mb->get_pengajuan($pnjm_id)->row(),
				// 'peng' => $this->mb->getPeng($pnjm_id)[0],
				// 'jenis' => $this->mb->getPeng($pnjm_id)[1],
				'hpeng' => $hpeng,
				'log' => $log,
				'pengajuan_user' => $dt
			];
			$this->load->view('_main',$d);
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}

	}

	public function form_test($pnjm_id='')
	{
		$action='add_pengajuan_mobil';
		$data = [
			'pnjm_id' => '',
            'kode' => '',
            'nama' => '',
            'attn' => '',
            'alamat' => ''
		];
		if($pnjm_id>0){
			$dx = $this->mv->get($pnjm_id);
			$data = $dx->row_array();
			$action = 'upd_pengajuan_mobil';
		}

		$d = [
			'title' => 'form pengajuan pinjaman mobil',
			'linkView' => 'page/scm/form_pengajuan_peminjaman_mobil',
			'fileScript' => 'persetujuan_pinjaman_mobil.js',
			'titleForm' => "Form Pengajuan",
			'bread' => [
				'nama' => 'Add Pengajuan',
				'data' => [
					// ['nama' => 'List Pengajuan','link' => site_url('SCM/list_Pengajuan'),'active' => ''],
					// ['nama' => 'Add Pengajuan','link' => site_url('SCM/form_vendor'),'active' => 'active'],
					['nama' => 'List Pengajuan','link' => site_url('/'),'active' => ''],
					['nama' => 'Add Pengajuan','link' => site_url('/'),'active' => 'active'],
				]
			],
			'val' => $data,
			'action' => $action
		];
		$this->load->view('_main',$d);
	}

	public function form_pengajuan_persetujuan_mobil($pnjm_id='')
	{

		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
			{
				$agent_disabled = '';
			}else{
				$agent_disabled = 'disabled';
			}

		$action='update_pengajuan_mobil';
		$this->db->select('*');
		$this->db->from('pnjm_pengajuan');
		$this->db->join('karyawan', 'karyawan.id = pnjm_pengajuan.pnjm_nip_pengajuan','left');
		$this->db->join('pnjm_mobil', 'pnjm_mobil.pnjm_id_mobil = pnjm_pengajuan.pnjm_mobil_id','left');
		$this->db->where('pnjm_pengajuan.pnjm_id',$pnjm_id);
		$query = $this->db->get();
        foreach ($query->result() as $row)
        {
		}
		
		if ($row->projek != '') {
            if ($row->projek == 1) {
                $s = "Opty";
            }else if ($row->projek == 2) {
                $s = "Lelang/Bid";
            }else if ($row->projek == 3) {
                $s = "Running";
            }else if ($row->projek == 4) {
                $s = "Other";
            }else{
				$s = $row->projek;
			}
		}
		
		if (!empty($row->img_start)) {
			$disabled_start = "disabled";
			if (!empty($row->img_end)) {
				$disabled_end = "disabled";
			}else{
				$disabled_end = "required";
			}
			
		}else{
			$disabled_start = "required";
			$disabled_end = "disabled";
		}
		// cek pengisian                               
		$data = [
			'pnjm_id' => $pnjm_id,
			'nama' => $row->nama,
            'pnjm_mobil_id' => $row->pnjm_mobil_id,
            'pnjm_merek_mobil' => $row->pnjm_merek_mobil,
            'pnjm_plat_mobil' => $row->pnjm_plat_mobil,
			'pnjm_tujuan' => $row->pnjm_tujuan,
			'km_start' => $row->km_start,
			'km_end' => $row->km_end,
			'bensin_start' => $row->bensin_start,
			'bensin_end' => $row->bensin_end,
			'img_start' => $row->img_start,
			'img_end' => $row->img_end,
			'projek' => $s,
			'pnjm_waktu_pengajuan' => $this->bantuan->tgl_indo($row->pnjm_waktu_pengajuan),
			'tmp' => $row->tmp,
			'tsp' => $row->tsp,
			'extend' => $row->extend,
			'pnjm_keterangan' => $row->pnjm_keterangan
		];

		$d = [
			'title' => 'Form Lanjutan Pengisian Pengajuan Pinjaman Mobil',
			'linkView' => 'page/scm/form_pengajuan_persetujuan_mobil',
			'fileScript' => 'form_pengajuan_persetujuan_mobil.js',
			'titleForm' => "Form Lanjutan Pengisian Pengajuan Pinjaman Mobil",
			'bread' => [
				'nama' => 'Form Lanjutan Pengisian Pengajuan Pinjaman Mobil',
				'data' => [
					// ['nama' => 'List Pengajuan','link' => site_url('SCM/list_Pengajuan'),'active' => ''],
					// ['nama' => 'Add Pengajuan','link' => site_url('SCM/form_vendor'),'active' => 'active'],
					// ['nama' => 'List Pengajuan','link' => site_url('/'),'active' => ''],
					// ['nama' => 'Add Pengajuan','link' => site_url('/'),'active' => 'active'],
				]
			],
			'val' => $data,
			'agent_disabled' => $agent_disabled,
			'disabled_start' => $disabled_start,
			'disabled_end' => $disabled_end,
			'action' => $action
		];
		$this->load->view('_main',$d);
	}

	public function add_pengajuan_mobil()
	{
		
	
		// cek tgl boking pengajuan mobil
		$mobil_id =$this->input->post('pnjm_mobil_id');
		$tmp = $this->input->post('tmp');
		$tsp =$this->input->post('tsp');
		$querya = $this->db->get_where('pnjm_pengajuan', array('status_pengajuan' => '2','pnjm_mobil_id' =>$mobil_id,'tmp >=' => $tmp,'tmp <=' => $tsp));
		$queryb = $this->db->get_where('pnjm_pengajuan', array('status_pengajuan' => '2','pnjm_mobil_id' =>$mobil_id,'tsp >=' => $tmp,'tsp <=' => $tsp));
		foreach ($querya->result() as $row)
		{
			$pnjm_ida = $row->pnjm_id;
		}
		foreach ($queryb->result() as $row)
		{
			$pnjm_idb = $row->pnjm_id;
		}

		if (!empty($pnjm_ida) || !empty($pnjm_idb)) {
			$this->session->set_flashdata('error', 'Gagal Melakukan Pengajuan Peminjaman. Harap Pilih Tanggal Dan Mobil yg sedang tersedia');
			redirect('SCM/pengajuan_peminjaman_mobil');
		}else{
			// echo "aman";
			// die();
			$projek = "";
			if (!empty($_POST['pnjm_projek_pribadi'])) {
				$projek = $_POST['pnjm_projek_pribadi'];
			}else{
				$projek = $_POST['pnjm_projek_kantor'];
			}
			$dt1 = array(
				'pnjm_mobil_id' => $this->input->post('pnjm_mobil_id'),
				'projek' => $projek,
				'pnjm_tujuan' => $this->input->post('pnjm_tujuan'),
				'pnjm_keterangan' => $this->input->post('pnjm_keterangan'),
				'pnjm_nip_pengajuan' => $this->session->userdata('karyawan_id'),
				'pnjm_waktu_pengajuan' => date("Y/m/d h:i:s"),
				'tmp' => $this->input->post('tmp'),
				'tsp' => $this->input->post('tsp'),
				'status_pengajuan' => '1'
			);	
			
			// untuk email
			$to = 71; // level approval
			$from =  $this->session->userdata('email');
			$subject = "Pengajuan Peminjaman Mobil";
			$msg = $this->input->post('pnjm_keterangan');
			$mobil= $this->input->post('pnjm_mobil_id');
			$wp= date("Y/m/d h:i:s");
			$wm= $this->input->post('tmp');
			$ws= $this->input->post('tsp');
			$this->kirim_email($from,$to,$subject,$msg,$mobil,$wp,$wm,$ws);
			// end email

			// untuk log kendaraan
			$this->db->insert('pnjm_pengajuan', $dt1);
			$pnjm_id = $this->db->insert_id();
			$user = $this->session->userdata('karyawan_id');
			$status = 1;
			$aktifitas = "Pengajuan Peminjaman Kendaraan";
			$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
			// end log kendaraan

			$this->bantuan->send_notif_to_lvl('Pengajuan Kendaraan Baru',71,'Ada yang mengajukan pengajuan kendaraan','SCM/persetujuan_peminjaman_mobil');	
			$this->bantuan->sendTelegToJabatan(71,'<a href="'.site_url('SCM/persetujuan_peminjaman_mobil').'">Ada pengajuan kendaraan baru, Silahkan CEK</a>');	
			$this->session->set_flashdata('success', 'Berhasil Melakukan Request Pengajuan Peminjaman Mobil');
			redirect('SCM/pengajuan_peminjaman_mobil');


		}
	}
	public function update_pengajuan_mobil($pnjm_id='')
	{
		// $data=$this->mb->update_pengajuan_mobil();
		$pnjm_id = $this->input->post('pnjm_id');
		$data=$this->mb->update_pengajuan_mobil($pnjm_id);
		if ($data == "true") {
			$this->session->set_flashdata('success', 'Berhasil Melakukan Update Request Pengajuan Peminjaman Mobil');
			redirect('SCM/pengajuan_peminjaman_mobil');
		}else{
			$this->session->set_flashdata('failed', 'Maksimal Upload file 5 MB');
			redirect('SCM/pengajuan_peminjaman_mobil');
			// echo "gagal";
		}
		// echo json_encode($data);

	}
	public function form_persetujuan_peminjaman_mobil($pnjm_id='')
	{
		$action='add_setuju_pengajuan';
		// $query = $this->db->get_where('pnjm_pengajuan',array('pnjm_id' => $pnjm_id));
		$this->db->select('*');
		$this->db->from('pnjm_pengajuan');
		$this->db->join('karyawan', 'karyawan.id = pnjm_pengajuan.pnjm_nip_pengajuan','left');
		$this->db->join('pnjm_mobil', 'pnjm_mobil.pnjm_id_mobil = pnjm_pengajuan.pnjm_mobil_id','left');
		$this->db->where('pnjm_pengajuan.pnjm_id',$pnjm_id);
		$query = $this->db->get();
        foreach ($query->result() as $row)
        {
			// echo $row->nama;
		}
		if ($row->projek != '') {
            if ($row->projek == 1) {
                $s = "Opty";
            }else if ($row->projek == 2) {
                $s = "Lelang/Bid";
            }else if ($row->projek == 3) {
                $s = "Running";
            }else if ($row->projek == 4) {
                $s = "Other";
            }else{
				$s = $row->projek;
			}
        }                               
		$data = [
			'pnjm_id' => $pnjm_id,
			'nama' => $row->nama,
			'pnjm_mobil_id' => $row->pnjm_mobil_id,
			'pnjm_nip_pengajuan' => $row->pnjm_nip_pengajuan,
            'pnjm_merek_mobil' => $row->pnjm_merek_mobil,
			'pnjm_plat_mobil' => $row->pnjm_plat_mobil,
			'pnjm_tujuan' => $row->pnjm_tujuan,
			'projek' => $s,
			'pnjm_waktu_pengajuan' => $this->bantuan->tgl_indo($row->pnjm_waktu_pengajuan),
			'waktu_pnjm_waktu_pengajuan' => $this->bantuan->waktu_indo($row->pnjm_waktu_pengajuan),
			'tmp' => $row->tmp,
			'tsp' => $row->tsp,
			'pnjm_keterangan' => $row->pnjm_keterangan
		];
	
		
		$d = [
			'title' => 'form persetujuan pengajuan pinjaman mobil',
			'linkView' => 'page/scm/form_persetujuan_peminjaman_mobil',
			'fileScript' => 'form_persetujuan_peminjaman_mobil.js',
			'titleForm' => "Form Persetujuan",
			'bread' => [
				'nama' => 'Add Persetujuan',
				'data' => [
					// ['nama' => 'List Pengajuan','link' => site_url('SCM/list_Pengajuan'),'active' => ''],
					// ['nama' => 'Add Pengajuan','link' => site_url('SCM/form_vendor'),'active' => 'active'],
					// ['nama' => 'List Persetujuan','link' => site_url('/'),'active' => ''],
					// ['nama' => 'Add Pengajuan','link' => site_url('/'),'active' => 'active'],
				]
			],
			'val' => $data,
			'action' => $action
		];
		$this->load->view('_main',$d);
	}

	public function add_setuju_pengajuan($pnjm_id='')
	{

		$dt_insert = array(
			'pnjm_id' => $this->input->post('pnjm_id'),
			'pnjm_persetujuan_nip' => $this->session->userdata('karyawan_id'),
			'pnjm_status_keterangan' => 'Persetujuan Pengajuan',
			'pnjm_persetujuan_keterangan' => $this->input->post('keterangan_persetujuan')
		);
		$dt_update_setuju = array(
			'status_pengajuan' => '2'
		);	
		$dt_update_ditolak = array(
			'status_pengajuan' => '3' // Lebih mengutamakan prioritas peminjaman yg lain
		);	
		$mobil_id = $this->input->post('pnjm_mobil_id');
		$pk = $this->input->post('pnjm_id');
		$tmp =  $_POST['tmp'];
		$tsp =  $_POST['tsp'];

		$where = "tmp BETWEEN '$tmp' and '$tsp' OR tsp BETWEEN '$tmp' and '$tsp' OR '$tmp' BETWEEN tmp and tsp OR '$tsp' BETWEEN tmp AND tsp";
		$this->db->select('*');
		$q = $this->db->get_where('pnjm_pengajuan',$where);
		 
		foreach ($q->result() as $row) {
			if ($mobil_id == $row->pnjm_mobil_id && $row->status_pengajuan == '1' && $row->pnjm_id != $pk) {
				$this->db->where('pnjm_id', $row->pnjm_id);
				$this->db->update('pnjm_pengajuan', $dt_update_ditolak);
				// // echo $row->pnjm_id;

				//  // log penolakan prioritas
				 $pnjm_id =  $row->pnjm_id;
				 $user = $this->session->userdata('karyawan_id');
				 $status = 9;
				 $aktifitas = "Penolakan Prioritas Kendaraan Dengan Id Prioritas : ".$this->input->post('pnjm_id');
				 $this->bantuan->log_kendaraan($pnjm_id=$row->pnjm_id,$user,$status,$aktifitas);
				 // end log
			}
		}

		$this->db->where('pnjm_id', $this->input->post('pnjm_id'));
		$this->db->update('pnjm_pengajuan', $dt_update_setuju);
		if(!empty($this->input->post('pnjm_id'))){
			$this->db->insert('pnjm_persetujuan_mobil', $dt_insert);
			$gto = '';
			$get_to = $this->db->get_where('users',['karyawan_id' => $_POST['pnjm_nip_pengajuan']])->result();
			foreach ($get_to as $t) {
				$gto = $t->email;
			}
			// EMAIL
			$pnjm_id = $this->input->post('pnjm_id');
			$to = $gto; // level approval
			$from =  $this->session->userdata('email');
			$subject = "Persetujuan Pengajuan Kendaraan";
			$status_persetujuan = "Menyetujui";
			$msg = $this->input->post('pnjm_persetujuan_keterangan');
			$wp= date("Y/m/d h:i:s");
			$this->kirim_email($from,$to,$subject,$msg,$wp,$pnjm_id,$status_persetujuan);
			// END Email

			// log persetujuan
			$user = $this->session->userdata('karyawan_id');
			$status = 2;
			$aktifitas = "persetujuan peminjaman mobil";
			$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
			// end log
			
			$this->session->set_flashdata('success', 'Berhasil Menyetujui Pengajuan Peminjaman Kendaraan');

			$to = $this->mb->get($this->input->post('pnjm_id'))->row()->pnjm_nip_pengajuan;
			$this->bantuan->send_notif('Pengajuan Kendaraan',$to,'Pengajuan Kendaraan berhasil disetujui','SCM/detail_peminjaman_mobil/'.$this->input->post('pnjm_id'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal Menyetujui Pengajuan Peminjaman Kendaraan');
		}
		redirect('SCM/persetujuan_peminjaman_mobil');
	}
	public function add_tolak_pengajuan($pnjm_id='')
	{
		$dt_insert = array(
			'pnjm_id' => $this->input->post('pnjm_id'),
			'pnjm_persetujuan_nip' => $this->session->userdata('karyawan_id'),
			'pnjm_status_keterangan' => 'Penolakan Pengajuan',
			'pnjm_persetujuan_keterangan' => $this->input->post('keterangan_persetujuan')
		);
		$dt_update_pengajuan = array(
			'status_pengajuan' => '4'
		);	
		$this->db->where('pnjm_id', $this->input->post('pnjm_id'));
        $this->db->update('pnjm_pengajuan', $dt_update_pengajuan);

		if(!empty($this->input->post('pnjm_id'))){
			$this->db->insert('pnjm_persetujuan_mobil', $dt_insert);
			$gto = '';
			$get_to = $this->db->get_where('users',['karyawan_id' => $_POST['pnjm_nip_pengajuan']])->result();
			foreach ($get_to as $t) {
				$gto = $t->email;
			}

			// email
			$pnjm_id = $this->input->post('pnjm_id');
			$to = $gto; // level approval
			$from =  $this->session->userdata('email');
			$subject = "Penolakan Pengajuan Kendaraan";
			$status_persetujuan = "Menolak";
			$msg = $this->input->post('pnjm_persetujuan_keterangan');
			$wp= date("Y/m/d h:i:s");
			$this->kirim_email($from,$to,$subject,$msg,$wp,$pnjm_id,$status_persetujuan);
			// end email

			 // log penolakan 
			 $user = $this->session->userdata('karyawan_id');
			 $status = 3;
			 $aktifitas = "Penolakan Langsung";
			 $this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
			 // end log
			$this->session->set_flashdata('success', 'Berhasil Menolak Pengajuan Peminjaman Kendaraan');

			$to = $this->mb->get($this->input->post('pnjm_id'))->row()->pnjm_nip_pengajuan;
			$this->bantuan->send_notif('Pengajuan Kendaraan',$to,'Pengajuan Kendaraan anda ditolak','SCM/detail_peminjaman_mobil/'.$this->input->post('pnjm_id'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal Menolak Pengajuan Peminjaman mobil');
		}
		redirect('SCM/persetujuan_peminjaman_mobil');
	}	

	public function add_pembatalan_pengajuan($pnjm_id = '')
	{
		$pk = $pnjm_id;
		$cek = $this->mb->get($pk);

		foreach ($cek->result() as $v) {
			$pnjm_id = $v->pnjm_id;
			$pnjm_mobil_id = $v->pnjm_mobil_id;
			$tmp = $v->tmp;
			$tsp = $v->tsp;
			$extend = $v->extend;
		}

		if ($extend != "") {
			$get_tsp = $extend;
		}else{
			$get_tsp = $tsp;
		}

		$where = "pnjm_mobil_id='$pnjm_mobil_id' and status_pengajuan = '3' AND tmp BETWEEN '$tmp' and '$get_tsp' OR tsp BETWEEN '$tmp' and '$get_tsp' OR '$tmp' BETWEEN tmp and tsp OR '$get_tsp' BETWEEN tmp AND tsp";
		$this->db->select('*');
		$q = $this->db->get_where('pnjm_pengajuan',$where);
		foreach ($q->result() as $row) {
			if ($pnjm_mobil_id == $row->pnjm_mobil_id && $row->status_pengajuan == '3') {

				 $pnjm_id =  $row->pnjm_id;
				 $user = $this->session->userdata('karyawan_id');
				 $status = 10;
				 $aktifitas = "Pembatalan Penolakan Prioritas Kendaraan Dengan Id Prioritas : ".$pk;
				 $this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);

				$dt_update_ditolak_dikembalikan = array(
					'status_pengajuan' => '1' // status dijadikan seperti saat pengajuan
						);
				$this->db->where('pnjm_id',$row->pnjm_id);			
				$this->db->update('pnjm_pengajuan', $dt_update_ditolak_dikembalikan);
				 
			}
		}
		$dt_update_pembatalan = array(
			'status_pengajuan' => '6' //dibatalkan
		);	
		$this->db->where('pnjm_id', $pk);
		$this->db->update('pnjm_pengajuan', $dt_update_pembatalan);

		$dt_insert_pembatalan = array(
			'pnjm_id' => $pk,
			'pnjm_persetujuan_nip' => $this->session->userdata('karyawan_id'),
			'pnjm_status_keterangan' => 'Pembatalan Pengajuan',

		);
		$this->db->insert('pnjm_persetujuan_mobil', $dt_insert_pembatalan);
		if(!empty($pk)){
			// log pembatalan 
			$pnjm_id = $pk;
			$user = $this->session->userdata('karyawan_id');
			$status = 4;
			$aktifitas = "Pembatalan Langsung";
			$this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
			// end log
			$this->session->set_flashdata('success', 'Berhasil Membatalkann Pengajuan Peminjaman mobil');
		}else{
			$this->session->set_flashdata('failed', 'Gagal Membatalkan Pengajuan Peminjaman mobil');
		}
		if ($this->session->userdata('level') != 71) {
			redirect('SCM/pengajuan_peminjaman_mobil');
		}else{
			redirect('SCM/persetujuan_peminjaman_mobil');
		}
		
	}

	
	// master data mobil
	public function get_device_po_item_id()
	{
		$po_item_id = $this->input->get('id');
		$this->md->see = "sd.id,sn,t.type";
		$q = $this->md->get_device_po_item_id($po_item_id);
		echo json_encode($q->result());
	}
	
	// Insert SN
	public function in_sn()
	{
		$sn = $this->input->post('sn');
		$id = $this->input->post('id');

		$msg = 'Gagal input SN';

		$type_id = '';
		$merek_id = '';
		$category = '';
		$purchase_date = '';

		$arr_sn = [];
		$c = 0;
		$this->mp->see = 'spi.id,spi.merek_id,spi.type_id,sp.category,sp.purchase_date';
		$d = $this->mp->get_po_item($id);
		if ($d->num_rows() > 0) {
			
			$dta = $d->row();

			$type_id = $dta->type_id;
			$merek_id = $dta->merek_id;
			$category = $dta->category;
			$purchase_date = $dta->purchase_date;
		}
		// $merek_id = $d->

		for ($i=0; $i < count($sn); $i++) { 
			
			$obj = [
				'sn' => $sn[$i],
				'merek_id' => $merek_id,
				'type_id' => $type_id,
				'ctddate' => date('Y-m-d'),
				'ctdby' => $this->session->userdata('karyawan_id'),
				'category' => $category,
				'po_item_id' => $id,
				'purchase_date' => $purchase_date
			];

			array_push($arr_sn,$obj);
		}

		if ($arr_sn > 0) {
			$this->db->insert_batch('scm_devices', $arr_sn);
			$c = $this->db->affected_rows();
			if ($c > 0) {
				$status = true;
				$msg = 'Berhasil input SN';
			}
		}

		$rsp = [
			'status' => $status,
			'msg' => $msg
		];

		echo json_encode($rsp);
	}

	// Data Ruangan

	public function data_ruangan()
	{
		$d = [
			'title' => 'Data Ruangan',
			'linkView' => 'page/scm/data_ruangan',
			'fileScript' => 'scm/data_ruangan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	public function dt_data_ruangan()
	{
		$this->load->model('MSCMRuangan','mscmr');
		echo $this->mscmr->dt_data_ruangan();
	}

	public function get_data_ruangan()
	{
		$this->load->model('MSCMRuangan','mscmr');
		$m = 'Gagal meload data ruangan';
		$s = false;

		$id = $this->input->get('id');

		$obj = [
			'id' => '',
			'nama_ruangan' => '',
			'aktif' => '',
		];

		$q = $this->mscmr->get_data_ruangan($id);
		if ($q->num_rows() > 0) {
			
			$x = $q->row();
			$s = true;

			$obj['id'] = $x->id;
			$obj['nama_ruangan'] = $x->nama_ruangan;
			$obj['aktif'] = $x->aktif;
			$obj['status_ruangan'] = $this->mscmr->get_status_data_ruangan($x->status_ruangan);
			$m = "Berhasil meload data ruangan";
		}
		
		$rsp = [
			'msg' => $m,
			'status' => $s,
			'data' => $obj
		];

		echo json_encode($rsp);
	}

	public function in_data_ruangan()
	{
		$this->load->model('MSCMRuangan','mscmr');
		$m = 'Gagal menambahkan ruangan';
		$s = false;

		$nama_ruangan = $this->input->post('nama_ruangan');

		$obj = [
			'nama_ruangan' => $nama_ruangan,
			'status_ruangan' => 0,	
		];

		$x = $this->mscmr->in_data_ruangan($obj);
		if ($x) {
			$s = true;
			$m = "Berhasil menambahkan ruangan";
		}

		$rsp = [
			'msg' => $m,
			'status' => $s
		];

		echo json_encode($rsp);
	}

	public function up_data_ruangan()
	{
		$this->load->model('MSCMRuangan','mscmr');
		$m = 'Gagal mengubah ruangan';
		$s = false;

		$id = $this->input->post('id');
		$nama_ruangan = $this->input->post('e_nama_ruangan');
		$aktif = $this->input->post('e_aktif');

		$obj = [
			'nama_ruangan' => $nama_ruangan,
			'aktif' => $aktif
		];

		$x = $this->mscmr->up_data_ruangan($obj,['id' => $id]);
		if ($x) {
			$s = true;
			$m = "Berhasil mengubah ruangan";
		}

		$rsp = [
			'msg' => $m,
			'status' => $s
		];

		echo json_encode($rsp);
	}

	public function set_non_aktif_data_ruangan()
	{
		$this->load->model('MSCMRuangan','mscmr');
		$m = 'Gagal mengahapus ruangan';
		$s = false;

		$id = $this->input->post('id');

		$x = $this->mscmr->set_non_aktif_data_ruangan($id);
		if ($x) {
			$s = true;
			$m = "Berhasil menghapus ruangan";
		}

		$rsp = [
			'msg' => $m,
			'status' => $s
		];

		echo json_encode($rsp);
	}

	public function set_aktif_data_ruangan()
	{
		$this->load->model('MSCMRuangan','mscmr');
		$m = 'Gagal mengembalikan data ruangan';
		$s = false;

		$id = $this->input->post('id');

		$x = $this->mscmr->set_aktif_data_ruangan($id);
		if ($x) {
			$s = true;
			$m = "Berhasil mengembalikan ruangan";
		}

		$rsp = [
			'msg' => $m,
			'status' => $s
		];

		echo json_encode($rsp);
	}

	// Peminjaman Ruangan

	public function dt_pnjm_ruangan()
    {
		$this->load->model('MSCMRuangan','mscmr');
        echo $this->mscmr->dt_pnjm_ruangan();
	}
	public function form_pengajuan_mobil($pnjm_id='')
	{
		$action='add_pengajuan_mobil';
		$data = [
			'pnjm_id' => '',
            'kode' => '',
            'nama' => '',
            'attn' => '',
            'alamat' => ''
		];
		if($pnjm_id>0){
			$dx = $this->mv->get($pnjm_id);
			$data = $dx->row_array();
			$action = 'upd_pengajuan_mobil';
		}

		$d = [
			'title' => 'form pengajuan pinjaman mobil',
			'linkView' => 'page/scm/form_pengajuan_peminjaman_mobil',
			'fileScript' => 'persetujuan_pinjaman_mobil.js',
			'titleForm' => "Form Pengajuan",
			'bread' => [
				'nama' => 'Add Pengajuan',
				'data' => [
					// ['nama' => 'List Pengajuan','link' => site_url('SCM/list_Pengajuan'),'active' => ''],
					// ['nama' => 'Add Pengajuan','link' => site_url('SCM/form_vendor'),'active' => 'active'],
					['nama' => 'List Pengajuan','link' => site_url('/'),'active' => ''],
					['nama' => 'Add Pengajuan','link' => site_url('/'),'active' => 'active'],
				]
			],
			'val' => $data,
			'action' => $action
		];
		$this->load->view('_main',$d);
	}

	public function kirim_email($from='',$to='',$subject='',$msg='',$mobil='',$wp='',$wm='',$ws='',$pnjm_id='',$status_persetujuan='')
    {
	    $nama_mobil = '';		 
		$get_mobil = $this->db->get_where('pnjm_mobil',['pnjm_id_mobil' => $mobil])->result();
		foreach ($get_mobil as $m) {
			$nama_mobil = $m->pnjm_merek_mobil;
		}
		if ($to != '') {
			if ($to == '71') {
				$e = $this->db->get_where('users',['level' => '71'])->result();
				$get_msg = '';
				foreach ($e as $v) {
					$approval = $v->email;
					$get_msg = '<p>Dear approved,<p>
					<p>Dengan Ini saya ingin mengajukan peminjaman mobil <br>
					Berikut adalah data pengajuan saya,<br>
					email   : '.$from.'<br>
					mobil   : '.$nama_mobil.'<br>
					waktu pengajuan   : '.$wp.'<br>
					waktu mulai   : '.$wm.'<br>
					waktu selesai   : '.$ws.'<br>
					Keterangan pengajuan   : '.$msg.'<br>
					
					</p>
					<p>Demikian, terimakasih.</p>
					Regards,<br>';
					$config = array(
						'protocol'      => 'mail',
						'smtp_host'     => 'mail.matrik.co.id',
						'smtp_port'     =>  465,
						'smtp_user'     => 'info@matrik.co.id',
						'smtp_pass'     => 'sahrul666!.',
						'smtp_crypto'   => 'ssl',
						'mailtype'      => 'html',
						'wordwrap'      => TRUE,
						'charset'       => 'utf-8',
						'priority'      => 1
					);
	
					$config['crlf'] = "\r\n";      //should be "\r\n"
					$config['newline'] = "\r\n";   //should be "\r\n"
					
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");
					
					// $this->email->attach('./uploads/persyaratan/' . $namaPdf . '.pdf');
					// $this->load->view('mail', $data);
	
					$this->email->to($approval);
					$this->email->from($from, 'Info Peminjaman Mobil');
					// $this->email->reply_to('info@matrik.co.id', 'Collection');
					$this->email->subject($subject);
					$this->email->message($get_msg);
					$this->email->send();

				}
			}else{
				$get_wp = '';
				$get_wm = '';
				$get_ws = '';
				$get_msg = '';
				$get_dt_msg = '';
				$data_pengajuan = $this->db->get_where('pnjm_pengajuan',['pnjm_id' => $pnjm_id])->result();
				foreach ($data_pengajuan as $dp) {
					$get_wp = $dp->pnjm_waktu_pengajuan;
					$get_wm = $dp->tmp;
					$get_ws = $dp->tsp;
					$get_msg = $dp->pnjm_keterangan;
				}
				$get_dt_msg = '<p>Dear Submission,<p>
				<p>Dengan Ini saya '.$status_persetujuan.' pengajuan peminjaman mobil yang anda ajukan<br>
				Berikut adalah data persetujuan,<br>
				email Submission  : '.$to.'<br>
				mobil   : '.$nama_mobil.'<br>
				waktu pengajuan   : '.$get_wp.'<br>
				waktu mulai   : '.$get_wm.'<br>
				waktu selesai   : '.$get_ws.'<br>
				Keterangan pengajuan   : '.$get_msg.'<br>
				</hr>
				<br>
				email approval : '.$from.'<br>
				tanggal  : '.$wp.'<br>
				status persetujuan  : '.$status_persetujuan.'<br>
				keterangan  : '.$msg.'<br>
				</p>
				<p>Demikian, terimakasih.</p>
				Regards,<br>';
				$config = array(
					'protocol'      => 'mail',
					'smtp_host'     => 'mail.matrik.co.id',
					'smtp_port'     =>  465,
					'smtp_user'     => 'info@matrik.co.id',
					'smtp_pass'     => 'sahrul666!.',
					'smtp_crypto'   => 'ssl',
					'mailtype'      => 'html',
					'wordwrap'      => TRUE,
					'charset'       => 'utf-8',
					'priority'      => 1
				);

				$config['crlf'] = "\r\n";      //should be "\r\n"
				$config['newline'] = "\r\n";   //should be "\r\n"
				
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
				
				// $this->email->attach('./uploads/persyaratan/' . $namaPdf . '.pdf');
				// $this->load->view('mail', $data);

				$this->email->to($to);
				$this->email->from($from, 'Info Peminjaman Mobil');
				// $this->email->reply_to('info@matrik.co.id', 'Collection');
				$this->email->subject($subject);
				$this->email->message($get_dt_msg);
				$this->email->send();

			}
		}
	}


	public function inv_ats()
	{
		$leader = $this->session->userdata('leader');
		if ($leader ==  1) {
			$d = [
				'title' => 'Data Pengajuan Inventori',
				'linkView' => 'page/scm/inv/inv_ats',
				'fileScript' => 'inv_ats.js',
				'bread' => [
					'nama' => 'Data Pengajuan Inventori',
					'data' => [
						//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
					]
				]
			];
			$this->load->view('_main',$d);
		}else{
			redirect('SCM/inventoryU');
		}

		


	}
	public function inv_adm()
	{
		echo "on progress";
		// $d = [
		// 	'title' => 'Data Pengajuan Inventori',
		// 	'linkView' => 'page/scm/inv/inv_ats',
		// 	'fileScript' => 'inv_ats.js',
		// 	'bread' => [
		// 		'nama' => 'Data Pengajuan Inventori',
		// 		'data' => [
		// 			//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
		// 		]
        //     ]
		// ];
		// $this->load->view('_main',$d);
		


	}
	public function inv_dt_tbl()
	{

		$level = $this->session->userdata('level');
		echo ($this->mi->inv_dt_tbl($level));


	}
	public function inv_total_ats()
	{

		$level = $this->session->userdata('level');
		$status = $this->input->post('status');
		echo ($this->mi->inv_total_ats($level,$status));


	}

	public function upd_ats()
	{
		echo json_encode($this->mi->upd_ats());
		// echo json_encode(true);
	}
	
	public function cek_bawahan($level='')
	{
		if ($this->session->userdata('leader') == 1) {
			$level = $this->session->userdata('level');
			echo json_encode($this->mi->cek_bawahan($level));
        }

		// echo ($this->mi->ce($karyawan_id,$atasan));
	}

	public function masterBarang()
	{
		$d = [
			'title' => 'Master Inventory',
			'linkView' => 'page/scm/master_barang',
			'fileScript' => 'scm/master_barang.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	public function addMasterBarangInv()
	{
		$nama_barang = $this->input->post('nama_barang');
			$var = [
				'nama_barang' => $nama_barang,
				'ctdDate' => date('Y-m-d'),
				'ctdTime' => date('H:i:s'),
				'ctdBy' => @$this->session->userdata('karyawan_id')
			];

		$q = $this->db->insert('scm_inv_data_mstr_brng',$var);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal menambahkan data baru');
		}

		echo $jsn;
	}

	public function upMasterBarangInv()
	{
		$var = [
			"nama_barang" => $this->input->post("nama_barang")
		];

		$q = $this->db->update('scm_inv_data_mstr_brng',$var,['id' => $this->input->post('id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data baru');
		}

		echo $jsn;
	}

	public function delMasterBarangInv()
	{
		$id = $this->input->get('id');
		$g = $this->db->delete('scm_inv_data_mstr_brng',['id' => $id]);
		
		echo ctojson('',1,'Sukses menghapus data');
	}

	public function dt_master_barang_inv()
	{
		echo $this->mi->dt_master_barang_inv();
	}
	
	public function inventoryu()
	{
		$d = [
			'title' => 'Inventory',
			'linkView' => 'page/scm/inventoryu',
			'fileScript' => 'scm/inventoryu.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	public function detail_inventoryu()
	{
		$d = [
			'title' => 'Detail Inventory',
			'linkView' => 'page/scm/detail_inventoryu',
			'fileScript' => 'scm/detail_inventoryu.js',
			'bread' => [
				'nama' => '',
				'data' => [
					//['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	public function getMasterBarang()
	{
		$id = $this->input->get('id');

		if ($id != '') {
			$g = $this->db->get_where('scm_inv_data_mstr_brng',['id' => $id])->row();
		}else{
			$g = $this->db->get('scm_inv_data_mstr_brng')->result();
		}
		echo json_encode($g);
	}

	public function getBrng()
    {
        $id = $this->input->get('id');
		$id_req = $this->input->get('id_req');
		$kid = $this->session->userdata('karyawan_id');
        if (!empty($id)) {
           $q = $this->mi->getBrng($id)->row();
        }if (!empty($id_req)) {
           $q = $this->mi->getBrng('',$id_req,$kid)->result();
        }
		else{
            $q = $this->mi->getBrng()->result();
        }

		$data = [
			"ttl_brng" => count($q),
			"data" => $q
		];

        echo json_encode($data);
	}

	public function getBrng2()
    {
        
            $q = $this->mi->tes()->result();

		$data = [
			"data" => $q
		];

        echo json_encode($data);
	}

	public function addReqInv()
	{
		$nama_barang = $this->input->post('nama_barang');
		$catatan = $this->input->post('catatan');

		$v = [
			'aktif' => 1,
			'ctdDate' => date('Y-m-d'),
			'ctdTime' => date('H:i:s'),
			'ctdBy' => @$this->session->userdata('karyawan_id'),
		];

		$this->db->insert('scm_inv_req',$v);
		$id_inv = $this->db->insert_id();

		$v2 = [
			'id_scm_inv_req' => $id_inv,
			'catatan' => 'Pengajuan karyawan',
			'ctdDate' => date('Y-m-d'),
			'ctdTime' => date('H:i:s'),
			'ctdBy' => @$this->session->userdata('karyawan_id'),
			'who_sts_act' => 1,
		];

		$this->db->insert('scm_inv_upd',$v2);

		for ($i=0; $i < count($catatan); $i++) {
			$var[] = [
				'id_inv_mstr_brng' => $nama_barang[$i],
				'id_inv_req' => $id_inv,
				'catatan' => $catatan[$i],	
				'ctdDate' => date('Y-m-d'),
				'ctdTime' => date('H:i:s'),
				'ctdBy' => @$this->session->userdata('karyawan_id'),
				'aktif' => 1,
			];
		}  

		$q = $this->db->insert_batch('scm_inv_req_brng',$var);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal menambahkan data baru');
		}

		$this->bantuan->send_notif_to_leader('Pengajuan','Pengajuan baru','SCM/inv_ats');

		echo $jsn;
	}


	public function dt_inventoryu()
	{
		$kid = @$this->session->userdata('karyawan_id');
		echo $this->mi->dt_inventoryu($kid);
	}


	//***Inventory Kantor***//
	public function inventory_kantor(){
		$d = [
			'title' => 'Inventory Kantor',
			'linkView' => 'page/scm/inventory_kantor',
			'fileScript' => 'scm/inventory_kantor.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
            ]
		];
		$this->load->view('_main',$d);
	}

	public function in_inventory_kantor()
	{
		$q = $this->mi->in_inventory_kantor();
		if ($q['count'] > 0) {
			$jsn = ctojson([],1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson([],0,'Gagal menambahkan data baru');
		}
		echo $jsn;
	}

	// Datatbale Inventory Kantor

	public function dt_inventory_kantor()
	{
		echo $this->mi->dt_inventory_kantor();
	}

	// Detail_Inventory_New
	public function detail_inventory_kantor()
	{
		$d = [
			'title' => 'Detail Inventory Kantor',
			'linkView' => 'page/scm/detail_inventory_new',
			'fileScript' => 'scm/detail_inventory_new.js',
			'bread' => [
				'nama' => '',
				'data' => [
				]
            ]
		];
		$this->load->view('_main',$d);
	}
	

	
}


