<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSerdev extends CI_Model {

    private $t = 'document';
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

     //  Work Order
     public function dt_wo()
     {
         // Definisi
         $condition = [];
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'sdv_wo sw';
         // Set orderable column fields
         $CI->dt->column_order = [null,'service','qty',null,null,'status','activity','remarks'];
         // Set searchable column fields
         $CI->dt->column_search = ['service','qty',null,null,'status','activity'];
         // Set select column fields
         $CI->dt->select = 'sw.id,p.service,pk.qty,sw.status,sw.activity,sw.remarks';
         // Set default order
         $CI->dt->order = ['sw.id' => 'desc'];
 
         $con = ['join','projek_kontrak pk','pk.id = sw.pk_id','inner'];
         array_push($condition,$con);

         $con = ['join','projek p','p.id = pk.projek_id','inner'];
         array_push($condition,$con);
        
         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
 
         $i = @$_POST['start'];
         $del = "'Apakah anda yakin ingin menghapus data ini ?'";
         foreach ($dataTabel as $dt) {
             $i++;
             $jml_install_done = $this->get_install('',$dt->id,'3')->num_rows();
             $jml_install_all = $this->get_install('',$dt->id)->num_rows();
             $persen = '0%';
             if ($jml_install_all > 0) {
                 $persen = @((float)$jml_install_done/(int)$jml_install_all*100).'%';
             }

             $data[] = array(
                 $dt->service,
                 $jml_install_all,
                 $persen,
                 $this->set_status($dt->status),
                 $this->set_activity($dt->activity),
                 $dt->remarks,
                 '<a href="#" data-toggle="modal" data-target="#serdevActivity" onclick="get_serdev_activity('.$dt->id.')" class="btn btn-default btn-sm"><i class="far fa-check-circle"></i></a>
                 <a href="'.site_url('Serdev/detail_project_new?id='.$dt->id).'"><button class="btn btn-sm btn-default text-uppercase font-weight-bold text-gray" ><i class="far fa-eye"></i></button></a>',
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

    public function get_wo($id='',$where='')
     {
        $this->db->select($this->see);
        if ($id != '') {
            $this->db->where('sw.id', $id);
        }

        if ($where != '') {
            $this->db->where($where);
        }

		$q = $this->db->get('sdv_wo sw');
		return $q;
     }

     public function get_device_by_wo($id='')
     {
        $this->db->select('sd.id,sd.sn,sdt.type');
        $this->db->join('scm_purchases sp', 'sp.project_id = sw.pk_id', 'inner');
        $this->db->join('scm_devices sd', 'sd.po_id = sp.id', 'inner');
        $this->db->join('scm_dvc_type sdt', 'sdt.id = sd.type_id', 'inner');

        $this->db->where('sw.id', $id);

        $q = $this->db->get('sdv_wo sw');
        return $q;
     }

    public function in_sdv_wo_activity($activity='',$remarks='',$id='')
    {
       $s = false;
       $upd = ['activity' => $activity,'remarks'=> $remarks];
       $this->db->update('sdv_wo',$upd,['id' => $id]);
       $q = $this->db->affected_rows();
       if ($q > 0) {
           $this->in_sdv_h_wo([
               'sdv_wo_id' => $id,
               'ctdby' => $this->session->userdata('karyawan_id'),
               'ctddate' => date('Y-m-d'),
               'data' => json_encode($upd),
               'remarks' => $remarks
           ]);
           $s = true;
       }
       return $s;
    }

    public function in_sdv_h_wo($obj='')
    {
        $s = false;
        $this->db->insert('sdv_h_wo', $obj);
        $q = $this->db->affected_rows();
        if ($q > 0) {
            $s = true;
        }

        return $s;
    }

    // Install

    //  Work Order
    public function dt_install($sdv_wo_id='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'sdv_install si';
        // Set orderable column fields
        $CI->dt->column_order = [null,'location','pic',null,'status',null,null];
        // Set searchable column fields
        $CI->dt->column_search = ['location','pic','status'];
        // Set select column fields
        $CI->dt->select = 'si.id,si.task,si.exec_id,si.status_exec,si.status,si.pic,si.location,si.remarks,si.install_date';
        // Set default order
        $CI->dt->order = ['si.id' => 'desc'];

        // $con = ['join','projek_kontrak pk','pk.id = si.pk_id','inner'];
        // array_push($condition,$con);

        $con = ['where','sdv_wo_id',$sdv_wo_id];
        array_push($condition,$con);
       
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        $del = "'Apakah anda yakin ingin menghapus data ini ?'";
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->task,
                $dt->location,
                // $dt->pic,
                $this->set_status_tech($dt->status_exec).'<br>'.$this->get_exec($dt)[1],
                $this->set_status($dt->status),
                // $this->get_install_dvc_scm($dt->id)->num_rows(),
                $this->bantuan->tgl_indo($dt->install_date),
                '<a href="#"  style="font-size:12px;margin-right:4px;" data-toggle="modal" data-target="#installation_form" class="btn btn-default btn-sm" onclick="get_install('.$dt->id.')"><i class="far fa-edit"></i></a><a href="#" data-toggle="modal" data-target="#detail_sn"  onclick="get_sn('.$dt->id.')"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:4px 6px !important;font-size: 13px;"><i class="far fa-eye"></i></button></a>',
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

   public function set_status_tech($m='')
   {
        if ($m == '1') {
            return '<span style="background:#8BC34A;border-radius:4px;color:#FFF;font-size:12px;padding:0 10px;">Karyawan</span>';
        }else if ($m == '2') {
            return '<span style="background:#ff9800;border-radius:4px;color:#FFF;font-size:12px;padding:0 10px;">Partner</span>';
        }
   }

   public function get_exec($dt='')
   {
       $id_person = '';
       $person = '';
       if ($dt->status_exec == '1') {
           $q = $this->db->get_where('karyawan', ['id' => $dt->exec_id]);
           $id_person = $q->row()->id;
           $person = $q->row()->nama;
       }else if($dt->status_exec == '2'){
           $q = $this->db->get_where('vnd_partner', ['id' => $dt->exec_id]);
           $id_person = $q->row()->id;
           $person = $q->row()->name;
       }

       return [$id_person,$person];
        
   }

   private function set_status_install($m='')
    {
        if ($m == '1') {
            return 'New';
        }else if ($m == '2') {
            return 'On Pogress';
        }else if ($m == '3') {
            return 'Project';
        }else if ($m == '4') {
            return 'Done';
        }else if ($m == '5') {
            return 'Pending';
        }
    }

    private function set_status_install2($m='')
    {
        if ($m == '1') {
            return 'Terpasang';
        }else if ($m == '0') {
            return 'Belum Terpasang';
        }
    }

    public function get_install($id='',$sdv_wo_id='',$status='')
     {
        $this->db->select($this->see);
        $this->db->join('sdv_wo sw', 'sw.id = si.sdv_wo_id', 'inner');
        
        if ($id != '') {
            $this->db->where('si.id', $id);
        }

        if ($sdv_wo_id != '') {
            $this->db->where('si.sdv_wo_id', $sdv_wo_id);
        }
        
        if ($status != '') {
            $this->db->where('si.status', $status);
        }

		$q = $this->db->get('sdv_install si');
		return $q;
     }

     public function up_install($obj='',$id='')
    {
       $s = false;
       if ($obj == '') {
        return $s;
        }
       $this->db->update('sdv_install',$obj,['id' => $id]);
       return true;
    }

     // Install Devices

     public function get_install_dvc($id='',$sdv_wo_id='',$status_si='')
     {
        $this->db->select($this->see);
        $this->db->join('sdv_install si', 'si.id = sid.sdv_install_id', 'inner');
        $this->db->join('sdv_wo sw', 'sw.id = si.sdv_wo_id', 'inner');
        
        if ($id != '') {
            $this->db->where('si.id', $id);
        }

        if ($sdv_wo_id != '') {
            $this->db->where('si.sdv_wo_id', $sdv_wo_id);
        }
       
        if ($status_si != '') {
            $this->db->where('si.status', $status_si);
        }

		$q = $this->db->get('sdv_install_dvc sid');
		return $q;
    }

     public function get_install_dvc_scm($sdv_install_id='')
     {
        $this->db->select('sid.id,sd.id as device_id,sd.sn,sdt.type');
        $this->db->join('scm_devices sd', 'sd.id = sid.device_id', 'inner');
        $this->db->join('scm_dvc_type sdt', 'sdt.id = sd.type_id', 'left');

        $this->db->where('sid.sdv_install_id', $sdv_install_id);

        $q = $this->db->get('sdv_install_dvc sid');
        return $q;
     }

     public function get_sdv_wo_dvc($sdv_wo_id='',$grp='',$type_id='')
     {
        $this->db->select('sw.id,sd.id as device_id,sd.sn,sdt.type,sd.type_id');
        $this->db->join('scm_purchases sp', 'sp.project_id = sw.pk_id', 'inner');
        $this->db->join('scm_devices sd', 'sd.po_id = sp.id', 'inner');
        $this->db->join('scm_dvc_type sdt', 'sdt.id = sd.type_id', 'left');

        $this->db->where('sw.id', $sdv_wo_id);
        if ($grp == '1') {
            $this->db->group_by('sd.type_id');
        }else if($grp == '2'){
            $this->db->group_by('sd.id');
        }

        if($type_id != ''){
            $this->db->where('sd.type_id',$type_id);
        }

        $q = $this->db->get('sdv_wo sw');
        return $q;
    }

    public function get_device_for_install($sdv_wo_id='')
    {
        $q = $this->db->query("SELECT sd.id as device_id,sd.sn,sdt.type FROM scm_devices sd  INNER JOIN scm_purchase_items spi ON spi.id = sd.po_item_id INNER JOIN scm_purchases sp ON sp.id = spi.po_id INNER JOIN sdv_wo sw ON sw.pk_id = sp.project_id INNER JOIN scm_dvc_type sdt ON sdt.id = sd.type_id  WHERE sw.id = ".$sdv_wo_id." AND sd.sn != '' AND (sd.id NOT IN (SELECT device_id FROM sdv_install_dvc));");
        return $q;
    }

    public function inb_install_dvc($id='',$device_id='')
    {
        $s = true;
        $install_dvc = [];
        if ($id != '' && $device_id != '' && @count($device_id) > 0) {
            foreach ($device_id as $k => $v) {
                $cek = $this->db->get_where('sdv_install_dvc',['device_id' => $v]);
                if($cek->num_rows() == 0){
                    $ind = [
                        'sdv_install_id' => $id,
                        'device_id' => $v,
                        'ctddate' => date('Y-m-d'),
                        'ctdby' => $this->session->userdata('karyawan_id'),
                    ];
    
                    array_push($install_dvc,$ind);
                }
            }
        }
        
       
        if (@count($install_dvc) > 0) {
            $this->db->insert_batch('sdv_install_dvc', $install_dvc);
            $x =   $this->db->affected_rows();
            if($x){
                $s = true;
            }
        }
       
        return $s;
    }

    private function set_status($m='')
    {
        if ($m == '0') {
            return 'Not Started';
        }else if ($m == '1') {
            return 'In Pogress';
        }else if ($m == '2') {
            return 'Pending';
        }else if ($m == '3') {
            return 'Complete';
        }
    }
    
    private function set_activity($m='')
    {
        if ($m == '1') {
            return 'Staging';
        }else if ($m == '2') {
            return 'Shiping';
        }else if ($m == '3') {
            return 'Survey';
        }else if ($m == '4') {
            return 'Installation';
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
                $msg = "Success insert data to Users";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function in_wo($obj='')
    {
        $s = false;
        if ($obj != '') {
            $obj['ctddate'] = date('Y-m-d');
            $obj['ctdby'] = $this->session->userdata('karyawan_id');
            $obj['aktif'] = '1';
            $this->db->insert('sdv_wo', $obj);
            $q = $this->db->affected_rows();
            if ($q > 0) {
                $s = true;
            }
        }

        return $s;
    }

    // Other

    public function getLembur()
    {
        $this->see = "lembur_utama";
        $q = $this->get()->row()->lembur_utama;
        return $q;
    }
    
    // Get Information Project
    public function get_info_project($id)
    {
        $this->db->select($this->see);
        $this->db->join('projek_kontrak pk', 'pk.id = sw.pk_id', 'inner');
        $this->db->join('projek p', 'p.id = pk.projek_id', 'inner');
        $this->db->join('cust c', 'c.id = p.cust_id', 'inner');
        $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
        
        $this->db->where('sw.id', $id);
        $q = $this->db->get('sdv_wo sw');
        return $q;
    }

    // Report Serdev

    // Dtatable  Work Order Service Delivery
    public function dt_wo_report()
    {
        // Definisi
        $condition = [];
        $data = [];
        $nama_tlead = '-';

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        $CI->load->model('MKaryawan', 'mk');

        // Set table name
        $CI->dt->table = 'sdv_wo sw';
        // Set orderable column fields
        $CI->dt->column_order = [null,'service','k.nama','priority','sw.status'];
        // Set searchable column fields
        $CI->dt->column_search = ['service','k.nama'];
        // Set select column fields
        $CI->dt->select = 'sw.id,c.custend,k.nama,sw.priority,sw.team_lead,sw.id,p.service,pk.qty,sw.status,sw.activity,sw.remarks';
        // Set default order
        $CI->dt->order = ['sw.id' => 'desc'];

        $con = ['join','projek_kontrak pk','pk.id = sw.pk_id','inner'];
        array_push($condition,$con);

        $con = ['join','projek p','p.id = pk.projek_id','inner'];
        array_push($condition,$con);

        $con = ['join','karyawan k','k.id = sw.team_lead','left'];
        array_push($condition,$con);
       
        $con = ['join','cust_end c','c.id = p.cust_end_id','inner'];
        array_push($condition,$con);
       
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        $del = "'Apakah anda yakin ingin menghapus data ini ?'";
        foreach ($dataTabel as $dt) {
            $i++;

            if($dt->team_lead != '' || $dt->team_lead != 0) {
                $tech_lead = $this->mk->get($dt->team_lead);
                if ($tech_lead->num_rows() > 0) {
                    $nama_tlead = $tech_lead->row()->nama;
                }   
            }

            $data[] = array(
                $i,
                '<a href="'.site_url('Serdev/detail_project_new?id='.$dt->id).'">'.$dt->custend.' - '.$dt->service.'</a>',
                $dt->nama,
                $dt->priority > 0 ? '<i class="fa fa-star-half-alt"><i>' : '-',
                $this->set_status($dt->status),
                '<a href="#" data-toggle="modal" data-target="#edit_projek" onclick="get_wo('.$dt->id.')" style="font-size:12px;" class="btn btn-sm btn-default"><i class="far fa-edit"></i></a>'
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

   public function up_wo($obj,$id='')
   {
       if ($obj && $id != '') {
           $this->db->update('sdv_wo', $obj,['id' => $id]);
           if ($this->db->affected_rows() > 0) {
                return true;
           }
       }

       return false;
   }

   public function get_grafik_progress($id='',$sdv_wo_id='',$status='')
     {
        $this->db->select('p.service,(select COUNT(*) as jml from sdv_install WHERE sdv_wo_id = si.sdv_wo_id) as jml_all,(select COUNT(*) as jml from sdv_install WHERE status = 3 && sdv_wo_id = si.sdv_wo_id) as jml_done');
        $this->db->join('sdv_wo sw', 'sw.id = si.sdv_wo_id', 'inner');
        $this->db->join('projek_kontrak pk', 'pk.id = sw.pk_id', 'left');
        $this->db->join('projek p', 'pk.projek_id = p.id', 'left');
        
        if ($id != '') {
            $this->db->where('si.id', $id);
        }

        if ($sdv_wo_id != '') {
            $this->db->where('si.sdv_wo_id', $sdv_wo_id);
        }
        
        if ($status != '') {
            $this->db->where('si.status', $status);
        }

        $this->db->group_by('si.sdv_wo_id');

		$q = $this->db->get('sdv_install si');
		return $q;
     }

     public function get_grafik_status($id='',$sdv_wo_id='',$status='')
     {
        $this->db->select("case si.status
        when '0' then 'Not Started'
        when '1' then 'On Progress'
        when '2' then 'Pending'
        when '3' then 'Complete'
        end as status_name,case si.status
        when '0' then '#DDD'
        when '1' then '#ffc107'
        when '2' then '#f44336'
        when '3' then '#8bc34a'
        end as color, count(*) as jml
        ");
       
        if ($sdv_wo_id != '') {
            $this->db->join('sdv_wo sw', 'sw.id = si.sdv_wo_id', 'inner');
            $this->db->where('si.sdv_wo_id', $sdv_wo_id);
        }
        
        if ($id != '') {
            $this->db->where('si.id', $id);
        }
        
        if ($status != '') {
            $this->db->where('si.status', $status);
        }

        $this->db->group_by('si.status');

		$q = $this->db->get('sdv_install si');
		return $q;
     }

     public function get_grafik_obstacle($obstacle='',$sdv_wo_id='',$status='')
     {
        $this->db->select("case sop.obstacle
        when '1' then 'Pending Items'
        when '2' then 'Change Request'
        when '3' then 'Comercial Issue'
        when '4' then 'Principle Issue'
        end as obstacle_name, count(*) as jml
        ");
       
        if ($obstacle != '') {
            $this->db->where('sop.obstacle', $obstacle);
        }

        if ($sdv_wo_id != '') {
            $this->db->where('sop.sdv_wo_id', $sdv_wo_id);
        }
   
        if ($status != '') {
            $this->db->where('sop.status', $status);
        }

        $this->db->group_by('sop.obstacle');

		$q = $this->db->get('sdv_obs_proj sop');
		return $q;
     }

    // Datatable service delivery untuk projek manager
    public function dt_serdev($pk_id='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'sdv_install si';
        // Set orderable column fields
        $CI->dt->column_order = [null,'task','status','install_date'];
        // Set searchable column fields
        $CI->dt->column_search = ['task','install_date'];
        // Set select column fields
        $CI->dt->select = 'si.id,si.task,si.status,si.install_date';
        // Set default order
        $CI->dt->order = ['si.id' => 'desc'];

        $con = ['join','sdv_wo sw','sw.id = si.sdv_wo_id','inner'];
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
                $dt->task,
                $this->set_status_install3($dt->status),
                $this->bantuan->tgl_indo($dt->install_date),
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

   private function set_status_install3($m)
   {
        if ($m == '0') {
            return '<i class="text-primary fa fa-circle"></i>Not Started';
        }else if ($m == '1') {
            return '<i class="text-yellow fa fa-circle"></i>In Pogress';
        }else if ($m == '2') {
            return '<i class="text-red fa fa-circle"></i>Pending';
        }else if ($m == '3') {
            return '<i class="text-green fa fa-circle"></i>Complete';
        }
   }

   public function get_total_install($pk_id='',$sdv_wo_id='',$grp_by='',$where=[])
   {
       $this->db->select($this->see);
       $this->db->join('sdv_wo sw', 'sw.id = si.sdv_wo_id', 'inner');
       if($pk_id != '') $this->db->where('sw.pk_id', $pk_id);
       if($sdv_wo_id != '') $this->db->where('si.sdv_wo_id', $sdv_wo_id);
       if(isset($where)) $this->db->where($where);
       if($grp_by != '') $this->db->group_by($grp_by);
       $q = $this->db->get('sdv_install si');
       return $q;
   }
   
}