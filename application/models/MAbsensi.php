<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAbsensi extends CI_Model {
    
    private $t = 'absensi';
    public $see = '*';
    private $id = 'id';
    public $jam_telat = '';
    
    public function __construct()
    {
        parent::__construct();
        $this->jam_telat = $this->db->get('setting_absen')->last_row()->jam_telat;
    }
    
    public function getDetail($id){
        return $this->db->query("select a.*,DATE_FORMAT(DATE_ADD(a.start_date,INTERVAL 7 HOUR),'%Y-%m-%d %H:%i') tgl_masuk,DATE_FORMAT(DATE_ADD(a.end_date,INTERVAL 7 HOUR),'%Y-%m-%d %H:%i') tgl_keluar,DATE_FORMAT(DATE_ADD(a.start_office_date,INTERVAL 7 HOUR),'%H:%i') office_masuk,DATE_FORMAT(DATE_ADD(a.end_office_date,INTERVAL 7 HOUR),'%H:%i') office_keluar from absensi a_erp left join absensis a on a_erp.absensis_id=a.id");
    }
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
    
    public function dtAbsensi($status='',$date='',$parent=0,$tgl_mulai='',$tgl_akhir='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = $this->t.' ab';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'k.nip','k.nama','jam_masuk','jam_keluar','tanggal'];
        // Set searchable column fields
        $CI->dt->column_search = ['k.nip','k.nama','jam_masuk','jam_keluar','tanggal'];
        // Set select column fields
        $CI->dt->select = 'ab.id,k.nip,k.nama,jam_masuk,ab.status,jam_keluar,tanggal,absensis_id';
        // Set default order
        $CI->dt->order = ['date(ab.tanggal),jam_masuk' => 'desc'];
        
        $con = ['join','karyawan k','k.id = ab.karyawan_id','inner'];
        array_push($condition,$con);
        
        $con2 = ['where','ab.aktif',1];
        array_push($condition,$con2);

        if ($status != '') {
            // if ($status == 'TL') {
            //     $con1 = ['where','ab.status','i'];
            //     array_push($condition,$con1);
        
            //     $con2 = ['where','ab.tanggal >',date('Y-m-d').' 08:30:00'];
            //     array_push($condition,$con2);
            // }else{
                $con1 = ['where','ab.status',$status];
                array_push($condition,$con1);
            // }
        }
        

        if ($date != '') {
            $con4 = ['where','date(ab.tanggal)',$date];
            array_push($condition,$con4);
        }

        if ($tgl_mulai != '' && $tgl_akhir != '') {
            $con4 = ['where','date(ab.tanggal) >=',$tgl_mulai];
            array_push($condition,$con4);

            $con4 = ['where','date(ab.tanggal) <=',$tgl_akhir];
            array_push($condition,$con4);
        }else if($tgl_mulai != ''){
            $con4 = ['where','date(ab.tanggal) =',$tgl_mulai];
            array_push($condition,$con4);
        }

        
        if ($this->session->userdata('level') != '1') {
            $con2 = ['where','ab.karyawan_id',$this->session->userdata('karyawan_id')];
            array_push($condition,$con2);
        }

       
        
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
         

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $d = '';
            if($dt->absensis_id){
                $d = '<a  class="text-warning" href="'.site_url('absensi/detail_data/').$dt->id.'"><i class="fa fa-list"></i></a>';
            }
            $i++;
            $data[] = array(
                $i,
                $dt->nip,
                $dt->nama,
                $this->setStatus($dt->status),
                $this->setJam($dt->tanggal,$dt->status),
                $this->bantuan->tgl_indo($dt->tanggal),
                $d
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

    public function dtAbsensiAll($status='',$karyawan='',$date='',$parent=0,$tgl_mulai='',$tgl_akhir='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'absensi ab';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'k.nip','k.nama','jam_masuk','jam_keluar','tanggal'];
        // Set searchable column fields
        $CI->dt->column_search = ['k.nip','k.nama','jam_masuk','jam_keluar','tanggal'];
        // Set select column fields
        $CI->dt->select = 'ab.id,k.nip,k.nama,jam_masuk,ab.status,jam_keluar,tanggal';
        // Set default order
        $CI->dt->order = ['date(ab.tanggal),jam_masuk' => 'desc'];
        
        $con = ['join','karyawan k','k.id = ab.karyawan_id','inner'];
        array_push($condition,$con);

        if ($parent==1) {
            $con5 = ['join','jabatan j','j.id = k.jabatan_id','inner'];
            array_push($condition,$con5);
    
            $k = $this->db->get_where('karyawan k',['id' => $this->session->userdata('karyawan_id')])->row();
            
            $con7 = ['where','j.parent_id',$this->session->userdata('level')];
            array_push($condition,$con7);
        }

        $con3 = ['where','ab.aktif',1];
        array_push($condition,$con3);
        
        // if ($date != '') {
        //     $con4 = ['where','date(ab.tanggal)',$date];
        //     array_push($condition,$con4);
        // }

        if ($tgl_mulai != '' && $tgl_akhir != '') {
            $con4 = ['where','date(ab.tanggal) >=',$tgl_mulai];
            array_push($condition,$con4);

            $con4 = ['where','date(ab.tanggal) <=',$tgl_akhir];
            array_push($condition,$con4);
        }else if($tgl_mulai != ''){
            $con4 = ['where','date(ab.tanggal) =',$tgl_mulai];
            array_push($condition,$con4);
        }


        if ($status != '') {
            $con1 = ['where','ab.status',$status];
            array_push($condition,$con1);
        }

        if (@$karyawan != '') {
            $con1 = ['where','ab.karyawan_id',$karyawan];
            array_push($condition,$con1);
        }
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nip,
                $dt->nama,
                $this->setStatus($dt->status),
                $this->setJam($dt->tanggal,$dt->status),
                $this->bantuan->tgl_indo($dt->tanggal),
                '<a  class="text-warning" href="'.site_url('absensi/detail_data/').$dt->id.'"><i class="fa fa-list"></i></a>',
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

    public function dtAbsensiReport($jenis='',$val='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'absensi ab';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'k.nip','k.nama'];
        // Set searchable column fields
        $CI->dt->column_search = ['k.nama','k.nip'];
        // Set select column fields
        $CI->dt->select = 'ab.id,k.nip,ab.karyawan_id,k.nama,ab.status,tanggal';
        // Set default order
        $CI->dt->order = ['date(ab.tanggal)' => 'desc'];
        
        $con = ['join','karyawan k','k.id = ab.karyawan_id','inner'];
        array_push($condition,$con);
        
        $con1 = ['where','ab.aktif','1'];
        array_push($condition,$con1);

        if ($jenis == 'bulan') {
            $con2 = ['where','month(ab.tanggal)',$val];
            array_push($condition,$con2);

            $rt = $this->db->query("SELECT `ab`.`id`, `k`.`nip`, `ab`.`karyawan_id`, `k`.`nama`, `ab`.`status`, `tanggal` FROM `absensi` `ab` INNER JOIN `karyawan` `k` ON `k`.`id` = `ab`.`karyawan_id` WHERE `ab`.`aktif` = '1' AND month(ab.tanggal) = '".$val."' GROUP BY `karyawan_id` ORDER BY date(ab.tanggal)")->num_rows();

        }else if($jenis == 'tahun'){
            $con2 = ['where','year(ab.tanggal)',$val];
            array_push($condition,$con2);

            $rt = $this->db->query("SELECT `ab`.`id`, `k`.`nip`, `ab`.`karyawan_id`, `k`.`nama`, `ab`.`status`, `tanggal` FROM `absensi` `ab` INNER JOIN `karyawan` `k` ON `k`.`id` = `ab`.`karyawan_id` WHERE `ab`.`aktif` = '1' AND year(ab.tanggal) = '".$val."' GROUP BY `karyawan_id` ORDER BY date(ab.tanggal)")->num_rows();
        }
     
        $this->db->group_by('karyawan_id');
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;

            if ($jenis == 'bulan') {
                $detail = '<a href="'.site_url('absensi/detail_rekap_bulanan/'.$dt->karyawan_id).'" class="btn btn-outline-danger">Detail</a>';
                $data[] = array(
                    $i,
                    $dt->nip,
                    $dt->nama,
                    $this->jmlMaAbKaBulan($dt->karyawan_id,$val),
                    $this->jmlMaCuKaBulan($dt->karyawan_id,$val),
                    $this->jmlMaIzKaBulan($dt->karyawan_id,$val),
                    $this->jmlMaSkKaBulan($dt->karyawan_id,$val),
                    $this->jmlMaTelatKaBulan($dt->karyawan_id,$val),
                    $detail
                );

            }else if ($jenis == 'tahun') {
                $detail = '<a href="'.site_url('absensi/detail_rekap_tahunan/'.$dt->karyawan_id).'" class="btn btn-outline-danger">Detail</a>';
                $data[] = array(
                    $i,
                    $dt->nip,
                    $dt->nama,
                    $this->jmlMaAbKaTahun($dt->karyawan_id,$val),
                    $this->jmlMaCuKaTahun($dt->karyawan_id,$val),
                    $this->jmlMaIzKaTahun($dt->karyawan_id,$val),
                    $this->jmlMaSkKaTahun($dt->karyawan_id,$val),
                    $this->jmlMaTelatKaTahun($dt->karyawan_id,$val),
                    $detail
                );

            }
        }
    

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => @$rt,
            "recordsFiltered" => $rt,
            "data" => $data,
        );
        
        // Output to JSON format
        return json_encode($output);
    }
    
    public function  requestPengajuan($nama='')
    {
        $CI = &get_instance();
        $CI->load->model('MKaryawan', 'mk');
        $CI->load->model('MNotif', 'n');

        $hrd = $CI->mk->get('',['jabatan_id' => '71'])->row()->id;
        $kary = $this->mk->get($nama)->row()->nama;
        $leader_id = $this->mk->get_kary_n_parent($nama)['leader_id'];

        $lama_cuti = '';
        $absen = [];
        $obj = [];

        $type = $this->input->post('type');
        $start_date = $this->input->post('tgl_mulai');
        $end_date = $this->input->post('tgl_akhir');
        $keterangan = $this->input->post('alasan');
        $absen_data = [];
        $karyawan = '';

        $jam_mulai = $this->input->post('waktu_mulai');
        if ($jam_mulai == '') {
            $jam_mulai = '';
        }

        $jam_selesai = $this->input->post('waktu_selesai');
        if ($jam_selesai == '') {
            $jam_selesai = '';
        }

        $this->mk->see = "k_sakit,k_izin,k_cuti";
        $karyawan = $this->mk->get($nama)->row();

        $tm = strtotime($this->input->post('tgl_mulai'));
        $ta = strtotime($this->input->post('tgl_akhir'));

        // Tanggal akhir harus lebih dari tanggal mulai
        if ($ta < $tm)  {
            $this->session->set_flashdata('error', 'Maaf gk bisa lanjut nih, Tanggal Akhir tidak boleh kurang dari tanggal mulai ya');
            redirect($_SERVER['HTTP_REFERER']);
        } 

        // Bro gk boleh ngajuan cuti lebih dari 5 kali dalam 1 bulan
        
        // Jatah cuti lu udah abis bro di tahun ini

        
        $timeDiff = abs($tm - $ta);
        
        $numberDays = $timeDiff/86400;  // 86400 seconds in one day
        
        // and you might want to convert to integer
        $numberDays = intval($numberDays);
        $lama_cuti = $numberDays + 1;

        $tglArray = $this->bantuan->hjt($this->input->post('tgl_akhir'),$this->input->post('tgl_mulai'));

        $jk_sakit = ($karyawan->k_sakit - count($tglArray));
        $jk_izin = ($karyawan->k_izin - count($tglArray));
        $jk_cuti = ($karyawan->k_cuti - count($tglArray));
        
            $pengajuan = [
                'tgl_pengajuan' => date('Y-m-d H:i:s'),
                'tgl_mulai' => date($this->input->post('tgl_mulai')),
                'tgl_akhir' => date($this->input->post('tgl_akhir')),
                'waktu_mulai' => $this->input->post('waktu_mulai'),
                'waktu_akhir' => $this->input->post('waktu_selesai'),
                'lama' => @$lama_cuti,
                'status_pengajuan' => 0,
                'jenis' => $this->input->post('type'),
                'alasan' => $this->input->post('alasan'),
                'karyawan_id' => $nama
            ];
            
            $in = $this->db->insert('pengajuan', $pengajuan);
            $idp = $this->db->insert_id();
            
            if ($in) {

                if ($type != 'L') {

                    foreach ($tglArray as $tgl) { 
                        $absen_data = [
                            'karyawan_id' => $nama,
                            'nama' => $this->mk->get($nama)->row()->nama,
                            'status' => $this->input->post('type'),
                            'jam_masuk' => $jam_mulai,
                            'jam_keluar' => $jam_selesai,
                            'aktif' => 0,
                            'pengajuan_id' => $idp,
                            'tanggal' => date($tgl)
                        ];  
                        
                        array_push($absen,$absen_data);
                    }

                }

                if ($this->input->post('type') == 'SK') {
                    $error = '';
                    $bukti = '';
                    $obj = [
                        'k_sakit' => ($karyawan->k_sakit - count($absen))
                    ];

                    $config['upload_path']          ='./data/bukti_sakit/';
                    $config['allowed_types']        = 'pdf|jpg|png|docx|xlsx';
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;
    
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('bukti'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                        $bukti = $this->upload->data()['file_name'];
                    }

                    $this->db->insert('peng_sakit',[
                        'created_date'   => date('Y-m-d'),
                        'karyawan_id'    => $nama,
                        'keterangan'     => $keterangan,
                        'bukti'          => $bukti,
                        'peng_id'        => $idp,
                    ]);
                   
                    $CI->n->inNotif(
                        'Pengajuan - Sakit',
                        $nama,
                        $hrd,
                        $kary.' telah mengajukan izin sakit',
                        'Hcm/list_izin_cuti'
                    );
                    
                    $CI->n->inNotif(
                        'Pengajuan - Sakit',
                        $nama,
                        $leader_id,
                        $kary.' telah mengajukan izin sakit',
                        'Hcm/list_izin_cuti'
                    );
                    
                }else if($this->input->post('type') == 'L') {
                    
                    $this->db->insert('peng_lembur',[
                        'karyawan_id'    => $nama,
                        'start_date'     => $start_date,
                        'end_date'       => $end_date,
                        'start_time'     => $jam_mulai,
                        'end_time'       => $jam_selesai,
                        'project_id'     => $this->input->post('projek'),
                        'keterangan'     => $keterangan,
                        'peng_id'        => $idp,
                    ]);

                }else if($this->input->post('type') == 'PD') {
                    
                    foreach ($this->input->post('karyawan') as $v) {
                        $karyawan .= $v.',';
                    }

                    $this->db->insert('peng_pd',[
                        'karyawan_obj'   => rtrim($karyawan, ","),
                        'start_date'     => $start_date,
                        'end_date'       => $end_date,
                        'keterangan'     => $keterangan,
                        'created_date'   => date('Y-m-d'),
                        'leader_id'      => $nama,
                        'peng_id'        => $idp,
                    ]);

                }else if($this->input->post('type') == 'CU') {
                    
                    $obj = [
                        'k_cuti' => ($karyawan->k_cuti - count($absen))
                    ];

                    $this->db->insert('peng_cuti',[
                        'created_date'   => date('Y-m-d'),
                        'karyawan_id'    => $nama,
                        'start_date'     => $start_date,
                        'end_date'       => $end_date,
                        'keterangan'     => $keterangan,
                        'peng_id'        => $idp,
                    ]);
                    
                    // Notifikasi ke HCM
                    $CI->n->inNotif(
                        'Pengajuan - Cuti',
                        $nama,
                        $hrd,
                        $kary.' telah mengajukan cuti',
                        'Hcm/list_izin_cuti?id='.base64_encode($idp.'|'.date('h:i:s'))
                    );

                    // Notifikasi ke Leader
                    $CI->n->inNotif(
                        'Pengajuan - Cuti',
                        $nama,
                        $leader_id,
                        $kary.' telah mengajukan cuti',
                        'Hcm/list_izin_cuti?id='.base64_encode($idp.'|'.date('h:i:s'))
                    );
                }

                if (count($obj) != 0) {
                    $this->mk->up($obj,['id' => $nama]);
                }

                if (count($absen) != 0) {
                   $this->db->insert_batch('absensi', $absen);
                }

                $this->session->set_flashdata('success', 'Berhasil mengirim pengajuan');
            }else{
                $this->session->set_flashdata('error', 'Gagal mengirim pengajuan');
            }

        redirect($_SERVER['HTTP_REFERER']);

    }

    // Fungsi ini untuk karyawan/leader/yang bersangkutan menerima pengajuan karyawan
    public function inHPeng($approve='',$peng_id='',$tahap='')
    {
        $alasan = '';

        if ($peng_id != '') {

            if ($approve  != 1) {
                $approve = $this->input->post('alasan');
            }
            
            $object = [
                'peng_id' => $peng_id,
                'tahap' => $tahap,
                'approve' => $approve,
                'alasan' => $alasan,
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
        $s = 'Tidak Diketahui';
        if ($status != '') {
            if ($status == "I") {
                $s = "<span class='lbl lbl-success'>Masuk</span>";
            }else if($status == "O" || $status == "0" || $status == "o"){
                $s = "<span class='lbl lbl-warning'>Pulang</span>";
            }else if ($status == "IZ") {
                $s = "Izin";
            }else if ($status == "CU") {
                $s = "Cuti";
            }else if ($status == "SK") {
                $s = "Sakit";
            }else if ($status == "PD") {
                $s = "Perjalanan Dinas";
            }else if ($status == "L") {
                $s = "Lembur";
            }else if ($status == "TL") {
                $s = "<span class='lbl lbl-danger'>Terlambat</span>";
            }
            
           return $s; 
        }
    }
    

    private function setJam($tanggal='',$status='')
    {
        $s = 'Tidak Diketahui';
        $j = explode(' ',$tanggal);

        if ($status != '') {
           if($status != "I" && $status != "O" && $status != "o" && $status != "0" && $status != "TL"){
                $s = '-';
            }else{
                $s = $j[1];
            }
           return $s; 
        }
    }

    
    public function jmlMaAbKaBulan($id='',$b='')    
    {
        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'i' AND month(tanggal) = ".$month." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaCuKaBulan($id='',$b='')
    {
        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }
        
        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'CU' AND month(tanggal) = ".$month." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaIzKaBulan($id='',$b='')
    {

        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }
        
        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'IZ' AND month(tanggal) = ".$month." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaSkKaBulan($id='',$b='')
    {
        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'SK' AND month(tanggal) = ".$month." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaTelatKaBulan($id='',$b='')
    {
        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'TL' AND month(tanggal) = ".$month." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaTelatKaWeekBulan($id='',$b='')
    {
        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }

        $data = 0;

        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'i'  AND month(tanggal) = ".$month." AND jam_masuk > '08:30:00' AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlTelatWeekBulan($id='',$b='')
    {
        if ($b != '') {
            $month = $b;
        }else{
            $month = 'month(date(now()))';
        }

        $data = 0;

        if ($id != '') {
            $data = $this->db->query("SELECT count(id) as jml,week(tanggal) as minggu FROM `absensi` WHERE  month(tanggal) = ".$month." AND  jam_masuk > '08:30:00' AND status = 'I' AND karyawan_id = '".$id."' group by WEEK(tanggal)");
        } 
 
        return $data;
    } 
 
    public function jmlTepatWeekBulan($id='',$b='') 
    { 
        if ($b != '') { 
            $month = $b; 
        }else{ 
            $month = 'month(date(now()))'; 
        } 
 
        $data = 0; 
 
        if ($id != '') { 
            $data = $this->db->query("SELECT count(id) as jml,week(tanggal) as minggu FROM `absensi` WHERE  month(tanggal) = ".$month." AND  jam_masuk <= '08:30:00' AND status = 'I' AND karyawan_id = '".$id."' group by WEEK(tanggal)");
        }

        return $data;
    }

    // Tahun

    public function jmlMaAbKaTahun($id='',$b='')
    {
        if ($b != '') { 
            $tahun = $b; 
        }else{ 
            $tahun = 'year(date(now()))'; 
        } 

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'i' AND year(tanggal) = ".$tahun." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaCuKaTahun($id='',$b='')
    {
        if ($b != '') { 
            $tahun = $b; 
        }else{ 
            $tahun = 'year(date(now()))'; 
        } 

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'CU' AND year(tanggal) = ".$tahun."  AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaIzKaTahun($id='',$b='')
    {
        if ($b != '') { 
            $tahun = $b; 
        }else{ 
            $tahun = 'year(date(now()))'; 
        } 

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'IZ' AND year(tanggal) = ".$tahun."  AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }

    public function jmlMaSkKaTahun($id='',$b='')
    {
        if ($b != '') { 
            $tahun = $b; 
        }else{ 
            $tahun = 'year(date(now()))'; 
        } 

        $data = 0;
        if ($id != '') {
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'SK' AND year(tanggal) = ".$tahun."  AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }
    
    public function jmlMaTelatKaTahun($id='',$b='')
    {
        if ($b != '') { 
            $tahun = $b; 
        }else{ 
            $tahun = 'year(date(now()))'; 
        } 

        $data = 0;
        if ($id != '') {
            // $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'i' AND jam_masuk > '".$this->jam_telat."' AND year(tanggal) = ".$tahun."  AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
            $data = $this->db->query("SELECT * FROM `absensi` WHERE aktif = 1 AND status = 'TL' AND year(tanggal) = ".$tahun." AND karyawan_id = ".$id." GROUP BY date(tanggal)")->num_rows();
        }

        return $data;
    }


    public function setTepat()
	{
		$t = $this->db->query('SELECT *,date(tanggal) as tgl FROM absensi WHERE jam_masuk <= "'.$this->jam_telat.'"');
		if ($t->num_rows() > 0) {
			foreach ($t->result() as $v) {
				$this->db->update('absensi',['status' => 'i'],['karyawan_id' => $v->karyawan_id,'jam_masuk <' =>  $this->jam_telat]);
			}	
		}

		return true;
	}

	public function setTelat()
	{
		$t = $this->db->query('SELECT *,date(tanggal) as tgl FROM absensi WHERE status = "i" AND (jam_masuk > "'.$this->jam_telat.'" AND jam_masuk < "10:40:00")');
		if ($t->num_rows() > 0) {
			foreach ($t->result() as $v) {
				$this->db->update('absensi',['status' => 'TL'],['karyawan_id' => $v->karyawan_id,'status' => 'i','jam_masuk >' =>  $this->jam_telat,'jam_masuk < ' => "10:40:00"]);
			}	
		}
		return true;
    }
    

	public function setKeluar()
	{
		$t = $this->db->query('SELECT *,date(tanggal) as tgl FROM absensi WHERE (status = "i" || status = "TL") AND jam_masuk > "17:00:00"');
		if ($t->num_rows() > 0) {
			foreach ($t->result() as $v) {
				$this->db->update('absensi',['status' => 'O'],['karyawan_id' => $v->karyawan_id,'jam_masuk >' => "17:00:00"]);
			}	
		}

		return true;
    }

    public function setKeluarTL()
	{
		$t = $this->db->query('SELECT *,date(tanggal) as tgl FROM absensi WHERE status = "TL" AND jam_masuk > "17:00:00"');
		if ($t->num_rows() > 0) {
			foreach ($t->result() as $v) {
				$this->db->update('absensi',['status' => 'O'],['karyawan_id' => $v->karyawan_id,'status' => 'TL','jam_masuk >' => "17:00:00"]);
			}	
		}

		return true;
    }

    // Absen Online

    public function dt_absen_online_personal($karyawan_id='')
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'absen_online ab';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'ab.tanggal','jam_masuk','bukti','jam_keluar'];
        // Set searchable column fields
        $CI->dt->column_search = ['ab.tanggal','jam_masuk','bukti','jam_keluar'];
        // Set select column fields
        $CI->dt->select = 'ab.tanggal,jam_masuk,jam_keluar,bukti';
        // Set default order
        $CI->dt->order = ['tanggal' => 'desc'];
        
        // $con = ['join','karyawan k','k.id = ab.karyawan_id','inner'];
        // array_push($condition,$con);

        
        // if ($date != '') {
        //     $con4 = ['where','date(ab.tanggal)',$date];
        //     array_push($condition,$con4);
        // }


        // if ($status != '') {
        //     $con1 = ['where','ab.status',$status];
        //     array_push($condition,$con1);
        // }

            $con1 = ['where','ab.karyawan_id',$karyawan_id];
            array_push($condition,$con1);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $data[] = array(
                $this->bantuan->tgl_indo($dt->tanggal),
                $dt->jam_masuk,
                '<a href="'.base_url('data/absen_online/'.$dt->bukti).'">Lihat Bukti</a>',
                $dt->jam_keluar,
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

    // Pengaturan Absensi

    public function dt_pengaturan_absensi()
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'absensi_jadwal aj';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'aj.tgl_mulai','tgl_akhir','jam_telat'];
        // Set searchable column fields
        $CI->dt->column_search = ['aj.tgl_mulai','tgl_akhir','jam_telat'];
        // Set select column fields
        $CI->dt->select = 'id,tgl_mulai,tgl_akhir,jam_telat,ctddate';
        // Set default order
        $CI->dt->order = ['id' => 'desc'];
        
            // $con1 = ['where','ab.karyawan_id',$karyawan_id];
            // array_push($condition,$con1);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows(@$_POST, $condition);

        $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $data[] = array(
                $this->bantuan->tgl_indo($dt->tgl_mulai),
                $this->bantuan->tgl_indo($dt->tgl_akhir),
                $dt->jam_telat,
                '<a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_edit" onclick="getPengat('.$dt->id.')"><i class="fa fa-edit"></i> </a>
                <a href="#" class="btn btn-sm btn-default" id="btn-singkroniasi" onclick="singkronisasi('.$dt->id.')"> <i class="fa fa-sync"></i></a>
                <button class="btn btn-primary" id="btn-loading'.$dt->id.'"  style="display:none;" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="sr-only">Loading...</span>
</button>',
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

    public function get_pengaturan_absensi($id='')
	{
		if ($id != '') $this->db->where('id', $id);
		$q = $this->db->get('absensi_jadwal');
		return $q;
    }
    
    public function in_pengaturan_absensi($data='')
	{
		$s = false;
		if($data != ''){
			$this->db->insert('absensi_jadwal', $data);
			$x = $this->db->affected_rows();
			if($x > 0){
				$s = true;
			}
		}
		return $s;
	}

    public function up_pengaturan_absensi($data='',$where='')
	{
		$s = false;
		if($data != '' && $where != ''){
			$this->db->update('absensi_jadwal', $data,$where);
			$x = $this->db->affected_rows();
			if($x > 0){
				$s = true;
			}
		}
		return $s;
	}
    
    public function singkornisasi_absen($id='')
	{
        $s = false;
        $c = 0;

		if($id != ''){
			$p = $this->get_pengaturan_absensi($id)->row();
        }else{
			$p = $this->get_pengaturan_absensi()->last_row();
        }

        // Telat
        $this->db->update('absensi', ['status' => 'TL'],['status !=' => 'O','DATE(tanggal) >= ' => $p->tgl_mulai,'DATE(tanggal) <=' => $p->tgl_akhir,'jam_masuk > ' => $p->jam_telat,'jam_masuk < ' => '12:00:00']);
        
        // // Jam Keluar
        // $this->db->update('absensi', ['status' => 'O'],['DATE(tanggal) >= ' => $p->tgl_mulai,'DATE(tanggal) <=' => $p->tgl_akhir,'jam_masuk > ' => '17:00:00','jam_masuk <' => '01:00:00','status' => 'i']);
        
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $s = true;
        }
        
		return [$s,$c];
	}
    
}