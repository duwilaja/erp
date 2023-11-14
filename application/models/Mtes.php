<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtes extends CI_Model {
    
    private $t = 'absensi';
    public $see = '*';
    private $id = 'id';
    
    // public function get_data(){
    //     $dt = $this->db->get('absensi')->result();
    //     return $dt;
    // }
    //
    public function get_absensi_tepat($get_bulan='',$get_tahun=''){
        $status = "status in('i','I')";
        $user = $this->session->userdata('karyawan_id');
        $sql = "SELECT @N := @N +1 AS minggu,COUNT(*) AS tepat
        FROM absensi, (SELECT @N:=0) dum
        WHERE  
        YEAR(tanggal) = '$get_tahun' AND
        MONTH(tanggal) = '$get_bulan' AND 
        jam_masuk < '08:31:00' AND
        karyawan_id = '$user' and  
        $status
        GROUP BY YEARWEEK(tanggal);";
        $dt = $this->db->query($sql);
        return $dt;
    }
    public function get_absensi_telat($get_bulan='',$get_tahun=''){
        $status = "status in('TL')";
        $user = $this->session->userdata('karyawan_id');
        $sql = "SELECT @N := @N +1 AS minggu,COUNT(*) AS telat
        FROM absensi, (SELECT @N:=0) dum
        WHERE  
        YEAR(tanggal) = '$get_tahun' AND
        MONTH(tanggal) = '$get_bulan' AND 
        jam_masuk >= '08:31:00' AND
        karyawan_id = '$user' and  
        $status
        GROUP BY YEARWEEK(tanggal);";
        $dt = $this->db->query($sql);
        return $dt;
    }   
    
}