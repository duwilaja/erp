<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProject extends CI_Model {

    private $t = 'projek';
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

    public function getProjek($id='',$status='',$pk='')
    {
        $this->db->select($this->see);
        $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');
        $this->db->join('cust c', 'c.id = p.cust_id', 'left');
        $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
        
        if ($id != '') {
            $this->db->where('id', $id);
        }

        if ($pk != '') {
            $this->db->where('pk.id', $pk);
        }

        if ($status != '') {
            $this->db->where('pk.status', $status);
        }

        $q = $this->db->get('projek p');
        return $q;
    }

    public function getPM($id='')
    {
        $this->db->select($this->see);

        if ($id != '') {
            $this->db->where('pk.id', $id);
        }

        $this->db->join('projek p','p.id = pk.projek_id', 'inner');
        $this->db->join('projek_pm pm', 'pm.pk_id = pk.id', 'left');
        $this->db->join('karyawan k', 'k.id = pm.pm_id', 'inner');
        $q = $this->db->get('projek_kontrak pk');
        return $q; 
    }

    public function dtProjek($status='')
    {
        // Definisi
        $condition = [];
        $data = [];
        $file= '';

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'projek_kontrak pk';
        // Set orderable column fields
        $CI->dt->column_order = [null,'service','qty','pm.status','remarks'];
        // Set searchable column fields
        $CI->dt->column_search = ['service','qty','pm.status','remarks'];
        // Set select column fields
        $CI->dt->select = 'pk.id,service,no_kontrak,qty,pk.pipeline_id,nama,pm.status,remarks';
        // Set default order
        $CI->dt->order = ['pk.id' => 'desc'];

        if ($status != '') {
            $con = ['where','pm.status',$status];
            array_push($condition,$con);
        }

        $con = ['join','projek_pm pm','pm.id = pk.id','left'];
        array_push($condition,$con);

        $con = ['join','projek p','p.id = pk.projek_id','inner'];
        array_push($condition,$con);

        $con = ['join','karyawan k','k.id = pm.pm_id','inner'];
        array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $kl = $this->db->get_where('act_kontrak', ['pipeline_id' => @$dt->pipeline_id]);
            if ($kl->num_rows() > 0) {
                $k = $kl->row();
                $file .= '<a href="'.base_url('data/sls/kontrak/'.$k->kontrak).'" class="btn btn-outline-danger btn-sm ml-1 mr-2">View Kontrak</a>';
            }

            $po = $this->db->get_where('act_po', ['pipeline_id' => $dt->pipeline_id]);
            if ($po->num_rows() > 0) {
                $p = $po->row();
                $file .= '<a href="'.base_url('data/sls/po/'.$p->po).'" class="btn btn-outline-danger btn-sm ml-1 mr-2">View PO</a>';
            }

            $i++;
            $data[] = array(
                $i,
                '<span class="badge badge-light">'.$dt->no_kontrak.'</span>'.$dt->service,
                $dt->qty,
                $file,
                $dt->nama,
                '<a href="'.site_url('pm/project_plan?id='.$dt->id).'" class="btn btn-outline-danger btn-sm ml-1 mr-2">View</a>',
                $this->setStatusPm($dt->status),
                $dt->remarks,
                '<a href="#" onclick="getPK('.$dt->id.')" data-toggle="modal" data-target="#detailModal" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
                <a href="#" onclick="getPK('.$dt->id.')" data-toggle="modal" data-target="#editModal" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a>'
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

    public function setStatusPm($s)
    {
        if($s == 0){
            return "Belum Diproses";
        }else if ($s == 1) {
            return "Planning";
        }else if ($s == 2) {
            return "Waiting For Approval";
        }else if ($s == 3) {
            return "Approved";
        }else if ($s == 4) {
            return "Not Approved";
        }
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
                $msg = "Success insert data";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }


    // Projek Kontrak

    public function dtProjekKontrak()
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'projek p';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'c.customer','ce.custend','pk.total_kon_ppn'];
       // Set searchable column fields
       $CI->dt->column_search = ['c.customer','ce.custend','pk.total_kon_ppn'];
       // Set select column fields
       $CI->dt->select = 'p.id as idp,customer,custend,service,no_kontrak,total_kon_ppn,p.aktif,pk.aktif';
       // Set default order
       $CI->dt->order = ['p.id' => 'desc'];

       if ($aktif != '') {
           $con = ['where','pk.aktif',$aktif];
           array_push($condition,$con);
       }

       $con = ['join','cust c','c.id = p.cust_id','left'];
       array_push($condition,$con);

       $con = ['join','cust_end ce','ce.id = p.cust_end_id','left'];
       array_push($condition,$con);

       $con = ['join','projek_kontrak pk','pk.projek_id = p.id','inner'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $ce = $dt->customer != '' ? $dt->customer.' - '.$dt->custend : $dt->custend;
           $data[] = array(
               $i,
               $dt->customer,
               $dt->custend,
               $dt->service.'</br><span style="color:#d81b60;font-size:12px;">'.$ce."</span>",
               $dt->no_kontrak,
               $dt->start_date.' - '.$dt->end_date,
               torp($dt->total_kon_ppn),
               $this->getTghAktif($dt->aktif),
               '<a href="'.site_url('tagihan/detail_projek/'.$dt->idp).'"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></a>'
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

    public function inPMStatus($obj)
    {
        $status  = false;
        if ($obj != '') {
            $this->db->insert('projek_pm_stat', $obj);
            if ($this->db->affected_rows() > 0) {
                $status = true;
            }
        }
        return $status;
    }

    public function getPMStatus($pm_id='')
    {
        $pms = [];

        if ($pm_id  != '') {
            $this->db->where('pm_id', $pm_id);
        }
        $this->db->order_by('id', 'desc');
        $q = $this->db->get('projek_pm_stat pms');
        if ($q->num_rows() > 0) {
            $qa = $q->result(); 
            foreach ($qa as $v) {
                $data = [
                    'ctdDate' => $v->ctdDate,
                    'status' => $this->setStatusPm($v->status)
                ];

                array_push($pms,$data);
            }
        }

        return $pms;
    }

    // Timeline

    public function getTimeline($pk_id='')
    {
        $q = [];
        
        if ($pk_id != '') {
            $this->db->select($this->see);
            $this->db->where('tt.pk_id', $pk_id);
            $this->db->join('projek_timeline pt', 'pt.id = tt.pt_id', 'inner');
            $this->db->join('projek_kontrak pk', 'pk.id = tt.pk_id', 'inner');
            $this->db->join('projek p', 'p.id = pk.projek_id', 'inner');
            $q = $this->db->get('timeline_task tt');
        }

        return $q;
    }

    public function getPTimeline($pk_id='')
    {
        $q = [];
        
        if ($pk_id != '') {
            $this->db->select($this->see);
            $this->db->where('pt.pk_id', $pk_id);
            $this->db->join('projek_kontrak pk', 'pk.id = pt.pk_id', 'inner');
            $this->db->join('projek p', 'p.id = pk.projek_id', 'inner');
            $q = $this->db->get('projek_timeline pt');
        }

        return $q;
    }

    public function getTimelinePSB($pk_id='',$group_by='')
    {
        $q = [];

        if ($pk_id != '') {
            $this->db->select('model,pk_id,tp.tt_id,jml as nilai');
            $this->db->where('tp.pk_id', $pk_id);
            $this->db->join('scm_devices sd', 'sd.id = tp.device_id', 'inner');
            if ($group_by !=  '') {
                $this->db->group_by($group_by);
            }
            $q = $this->db->get('timeline_psb tp');
        }

        return $q;
    }

    public function getTimelineDISMANTLE($pk_id='',$group_by='')
    {
        $q = [];
        
        if ($pk_id != '') {
            $this->db->select('model,pk_id,tp.tt_id,jml as nilai');
            $this->db->where('tp.pk_id', $pk_id);
            $this->db->join('scm_devices sd', 'sd.id = tp.device_id', 'inner');
            if ($group_by !=  '') {
                $this->db->group_by($group_by);
            }
            $q = $this->db->get('timeline_dismantle tp');
        }

        return $q;
    }

    public function setKategoriTimeline($s='')
    {
       if ($s == 1) {
            return "Kegiatan";
        }else if ($s == 2) {
            return "Implementasi dan Dimantle";
        }else if ($s == 3) {
            return "Dokumentasi";
        }
    }

    // dt customer device projek kontrak
    public function dt_cust_projek_kontrak($aktif='1')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'projek p';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'p.service','ce.custend'];
       // Set searchable column fields
       $CI->dt->column_search = ['p.service','ce.custend'];
       // Set select column fields
       $CI->dt->select = 'pk.id,p.id as idp,custend,service';
       // Set default order
       $CI->dt->order = ['p.id' => 'desc'];

       if ($aktif != '') {
           $con = ['where','pk.aktif',$aktif];
           array_push($condition,$con);
       }

       $con = ['join','cust_end ce','ce.id = p.cust_end_id','left'];
       array_push($condition,$con);

       $con = ['join','projek_kontrak pk','pk.projek_id = p.id','inner'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->service,
               $dt->custend,
               '<a href="'.site_url('oprations/detail_cd/'.$dt->id).'"><button class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></button></a>'
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

    // File Kontrak
    public function get_file_kontrak($pk_id='')
    {
        $this->db->order_by('pkf.id', 'desc');
        $q = $this->db->get_where('projek_k_file pkf',['pkf.pk_id' => $pk_id]);
        return $q;
    }

    // Mendapatkan file po berdsarkan projek
    public function get_po_by_projek($pk_id='')
    {   
        $this->db->order_by('ap.id', 'desc');
        $this->db->join('projek_kontrak pk', 'pk.pipeline_id = ap.pipeline_id', 'inner');
        $q = $this->db->get_where('act_po ap',['ap.pipeline_id' => $pk_id]);
        return $q;
    }
    public function dt_pilih_projek($aktif='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'projek p';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'p.service','ce.custend'];
       // Set searchable column fields
       $CI->dt->column_search = ['p.service','ce.custend'];
       // Set select column fields
       $CI->dt->select = 'pk.id,p.id as idp,custend,service,p.status';
       // Set default order
       $CI->dt->order = ['p.id' => 'desc'];
       
    //    if ($aktif != '') {
    //     $con = ['where','pk.aktif',$aktif];
    //     array_push($condition,$con);
    //     }

        $con = ['where','pk.pm =','0'];
        array_push($condition,$con);

       $con = ['join','cust_end ce','ce.id = p.cust_end_id','left'];
       array_push($condition,$con);
       
       $con = ['join','projek_kontrak pk','pk.projek_id = p.id','left'];
       array_push($condition,$con);
       
       $con = ['join','projek_pm pm','pm.pk_id = pk.id','left'];
       array_push($condition,$con);

       $con = ['where','pk.pm !=',$this->session->userdata('karyawan_id')];
       array_push($condition,$con);
       
       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->service,
               $dt->custend,
               '<a href="javascript:void(0);" onclick="pilih_projek('.$dt->id.','.$dt->status.')" class="btn btn-dark btn-sm"><i class="fas fa-check"></i></a>'
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

    public function dt_projek()
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'projek_pm ppm';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'p.service','pk.status','pk.work_devision','k.nama'];
       // Set searchable column fields
       $CI->dt->column_search = ['p.service','pk.status','k.nama'];
       // Set select column fields
       $CI->dt->select = 'ppm.id,pk.id as id,pk_id,p.service,ppm.status,pk.work_devision,ppm.ctd_by,k.nama';
       // Set default order
       
       $CI->dt->order = ['ppm.id' => 'desc'];

       if ($this->session->userdata('level') == '68') {
           $con = ['where','ppm.ctd_by',$this->session->userdata('karyawan_id')];
           array_push($condition,$con);
       }

       $con = ['join','projek_kontrak pk','pk.id = ppm.pk_id','left'];
       array_push($condition,$con);

       $con = ['join','projek p','p.id = pk.projek_id','left'];
       array_push($condition,$con);

       $con = ['join','karyawan k','k.id = ppm.ctd_by','left'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->service,
               $this->setStatusProj($dt->status),
               $this->setDevision($dt->work_devision),
               $dt->nama,
               '<a href="'.site_url('pm/detail_work_order/'.$dt->pk_id).'"><button class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></button></a>'
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

    public function setDevision($s)
    {
        if($s == 1){
            return "Development";
        }else if ($s == 2) {
            return "Serdev";
        }else if ($s == 3) {
            return "Development & Serdev";
        }
    }

    public function setStatusProj($s)
    {
        if($s == 1){
            return "Approval";
        }else if ($s == 2) {
            return "DRM";
        }else if ($s == 3) {
            return "KOM";
        }else if ($s == 4) {
            return "Implementasi Projek";
        }else if ($s == 5) {
            return "BAST Projek";
        }else if ($s == 6) {
            return "Closed";
        }
    }

    public function upProj($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('projek_kontrak', $obj,$where);
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

    public function inProjPm($data='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($data != '') {
            $q = $this->db->insert('projek_pm', $data);
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

    public function dt_projek_trouble($aktif='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'projek_trouble pt';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'p.service'];
       // Set searchable column fields
       $CI->dt->column_search = ['p.service'];
       // Set select column fields
       $CI->dt->select = 'pt.id,pk.id,p.id as id,pt.pk_id,pt.ctd_by,service,count(*) as kendala';
       // Set default order
       
       $CI->dt->order = ['pt.id' => 'desc'];
       $this->db->group_by('pt.pk_id');

       if ($aktif != '') {
           $con = ['where','pk.aktif',$aktif];
           array_push($condition,$con);
       }

       if ($this->session->userdata('level') == '68') {
        $con = ['where','pt.ctd_by',$this->session->userdata('karyawan_id')];
        array_push($condition,$con);
        }

       $con = ['join','projek_kontrak pk','pk.id = pt.pk_id','left'];
       array_push($condition,$con);

       $con = ['join','projek_pm ppm','ppm.id = pt.ppm_id','left'];
       array_push($condition,$con);

       $con = ['join','projek p','p.id = pk.projek_id','left'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->service,
               $dt->kendala,
               '<a href="'.site_url('pm/detail_control_project/'.$dt->pk_id.'?pk='.$dt->pk_id).'"><button class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></button></a>'
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

    public function getProjekTrouble($pk_id='')
    {
        $this->db->select($this->see);

        if ($pk_id != '') {
            $this->db->where('pt.pk_id', $pk_id);
        }

        $this->db->join('projek_kontrak pk','pk.id = pt.pk_id', 'left');
        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        // $this->db->join('karyawan k', 'k.id = pm.pm_id', 'inner');
        $q = $this->db->get('projek_trouble pt');
        return $q; 
    }

    public function getCountTrouble($id)
    {
        $this->db->select($this->see);

        if ($id != '') {
            $this->db->where('pt.pk_id', $id);
        }

        $q = $this->db->get('projek_trouble pt');
        return $q->num_rows(); 
    }

    public function getCust($id)
    {
        $this->db->select($this->see);

        if ($id != '') {
            $this->db->where('pk.id', $id);
        }

        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        $this->db->join('cust c','c.id = p.cust_id','left');
        $q = $this->db->get('projek_kontrak pk');
        return $q; 
    }

    public function getCustend($id)
    {
        $this->db->select($this->see);

        if ($id != '') {
            $this->db->where('pk.id', $id);
        }

        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        $this->db->join('cust_end ce','ce.id = p.cust_end_id','left');
        $q = $this->db->get('projek_kontrak pk');
        return $q; 
    }

    public function getProjPm($id)
    {
        $this->db->select('pm.id,service,pm.status');

        if ($id != '') {
            $this->db->where('pm.pk_id', $id);
        }

        $this->db->join('projek_kontrak pk','pk.id = pm.pk_id', 'left');
        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        $q = $this->db->get('projek_pm pm');
        return $q; 
    }

    public function getPK($id)
    {
        $this->db->select('*');

        if ($id != '') {
            $this->db->where('pk.id', $id);
        }

        // $this->db->join('projek_kontrak pk','pk.id = pm.pk_id', 'left');
        // $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        $q = $this->db->get('projek_kontrak pk');
        return $q; 
    }

    public function dt_trouble($aktif='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'projek_trouble pt';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'pt.kendala'];
       // Set searchable column fields
       $CI->dt->column_search = ['pt.kendala'];
       // Set select column fields
       $CI->dt->select = 'pk_id,ctd_date,kendala';
       // Set default order
       
       $CI->dt->order = ['pt.pk_id' => 'desc'];

       if ($aktif != '') {
           $con = ['where','pt.pk_id',$aktif];
           array_push($condition,$con);
       }

    //    $con = ['join','projek_kontrak pk','pk.id = pt.pk_id','left'];
    //    array_push($condition,$con);

    //    $con = ['join','projek p','p.id = pk.projek_id','left'];
    //    array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->kendala,
               $dt->ctd_date,
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
    
    public function in_data_kendala($data='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($data != '') {
            $q = $this->db->insert('projek_trouble', $data);
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

    public function upProjPm($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('projek_pm', $obj,$where);
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
    public function getFilePm($get_kategori='', $get_projek='',$limit='', $start='', $get_cari='',$get_where="",$where="",$status="")
    {
        $this->db->order_by("id", "DESC");
        if (!empty($get_projek) && empty($get_kategori) && empty($get_cari)) {
            $this->db->where('pk_id', $get_projek);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }
        
        if (!empty($get_projek) && !empty($get_kategori) && empty($get_cari)) {
            $this->db->where('pk_id', $get_projek);
            $this->db->like('file', $get_kategori);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (!empty($get_projek) && empty($get_kategori) && !empty($get_cari)) {
            $this->db->where('pk_id', $get_projek);
            $this->db->like('nama_file', $get_cari);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (!empty($get_projek) && !empty($get_kategori) && !empty($get_cari)) {
            $this->db->where('pk_id', $get_projek);
            $this->db->like('file', $get_kategori);
            $this->db->like('nama_file', $get_cari);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (empty($get_projek) && !empty($get_kategori) && !empty($get_cari)) {
            $this->db->like('file', $get_kategori);
            $this->db->like('nama_file', $get_cari);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (empty($get_projek) && !empty($get_kategori) && empty($get_cari)) {
            $this->db->like('file', $get_kategori);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (empty($get_projek) && empty($get_kategori) && !empty($get_cari)) {
            $this->db->like('nama_file', $get_cari);
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (empty($get_projek) && empty($get_kategori) && empty($get_cari)) {
            $this->db->select('*');
            $this->db->where('status','1');
            $this->db->limit($limit, $start);
            $q = $this->db->get('projek_k_file');
        }

        if (!empty($get_where)) {
            $this->db->order_by("id", "DESC");
            $this->db->select('*');
            $this->db->where($get_where,$where);
            $this->db->where('status',$status);
            $q = $this->db->get('projek_k_file');
        }
        
        return $q; 
    }

    public function getProjekPm()
    {
        $this->db->select($this->see);
        $this->db->join('projek_kontrak pk', 'pk.id = pm.pk_id', 'left');
        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        
        $q = $this->db->get('projek_pm pm');
        return $q;
    }

    public function inProjekKontrakFile($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert("projek_k_file", $obj);
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

    public function upProjekKontrakFile($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('projek_k_file', $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }

    public function get_drm($id='',$where='')
     {
        $this->db->select($this->see);
        if ($id != '') {
            $this->db->where('pd.id', $id);
        }

        if ($where != '') {
            $this->db->where($where);
        }

		$q = $this->db->get('pm_drm pd');
		return $q;
     }

    public function in_drm($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert("pm_drm", $obj);
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

    public function inProjekHistory($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert("projek_k_histori", $obj);
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

    public function dt_pk_histori($pk_id='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'projek_k_histori pkh';
        // Set orderable column fields
        $CI->dt->column_order = [null,'nama'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama'];
        // Set select column fields
        $CI->dt->select = 'pkh.id,pkh.nama_file,pkh.keterangan,pkh.ctdDate,k.nama';
        // Set default order
        $CI->dt->order = ['pkh.id' => 'desc'];

        $con = ['join','karyawan k','k.id = pkh.ctdBy','left'];
        array_push($condition,$con);

        $con = ['where','pk_id',$pk_id];
        array_push($condition,$con);
       
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $dt->keterangan,
                $dt->ctdDate,
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
}