<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTagihan extends CI_Model {

    public $see = '*';
    public $lim = 0;

    public function getTgh($act='',$date='',$status='',$cari='',$aktif='1',$info='') 
    {
        $q = null;

         if ($cari != '') {
            $this->db->like('pk.no_kontrak', $cari);
            $this->db->or_like('p.service', $cari);
         }   

        if ($act == 1 && $date != '' && is_array($date)) { // Tagihan Berjangka,  Tagihan Minggu Ini / Tagihan Sekarang (Tagihan yang sudah di prepare dari 1 minggu lalu)
            $this->db->select($this->see);
            $this->db->join('tgh_list tl', 'tl.projek_id = p.id', 'inner');
            $this->db->join('cust c', 'c.id = p.cust_id', 'left');
            $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
            $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');
            if ($status != '') {
                $this->db->where('tl.status', $status);
            }
            $this->db->where_in('tl.tghDate', $date);

            if ($this->lim != 0) {
                $this->db->limit(10);
            }

            $q = $this->db->get_where('projek p', ['p.aktif' => $aktif]);
            return $q;
        }elseif ($act == 2 && $date != '') { //Tagihan bulan besok
            $this->db->select($this->see);
            $this->db->join('tgh_list tl', 'tl.projek_id = p.id', 'inner');
            $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');
            $this->db->join('cust c', 'c.id = p.cust_id', 'left');
            $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
            $this->db->where('tl.tghDate = (SELECT tghDate FROM `tgh_list` WHERE status = 0 AND date(tghDate) > "'.$date.'"  ORDER BY `tghDate` ASC LIMIT 1)');
            if ($status != '') {
                $this->db->where('tl.status', $status);
            }
            $this->db->order_by('tl.tghDate', 'ASC');

            if ($this->lim != 0) {
                $this->db->limit($this->lim);
            }
            
            $this->db->group_by('tl.id');
            
            $q = $this->db->get_where('projek p', ['p.aktif' => $aktif]);
            return $q;
        } else if ($act == 3 && $date != '') { // Tagihan Berjangka,  Tagihan Minggu Ini / Tagihan Sekarang (Tagihan yang sudah di prepare dari 1 minggu lalu)
            $this->db->select($this->see);
            $this->db->join('tgh_list tl', 'tl.projek_id = p.id', 'inner');
            $this->db->join('cust c', 'c.id = p.cust_id', 'left');
            $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
            $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');
            if ($status != '') {
                $this->db->where('tl.status', $status);
            }
            $this->db->where('(MONTH(tl.tghDate) <= MONTH(NOW()) AND YEAR(tl.tghDate) <= YEAR(NOW()))');

            if ($this->lim != 0) {
                $this->db->limit($this->lim);
            }

            $this->db->group_by('tl.id');

            $q = $this->db->get_where('projek p', ['p.aktif' => $aktif]);
            return $q;
        }else{ 
            $this->db->select($this->see);
            $this->db->join('cust c', 'c.id = p.cust_id', 'left');
            $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'left');
            $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');
            
            if ($this->lim != 0) {
                $this->db->limit($this->lim);
            }

            $q = $this->db->get_where('projek p', ['p.status' => $status]);
            return $q; //bisa menampilkan tagihan yang sudah lunas / yang belum
        }
        
    }

    // Detail Tagihan
    public function getTghId($projek_id='',$tgh_list_id='')
    {
        $this->db->select($this->see);
        $this->db->join('cust c', 'c.id = p.cust_id', 'left');
        $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
        $this->db->join('tgh_list tl', 'tl.projek_id = p.id', 'inner');
        $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');
        $this->db->where('p.id', $projek_id);
        $this->db->where('tl.id', $tgh_list_id);
        $q = $this->db->get('projek p');
        return $q;
    }

    // Tgh List data table

    public function dtTghList($projek_id='',$status='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'tgh_list tl';
        // Set orderable column fields
        $CI->dt->column_order = [null, '    tghDate','total','terbayar','terhutang','status'];
        // Set searchable column fields
        $CI->dt->column_search = [' tghDate','total','terbayar','terhutang','status'];
        // Set select column fields
        $CI->dt->select = '*';
        // Set default order
        $CI->dt->order = ['tl.tghDate' => 'ASC'];

        if ($projek_id != '') {
            $con = ['where','tl.projek_id',$projek_id];
            array_push($condition,$con);
        }
        
        if ($status != '') {
            $con = ['where','tl.status',$status];
            array_push($condition,$con);
        }

        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $this->bantuan->tgl_indo($dt->tghDate),
                torp($dt->total),
                torp((int)$dt->terbayar),
                torp((int)$dt->terhutang),
                '<span class="badge badge-light">'.$this->getStatusTgh($dt->status).'</span>',
                '<a href="'.site_url('tagihan/detail_tagihan/'.$dt->projek_id.'/'.$dt->id).'"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">Detail</button></a>'.
                '<a href="#" onclick="deTghList('.$dt->id.')"><button class="btn btn-default text-uppercase font-weight-bold text-grey" style="margin-left:5px;padding:3px 10px !important;font-size: 13px;"><i class="fa fa-trash"></i></button></a>'
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

    public function getTghList($projek_id='',$status='',$groupby='',$see='') //mengambil daftar salary tagihan bulanan
    {
        if ($projek_id != '') {
            $this->db->where('tl.projek_id', $projek_id); // berdasarkan projek id
        }

        if ($groupby != '') {
            $this->db->group_by('tl.projek_id');
        }

        if ($see != '') {
            $this->db->select($see);
        }
        
        if ($status != '') {
            $this->db->where('tl.status', $status); //belum bayar
        }
        $q = $this->db->get('tgh_list tl');
        return $q;
    }
    public function dtTagihan($aktif='')
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
        $CI->dt->select = 'p.id as idp,customer,custend,service,total_kon_ppn,p.aktif,pk.aktif';
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
                $dt->service.'</br><span style="color:#d81b60;font-size:12px;">'.$ce."</span>",
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

    // Mengambil data jenis lampiran dari database
    public function getJenisLamp($id='',$in='',$type='')
    {
        if ($id != '') {
            $q = $this->db->get_where('jenis_lamp',['id' => $id]);
        }else if ($in != '') {
            $this->db->where_in('id', $in);
            $q = $this->db->get('jenis_lamp');
        }else{
            if ($type != '') {
                $this->db->where('type', $type);
            }
            $q = $this->db->get('jenis_lamp');
        }
        return $q;
    }

    // Get Projek Monitoring Tagihan
    public function getProjekTgh($projek_id='',$lim='20',$status='',$aktif='')
    {
        $data = [];
        $rsl = [];
        
        if ($projek_id != '') {
            $this->db->select('projek_id,service,customer,custend,pk.aktif,pk.status,pk.masa_kontrak,pk.no_kontrak,total_kon_ppn,sudah_invoice,terhutang,terbayar,pk.start_date,pk.end_date,pk.ctdBy,pk.category');
            $this->db->where('p.id',$projek_id);
        }else{
            $this->db->select('projek_id,service,customer,custend,pk.aktif,pk.status,pk.masa_kontrak,pk.no_kontrak,total_kon_ppn,sudah_invoice,terhutang,terbayar,pk.start_date,pk.end_date,pk.ctdBy,pk.category,ak.pipeline_id as akpid,ap.pipeline_id as apid,p.pipeline_id');
            $this->db->join('act_kontrak ak', 'ak.pipeline_id = p.pipeline_id', 'left');
            $this->db->join('act_po ap', 'ap.pipeline_id = p.pipeline_id', 'left');
            $this->db->group_by('p.id');
        }
        
        if ($status != '') {
            $this->db->where('pk.status',$status);
        }

        $this->db->order_by('pk.id', 'desc');
        $this->db->where('pk.aktif','1');
        // $this->db->where('pk.status_kontrak','1');

        $this->db->join('cust c', 'c.id = p.cust_id', 'left');
        $this->db->join('cust_end ce', 'ce.id = p.cust_end_id', 'inner');
        $this->db->join('projek_kontrak pk', 'pk.projek_id = p.id', 'inner');

        $this->db->limit($lim);
        $q = $this->db->get('projek p');

        if ($q->num_rows() > 0) {       
            
            if ($projek_id != '') {
            
            $v = $q->row();

            $rsl = [
                'projek_id' => $v->projek_id,
                'service' => $v->service,
                'category' => $v->category,
                'customer' => $v->customer,
                'custend' => $v->custend,
                'custendcust' => $v->customer != '' ? $v->customer.' - '.$v->custend : $v->custend,
                'aktif' => [$v->aktif,$this->getProjekAktif($v->aktif)],
                'status' => [$v->status,$this->getProjekStatus($v->status)],
                'masa_kontrak' => $v->masa_kontrak,
                'no_kontrak' => $v->no_kontrak,
                'total_tagihan' => torp($v->total_kon_ppn),
                'tt' => $v->total_kon_ppn,
                // 'doc' => [],
                'total_terbayar' => $this->getTotalTgh($v->projek_id,'1'),
                'total_terhutang' => $this->getTotalTgh($v->projek_id,'2'),
                'sales' => $v->ctdBy != "" ? $this->db->get_where('karyawan',['id' => $v->ctdBy])->row()->nama : "-",
                'start_date' => $v->start_date,
                'end_date' => $v->end_date,
            ];
       
            }else{
                $vq = $q->result();
                foreach ($vq as $v) {
                    // if ($v->pipeline_id == $v->apid || $v->pipeline_id == $v->akpid) {
                        // echo $v->pipeline_id.' = '.$v->apid;
                        // echo $v->pipeline_id.' = '.$v->akpid;
                        // if($v->apid != '' || $v->akpid != ''){
                            $data = [
                            'projek_id' => $v->projek_id,
                            'service' => $v->service,
                            'pipeline_id' => $v->pipeline_id,
                            'akpid' => $v->akpid,
                            'apid' => $v->apid,
                            'category' => $v->category,
                            'customer' => $v->customer,
                            'custend' => $v->custend,
                            'custendcust' => $v->customer != '' ? $v->customer.' - '.$v->custend : $v->custend,
                            'aktif' => [$v->aktif,$this->getProjekAktif($v->aktif)],
                            'status' => [$v->status,$this->getProjekStatus($v->status)],
                            'masa_kontrak' => $v->masa_kontrak,
                            'no_kontrak' => $v->no_kontrak,
                            'total_tagihan' => torp($v->total_kon_ppn),
                            'tt' => $v->total_kon_ppn,
                            // 'doc' => $this->getDocPipeline($v->pipeline_id),
                            'total_terbayar' => $this->getTotalTgh($v->projek_id,'1'),
                            'total_terhutang' => $this->getTotalTgh($v->projek_id,'2'),
                            'sales' => $v->ctdBy != "" ? $this->db->get_where('karyawan',['id' => $v->ctdBy])->row()->nama : "-",
                            'start_date' => $v->start_date != '0000-00-00' ? $this->bantuan->tgl_indo($v->start_date) : '',
                            'end_date' =>  $v->end_date != '0000-00-00' ? $this->bantuan->tgl_indo($v->end_date) : '',
                        ];

                        array_push($rsl,$data);
                        // }
                    // }
                }
            }

        }

        return $rsl;
    }

    private function getTotalTgh($projek_id='',$jenis='1')
    {
        $total = 0;
        $q = $this->getTghList($projek_id,'','1','SUM(terbayar) as total_terbayar,SUM(terhutang) as total_terhutang');
        if ($q->num_rows() > 0) {
            $x = $q->row();
            if ($jenis == '1') {
                $total = $x->total_terbayar;
            }else if ($jenis == '2') {
                $total = $x->total_terhutang;
            }
        }
        return torp((float) $total);
    }   

    public function getProjekAktif($s='')
    {
        if ($s == 1) {
            return "Aktif";
        }else if($s == 0){
            return "Tidak Aktif";
        }
    }
    
    public function getProjekStatus($s='')
    {
        if ($s == 1) {
            return "On Progress";
        }else if($s == 2){
            return "Terhutang";
        }else if($s == 3){
            return "Lunas/Selesai";
        }else if($s == 3){
            return "Tertagih";
        }else{
            return "Berlum Diproses";
        }
    }

    // Mengambil Dokumen Projek 

    public function getProjekDoc($p='',$tlid='', $groupby='')
    {
        $this->db->select('jl.id,jl.jl,pc.file,nma_jabatan as jabatan,nama,pc.ctdDate');
        $this->db->join('jenis_lamp jl', 'jl.id = pc.jl_id', 'inner');
        $this->db->join('karyawan k', 'k.id = pc.ctdBy', 'inner');
        $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'inner');
        $this->db->where('pc.projek_id', $p);
        $this->db->where('pc.tgh_list_id', $tlid);
        $this->db->order_by('pc.id', 'desc');

        if ($groupby != '') {
            $this->db->group_by('pc.jl_id');
        }

        $q = $this->db->get('projek_doc pc');
        return $q;
    }   

    // Datatable History Projek Tagihan

    public function dtProjekTghH($projek_id='',$tlid='')
    {
         // Definisi
         $condition = [];
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'projek_tgh_h';
         // Set orderable column fields
         $CI->dt->column_order = [null, 'msg','ctdBy','ctdDate'];
         // Set searchable column fields
         $CI->dt->column_search = ['msg','ctdBy','ctdDate'];
         // Set select column fields
         $CI->dt->select = 'id,msg,ctdBy,ctdDate';
         // Set default order
         $CI->dt->order = ['id' => 'desc'];

         $con = ['where','projek_id',$projek_id];
         array_push($condition,$con);

         $con = ['where','tgh_list_id',$tlid];
         array_push($condition,$con);

         // Fetch member's records
         $dataTabel = $this->dt->getRows(@$_POST, $condition);
 
         $i = @$_POST['start'];
         foreach ($dataTabel as $dt) {
             $i++;
             $data[] = array(
                 $i,
                 $dt->msg,
                 $dt->ctdBy,
                 $dt->ctdDate
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

    // Insert data history projek tagihan

    public function inProjekTghH($projek_id='',$tgh_list_id="",$msg="",$data="",$nama="")
    {
        if ($nama == '') {
            $n = $this->db->get_where('karyawan', ['id' => $this->session->userdata('karyawan_id')])->row()->nama;
            $nama = $n;
        }

        $data = [
            'projek_id' => $projek_id,
            'tgh_list_id' => $tgh_list_id,
            'msg' => $msg,
            'data' => $data,
            'ctdBy' => $nama,
            'ctdDate' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('projek_tgh_h', $data);
        $k = $this->db->affected_rows();
        
        return [$data,$k];    
    }

    public function getStatusTgh($s=0)
    {
        if($s == 0){
            return "Belum Diproses";
        }else if ($s == 1) {
            return "On Progress";
        }else if ($s == 2) {
            return "Terhutang";
        }else if ($s == 3) {
            return "Terbayar";
        }else if ($s == 4) {
            return "Tertagih";
        }
    }

    public function getTghAktif($s=0)
    {
        if ($s == 0) {
            return "Tidak";
        }else if($s == 1){
            return "Ya";
        }
    }
    
    public function setTerbayar($n,$id)
    {
        $status = false;

        $q = $this->db->update('tgh_list', ['terbayar' => $n,'status' => 3], ['id' => $id]);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $status = true;
        }   

        return $status;
    }

    public function getJmlTgh($status='',$type='',$date='')
    {
        $sum = '';
        $where = '';
        $st = '';


        if ($status == "3") {
            $sum = "sum(terbayar)";
            $st = ' AND status in (3,2)';
        }else{
            $sum = "sum(total)";
        }
        
        if ($date == '') {
            $date = date('Y-m-d');
        }

        if ($type=='1') { //minggu

        }else if($type=='2'){ //bulan
            $where = 'MONTH(tghDate) = MONTH("'.$date.'") AND YEAR(tghDate) = YEAR("'.$date.'")'.$st;
        }else if($type=='3'){ //tahun
            $where = 'YEAR(tghDate) = YEAR("'.$date.'")'.$st;
        }

        $this->db->select($sum.' as total');
        $this->db->where($where);
        $q = $this->db->get('tgh_list');
        return $q->row()->total;
    }

    // GET Jumlah Projek Tagihan
    public function getJmlProjekTgh($projek_id='',$type='',$date='')
    {
        $data = [];
        $where = '';
        $where2 = '';
        $max = 0;

        $namaBulan = [];
        $valJumlah = [];

         // Bulan
         $bulan = [
            ['key' => 1,'name' => "Jan", 'val' => 0],
            ['key' => 2,'name' => "Feb", 'val' => 0],
            ['key' => 3,'name' => "Mar", 'val' => 0],
            ['key' => 4,'name' => "Apr", 'val' => 0],
            ['key' => 5,'name' => "Mei", 'val' => 0],
            ['key' => 6,'name' => "Jun", 'val' => 0],
            ['key' => 7,'name' => "Jul", 'val' => 0],
            ['key' => 8,'name' => "Agu", 'val' => 0],
            ['key' => 9,'name' => "Sep", 'val' => 0],
            ['key' => 10,'name' => "Okt", 'val' => 0],
            ['key' => 11,'name' => "Nov", 'val' => 0],
            ['key' => 12,'name' => "Des", 'val' => 0],
        ];
        if ($date == '') {
            $date = date('Y-m-d');
        }

        $t_tagihan =  0;
        $t_terbayar =  0;
        $t_terhutang =  0;
        $t_sisa_tagihan =  0;
        $margin_lose =  0;
        $jml_p_aktif =  0;
        $jml_p_tidak_aktif =  0;
        $jml_p_berjalan =  0;
        $jml_p_lunas =  0;
        $jml_p_terhutang =  0;

        $jml_t_tagihan =  [];
        $jml_t_terbayar =  [];
        $jml_t_terhutang =  [];

        if ($projek_id != '') {
            $w = " AND projek_id = ".$projek_id;
        }else{
            $w = "";
        }

        if ($type=='1') { //minggu

        }else if($type=='2'){ //bulan
            $where = 'MONTH(tghDate) = MONTH("'.$date.'")'.$w;
            $where2 = 'AND MONTH(tghDate) = MONTH("'.$date.'")'.$w;
            $where3 = 'AND MONTH(updDate) = MONTH("'.$date.'")'.$w;
        }else if($type=='3'){ //tahun
            $where = 'YEAR(tghDate) = YEAR("'.$date.'")'.$w;
            $where2 = 'AND YEAR(tghDate) = YEAR("'.$date.'")'.$w;
            $where3 = 'AND YEAR(updDate) = YEAR("'.$date.'")'.$w;
        }else{
            // if ($w != '') {
            //     $where = "WHERE ".$w;
            // }
            
        }

        $t_tagihan = cekData($this->db->query('SELECT sum(total) as total FROM `tgh_list` pk WHERE '.$where),'total'); //total tagihan  
        $t_terbayar = cekData($this->db->query('SELECT sum(terbayar) as total FROM `tgh_list` pk WHERE '.$where),'total');
        $t_terhutang = cekData($this->db->query('SELECT sum(terhutang) as total FROM `tgh_list` pk WHERE '.$where),'total');
        $t_sisa_tagihan = cekData($this->db->query('SELECT (sum(total) - sum(terbayar)) as total FROM `tgh_list` pk WHERE '.$where),'total');

        // Query Harga  
        $q_h_tagihan = $this->db->query("SELECT MONTH(tghDate) as k,sum(total) as jml FROM tgh_list tl WHERE ".$where." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        $q_h_terhutang = $this->db->query("SELECT MONTH(tghDate) as k,sum(terhutang) as jml FROM tgh_list tl WHERE status = 2 ".$where2." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        $q_h_terbayar = $this->db->query("SELECT MONTH(tghDate) as k,sum(terbayar) as jml FROM tgh_list tl WHERE status = 3 ".$where2." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        $q_h_tertunda = $this->db->query("SELECT MONTH(tghDate) as k,(sum(total) - (sum(terbayar)) + sum(terhutang)) as jml  FROM tgh_list tl WHERE status not in (3) ".$where2." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        
        // Margin
        $q_margin = $this->db->query("SELECT MONTH(tghDate) as k,FORMAT((sum(terbayar) / sum(total) * 100),1)  as jml  FROM tgh_list tl WHERE ".$where." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        $q_margin_lose = $this->db->query("SELECT MONTH(tghDate) as k,FORMAT((100 - (sum(terbayar) / sum(total) * 100)),1)  as jml  FROM tgh_list tl WHERE ".$where." GROUP BY MONTH(tghDate)"); //Aktif per Projek

        // Query Jumlah Total
        $q_jml_t_tagihan = $this->db->query("SELECT MONTH(tghDate) as k, count(*) as jml FROM `tgh_list` WHERE $where GROUP BY MONTH(tghDate)"); //Aktif per Projek
        $q_jml_t_terbayar = $this->db->query("SELECT MONTH(tghDate) as k, count(*) as jml FROM `tgh_list` WHERE status = 3 ".$where2." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        $q_jml_t_terhutang = $this->db->query("SELECT MONTH(tghDate) as k, count(*) as jml FROM `tgh_list` WHERE status = 2 ".$where2." GROUP BY MONTH(tghDate)"); //Aktif per Projek
        
        $jml_p_aktif = $this->db->query("SELECT id FROM `projek_kontrak` p WHERE aktif = 1 ".$where3)->num_rows(); //Aktif per Projek
        $jml_p_tidak_aktif = $this->db->query("SELECT id FROM `projek_kontrak` p WHERE aktif = 0 ".$where3)->num_rows(); // Tidak Aktif per Projek

        $jml_p_berjalan = $this->db->query("SELECT id FROM `projek_kontrak` p WHERE status = 1 ".$where3)->num_rows(); // Berjalan per Projek
        $jml_p_terhutang = $this->db->query("SELECT id FROM `projek_kontrak` p WHERE status = 2 ".$where3)->num_rows(); // Terhutang per Projek
        $jml_p_lunas = $this->db->query("SELECT id FROM `projek_kontrak` p WHERE status = 3 ".$where3)->num_rows(); // Lunas per Projek
        

        // Margin
        $m_income = $this->grx_j_tgh($q_margin,'float');
        $m_lose = $this->grx_j_tgh($q_margin_lose,'float');

        // Proses Harga 

            $h_tagihan = $this->grx_j_tgh($q_h_tagihan,'float');
            $h_terhutang = $this->grx_j_tgh($q_h_terhutang,'float');
            $h_terbayar = $this->grx_j_tgh($q_h_terbayar,'float');
            $h_tertunda = $this->grx_j_tgh($q_h_tertunda,'float');

        // Proses Jumlah Tagihan
        
            // Total Jumlah Tagihan
            $jml_t_tagihan = $this->grx_j_tgh($q_jml_t_tagihan);

            // Jumlah Terbayar
            $jml_t_terbayar = $this->grx_j_tgh($q_jml_t_terbayar);
            
            // Jumlah Terhutang
            $jml_t_terhutang = $this->grx_j_tgh($q_jml_t_terhutang);


        // Tutup Proses Jumlah Tagihan

        $data = [
            't_tagihan' => (float) $t_tagihan,
            't_terbayar' => (float) $t_terbayar,
            't_terhutang' => (float) $t_terhutang,
            't_sisa_tagihan' => (float) $t_sisa_tagihan,
            'margin_lose' => $margin_lose,
            'jml_p_berjalan' => $jml_p_berjalan,
            'jml_p_tidak_aktif' => $jml_p_tidak_aktif,
            'jml_p_terhutang' => $jml_p_terhutang,
            'jml_p_lunas' => $jml_p_lunas,
            'jml_t_tagihan' => $jml_t_tagihan,
            'jml_t_terbayar' => $jml_t_terbayar,
            'jml_t_terhutang' => $jml_t_terhutang,
            'h_tagihan' => $h_tagihan,
            'h_terhutang' => $h_terhutang,
            'h_terbayar' => $h_terbayar,
            'h_tertunda' => $h_tertunda,
            'm_income' => $m_income,
            'm_lose' => $m_lose
        ];

        return $data;

    }

    private function grx_j_tgh($q='',$tipe_data='int')
    {
        $max = 0;
        $namaBulan = [];
        $valJumlah = [];

         // Bulan
         $bulan = [
            ['key' => 1,'name' => "Jan", 'val' => 0],
            ['key' => 2,'name' => "Feb", 'val' => 0],
            ['key' => 3,'name' => "Mar", 'val' => 0],
            ['key' => 4,'name' => "Apr", 'val' => 0],
            ['key' => 5,'name' => "Mei", 'val' => 0],
            ['key' => 6,'name' => "Jun", 'val' => 0],
            ['key' => 7,'name' => "Jul", 'val' => 0],
            ['key' => 8,'name' => "Agu", 'val' => 0],
            ['key' => 9,'name' => "Sep", 'val' => 0],
            ['key' => 10,'name' => "Okt", 'val' => 0],
            ['key' => 11,'name' => "Nov", 'val' => 0],
            ['key' => 12,'name' => "Des", 'val' => 0],
        ];
     

        $jml_t =  [];

        foreach ($q->result() as $k => $v) {
            foreach ($bulan as $km => $m) {
                
                if ($tipe_data == 'int') {
                    if ($m['key'] == $v->k) {
                        $bulan[$km]['val'] = (int)$v->jml;
                        if($v->jml > $max )
                            $max += (int)$v->jml;
                    }
                }

                if ($tipe_data == 'float') {
                    if ($m['key'] == $v->k) {
                        $bulan[$km]['val'] = (float)$v->jml;
                        if($v->jml > $max )
                            $max += (float)$v->jml;
                    }
                }
                
            }
        }

        foreach ($bulan as $v) {
            array_push($namaBulan,$v['name']);
            array_push($valJumlah,$v['val']);
        }

        $jml_t = [
            'nama' => $namaBulan,
            'val' => $valJumlah,
            'max' => $max+5
        ];

        return $jml_t;
    }

    // Datatable Tagihan Laporan
    public function dtTagihanLaporan($status='',$tahun='')
    {
        // Definisi
        $condition = [];
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = 'tgh_list tl';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'service','total','tl.terbayar','tl.terhutang','no_kontrak'];
        // Set searchable column fields
        $CI->dt->column_search = ['service','total','tl.terbayar','tl.terhutang','no_kontrak'];
        // Set select column fields
        $CI->dt->select = 'tl.projek_id,pk.no_kontrak,service,customer,custend,'."sum(replace(tl.total,',','')) as total".',sum(tl.terbayar) as terbayar, sum(tl.terhutang) as terhutang, ((sum(replace(tl.total,",",""))+sum(tl.terhutang)) - sum(tl.terbayar)) as sisa_tagihan,tl.status';
        // Set default order
        $CI->dt->order = ['tl.projek_id' => 'ASC'];

        if ($tahun != '') {
            $con2 = ['where','YEAR(tl.tghDate)',$tahun];
            array_push($condition,$con2);
        }

        if ($status != '') {
            $con = ['where','tl.status',$status];
            array_push($condition,$con);
        }

        $con = ['join','projek p','p.id = tl.projek_id','inner'];
        array_push($condition,$con);

        $con = ['join','cust c','c.id = p.cust_id','left'];
        array_push($condition,$con);

        $con = ['join','cust_end ce','ce.id = p.cust_end_id','left'];
        array_push($condition,$con);

        $con = ['join','projek_kontrak pk','pk.projek_id = tl.projek_id','inner'];
        array_push($condition,$con);

        $this->db->group_by('tl.projek_id');
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);
        
        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $ce = $dt->customer != '' ? $dt->customer.' - '.$dt->custend : $dt->custend;
            $data[] = array(
                '<span class="badge badge-light">'.$dt->no_kontrak.'</span></br>'.$dt->service.'</br><span style="color:#d81b60;font-size:12px;">'.$ce."</span>",
                torp($dt->total),
                torp($dt->terbayar),
                torp($dt->terhutang),
                torp($dt->sisa_tagihan),
                '<a href="'.site_url('tagihan/detail_projek/'.$dt->projek_id).'"><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></a>'
            );
        }

        $this->dt->countFiltered(@$_POST, $condition);
        $qa = $this->db->last_query();
        $xq = str_replace('ORDER BY','GROUP BY tl.projek_id ORDER BY',$qa);

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->db->query($qa)->num_rows(),
            "recordsFiltered" => $this->db->query($xq)->num_rows(),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    // update status tagihan 

    public function upStatusTgh($projek_id='',$tlid='',$s='')
    {
        $status = 1;

        if ($projek_id != '' && $tlid != '' && $s != '') {
            $this->db->update('tgh_list',['status' => $s],['projek_id' => $projek_id,'id' => $tlid]);
            if ($this->db->affected_rows() > 0) {
                $status = true;
            }
        }

        return $status;
        
    }

    public function upStatusTghField($projek_id='',$tlid='',$field='')
    {
        $status = 1;

        if ($projek_id != '' && $tlid != '' && $field != '') {
            $this->db->update('tgh_list',$field,['projek_id' => $projek_id,'id' => $tlid]);
            if ($this->db->affected_rows() > 0) {
                $status = true;
            }
        }

        return $status;
        
    }

    public function cekNgutangTgh($projek_id='',$tlid='',$nilai='')
    {
        $status = 0;
        $t = 'tgh_list';
        $w = ['id'=>$tlid,'projek_id' => $projek_id];

        $q = $this->db->get_where($t, $w);
        if ($q->num_rows() > 0) {
            $nn = $q->row();
            if ($nilai < $nn->total) {
                $this->db->update($t,['terhutang' => ($nn->total - $nilai),'status' => 2],$w);
                if ($this->db->affected_rows() > 0) {
                    $status=1;
                    $this->inProjekTghH($projek_id,$tlid,"Terhutang ".torp((float)($nn->total - $nilai)));
                }
            }
        }
        
        return $status;
    }

    // Set Status Projek

    public function setStatusProjek($projek_id='')
    {
        $r = 0;
        // Terbayar
        $tgh = $this->db->get_where('tgh_list',['projek_id' => $projek_id]);
        $tghTerbayar = $this->db->get_where('tgh_list',['status' => 3,'projek_id' => $projek_id]);
        $tghTerhutang = $this->db->get_where('tgh_list',['status' => 2,'projek_id' => $projek_id]);

        $jml = $this->db->query("SELECT sum(terhutang) as th, sum(terbayar) tb FROM `tgh_list` WHERE projek_id = ".$projek_id)->row();
        $terhutang = $jml->th;
        $terbayar = $jml->tb;

        if ($tghTerbayar->num_rows() == $tgh->num_rows()) {
            $object = [
                'status' => 3, //lunas
                'aktif' => 0,
                'terbayar' => $terbayar,
                'terhutang' => $terhutang,
                'updDate' => date('Y-m-d H:i:s')
            ];
            $r=2;
            $this->db->update('projek_kontrak', $object,['projek_id' => $projek_id]);
        }else{
            if ($tghTerhutang->num_rows() > 0) {
                $object = [
                    'status' => 2, //Tehutang
                    'aktif' => 1,
                    'terbayar' => $terbayar,
                    'terhutang' => $terhutang,
                    'updDate' => date('Y-m-d H:i:s')
                ];
                $r = 2;
            }else{
                $object = [
                    'status' => 1, //Sedang Berjalan
                    'aktif' => 1,
                    'terbayar' => $terbayar,
                    'terhutang' => $terhutang,
                    'updDate' => date('Y-m-d H:i:s')
                ];
                $r=1;
            }
            
            $this->db->update('projek_kontrak', $object,['projek_id' => $projek_id]);
        }
        return $r;
    }

    public function setTerhutangOto()
    {
        $jml = 0;
        $q = $this->db->query("SELECT DATE_ADD(tglsubmit, INTERVAL 45 DAY) FROM `tgh_list` WHERE DATE_ADD(tglsubmit, INTERVAL 45 DAY) < DATE(NOW()) AND tglsubmit != '0000-00-00' AND status != 2 ORDER BY `tghDate`");
        if ($q->num_rows() >  0 ) {
            foreach ($q->result() as $v) {
                if ($v->terhutang < 1 || $v->terhutang != '') {
                    $this->db->update('tgh_list', ['terhutang' => $v->total,'status' => 2],['id' => $v->id]);
                    $jml += $this->db->affected_rows();
                }
            }
        }

        return $jml;
    }
  
}