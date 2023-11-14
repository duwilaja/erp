<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCustomers extends CI_Model {

    private $t = 'cust';
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

    public function getEnd($id='')
    {
        $this->db->order_by('id', 'desc');
        $this->db->select($this->see);
        if ($id != '') {
            $q = $this->db->get_where('cust_end', ['id' => $id]);
        }else{
            $q = $this->db->get('cust_end');
        }
        return $q;
    }

    public function dt()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'cust c';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'kodec','customer'];
        // Set searchable column fields
        $CI->dt->column_search = ['kodec','customer'];
        // Set select column fields
        $CI->dt->select ='c.id as idc,last_update,customer,nama';
        // Set default order
        $CI->dt->order = ['c.id' => 'desc'];

        $condition = [
            ['join','karyawan k','k.id = c.ctdBy','left']
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->customer,
                $dt->last_update,
                $dt->nama,
                ' <a href="#" data-toggle="modal" data-target="#editCust" onclick="detailCus('.$dt->idc.')" class="btn btn-default btn-sm"><i class="far fa-edit"></i></a> <a href="#" class="btn btn-primary btn-sm" onclick="deCus('.$dt->idc.')"><i class="far fa-trash-alt"></i></a>'
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

    public function dtEnd()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'cust_end c';
        // Set orderable column fields
        $CI->dt->column_order = [null,'custend','last_update','nama'];
        // Set searchable column fields
        $CI->dt->column_search = ['custend','last_update','nama'];
        // Set select column fields
        $CI->dt->select ='c.id as idc,last_update,custend,nama';
        // Set default order
        $CI->dt->order = ['c.id' => 'desc'];

        $condition = [
            ['join','karyawan k','k.id = c.ctdBy','left']
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->custend,
                $dt->last_update,
                $dt->nama,
                ' <a href="#" data-toggle="modal" data-target="#editEndCust" onclick="detailEndCus('.$dt->idc.')" class="btn btn-default btn-sm" ><i class="far fa-edit"></i></a> <a href="#" class="btn btn-primary btn-sm" onclick="deEndCus('.$dt->idc.')"><i class="far fa-trash-alt"></i></a>'
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

    public function dtPic()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'cust c';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'c.nama','c.kontak_pic', 'lokasi','alamat','customer'];
        // Set searchable column fields
        $CI->dt->column_search = ['c.nama','c.kontak_pic', 'lokasi','alamat','customer'];
        // Set select column fields
        $CI->dt->select = 'c.id as idc,c.pic,c.kontak_pic,c.lokasi,c.alamat,c.customer';
        // Set default order
        $CI->dt->order = ['c.id' => 'desc'];
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->pic,
                $dt->kontak_pic,
                $dt->lokasi,
                $dt->alamat,
                $dt->customer,
                '<a href="#" class="btn btn-outline-danger" onclick="editPic('.@$dt->idc.')" data-toggle="modal" data-target="#exampleModal">Edit</a>'
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

    public function inEnd($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert('cust_end', $obj);
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

    public function deCust($id='')
    {
        $q = null;

        if($id != ''){
          $q = $this->db->delete('cust',['id' => $id]);
        }

        return $q;
    }
  
}