<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMRequest extends CI_Model {

    public $t = 'scm_request';
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

    public function dt_request($req_id='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t.' sr';
        // Set orderable column fields
        $CI->dt->column_order = ['nama','nma_jabatan','ctddate'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama', 'nma_jabatan','ctddate'];
        // Set select column fields
        $CI->dt->select = 'nama,nma_jabatan,ctddate,';
        // Set default order
        $CI->dt->order = ['id' => 'desc'];

       $con = ['join','karyawan k','k.id = sr.req_by','inner'];
       array_push($condition,$con);

       $con = ['join','jabatan j','j.id = k.jabatan_id','inner'];
       array_push($condition,$con);

       if ($req_id != '') {
           $con = ['where','req_id',$req_id];
           array_push($condition,$con);
       }

       // Fetch member's records
       $dataTabel = $this->dt->getRows($_POST, $condition);      
       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               //$i,
               $dt->nama,
               $dt->nma_jabatan,
               $this->bantuan->tgl_indo($dt->ctddate),
               '<a class="btn btn-default btn-sm" href="'.site_url('SCM/detail_req/').$dt->id.'"><i class="far fa-eye"></i></a>',
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

    public function dt_req_list($req_id='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'scm_req_list srl';
        // Set orderable column fields
        $CI->dt->column_order = ['type',null,'handover_date','status'];
        // Set searchable column fields
        $CI->dt->column_search = ['type','handover_date'];
        // Set select column fields
        $CI->dt->select = 'srl.id,req_id,type,handover_date,srl.status,qty';
        // Set default order
        $CI->dt->order = ['srl.id' => 'desc'];

       $con = ['join','scm_dvc_type t','t.id = srl.type_id','inner'];
       array_push($condition,$con);

       if ($req_id != '') {
           $con = ['where','req_id',$req_id];
           array_push($condition,$con);
       }
       
       $dataTabel = $this->dt->getRows(@$_POST, $condition);    
       $q = $this->db->last_query();
        $kq = $this->db->query($q)->num_rows();
       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               //$i,
               $dt->type,
               $dt->qty,
               $this->bantuan->tgl_indo($dt->handover_date),
               $this->cek_status_req($dt->status),
               ' <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#detailModal"><i class="fas fa-barcode"></i></button>
               <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#handovModal" onclick="get_detail('.$dt->id.','.$dt->qty.')"><i class="fas fa-bullseye"></i></button>',
           );
       }

      $output = array(
          "draw" => @$_POST['draw'],
          "recordsTotal" => $kq,
          "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
          "data" => $data,
      );  

      // Output to JSON format
      return json_encode($output);
    }

    public function cek_status_req($n='')
    {
        if($n == '1'){
            return 'Approved';
        }else if($n == '2'){
            return 'Not Approved';
        }else{
            return 'Pending';
        }
    }

    public function ubah_status_req($req_list_id='',$n='',$alasan='')
    {
        $s = false;
        if ($req_list_id != '') {
            if ($n == '1') {
                // Terima
                $this->db->update('scm_req_list', ['status' => $n],['id' => $req_list_id]);
                $s = true;
            }else if ($n == '2') {
                // Tolak
                $this->db->update('scm_req_list', ['status' => $n,'alasan' => $alasan],['id' => $req_list_id]);
            }
        }

        return $s;
    }

    public function handover_date($req_list_id='',$handover_date='')
    {
        $s = false;
        if ($req_list_id != '') {
            // set tanggal serah terima
            $this->db->update('scm_req_list', ['handover_date' => $handover_date],['id' => $req_list_id]);
            $jml = $this->db->affected_rows();
            if ($jml > 0) {
                $grd = $this->get_req_dvc($req_list_id);
                if ($grd->num_rows() > 0) {
                    $g = $grd->result();
                    foreach ($g as $v) {
                        $this->db->update('scm_devices', ['handover_date' => $handover_date],['id' => $v->device_id]);
                    }
                    $s = true;
                }
            }
        }

        return $s;
    }
    
    // Request device
    public function get_req_dvc($req_list_id='')
    {
        $q = $this->db->get_where('scm_req_dvc',['req_list_id' => $req_list_id]);
        return $q;
    }
    
    public function del($where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($where != '') {
            $q = $this->db->delete($this->t, $where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success delete data";
                $status = 1;
            }else{
                $msg = "Failed delete data";
            }
        }

        return [$msg,$status];
        
    }

    public function up($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
		
		$db_debug=$this->db->db_debug;
		$this->db->db_debug=false;

        if ($obj != '' || $where != '') {
            $q = $this->db->update($this->t, $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }
		
		$this->db->db_debug=$db_debug;

        return [$msg,$status];
        
    }
	
	public function in($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

		$db_debug=$this->db->db_debug;
		$this->db->db_debug=false;

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

		$this->db->db_debug=$db_debug;
		
        return [$msg,$status,$id];
        
    }
	
}