<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MProduct','mp');
    }
    
    public function dt($status='1')
    {
        echo ($this->mk->dt($status));
    }

    public function list_product()
	{
		$d = [
			'title' => 'List Product',
			'linkView' => 'page/product/product',
			'fileScript' => 'product.js',
			'bread' => [
				'nama' => 'List Product',
				'data' => [
					['nama' => 'Product','link' => site_url('main/product'),'active' => 'active']
				]
            ],
            'jmlActive' => $this->mk->get('',['status' => 1])->num_rows(),
            'jmlNonActive' => $this->mk->get('',['status' => 0])->num_rows()
		];
		$this->load->view('_main',$d);
	}
	
	public function add_product()
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
            'product_id' =>'',
            'status_product' => '',
            'jk' => ''
		];

		$d = [
			'title' => 'Add Product',
			'linkView' => 'page/product/add_product',
			'fileScript' => 'add_product.js',
			'titleForm' => "Form Ubah Data Product",
			'bread' => [
				'nama' => 'Add Product',
				'data' => [
					['nama' => 'List Product','link' => site_url('main/product'),'active' => ''],
					['nama' => 'Add Product','link' => site_url('main/add_product'),'active' => 'active'],
				]
			],
			'val' => $data,
			'jabatan' => $this->mj->get()->result(),
			'action' => 'inProduct'
		];
		$this->load->view('_main',$d);
    }
    
	public function edit_product($id='')
	{		
		$dProduct = $this->mu->getUser($id);
		if ($dProduct->num_rows()) {
			$data = $dProduct->row_array();
		}else{
			$this->session->set_flashdata('gagal', 'Data tidak dapat ditemukan');
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$d = [
			'title' => 'Edit Product',
			'linkView' => 'page/product/add_product',
			'fileScript' => 'add_product.js',
			'titleForm' => "Form Edit Product",
			'bread' => [
				'nama' => 'Edit Products',
				'data' => [
					['nama' => 'List Product','link' => site_url('main/daftar_product'),'active' => ''],
					['nama' => 'Edit Products','link' => site_url('main/edit_product'),'active' => 'active'],
				]
			],
			'val' => $data,
			'jabatan' => $this->mj->get()->result(),
			'action' => 'upProduct'
		];
		$this->load->view('_main',$d);
	}


    // Action
    
    public function inProduct()
    {
        $nip = $this->input->post('nip');
        $cek_nip = $this->mk->get('',['nip' => $nip ]);
        if ($cek_nip->num_rows() > 0) {
            $this->session->set_flashdata('gagal', 'NIP sudah digunakan, silahkan masukan NIP lain');
            redirect('main/add_product');
        }else{
            $obj = [
                'nama' => $this->input->post('nama_product'),
                'nip' => $nip,
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'alamat_tinggal' => $this->input->post('alamat'),
                'no_rekening' => $this->input->post('no_rekening'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'jabatan_id' => $this->input->post('jabatan'),
                'status_product' => $this->input->post('status_pegawai'),
                'created_by' => $this->session->userdata('id'),
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s')
            ];
            
            $in = $this->mk->in($obj);
            if ($in[1] == 1) {
                
                $data_user = [
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'email' => $this->input->post('email'),
                    'created_by' => $this->session->userdata('id'),
                    'created_date' => date('Y-m-d H:i:s'),
                    'product_id' => $in[2]
                ];
                
                $inUser = $this->mu->in($data_user);
                if ($inUser[1] == 1) {
                    $this->session->set_flashdata('success', 'Berhasil menambahkan product baru');
                    redirect('main/daftar_product');
                }
                
            }else{
                $this->session->set_flashdata('failed', 'Gagal menambahkan product baru');
            }
        }
        
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function upProduct()
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
                'nama' => $this->input->post('nama_product'),
                'nip' => $nip,
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'alamat_tinggal' => $this->input->post('alamat'),
                'no_rekening' => $this->input->post('no_rekening'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'jabatan_id' => $this->input->post('jabatan'),
                'jk' => $this->input->post('jk'),
                'status_product' => $this->input->post('status_pegawai'),
            ];
            
            $up = $this->mk->up($obj,['id' => $id]);
            if ($up) {
                
                $data_user = [
                    'username' => $this->input->post('username'),
                    'password' => $password,
                    'email' => $this->input->post('email'),
                ];
                
                $inUser = $this->mu->up($data_user,['product_id' => $id]);
                if ($inUser[1] == 1) {
                    $this->session->set_flashdata('success', 'Berhasil menambahkan product baru');
                }
                
            }else{
                $this->session->set_flashdata('failed', 'Gagal menambahkan product baru');
            }
        }
        
        redirect('main/daftar_product');
    }

    public function getProduct($id='')
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
    
}
