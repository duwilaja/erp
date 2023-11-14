<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lab extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MMenu','m');
    }
    
    public function index()
    {
        // echo json_encode($this->bantuan->menu());
    }

    public function dtMenu()
    {
        $status = $this->input->get('status');
        echo $this->m->dtMenu($status);
    }

    public function add_hak_akses()
    {
        $d = [
            'title' => 'Hak Akses',
            'linkView' => 'page/lab/add_hak_akses',
            'fileScript' => 'lab/add_hak_akses.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => 'List Attendance','link' => '','active' => ''],
                ]
            ]
        ];
        
        $this->load->view('_main',$d);
    }

    public function hak_akses()
    {
        $d = [
            'title' => 'Hak Akses',
            'linkView' => 'page/lab/hak_akses',
            'fileScript' => 'lab/hak_akses.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => 'List Attendance','link' => '','active' => ''],
                ]
            ]
        ];
        
        $this->load->view('_main',$d);
    }

    public function getIdMS($id_menu='')
    {
        if ($id_menu != '') {
            $men = $this->m->menu($id_menu)->row();
            $sub = $this->m->submenu('',$id_menu)->result();
            $menus = [
                'menu' => $men,
                'submenu' => $sub
            ];
        }

        echo json_encode($menus);
    }

    public function addHakAkses()
    {
        $level = ',';
        $block = ',';
        $sub_block = ',';
        $type  = 1;
        $submenus = [];
        $submenu = [];
        $count_subm = 0;
        $status = false;
        $msg = "Gagal tambah menu";
       
        $pblock = $this->input->post('block');
        $plevel = $this->input->post('level');
        

        $submenu = $this->input->post('submenu');
        if (isset($submenu)) {
            $type  = 2;
        }

        if (isset($plevel)) {
            foreach (@$plevel as $v) {
                $level .= $v.',';
            }
        }


        if (isset($pblock)) {
            foreach (@$pblock as $v) {
                $block .= $v.',';
            }
        }
       
        $menu = [
            'urutan' => $this->input->post('urutan'),
            'menu' => $this->input->post('menu'),
            'target' => $this->input->post('target'),
            'icon' => $this->input->post('icon'),
            'level' => $level,
            'block_id' => $block,
            'type' => $type,
            'status' => 1,
            'created_date' => date('Y-m-d'),
            'created_by' => @$this->session->userdata('karyawan_id')
        ];

        $inm = $this->m->inMenu($menu);
        if ($inm[1] == 1) {
            $psub_block = $this->input->post('sub_block');
            if (isset($psub_block)) {
                foreach (@$psub_block as $v) {
                    $sub_block .= $v.',';
                }
            }
            if ($type == 2) {
                foreach ($submenu as $k => $v) {
                    $sub = [
                        'urutan' => $this->input->post('no')[$k],
                        'menu_id' => $inm[2],
                        'submenu' => $v,
                        'target' => $this->input->post('sub_target')[$k],
                        'sub_block_id' => $sub_block,
                        'status' => 1,
                        'created_date' => date('Y-m-d'),
                        'created_by' => @$this->session->userdata('karyawan_id')
                    ];

                    $ins = $this->m->inMenuSub($sub);
                    $count_subm =+ $ins[2];
                }   
            }
        }

        if (($inm[2] > 0 && $count_subm > 0) || ($inm[2] > 0)) {
            $status = true;
            $msg = "Berhasil menambahkan menu Hak Akses";
        }

        $data = [
            'status' => $status,
            'msg' => $msg
        ];

        echo json_encode($data);
    }

    public function upHakAkses()
    {
        $level = ',';
        $block = ',';
        $sub_block = ',';
        $type  = 1;
        $submenus = [];
        $submenu = [];
        $count_subm = 0;
        $status = false;
        $msg = "Gagal tambah menu";
       
        $pblock = $this->input->post('block');
        $plevel = $this->input->post('level');
        
        $submenu = $this->input->post('submenu');
        if ($submenu != '' || @isset($submenu)) {
            $type  = 2;
        }

        if (isset($plevel)) {
            foreach (@$plevel as $v) {
                $level .= $v.',';
            }
        }


        if (@isset($pblock)) {
            foreach (@$pblock as $v) {
                $block .= $v.',';
            }
        }
       
        $menu = [
            'urutan' => $this->input->post('urutan'),
            'menu' => $this->input->post('menu'),
            'icon' => $this->input->post('icon'),
            'target' => $this->input->post('target'),
            'level' => $level,
            'block_id' => $block,
            'type' => $type,
            'status' => 1,
            'created_by' => @$this->session->userdata('karyawan_id')
        ];

        $inm = $this->m->upMenu($menu,['id' => $this->input->post('id')]);
            
            if ($type == 2) {
                foreach ($submenu as $k => $v) {
                    $sub_block = ',';
                    $psub_block = @$this->input->post('sub_block')[$this->input->post('id_sub')[$k]];
                    if (isset($psub_block)) {
                        foreach (@$psub_block as $x) {
                            $sub_block .= $x.',';
                        }
                    }
                    // echo $sub_block;
                    $sub = [
                        'urutan' => $this->input->post('no')[$k],
                        'submenu' => $v,
                        'target' => $this->input->post('sub_target')[$k],
                        'sub_block_id' => $sub_block,
                        'status' => 1,
                        'created_by' => @$this->session->userdata('karyawan_id')
                    ];

                    array_push($submenus,$sub);

                    $ins = $this->m->upMenuSub($sub,['id' => $this->input->post('id_sub')[$k]]);

                    if ($this->input->post('id_sub')[$k] == '' && $v != '') {
                        $sub = [
                            'urutan' => $this->input->post('no')[$k],
                            'menu_id' => $this->input->post('id'),
                            'submenu' => $v,
                            'target' => $this->input->post('sub_target')[$k],
                            'sub_block_id' => $sub_block,
                            'status' => 1,
                            'created_date' => date('Y-m-d'),
                            'created_by' => @$this->session->userdata('karyawan_id')
                        ];
    
                        $ins = $this->m->inMenuSub($sub);
                    }

                    $count_subm =+ $ins[2];
                }   
            }

        // if (($count_subm > 0) || ($inm[2] > 0)) {
            $status = true;
            $msg = "Berhasil Update Hak Akses";
        // }


        $data = [
            'status' => $status,
            'msg' => $msg,
            'sub' => $submenus
        ];

        echo json_encode($data);
    }

    public function deMenuSub()
    {
        $id = $this->input->post('id');
        return $this->m->deMenuSub($id);
    }

}

/* End of file Lab.php */
