<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MVm extends CI_Model {

    public function dtPartner($id='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'vnd_partner p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'pc.category','p.area','p.location','p.name','p.status','p.remaks'];
        // Set searchable column fields
        $CI->dt->column_search = ['p.kategori','pc.category','p.area','p.location','p.name','p.status','p.remaks'];
        // Set select column fields
        $CI->dt->select = 'p.id,pc.category,p.name,p.status,pro.name as provinsi,k.name as kota,area,location,phone, kategori';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];

        $con1 = ['join','part_categ pc','pc.id = p.cp_id','left'];
        array_push($condition,$con1);

        $con1 = ['join','provinsi pro','pro.id = p.prov_id','left'];
        array_push($condition,$con1);

        $con1 = ['join','kota k','k.id = p.kota_id','left'];
        array_push($condition,$con1);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $dt->kategori,
                $dt->name,
                $dt->area,
                $dt->location,
                $dt->phone,
                $this->cek_akses($dt),
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

    private function cek_akses($dt='')
    {
        if ($dt != '') {
            if ($this->session->userdata('level') == '40' || $this->session->userdata('level') == '73') {
                return '<a href="#" data-toggle="modal" data-target="#formEditPartner" onclick="getEdit('.$dt->id.')" class="btn btn-warning btn-sm text-white"><i class="far fa-edit"></i></a> <a href="#" data-toggle="modal" data-target="#formDetailPartner" onclick="getDetail('.$dt->id.')" class="btn btn-info btn-sm text-white"><i class="fa fa-eye"></i></a> <a href="#" onclick="delPartner('.$dt->id.')" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash"></i></a>';
            }
        }
    }
    public function getReportPartner($kategori='',$nama='',$area='',$lokasi='',$kontak='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'vnd_partner p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'pc.category','p.area','p.location','p.name','p.status','p.remaks'];
        // Set searchable column fields
        $CI->dt->column_search = ['p.kategori','pc.category','p.area','p.location','p.name','p.status','p.remaks'];
        // Set select column fields
        $CI->dt->select = 'p.id,pc.category,p.name,p.status,pro.name as provinsi,k.name as kota,area,location,phone, kategori';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];
        
        $con1 = ['join','part_categ pc','pc.id = p.cp_id','left'];
        array_push($condition,$con1);

        $con1 = ['join','provinsi pro','pro.id = p.prov_id','left'];
        array_push($condition,$con1);

        $con1 = ['join','kota k','k.id = p.kota_id','left'];
        array_push($condition,$con1);

        if ($kategori != '') {
            $con2 = ['like','p.kategori',$kategori];
            array_push($condition,$con2);
        }
        if ($nama != '') {
            $con3 = ['or_like','p.name',$nama];
            array_push($condition,$con3);
        }
        if ($area != '') {
            $con4 = ['or_like','p.area',$area];
            array_push($condition,$con4);
        }
        if ($lokasi != '') {
            $con5 = ['or_like','p.location',$lokasi];
            array_push($condition,$con5);
        }
        if ($kontak != '') {
            $con6 = ['or_like','p.phone',$kontak];
            array_push($condition,$con6);
        }
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        // $i = @$_POST['start'];
        // foreach ($dataTabel as $dt) {
        //     $i++;
        //     $data[] = array(
        //         $dt->kategori,
        //         $dt->name,
        //         $dt->area,
        //         $dt->location,
        //         $dt->phone,
        //         '<a href="#" data-toggle="modal" data-target="#formEditPartner" onclick="getEdit('.$dt->id.')" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a> <a href="#" onclick="delPartner('.$dt->id.')" class="btn btn-warning btn-sm text-white"><i class="fas fa-trash"></i></a>',
        //     );
        // }
        
        // $output = array(
        //     "draw" => @$_POST['draw'],
        //     "recordsTotal" => $this->dt->countAll($condition),
        //     "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
        //     "data" => $data,
        // );
        
        // Output to JSON format
        // return json_encode($output);
        return $dataTabel;
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
          $CI->dt->column_order = [null,'service',null,null,null];
          // Set searchable column fields
          $CI->dt->column_search = ['service'];
          // Set select column fields
          $CI->dt->select = 'sw.id,p.service';
          // Set default order
          $CI->dt->order = ['sw.id' => 'desc'];
  
          $con = ['join','projek_kontrak pk','pk.id = sw.pk_id','inner'];
          array_push($condition,$con);
 
          $con = ['join','projek p','p.id = pk.projek_id','inner'];
          array_push($condition,$con);
         
          // Fetch member's records
          $dataTabel = $this->dt->getRows($_POST, $condition);
  
          $i = @$_POST['start'];
          foreach ($dataTabel as $dt) {
              $i++;
              $data[] = array(
                  $i,
                  $dt->service,
                  $this->get_partner_wo($dt->id)->num_rows(),
                  $this->get_partner_wo($dt->id,'0')->num_rows(),
                  $this->get_partner_wo($dt->id,'1')->num_rows(),
                  '<a href="'.site_url('VM/detail_wo?id='.$dt->id).'" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>',
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

     public function get_partner_wo($sdv_wo_id='',$status='')
     {
         $this->db->join('sdv_install si', 'si.exec_id = vp.id', 'inner');
         $this->db->join('sdv_wo sw', 'sw.id = si.sdv_wo_id', 'inner');
         $this->db->join('projek_kontrak pk', 'pk.id = sw.pk_id', 'inner');
         $this->db->join('projek p', 'p.id = pk.projek_id', 'inner');
         $this->db->where('si.status_exec', '2');
         
         if ($sdv_wo_id != '') {
             $this->db->where('si.sdv_wo_id', $sdv_wo_id);
         }

         if ($status != '') {
            $this->db->where('si.status', $status);
         }

        $q = $this->db->get('vnd_partner vp');
        return $q;
     }

      //  Work Order
	 public function dt_detail_wo($sdv_wo_id='')
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
		 $CI->dt->select = 'si.id,si.exec_id,si.status_exec,si.status,si.pic,si.location,si.remarks';
		 // Set default order
		 $CI->dt->order = ['si.id' => 'desc'];
 
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
				 $dt->location,
				 $dt->pic,
				 $this->set_status_tech($dt->status_exec).'<br>'.$this->get_exec($dt)[1],
				 $this->set_status_install2($dt->status),
				 '<a href="#"  style="font-size:12px;margin-right:4px;" data-toggle="modal" data-target="#installation_form" class="btn btn-warning btn-sm text-white" onclick="get_install('.$dt->id.')"><i class="far fa-edit"></i></a><a href="#" data-toggle="modal" data-target="#detail_sn"  onclick="get_sn('.$dt->id.')"><button class="btn btn-info text-uppercase font-weight-bold text-white" style="padding:3px 10px !important;font-size: 13px;">detail</button></a>',
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
 
 
     public function set_status_install2($m='')
     {
         if ($m == '1') {
             return 'Terpasang';
         }else if ($m == '0') {
             return 'Belum Terpasang';
         }
     }

    // Category

    public function getCategory($id='')
    {
        if ($id != '') {
            $q = $this->db->get_where('part_categ',['id' => $id ]);
        }else{
            $q = $this->db->get('part_categ');
        }

        return $q;
    }

    public function setStatus($s='')
    {
        if ($s != '') {
            if ($s == 0) {
                return  'Tidak Ada';
            }else if ($s == 1) {
                return  'Sedang Bertugas';
            }
        }
    }

    public function getJobs($id='')
    {
        $this->db->select('*');
        
        if ($id != '') {
            $this->db->where('id', $id);
        }
        $this->db->where('status', 1);
        $ok = $this->db->get('partner_job');
        return $ok;
    }

    public function dtPartnerJob($status='1')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'partner_job';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'jobs'];
        // Set searchable column fields
        $CI->dt->column_search = ['jobs'];
        // Set select column fields
        $CI->dt->select = 'id,jobs';
        // Set default order
        $CI->dt->order = ['id' => 'desc'];

        if ($status != '') {
            $con = ['where','status',$status];
            array_push($condition,$con);
        }
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->jobs,
                '<a href="javascript:void(0)" data-toggle="modal" data-target="#formEditPartnerJob" onclick="getEdit('.$dt->id.')" class="btn btn-warning btn-sm text-white"><i class="fa fa-edit"></i></a>
                 <a href="javascript:void(0)" onclick="delPartnerJob('.$dt->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
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

    public function get_sdv_install()
    {
        $this->db->select('si.id,si.exec_id,si.status_exec,si.status,si.pic,si.location,si.remarks,vp.name');
        $this->db->join('vnd_partner vp', 'vp.id = si.exec_id', 'left');
        $q = $this->db->get('sdv_install si');
        return $q;
    }

    public function get_vnd_prt_job($search="",$location="",$limit='', $start='',$id='')
    {
        $this->db->select('vpj.id,vpj.job_name,vpj.addreas,vpj.ctdDate,vpj.ctdBy,vpj.status,vpj.price,vpj.description,p.name as provinsi,k.name as kota,vpj.provinsi_id,vpj.kota_id, ROW_NUMBER() OVER (ORDER BY vpj.id DESC) AS rowid');
        $this->db->join('provinsi p', 'p.id = vpj.provinsi_id', 'left');
        $this->db->join('kota k', 'k.id = vpj.kota_id', 'left');
        $this->db->order_by("id", "DESC");
        $this->db->where('status','1');
        
        if (!empty($search) && !empty($location)) {
            $this->db->limit($limit, $start);
            $this->db->like('job_name', $search);
            $this->db->where('provinsi_id', $location);
            $q = $this->db->get('vnd_partner_jobs vpj');
        }

        if (!empty($search) && empty($location)) {
            $this->db->limit($limit, $start);
            $this->db->like('job_name', $search);
            $q = $this->db->get('vnd_partner_jobs vpj');
        }

        if (empty($search) && !empty($location)) {
            $this->db->limit($limit, $start);
            $this->db->where('provinsi_id', $location);
            $q = $this->db->get('vnd_partner_jobs vpj');
        }

        if (empty($search) && empty($location)) {
            $this->db->limit($limit, $start);
            $q = $this->db->get('vnd_partner_jobs vpj');
        }

        if (!empty($id)) {
            $this->db->select('vpj.id,vpj.job_name,vpj.addreas,vpj.ctdDate,vpj.ctdBy,vpj.status,vpj.price,vpj.description,p.name as provinsi,k.name as kota,vpj.provinsi_id,vpj.kota_id');
            $this->db->join('provinsi p', 'p.id = vpj.provinsi_id', 'left');
            $this->db->join('kota k', 'k.id = vpj.kota_id', 'left');
            $this->db->where('vpj.id', $id);
            $q = $this->db->get('vnd_partner_jobs vpj');
        }
        return $q;
    }

}