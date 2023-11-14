<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MNotif extends CI_Model {

    public function inNotif($info,$from,$to,$msg,$redirect)
    {
        $r = false;

        $k = $this->db->get_where('karyawan',['id' => $this->session->userdata('karyawan_id')])->row();
        
        $obj = [
            'info' => $info,
            'karyawan_id' => $k->id,
            'created_date' => date('Y-m-d H:i:s'),
            'jabatan_id' => $k->jabatan_id, 
            'from' => $k->id,
            'to' => $to,
            'msg' => $msg,
            'redirect' => $redirect,
            'read' => 0
        ];

        $this->db->insert('notif', $obj);
        $post = $this->db->affected_rows();
        if ($post > 0) {
            $r = true;
        }     

        return $r;
    }

    public function readNotif($id)
    {
       return $this->db->update('notif', ['read' => 1],['id' => $id]);
    }

    public function getNotif($id='',$read='')
    {
        if ($id != '') {
            $q = $this->db->get_where('notif',['id' => $id]);
            $r = $q->row();
            $c = $q->num_rows();
        }else{
            $q = $this->db->get('notif');
            $r = $q->result();
            $c = $q->num_rows();
        }

        return [$r,$c];
    }

    public function getMeNotif($read='')    
    {
        $r = false;
        $c = 0;

        if ($read != '') {
            $q = $this->db->get_where('notif',['to' => $this->session->userdata('karyawan_id'),'read' => $read]);
            $c = $q->num_rows();
            $r = $q->result();
        }else{
            $q = $this->db->get_where('notif',['to' => $this->session->userdata('karyawan_id')]);
            $c = $q->num_rows();
            $r = $q->result();
        }

        return [$r,$c];
    }

    public function cekWarna($id='')
    {
        if ($id != '') {
           $notif = $this->db->get_where('notif',['id' => $id,'read' => '0']);
           if ($notif->num_rows() > 0) {
               return "background: #fff1f1;border: solid 1px #969696;";
           }
        }
    }

    public function dt_notif()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dta');

        // Set table name
        $CI->dta->table = 'notif n';
        // Set orderable column fields
        $CI->dta->column_order = [null, 'msg','read', 'created_date'];
        // Set searchable column fields
        $CI->dta->column_search = ['msg','read', 'created_date'];
        // Set select column fields
        $CI->dta->select = '*';
        // Set default order
        $CI->dta->order = ['n.id' => 'desc'];

        $con = ['where','to',$this->session->userdata('karyawan_id')];
        array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dta->getRows($_POST, $condition);
        $i = $this->input->post('start');
        foreach ($dataTabel as $dt) {
            $i++;
            $tgl = explode(' ',$dt->created_date);
            $jam = explode(':',$tgl[1]);
            $data[] = array(
                anchor('notif/links?redirect='.$dt->redirect.'&id='.$dt->id, $dt->msg, 'class="text-dark" target="_blank"'),
                $this->__setread($dt->read),
                $jam[0].':'.$jam[1].'<br>'.$this->bantuan->tgl_indo($dt->created_date),
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

    private function __setread($v='')
    {
        if ($v != '') {
            if ($v == '0') {
                return "<span class='aktif b'>Belum dibaca</span>";
            }else{
                return "<span class='aktif s'>Sudah dibaca</span>";
            }
        }
    }

}