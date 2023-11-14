<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDatek extends CI_Model {

    private $t = 'datek';
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

    public function categ($c='')
    {
        if ($c != '') {
             if ($c == 'pp') {
                 return 'Potential Prospect';
             }else if ($c == 'pt') {
                 return 'Potential Target';
             }else if ($c == 'qo') {
                 return 'Qualified Opportunity';
             }
        }
    }

    public function getProjekK($pk_id='')
    {
        $this->db->select($this->see);

        if ($pk_id != '') {
            $this->db->where('pk.id', $pk_id);
        }
        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        $q = $this->db->get('projek_kontrak pk');
        return $q; 
    }

    public function dtDatekProjek()
    {
        // Definisi
        $condition = [];
        $data = [];
        $ax = '';

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'projek_kontrak pk';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'customer','custend','category','service','pk.ctdDate'];
        // Set searchable column fields
        $CI->dt->column_search = ['customer','custend','category','service','pk.ctdDate'];
        // Set select column fields
        $CI->dt->select ='pk.id,customer,custend,category,pk.ctdDate,p.service';
        // Set default order
        $CI->dt->order = ['pk.id' => 'desc'];
        
        $con = ['join','projek p','p.id = pk.projek_id','left'];
        array_push($condition,$con);
        
        $con = ['join','cust c','c.id = p.cust_id','left'];
        array_push($condition,$con);

        $con = ['join','cust_end ec','ec.id = p.cust_end_id','left'];
        array_push($condition,$con);


        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->customer.'<br><span style="background: aquamarine;padding: 0 5px;">'.$dt->custend.'</span>',
                $dt->service,
                $this->categ($dt->category),
                $this->bantuan->tgl_indo($dt->ctdDate),
                '<a id="a" href="'.site_url('Datek/detail_datek?pk='.$dt->id).'"  class="btn btn-info btn-sm tooltiptext" data-toggle="tooltip" data-placement="top" title="Detail Data Teknis"><i class="far fa-eye"></i></a>'
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

    public function dtDatekList($pk_id='')
    {
        // Definisi
        $condition = [];
        $data = [];
        $ax = '';

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'datek_list dl';
        // Set orderable column fields
        $CI->dt->column_order = [null,'layanan','lokasi','provinsi','status','masa_layanan'];
        // Set searchable column fields
        $CI->dt->column_search = ['layanan','lokasi','provinsi','status','masa_layanan'];
        // Set select column fields
        $CI->dt->select ='*';
        // Set default order
        $CI->dt->order = ['dl.id' => 'desc'];
        
        if ($pk_id != '') {
            $con = ['where','dl.pk_id',$pk_id];
            array_push($condition,$con);
        }

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->layanan,
                $dt->lokasi,
                $dt->provinsi,
                $dt->alamat,
                $dt->sid,
                $dt->status,
                $dt->masa_layanan,
                $this->bantuan->tgl_indo($dt->ctddate),
                '<a href="javascript:void(0)" onclick="modal_edit('.$dt->id.')" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>'
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

    public function get_dtk($id='',$where='')
     {
        $this->db->select($this->see);
        if ($id != '') {
            $this->db->where('d.id', $id);
        }

        if ($where != '') {
            $this->db->where($where);
        }

		$q = $this->db->get('datek d');
		return $q;
     }

     public function in_dtk($obj='')
    {
        $s = false;
        if ($obj != '') {
            $obj['ctddate'] = date('Y-m-d');
            $obj['ctdtime'] = date('H:i:s');
            $this->db->insert('datek', $obj);
            $q = $this->db->affected_rows();
            if ($q > 0) {
                $s = true;
            }
        }

        return $s;
    }

    public function in_dtk_list($data='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($data != '') {
            $q = $this->db->insert('datek_list', $data);
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

    public function getDtkList($id='',$limit='')
    {
            $this->db->select($this->see);
            
            if ($id != '') {
                $this->db->where('id', $id);
            }else if($limit != ''){
                $this->db->order_by('id', 'desc');
                $this->db->limit($limit);
            }else {
                $this->db->order_by('id', 'desc');
            }

            $ok = $this->db->get('datek_list dl');
            return $ok;
    }

    public function up_dtk_list($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('datek_list', $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }
}