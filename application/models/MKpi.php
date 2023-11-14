<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKpi extends CI_Model {

    public $t = 'kpi_input';
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

     public function dt($status='1')
    {
        // Definisi
        $condition = '';
        $data = [];
        $total = 0;

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t.' kpi';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'k.nama', 'j.nma_jabatan'];
        // Set searchable column fields
        $CI->dt->column_search = ['k.nama', 'j.nma_jabatan'];
        // Set select column fields
        $CI->dt->select = 'kpi.id,kpi.karyawan_id as idk,k.nama,j.nma_jabatan,kpi.total';
        // Set default order
        $CI->dt->order = ['kpi.id' => 'desc'];

        $condition = [
            ['join','jabatan j','j.id = kpi.jabatan_id','inner'],
            ['join','karyawan k','k.id = kpi.karyawan_id','inner'],
        ];

        $id = $this->uri->segment(3);
        if ($id) {
            $condition = [
                ['join','jabatan j','j.id = kpi.jabatan_id','inner'],
                ['join','karyawan k','k.id = kpi.karyawan_id','inner'],
                ['where','kpi.jabatan_id',$id],
            ];
            $this->db->group_by('karyawan_id');
        }

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i++,
                $dt->nama,
                $dt->nma_jabatan,
                $this->getTotalAllKpi($dt->idk),
                '<a href="'.site_url('kpi/detail_kpi/'.$dt->id.'/'.$dt->idk).'"><i class="fa fa-edit"></i> Detail</a>',
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

    public function getKpiJabatan($idJabatan='')
    {
       $this->db->select('kpi.id,pg,nma_jabatan,weight,kpi,target');
       $this->db->join('jabatan j', 'j.id = kpi.jabatan_id', 'inner');
       $this->db->where('kpi.jabatan_id', $idJabatan);
       $this->db->order_by('urutan', 'asc');
       $q = $this->db->get('kpi_input_jabatan kpi');
       return $q;
    }

    public function getKpiKaryawan($id='')
    {
        $this->db->select('kpi.id,pg,nma_jabatan,weight,kpi,target,realization,score,total,kpi.karyawan_id');
        $this->db->join('jabatan j', 'j.id = kpi.jabatan_id', 'inner');
        $this->db->join('kpi_input_jabatan kpi_ij', 'kpi_ij.id = kpi.kpi_ij', 'inner');
        $this->db->where('kpi.karyawan_id', $id);
        $q = $this->db->get('kpi_input kpi');
        return $q;
    }

    public function getTotalAllKpi($karyawan_id='')
    {
        $t = 0;

        if ($karyawan_id != '') {
            $get =  $this->get('',['karyawan_id' => $karyawan_id])->result();
            foreach ($get as $v) {
               @$t += @$v->total; 
            }
        }

        return $t;
    }

    public function ubahScore()
    {
        $total = 0;
        $score = $this->input->post('score');
        $weight = $this->input->post('weight');
        $id = $this->input->post('id');
        $karyawan_id = $this->input->post('idk');

        $total = $score*$weight/100;

        $this->db->update('kpi_input', ['score' => $score,'total' => $total],['id' => $id]);
        $arr = [
            'total' => $total,
            'total_all' => $this->getTotalAllKpi($karyawan_id)
        ];


        return $arr;
    }
    
}