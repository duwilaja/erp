<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSelma extends CI_Model {

    private $t = 'pipeline';
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

    public function dtPipeline($activity='',$agree='')
    {
        // Definisi
        $condition = [];
        $data = [];
        $ax = '';

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'pipeline p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'customer','custend','solution','product','category'];
        // Set searchable column fields
        $CI->dt->column_search = ['customer','custend','solution','product','category'];
        // Set select column fields
        $CI->dt->select ='p.id,customer,custend,solution,product,category,p.date,activity,p.projek';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];

        $con = ['join','cust c','c.id = p.cust_id','left'];
        array_push($condition,$con);

        $con = ['join','cust_end ec','ec.id = p.end_cust_id','left'];
        array_push($condition,$con);

        $con = ['join','sales_solution ss','ss.id = p.solution_id','left'];
        array_push($condition,$con);

        $con = ['join','sales_product sp','sp.id = p.product_id','left'];
        array_push($condition,$con);

        if ($activity != '') {
            $con = ['where','activity',$activity];
            array_push($condition,$con);
        }

        if ($agree != '') {
            $ax = '?act=2';
            $con = ['where','agree',$agree];
            array_push($condition,$con);
        }

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->customer.'<br><span style="background: aquamarine;padding: 0 5px;">'.$dt->custend.'</span>',
                $dt->projek,
                $dt->solution.' - '.$dt->product,
                $this->categ($dt->category),
                $this->bantuan->tgl_indo($dt->date),
                $this->activity($dt->activity),
                '<a id="a" href="'.site_url('SelMa/detail_pipeline/'.$dt->id.$ax).'"  class="btn btn-default btn-sm tooltiptext" data-toggle="tooltip" data-placement="top" title="Detail Pipeline"><i class="far fa-eye"></i></a>
                <a id="b" href="'.site_url('SelMa/pipeline_activity/'.$dt->id.$ax).'" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Add/Update Activity"><i class="far fa-check-circle"></i></a>'.$this->cek_pipeline_agree($dt,$agree)
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

    private function cek_pipeline_agree($dt='',$agree='')
    {
        $data = '';
        if ($agree == '') {
           $data = ' <a data-toggle="modal" data-target="#editModal" onclick="getPipeline('.$dt->id.')" href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Pipeline"><i class="far fa-edit"></i></a>';
        }

        return $data;
    }

    public function  dtMarkProg()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'mar_prog m';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'title','start_date','end_date','desc','created_by'];
        // Set searchable column fields
        $CI->dt->column_search = ['title','start_date','end_date','desc','created_by'];
        // Set select column fields
        $CI->dt->select ='id,title,start_date,end_date,desc,created_by';
        // Set default order
        $CI->dt->order = ['m.id' => 'desc'];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->title,
                $dt->start_date,
                $dt->end_date,
                $dt->desc,
                '<a onclick="getMarProg('.$dt->id.')" data-toggle="modal" data-target="#editModal" class="btn btn-default btn-sm"><i class="far fa-edit"></i></a>
                <a href="#" onclick="delMarProg('.$dt->id.')" class="btn btn-primary btn-sm"><i class="far fa-trash-alt"></i></a>'
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

    public function inHPipeline($data='',$id='')
    {
        array_push($data,$id);
		$data['pipeline_id'] = $data[0];
		unset($data[0]);

        $this->db->insert('h_pipeline', $data);
    }

    public function getDetail($id='')
    {
        $this->db->select('p.activity,p.cust_id,p.end_cust_id,p.solution_id,p.product_id,p.id,p.telp,p.email,p.address, c.customer, ec.custend,k.nama,category,ss.solution,sp.product,p.pic');
        $this->db->join('cust c', 'c.id = p.cust_id', 'left');
        $this->db->join('cust_end ec', 'ec.id = p.end_cust_id', 'left');
        $this->db->join('karyawan k', 'k.id = p.sales_id', 'left');
        $this->db->join('sales_product sp', 'sp.id = p.product_id', 'left');
        $this->db->join('sales_solution ss', 'ss.id = p.solution_id', 'left');
        $this->db->where('p.id', $id);
        $q = $this->db->get('pipeline p');

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

    public function activity($a='')
    {
        if ($a != '') {
            if ($a == '1') {
                return 'Contact Potential';
            }else if ($a == '2') {
                return 'Presentation';
            }else if ($a == '3') {
                return 'Technical Presentation';
            }else if ($a == '4') {
                return 'POC';
            }else if ($a == '5') {
                return 'SPH';
            }else if ($a == '6') {
                return 'BAKN';
            }else if ($a == '7') {
                return 'PO';
            }else if ($a == '8') {
                return 'LOST';
            }else if ($a == '9') {
                return 'Close Deal';
            }else if ($a == '10') {
                return 'KL';
            }
       }
    }

    // Sales Product 

    public function dtProduct()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'sales_product sp';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'product','created_date','created_by'];
        // Set searchable column fields
        $CI->dt->column_search = ['product','created_date','created_by'];
        // Set select column fields
        $CI->dt->select ='sp.id,product,sp.created_date,nama';
        // Set default order
        $CI->dt->order = ['sp.created_date' => 'desc'];

        $con2 = ['join','karyawan k','k.id = sp.created_by','inner'];
        array_push($condition,$con2);

        // $con3 = ['join','sales_solution ss','ss.id = sp.solution_id','inner'];
        // array_push($condition,$con3);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->product,
                $this->bantuan->tgl_indo($dt->created_date),
                $dt->nama,
                '<a href="#" onclick="getProduct('.$dt->id.')" data-toggle="modal" data-target="#editProduct" class="btn btn-default btn-sm"><i class="far fa-edit"></i></a>'
//                 '<a href="#" onclick="getProduct('.$dt->id.')" data-toggle="modal" data-target="#editProduct" class="btn btn-default btn-sm"><i class="far fa-edit"></i></a>
//  <a href="#" onclick="delProduct('.$dt->id.')" class="btn btn-primary btn-sm"><i class="far fa-trash-alt"></i></a>'
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

    public function delProduct($id){
        $this->db->delete('sales_product', ['id' => $id]);
        $del = $this->db->affected_rows();
        return $del;
    }

    public function getProduct($id='',$id_solution='')
    {
        $num = 0;
        if ($id != '') {
            $s = $this->db->get_where('sales_product', ['id' => $id]);
            $n = $s->num_rows();
            if ($n > 0) {
                $num = $n;
            }
        }else if($id_solution != ''){
            $s = $this->db->get_where('sales_product', ['solution_id' => $id_solution]);
            $n = $s->num_rows();
            if ($n > 0) {
                $num = $n;
            }
        }else{
            $s = $this->db->get('sales_product');
            $n = $s->num_rows();
            if ($n > 0) {
                $num = $n;
            }
        }
        return [$s,$n];
    }

    public function upProduct($obj,$id)
    {
        $s = $this->db->update('sales_product', $obj,['id' => $id]);
        $x = $this->db->affected_rows();
        return $x; 
    }

    public function inProduct($obj)
    {
        $s = $this->db->insert('sales_product',$obj);
        $x = $this->db->affected_rows();
        return $x; 
    }

    // Data Sales

    public function dtSales()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'karyawan k';
        // Set orderable column fields
        $CI->dt->column_order = [null,'nama','created_date','created_by'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama','created_date','created_by'];
        // Set select column fields
        $CI->dt->select = 'nama,created_date,created_by';
        // Set default order
        $CI->dt->order = ['k.id' => 'desc'];

        $con2 = ['where','k.status',1];
        array_push($condition,$con2);

        $j = ['15','22','24','56'];
        $con3 = ['where_in','k.jabatan_id',$j];
        array_push($condition,$con3);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $dt->created_date,
                $dt->created_by,
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

    // Solution

    public function dtSolution()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'sales_solution sk';
        // Set orderable column fields
        $CI->dt->column_order = [null,'solution','product','created_date','created_by'];
        // Set searchable column fields
        $CI->dt->column_search = ['solution','product','created_date','created_by'];
        // Set select column fields
        $CI->dt->select = 'sk.id,solution,product,sk.created_date,sk.created_by';
        // Set default order
        $CI->dt->order = ['sk.id' => 'desc'];

        $con = ['join','sales_product sp','sp.id = sk.product_id','left'];
        array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->solution,
                $dt->product,
                $dt->created_date,
                $dt->created_by,
                '<a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editSolution" onclick="getSolution('.$dt->id.')"><i class="fa fa-edit"></i></a>',
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

    public function getSolution($id='',$product='')
    {
        $num = 0;
        if ($id != '') {
            $s = $this->db->get_where('sales_solution', ['id' => $id]);
            $n = $s->num_rows();
            if ($n > 0) {
                $num = $n;
            }
        }else if ($product != '') {
            $s = $this->db->get_where('sales_solution', ['product_id' => $product]);
            $n = $s->num_rows();
            if ($n > 0) {
                $num = $n;
            }
        }else{
            $s = $this->db->get('sales_solution');
            $n = $s->num_rows();
            if ($n > 0) {
                $num = $n;
            }
        }
        return [$s,$n];
    }

    public function upSolution($obj,$id)
    {
        $s = $this->db->update('sales_solution', $obj,['id' => $id]);
        $x = $this->db->affected_rows();
        return $x; 
    }

    public function inSolution($obj)
    {
        $s = $this->db->insert('sales_solution',$obj);
        $x = $this->db->affected_rows();
        return $x; 
    }

    public function deSolution($id)
    {
        $s = $this->db->delete('sales_solution',['id' => $id]);
        return $s; 
    }

    // Sales Schedule
    public function dtSalesSchedule()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'sales_schedule ss';
        // Set orderable column fields
        $CI->dt->column_order = [null,'title','date','location','description'];
        // Set searchable column fields
        $CI->dt->column_search = ['title','date','location','description'];
        // Set select column fields
        $CI->dt->select = 'id,title,date,location,description';
        // Set default order
        $CI->dt->order = ['ss.id' => 'desc'];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->title,
                $this->bantuan->tgl_indo($dt->date),
                $dt->location,
                $dt->description,
                '<a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editSalesSchedule" onclick="getEdit('.$dt->id.')"><i class="fa fa-edit"></i></a> <a href="#" class="btn btn-primary btn-sm" onclick="deSalesSchedule('.$dt->id.')"><i class="fa fa-trash"></i></a>',
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

    public function getPactivity($id='')
    {
        $this->db->join('cust c', 'c.id = p.cust_id', 'left');
        $this->db->join('cust_end ce', 'ce.id = p.end_cust_id', 'left');
        $this->db->join('sales_product sp', 'sp.id = p.product_id', 'left');
        $this->db->join('sales_solution ss', 'ss.id = p.solution_id', 'left');

        if ($id != '') {
            $this->db->where('p.id', $id);
        }
        
        $q = $this->db->get('pipeline p');
        return $q;
    }

    // Kontrak

    public function getProjek($id='')
    {
        if ($id != '') {
            $this->db->where('id', $id);
        }
        $q = $this->db->get('projek p');
        return $q;
        
    }

    public function getProjekKontrak($id='',$projek_id='')
    {
        if ($id != '') {
            $this->db->where('id', $id);
        }
        
        if ($projek_id != '') {
            $this->db->where('projek_id', $projek_id);
        }

        $q = $this->db->get('projek_kontrak pk');

        return $q;
    }

    public function dtProjekKontrak($id='',$status='',$aktif='')
    {
        if($id == '') return  json_encode($output = [
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => [],
        ]);

          // Definisi
          $condition = [];
          $data = [];
  
          $CI = &get_instance();
          $CI->load->model('DataTable', 'dt');
  
          // Set table name
          $CI->dt->table = 'projek_kontrak pk';
          // Set orderable column fields
          $CI->dt->column_order = [null,'no_kontrak','masa_kontrak','start_date','end_date','total_kon_ppn'];
          // Set searchable column fields
          $CI->dt->column_search = ['no_kontrak','masa_kontrak','start_date','end_date','total_kon_ppn'];
          // Set select column fields
          $CI->dt->select = 'pk.id,no_kontrak,masa_kontrak,file,jenis,total_kon_ppn,start_date,end_date,pk.pipeline_id,pk.aktif,pk.status_kontrak';
          // Set default order
          $CI->dt->order = ['pk.id' => 'desc'];

          $con = ['join','projek_k_file pkf','pkf.pk_id = pk.id','left'];
          array_push($condition,$con);

          $con = ['where','pk.projek_id',$id];
          array_push($condition,$con);

          if ($status != '') {
              $con = ['where','pk.status',$status];
              array_push($condition,$con);
          }

          if ($aktif != '') {
            $con = ['where','pk.aktif',$aktif];
            array_push($condition,$con);
          }
  
          // Fetch member's records
          $dataTabel = $this->dt->getRows($_POST, $condition);
  
          $i = @$_POST['start'];
          foreach ($dataTabel as $dt) {
              $i++;
              
              $periode = '-';

              if ($dt->start_date != '0000-00-00' && $dt->end_date != '0000-00-00') {
                  $periode = $this->bantuan->tgl_indo($dt->start_date).' - '.$this->bantuan->tgl_indo($dt->end_date);
              }

              $link = '';
              $status = '';

              if ($dt->pipeline_id != ''){
                  $k = $this->db->get_where('act_kontrak',['pipeline_id' => $dt->pipeline_id]);
                  $po = $this->db->get_where('act_po',['pipeline_id' => $dt->pipeline_id]);
                  if ($k->num_rows() > 0) {
                      $k = $k->row();
                      $kontrak = $k->kontrak;
                      $link = '<a href="'.base_url('data/sls/kontrak/'.$kontrak).'" class="btn btn-default btn-sm"><i class="fa fa-download"></i></a>';
                  }else{
                    if ($po->num_rows() > 0) {
                        $po = $po->row();
                        $kontrak = $po->po;
                        $link = '<a href="'.base_url('data/sls/po/'.$kontrak).'" class="btn btn-default btn-sm"><i class="fa fa-download"></i></a>';
                      }
                  }
                 
              }else{
                  if ($dt->file != '') {
                      $link = '<a href="'.base_url('data/sls/kontrak/'.$dt->file).'" class="btn btn-default btn-sm"><i class="fa fa-download"></i></a>';
                  }
              }

              if ($dt->status_kontrak == '1') {
                $status = '<span style="background: #4CAF50;color: #FFF;padding: 0 20px;border-radius: 10px;">Aktif</span></br>';
              }else if ($dt->status_kontrak == '0') {
                $status = '<span style="background: #3F51B5;color: #FFF;padding: 0 20px;border-radius: 10px;">Kontrak Habis</span></br>';
              }

              $this->set_pk_expired($dt->id);

              $data[] = array(
                  $dt->no_kontrak,
                  strtoupper($dt->jenis),
                  $status,
                  $periode,
                  torp($dt->total_kon_ppn),
                  $link.'<button data-toggle="modal" data-target="#editRenewal" class="btn btn-default btn-sm ml-2" onclick="getKontrak('.$dt->id.')"><i class="fa fa-pen"></i></button>'.'<button class="btn btn-danger btn-sm ml-2" onclick="delKontrak('.$dt->id.')"><i class="fa fa-trash"></i></button>',
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

    public function inKontrak()
    {
        $this->load->library('upload');
        
        $id = $this->input->post('id');
        	
		$data = [
			'projek_id' => $this->input->post('id'),
			'no_kontrak' => $this->input->post('no_kontrak'),
			'masa_kontrak' => $this->input->post('masa_kontrak'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
            'total_kon_ppn' => $this->input->post('nominal'),
            'status' => 1,
            'status_kontrak' => '1',
            'aktif' => 1,
            'ctdDate' => date('Y-m-d'),
            'ctdBy' => $this->session->userdata('karyawan_id'),
		];
        $this->db->insert('projek_kontrak',$data);
        $pk_id = $this->db->insert_id();

        $kontrak = '';	

		$config['upload_path']          ='./data/sls/kontrak';
		$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('kontrak')){
			$msg = $this->upload->display_errors();
		}else{
			$kontrak = $this->upload->data()['file_name'];
        }
        
		$this->db->insert('projek_k_file',[
            'pk_id' => $pk_id,
            'p_id' => $id,
            'ctdDate' => date('Y-m-d'),
            'ctdBy' => $this->session->userdata('karyawan_id'),
            'file' => $kontrak,
            'status' => 1, //1=> kontrak
        ]);

        $resp = [
            'status' => true,
            'msg' => 'Berhasil menambahkan kontrak baru'
        ];

        return $resp;
    }

    public function inprojek_n_kontrak($id_pip='',$data='',$tbl='')
    {
        if ($id_pip != '') {
         // Jika pipeline berhasil dibuat dan sudah mengpload berupa SPH maka dibuatkan data pada tabel projek dan projek kontrak
		 $sph = $this->db->get_where('act_sph', ['pipeline_id' => $id_pip]);
            if ($sph->num_rows() > 0) {

                $idprojek = 0;
                $p = $this->db->get_where('pipeline', ['id' => $id_pip]);
                $pipe = $p->row();
                
                $pr = $this->db->get_where('projek', ['pipeline_id' => $id_pip]);
                if ($pr->num_rows() == 0) {
                    $projek_x = [
                        'service' => $pipe->projek,
                        'cust_id' => $pipe->cust_id,
                        'cust_end_id' => $pipe->end_cust_id,
                        'status' => '1',
                        'aktif' => '1',
                        'ctdDate' => date('Y-m-d'),
                        'updDate' => date('Y-m-d h:i:s'),
                        'pipeline_id' => $id_pip,
                        'ctdBy' => $this->session->userdata('karyawan_id'),
                    ];
    
                    $this->db->insert('projek',$projek_x);
                    $idprojek = $this->db->insert_id();
                }

                if ($idprojek != 0) {
                    $prk = $this->db->get_where('projek', ['pipeline_id' => $id_pip]);
                    if ($prk->num_rows() > 0) {
                        $data = [
                            'projek_id' => $idprojek,
                            'ctdDate' => date('Y-m-d'),
                            'category' => $pipe->category,
                            'pipeline_id' => $id_pip,
                            'status' => '1',
                            'aktif' => '1',
                            'total_kon_ppn' => '0',
                            'terhutang' => '0',
                            'terbayar' => '0',
                            'ctdBy' => $this->session->userdata('karyawan_id'),
                        ];
        
                        $this->db->insert('projek_kontrak',$data);
                    }
                }

            }
        }
        // Jika data tidak kosong dan id disi, kemudian tabel juga disin, maka akan mengarahkankan ke update
        if ($data != '' && $id_pip != '' && $tbl != '') {
            if ($tbl == 'p') {
              $this->db->update('projek', $data,['pipeline_id' => $id_pip]);
            }else if($tbl == 'pk'){
                $this->db->update('projek_kontrak', $data,['pipeline_id' => $id_pip]);
            }
        }
    }

    public function set_pk_expired($id='')
    {
        $g = $this->db->get_where('projek_kontrak pk',['pk.end_date <' => date('Y-m-d'),'id' => $id]);
        if ($g->num_rows() > 0) {
            $this->db->update('projek_kontrak', ['aktif' => '0'],['jenis' => 'mrc','aktif' => '1','id' => $id]);
        }else{
            $this->db->update('projek_kontrak', ['aktif' => '1'],['jenis' => 'mrc','aktif' => '0','id' => $id]);
        }
    }

    // GET PO
    public function get_po($id='',$pipeline_id='')
    {
        if ($id != '') {
            $q = $this->db->get_where('act_po',['id' => $id]);
        }else{
            $q = $this->db->get_where('act_po',['pipeline_id' => $pipeline_id]);
        }
        return $q;
    }

    // Datatable Projek by po

    public function dt_projek_by_po()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        $CI->load->model('MSCMPurchase', 'mp');

        // Set table name
        $CI->dt->table = 'projek_kontrak pk';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'p.service',null,'pk.jenis','pk.masa_kontrak'];
        // Set searchable column fields
        $CI->dt->column_search = ['p.service','pk.jenis','pk.masa_kontrak'];
        // Set select column fields
        $CI->dt->select ='pk.id,p.pipeline_id,p.service,pk.jenis,pk.masa_kontrak,c.customer,ec.custend';
        // Set default order
        $CI->dt->order = ['pk.id' => 'desc','po.id' => 'desc',];

        $con = ['join','projek p','p.id = pk.projek_id','inner'];
        array_push($condition,$con);

        $con = ['join','cust c','c.id = p.cust_id','left'];
        array_push($condition,$con);

        $con = ['join','cust_end ec','ec.id = p.cust_end_id','left'];
        array_push($condition,$con);

        // $con = ['join','pipeline pl','pl.id = p.pipeline_id','inner'];
        // array_push($condition,$con);

        // $con = ['join','act_po po','po.pipeline_id = p.pipeline_id','inner'];
        // array_push($condition,$con);

        // $this->db->group_by('po.pipeline_id');

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $q = $this->db->last_query();
        $cf = $this->db->query($q)->num_rows();

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $data[] = array(
                '<a href="'.site_url('SCM/create_po?id='.$dt->id).'">'.$dt->service.'</a><br><div style="font-size:14px;"><span>'.$dt->customer.'</span> - <span>'.$dt->custend.'</span></div>',
                // '<a class="btn btn-sm btn-default" href="'.base_url('data/sls/po/'.$this->get_po('',$dt->pipeline_id)->last_row()->po).'"><i class="fa fa-file-alt"></i></a>',
                // $dt->jenis,
                $CI->mp->get('',['project_id' => $dt->id])->num_rows(),
            );
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $cf,
            "recordsFiltered" => $cf,
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function dtProjekPo()
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
                // $dt->solution.' - '.$dt->product,
                $this->categ($dt->category),
                $this->bantuan->tgl_indo($dt->ctdDate),
                // $this->activity($dt->activity),
                '<a id="a" href="'.site_url('SelMa/detail_projek_po?pk='.$dt->id).'"  class="btn btn-info btn-sm tooltiptext" data-toggle="tooltip" data-placement="top" title="Detail Projek PO"><i class="far fa-eye"></i></a>'
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

    public function getProjekPo($pk_id='')
    {
        $this->db->select($this->see);

        if ($pk_id != '') {
            $this->db->where('pk.id', $pk_id);
        }

        // $this->db->join('projek_kontrak pk','pk.id = pt.pk_id', 'left');
        $this->db->join('projek p', 'p.id = pk.projek_id', 'left');
        // $this->db->join('karyawan k', 'k.id = pm.pm_id', 'inner');
        $q = $this->db->get('projek_kontrak pk');
        return $q; 
    }

    public function dtDetailProjekPo($pk_id='')
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
        // $con = ['join','projek p','p.id = pk.projek_id','left'];
        // array_push($condition,$con);
        
        // $con = ['join','cust c','c.id = p.cust_id','left'];
        // array_push($condition,$con);

        // $con = ['join','cust_end ec','ec.id = p.cust_end_id','left'];
        // array_push($condition,$con);


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