<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMQuotation extends CI_Model {

    public $t = 'scm_quotations';
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
	
	private function attc($f){
		return $f==''?'':'<a target="_blank" href="'.site_url('/data/scm/quotations/').$f.'"><i class="fa fa-file-pdf"></a>';
	}

     public function dt($rpt)
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t.' q';
        // Set orderable column fields
        $CI->dt->column_order = ['quotnum','ket','dt','project_name','v.nama'];
        // Set searchable column fields
        $CI->dt->column_search = ['quotnum', 'ket'];
        // Set select column fields
        $CI->dt->select = 'quotnum,ket,dt,project_name as project,v.nama as vendor,q.id,attc';
        // Set default order
        $CI->dt->order = ['dt' => 'desc'];

        $condition = [
            //['where',$this->t.'.status',$status],
            ['join','scm_vendors v','v.id = q.vendor_id','left'],
			['join','project p','p.id = q.project_id','left'],
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
			$lnk=$rpt?$this->attc($dt->attc):'<a href="'.site_url('SCM/form_quotation/').$dt->id.'"><i class="fa fa-edit"></i></a> '.$this->attc($dt->attc);
            $data[] = array(
                //$i,
                $dt->quotnum,
                $dt->ket,
                $dt->dt,
                $dt->project,
				$dt->vendor,
                $lnk,
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
	

    public function dtGaji_Karyawan($status='1')
    {
        $this->load->library('bantuan');

        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'gaji_tf_karyawan gk';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nip', 'nama', 'nma_jabatan','no_rekening','gk.gaji_pokok','tgl_masuk'];
        // Set searchable column fields
        $CI->dt->column_search = ['nip', 'nama', 'nma_jabatan','no_rekening','gk.gaji_pokok','tgl_masuk'];
        // Set select column fields
        $CI->dt->select = 'gk.id as idk,nip,jam,total_uplem,bulan,nama,total_gaji,tgl_transfer';
        // Set default order
        $CI->dt->order = ['gk' . '.id' => 'desc'];

        $condition = [
            ['join','karyawan k','k.id = gk.karyawan_id','inner'],
            ['join','lembur l','l.gtk_id = gk.id','inner'],
        ];
        $this->db->group_by('gk.id');
        

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                'Rp.'.number_format($dt->total_gaji,0,",","."),
                $dt->jam,
                'Rp.'.number_format($dt->total_uplem,0,",","."),
                $dt->bulan,
                '<a href="'.site_url('payroll/detail_gj_karyawan/').$dt->idk.'">Detail</a>',
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