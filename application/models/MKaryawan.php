<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKaryawan extends CI_Model {

    public $t = 'karyawan';
    public $see = '*';
    private $id = 'id';

    
    public function __construct()
    {
        parent::__construct();
        
    }
    
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

    public function get_kary_n_parent($id='')
    {
        $this->mk->see = "nama,nma_jabatan,k.id,j.id as idj,j.parent_id";
        $q = $this->mk->getKaryawan($id)->row_array();
        $q['leader_id'] = '0';
        if ($q['parent_id'] != '0') {
            $this->mk->see = '*';
            $q['leader_id'] = $this->mk->get('',['jabatan_id' => $q['parent_id']])->row()->id;
        }

        return $q;
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
        $CI->dt->column_order = [null, 'nip', 'nama','nma_jabatan'];
        // Set searchable column fields
        $CI->dt->column_search = ['nip', 'nama','nma_jabatan'];
        // Set select column fields
        $CI->dt->select = 'karyawan.id as idk,nip,nama,status_karyawan,nma_jabatan,grade';
        // Set default order
        $CI->dt->order = [$this->t . '.id' => 'desc'];

        if ($status != '') {
            $con2 = ['where','karyawan.status',$status];
            array_push($condition,$con2);
        }

        if ($jabatan != '') {
            $con2 = ['where','karyawan.jabatan_id',$jabatan];
            array_push($condition,$con2);
        }
       
        $con3 = ['join','jabatan j','j.id = karyawan.jabatan_id','left'];
        array_push($condition,$con3);

        $dataTabel = $this->dt->getRows($_POST, $condition);
        $del = "'Apakah anda yakin ingin menghapus data karyawan ini ?'";
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nip,
                $dt->nama,
                $dt->nma_jabatan,
                // $dt->grade,
                // $this->cek_status($dt->status_karyawan),
                // '<a  class="text-warning" href="'.site_url('karyawan/ubah_karyawan/').$dt->idk.'"><i class="fa fa-edit"></i></a> . <a onclick="return confirm('.$del.')" href="'.site_url('karyawan/set_nonaktif/').$dt->idk.'" class="text-danger" ><i class="fa fa-trash"></i></a>',
                '<a  class="text-warning" href="'.site_url('karyawan/ubah_karyawan/').$dt->idk.'"><i class="fa fa-edit"></i></a>',
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

    public function dtJabatan($status='1')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t;
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nip', 'nama','nma_jabatan'];
        // Set searchable column fields
        $CI->dt->column_search = ['nip', 'nama','nma_jabatan'];
        // Set select column fields
        $CI->dt->select = 'karyawan.id as idk,nip,nama,status_karyawan,nma_jabatan';
        // Set default order
        $CI->dt->order = [$this->t . '.id' => 'desc'];

        $con2 = ['where','karyawan.status',$status];
        array_push($condition,$con2);
       
        $con3 = ['join','jabatan j','j.id = karyawan.jabatan_id','left'];
        array_push($condition,$con3);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nip,
                $dt->nama,
                $dt->nma_jabatan,
                // $this->cek_status($dt->status_karyawan),
                '<a class="btn btn-danger" href="'.site_url('hcm/historical_detail/').$dt->idk.'"><i class="fa fa-circle-info"></i> Detail</a>',
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

    public function dtGaji_Karyawan($id='')
    {
        $this->load->library('bantuan');

        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'karyawan k';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nip', 'nama', 'nma_jabatan'];
        // Set searchable column fields
        $CI->dt->column_search = ['nip', 'nama', 'nma_jabatan'];
        // Set select column fields
        $CI->dt->select = 'k.id,nip,nama,nma_jabatan,gtk.created_date,gtk.id as idgtk';
        // Set default order
        $CI->dt->order = ['k.id' => 'desc'];
        
        $con = ['join','jabatan j','j.id = k.jabatan_id','left'];
        array_push($condition,$con);

        $con = ['join','gaji_tf_karyawan gtk','gtk.karyawan_id = k.id','inner'];
        array_push($condition,$con);

        $con2 = ['where','k.id',$this->session->userdata('karyawan_id')];
        array_push($condition,$con2);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nip,
                $dt->nama,
                $dt->nma_jabatan,
                $this->bantuan->tgl_indo(explode(' ',$dt->created_date)[0]),
                '<a href="'.site_url('payroll/detail_gj_karyawan/').$dt->id.'/'.$dt->idgtk.'">Slip Gaji</a>',
            );
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function dtGaji_Karyawan_all()
    {
        $this->load->library('bantuan');

        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'karyawan k';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nip', 'nama', 'nma_jabatan'];
        // Set searchable column fields
        $CI->dt->column_search = ['nip', 'nama', 'nma_jabatan'];
        // Set select column fields
        $CI->dt->select = 'k.id,nip,nama,nma_jabatan,gtk.created_date,gtk.id as idgtk';
        // Set default order
        $CI->dt->order = ['k.id' => 'desc'];
        
        $con = ['join','jabatan j','j.id = k.jabatan_id','left'];
        array_push($condition,$con);

        $con = ['join','gaji_tf_karyawan gtk','gtk.karyawan_id = k.id','inner'];
        array_push($condition,$con);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nip,
                $dt->nama,
                $dt->nma_jabatan,
                $this->bantuan->tgl_indo(explode(' ',$dt->created_date)[0]),
                '<a href="'.site_url('payroll/detail_gj_karyawan/').$dt->id.'/'.$dt->idgtk.'">Slip Gaji</a>',
            );
        }

        $output = array(
            "draw" => @$_POST['draw'],
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
                $msg = "Success insert data to Karyawan";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function getKaryawan($id='')
    {
        $this->db->select($this->see);
        
        if ($id != '') {
            $this->db->where('k.id', $id);
        }

        $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'inner');
        $ok = $this->db->get('karyawan k');
        return $ok;
    }

    public function getKaryawanChatByGrp($grp='')
    {
        $this->db->select($this->see);
        $this->db->join('users u', 'k.id = u.karyawan_id', 'inner');
        $this->db->where('u.group', $grp);
        $this->db->where('k.chat_id !=','');
        $q = $this->db->get('karyawan k');
        return $q;
    }

    public function getKaryawanByGrp($grp='')
    {
        $this->db->select($this->see);
        $this->db->where('j.grp_jabatan_id', $grp);
        $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'inner');
        $q = $this->db->get('karyawan k');
        return $q;
    }

    public function getKaryawanNotParent($id='')
    {
            $this->db->select($this->see);
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
        
            if ($id != '') {
                $this->db->where('k.id', $id);
            }

            $this->db->where_not_in('j.parent_id', $this->session->userdata('level'));
            $ok = $this->db->get('karyawan k');
            return $ok;
    }

    private function cek_status($status='')
    {
        if ($status == '1') {
            return '<span class="actv">Active</span>';
        }else if($status == '0'){
            return '<span class="non_actv">Non Active</span>';
        }
    }

    public function cek_pass($id, $pass){
        $cek = $this->db->get_where('users',['karyawan_id' => $id, 'password' => md5($pass)]);
        if($cek->num_rows() > 0){
            return true;
        }else{
            return false;
        }     
    }

    public function getKarJab($id='')
    {
        if ($id == '') {
            $id = $this->session->userdata('karyawan_id');
        }
        $this->db->select($this->see);
        $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'inner');
        $this->db->where('j.parent_id', $this->session->userdata('level'));   
        $this->db->or_where('j.id', $this->session->userdata('level'));   
        $k = $this->db->get('karyawan k');
        
        return $k;
    }

    public function getKaryawanLevel($arr_level)
    {
        $this->db->select($this->see);
        $this->db->where_in('jabatan_id', $arr_level);
        $this->db->where_not_in('jabatan_id','0');
        $q = $this->db->get('karyawan k');
        return $q;
    }

    public function dtAnggota()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'karyawan k';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nama', 'nma_jabatan', 'group'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama', 'nma_jabatan', 'group'];
        // Set select column fields
        $CI->dt->select = 'k.id,k.nama,j.nma_jabatan,u.group,ce.custend';
        // Set default order
        $CI->dt->order = ['k.id' => 'desc'];
        
        $con = ['join','jabatan j','j.id = k.jabatan_id','left'];
        array_push($condition,$con);

        $con = ['join','users u','u.karyawan_id = k.id','inner'];
        array_push($condition,$con);
       
        $con = ['join','cust_end ce','ce.id = k.alokasi_cust','left'];
        array_push($condition,$con);

        $con2 = ['where','j.parent_id',$this->session->userdata('level')];
        array_push($condition,$con2);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $dt->nma_jabatan,
                $dt->custend,
                $dt->group,
                '<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalEditAnggota" onclick="getAnggota('.$dt->id.')">Edit</a> | <a href="#" class="btn btn-danger" onclick="deAnggota('.$dt->id.')">Hapus</a>',
            );
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }
}
