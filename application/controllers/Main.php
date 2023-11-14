<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MKaryawan','mk');
		$this->load->model('MUsers','mu');
		$this->load->model('MJabatan','mj');
	}
	

	// Dashboard
	public function index()
	{
		$d = [
			'title' => 'Dashboard',
			'linkView' => 'page/dashboard/dashboard',
			'fileScript' => 'dashboard.js',
			'bread' => [
				'nama' => 'Dashboard',
				'data' => [
					['nama' => 'Dashboard','link' => site_url('main/index'),'active' => 'active']
				]
			]
		];
		$this->load->view('_main',$d);
	}

	// PROJECT

	public function projek()
	{
		$d = [
			'title' => 'Project',
			'linkView' => 'page/project/project',
			'fileScript' => 'project.js',
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
			]
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
			]
		];
		$this->load->view('_main',$d);
	}

	
	public function finance()
	{
		$d = [
			'title' => 'Daftar Pengeluaran',
			'linkView' => 'page/finance/finance',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => 'Daftar Pengeluaran',
				'data' => [
					['nama' => 'Daftar Pengeluaran','link' => site_url('main/finance'),'active' => ''],
					['nama' => 'Tambah Pengeluaran','link' => site_url('main/tambah_finance'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function tambah_finance()
	{
		$d = [
			'title' => 'Tambah 	Pengeluaran',
			'linkView' => 'page/finance/tambah_finance',
			'fileScript' => 'tambah_finance.js',
			'bread' => [
				'nama' => 'Tambah Pengeluaran',
				'data' => [
					['nama' => 'Daftar Pengeluaran','link' => site_url('main/finance'),'active' => ''],
					['nama' => 'Tambah Pengeluaran','link' => site_url('main/tambah_finance'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	// hcm

	public function hcm()
	{
		$d = [
			'title' => 'Daftar Izin Cuti',
			'linkView' => 'page/hcm/hcm',
			'fileScript' => 'hcm.js',
			'bread' => [
				'nama' => 'Daftar Izin Cuti',
				'data' => [
					['nama' => 'Daftar Izin Cuti','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}


	public function daftar_karyawan()
	{
		$d = [
			'title' => 'Daftar Karyawan',
			'linkView' => 'page/karyawan/karyawan',
			'fileScript' => 'karyawan.js',
			'bread' => [
				'nama' => 'Daftar Karyawan',
				'data' => [
					['nama' => 'Karyawan','link' => site_url('main/karyawan'),'active' => 'active']
				]
			]
		];
		$this->load->view('_main',$d);
	}
	
	public function tambah_karyawan()
	{
		$data = [
            'nama' => '',
            'email' => '',
            'username' => '',
            'nip' => '',
            'tgl_lahir' => '',
            'tgl_masuk' => '',
            'alamat_tinggal' => '',
            'no_rekening' => '',
            'gaji_pokok' => '',
            'jabatan_id' =>'',
            'karyawan_id' =>'',
            'status_karyawan' => '',
            'jk' => ''
		];

		$d = [
			'title' => 'Tambah 	Pengeluaran',
			'linkView' => 'page/karyawan/tambah_karyawan',
			'fileScript' => 'tambah_karyawan.js',
			'titleForm' => "Form Ubah Data Karyawan",
			'bread' => [
				'nama' => 'Tambah Karyawan',
				'data' => [
					['nama' => 'Daftar Karyawan','link' => site_url('main/karyawan'),'active' => ''],
					['nama' => 'Tambah Karyawan','link' => site_url('main/tambah_karyawan'),'active' => 'active'],
				]
			],
			'val' => $data,
			'jabatan' => $this->mj->get('',['aktif' => 1])->result(),
			'action' => 'inKaryawan'
		];
		$this->load->view('_main',$d);
	}
	
	public function ubah_karyawan($id='')
	{		
		$dKaryawan = $this->mu->getUser($id);
		if ($dKaryawan->num_rows()) {
			$data = $dKaryawan->row_array();
		}else{
			$this->session->set_flashdata('gagal', 'Data tidak dapat ditemukan');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$d = [
			'title' => 'Ubah Karyawan',
			'linkView' => 'page/karyawan/tambah_karyawan',
			'fileScript' => 'uabh_karyawan.js',
			'titleForm' => "Form Ubah Data Karyawan",
			'bread' => [
				'nama' => 'Ubah Karyawan',
				'data' => [
					['nama' => 'Daftar Karyawan','link' => site_url('main/daftar_karyawan'),'active' => ''],
					['nama' => 'Ubah Karyawan','link' => site_url('main/ubah_karyawan'),'active' => 'active'],
				]
			],
			'val' => $data,
			'jabatan' => $this->mj->get('',['aktif' => 1])->result(),
			'action' => 'upKaryawan'
		];
		$this->load->view('_main',$d);
	}

	

	public function izin_cuti()
	{
		$d = [
			'title' => 'Izin Cuti',
			'linkView' => 'page/hcm/izin_cuti',
			'fileScript' => 'izin_cuti.js',
			'bread' => [
				'nama' => 'Izin Cuti',
				'data' => [
					['nama' => 'Daftar Izin Cuti','link' => site_url('main/hcm'),'active' => ''],
					['nama' => 'Izin Cuti','link' => site_url('main/izin_hcm'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
	}

}
