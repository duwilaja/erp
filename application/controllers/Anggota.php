
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('MKaryawan','mk');
        $this->load->model('MUsers','mu');
    }
    
    public function dtAnggota()
    {
        echo $this->mk->dtAnggota();
    }
    
    public function list_anggota()
	{
		$d = [
			'title' => 'Daftar Anggota',
			'linkView' => 'page/anggota/list_anggota',
			'fileScript' => 'anggota/list_anggota.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('customers/list_costumer'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }
    
    public function getAnggota()
    {
       $status = false;
       $msg = "Gagal meload data";
       $data = [];

       $id = $this->input->get('id');

       if ($id != '') {
            $this->mu->see = "k.id,k.nama,k.alokasi_cust,u.group";
            $x = $this->mu->getUser($id);
            $k = $x->row();
        }else{
            $this->mk->see = "j.id,k.id as karyawan_id,k.alokasi_cust,k.nama,j.nma_jabatan";
            $x = $this->mk->getKaryawanNotParent();
            $k = $x->result();
        }
       
       if ($x->num_rows() > 0) {
           $status  = true;
           $msg = "Berhasil meload data";
           $data = $k;
       }

       $res = [
           'data' => $data,
           'status' => $status,
           'msg' => $msg
       ];

       echo json_encode($res);
    }

	public function addAnggota()
	{
        $status = false;
        $msg = "Gagal menambahkan data";
        $data = [];

		$group = $this->input->post('group');
        $dt = $this->input->post('karyawan');
        $x = explode('|',$dt);
        
        $q = $this->db->update('jabatan', ['parent_id' => $this->session->userdata('level')],['id' => $x[0]]);
        $q2 = $this->mu->up(['group' => $group],['karyawan_id' => $x[1] ]);
        
        $status = true;
        $msg = "Berhasil menambahkan anggota baru";
        
        $res = [
            'data' => $data,
            'status' => $status,
            'msg' => $msg
        ];

		echo json_encode($res);
    }
    
    public function deAnggota()
	{
        $status = false;
        $msg = "Gagal hapus data";
        $data = [];

		$id = $this->input->post('id');
        
        $jabatan = $this->mk->get($id)->row()->jabatan_id;
        $q = $this->db->update('jabatan', ['parent_id' => ''],['id' => $jabatan]);
        if ($this->db->affected_rows() > 0) {
           $status = true;
           $msg = "Berhasil hapus anggota";
           $this->mu->up(['group' => ''],['karyawan_id' => $id]);
        }
        
        $res = [
            'data' => $data,
            'status' => $status,
            'msg' => $msg
        ];

		echo json_encode($res);
	}

	public function editAnggota()
	{
		$status = false;
        $msg = "Gagal mengubah data";
        $data = [];

		$karyawan_id = $this->input->post('id');
		$group = $this->input->post('e_group');
        
        $q = $this->mu->up(['group' => $group],['karyawan_id' => $karyawan_id ]);
        if ($q[1]) {
           $status = true;
           $msg = "Berhasil mengubah anggota ";
        }
        
        $res = [
            'data' => $data,
            'status' => $status,
            'msg' => $msg
        ];

		echo json_encode($res);
	}


	// public function deAnggota($id='')
	// {
	// 	$de = $this->db->delete('anggota',['id' => $id]);
        
    //     if ($de) {
	// 		$arr = [
	// 			'msg' => $msg,
	// 			'status' => $status
	// 		];
	// 	}

	// 	echo json_encode($arr);
	// }
	
}
