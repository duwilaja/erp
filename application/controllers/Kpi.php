<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MKpi','mkpi');
        $this->load->model('MKaryawan','mk');
        $this->load->model('MJabatan','mj');
    }

    // VIEW

    // menu kpi
    public function list_kpi()
	{
        $idj = $this->uri->segment(3);
        if ($idj == '') {
            $idj = 1;
        }
        
		$d = [
			'title' => 'List KPI',
			'linkView' => 'page/hcm/kpi',
			'fileScript' => 'list_kpi.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'KPI','link' => site_url('kpi/list_kpi'),'active' => ''],
				]
            ],
            'val' => [
                'kpiJabatan' => $this->getKpiJabatan($idj),
                'jabatan' => $this->mj->get()->result(),
                'textJabatan' => $this->mj->get($idj)->row()->nma_jabatan,
            ] 
		];
		$this->load->view('_main',$d);
    }

    public function detail_kpi($id,$idk)
	{
        if ($id == '') {
            redirect($_SERVER['HTTP_REFERER']);
        }

		$d = [
			'title' => 'List KPI',
			'linkView' => 'page/hcm/detail_kpi',
			'fileScript' => 'detail_kpi.js',
			'bread' => [
				'nama' => '',
				'data' => [
                    ['nama' => '','link' => site_url('kpi/detail_kpi'),'active' => ''],
				]
            ],
            'val' => [
                'kpiKaryawan' => $this->getKpiKaryawan($idk),
                'total_all' => $this->mkpi->getTotalAllKpi($idk),
                'nama_karyawan' => $this->mk->get($this->uri->segment(4))->row()->nama
            ]
		];
		$this->load->view('_main',$d);
    }

    public function edit_kpi()
	{
		$d = [
			'title' => 'List KPI',
			'linkView' => 'page/hcm/edit_kpi',
			'fileScript' => 'list_kpi.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'KPI','link' => site_url('kpi/edit_kpi'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}
	
	public function edit_score()
	{
		$d = [
			'title' => 'List KPI',
			'linkView' => 'page/hcm/edit_score',
			'fileScript' => 'list_kpi.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'KPI','link' => site_url('kpi/edit_kpi'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function add_kpi($idj='')
	{
		$d = [
			'title' => 'Add KPI',
			'linkView' => 'page/hcm/add_kpi',
			'fileScript' => 'add_kpi.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'List KPI','link' => site_url('kpi/list_kpi'),'active' => ''],
				]
            ],'val' => [
                'kpiJabatan' => $this->getKpiJabatan($idj),
                'jabatan' => $this->mj->get()->result(),
                'textJabatan' => $this->mj->get($idj)->row()->nma_jabatan,
            ] 
            
		];
		$this->load->view('_main',$d);
    }

    public function add_kpi_employes($idj='')
	{
		$d = [
			'title' => 'Add KPI Employes',
			'linkView' => 'page/hcm/add_kpi_employes',
			'fileScript' => 'add_kpi_employes.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'List KPI','link' => site_url('kpi/list_kpi'),'active' => ''],
				]
            ],'val' => [
                'karyawan' => $this->mk->get()->result(),
                'jabatan' => $this->mj->get()->result(),
                'textJabatan' => $this->mj->get($idj)->row()->nma_jabatan,
            ] 
            
		];
		$this->load->view('_main',$d);
    }

    // Proses KPI

    public function getKpiJabatan($id='',$return='') //menampilkan data KPI berdasarkan jabatan
    {
        $q = '';
        if ($id != '') {
           $q =  $this->mkpi->getKpiJabatan($id)->result();
        }
        if ($return == 1) {
            echo json_encode($q);
        }else{
            return $q;            
        }
    }

    public function getKpiKaryawan($id='',$return='') //menampilkan data KPI berdasarkan jabatan
    {
        $q = '';
        if ($id != '') {
           $q =  $this->mkpi->getKpiKaryawan($id)->result();
        }
        if ($return == 1) {
            echo json_encode($q);
        }else{
            return $q;            
        }
    }

    public function dtKPI()
    {
        echo $this->mkpi->dt(); 
    }

    public function ubahScore()
    {
      echo json_encode($this->mkpi->ubahScore());        
    }

    public function inKpi()
    {
       $kpiUpdate = []; 
       $kpiInsert = []; 
       $id = []; 
       
       foreach ($this->input->post('up_pg') as $k => $v) {
        $arr = [
            'jabatan_id' => $this->input->post('jabatan'),
            'pg' => $this->input->post('up_pg')[$k],
            'weight' => $this->input->post('up_weight')[$k],
            'kpi' => $this->input->post('up_kpi')[$k],
            'target' => $this->input->post('up_target')[$k],
        ];
           
        $ids = [
            'id' => $this->input->post('id')[$k],
        ];

        $this->db->update('kpi_input_jabatan', $arr,$ids);
        
       }

        foreach ($this->input->post('pg') as $k => $v) {
            if ($this->input->post('pg')[$k] != '') { 
                $arrx = [
                    'jabatan_id' => $this->input->post('jabatan'),
                    'pg' => $this->input->post('pg')[$k],
                    'weight' => $this->input->post('weight')[$k],
                    'kpi' => $this->input->post('kpi')[$k],
                    'target' => $this->input->post('target')[$k],
                ];
                array_push($kpiInsert,$arrx);
            }else{
                $this->session->set_flashdata('error', 'Data cannot be null');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

         $this->db->insert_batch('kpi_input_jabatan', $kpiInsert);
        
        $this->session->set_flashdata('success', 'Success to changes KPI');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function inKpiEmployes()
    {

       foreach ($this->input->post('id') as  $v) {
            $arr = [
                'jabatan_id' => $this->input->post('jabatan'),
                'karyawan_id' => $this->input->post('karyawan'),
                'kpi_ij' => $v,
            ];
            
            $this->db->insert('kpi_input', $arr);
        }   
    

    $this->session->set_flashdata('success', 'Success to add data KPI Employes');
    redirect($_SERVER['HTTP_REFERER']);

    }
   
   public function deKpi($id='')
   {
      $ok =  $this->db->delete('kpi_input_jabatan',['id' => $id]);
      $this->session->set_flashdata('success', 'Success remove data');
      redirect($_SERVER['HTTP_REFERER']);
   }

}

/* End of file Kpi.php */
