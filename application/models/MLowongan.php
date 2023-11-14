<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLowongan extends CI_Model {

    private $t = 'lowongan';
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

    public function dtLowongan($status)
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'lowongan l';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'l.pekerjaan','l.status'];
        // Set searchable column fields
        $CI->dt->column_search = ['l.pekerjaan','l.status'];
        // Set select column fields
        $CI->dt->select = 'l.id,l.pekerjaan,l.status';
        // Set default order
        $CI->dt->order = ['l.id' => 'desc'];
        
        $con2 = ['where','l.status',$status];
        array_push($condition,$con2);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = $_POST['start'];
        $hapus = "'Are you sure to remove this data ?'";
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->pekerjaan,
                $dt->status == 1 ? 'Aktif'  : 'Tidak Aktif',
                '<a class="btn btn-success" href="'.site_url('hcm/detail_lowongan/'.$dt->id).'"><i class="fa fa-eye"></i> Detail</a> | <a class="btn btn-warning" onclick="return confirm('.$hapus.')" href="'.site_url('hcm/deLowongan/'.$dt->id).'"><i class="fa fa-trash"></i> Remove</a>',
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );
        
        // Output to JSON format
        return json_encode($output);
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
                $msg = "Success insert data";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function de($arr)
    {
       return $this->db->delete('lowongan',$arr);
    }
  
}