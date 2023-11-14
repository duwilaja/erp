<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMenu extends CI_Model {

    private $t = 'menu';
    public $see = '*';
    private $id = 'id';

    public function get($id='',$where='',$query='',$limit='',$start='')
    {
        $q = false;

        if ($id != '') {
            $this->db->order_by('urutan', 'asc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, [$this->id => $id]);
        }elseif ($where != '') {
            $this->db->order_by('urutan', 'asc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, $where);
        }elseif ($query != '') {
            $q = $this->db->query($query);
        }elseif($limit != ''){
            $this->db->order_by('urutan', 'asc');
            $this->db->select($this->see);
            $q = $this->db->get_where($this->t,$where,$limit,$start);
        }else{
            $this->db->order_by('urutan', 'asc');
            $this->db->select($this->see);
           $q = $this->db->get($this->t);
        }

        return $q;
    }

    public function menu($id='',$level='',$block='',$status=1)
    {
        $this->db->select('*');
        
        if ($id != '') {
            $this->db->where('id', $id);
        }

        if ($status != '') {
            $this->db->where('status', $status);
        }

        if ($level != '') {
            $this->db->like('level', ','.$level.',');
        }

        if ($block != '') {
            $this->db->not_like('block_id', ','.$block.',');
        }

        $this->db->group_by('m.id');
        $this->db->order_by('urutan', 'asc');

        $m = $this->db->get('menu m');

        return $m; 
    }

    public function submenu($id='',$id_menu='',$block='',$status=1)
    {
        $this->db->select('*,ms.target,ms.icon,ms.id,ms.urutan');
        
        if ($id != '') {
            $this->db->where('id', $id);
        }

        if ($status != '') {
            $this->db->where('ms.status', $status);
        }

        if ($block != '') {
            $this->db->not_like('ms.sub_block_id', ','.$block.',');
        }

        $this->db->where('menu_id', $id_menu);
        
        $this->db->join('menu m', 'm.id = ms.menu_id', 'inner');
        $this->db->order_by('ms.urutan', 'asc');
        
        $m = $this->db->get('menu_sub ms');
        
        return $m; 
    }

    public function dtMenu($status='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'menu m';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'urutan','menu','status'];
        // Set searchable column fields
        $CI->dt->column_search = ['urutan','menu','status'];
        // Set select column fields
        $CI->dt->select = '*';
        // Set default order
        $CI->dt->order = ['m.urutan' => 'asc'];

        if ($status != '') {
            $con = ['where','m.status',$status];
            array_push($condition,$con);
        }

        // $con = ['join','cust c','c.id = p.cust_id','left'];
        // array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $data[] = array(
                $dt->urutan,
                $dt->menu,
                setStatus($dt->status),
                '<a href="'.site_url('lab/add_hak_akses?idm='.$dt->id).'"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></a>'
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

    public function upMenu($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('menu', $obj,$where);
            $id = $this->db->affected_rows();
            if ($id > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status,$id];
        
    }

     public function inMenu($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert('menu', $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function inMenuSub($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert('menu_sub', $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function upMenuSub($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('menu_sub', $obj,$where);
            $id = $this->db->affected_rows();
            if ($id > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status,$id];
    } 
    
    public function deMenuSub($id='')
    {
        return $this->db->delete('menu_sub',['id' => $id]);
    }

    public function cek_menu_all()
    {
        $i = substr($_SERVER['PATH_INFO'],1);

        $x = explode('/',$i);
        if (isset($x)) {
            if (!empty($x[2])) {
                $i = str_replace($x[2],'$num',$i);
            }
        }

		$this->db->where('link', $i);
		$this->db->where('access', '1');
		$q = $this->db->get('menu_link ml');
		
		if ($q->num_rows() == 0) {
			return false;
		}else{
            return true;
        }
    }

    public function cek_menu()
    {
        $i = substr($_SERVER['PATH_INFO'],1);
        
        $x = explode('/',$i);
        if (isset($x)) {
            if (!empty($x[2])) {
                $i = str_replace($x[2],'$num',$i);
            }
        }
        
		$this->db->join('menu m', 'm.id = ml.menu_id', 'inner');
		$this->db->like('level', ','.$this->session->userdata('level').',');
		$this->db->where('link', $i);
		$q = $this->db->get('menu_link ml');
		
		if ($q->num_rows() == 0) {
			return false;
		}else{
            return true;
        }
    }
}