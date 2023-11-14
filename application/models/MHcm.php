<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MHcm extends CI_Model {

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

    public function dt($status='',$one='')
    {
        // Definisi
        $condition = [] ;
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        $CI->load->model('MAbsensi', 'ma');

        // Set table name
        $CI->dt->table = 'pengajuan p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'nama', 'tgl_pengajuan', 'lama', null,'alasan',null];
        // Set searchable column fields
        $CI->dt->column_search = ['nama', 'tgl_pengajuan', 'lama','alasan'];
        // Set select column fields
        $CI->dt->select = 'p.status_pengajuan,p.id,nama,tgl_pengajuan,p.status_pengajuan,tgl_mulai,tgl_akhir,lama,alasan,karyawan_id,jenis,nip,p.who_approve';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];

        $con4 = ['join','karyawan k','k.id = p.karyawan_id','inner'];
        array_push($condition,$con4);
       
           
         if ($this->session->userdata('leader') == 1) {
             $con5 = ['join','jabatan j','j.id = k.jabatan_id','inner'];
             array_push($condition,$con5);
             
             $con7 = ['where','j.parent_id',$this->session->userdata('level')];
             array_push($condition,$con7);
         }else{
             
             if ($one == 1) {
                 $con8 = ['where','p.karyawan_id',$this->session->userdata('karyawan_id')];
                 array_push($condition,$con8);
             }

             if ($status != '') {
                 $con8 = ['where','p.status_pengajuan',$status];
                 array_push($condition,$con8);
             }
         }
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        $terima = "'Apakah anda yakin ingin menerima pengajuan ini ?'";
        $tolak = "'Apakah anda yakin ingin menolak pengajuan ini ?'";
        $batal = '';
        $tombol = '';

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            
            $data[] = array(
                $i,
                $dt->nama.'</br><span style="font-size:13px;">'.$CI->ma->setStatus($dt->jenis).'</span>',
                $dt->tgl_pengajuan,
                $this->setStatus($dt->status_pengajuan),
                $dt->alasan,
                $this->link($dt,$one)
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

    private function link($dt,$one='')
    {
        $html = '<a class="btn btn-default btn-sm" href="'.site_url('hcm/detailSubmission/'.$dt->id).'"><i class="fa fa-info-circle"></i></a>';
        if($dt->status_pengajuan == '' || $dt->status_pengajuan == '0') {
            if ($one != 1 && $dt->who_approve == '0') {
                $tombol = ' <a class="btn btn-success btn-sm" href="#" data-toggle="modal"  data-target="#modal_form_pengajuan" onclick="get_pengajuan('.$dt->id.')"><i class="fa fa-check-circle"></i></a>';
                $html .= $tombol;
            }
        }

        return $html;
    }
    
    public function up($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update($this->t2, $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }

     public function inPc($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert($this->t2, $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data to Pengajuan Cuti";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function inCuti($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert($this->t, $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data to Cuti";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];
        
    }

    public function terima($id='')
    {   
      $pengajuan =  $this->db->update('pengajuan',['status_pengajuan' => '1','who_approve' => $this->session->userdata('karyawan_id')], ['id' => $id]);
      $absensi =  $this->db->update('absensi',['aktif' => 1], ['pengajuan_id' => $id]);

      $k = $this->db->get_where('karyawan',['id' => $this->session->userdata('karyawan_id')])->row();
      if ($k->jabatan_id == '3') {
            $this->inHPeng(1,$id,2,'2');
      }else{
        $this->inHPeng(1,$id,1,'1');
      }

      $this->session->set_flashdata('success', 'Berhasil menerima pengajuan');
      return true;
    }

    public function tolak($id='')
    {
        $pengajuan =  $this->db->update('pengajuan',['status_pengajuan' => '2','who_approve' => $this->session->userdata('karyawan_id')], ['id' => $id]);
        
        $k = $this->db->get_where('karyawan',['id' => $this->session->userdata('karyawan_id')])->row();
        if ($k->jabatan_id == '3') {
            $this->inHPeng(0,$id,3,'2');
        }else{
            $this->inHPeng(0,$id,3,'1');
        }

        return true;
    }

    public function getPeng($id='')
    {
        if ($id != '') {
            $p = $this->db->get_where('pengajuan',['id' => $id])->row();
            
            if ($p->jenis == 'CU') {
                $peng = $this->db->get_where('peng_cuti',['peng_id' => $id])->row();
            }else if ($p->jenis == 'L') {
                $peng = $this->db->get_where('peng_lembur',['peng_id' => $id])->row();
            }else if ($p->jenis == 'PD') {
                $peng = $this->db->get_where('peng_pd',['peng_id' => $id])->row();
            }else if ($p->jenis == 'SK') {
                $peng = $this->db->get_where('peng_sakit',['peng_id' => $id])->row();
            }
        }

        return [$peng,$p->jenis];
    }

    public function get_jml_pengajuan_arr($arr='')
    {
        if ($arr != '') {
            $this->db->select('sum(p.lama) as jml');
            $this->db->group_by('p.karyawan_id');
            $this->db->join('karyawan k', 'k.id = p.karyawan_id', 'inner');
            $q = $this->db->get_where('pengajuan p',$arr);
            return $q; 
        }
    }

    public function get_pengajuan($id='',$arr='')
    {

        if ($id != '') {
            $this->db->where('p.id', $id);
        }
        $this->db->join('karyawan k', 'k.id = p.karyawan_id', 'inner');
        $q = $this->db->get('pengajuan p');
        return $q; 
    }

    public function get_pengajuan_id($id='')
    {
        if ($id == '')  return false;
        $this->db->where('p.id', $id);
        $this->db->join('karyawan k', 'k.id = p.karyawan_id', 'inner');
        $q = $this->db->get('pengajuan p');
        return $q; 
    }

    public function getHPeng($id='')
    {
        $s = 0;
        if ($id != '') { 
            $p = $this->db->query('SELECT nama,approve,hp.status,alasan,hp.created_date FROM h_peng hp INNER JOIN karyawan k ON k.id = hp.approved_id WHERE hp.peng_id = '.$id);
            $s = $p->num_rows();
        }

        return [$p->result(),$s];
    }

    public function setApprove($a='')
    {
        if ($a != '') {
            if ($a == 1) {
                return 'Ya';
            }else{
                return 'Tidak';
            }
        }else{
            return '-';
        }
    }

    // Fungsi ini untuk karyawan/leader/yang bersangkutan menerima pengajuan karyawan
    public function inHPeng($approve='',$peng_id='',$status='',$tahap='')
    {
        $alasan = '';

        if ($peng_id != '') {

            $alasan = $this->input->post('alasan');
            
            $object = [
                'peng_id' => $peng_id,
                'tahap' => $tahap,
                'approve' => $approve,
                'alasan' => $alasan,
                'status' => $status,
                'approved_id' => $this->session->userdata('karyawan_id'),
                'created_date' => date('Y-m-d H:i:s')
            ];

            $a = $this->db->insert('h_peng', $object);
            if ($this->db->affected_rows()) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function setStatus($status='')
    {
        if ($status != '') {
            if ($status == '0') {
                return 'Pending';
            }else if ($status == '1') {
                return 'Diterima';
            }else if ($status == '2') {
                return 'Ditolak';
            }else if ($status == '3') {
                return 'Rejected';
            }
        }
    }

    public function inTrackCov($obj='')
    {
        $q = $this->db->insert("tracking_covid", $obj);
        $id = $this->db->insert_id();
        return $id;
        
    }

    public function getTrackCov($id='',$status_covid='',$limit='')
    {
            $this->db->select($this->see);
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            
            if ($id != '') {
                $this->db->where('idtc', $id);
            }else if ($status_covid != ''){
                if ($status_covid == 1) {
                    $this->db->where('tc.aktif', 1);
                    $this->db->where('tc.status_covid', 1);
                } else {
                    $this->db->where('tc.aktif', 1);
                    $this->db->where('tc.status_covid', 2);
                }
            }else if($limit != ''){
                $this->db->order_by('idtc', 'desc');
                $this->db->where('tc.aktif', 1);
                $this->db->limit(2);
            }else {
                $this->db->order_by('idtc', 'desc');
                $this->db->where('tc.aktif', 1);
            }

            $ok = $this->db->get('tracking_covid tc');
            return $ok;
    }

    public function graph($get_bulan='',$get_tahun='',$get_date='',$get_direktorat='')
	{
        $tahun = $get_tahun;
        $bulan = $get_bulan;
        $date = $get_date;

        if (!empty($tahun) && !empty($bulan) && !empty($date) && !empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->group_by('j.nma_jabatan');
            $this->db->where('aktif', 1);
            $this->db->where('status_covid', 2);
            $this->db->where('k.jabatan_id',$get_direktorat);            
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        }

        if (!empty($tahun) && !empty($bulan) && !empty($date) && empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->group_by('j.nma_jabatan');
            $this->db->where('aktif', 1);
            $this->db->where('status_covid', 2);          
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && !empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->group_by('j.nma_jabatan');
            $this->db->where('aktif', 1);
            $this->db->where('status_covid', 2);
            $this->db->where('k.jabatan_id',$get_direktorat);
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->group_by('j.nma_jabatan');
            $this->db->where('aktif', 1);
            $this->db->where('status_covid', 2);
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        }

        return $data->result();
	}

    public function totalCov($status_covid,$get_tahun='',$get_bulan='',$get_date='',$get_direktorat='')
    {   
        $tahun = $get_tahun;
        $bulan = $get_bulan;
        $date = $get_date;
        
        // Filter berdasarkan tahun, bulan
        if (!empty($tahun) && !empty($bulan) && empty($date) && empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', $status_covid);
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
            // var_dump("filter berdasarkan tahun, bulan");die;
        }

        // Filter berdasarkan tahun, bulan dan tanggal
        if (!empty($tahun) && !empty($bulan) && !empty($date) && empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', $status_covid);
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
            // var_dump("filter berdasarkan tahun, bulan tanggal");die;
        }

        // Filter berdasarkan tahun, bulan, tanggal dan karyawan
        if (!empty($tahun) && !empty($bulan) && !empty($date) && !empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', $status_covid);
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where('k.jabatan_id',$get_direktorat);            
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
            // var_dump("filter berdasarkan tahun, bulan tanggal dan direktorat");die;
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && !empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', $status_covid);
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where('k.jabatan_id',$get_direktorat);
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
            // var_dump("filter berdasarkan tahun, bulan tanggal dan direktorat");die;
        }

        return $data;
    }

    function totalKaryawan($get_direktorat = '')
    {
        // Filter jika karyawan ada
        if (!empty($get_direktorat)) {
            // $this->db->where('tc.aktif', 1);
            // $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where('k.jabatan_id',$get_direktorat);
            $data = $this->db->get('karyawan k');
        }

        // Filter jika karyawan tidak ada
        if (empty($get_direktorat)) {
            $this->db->select('*');
            $data = $this->db->get('karyawan');
        }

        return $data;
    }

    function totalPositifPerTahun($status_covid, $get_tahun)
    {
        $tahun = $get_tahun;

        $this->db->where('tc.aktif', 1);
        $this->db->where('tc.status_covid', $status_covid);
        $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
        $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
        $data = $this->db->get('tracking_covid tc');

        return $data;
    }

    function totalPerBulan($status_covid, $get_bulan, $get_tahun)
    {
        $tahun = $get_tahun;
        $bulan = $get_bulan;

        $this->db->where('tc.aktif', 1);
        $this->db->where('tc.status_covid', $status_covid);
        $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
        $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
        $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
        $data = $this->db->get('tracking_covid tc');

        return $data;
    }

    function divisiTerbanyak($get_tahun='',$get_bulan='',$get_date='',$get_direktorat='')
    {
        $tahun = $get_tahun;
        $bulan = $get_bulan;
        $date = $get_date;

        if (!empty($tahun) && !empty($bulan) && !empty($date) && !empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', 2);
            $this->db->group_by('j.nma_jabatan');
            $this->db->order_by('Total', 'DESC');
            $this->db->limit(1);
            $this->db->where('k.jabatan_id',$get_direktorat);            
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
            
        }

        if (!empty($tahun) && !empty($bulan) && !empty($date) && empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', 2);
            $this->db->group_by('j.nma_jabatan');
            $this->db->order_by('Total', 'DESC');
            $this->db->limit(1);      
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && !empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', 2);
            $this->db->group_by('j.nma_jabatan');
            $this->db->order_by('Total', 'DESC');
            $this->db->limit(1);
            $this->db->where('k.jabatan_id',$get_direktorat);
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && empty($get_direktorat)) {
            $this->db->select('COUNT(k.jabatan_id) AS Total');
            $this->db->select('j.nma_jabatan');
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');
            $this->db->where('tc.aktif', 1);
            $this->db->where('tc.status_covid', 2);
            $this->db->group_by('j.nma_jabatan');
            $this->db->order_by('Total', 'DESC');
            $this->db->limit(1);
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        
        }
        
        if ($data->num_rows() > 0) {
            return $data->result()[0]->nma_jabatan;
        } else {
            return '-';
        }
        
    }

    function totalTrackCov($get_tahun='',$get_bulan='',$get_date='',$get_direktorat='')
    {
        $tahun = $get_tahun;
        $bulan = $get_bulan;
        $date = $get_date;
        
        if (!empty($tahun) && !empty($bulan) && !empty($date) && empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        }

        if (!empty($tahun) && !empty($bulan) && !empty($date) && !empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where('k.jabatan_id',$get_direktorat);
            $this->db->where("(DAY(tc.ctdUpd)=".$date." OR DAY(tc.ctdDate)=".$date.")");
            $this->db->where("(YEAR(tc.ctdUpd) = ".$tahun." OR YEAR(tc.ctdDate) = ".$tahun.")");
            $this->db->where("(MONTH(tc.ctdUpd)=".$bulan." OR MONTH(tc.ctdDate) =".$bulan.")");
            $data = $this->db->get('tracking_covid tc');
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && !empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');
            $this->db->where('k.jabatan_id',$get_direktorat);            
            $this->db->where('MONTH(tc.ctdDate)',$bulan);
            $this->db->where('YEAR(tc.ctdDate)',$tahun);
            $data = $this->db->get('tracking_covid tc');
        }

        if (!empty($tahun) && !empty($bulan) && empty($date) && empty($get_direktorat)) {
            $this->db->where('tc.aktif', 1);
            
            $this->db->join('karyawan k', 'k.id = tc.karyawan_id', 'left');           
            $this->db->where('MONTH(tc.ctdDate)',$bulan);
            $this->db->where('YEAR(tc.ctdDate)',$tahun);
            $data = $this->db->get('tracking_covid tc');
        }
        
        return $data;
    }

    public function upTrackCov($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('tracking_covid', $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }

    public function inHistoryCov($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert("history_covid", $obj);
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

    public function setStatusCov($s)
    {
        if($s == 2){
            return "Positif";
        }else if($s == 1){
            return "Negatif";
        }
    }

    public function setColorCov($s)
    {
        if($s == 2){
            return "danger";
        }else if($s == 1){
            return "success";
        }
    }

    public function dt_tracking_covid($aktif='1')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'tracking_covid tc';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'k.nama'];
       // Set searchable column fields
       $CI->dt->column_search = ['k.nama'];
       // Set select column fields
       $CI->dt->select = 'tc.idtc as id,k.id as idk,nama,tgl_mulai_sakit,tgl_tes,status_covid';
       // Set default order
       
       $CI->dt->order = ['tc.idtc' => 'desc'];

       if ($aktif != '') {
           $con = ['where','tc.aktif',$aktif];
           array_push($condition,$con);
       }

       $con = ['join','karyawan k','k.id = tc.karyawan_id','left'];
       array_push($condition,$con);

       $con = ['join','jabatan j','j.id = k.jabatan_id','left'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->nama,
               $dt->tgl_mulai_sakit,
               $dt->tgl_tes,
               '<span class="badge badge-pill badge-'.$this->setColorCov($dt->status_covid).'">'.$this->setStatusCov($dt->status_covid).'</span>',
               '<a href="javascript:void(0)" onClick="detail_modal('.$dt->id.')" class="btn btn-info btn-sm">detail</a>',
               '<a href="javascript:void(0)" onClick="edit_modal('.$dt->id.')"><i class="fa fa-edit text-warning mr-2"></i></a>
               <a href="javascript:void(0)" onClick="del_cov('.$dt->id.')"><i class="fa fa-trash text-danger"></i></a>'
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

    public function dt_tracking_covidk($karyawan_id,$aktif='1')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'tracking_covid tc';
       // Set orderable column fields
       $CI->dt->column_order = [null, 'k.nama'];
       // Set searchable column fields
       $CI->dt->column_search = ['k.nama'];
       // Set select column fields
       $CI->dt->select = 'tc.idtc as id,k.id as idk,nama,tgl_mulai_sakit,tgl_tes,status_covid';
       // Set default order
       
       $CI->dt->order = ['tc.idtc' => 'desc'];

       if ($aktif != '') {
           $con = ['where','tc.aktif',$aktif];
           array_push($condition,$con);
       }

       if ($karyawan_id != '') {
        $con = ['where','tc.karyawan_id',$karyawan_id];
        array_push($condition,$con);
    }

       $con = ['join','karyawan k','k.id = tc.karyawan_id','left'];
       array_push($condition,$con);

       $con = ['join','jabatan j','j.id = k.jabatan_id','left'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->nama,
               $dt->tgl_mulai_sakit,
               $dt->tgl_tes,
               '<span class="badge badge-pill badge-'.$this->setColorCov($dt->status_covid).'">'.$this->setStatusCov($dt->status_covid).'</span>',
               '<a href="javascript:void(0)" onClick="detail_modal('.$dt->id.')" class="btn btn-info btn-sm">detail</a>',
               '<a href="javascript:void(0)" onClick="edit_modal('.$dt->id.')"><i class="fa fa-edit text-warning mr-2"></i></a>
               <a href="javascript:void(0)" onClick="del_cov('.$dt->id.')"><i class="fa fa-trash text-danger"></i></a>'
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

    public function dt_histori_covid($tcid)
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'history_covid hc';
       // Set orderable column fields
       $CI->dt->column_order = [null, ''];
       // Set searchable column fields
       $CI->dt->column_search = [''];
       // Set select column fields
       $CI->dt->select = 'hc.idhc as id,pesan,hc.tgl_catatan,hc.file,hc.tes_covid,hc.obat,hc.status_covid';
       // Set default order
       
       $CI->dt->order = ['hc.idhc' => 'desc'];

       if ($tcid != '') {
           $con = ['where','hc.trac_cov_id',$tcid];
           array_push($condition,$con);
       }

       $con = ['join','tracking_covid tc','tc.idtc = hc.trac_cov_id','left'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $dt->tgl_catatan,
               $dt->tes_covid,
               $dt->pesan,
               $dt->obat,
               '<span class="badge badge-pill badge-'.$this->setColorCov($dt->status_covid).'">'.$this->setStatusCov($dt->status_covid).'</span>',
               $dt->file != '' ? '<a href="'.site_url('data/covid/'.$dt->file).'" download="'.$dt->file.'"><i class="fa fa-file text-gray"></i></a>' : ''
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
