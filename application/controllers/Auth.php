<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('MUsers','mu');
    }
    
    public function login()
    {
        $d = [
			'title' => 'Login to Matrik Application System',
		];
		$this->load->view('login',$d);
    }

    public function proses_login()
    {   
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (stripos($username, "@") !== false) {
            $arr = ['email' => $username,'password' => md5($password),'level !=' => ''];
        }else{
            $arr = ['username' => $username,'password' => md5($password),'level !=' => ''];
        }


        $q = $this->mu->get('',$arr);
        if ($q->num_rows() > 0) {
            
            $u = $q->row();
            $jabatan = $this->db->get_where('jabatan',['id' => $u->level])->row();

            $array = array(
                'id' => $u->id,
                'level' => $u->level,
                'leader' => $jabatan->leader,
                'grp' => $jabatan->grp_jabatan_id,
                'group' => $u->group,
                'email' => $u->email,
                'karyawan_id' => $u->karyawan_id,
            );
            
            $this->session->set_userdata( $array );
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('gagal', 'Username or Password is not valid, please check username and password.');
            redirect('/');
        }
        
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
        
    }
	

}
