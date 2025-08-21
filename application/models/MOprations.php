<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MOprations extends CI_Model {

    private $t = 'tickets';
    private $t2 = 'tickets_h';
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

    // Laporan Report Oprations

    public function getPicTicket()
    {
       $this->db->join('karyawan k', 'k.id = t.pic', 'inner');
       //$this->db->group_by('pic');
       $q = $this->db->get('tickets t');
       return $q->result();   
    }

    public function jmlAllTicketBy($bulan='',$tahun='',$group_by='status',$status='',$custend='',$tgl_mulai='',$tgl_akhir='')
    {
        $this->db->select('count(id) as jml,status');

        if ($tgl_mulai != '' && $tgl_akhir != '') {
            $this->db->where('DATE(dtm) >= DATE("'.$tgl_mulai.'")');
            $this->db->where('DATE(dtm) <= DATE("'.$tgl_akhir.'")');
        }else{
            if ($bulan != '') {
                $this->db->where('MONTH(dtm) = MONTH("'.$bulan.'")');
            }

            if ($tahun != '') {
                $this->db->where('YEAR(dtm) = YEAR("'.$tahun.'")');
            }
        }

        if ($status != '') {
            $this->db->where('status',$status);
        }

        if ($custend != '') {
            $this->db->where('t.customer',$custend);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }
              
        $q = $this->db->get('tickets t');
        
        return $q;
    }

    public function getJmlTicketByDate($bulan='',$tahun='',$status='',$custend='',$tgl_mulai='',$tgl_akhir='')
    {
        if ($bulan == '') {
            $bulan = date('m');
        }

        if ($tahun == '') {
            $tahun = date('Y');
        }

        $this->db->select("DATE_FORMAT(dtm,'%e') as tgl,count(id) as jml,status");

        if ($tgl_mulai != '' && $tgl_akhir != '') {
                $this->db->where('DATE(dtm) >= DATE("'.$tgl_mulai.'")');
                $this->db->where('DATE(dtm) <= DATE("'.$tgl_akhir.'")');
        }else{
            if ($bulan != '') {
                $this->db->where('MONTH(dtm) = MONTH("'.$bulan.'")');
            }
    
            if ($tahun != '') {
                $this->db->where('YEAR(dtm) = YEAR("'.$tahun.'")');
            }
        }
    
        if ($status != '') {
            $this->db->where('status',$status);
        }

        if ($custend != '') {
            $this->db->where('t.customer',$custend);
        }
	
        //$this->db->group_by('DATE(dtm)');
        $this->db->group_by('tgl,status');

        $q = $this->db->get('tickets t');
    
        return $q;
    }
    
    public function getReportTicket($bulan='',$tahun='',$status='',$custend='',$tgl_mulai='',$tgl_akhir='')
    {
        $this->db->select('t.id,tn.node,tsc.s_closed,t.ctddone,ticketno,dtm,lastupd,c.custend,t.node_id,nama_kategori,nama_subject,t.status,t.body,t.notes,nama,layanan,p.name as provinsi,t.sla');

        if ($tgl_mulai != '' && $tgl_akhir != '') {
            $this->db->where('DATE(dtm) >= DATE("'.$tgl_mulai.'")');
            $this->db->where('DATE(dtm) <= DATE("'.$tgl_akhir.'")');
        }else{
            if ($bulan != '') {
                $this->db->where('MONTH(dtm) = MONTH("'.$bulan.'")');
            }

            if ($tahun != '') {
                $this->db->where('YEAR(dtm) = YEAR("'.$tahun.'")');
            }
        }

        if ($status != '') {
            $this->db->where('t.status',$status);
        }

        $this->db->where_not_in('t.status','');

        if ($custend != '') {
            $this->db->where('t.customer',$custend);
        }

        $this->db->join('karyawan k', 'k.id = t.pic', 'left');
        $this->db->join('cust_end c', 'c.id = t.customer', 'left');
        $this->db->join('tic_kategori tk', 'tk.id = t.tic_ktg_id', 'left');
        $this->db->join('tic_subject ts', 'ts.id = t.tic_subject_id', 'left');
        $this->db->join('tic_layanan tl', 'tl.id = t.tic_layanan_id', 'left');
        $this->db->join('tic_s_closed tsc', 'tsc.id = t.s_closed_id', 'left');
        $this->db->join('layanan l', 'l.id = tl.layanan_id', 'left');
        $this->db->join('provinsi p', 'p.id = t.prov_id', 'left');
        $this->db->join('tic_node tn', 'tn.id = t.tic_node_id', 'left');
        
        $q = $this->db->get('tickets t');
        return $q;
    }

    public function dtReportTicket($bulan='',$tahun='',$status='',$custend='',$tgl_mulai='',$tgl_akhir='')
    {
         $condition = [];
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'tickets t';
         // Set orderable column fields
         $CI->dt->column_order = [null, 'ticketno','dtm','lastupd','c.custend','t.node_id','node','nama_kategori','nama_subject','t.status','t.body','t.notes','nama'];
         // Set searchable column fields
         $CI->dt->column_search = ['ticketno','dtm','lastupd','c.custend','t.node_id','node','nama_kategori','nama_subject','t.status','t.body','t.notes','nama'];
         // Set select column fields
         $CI->dt->select = 't.id,ticketno,dtm,lastupd,c.custend,nama_kategori,t.ctddone,nama_subject,t.status,t.body,t.notes,nama,t.node_id,p.name as provinsi,tsc.s_closed,tn.node';
         // Set default order
         $CI->dt->order = ['t.id' => 'desc'];

         if ($tgl_mulai != '' && $tgl_akhir != '') {
            $con = ['where','DATE(dtm) >= DATE("'.$tgl_mulai.'")'];
            array_push($condition,$con);
            
            $con = ['where','DATE(dtm) <= DATE("'.$tgl_akhir.'")'];
            array_push($condition,$con);
        }else{
            $con = ['where','MONTH(dtm) = MONTH("'.$bulan.'")'];
            array_push($condition,$con);
   
            $con = ['where','YEAR(dtm) = YEAR("'.$tahun.'")'];
            array_push($condition,$con);
        }

         if ($custend != '') {
            $con = ['where','t.customer ',$custend];
            array_push($condition,$con);
         }

         if ($status != '') {
            $con = ['where','t.status ',$status];
            array_push($condition,$con);
         }

         $con = ['where_not_in','t.status ',''];
            array_push($condition,$con);

         $con = ['join','karyawan k','k.id = t.pic','left'];
         array_push($condition,$con);

         $con = ['join','cust_end c','c.id = t.customer','left'];
         array_push($condition,$con);

         $con = ['join','tic_kategori tk','tk.id = t.tic_ktg_id','left'];
         array_push($condition,$con);

         $con = ['join','tic_subject sk','sk.id = t.tic_subject_id','left'];
         array_push($condition,$con);
        
         $con = ['join','provinsi p','p.id = t.prov_id','left'];
         array_push($condition,$con);

         $ss =  ['join','tic_s_closed tsc','tsc.id = t.s_closed_id','left'];
         array_push($condition,$ss);

         $tn =  ['join','tic_node tn','tn.id = t.tic_node_id','left'];
         array_push($condition,$tn);

         // Fetch member's records
         $dataTabel = $this->dt->getRows(@$_POST, $condition);
 
         $i = @$_POST['start'];
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                $i,
                $dt->id,
                $dt->dtm,
                $dt->status == 'closed' ? $dt->ctddone : '-',
                $dt->status == 'closed' ? $this->bantuan->ttr($dt->id).' detik' : '-',
                $dt->nama,
                $dt->custend,
                $dt->node_id == ''? $dt->node : $dt->node_id,
                $dt->nama_kategori,
                $dt->nama_subject,
                $dt->provinsi,
                $dt->status,
                $dt->s_closed,
                $dt->body,
                $dt->notes,
             );
         }
 
         $output = array(
             "draw" => @$_POST['draw'],
             "recordsTotal" => $this->dt->countAll($condition),
             "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
             "data" => $data,
         );

         return json_encode($output);
        
    }

    public function getTicket($id)
    {
        $q = $this->db->query("SELECT t.*,tn.node,kt.name as kota,lyn.layanan,p.name as provinsi,c.custend,tk.nama_kategori,ts.nama_subject,k.nama as kpic  FROM `tickets` t LEFT JOIN cust_end c ON c.id = t.customer LEFT JOIN tic_kategori tk ON tk.id = t.tic_ktg_id LEFT JOIN tic_subject ts ON ts.id = t.tic_subject_id LEFT JOIN tic_layanan ly ON ly.id = t.tic_layanan_id  LEFT JOIN layanan lyn ON lyn.id = ly.layanan_id LEFT JOIN tic_node tn ON tn.id = t.tic_node_id  LEFT JOIN provinsi p ON p.id = t.prov_id LEFT JOIN kota kt ON kt.id = t.kota_id LEFT JOIN karyawan k ON k.id = t.pic WHERE t.id = ".$id);

        return $q;
    }

    public function dt($id='',$name='')
    {
        // Definisi
        $condition = [];
        $data = [];
        $i = $this->input->post();
        $tabl = 'tickets';


        if ($id != '' && $name !='') {
            if ($name == 'history') {
                $condition = [
                    ['where','tickets_h.id',$id]
                ];
                $tabl = 'tickets_h';
                $this->t = $this->t2;
            }else if ($name == 'myticket') {
                $condition = [
                    ['where','tickets.pic',$id]
                ];
            }else if ($name == 'mygroup') {
                $condition = [
                    ['where','tickets.grp',$id]
                ];
            }
        }
    
        if (@$i['grpf'] != '') {
            $xar = ['where','grp',@$i['grpf']];
            array_push($condition,$xar);
        }

        if (@$i['slaf'] != '') {
            $xar = ['where','sla',@$i['slaf']];
            array_push($condition,$xar);
        }

        if (@$i['f_kategori'] != '') {
            $xar2 = ['where','tickets.tic_ktg_id',@$i['f_kategori']];
            array_push($condition,$xar2);
        }

        if (@$i['f_subject'] != '') {
            $xar1 = ['where','tickets.tic_subject_id',@$i['f_subject']];
            array_push($condition,$xar1);
        }

        if (@$i['customerf'] != '') {
            $xar = ['where','customer',@$i['customerf']];
            array_push($condition,$xar);
        }
       
        if (@$i['layananf'] != '') {
            $xar = ['where',$tabl.'.tic_layanan_id',@$i['layananf']];
            array_push($condition,$xar);
        }

        if (@$i['statusf'] != '') {
            $xar = ['where','status',@$i['statusf']];
            array_push($condition,$xar);
        }
       
       
        $sub =  ['join','tic_subject ts','ts.id = '.$tabl.'.tic_subject_id','left'];
        array_push($condition,$sub);

        $kat =  ['join','tic_kategori tk','tk.id = '.$tabl.'.tic_ktg_id','left'];
        array_push($condition,$kat);

        $ss =  ['join','tic_s_closed tsc','tsc.id = '.$tabl.'.s_closed_id','left'];
        array_push($condition,$ss);

        $tn =  ['join','tic_node tn','tn.id = '.$tabl.'.tic_node_id','left'];
        array_push($condition,$tn);

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        $CI->load->model('MCostumers', 'mc');
        $CI->load->model('MUsers', 'mu');

        // Set table name
        $CI->dt->table = $this->t;
        // Set orderable column fields
        $CI->dt->column_order = [null,'ticketno','dtm','customer','reporter','node_id','node','alamat','sla','tic_subject_id','body','grp','pic','status','lastupd','updby','notes'];
        // Set searchable column fields
        $CI->dt->column_search = ['ticketno','dtm','customer','reporter','node_id','node','alamat','sla','nama_subject','nama_kategori','body','grp','pic','status','lastupd','updby','notes'];
        // Set select column fields
        $CI->dt->select = $this->t . '.*,ts.nama_subject,tk.nama_kategori,tsc.s_closed,tn.node';
        // Set default order
        $CI->dt->order = [$this->t . '.dtm' => 'desc'];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
            
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $this->cekAction($name,$dt,$i),
                $dt->id,
                @$CI->mc->getEnd($dt->customer)->row()->custend,
                @$this->get_tic_layanan($dt->tic_layanan_id),
                @$dt->node_id == '' ? $dt->node : $dt->node_id,
                @$dt->alamat,
                $dt->reporter,
                $this->cekSla($dt->sla),
                '<b>'.$dt->nama_kategori.'</b></br>'.$dt->nama_subject,
                $dt->body,
                $dt->grp,
                @($dt->pic == '' ? '-' : $CI->mk->get($dt->pic)->row()->nama),
                $dt->status,
                $dt->s_closed,
                $dt->lastupd,
                @($dt->updby == '' ? '-' : $CI->mk->get($dt->updby)->row()->nama),
                @($dt->createdby == '' ? '-' : $CI->mk->get($dt->createdby)->row()->nama),
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

    public function cekAction($name,$dt,$i)
    {   
        if($dt->pic == '' && $this->session->userdata('group') == $dt->grp){
            return '</br><div class="btn-group"> <button type="button" class="btn btn-outline-warning btn-sm" onclick="ticketAgree('.$dt->id.','.$dt->pic.')"><i class="fas fa-check"></i></button>';
        }elseif($dt->known == 0){
            if ($dt->pic == '') {
                $pic = '';
            }else{
                $pic = $dt->pic;
            }

            if ($this->session->userdata('karyawan_id') == $dt->pic) {
                return '</br><div class="btn-group"> <button type="button" class="btn btn-outline-warning btn-sm" onclick="ticketAgree('.$dt->id.','.$pic.')"><i class="fas fa-check"></i></button>';
            }
        }elseif ($name !="history" && $this->session->userdata('karyawan_id') == $dt->pic) {
            return '</br><div class="btn-group"> <button type="button" class="btn btn-default btn-sm" onclick="historyTicket('.$dt->id.')"><i class="fas fa-history"></i></button> <button type="button" class="btn btn-default btn-sm" onclick="editTicket('.$dt->id.')"><i class="fas fa-edit"></i></button> </div>';
        }else{
            return '</br><div class="btn-group"> <button type="button" class="btn btn-default btn-sm" onclick="historyTicket('.$dt->id.')"><i class="fas fa-history"></i>';
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

    public function in_h($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert($this->t2, $obj);
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

    public function cekSla($v='',$s='')
    {
        if ($v != '') {
            if ($v == 1) {
                return $s==''?'<span style="color:#FFF;padding:5px;border-radius:4px;background:#6f42c1;" >Ciritcal<span>':'Critical';
            }else if($v == 2){
                return $s==''?'<span style="color:#FFF;padding:5px;border-radius:4px;background:#dc3545;">High<span>':'High';
            }else if($v == 3){
                return $s==''?'<span style="color:#FFF;padding:5px;border-radius:4px;background:#fd7e14;">Medium<span>':'Medium';
            }else if($v == 4){
                return $s==''?'<span style="color:#FFF;padding:5px;border-radius:4px;background:#20c997;">Low<span>':'Low';
            }
        }
    }

    // Ticket Kategori
    public function tic_kategori($id='')
    {
        if ($id != '') {
          $q =  $this->db->get_where('tic_kategori',['id' => $id]);
        }else{
           $q =  $this->db->get('tic_kategori');
        }

        return $q;
        
    }

      // Ticket Subject
      public function tic_subject($id='',$tic_ktg_id='')
      {
          if ($id != '') {
            $q =  $this->db->get_where('tic_subject',['id' => $id]);
          }else if ($tic_ktg_id != '') {
            $q =  $this->db->get_where('tic_subject',['tic_ktg_id' => $tic_ktg_id]);
          }else{
             $q =  $this->db->get('tic_subject');
          }
  
          return $q;
          
      }

    //   Prefentive Maintenance

    public function getPmJoinTglPm()
    {
          return $this->db->select('pm.lokasi,pm.problem,tm.description,tm.hasil,tm.status,tm.id as idtm,tm.tanggal,c.nama_customer,k.nama')
          ->join('tgl_maintenance tm', 'tm.id_pm = pm.id', 'inner')
          ->join('customers c', 'c.id = pm.customer_id', 'inner')
          ->join('karyawan k', 'k.id = pm.teknisi_id', 'inner')
          ->get('prev_maintenance pm');
    }

    public function get_pm($id = '')
    {
        if ($id != '') {
            $q =  $this->db->get_where('prev_maintenance',['id' => $id]);
          }else{
             $q =  $this->db->get('prev_maintenance');
          }
  
          return $q;
    }
    
    public function inPm($data='')
    {
        $q = null;
        if ($data != '') {
           $q = $this->db->insert('prev_maintenance', $data);
           $ok = $this->db->affected_rows();
           if ($ok) {
               return $q;
           }
        }
    }
    
    public function setStatusTglPm($obj,$id)
    {
        if ($obj != '') {
            $q = $this->db->update('prev_maintenance', $obj,['id' => $id]);
            $ok = $this->db->affected_rows();
            if ($ok > 0) {
                return true;
            }
        }

        return false;
    }

    public function inTglPm($data='')
    {
        $q = null;
        if ($data != '') {
           $q = $this->db->insert('prev_maintenance', $data);
           $ok = $this->db->affected_rows();
           if ($ok) {
               return $q;
           }
        }
    }

    // Tanggal Prefentive Maintenance
      public function getTglPm($id='',$id_pm='')
      {
          if ($id != '') {
            $q =  $this->db->get_where('prev_maintenance',['id' => $id]);
          }else if ($id_pm != '') {
            $q =  $this->db->get_where('prev_maintenance',['id_pm' => $id_pm]);
          }else{
             $q =  $this->db->get('prev_maintenance');
          }
  
          return $q;
      }

    //   Data Teknis Pelanggan


    public function dttctr()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dta');

        // Set table name
        $CI->dta->table = 'dt_pelanggan dtp';
        // Set orderable column fields
        $CI->dta->column_order = [null, 'customer','device','ip_address','access','port','user','password','enable'];
        // Set searchable column fields
        $CI->dta->column_search = ['customer','device','ip_address','access','port','user','password','enable'];
        // Set select column fields
        $CI->dta->select = 'c.nama_customer,device,ip_address,access,port,user,password,enable';
        // Set default order
        $CI->dta->order = ['dtp.id' => 'desc'];

        $condition = [
            ['join','customers c',' c.id = dtp.customer_id','inner']
        ];

        // Fetch member's records
        $dataTabel = $this->dta->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama_customer,
                $dt->device,
                $dt->ip_address,
                $dt->access,
                $dt->port,
                $dt->user,
                $dt->password,
                $dt->enable,
                ''
            );
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dta->countAll($condition),
            "recordsFiltered" => $this->dta->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function tes(){
        $this->db->select('t.dtm, t.status, t.body ,c.nama_customer');
        $this->db->join('customers c', 'c.id = t.customer');
        $all = $this->db->get('tickets t');
        
        return $all->result();
        
    }

    // Ticketing Category
     
    public function dtTicCategory()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'tic_kategori';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nama_kategori'];
        // Set searchable column fields
        $CI->dt->column_search = ['nama_kategori'];
        // Set select column fields
        $CI->dt->select = 'id,nama_kategori';
        // Set default order
        $CI->dt->order = ['id' => 'desc'];

        // $condition = [
        //     ['join','customers c','c.id = s.customer_id','inner']
        // ];

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        $del = "'Are you sure to delete this data ?'";
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama_kategori,
                '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#mEditTicCategory"  onclick="getEditTicCategory('.$dt->id.')">Edit</button> <a onclick="deTicCategory('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

     // Ticketing Subject
     
     public function dtTicSubject()
     {
         // Definisi
         $condition = '';
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'tic_subject s';
         // Set orderable column fields
         $CI->dt->column_order = [null, 'c.nama_kategori','s.nama_subject'];
         // Set searchable column fields
         $CI->dt->column_search = ['c.nama_kategori','s.nama_subject'];
         // Set select column fields
         $CI->dt->select = 's.id,c.nama_kategori,s.nama_subject';
         // Set default order
         $CI->dt->order = ['c.id' => 'desc'];
 
         $condition = [
             ['join','tic_kategori c','c.id = s.tic_ktg_id','inner']
         ];
 
         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
 
         $i = $_POST['start'];
         $del = "'Are you sure to delete this data ?'";
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                 $i,
                 $dt->nama_kategori,
                 $dt->nama_subject,
                 '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#mEditTicSubject"  onclick="getSubjectTicCategory('.$dt->id.')">Edit</button> <a onclick="deTicSubject('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

     // Ticketing Layanan
     public function get_tic_layanan($id='')
     {
        $rsl = '';
        $this->db->select('tl.id,l.id as lid, layanan');
        $this->db->join('layanan l', 'l.id = tl.layanan_id', 'inner');
        $l = $this->db->get_where('tic_layanan tl', ['tl.id' => $id]);
        if ($l->num_rows() > 0) {
            $rsl = $l->row()->layanan;
        }

        return $rsl;
     }

     public function get_layanan($id='')
     {
        $rsl = '';

        $l = $this->db->get_where('layanan l', ['l.id' => $id]);
        if ($l->num_rows() > 0) {
            $rsl = $l->row()->layanan;
        }

        return $rsl;
     }

     public function layanan($id='')
    {
        if ($id != '') {
          $q =  $this->db->get_where('layanan',['id' => $id]);
        }else{
           $q =  $this->db->get('layanan');
        }

        return $q;
        
    }

    public function tic_layanan($id='',$cust_end='')
    {
        $this->db->select('tl.id,l.id as lid, layanan');
        $this->db->join('layanan l', 'l.id = tl.layanan_id', 'inner');
        if ($id != '') {
          $this->db->where('tl.id', $id);
        }else if ($cust_end != '') {
          $this->db->where(['tl.cust_end_id'=> $cust_end,['dele'=>'N']);
        }
        
        $q =  $this->db->get('tic_layanan tl');

        return $q;
        
    }
     
     public function dtTicLayanan()
     {
         // Definisi
         $condition = '';
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'tic_layanan s';
         // Set orderable column fields
         $CI->dt->column_order = [null,'c.custend', 'l.layanan'];
         // Set searchable column fields
         $CI->dt->column_search = ['l.layanan','c.custend'];
         // Set select column fields
         $CI->dt->select = 's.id,l.layanan,c.custend,s.dele';
         // Set default order
         $CI->dt->order = ['s.id' => 'desc'];
        
         $condition = [
            ['join','cust_end c','c.id = s.cust_end_id','inner'],
            ['join','layanan l','l.id = s.layanan_id','inner'],
        ];

         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
 
         $i = $_POST['start'];
         $del = "'Are you sure to delete this data ?'";
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                 $i,
                 $dt->custend,
                 $dt->layanan,
				 $dt->dele,
                 '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#mEditTicLayanan"  onclick="getEditTicLayanan('.$dt->id.')">Edit</button> <a onclick="deTicLayanan('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

    //  Preventive Maintenance

    public function dt_pm()
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'prev_maintenance pm';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'custend', 'pm.lokasi', 'nama','tanggal','problem','desc'];
        // Set searchable column fields
        $CI->dt->column_search = ['custend', 'pm.lokasi', 'nama','tanggal','problem','desc'];
        // Set select column fields
        $CI->dt->select = 'pm.id,k.nama,ce.custend,pm.tanggal,pm.lokasi,problem,desc,hasil,pm.status';
        // Set default order
        $CI->dt->order = ['k.id' => 'desc'];
        
        $con = ['join','karyawan k','k.id = pm.teknisi_id','inner'];
        array_push($condition,$con);

        $con = ['join','cust_end ce','ce.id = pm.customer_id','inner'];
        array_push($condition,$con);

        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->custend,
                $dt->lokasi,
                $dt->nama,
                $dt->tanggal,
                $dt->problem,
                $dt->desc,
                $dt->hasil,
                $this->set_status_pm($dt->status),
                '<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modelEditPm" onclick="get_pm('.$dt->id.')">Edit</a>',
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

    public function set_status_pm($status='')
    {
        $hsl = '';
        if ($status != '') {
            if ($status == '1') {
                $hsl = 'On Schedule';
            }else if ($status == '2') {
                $hsl = 'Done';
            }else if ($status == '3') {
                $hsl = 'Close';
            }else if ($status == '4') {
                $hsl = 'Reschedule';
            }
        }

        return $hsl;
    }

    // Customer Device

    public function dt_cust_device($pk_id='')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_devices cd';
       // Set orderable column fields
       $CI->dt->column_order = [null,'node_id' ,'model' ,'ip' ,'access' ,'port' ,'user' ,'password' ,'enable','sd.ctddate'];
       // Set searchable column fields
       $CI->dt->column_search = ['node_id' ,'model' ,'ip' ,'access' ,'port' ,'user' ,'password' ,'enable','cd.ctddate'];
       // Set select column fields
       $CI->dt->select = 'cd.id,ce.id as custid,node_id,cd.status,cd.ket,model,ip,access,port,user,password,enable,cd.ctddate,project,sn';
       // Set default order
       $CI->dt->order = ['cd.id' => 'desc'];
        
       if ($pk_id != '') {
            $con = ['where','project',$pk_id];
            array_push($condition,$con);
       }

       $con = ['join','projek_kontrak pk','pk.id = cd.project','inner'];
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
               $dt->node_id,
               $dt->sn,
               $dt->model,
               $dt->ip,
               $dt->access,
               $dt->port,
               //    $dt->password,
               $dt->enable,
               $dt->status,
               $dt->ket,
               '<a href="'.site_url('Oprations/manage_device?id='.$dt->id).'" class="btn btn-default btn-sm" >Edit</a> <a target="_blank" href="'.site_url('Oprations/replace?edit=true&cust='.$dt->custid.'&device_id='.$dt->id).'" class="btn btn-default btn-sm" >Replace</a> ',
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

    // NODE

    public function dt_node()
     {
         // Definisi
         $condition = '';
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'tic_node tn';
         // Set orderable column fields
         $CI->dt->column_order = [null,'tn.node','c.custend', 'l.layanan'];
         // Set searchable column fields
         $CI->dt->column_search = ['tn.node','l.layanan','c.custend'];
         // Set select column fields
         $CI->dt->select = 'tn.id,tn.node,l.layanan,c.custend';
         // Set default order
         $CI->dt->order = ['tn.id' => 'desc'];
        
         $condition = [
            ['join','cust_end c','c.id = tn.cust_id','inner'],
            ['join','tic_layanan tl','tl.id = tn.tic_layanan_id','inner'],
            ['join','layanan l','l.id = tl.layanan_id','inner'],
        ];

         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
 
         $i = @$_POST['start'];
         $del = "'Are you sure to delete this data ?'";
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                 $i,
                 $dt->node,
                 $dt->custend,
                 $dt->layanan,
                 '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal_edit_node"  onclick="get_edit_node('.$dt->id.')">Edit</button> <a onclick="del_node('.$dt->id.')" class="btn btn-outline-warning">Hapus</a>',
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

     public function get_node($id='')
     {
        $q = $this->db->get_where('tic_node tn', ['id' => $id]);
        return $q;         
     }

     public function get_node_cl($cust_id='',$layanan_id='')
     {
        $q = $this->db->get_where('tic_node tn', ['cust_id' => $cust_id,'tic_layanan_id' => $layanan_id]);
        return $q;         
     }
   
}
