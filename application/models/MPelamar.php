<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPelamar extends CI_Model {

    private $t = 'pelamar';
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

    public function dtPelamar($id)
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'pelamar p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'p.nama','p.pendidikan','email','no_tlp','cv','p.status'];
        // Set searchable column fields
        $CI->dt->column_search = ['p.nama','p.pendidikan','email','no_tlp','cv','p.status'];
        // Set select column fields
        $CI->dt->select = 'p.id,p.nama,p.pendidikan,email,no_tlp,cv,p.status';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];

        if ($id != '') {
            $con2 = ['where','p.lowongan_id',$id];
            array_push($condition,$con2);
        }
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $dt->pendidikan,
                $dt->email,
                $dt->no_tlp,
                anchor('data/cv/'.$dt->cv, $dt->cv),
                $this->setStatus($dt->status),
                '<a href="#" class="btn btn-success" data-toggle="modal" onclick="getStatusPelamar('.$dt->id.')" data-target="#exampleModal"> <i class="fas fa-pen-square"></i> Ubah </a>',
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

    public function de($arr)
    {
       return $this->db->delete('lowongan',$arr);
    }

    public function inHPelamar($data='')
    {
        if ($data != '') {
         return   $this->db->insert('h_pelamar', $data);
        }
    }
  
    private function setStatus($v='')
    {
        if ($v != '') {
            if ($v == '1' ) {
                return '<span class="badge badge-secondary">Pending</span>';
            }else if ($v == '2' ) {
                return '<span class="badge badge-success">Diterima</span>';
            }else if ($v == '3' ) {
                return '<span class="badge badge-danger">Wawancara</span>';
            }else if ($v == '4' ) {
                return '<span class="badge badge-secondary">Blacklist</span>';
            }else if ($v == '5' ) {
                return '<span class="badge badge-warning">Ditolak</span>';
            }
        }
    }
}