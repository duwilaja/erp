<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MMenu','mm');
		$this->load->model('MAbsensi','ma');
		$this->load->model('MKaryawan','mk');
		$this->load->model('Mtes','mt');		
	}
	

	// Dashboard
	public function index()
	{
		$this->load->model('MHcm','mhcm');
		
		$cuti_x = 0;
		$sakit_x = 0;

		$cuti = $this->mhcm->get_jml_pengajuan_arr(['karyawan_id' => $this->session->userdata('karyawan_id'),'jenis' => 'CU','status_pengajuan' => '1']);	
		$sakit = $this->mhcm->get_jml_pengajuan_arr(['karyawan_id' => $this->session->userdata('karyawan_id'),'jenis' => 'SK','status_pengajuan' => '1']);	
		
		if($cuti->num_rows() > 0) $cuti_x = $cuti->row()->jml;
		if($sakit->num_rows() > 0) $sakit_x = $sakit->row()->jml;

		
		// $k_izin = @$this->mk->get($this->session->userdata('karyawan_id'))->row()->k_izin;
		// $k_sakit = @$this->mk->get($this->session->userdata('karyawan_id'))->row()->k_sakit;
		// $k_cuti = @$this->mk->get($this->session->userdata('karyawan_id'))->row()->k_cuti;

		$tanggal = date('m');

		$d = [
			'title' => 'Dashboard',
			'linkView' => 'page/dashboard/dashboard',
			'fileScript' => 'dashboard.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/index'),'active' => 'active']
				]
			],
			'jml_tepat' => $this->db->query("SELECT * FROM `absensi` WHERE status = 'i' AND jam_masuk <= '08:30:00' AND karyawan_id = '".$this->session->userdata('karyawan_id')."' AND MONTH(tanggal) = '".$tanggal."'")->num_rows(),
			'jml_telat' => $this->db->query("SELECT * FROM `absensi` WHERE status = 'i' AND jam_masuk > '08:30:00' AND karyawan_id = '".$this->session->userdata('karyawan_id')."' AND MONTH(tanggal) = '".$tanggal."'")->num_rows(),
			'jam_masuk' => @explode(' ',$this->ma->get('','',"SELECT * FROM `absensi` WHERE karyawan_id = '".$this->session->userdata('karyawan_id')."' AND date(tanggal) = date(now()) AND status = 'I'")->row()->tanggal)[1],
			'jam_keluar' => @explode(' ',$this->ma->get('','',"SELECT * FROM `absensi` WHERE karyawan_id = '".$this->session->userdata('karyawan_id')."' AND date(tanggal) = date(now()) AND status = 'O'")->row()->tanggal)[1],
			'menu' =>  $this->mm,
			'karyawan' =>  $this->mk->getKaryawan($this->session->userdata('karyawan_id'))->row(),
			'sakit' => $sakit_x,
			'cuti' => $cuti_x,
		];

		$this->load->view('_main',$d);

	}

	public function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
    }
	
	// public function dataAbsenJsona()	
	// {
	// 	$data = $this->mt->get_data();
    //     $tepat = array(0,0,0,0,0);
	// 	$telat = array(0,0,0,0,0);
	// 	$bulan = $this->input->get('bulan');
    //     foreach($data as $d){
    //         if($d->karyawan_id == $this->session->userdata('karyawan_id')){ //ganti 3 dengan $idk(id karyawan)
    //             $tgl = explode(" ", $d->tanggal);
    //             $jm = explode(":", $d->jam_masuk);
    //             $jm = ($jm[0]*60) + $jm[1];
                
    //             if(explode("-",$tgl[0])[1] == $bulan){ // ganti 01 dengan $bln
    //                 if($d->status == 'I'){
    //                     $tes = $this->weekOfMonth(strtotime($tgl[0]));
    //                     if($jm <= 510){
    //                         switch ($tes) {
    //                             case 1:
    //                                 $tepat[0]++;
    //                             break;
    //                             case 2:
    //                                 $tepat[1]++;
    //                             break;
    //                             case 3:
    //                                 $tepat[2]++;
    //                             break;
    //                             case 4:
    //                                 $tepat[3]++;
    //                             break;
    //                             case 5:
    //                                 $tepat[4]++;
    //                             break;
    //                             default:
                                
    //                         } 
    //                     }else if($jm > 510){
    //                         switch ($tes) {
    //                             case 1:
    //                                 $telat[0]++;
    //                             break;
    //                             case 2:
    //                                 $telat[1]++;
    //                             break;
    //                             case 3:
    //                                 $telat[2]++;
    //                             break;
    //                             case 4:
    //                                 $telat[3]++;
    //                             break;
    //                             case 5:
    //                                 $telat[4]++;
    //                             break;
    //                             default:
                                
    //                         } 
    //                     }
                        
    //                 }       
    //             }
                
    //         }
	// 	}
		
	// 	// $telat = [];
	// 	// $tepat = [];
	// 	// $minggu = ["Minggu ke 1", "Minggu ke 2", "Minggu ke 3", "Minggu ke 4", "Minggu ke 5" ];
	// 	// $bulan = $this->input->get('bulan');


	// 	// $qTepat = $this->ma->jmlTepatWeekBulan($this->session->userdata('karyawan_id'),$bulan)->result();
	// 	// $qTelat = $this->ma->jmlTelatWeekBulan($this->session->userdata('karyawan_id'),$bulan)->result();

	// 	// foreach ($qTepat as $tp) {
	// 	// 	array_push($tepat,(int) $tp->jml);
	// 	// }

	// 	// foreach ($qTelat as $v) {
	// 	// 	array_push($telat,(int) $v->jml);
	// 	// }

	// 	$densityData = [
	// 		'label' => 'Tepat Waktu',
	// 		'data' => $tepat,
	// 		'backgroundColor' => 'rgba(50, 130, 184, 1)',
	// 		'borderWidth' => 0,
	// 	];
		  
	// 	$gravityData = [
	// 		'label' =>  'Telat',
	// 		'data' => $telat ,
	// 		'backgroundColor' =>  'rgba(253, 94, 83, 1)',
	// 		'borderWidth' =>  0,
	// 	];
		  
	// 	$planetData = [
	// 		'labels' => ["Minggu ke 1", "Minggu ke 2", "Minggu ke 3", "Minggu ke 4", "Minggu ke 5" ],
	// 		'datasets' => [$densityData, $gravityData]
	// 	];

	// 	echo json_encode($planetData);
	// }

	public function dataAbsenJson($bulan='',$tahun='')	
	{
		// $bulan = $this->input->post('bulan');
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');

		$get_tahun = "";
		if ($tahun != "") {
			$get_tahun = $tahun;
		}else{
			$default = explode('-', date("Y-m-d"));
		    $get_tahun = $default[0];
		}

		$get_bulan = "";
		if ($bulan != "") {
			$get_bulan = $bulan;
		}else{
			$default = explode('-', date("Y-m-d"));
		    $get_bulan = $default[1];
		}
		// $data = $this->mt->get_data();
		$dt_tepat = $this->mt->get_absensi_tepat($get_bulan,$get_tahun);
		$dt_telat = $this->mt->get_absensi_telat($get_bulan,$get_tahun);
        $tepat = array(0,0,0,0,0);
		$telat = array(0,0,0,0,0);
		$a_tepat=0;$b_tepat=0;$c_tepat=0;$d_tepat=0;$e_tepat=0;
		$a_telat=0;$b_telat=0;$c_telat=0;$d_telat=0;$e_telat=0;
		foreach ($dt_tepat->result() as $value) {
				if ($value->minggu ==  1) {
					$a_tepat = $value->tepat;
				}
				if ($value->minggu ==  2) {
					$b_tepat = $value->tepat;
				}
				if ($value->minggu ==  3) {
					$c_tepat = $value->tepat;
				}
				if ($value->minggu ==  4) {
					$d_tepat = $value->tepat;
				}
				if ($value->minggu ==  5) {
					$e_tepat = $value->tepat;
				}
				$tepat = array($a_tepat,$b_tepat,$c_tepat,$d_tepat,$e_tepat);
				
		}
		foreach ($dt_telat->result() as $value) {
			if ($value->minggu ==  1) {
				$a_telat = $value->telat;
			}
			if ($value->minggu ==  2) {
				$b_telat = $value->telat;
			}
			if ($value->minggu ==  3) {
				$c_telat = $value->telat;
			}
			if ($value->minggu ==  4) {
				$d_telat = $value->telat;
			}
			if ($value->minggu ==  5) {
				$e_telat = $value->telat;
			}
			$telat = array($a_telat,$b_telat,$c_telat,$d_telat,$e_telat);
			
	}

	
		$densityData = [
			'label' => 'Tepat Waktu',
			'data' => $tepat,
			'backgroundColor' => 'rgba(50, 130, 184, 1)',
			'borderWidth' => 0,
		];
		  
		$gravityData = [
			'label' =>  'Telat',
			'data' => $telat ,
			'backgroundColor' =>  'rgba(253, 94, 83, 1)',
			'borderWidth' =>  0,
		];
		  
		$planetData = [
			'labels' => ["Minggu ke 1", "Minggu ke 2", "Minggu ke 3", "Minggu ke 4", "Minggu ke 5" ],
			'datasets' => [$densityData, $gravityData]
		];

		echo json_encode($planetData);
	}

	
    
}
