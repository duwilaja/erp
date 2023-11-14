<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUsers','mu');        
        $this->load->model('MAbsen','ma');
    }
    
    public function index()
    {
        $this->load->view('welcome_message');
    }
    
    private function upload($path,$files,$types="jpg|png|jpeg|svg")
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => $types,
            'encrypt_name'  => true,
            'max_size'      => 0,
            'max_width'     => 0,
            'max_height'    => 0,                   
        );
        
        $this->load->library('upload', $config);
        
        $images = array();
        
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];
            
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('images[]')) {
                $images[] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        
        return $images;
    }
    
    private function token()
    {
        $token = @getallheaders()['token'];
        
        if (!$token) {
            # jika array kosong, dia akan melempar objek Exception baru
            throw new Exception('Header Token tidak terdeteksi');
        }
        
        return $token;
    }
    
    private function header($method="POST")
    {
        header("Content-Type: application/json; charset=UTF-8");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: ".$method);
        header("Access-Control-Allow-Headers: Content-Type, Token");
        
        return true;
    }
    
    private function cek_token()
    {
        $bool = false;
        $q = $this->db->get_where('token', ['token' => $this->token(),'aktif' => 1]);
        if ($q->num_rows() > 0) 
        $bool = true;
        
        return $bool;
    }
    
    // Login Petugas
    public function auth_erp()
    {        
        $this->header();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
            $data = [];
            $status = false;
            $statusCode = 200;
            $msg = "Gagal login ke aplikasi";
            
            if (empty($this->input->post())) {
                $msg = "Tidak ada data yang dikirim";
                $statusCode = 410;
            }else{
                try {   
                    if ($this->cek_token()) {
                        $username = $this->input->post('username');
                        $password = $this->input->post('password');
                        
                        if ($username == '') {
                            $msg = "Username tidak boleh kosong";
                        }else if($password == ''){
                            $msg = "Password tidak boleh kosong";
                        }else{
                            $q = $this->db->get_where('users',[
                                'username' => $username,
                                'password' => md5($password),
                                'level !=' => ''
                            ]);
                            if ($q->num_rows() > 0) {
                                
                                $u = $q->row();
                                $jabatan = $this->db->get_where('jabatan',['id' => $u->level])->row();
                                $karyawan = $this->db->get_where('karyawan k', [
                                    'id' => $u->karyawan_id
                                ])->row();
                                
                                
                                $data = array(
                                    'id' => $u->id,
                                    'level' => $u->level,
                                    'leader' => $jabatan->leader,
                                    'grp' => $jabatan->grp_jabatan_id,
                                    'posisi' => $jabatan->nma_jabatan,
                                    'group' => $u->group,
                                    'email' => $u->email,
                                    'nama' => $karyawan->nama,
                                    'username' => $u->username,
                                    'karyawan_id' => $u->karyawan_id,
                                );
                                
                                $msg = "Berhasil login ke aplikasi";
                                $status = true; 
                            }
                        }
                    }
                } catch (Exception $error) {
                    $statusCode = 417;
                    $msg = $error->getMessage();
                }
            }
            
            $arr = [
                'data' => $data,
                'msg' => $msg,
                'statusCode' => $statusCode,
                'status' => $status
            ];
            
            echo json_encode($arr);
        }
        
    }
    
    // Get Rekap Absen
    public function get_rekap_absen()
    {        
        $this->header();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
            $data = [];
            $status = false;
            $statusCode = 200;
            $msg = "Gagal mendapatkan data rekap absen";
            
            if (empty($this->input->post())) {
                $msg = "Tidak ada data yang dikirim";
                $statusCode = 410;
            }else{
                try {   
                    if ($this->cek_token()) {
                        $karyawan_id = $this->input->post('karyawan_id');
                        $q = $this->ma->get([
                            'ao.id,ao.status_in,ao.status_out,k.nama,ao.jam_masuk,ao.jam_keluar,ao.tanggal,ao.lat_masuk,ao.lng_masuk,ao.lat_keluar,ao.lng_keluar',
                            ['ao.karyawan_id' => $karyawan_id],
                            10
                        ]);
                        if($q->num_rows() > 0){
                            $data = $q->result();
                            $msg = "Berhasil mengambil rekap absen";
                            $status = true; 
                        }
                    }
                } catch (Exception $error) {
                    $statusCode = 417;
                    $msg = $error->getMessage();
                }
            }
            
            $arr = [
                'data' => $data,
                'msg' => $msg,
                'statusCode' => $statusCode,
                'status' => $status
            ];
            
            echo json_encode($arr);
        }
        
    }
    
    public function actAbsen()
    {
        $this->header();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
            
            $id = $this->input->post('karyawan_id');
            $opsi = $this->input->post('opsi');
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');
            $jam_absen = $this->input->post('jam');
            
            $this->load->library('upload');
            
            $status = false;
            $statusCode = 200;
            $file = '';
            $msg = 'Gagal melakukan absen';
            $r = 0;
            $arr = [];
            
            if (empty($this->input->post())) {
                $msg = "Tidak ada data yang dikirim";
                $statusCode = 410;
            }else{
                try {   
                    if ($this->cek_token()) {
                        if ($opsi == 'I') {
                            $cek = $this->db->get_where('absen_online', ['tanggal' => date('Y-m-d'),'karyawan_id' => $id, 'status_in' => 'I']);
                            if ($cek->num_rows() == 0) {
                                $file = $this->upload('./data/img/absen/',$_FILES['img']);
                                if ($file) {
                                    foreach ($file as $v) {
                                        // Jam Masuk
                                        $absen = [
                                            'karyawan_id' => $id,
                                            'status_in' => $opsi,
                                            'bukti' => $v,
                                            'jam_masuk' => $jam_absen,
                                            'lat_masuk' => $lat,
                                            'lng_masuk' => $lng,
                                            'tanggal' => date('Y-m-d'),	
                                            'ctdupd' => date('Y-m-d H:i:s'),	
                                            
                                        ];
                                        array_push($arr,$absen);
                                    }
                                    $this->db->insert_batch('absen_online', $arr);
                                    $r = $this->db->affected_rows();
                                    if ($r > 0 ) {
                                        $msg = 'Berhasil melakukan absen masuk';
                                        $status = true;	
                                    } 
                                    
                                }else{
                                    $msg = 'Anda harus mengupload foto bukti absen';
                                }
                            }else{
                                $msg = 'Anda sudah melakukan absen masuk hari ini';
                            }
                            
                        }else if($opsi == 'O'){
                            $cek = $this->db->get_where('absen_online', ['tanggal' => date('Y-m-d'),'karyawan_id' => $id, 'status_out' => 'O']);
                            if ($cek->num_rows() == 0) {
                                // Jam Pulang
                                $absen = [
                                    'karyawan_id' => $id,
                                    'status_out' => $opsi,
                                    'jam_keluar' => $jam_absen,
                                    'lat_keluar' => $lat,
                                    'lng_keluar' => $lng,
                                    'tanggal' => date('Y-m-d'),	
                                    'ctdupd' => date('Y-m-d H:i:s'),	
                                ];
                                
                                $this->db->update('absen_online', $absen,['tanggal' => date('Y-m-d'),'karyawan_id' => $id,'status_in' => 'I']);
                                $r = $this->db->affected_rows();
                                if ($r > 0 ) {
                                    $msg = 'Berhasil melakukan absen pulang';
                                    $status = true;	
                                } 
                            }else{
                                $msg = 'Anda sudah melakukan absen pulang hari ini';
                            }
                        }
                    }
                } catch (Exception $error) {
                    $statusCode = 417;
                    $msg = $error->getMessage();
                }
            }
            
            $arr = [
                'data' => '',
                'msg' => $msg,
                'statusCode' => $statusCode,
                'status' => $status
            ];
            
            echo json_encode($arr);
        }
        
    }
    
}
