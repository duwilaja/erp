<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presales extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MSCMDevice','md');
	}
    
	public function dm_team()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/presales/dm_team',
			'fileScript' => '',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url(''),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }
    
    public function dm_pricing()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/presales/dm_pricing',
			'fileScript' => '',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }
    
    public function presales_activity()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/presales/presales_activity',
			'fileScript' => '',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }
    
    public function file_storage()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/presales/file_storage',
			'fileScript' => '',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }

    public function precalculation()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/presales/precalculation',
			'fileScript' => '',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}
	
	public function edit_precalc()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/presales/edit_precalc',
			'fileScript' => '',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
    }

	// Merek Device

    public function merek()
    {
        $d = [
            'title' => 'Merek',
            'linkView' => 'page/presales/merek',
            'fileScript' => 'presales/merek.js',
            'bread' => [
                'nama' => 'Merek',
                'data' => [
                    ['nama' => '','link' => site_url('oprations/my_ticket'),'active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }

    public function in_merek()
    {
        $merek = $this->input->post('merek');
        $solution = $this->input->post('solution');

        $obj = [
            'solution_id' => $solution,
            'merek' => $merek,
            'ctddate' => date('Y-m-d H:i:s'),
            'ctdby' => $this->session->userdata('karyawan_id')
        ];

        $k = $this->db->insert('scm_dvc_merek', $obj);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil menambahkan Merek');
        }else{
            $resl = ctojson('',0,'Gagal menambahkan Merek');
        }

        echo $resl;
    }

    public function up_merek()
    {
        $obj = [
            'merek' => $this->input->post('e_merek'),
            'solution_id' => $this->input->post('e_solution')
        ];

        $k = $this->db->update('scm_dvc_merek', $obj,['id' => $this->input->post('e_id')]);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil mengubah Merek');
        }else{
            $resl = ctojson('',0,'Gagal mengubah Merek');
        }

        echo $resl;
    }

    public function de_merek()
    {
        $del = $this->db->delete('scm_dvc_merek',['id' => $this->input->post('id')]);
        echo ctojson('',1,'Berhasil menghapus Merek');
    }

    public function dt_merek()
    {
        echo $this->md->dt_merek();
    }  

    public function get_merek_json()
    {
        $id = $this->input->get('id');

        if ($id != '') {
            $q = $this->md->get_dvc_merek(['id' => $id])->row();
        }else{
            $q = $this->md->get_dvc_merek()->result();
		}
		
        echo json_encode($q);
	}
	
    // Type Device
    
    public function dt_type()
    {
        echo $this->md->dt_type();
    } 

    public function type()
    {
        $d = [
            'title' => 'Type',
            'linkView' => 'page/presales/type',
            'fileScript' => 'presales/type.js',
            'bread' => [
                'nama' => 'Type',
                'data' => [
                    ['nama' => '','link' => site_url('oprations/my_ticket'),'active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }

    public function in_type()
    {
        $type = $this->input->post('type');
        $merek_id = $this->input->post('merek');

        $obj = [
            'type' => $type,
            'merek_id' => $merek_id,
            'ctddate' => date('Y-m-d H:i:s'),
            'ctdby' => $this->session->userdata('karyawan_id')
        ];

        $k = $this->db->insert('scm_dvc_type', $obj);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil menambahkan Type');
        }else{
            $resl = ctojson('',0,'Gagal menambahkan Type');
        }

        echo $resl;
    }

    public function up_type()
    {
        $obj = [
            'type' => $this->input->post('e_type'),
            'merek_id' => $this->input->post('e_merek'),
        ];

        $k = $this->db->update('scm_dvc_type', $obj,['id' => $this->input->post('e_id')]);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil mengubah Type');
        }else{
            $resl = ctojson('',0,'Gagal mengubah Type');
        }

        echo $resl;
    }

    public function de_type()
    {
        $del = $this->db->delete('scm_dvc_type',['id' => $this->input->post('id')]);
        echo ctojson('',1,'Berhasil menghapus Type');
    }

    public function get_type_json()
    {
        $id = $this->input->get('id');
        $merek_id = $this->input->get('merek_id');

        if ($id != '') {
            $q = $this->md->get_dvc_type(['id' => $id])->row();
        }else if ($merek_id != '') {
            $q = $this->md->get_dvc_type(['merek_id' => $merek_id])->result();
        }else{
            $q = $this->md->get_dvc_type()->result();
		}
		
        echo json_encode($q);
    }
}
