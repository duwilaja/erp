<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCc extends CI_Model {

    // Sqa
    
    public function dtSqa()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'sqa s';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nama_customer','file', 's.created_date'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama_customer','file', 's.created_date'];
        // Set select column fields
        $CI->dt->select = 's.id,nama_customer,file,s.created_date';
        // Set default order
        $CI->dt->order = ['s.id' => 'desc'];

        $condition = [
            ['join','customers c','c.id = s.customer_id','inner']
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        $del = "'Are you sure to delete this data ?'";
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama_customer,
                '<a href="'.base_url('data/sqa/'.$dt->file).'">'.$dt->file.'</a>',
                $this->bantuan->tgl_indo($dt->created_date),
                '<a onclick="delSqa('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

    public function deSqa($id='')
    {
        $q = '';
        if ($id != '') {
            $q = $this->db->delete('sqa',['id' => $id]);
        }

        return $q;
    }

    // Preventive EOS

    public function dtPreventiveEos()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'peos s';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nama_customer','file', 's.created_date'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama_customer','file', 's.created_date'];
        // Set select column fields
        $CI->dt->select = 's.id,nama_customer,file,s.created_date';
        // Set default order
        $CI->dt->order = ['s.id' => 'desc'];

        $condition = [
            ['join','customers c','c.id = s.customer_id','inner']
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        $del = "'Are you sure to delete this data ?'";
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama_customer,
                '<a href="'.base_url('data/preventive_eos/'.$dt->file).'">'.$dt->file.'</a>',
                $this->bantuan->tgl_indo($dt->created_date),
                '<a onclick="dePreventiveEos('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

    public function dePreventiveEos($id='')
    {
        $q = '';
        if ($id != '') {
            $q = $this->db->delete('peos',['id' => $id]);
        }

        return $q;
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