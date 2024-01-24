<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUsers extends CI_Model {

    private $t = 'users';
    public $see = '*';
    private $id = 'id';

    public function get($id='',$where='',$query='',$limit='',$start='')
    {
        $q = false;

        if ($id != '') {
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, [$this->id => $id]);
        }elseif ($where != '') {
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, $where);
        }elseif ($query != '') {
            $q = $this->db->query($query);
        }elseif($limit != ''){
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
            $q = $this->db->get_where($this->t,$where,$limit,$start);
        }else{
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get($this->t);
        }

        return $q;
    }

    public function up($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update($this->t, $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }
    public function upNew($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update("user_news", $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }

     public function in($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert($this->t, $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data to Users";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }
    public function inNew($obj='')
   {
       $q = [];
       $msg = 'Object or Array is null';
       $status = 0 ;
       $id = 0;

       if ($obj != '') {
           $q = $this->db->insert("user_news", $obj);
           $id = $this->db->insert_id();
           if ($this->db->affected_rows() > 0) {
               $msg = "Success insert data to Users";
               $status = 1;
           }else{
               $msg = "Failed insert data";
           }
       }

       return [$msg,$status,$id];
       
   }

    public function getUser($id='',$where='')
    {
       $this->db->select($this->see);
       $this->db->join('karyawan k', 'k.id = u.karyawan_id', 'inner');
       $this->db->join('user_news un', 'un.karyawan_id = k.id', 'left');
       if ($id != '') {
        $this->db->where('k.id', $id);
       }
       if ($where != '') {
            $q = $this->db->get_where('users u',$where);
        }else{
            $q = $this->db->get('users u');
        }
       
       return $q;
    }

    public function getOffice($id='',$where='')
    {
       $this->db->select($this->see);
       if ($id != '') {
        $this->db->where('u.id', $id);
       }
       if ($where != '') {
            $q = $this->db->get_where('offices u',$where);
        }else{
            $q = $this->db->get('offices u');
        }
       
       return $q;
    }
    public function getOfficeStaff($id='',$where='')
    {
       $this->db->select($this->see);
       if ($id != '') {
        $this->db->where('u.id', $id);
       }
       if ($where != '') {
            $q = $this->db->get_where('office_staff_types u',$where);
        }else{
            $q = $this->db->get('office_staff_types u');
        }
       
       return $q;
    }
    // public function cek_user_gj($password='')
    // {

    // }
}
