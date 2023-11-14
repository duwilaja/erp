<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CC extends MY_controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MCustomers','mc');
        $this->load->model('MCc','mcc');
    }
    
    public function data_master()
    {
        $d = [
            'title' => 'Data Master',
            'linkView' => 'page/cc/data_master',
            'fileScript' => 'cc.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                    ]
                ],
            ];
            $this->load->view('_main',$d);
    }

    public function dtPic()
    {
        echo $this->mc->dtPic();
    }

    public function getCustomer($id='')
    {
        if ($id != '') {
            $q = $this->mc->get($id)->row();
        }

        echo json_encode($q);
    }


    public function upCustomerPic()
    {
        $obj = [
            'pic' => $this->input->post('pic'),
            'kontak_pic' => $this->input->post('kontak_pic'),
            'lokasi' => $this->input->post('lokasi'),
            'nama_customer' => $this->input->post('customer'),
            'alamat' => $this->input->post('alamat'),
        ];
        $q = $this->db->update('customers c', $obj,['id' => $this->input->post('id')]);
        
        $data = [
            'msg' => "Sukses edit pic",
            'status' => 1
        ];

        echo json_encode($data);
    }

    public function inPic()
    {
        
    }
        
        public function data_partner()
        {
            $d = [
                'title' => 'Data Master',
                'linkView' => 'page/cc/data_partner',
                'fileScript' => 'training.js',
                'bread' => [
                    'nama' => '',
                    'data' => [
                        ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                        ]
                    ],
                ];
                $this->load->view('_main',$d);
            }
            
            public function report_list()
            {
                $d = [
                    'title' => 'Data Master',
                    'linkView' => 'page/cc/report_list',
                    'fileScript' => 'training.js',
                    'bread' => [
                        'nama' => '',
                        'data' => [
                                ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                            ]
                        ],
                    ];
                    $this->load->view('_main',$d);
                }

                public function report_weekly()
            {
                $d = [
                    'title' => 'Data Master',
                    'linkView' => 'page/cc/report_weekly',
                    'fileScript' => 'training.js',
                    'bread' => [
                        'nama' => '',
                        'data' => [
                            ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                            ]
                        ],
                    ];
                    $this->load->view('_main',$d);
                }

                public function report_monthly()
            {
                $d = [
                    'title' => 'Data Master',
                    'linkView' => 'page/cc/report_monthly',
                    'fileScript' => 'training.js',
                    'bread' => [
                        'nama' => '',
                        'data' => [
                            ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                            ]
                        ],
                    ];
                    $this->load->view('_main',$d);
                }

                // SQA

                public function sqa()
                {
                    $d = [
                        'title' => 'Data Master',
                        'linkView' => 'page/cc/sqa',
                        'fileScript' => 'cc.js',
                        'bread' => [
                            'nama' => '',
                            'data' => [
                                ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                                ]
                            ],
                            'customer' => $this->mc->get()->result()
                        ];
                        $this->load->view('_main',$d);
                    } 

                public function dtSqa()
                {
                    echo $this->mcc->dtSqa();
                }

                public function deSqa($id='')
                {
                    $this->mcc->deSqa($id);
                    $arr = [
                        'msg' => 'Success delete sqa',
                        'status' => 1
                    ];

                    echo json_encode($arr);
                }

                public function inSqa()
                {
                    $this->load->library('upload');
            
                    $f = '';
                    $msg = '';
        
                    $config['upload_path']          ='./data/sqa';
                    $config['allowed_types']        = 'xlx|xlsx|doc|docx';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;
        
                    $this->upload->initialize($config);
        
                    if (!$this->upload->do_upload('file')){
                        $msg = $this->upload->display_errors();
                    }else{
                        $f = $this->upload->data()['file_name'];
                    }

                    $d = [
                        'customer_id' => $this->input->post('customer'),
                        'file' => $f,
                        'created_date' => date('Y-m-d'),
                        'status' => 1,
                        'created_by' => $this->session->userdata('id')
                    ];

                    $dx = $this->db->insert('sqa',$d);

                    $arr = [
                        'd' => $d,
                        'msg' => 'Success add data',
                        'status' => 1
                    ];

                    echo json_encode($arr);
                }
                
                // Preventive EOS
                public function preventive_eos()
                {
                    $d = [
                        'title' => 'Data Master',
                        'linkView' => 'page/cc/preventive_eos',
                        'fileScript' => 'cc.js',
                        'bread' => [
                            'nama' => '',
                            'data' => [
                                ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                                ]
                            ],
                            'customer' => $this->mc->get()->result()
                        ];
                        $this->load->view('_main',$d);
                    }

                public function dtPreventiveEos()
                {
                    echo $this->mcc->dtPreventiveEos();
                }

                public function dePreventiveEos($id='')
                {
                    $this->mcc->dePreventiveEos($id);
                    $arr = [
                        'msg' => 'Success delete sqa',
                        'status' => 1
                    ];

                    echo json_encode($arr);
                }

                public function inPreventiveEos()
                {
                    $this->load->library('upload');
            
                    $f = '';
                    $msg = '';
        
                    $config['upload_path']          ='./data/preventive_eos';
                    $config['allowed_types']        = 'xlx|xlsx|doc|docx';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;
        
                    $this->upload->initialize($config);
        
                    if (!$this->upload->do_upload('file')){
                        $msg = $this->upload->display_errors();
                    }else{
                        $f = $this->upload->data()['file_name'];
                    }

                    $d = [
                        'customer_id' => $this->input->post('customer'),
                        'file' => $f,
                        'created_date' => date('Y-m-d'),
                        'status' => 1,
                        'created_by' => $this->session->userdata('id')
                    ];

                    $dx = $this->db->insert('peos',$d);

                    $arr = [
                        'd' => $d,
                        'msg' => 'Success add data',
                        'status' => 1
                    ];

                    echo json_encode($arr);
                }
                    
                public function preventive_ticketing()
                {
                    $d = [
                        'title' => 'Data Master',
                        'linkView' => 'page/cc/preventive_ticketing',
                        'fileScript' => 'training.js',
                        'bread' => [
                            'nama' => '',
                            'data' => [
                                    ['nama' => '','link' => site_url('Training/list_training'),'active' => 'active'],
                                ]
                            ],
                        ];
                        $this->load->view('_main',$d);
                    }
                    
                }
                