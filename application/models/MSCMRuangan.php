<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMRuangan extends CI_Model {

    // Data Ruangan
    public function get_data_ruangan($id='')
    {
        if ($id != '') {
            $q = $this->db->get_where('data_ruangan',['id' => $id]);
        }else{
            $q = $this->db->get('data_ruangan');
        }

        return $q;
    }

    public function dt_data_ruangan($aktif='')
    {
        if($aktif == ''){
            $aktif = 1;
        }

       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'data_ruangan dr';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'nama_ruangan','status_ruangan'];
       // Set searchable column fields
       $CI->dt->column_search = ['nama_ruangan','status_ruangan'];
       // Set select column fields
       $CI->dt->select = '*';
       // Set default order
       $CI->dt->order = ['id' => 'desc'];

       if ($aktif != '') {
           $con = ['where','dr.aktif','1'];
           array_push($condition,$con);
       }

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->nama_ruangan,
               $this->get_status_data_ruangan($dt->status_ruangan),
               '<a href="#" data-toggle="modal" data-target="#modal_detail_data_ruangan" onclick="detail_data_ruangan('.$dt->id.')"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></a> <a href="#" data-toggle="modal" data-target="#modal_up_data_ruangan" onclick="edit_data_ruangan('.$dt->id.')"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">edit</button></a> <button  onclick="del_data_ruangan('.$dt->id.')" class="btn btn-danger text-uppercase font-weight-bold text-white" style="padding:3px 10px !important;font-size: 13px;">hapus</button></a>'
           );
       }

       $output = array(
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }
    
    public function in_data_ruangan($obj=[])
    {
        $status  = false;
        $id = 0;

        if (!empty($obj)) {
            $obj['ctddate'] = date('Y-m-d');
            $obj['aktif'] = 1;
            $obj['ctdby'] = $this->session->userdata('karyawan_id');
            $this->db->insert('data_ruangan', $obj);
            if ($this->db->affected_rows() > 0) {
                $status = true;
                $id = $this->db->insert_id();
            }
        }
        return [$status,$id];
    }

    public function up_data_ruangan($obj=[],$where=[])
    {
        $status  = false;

        if (!empty($obj) && !empty($where)) {
            $this->db->update('data_ruangan', $obj, $where);
            if ($this->db->affected_rows() > 0) {
                $status = true;
            }
        }
        return $status;
    }

    public function set_non_aktif_data_ruangan($id='')
    {
        $s = false;

        if ($id != '') {
            $x = $this->up_data_ruangan(['aktif' => 0],['id' => $id]);
            if ($x) {
                $s = true;
            }
        }

        return $s;
    }

    public function set_aktif_data_ruangan($id='')
    {
        $s = false;

        if ($id != '') {
            $x = $this->up_data_ruangan(['aktif' => 1],['id' => $id]);
            if ($x) {
                $s = true;
            }
        }

        return $s;
    }
    
    public function get_status_data_ruangan($s)
    {
       if ($s == 0) {
            return "Tidak Dipakai";
        }else if ($s == 1) {
            return "Dipakai";
        }
    }

    // Peminjaman Ruangan

    public function dt_pnjm_ruangan($status='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'pnjm_ruangan pr';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'nama','nama_ruangan','tujuan','tgl_pnjm'];
       // Set searchable column fields
       $CI->dt->column_search = ['nama','nama_ruangan','tujuan','tgl_pnjm'];
       // Set select column fields
       $CI->dt->select = 'pr.id,k.nama,dr.nama_ruangan,tujuan,tgl_pnjm,pra.status_pnjm';
       // Set default order
       $CI->dt->order = ['pr.id' => 'desc'];

        if ($status != '') {
            $con = ['where','pra.status_pnjm',$status];
            array_push($condition,$con);
        }

        $con = ['join','data_ruangan dr','dr.id = pr.dta_ruangan_id','inner'];
        array_push($condition,$con);

        $con = ['join','pnjm_ruangan_approve pra','pra.pnjm_ruangan_id = pr.id','inner'];
        array_push($condition,$con);

        $con1 = ['join','karyawan k','k.id = siapa_pnjm','inner'];
        array_push($condition,$con1);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->nama,
               $dt->nama_ruangan,
               $dt->tujuan,
               $this->bantuan->tgl_indo($dt->tgl_pnjm),
               $this->get_status_pnjm_ruangan($dt->status_pnjm),
               '<a href="#" data-toggle="modal" data-target="#modal_detail_pnjm_ruangan" onclick="detail_pnjm_ruangan('.$dt->id.')"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></a>'
           );
       }

       $output = array(
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }

    public function in_pnjm_ruangan($obj=[])
    {
        $status  = false;
        $id = 0;

        if (!empty($obj)) {
            $obj['ctddate'] = date('Y-m-d');
            $obj['status_ruangan'] = 0;
            $obj['siapa_pnjm'] = $this->session->userdata('karyawan_id');
            $this->db->insert('pnjm_ruangan', $obj);
            if ($this->db->affected_rows() > 0) {
                $status = true;
                $id = $this->db->insert_id();
            }
        }

        return [$status,$id];
    }

    public function in_pnjm_ruangan_approve($obj=[])
    {
        $status  = false;
        $id = 0;

        $obj['ctddate'] = date('Y-m-d H:i:s');
        $obj['s_approved'] = $this->session->userdata('karyawan_id');
        $this->db->insert('pnjm_ruangan_approve', $obj);
        if ($this->db->affected_rows() > 0) {
            $status = true;
            $id = $this->db->insert_id();
        }

        return [$status,$id];
    }

    public function pengajuan_ruangan_karyawan($obj)
    {
        $x = $this->in_pnjm_ruangan($obj);
        if ($x[0]) {
            $this->in_pnjm_ruangan_approve();
        }
    }

    public function get_status_pnjm_ruangan($s)
    {
       if ($s == 0) {
            return "-";
        }else if ($s == 1) {
            return "Disetujui";
        }else if ($s == 2) {
            return "Ditolak";
        }
    }
	
}