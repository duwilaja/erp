<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMPurchase extends CI_Model {

    public $t = 'scm_purchases';
	public $ti = 'scm_purchase_items';
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
	
	public function get_item($id='',$where='',$query='',$limit='',$start='')
    {
        $q = false;

        if ($id != '') {
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->ti, [$this->id => $id]);
        }elseif ($where != '') {
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->ti, $where);
        }elseif ($query != '') {
            $q = $this->db->query($query);
        }elseif($limit != ''){
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
            $q = $this->db->get_where($this->ti,$where,$limit,$start);
        }else{
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get($this->ti);
        }

        return $q;
    }
	
	private function attc($f){
		return $f==''?'':'<a target="_blank"  class="btn btn-default btn-sm" href="'.site_url('/data/scm/purchases/').$f.'"><i class="fa fa-file-pdf"></a>';
	}
	private function items($id){
		$url=site_url('SCM/get_purchase_item/'.$id);
		return '<a href="#" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#modal-items" onclick="get_item(\''.$url.'\',\''.$id.'\');"><i class="fa fa-list"></i></a>';
	}

     public function dt()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t.' q';
        // Set orderable column fields
        $CI->dt->column_order = ['purchaseno','ket','dt','project_name','vname','tot'];
        // Set searchable column fields
        $CI->dt->column_search = ['purchaseno', 'ket', 'vname'];
        // Set select column fields
        $CI->dt->select = 'purchaseno,ket,dt,project_name as project,vname as vendor,tot,q.id,attc';
        // Set default order
        $CI->dt->order = ['dt' => 'desc'];

        $condition = [
            //['where',$this->t.'.status',$status],
			//['join','scm_vendors v','v.id = q.vendor_id','left'],
			['join','project p','p.id = q.project_id','left'],
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->purchaseno,
                $dt->ket,
                $dt->dt,
                $dt->project,
				$dt->vendor,
                $dt->tot,
                '<a href="'.site_url('SCM/form_purchase/').$dt->id.'" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a> '.$this->items($dt->id).' '.$this->attc($dt->attc)
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

    public function dt_po_project($projek='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        $CI->load->model('MSCMDevice', 'md');

        // Set table name
        $CI->dt->table = $this->t.' q';
        // Set orderable column fields
        $CI->dt->column_order = ['purchaseno','sv.nama','date_receive','date_deliverd','file'];
        // Set searchable column fields
        $CI->dt->column_search = ['purchaseno', 'sv.nama','date_receive','date_deliverd','file'];
        // Set select column fields
        $CI->dt->select = 'q.id,purchaseno,sv.nama,date_receive,date_deliverd,dt,file';
        // Set default order
        $CI->dt->order = ['q.id' => 'desc'];

        $con = ['join','projek_kontrak pk','pk.id = q.project_id','inner'];
        array_push($condition,$con);

        $con = ['join','scm_vendors sv','sv.id = q.vendor_id','inner'];
        array_push($condition,$con);

        $con = ['where','q.project_id',$projek];
        array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->purchaseno,
                $dt->nama,
                $dt->dt,
                $dt->date_receive   ,
                anchor('SCM/detail_inventory_new?id='.$dt->id, $CI->md->get('',['po_id' => $dt->id])->num_rows()),
				'<a href="'.base_url('data/scm/po/'.$dt->file).'" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-file-alt"></i></a>',
                '<a href="#" class="btn btn-default btn-sm" onclick="get_po('.$dt->id.')" data-toggle="modal" data-target="#detail_device"><i class="fa fa-box"></i></a>'
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
	
	public function dt_rpt()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->ti.' d';
        // Set orderable column fields
        $CI->dt->column_order = [null,'vname','dt','purchaseno','dscr','project_name','qty','unit','curr','price','(qty*price)','status'];
        // Set searchable column fields
        $CI->dt->column_search = ['purchaseno', 'project_name', 'vname', 'dscr','status'];
        // Set select column fields
        $CI->dt->select = 'purchaseno,dt,project_name as project,vname as vendor,tot,attc,dscr,qty,unit,price,curr,status';
        // Set default order
        $CI->dt->order = ['dt' => 'desc'];

        $condition = [
            //['where',$this->t.'.status',$status],
			['join',$this->t.' o','o.id = d.id','left'],
			['join','project p','p.id = o.project_id','left'],
        ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->vendor,
                $dt->dt,
                $dt->purchaseno,
                $dt->dscr,
                $dt->project,
				$dt->qty,
                $dt->unit,
                $dt->curr,
                $dt->price,
                $dt->qty*$dt->price,
                $dt->status,
                $this->attc($dt->attc)
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
	public function del_item($where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($where != '') {
            $q = $this->db->delete($this->ti, $where);
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
	public function in_item($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

		$db_debug=$this->db->db_debug;
		$this->db->db_debug=false;

        if ($obj != '') {
            $q = $this->db->insert($this->ti, $obj);
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
    
    public function in_po_blank()
    {
        $status = false;
        $obj = [
            'ctddate' => date('Y-m-d'),
            'ctdby' => $this->session->userdata('karyawan_id')
        ];

        if ($obj != '') {
            $q = $this->db->insert($this->t, $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data";
                $status = true;
            }else{
                $msg = "Failed insert data";
            }
        }
        
        return [$msg,$status,$id];
    }

    public function get_po_items($id_po='',$type='')
    {
        if($type=='1'){
            // total price
            $this->db->select('sum(price*qty) as tp');
            $this->db->group_by('po_id');
        }
        
        $q = $this->db->get_where('scm_purchase_items',['po_id' => $id_po]);
        return $q;
    }

    public function get_po_item_id($id='')
    {
        $this->db->select($this->see);
        $q = $this->db->get_where('scm_purchase_items spi',['id' => $id]);
        return $q;
    }

    public function get_po_item($id='')
    {
        $this->db->select($this->see);
        $this->db->where('spi.id', $id);
        $this->db->join('scm_purchases sp', 'sp.id = spi.po_id', 'inner');
        $q = $this->db->get('scm_purchase_items spi');
        return $q;
    }

    public function dt_inventory_invoice()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t.' q';
        // Set orderable column fields
        $CI->dt->column_order = ['category','desc','purchase_date',null];
        // Set searchable column fields
        $CI->dt->column_search = ['category', 'desc','purchase_date',null];
        // Set select column fields
        $CI->dt->select = 'id,purchaseno,category,desc,purchase_date,file';
        // Set default order
        $CI->dt->order = ['q.id' => 'desc'];

        // $con = ['join','projek_kontrak pk','pk.id = q.project_id','inner'];
        // array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->purchaseno.'</br>'.
                $this->set_categ($dt->category),
                $dt->desc,
                $this->bantuan->tgl_indo($dt->purchase_date),
                torp(@$this->get_po_items($dt->id,'1')->row()->tp),
				'<a href="'.site_url('SCM/detail_inventory_new?id='.$dt->id).'"><button class="btn btn-default btn-sm" data-target="detail_inventory"><i class="fa fa-box"></i></button></a> '
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

    public function dt_inventory_items($po_id='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'scm_purchase_items spi';
        // Set orderable column fields
        $CI->dt->column_order = ['merek','type','qty','price',null];
        // Set searchable column fields
        $CI->dt->column_search = ['merek', 'type','qty','price',null];
        // Set select column fields
        $CI->dt->select = 'spi.id,merek,type,qty,price';
        // Set default order
        $CI->dt->order = ['spi.id' => 'desc'];

        $con = ['join','scm_dvc_merek sdm','sdm.id = spi.merek_id','left'];
        array_push($condition,$con);

        $con = ['join','scm_dvc_type sdt','sdt.id = spi.type_id','left'];
        array_push($condition,$con);

        if ($po_id != '') {
            $con = ['where','spi.po_id',$po_id];
            array_push($condition,$con);
        }
        

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->merek,
                $dt->type,
                $dt->qty,
                $dt->price,
				$this->cek_inp_sn($dt->id,$dt).' <a href="#" data-toggle="modal" data-target="#modal_list_sn" onclick="detail_list_sn('.$dt->id.')" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>'
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

    public function cek_inp_sn($po_item_id='',$dt='')
    {
        $CI = &get_instance();
        $CI->load->model('MSCMDevice', 'md');
        $q =  $CI->md->get_device_po_item_id($po_item_id);
        if ($q->num_rows() < $dt->qty) {
            return '<a href="#" data-toggle="modal" data-target="#modal_create_sn" onclick="detail_sn('.$dt->id.')" class="btn btn-default btn-sm"><i class="fa fa-barcode"></i></a>';
        }
    }

    private function set_categ($m='')
    {
        if ($m == '1') {
            return 'Property';
        }else if ($m == '2') {
            return 'Electronic';
        }else if ($m == '3') {
            return 'Project';
        }
    }

}