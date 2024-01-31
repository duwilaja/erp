<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MOStype extends CI_Model {

    private $t = 'office_staff_types';
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

        if ($obj != '' && $where != '') {
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
    public function dt($status='',$jabatan='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        $kar = $this->get($this->session->userdata('karyawan_id'))->row();
        // Set table name
        $CI->dt->table = $this->t;
        // Set orderable column fields
        $CI->dt->column_order = ['o.name', 'staff_code','start_date','end_date'];
        // Set searchable column fields
        $CI->dt->column_search = ['o.name', 'staff_code'];
        // Set select column fields
        $CI->dt->select = 'o.name,staff_code,start_date,end_date,'.$this->t.'.id';
        // Set default order
        $CI->dt->order = [$this->t . '.id' => 'desc'];
       
	   $condition = [
            ['join','offices o','o.id = '.$this->t.'.office_id','inner'],
        ];

        $dataTabel = $this->dt->getRows($_POST, $condition);
        $del = "'Apakah anda yakin ingin menghapus data ini ?'";
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $dt->name,
                $dt->staff_code,
                $dt->start_date,
                $dt->end_date,
                ' <a href="#" data-toggle="modal" data-target="#exampleModal" onclick="det('.$dt->id.')" class="btn btn-default btn-sm"><i class="far fa-edit"></i></a> <a href="#" class="btn btn-primary btn-sm" onclick="de('.$dt->id.')"><i class="far fa-trash-alt"></i></a>'
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
	public function del($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->delete($this->t, $obj);
            //$id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success delete data";
                $status = 1;
            }else{
                $msg = "Failed delete data";
            }
        }

        return [$msg,$status,$id];
        
    }
}