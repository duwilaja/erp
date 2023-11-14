<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMVendor extends CI_Model {

    public $t = 'scm_vendors';
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

     public function dt()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t;
        // Set orderable column fields
        $CI->dt->column_order = ['kode','nama','attn','alamat'];
        // Set searchable column fields
        $CI->dt->column_search = ['kode', 'nama'];
        // Set select column fields
        $CI->dt->select = 'kode,nama,attn,alamat,id';
        // Set default order
        $CI->dt->order = ['nama' => 'asc'];

        $condition = [
            //['where',$this->t.'.status',$status],
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->kode,
                $dt->nama,
                $dt->attn,
                str_ireplace("\n","<br />",$dt->alamat),
                '<a class="btn btn-default btn-sm" href="'.site_url('SCM/form_vendor/').$dt->id.'"><i class="fa fa-edit"></i></a>',
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
	
}