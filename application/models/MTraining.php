<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTraining extends CI_Model {

    private $t = 'pelatihan';
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

    public function dt($id='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'pelatihan p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'k.nama','p.pelatihan','tgl_mulai','tgl_akhir','p.status'];
        // Set searchable column fields
        $CI->dt->column_search = ['k.nama','p.pelatihan','tgl_mulai','tgl_akhir','p.status'];
        // Set select column fields
        $CI->dt->select = 'p.id,k.nama,p.pelatihan,tgl_mulai,tgl_akhir,p.status';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];

        if ($id != '') {
            $con2 = ['where','p.lowongan_id',$id];
            array_push($condition,$con2);
        }

        $con3 = ['join','karyawan k','k.id = p.karyawan_id','inner'];
        array_push($condition,$con3);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $dt->pelatihan,
                $dt->tgl_mulai,
                $dt->tgl_akhir,
                $this->setStatus($dt->status),
                '<a href="'.site_url('training/detail_training/'.$dt->id).'" class="btn btn-success"><i class="fas fa-info-circle"></i> Detail</a> | <a href="#" class="btn btn-danger" data-toggle="modal" onclick="getStatusPelatihan('.$dt->id.')" data-target="#exampleModal"> <i class="fas fa-pen-square"></i> Update </a>',
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
  
    public function setStatus($v='')
    {
        if ($v != '') {
            if ($v == '1' ) {
                return '<span class="badge badge-secondary">Pending</span>';
            }else if ($v == '2' ) {
                return '<span class="badge badge-success">Diterima</span>';
            }else if ($v == '3' ) {
                return '<span class="badge badge-danger">Ditolak</span>';
            }else if ($v == '4' ) {
                return '<span class="badge badge-secondary">Sedang Berjalan</span>';
            }else if ($v == '5' ) {
                return '<span class="badge badge-warning">Lulus</span>';
            }else if ($v == '6' ) {
                return '<span class="badge badge-warning">Tidak Lulus</span>';
            }
        }
    }

    public function getTrainingId($id){
       

        $tr = $this->db->select('p.*,k.nama')->
        join('karyawan k', 'k.id = p.karyawan_id', 'inner')->
        get_where('pelatihan p', ['p.id'=>$id]);

        return $tr;
        
    }
}