<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MY_controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('MKaryawan', 'mk');
        $this->load->model('MUsers', 'mu');
        $this->load->model('MJabatan', 'mj');
    }

    public function index()
    {
        $data = [
            'karyawan' => $this->mk->get()->result(),
            'jabatan' => $this->mj->get('', ['aktif' => 1])->result(),
        ];

        if ($this->input->post('btn')) {
            $this->db->update('karyawan', ['jabatan_id' => $this->input->post('jabatan')], ['id' => $this->input->post('karyawan')]);
            $this->db->update('users', ['level' => $this->input->post('jabatan')], ['id' => $this->input->post('karyawan')]);

            echo "Berhasil mengubah Jabatan" . $this->mk->get($this->input->post('karyawan'))->row()->nama . '<br>';
        }

        $this->load->view('karyawan', $data);
    }

    public function dt($status = '1')
    {
        $jabatan = $this->input->post('jabatan');
        echo ($this->mk->dt($status, $jabatan));
    }

    public function dtJabatan($status = '1')
    {
        echo ($this->mk->dtJabatan($status));
    }

    public function daftar_karyawan()
    {
        $d = [
            'title' => 'List Employes',
            'linkView' => 'page/karyawan/karyawan',
            'fileScript' => 'karyawan.js',
            'bread' => [
                'nama' => 'List Employes',
                'data' => [
                    ['nama' => 'Karyawan', 'link' => site_url('main/karyawan'), 'active' => 'active']
                ]
            ],
            'jmlActive' => $this->mk->get('', ['status' => 1])->num_rows(),
            'jmlNonActive' => $this->mk->get('', ['status' => 0])->num_rows()
        ];
        $this->load->view('_main', $d);
    }

    public function getKaryawanJson()
    {
        $this->mk->see = 'id,nip,nama,jabatan_id';
        $karyawan = $this->mk->get()->result();
        echo json_encode($karyawan);
    }

    public function getKaryJson()
    {
        $this->mk->see = 'k.id,nip,nama,jabatan_id,nma_jabatan';
        $karyawan = $this->mk->getKaryawan()->result();
        echo json_encode($karyawan);
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
            'jabatan_id' => '',
            'karyawan_id' => '',
            'status_karyawan' => '',
            'jk' => '',
            'geofence_status' => "1",
            'office_id' => "",
            'office_staff_id' => "",
            'staff_code' => "",
            "device_id" => ""
        ];

        $d = [
            'title' => 'Tambah 	Karyawan',
            'linkView' => 'page/karyawan/tambah_karyawan',
            'fileScript' => 'tambah_karyawan.js',
            'titleForm' => "Form Ubah Data Karyawan",
            'bread' => [
                'nama' => 'Tambah Karyawan',
                'data' => [
                    ['nama' => 'Daftar Karyawan', 'link' => site_url('main/karyawan'), 'active' => ''],
                    ['nama' => 'Tambah Karyawan', 'link' => site_url('main/tambah_karyawan'), 'active' => 'active'],
                ]
            ],
            'val' => $data,
            'jabatan' => $this->mj->get('', ['aktif' => 1])->result(),
            'office' => $this->mu->getOffice('', ['status' => 1])->result(),
            'office_staff' => $this->mu->getOfficeStaff('')->result(),
            'action' => 'inKaryawan'
        ];
        $this->load->view('_main', $d);
    }

    public function ubah_karyawan($id = '')
    {
        $dKaryawan = $this->mu->getUser($id);
        if ($dKaryawan->num_rows()) {
            $data = $dKaryawan->row_array();
        } else {
            $this->session->set_flashdata('gagal', 'Data tidak dapat ditemukan');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $d = [
            'title' => 'Edit Employes',
            'linkView' => 'page/karyawan/tambah_karyawan',
            'fileScript' => 'tambah_karyawan.js',
            'titleForm' => "Form Edit Employes",
            'bread' => [
                'nama' => 'Edit Employess',
                'data' => [
                    ['nama' => 'List Employes', 'link' => site_url('main/daftar_karyawan'), 'active' => ''],
                    ['nama' => 'Edit Employess', 'link' => site_url('main/ubah_karyawan'), 'active' => 'active'],
                ]
            ],
            'val' => $data,
            'jabatan' => $this->mj->get('', ['aktif' => 1])->result(),
            'office' => $this->mu->getOffice('', ['status' => 1])->result(),
            'office_staff' => $this->mu->getOfficeStaff('')->result(),
            'action' => 'upKaryawan'
        ];
        $this->load->view('_main', $d);
    }

    public function data_gaji_karyawan()
    {
        $d = [
            'title' => 'Data Gaji Karyawan',
            'linkView' => 'page/karyawan/dg_karyawan',
            'fileScript' => 'dg_karyawan.js',
            'bread' => [
                'nama' => 'Data Gaji Karyawan',
                'data' => [
                    ['nama' => 'Data Gaji Karyawan', 'link' => site_url('main/data_gaji_karyawan'), 'active' => 'active']
                ]
            ]
        ];
        $this->load->view('_main', $d);
    }

    public function lembur_karyawan()
    {
        $d = [
            'title' => 'Lembur Karyawan',
            'linkView' => 'page/karyawan/lembur_karyawan',
            'fileScript' => 'lembur_karyawan.js',
            'bread' => [
                'nama' => 'Lembur Karyawan',
                'data' => [
                    ['nama' => 'Data Lembur Karyawan', 'link' => site_url('main/lambar_karywan'), 'active' => 'active']
                ]
            ]
        ];
        $this->load->view('_main', $d);
    }

    // Action

    public function inKaryawan()
    {
        $nip = $this->input->post('nip');
        $cek_nip = $this->mk->get('', ['nip' => $nip]);
        if ($cek_nip->num_rows() > 0) {
            $this->session->set_flashdata('gagal', 'NIP sudah digunakan, silahkan masukan NIP lain');
            redirect('Karyawan/tambah_karyawan');
        } else {
            $obj = [
                'nama' => $this->input->post('nama_karyawan'),
                'nip' => $nip,
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'grade' => $this->input->post('grade'),
                'alamat_tinggal' => $this->input->post('alamat'),
                'no_rekening' => $this->input->post('no_rekening'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'jabatan_id' => $this->input->post('jabatan'),
                'status_karyawan' => $this->input->post('status_pegawai'),
                'created_by' => $this->session->userdata('id'),
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s')
            ];

            $in = $this->mk->in($obj);
            if ($in[1] == 1) {

                $data_user = [
                    'level' => $this->input->post('jabatan'),
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'email' => $this->input->post('email'),
                    'created_by' => $this->session->userdata('id'),
                    'created_date' => date('Y-m-d H:i:s'),
                    'karyawan_id' => $in[2]
                ];

                $inUser = $this->mu->in($data_user);
                if ($inUser[1] == 1) {
                    $dataNew = [
                        'nip' => $nip,
                        'name' => $this->input->post('nama_karyawan'),
                        'email' => $this->input->post('email'),
                        'status' => 1,
                        'role' => 'KARYAWAN',
                        'geotagging_status' => 1,
                        'geofence_status' => $this->input->post('geofence_status'),
                        'office_id' => $this->input->post('office_id'),
                        'staff_code' => $this->input->post('staff_code'),
                        'office_staff_id' => $this->input->post('office_staff_id'),
                        'device_id' => $this->input->post('device_id'),
                        'karyawan_id' => $in[2]
                    ];

                    $inUserNew = $this->mu->inNew($dataNew);
                    if ($inUserNew[1] == 1) {
                        $this->session->set_flashdata('success', 'Berhasil menambahkan karyawan baru');
                        redirect('karyawan/daftar_karyawan');
                    }
                }

            } else {
                $this->session->set_flashdata('failed', 'Gagal menambahkan karyawan baru');
            }
        }

        redirect('karyawan/daftar_karyawan');
    }

    public function upKaryawan()
    {
        $id = $this->input->post('id');
        $nip = $this->input->post('nip');
        $pass = $this->input->post('password');
        $cek_nip = $this->mk->get('', ['nip' => $nip, 'id !=' => $id]);

        if ($pass != '') {
            $password = md5($this->input->post('password'));
        } else {
            $password = $this->mu->getUser($id)->row()->password;
        }

        if ($cek_nip->num_rows() > 0) {
            $this->session->set_flashdata('gagal', 'NIP sudah digunakan, silahkan masukan NIP lain');
        } else {
            $obj = [
                'nama' => $this->input->post('nama_karyawan'),
                'nip' => $nip,
                'email' => $this->input->post('email'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'grade' => $this->input->post('grade'),
                'alamat_tinggal' => $this->input->post('alamat'),
                'no_rekening' => $this->input->post('no_rekening'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'jabatan_id' => $this->input->post('jabatan'),
                'jk' => $this->input->post('jk'),
                'status_karyawan' => $this->input->post('status_pegawai'),
            ];

            $up = $this->mk->up($obj, ['id' => $id]);

            // print_r($obj);
            // print_r($id);
            // die;
            if ($up) {

                $data_user = [
                    'username' => $this->input->post('username'),
                    'password' => $password,
                    'level' => $this->input->post('jabatan'),
                    'email' => $this->input->post('email'),
                ];

                $inUser = $this->mu->up($data_user, ['karyawan_id' => $id]);
                if ($inUser) {
                    $dataNew = [
                        'name' => $this->input->post('nama_karyawan'),
                        'email' => $this->input->post('email'),
                        'geofence_status' => $this->input->post('geofence_status'),
                        'office_id' => $this->input->post('office_id'),
                        'staff_code' => $this->input->post('staff_code'),
                        'office_staff_id' => $this->input->post('office_staff_id'),
                        'device_id' => $this->input->post('device_id'),
                    ];
                    $inUserNew = $this->mu->upNew($dataNew, ['karyawan_id' => $id]);
                    if ($inUserNew) {
                    $this->session->set_flashdata('success', 'Berhasil update data karyawan.');
                    }
                }

            } else {
                $this->session->set_flashdata('failed', 'Gagal menambahkan karyawan baru');
            }
        }

        redirect('karyawan/daftar_karyawan');
    }

    public function getKaryawanSlip($id = '')
    {
        $q = [];
        $msg = '';
        $status = 0;

        if ($id != '') {
            $kar = $this->mk->get($id);
            if ($kar->num_rows() > 0) {
                $k = $kar->row();
                $q = [
                    'idslip' => 'MD' . date('Ym') . $k->id,
                    'nama' => $k->nama,
                    'gj' => $k->gaji_pokok,
                    'jabatan' => @$this->mj->get($k->jabatan_id)->row()->nma_jabatan,
                    'direktorat' => $k->direktorat,
                    'golongan' => $k->gol,
                    'departemen' => $k->departemen,
                    'status_karyawan' => $this->setStatusKaryawan($k->status_karyawan),
                ];
                $msg = "Data ditemukan";
                $status = 1;

            } else {
                $msg = "Data tidak ditemukan";
            }
        }

        $arr = [
            'data' => $q,
            'msg' => $msg,
            'status' => $status
        ];

        echo json_encode($arr);
    }

    private function setStatusKaryawan($s = '')
    {
        if ($s != '') {
            if ($s == '1') {
                return "Kontrak";
            } else if ($s == '2') {
                return "Tetap";
            }
        }
    }

    public function getJabatanKaryawan($id = '')
    {
        $data = '';
        if ($id != '') {
            $this->mk->see = "nama,nma_jabatan,k.id,j.id as idj";
            $q = $this->mk->getKaryawan($id)->row();
        } else {
            $this->mk->see = "nama,nma_jabatan,k.id,j.id as idj";
            $q = $this->mk->getKaryawan()->result();
        }

        $data = [
            // 'jabatan' => $this->mj->get()->result(),
            'karyawan' => $q,
        ];

        echo json_encode($data);
    }

    public function getKaryawanByGrp($grp = '')
    {
        $this->mk->see = "k.id,k.nama";
        $q = $this->mk->getKaryawanByGrp($grp)->result();
        echo json_encode($q);
    }

    public function profile()
    {
        $d = [
            'title' => 'Profile',
            'linkView' => 'page/karyawan/profile',
            'fileScript' => 'profile.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '', 'link' => site_url('main/data_gaji_karyawan'), 'active' => 'active']
                ]
            ],
            'karyawan' => $this->mk->get($this->session->userdata('karyawan_id'))->row(),
            'education' => $this->db->get_where('education', ['karyawan_id' => $this->session->userdata('karyawan_id')]),
            'award' => $this->db->get_where('award', ['karyawan_id' => $this->session->userdata('karyawan_id')]),
            'skils' => $this->db->get_where('skils', ['karyawan_id' => $this->session->userdata('karyawan_id')]),
            'job_history' => $this->db->get_where('job_history', ['karyawan_id' => $this->session->userdata('karyawan_id')]),
            'pelatihan' => $this->db->get_where('pelatihan', ['karyawan_id' => $this->session->userdata('karyawan_id')]),
        ];
        $this->load->view('_main', $d);
    }

    // Education

    public function inEducation()
    {
        $obj = [
            'sekolah' => $this->input->post('sekolah'),
            'tahun_mulai' => $this->input->post('tahun_mulai'),
            'tahun_akhir' => $this->input->post('tahun_akhir'),
            'karyawan_id' => $this->session->userdata('karyawan_id')
        ];

        $q = $this->db->insert('education', $obj);

        $arr = [
            'msg' => "Success add education",
            'status' => 1
        ];

        echo json_encode($arr);
    }

    public function inAward()
    {
        $obj = [
            'award' => $this->input->post('award'),
            'keterangan' => $this->input->post('keterangan'),
            'tahun' => $this->input->post('tahun'),
            'karyawan_id' => $this->session->userdata('karyawan_id')
        ];

        $q = $this->db->insert('award', $obj);

        $arr = [
            'msg' => "Success add Award",
            'status' => 1
        ];

        echo json_encode($arr);
    }

    public function inSkill()
    {
        foreach ($this->input->post('skill') as $s) {
            $obj = [
                'skill' => $s,
                'karyawan_id' => $this->session->userdata('karyawan_id')
            ];
            $q = $this->db->insert('skils', $obj);
        }

        $arr = [
            'msg' => "Success add Skils",
            'status' => 1
        ];

        echo json_encode($arr);
    }

    public function inJobHistory()
    {
        $obj = [
            'jabatan' => $this->input->post('jabatan'),
            'perusahaan' => $this->input->post('perusahaan'),
            'tahun' => $this->input->post('tahun'),
            'karyawan_id' => $this->session->userdata('karyawan_id')
        ];

        $q = $this->db->insert('job_history', $obj);

        $arr = [
            'msg' => "Success add Professional Experience ",
            'status' => 1
        ];

        echo json_encode($arr);
    }

    public function inPelatihan()
    {
        $obj = [
            'pelatihan' => $this->input->post('pelatihan'),
            'oleh' => $this->input->post('oleh'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'karyawan_id' => $this->session->userdata('karyawan_id')
        ];

        $q = $this->db->insert('pelatihan', $obj);

        $arr = [
            'msg' => "Success add Training ",
            'status' => 1
        ];

        echo json_encode($arr);
    }

    public function edit_profile()
    {
        $d = [
            'title' => 'Edit Profile',
            'linkView' => 'page/karyawan/edit_profile',
            'fileScript' => 'edit_profile.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '', 'link' => site_url('main/data_gaji_karyawan'), 'active' => 'active']
                ]
            ],
            'karyawan' => $this->mk->get($this->session->userdata('karyawan_id'))->row()
        ];
        $this->load->view('_main', $d);
    }

    public function upProfile()
    {
        $foto = '';
        $cv = $this->do_upload('cv', './data/cv/')[1];
        $foto = $this->do_upload('foto', './data/foto_profile/')[1];
        // $oldPass = $this->input->post('old');
        $newPass = $this->input->post('new');
        $rePass = $this->input->post('retype');
        $uid = $this->session->userdata('karyawan_id');

        if ($newPass != '' || $rePass != '') {
            if ($newPass == $rePass) {
                $dt = [
                    'password' => md5($newPass),
                ];
                $this->db->update('users', $dt, ['karyawan_id' => $uid]);
            }
        }

        if ($cv == '') {
            $cv = $this->input->post('h_cv');
        }

        if ($foto == '') {
            $foto = $this->input->post('h_foto');
        }


        $data = [
            'nama' => $this->input->post('nama'),
            'agama' => $this->input->post('agama'),
            'tempat_tinggal' => $this->input->post('tempat_tinggal'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jk' => $this->input->post('jk'),
            'marital' => $this->input->post('marital'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'alamat_tinggal' => $this->input->post('alamat_tinggal'),
            'objektif' => $this->input->post('objektif'),
            'kualifikasi' => $this->input->post('kualifikasi'),
            'cv' => $cv,
            'foto' => $foto,
        ];

        $this->db->update('users', ['email' => $this->input->post('email')], ['karyawan_id' => $uid]);
        $q = $this->db->update('karyawan', $data, ['id' => $this->session->userdata('karyawan_id')]);
        $arr = [
            'msg' => 'Success to update employes',
            'status' => 1
        ];

        echo json_encode($arr);

    }

    public function do_upload($name = '', $path = '')
    {
        $this->load->library('upload');

        $d = '';
        $s = 0;
        $msg = '';

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'pdf|jpg|png|jpeg';
        $config['max_size'] = 0;
        $config['max_width'] = 0;
        $config['max_height'] = 0;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
            $msg = $this->upload->display_errors();
        } else {
            $d = $this->upload->data()['file_name'];
            $s = 1;
        }

        return [$s, $d, $msg, $this->upload->data(), $config];
    }

    public function getKaryawanLevel()
    {
        $level = [];
        $this->mk->see = 'id,nama,jabatan_id';
        $lvl = $this->input->get('level');
        $level = explode(',', $lvl);
        $q = $this->mk->getKaryawanLevel($level);

        echo json_encode($q->result());
    }

    // Setnonaktif

    public function set_nonaktif($id = '')
    {
        if ($id != '') {
            $q = $this->db->delete('karyawan', ['id' => $id]);
            if ($q) {
                $this->session->set_flashdata('success', 'Berhasil menghapus data karyawan');
            } else {
                $this->session->set_flashdata('success', 'Gagal menghapus data karyawan');
            }
        }
        redirect('karyawan/daftar_karyawan');
    }

}
