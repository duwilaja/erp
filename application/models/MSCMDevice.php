<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMDevice extends CI_Model {

    public $t = 'scm_devices';
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
        $condition = [];
        $data = [];

        $device = $this->input->post('device');
        $project = $this->input->post('project');
        $status = $this->input->post('status');
        $used = $this->input->post('used');
        $allocation = $this->input->post('allocation');

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t.' d';
        // Set orderable column fields
        $CI->dt->column_order = ['sn','model','po','received','project','delivered','d.status','allocation','used'];
        // Set searchable column fields
        $CI->dt->column_search = ['sn', 'model'];
        // Set select column fields
        $CI->dt->select = 'sn,model,po,received,project,delivered,d.status,d.ket,d.id,allocation,used,p.service';
        // Set default order
        $CI->dt->order = ['d.ctddate' => 'desc'];

        if ($device != '') {
            $con = ['where','model',$device];
            array_push($condition,$con);
        } 
        
        if ($project != '') {
            $con = ['where','project',$project];
            array_push($condition,$con);
        } 

        if ($status != '') {
            $con = ['where','d.status',$status];
            array_push($condition,$con);
        } 

        if ($used != '') {
            $con = ['where','used',$used];
            array_push($condition,$con);
        } 

        if ($allocation != '') {
            $con = ['where','allocation',$allocation];
            array_push($condition,$con);
        } 

       $con = ['join','projek_kontrak pk','pk.id = d.project','left'];
       array_push($condition,$con);

       $con = ['join','projek p','p.id = pk.projek_id','left'];
       array_push($condition,$con);


        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->sn,
                $dt->model,
                $dt->po,
                $dt->received,
                $dt->service,
                $dt->delivered,
                $dt->status,
                $dt->allocation,
                $dt->used,
                str_ireplace("\n","<br />",$dt->ket),
                '<a href="'.site_url('SCM/h_device?dv_id='.$dt->id).'" class="btn btn-sm btn-default"><i class="fa fa-history"></i></a> 
                <a href="'.site_url('SCM/form_device/').$dt->id.'" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>',
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

    public function get_device_grp_by($field='',$value='')
    {
        $this->db->select($this->see);
        if ($field != '' && $value != '') {
            $this->db->where($field, $value);
        }

        if ($field == 'project') {
            $this->db->join('projek_kontrak pk', 'pk.id = d.project', 'left');
            $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        }

        $this->db->group_by($field);
        $q = $this->db->get($this->t.' d');
       return $q;
    }

    public function dt_by_device()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        $allocation = $this->input->post('allocation');

        // Set table name
        $CI->dt->table = $this->t.' d';
        // Set orderable column fields
        $CI->dt->column_order = ['model'];
        // Set searchable column fields
        $CI->dt->column_search = ['model'];
        // Set select column fields
        $CI->dt->select = '*';
        // Set default order
        $CI->dt->order = ['d.ctddate' => 'desc'];
        
        $this->db->group_by('model');

        if ($allocation != '') {
            $con = ['where','allocation',$allocation];
            array_push($condition,$con);
        } 
        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);
        $qnew = $this->db->query($this->db->last_query());
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                anchor('SCM/list_device?device='.$dt->model, $dt->model, ''),
                $this->get('',['model' => $dt->model])->num_rows(),
                $this->get('',['model' => $dt->model,'used' => 'y'])->num_rows(),
                $this->get('',['model' => $dt->model,'used' => 'n'])->num_rows(),
                $this->get('',['model' => $dt->model,'status' => 'baik'])->num_rows(),
                $this->get('',['model' => $dt->model,'status' => 'rusak'])->num_rows(),
            );
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $qnew->num_rows(),
            "recordsFiltered" => $qnew->num_rows(),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function dt_stock_device_opr()
    {
        // Definisi
        $condition = [];
        $data = [];


        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        $allocation = $this->input->post('allocation');
        $type = $this->input->post('type');

        // Set table name
        $CI->dt->table = $this->t.' d';
        // Set orderable column fields
        $CI->dt->column_order = ['model'];
        // Set searchable column fields
        $CI->dt->column_search = ['model','sn','mac'];
        // Set select column fields
        $CI->dt->select = '*';
        // Set default order
        $CI->dt->order = ['d.ctddate' => 'desc'];
                
        if ($type == 'client') {

            $this->db->group_by('sn');

            $CI->dt->select = 'd.*,p.service,c.custend,c.id as custid,pk.id as pkid';

            $con = ['join','projek_kontrak pk','pk.id = d.project','inner'];
            array_push($condition,$con);

            $con = ['where','pk.aktif','1'];
            array_push($condition,$con);
     
            $con = ['join','projek p','p.id = pk.projek_id','inner'];
            array_push($condition,$con);

            $con = ['join','cust_end c','c.id = p.cust_end_id','inner'];
            array_push($condition,$con);
        }else if($type=="group"){
            $this->db->group_by('model');
        }else if($type=="all"){
            $con = ['where','allocation','operation'];
            array_push($condition,$con);
        } 

        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);
        $qnew = $this->db->query($this->db->last_query());
        

        $i = @$_POST['start'];
        if ($type == 'all') {
            foreach ($dataTabel as $dt) {
                $i++;
                $data[] = array(
                    $dt->model,
                    $dt->sn,
                    $dt->status,
                    $dt->ket,
                    '<a href="'.site_url('Oprations/manage_device?id='.$dt->id).'" class="btn btn-default btn-sm">Edit</a> '.$this->cek_rma($dt->status,$dt->id)
                );
            }
        }else if($type == 'group'){
            foreach ($dataTabel as $dt) {
                $i++;
                $data[] = array(
                    $dt->model,
                    $this->get('',['model' => $dt->model])->num_rows(),
                    $this->get('',['model' => $dt->model,'used' => 'y'])->num_rows(),
                    $this->get('',['model' => $dt->model,'used' => 'n'])->num_rows(),
                    $this->get('',['model' => $dt->model,'status' => 'baik'])->num_rows(),
                    $this->get('',['model' => $dt->model,'status' => 'rusak'])->num_rows(),
                );
            }
        }else if ($type == 'client') {
            foreach ($dataTabel as $dt) {
                $i++;
                $data[] = array(
                    $dt->model,
                    $dt->sn,
                    anchor('Oprations/detail_cd/'.$dt->pkid,$dt->custend.'</br>'.$dt->service, 'target="_blank"'),
                    $dt->status,
                    $dt->ket,
                    '<a target="_blank" href="'.site_url('Oprations/replace?edit=true&cust='.$dt->custid.'&device_id='.$dt->id).'" class="btn btn-default btn-sm" >Replace</a>'
                );
            }
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $qnew->num_rows(),
            "recordsFiltered" => $qnew->num_rows(),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function cek_rma($s='',$id='')
    {
        if($s == 'rusak') return '<a target="_blank" href="'.site_url('Oprations/rma?edit=true&device_id='.$id).'" class="btn btn-default btn-sm" >RMA</a>';
    }

    //History Device

    public function in_h_device($ket='',$device_id='')
    {
        $in = false;
        
        if ($ket != '' && $device_id != '') {
            $object = [
                'ket' => $ket,
                'device_id' => $device_id,
                'ctddate'=> date('Y-m-d H:i:s'),
                'ctdby' => $this->session->userdata('karyawan_id')
            ];
    
            $in = $this->db->insert('scm_h_device', $object);
            if ($this->db->affected_rows() > 0) {
                $in = true;
            }
        }
        
        return $in;
    }

    public function dt_h_device()
    {
        // Definisi
        $condition = [];
        $data = [];

        $device_id = $this->input->post('device_id');

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'scm_h_device hd';
        // Set orderable column fields
        $CI->dt->column_order = ['ket','ctddate'];
        // Set searchable column fields
        $CI->dt->column_search = ['ket','ctddate'];
        // Set select column fields
        $CI->dt->select = '*';
        // Set default order
        $CI->dt->order = ['hd.ctddate' => 'desc'];

        if ($device_id != '') {
            $con = ['where','device_id',$device_id];
            array_push($condition,$con);
        } 


        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);

        $i = @$_POST['start'];
        if ($device_id != '') {
            foreach ($dataTabel as $dt) {
                $data[] = array(
                    $dt->ket,
                    $dt->ctddate
                );
            }
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

     // Replace device 
     public function dt_device_replace()
     {
          // Definisi
          $condition = [];
          $data = [];
   
          $CI = &get_instance();
          $CI->load->model('DataTable', 'dt');
   
          // Set table name
          $CI->dt->table = 'scm_dvc_replace dr';
          // Set orderable column fields
          $CI->dt->column_order = [null,'custend' ,'model' ,'node_id' ,'sn_old' ,'sn_new','ctddate'];
          // Set searchable column fields
          $CI->dt->column_search = ['custend' ,'model' ,'node_id' ,'sn_old' ,'sn_new','ctddate'];
          // Set select column fields
          $CI->dt->select = 'dr.id,sd.id as device_id,custend ,model ,node_id ,sn_old ,sn_new';
          // Set default order
          $CI->dt->order = ['dr.id' => 'desc'];
          
          $con = ['join','scm_devices sd','sd.id = dr.device_new','inner'];
          array_push($condition,$con);
   
          $con = ['join','projek_kontrak pk','pk.id = sd.project','inner'];
          array_push($condition,$con);
   
          $con = ['join','projek p','p.id = pk.projek_id','inner'];
          array_push($condition,$con);
   
          $con = ['join','cust_end ce','ce.id = p.cust_end_id','inner'];
          array_push($condition,$con);
   
          // Fetch member's records
          $dataTabel = $this->dt->getRows($_POST, $condition);
          
          $i = @$_POST['start'];
          foreach ($dataTabel as $dt) {
              $i++;
              $data[] = array(
                  $i,
                  $dt->custend,
                  $dt->node_id,
                  $dt->model,
                  $dt->sn_old,
                  $dt->sn_new,
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
     
     public function cek_device_by_cust($id='')
     {
        $this->db->select($this->see);
		$this->db->join('projek_kontrak pk', 'pk.id = sd.project', 'inner');
		$this->db->join('projek p', 'p.id = pk.projek_id', 'inner');
		$this->db->where('p.cust_end_id', $id);
		$q = $this->db->get('scm_devices sd');
		return $q;
     }

     public function in_replace_device($device_old='',$device_new='',$date_replace='')
     {
         $status = false;

         if($device_old == '' || $device_old == '') return $status;

         $dold = $this->get($device_old)->row();
         $sn_old = $dold->sn; 
         $pk_id = $dold->project; 
         $sn_new = $this->get($device_new)->row()->sn;

        //  ubah status device baru dan mengalokasikan ke client
        $this->db->update('scm_devices', ['allocation' => 'client','project' => $pk_id,'used' => 'y'], ['id' => $device_new]);

        //  ubah status device lama
        $this->db->update('scm_devices', ['allocation' => 'operation','status' => 'rusak','project' => '','used' => 'n'], ['id' => $device_old]);

         $obj = [
             'device_old' => $device_old,
             'device_new' => $device_new,
             'sn_old' => $sn_old,
             'sn_new' => $sn_new,
             'pk_id' => $pk_id,
             'ctddate' => date('Y-m-d'),
             'date_replace' => $date_replace,
         ];

         $this->db->insert('scm_dvc_replace', $obj);
         if ($this->db->affected_rows() > 0) {
            $status = true;
         }

         return $status;
     }

     // RMA device 

     public function get_device_rma($device_id='')
     {
        $this->db->select($this->see);
        $this->db->join('scm_devices sd', 'sd.id = scr.device_id', 'inner');
        $this->db->where('scr.device_id', $device_id);
		$q = $this->db->get('scm_dvc_rma scr');
		return $q;
     }

     public function dt_device_rma()
     {
          // Definisi
          $condition = [];
          $data = [];
   
          $CI = &get_instance();
          $CI->load->model('DataTable', 'dt');
   
          // Set table name
          $CI->dt->table = 'scm_dvc_rma r';
          // Set orderable column fields
          $CI->dt->column_order = [null,'model' ,'sn' ,'r.status'];
          // Set searchable column fields
          $CI->dt->column_search = ['model' ,'sn' ,'r.status'];
          // Set select column fields
          $CI->dt->select = 'r.id,d.id as device_id,model,sn,date_rma,r.status,r.ket';
          // Set default order
          $CI->dt->order = ['r.id' => 'desc'];
          
          $con = ['where','aktif',1];
          array_push($condition,$con);

          $con = ['join','scm_devices d','d.id = r.device_id','inner'];
          array_push($condition,$con);

          $con = ['where','d.status','rusak'];
          array_push($condition,$con);
   
          // Fetch member's records
          $dataTabel = $this->dt->getRows($_POST, $condition);
          
          $i = @$_POST['start'];
          foreach ($dataTabel as $dt) {
              $i++;
              $data[] = array(
                  $i,
                  $dt->model,
                  $dt->sn,
                  $this->status_rma($dt->status),
                  $dt->ket,
                  '<button type="button" class="btn btn-default btn-sm w-100" data-toggle="modal" data-target="#editModal"  onclick="get_rma_device('.$dt->id.','.$dt->device_id.')">RMA</button>'
              );
          }
   
          $output = array(
              "raw" => @$_POST['raw'],
              "recordsTotal" => $this->dt->countAll($condition),
              "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
              "data" => $data,
          );
   
          // Output to JSON format
          return json_encode($output);
     }
     
     public function status_rma($v='')
     {
       if ($v == 1) {
        return 'Diperbaiki';
       }else if($v == 2){
        return 'Ganti Baru';
       }else if($v == 3){
        return 'Sudah Diperbaiki';
       }else{
           return  '-';
       }
     }

     public function in_rma_device($device_id='')
     {
        $status = false;
        $rma = $this->db->get_where('scm_dvc_rma',['device_id' => $device_id]);
        if ($rma->num_rows() > 0) {
            $r = $rma->row();
            if ($r->aktif == 0) {
                $this->db->update('scm_dvc_rma', ['aktif' => 1], ['device_id' => $device_id]);
            }
        }else{
            $this->db->insert('scm_dvc_rma', [
                'device_id' => $device_id,
                'ctddate' => date('Y-m-d'),
                'ctdby' => $this->session->userdata('karyawan_id'),
                'aktif' => 1
            ]);
            
            $in = $this->db->affected_rows();
            if ($in) {
                $status = true;
            }
        }

        return $status;
        
     }

     public function up_rma_device($device_id='',$status='',$date_rma='',$ket='')
     {
         $s = false;
         $aktif = 1;
         $date_fix_rma = '';

         if($device_id == '') return $status;

         if ($status == 3) {
            //  ubah status device lama
            $this->db->update('scm_devices', ['allocation' => 'operation','status' => 'baik','used' => 'n'], ['id' => $device_id]);
            $aktif = 0;
            $date_fix_rma = date('Y-m-d');
            $status = 0;
         }
         
         $obj = [
             'status' => $status,
             'date_rma' => $date_rma,
             'aktif' => $aktif,
             'ket' => $ket,
             'date_fix_rma' => $date_fix_rma,
         ];

         $this->db->update('scm_devices', ['ket' => $ket], ['id' => $device_id]);

         $this->db->update('scm_dvc_rma', $obj,['device_id' => $device_id]);
         if ($this->db->affected_rows() > 0) {
            $s = true;
         }

         return $s;
     }

    //  Device Merek

    // Device SN
    public function in_device_sn($obj='')
    {
        if ($obj != '') {
            $this->db->insert('scm_devices', $obj);
        }
    }

    public function get_dvc_merek($w='')
    {
        if ($w != '') {
            $q = $this->db->get_where('scm_dvc_merek',$w);
        }else{
            $q = $this->db->get('scm_dvc_merek');
        }

        return $q;
    }

    public function in_dvc_merek()
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert('scm_dvc_merek', $obj);
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

    public function dt_merek()
     {
         // Definisi
         $condition = [];
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'scm_dvc_merek sdm';
         // Set orderable column fields
         $CI->dt->column_order = [null,'merek','solution',null];
         // Set searchable column fields
         $CI->dt->column_search = ['merek','solution'];
         // Set select column fields
         $CI->dt->select = 'sdm.id,merek,solution';
         // Set default order
         $CI->dt->order = ['sdm.id' => 'desc'];

         $con2 = ['join','sales_solution ss','ss.id = sdm.solution_id','left'];
         array_push($condition,$con2);

         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
 
         $i = $_POST['start'];
         $del = "'Apakah anda yakin ingin menghapus data ini ?'";
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                 $i,
                 $dt->solution,
                 $dt->merek,
                 '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#model_form_edit"  onclick="get_edit('.$dt->id.')">Edit</button> <a onclick="del_merek('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

    //  Device Type
    public function dt_type()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'scm_dvc_type sdt';
        // Set orderable column fields
        $CI->dt->column_order = [null,'merek','type',null];
        // Set searchable column fields
        $CI->dt->column_search = ['merek','type'];
        // Set select column fields
        $CI->dt->select = 'sdt.id,sdt.merek_id,,merek,type';
        // Set default order
        $CI->dt->order = ['sdt.id' => 'desc'];

        $con = ['join','scm_dvc_merek sdm','sdm.id = sdt.merek_id','inner'];
        array_push($condition,$con);
       
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        $del = "'Apakah anda yakin ingin menghapus data ini ?'";
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->merek,
                $dt->type,
                '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#model_form_edit"  onclick="get_edit('.$dt->id.')">Edit</button>',
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

    public function get_dvc_type($w='')
    {
        if ($w != '') {
            $q = $this->db->get_where('scm_dvc_type',$w);
        }else{
            $q = $this->db->get('scm_dvc_type');
        }
        
        return $q;
    }

    public function in_dvc_type()
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert('scm_dvc_type', $obj);
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
    
     public function dt_inventory($type='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'scm_devices sd';
        // Set orderable column fields
        $CI->dt->column_order = ['sd.category','merek','type','dt',null,'sd.price',null];
        // Set searchable column fields
        $CI->dt->column_search = ['sd.category','merek','type','dt',null,'sd.price',null];
        // Set select column fields
        $CI->dt->select = 'sd.id,sd.category,merek,sd.merek_id,type,sp.dt,sd.price,count(*) as type_count,sum(sd.price) as price_count,type_id';
        // Set default order
        $CI->dt->order = ['sd.id' => 'desc'];

        $con = ['join','scm_dvc_merek m','m.id = sd.merek_id','inner'];
        array_push($condition,$con);

        $con = ['join','scm_dvc_type t','t.id = sd.type_id','inner'];
        array_push($condition,$con);

        if ($type != '') {
            $CI->dt->select = 'sd.sn,status,mutation,alokasi_dvc,handover_date,category';

            $con = ['where','type_id',$type];
            array_push($condition,$con);
        }else{
            $con = ['join','scm_purchases sp','sp.id = sd.po_id','left'];
            array_push($condition,$con);

            $this->db->group_by('sd.type_id');        
        }
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        $qgrp = $this->db->query($this->db->last_query())->num_rows();

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
             
            if ($type != '') {
                $data[] = array(
                    //$i,
                    $this->set_categ($dt->category),
                    $dt->sn,
                    $dt->status,
                    $this->set_mutation($dt->mutation),
                    $dt->alokasi_dvc,
                    $dt->handover_date,
                );
            }else{
                $data[] = array(
                    //$i,
                    // $this->set_categ($dt->category),
                    $dt->merek,
                    $dt->type,
                    // $dt->dt,
                    $dt->type_count,
                    // $dt->price,
                    // $dt->price_count,
                    '<a href="'.site_url('SCM/detail_inventory?type='.$dt->type_id.'&merek='.$dt->merek_id.'&categ='.$dt->category).'"><button class="btn btn-default btn-sm" data-target="detail_inventory"><i class="fa fa-box"></i></button></a>'
                    // $CI->md->get('',['po_id' => $dt->id])->num_rows(),
                    // '<a href="'.base_url('data/scm/po/'.$dt->file).'" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-file-alt"></i></a>',
                    // '<a href="#" class="btn btn-default btn-sm" onclick="get_po('.$dt->id.')" data-toggle="modal" data-target="#detail_device"><i class="fa fa-box"></i></a>'
                );
            }
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

    public function dt_all_inventory($category='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_devices sd';
       // Set orderable column fields
       $CI->dt->column_order = [null,'sd.category' ,'merek' ,'type','sn','sd.status','dt','mutation','alokasi_dvc','handover_date',null];
       // Set searchable column fields
       $CI->dt->column_search = ['sd.category' ,'merek' ,'type','sn','sd.status','dt','mutation','alokasi_dvc','handover_date',null];
       // Set select column fields
       $CI->dt->select = 'sd.id,merek,type,sn,sd.status,sd.category,dt,mutation,alokasi_dvc,handover_date,sd.purchase_date';
       // Set default order
       $CI->dt->order = ['sd.id' => 'desc'];


       $con = ['join','scm_dvc_merek m','m.id = sd.merek_id','inner'];
       array_push($condition,$con);

       $con = ['join','scm_dvc_type t','t.id = sd.type_id','inner'];
       array_push($condition,$con);

       $con = ['join','scm_purchases sp','sp.id = sd.po_id','left'];
       array_push($condition,$con);

       if ($category != '') {
           $con = ['where','sd.category',$category];
           array_push($condition,$con);
       }

       // Fetch member's records
       $dataTabel = $this->dt->getRows($_POST, $condition);
       
       $i = @$_POST['start'];
      
       if ($category != '') {
         foreach ($dataTabel as $dt) {
            $data[] = array(
                $dt->merek,
                $dt->type,
                $dt->sn,
                $dt->status,
                $dt->purchase_date,
                $this->set_mutation($dt->mutation),
                $dt->alokasi_dvc,
                $dt->handover_date,
                null,
                '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editModal"  onclick="get_device('.$dt->id.')"><i class="fa fa-edit"></i></button> <a href="'.site_url('SCM/history_inventory?id='.$dt->id).'" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>'
            );
        }
       }else{
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $this->set_categ($dt->category),
                $dt->merek,
                $dt->type,
                $dt->sn,
                $dt->status,
                $dt->purchase_date,
                $this->set_mutation($dt->mutation),
                $dt->alokasi_dvc,
                $dt->handover_date,
                null,
                '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editModal"  onclick="get_device('.$dt->id.')"><i class="fa fa-edit"></i></button> <a href="'.site_url('SCM/history_inventory?id='.$dt->id).'" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>'
            );
        }
       }


       $output = array(
           "raw" => @$_POST['raw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }

    private function set_mutation($m='')
    {
        if ($m == '1') {
            return 'Employee';
        }else if ($m == '2') {
            return 'Devision';
        }else if ($m == '3') {
            return 'Project';
        }else if ($m == '4') {
            return 'Office';
        }else if ($m == '5') {
            return 'SCM';
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

    public function get_device_po_item_id($po_item_id='')
    {
       $this->db->select($this->see);
       $this->db->where('po_item_id', $po_item_id);
       $this->db->join('scm_dvc_type t', 't.id = sd.type_id', 'left');
       $q =  $this->db->get('scm_devices sd');
       return $q;
    }

    public function dt_cek_dvc_projek($pk_id='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_devices sd';
       // Set orderable column fields
       $CI->dt->column_order = [null,'type' ,'sn'];
       // Set searchable column fields
       $CI->dt->column_search = ['type' ,'sn'];
       // Set select column fields
       $CI->dt->select = 'sd.id,merek,type,sn';
       // Set default order
       $CI->dt->order = ['sd.id' => 'desc'];


       $con = ['join','scm_dvc_merek m','m.id = sd.merek_id','inner'];
       array_push($condition,$con);

       $con = ['join','scm_dvc_type t','t.id = sd.type_id','inner'];
       array_push($condition,$con);

       $con = ['join','scm_purchases sp','sp.id = sd.po_id','left'];
       array_push($condition,$con);

       $con = ['where','sp.project_id',$pk_id];
       array_push($condition,$con);
       

       // Fetch member's records
       $dataTabel = $this->dt->getRows($_POST, $condition);
       
       $i = @$_POST['start'];
      
         foreach ($dataTabel as $dt) {
            $data[] = array(
                $dt->type,
                $dt->sn,
                'ok'
            );
        }
       

       $output = array(
           "raw" => @$_POST['raw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }

}