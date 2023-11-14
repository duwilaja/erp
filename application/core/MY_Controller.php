<?php
class MY_controller extends  CI_controller
{
    
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        if ($this->session->userdata('karyawan_id') == '') {
            redirect('/');
        }
        
        // if ($this->menus->cek_menu_all()) {
        //     // echo "bisa ke 1";
        // }else if($this->menus->cek_menu()){
        //     // echo "bisa ke 2";
        // }else{
        //     echo "gagal total";
        // }
        // 1 Productioon
        // 2 Dev

        // $this->bantuan->cekMenuLevel(2);
    }
    
}
