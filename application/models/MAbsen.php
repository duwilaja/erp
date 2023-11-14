<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MAbsen extends CI_Model{
    
    function __construct() {
      
    }
    
    public function get($arr=[])
    {
       if (!empty($arr)){
            if (!empty($arr[0]) && $arr[0] != '') 
                $this->db->select($arr[0]);
        
            if (!empty($arr[1])) 
                $this->db->where($arr[1]);

            if (!empty($arr[2])) 
                $this->db->where_in($arr[2]);

            if (!empty($arr[3])) 
                $this->db->limit($arr[3]);
        }
       
       $this->db->group_by('id','desc');
       $this->db->join('karyawan k', 'k.id = ao.karyawan_id', 'join');
       $q = $this->db->get('absen_online ao');
       return $q; 
    }

}