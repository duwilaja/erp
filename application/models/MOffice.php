<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MOffice extends CI_Model {

    private $t = 'offices';
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
        $CI->dt->column_order = [null, 'name'];
        // Set searchable column fields
        $CI->dt->column_search = ['name', 'alamat'];
        // Set select column fields
        $CI->dt->select = 'name,description, alamat, range_geofence';
        // Set default order
        $CI->dt->order = [$this->t . '.id' => 'desc'];
       

        $dataTabel = $this->dt->getRows($_POST, $condition);
        $del = "'Apakah anda yakin ingin menghapus data karyawan ini ?'";
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->name,
                $dt->description,
                $dt->alamat,
                $dt->range_geofence,
                '<a  class="text-warning" href="'.site_url('office/ubah_data/').$dt->idk.'"><i class="fa fa-edit"></i></a>',
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
                $msg = "Success insert data to Users";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }
}