<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Privilage extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('MJabatan','mj');
        $this->load->model('MPrivilage','mp');
        $this->load->helper('custom');
        $this->load->model('MKaryawan','mk');
        
    }
    
    // Privilage
    
    public function privilage_menu()
    {
        $d = [
            'title' => 'Privilage',
            'linkView' => 'page/privilage/privilage_menu',
            'fileScript' => 'pri_menu.js',
            'dtRahasia' => 'dtMyticket/1',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '','link' => '','active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }
    
    public function privilage_submenu()
    {
        $d = [
            'title' => 'Privilage',
            'linkView' => 'page/privilage/privilage_submenu',
            'fileScript' => 'pri_submenu.js',
            'dtRahasia' => 'dtMyticket/1',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '','link' => '','active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }
    
    public function privilage()
    {
        $d = [
            'title' => 'Privilage',
            'linkView' => 'page/privilage/privilage',
            'fileScript' => 'privilage/privilage.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '','link' => '','active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }

    // Jabatan

    public function getJabatan($id='')
    {
        if ($id != '') {
            $q = $this->mj->get($id);
            $r = $q->row();
        }else{
            $q = $this->mj->get();
            $r = $q->result();
        }
        
        if ($q->num_rows() > 0) {
           echo json_encode($r);
        }
    }

    // Menu

    public function getMenu($id='')
    {
        echo ctojson($this->mp->getMenuJson($id),1,'Berhasil menampilkan data');
    }

    public function getMenuJab($id='')
    {
        echo ctojson($this->mp->getMenuJabJson($id)[0],1,'Berhasil menampilkan data',$this->mp->getMenuJabJson($id)[1]);
    }

    public function dtMenu()
    {
        echo $this->mp->dtMenu();
    }

    public function inAccMenu()
    {
        
        $obj = [
            'menu' => $this->input->post('menu'),
            'jabatan_id' => $this->input->post('jabatan_id'),
            'created_date' => date('Y-m-d'),
            'created_by' => $this->session->userdata('karyawan_id'),
        ];

        $this->db->insert('m_access', $obj);
        if ($this->db->affected_rows() > 0) {
            $resl = ctojson('',1,'Berhasil menambah data');
        }else{
            $resl = ctojson('',0,'Gagal menambah data');
        }

        echo $resl;
        
    }

    public function upAccMenu()
    {
        
        $obj = [
            'menu' => $this->input->post('menu'),
            'jabatan_id' => $this->input->post('jabatan_id'),
            'created_date' => date('Y-m-d'),
            'created_by' => $this->session->userdata('karyawan_id'),
        ];

        $this->db->update('m_access', $obj,['id' => $this->input->post('id')]);
        if ($this->db->affected_rows() > 0) {
            $resl = ctojson('',1,'Berhasil mengubah data');
        }else{
            $resl = ctojson('',0,'Gagal mengubah data');
        }

        echo $resl;
        
    }

    public function deAccMenu()
    {
        $this->db->delete('m_access',['id' => $this->input->post('id')]);
        if ($this->db->affected_rows() > 0) {
            $resl = ctojson('',1,'Berhasil delete data');
        }else{
            $resl = ctojson('',0,'Gagal delete data');
        }

        echo $resl; 
    }

    // Submenu

    public function getSubmenu($id='')
    {
        echo ctojson($this->mp->getSubmenuJson($id)[0],1,'Berhasil menampikan data',$this->mp->getSubmenuJson($id)[1]);
    }

    public function getSubmenuMen($id='')
    {
        echo ctojson($this->mp->getSubmenuMenJson($id)[0],1,'Berhasil menampikan data',$this->mp->getSubmenuJson($id)[1]);
    }

    public function dtSubmenu()
    {
        echo $this->mp->dtSubmenu();
    }

    public function inAccSubmenu()
    {
        
        $obj = [
            'm_access_id' => $this->input->post('menu_id'),
            'submenu' => $this->input->post('submenu'),
            'fitur' => $this->input->post('fitur'),
            'created_date' => date('Y-m-d'),
            'created_by' => $this->session->userdata('karyawan_id'),
        ];

        $this->db->insert('m_sub_access', $obj);
        if ($this->db->affected_rows() > 0) {
            $resl = ctojson('',1,'Berhasil menambah data');
        }else{
            $resl = ctojson('',0,'Gagal menambah data');
        }

        echo $resl;
        
    }

    public function upAccSubmenu()
    {
        
        $obj = [
            'm_access_id' => $this->input->post('menu_id'),
            'submenu' => $this->input->post('submenu'),
            'fitur' => $this->input->post('fitur'),
            'created_date' => date('Y-m-d'),
            'created_by' => $this->session->userdata('karyawan_id'),
        ];

        $this->db->update('m_sub_access', $obj,['id' => $this->input->post('id')]);
        if ($this->db->affected_rows() > 0) {
            $resl = ctojson('',1,'Berhasil mengubah data');
        }else{
            $resl = ctojson('',0,'Gagal mengubah data');
        }

        echo $resl;
        
    }

    public function deAccSubmenu()
    {
        $this->db->delete('m_sub_access',['id' => $this->input->post('id')]);
        if ($this->db->affected_rows() > 0) {
            $resl = ctojson('',1,'Berhasil hapus data');
        }else{
            $resl = ctojson('',0,'Gagal hapus data');
        }

        echo $resl;
        
    }
    
    // Privilage

    public function dtPrivilage()
    {
        echo $this->mp->dtPrivilage();
    }

    public function inPrivilage()
    {
        $fitur = '';
        if ($this->input->post('c')) {
           $fitur .= 'c,'; 
        }
        
        if($this->input->post('u')){
            $fitur .= 'u,';
        }
        
        if($this->input->post('d')){
            $fitur .= 'd,';
        }
        
        if($this->input->post('h')){
            $fitur .= 'h,';
        }

        $men = explode('.',$this->input->post('menu'));
        $sub = explode('.',$this->input->post('submenu'));
        $kar = explode('.',$this->input->post('karyawan'));

        $cek = $this->db->get_where('p_access',['sub_acc_id' => $sub[0],'karyawan_id' => $kar[0]]);
        if ($cek->num_rows()>0) {
            $resl = ctojson('',0,'Menu tersebut sudah terinput!');
        }else{
            $obj = [
                'parent_id' => $this->session->userdata('karyawan_id'),
                'karyawan_id' => $kar[0],
                'm_access_id' => $men[0],
                'sub_acc_id' => $sub[0],
                'created_by' => $this->session->userdata('karyawan_id'),
                'fitur' => $fitur,
                'date' => date('Y-m-d')
            ];

            $this->db->insert('p_access', $obj);
            $x = $this->db->affected_rows();
            if ($x > 0) {
                $resl = ctojson('',1,'Berhasil menambah data');
            }else{
                $resl = ctojson('',0,'Gagal menambah data');
            }
        }

        echo $resl;
            
    }

    public function getKaryawanPriv($id='')
    {
        $kary = [];
        $karp = [];

        $this->mk->see = 'k.id,nama,jabatan_id';
        if ($id != '') {    
            $k = $this->mk->getKarJab()->result();
        }else{
            $k = $this->mk->getKarJab()->result();
        }

        $parent = $this->db->get_where('karyawan',['id' => $this->session->userdata('karyawan_id')])->row();
        $karp = [
            'id' => $parent->id,
            'nama' => $parent->nama,
            'jabatan_id' => $parent->jabatan_id,
        ];
        
        array_push($k,$karp);
        
        echo json_encode($k);
    }

    public function detail_priv($kar_id='')
    {
        $kar = [];
        $submenu = [];
        $menu = [];

        if($kar_id != ''){

            // Get Nama karyawan dan jabatan
            $this->mk->see = 'k.id,nama,nma_jabatan as jabatan';
            $k = $this->mk->getKaryawan($kar_id)->row();
            array_push($kar, [
                'nama' => $k->nama,
                'jabatan' => $k->jabatan
            ]);
            
             // Get Menu dari p_access
            $men = $this->mp->getMenuPacc($kar_id);
            if ($men->num_rows() > 0 ) {
               $m = $men->result();
               foreach ($m as $v) {
                array_push($menu, [
                    'id_m' => $v->id,
                    'menu' => $v->menu
                ]);
               }
            }

            // Get Submenu dari p_access
            $sub = $this->mp->getSubmenuPacc($kar_id);
            if ($sub->num_rows() > 0 ) {
                $s = $sub->result();
                foreach ($s as $v) {
                    array_push($submenu, [
                        'id_s' => $v->id,
                        'm_id' => $v->m_access_id,
                        'fitur' => $v->fitur,
                        'submenu' => $v->submenu
                    ]);
                }
             }
           
             array_push($kar,['menu' => $menu]);
             array_push($kar,['submenu' => $submenu ]);
             
        }

        echo json_encode($kar);
    }

}
