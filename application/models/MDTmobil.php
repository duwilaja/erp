<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDaily extends CI_Model {

    public function getAllDaily(){ 
        $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'inner');
        $this->db->join('karyawan k', 'k.id = dt.karyawan_id', 'inner');
        $this->db->where('j.parent_id', $this->session->userdata('karyawan_id'));
        $dt =  $this->db->get('daily_task dt');
        return $dt;
    }

    public function getAll(){ 
        $dt =  $this->db->get('daily_task d')->row();
        
        return json_encode($dt);
    }

    public function getDaily($id='')
    {
        if ($id != '') {
            $q = $this->db->get_where('daily_task',['id' => $id]);
            $r = $q->row();
        }else{
            $q = $this->db->get('daily_task');
            $r = $q->result();
        }
        
        if ($q->num_rows() > 0) {
           return $r;
        }
    }

    public function upDaily($obj='',$id)
    {
        $r = false;
        if ($obj != '') {
            $x = $this->db->update('daily_task', $obj,['id' => $id]);
            $cp = $this->db->affected_rows();
            if ($cp > 0) {
                 $r = true;
            }            
        }

        return $r;
    }

    public function dtDt($karyawan='',$tanggal='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dta');

        // Set table name
        $CI->dta->table = 'daily_task dt';
        // Set orderable column fields
        $CI->dta->column_order = [null, 'karyawan_id','pekerjaan', 'tanggal'];
        // Set searchable column fields
        $CI->dta->column_search = ['karyawan_id','pekerjaan', 'tanggal'];
        // Set select column fields
        $CI->dta->select = 'dt.id,dt.karyawan_id,pekerjaan,tanggal,nama';
        // Set default order
        $CI->dta->order = ['dt.id' => 'desc'];

        $con = ['join','karyawan k','k.id = dt.karyawan_id','inner'];
        array_push($condition,$con);

        $con = ['join','jabatan j','j.id = k.jabatan_id','inner'];
        array_push($condition,$con);
        
        if ($tanggal != '') {
            $con3 = ['where','dt.tanggal',$tanggal];
            array_push($condition,$con3);
        }

        if ($this->session->userdata('leader') != 1) {
            $con2 = ['where','k.id',$this->session->userdata('karyawan_id')];
            array_push($condition,$con2);
        }else{

            if ($karyawan != '') {
                $con3 = ['where','dt.karyawan_id',$karyawan];
                array_push($condition,$con3);
            }else{
                $con2 = ['where','j.parent_id',$this->session->userdata('level')];
                array_push($condition,$con2);
                
                $con2 = ['or_where','j.id',$this->session->userdata('level')];
                array_push($condition,$con2);
            }

        }

        // Fetch member's records
        $dataTabel = $this->dta->getRows($_POST, $condition);

        $i = $this->input->post('start');
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $this->bantuan->tgl_indo($dt->tanggal),
                $dt->pekerjaan,
                '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalEdit"  onclick="getDaily('.$dt->id.')">Edit</button>',
            );
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dta->countAll($condition),
            "recordsFiltered" => $this->dta->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function inDailyTask($obj)
    {
        if ($obj != '') {
            $q = $this->db->insert('daily_task', $obj);
            $qd = $this->db->affected_rows();
            if($qd) {
            return $q;  
            }
        }

    }

    
}