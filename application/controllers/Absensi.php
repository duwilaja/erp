<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends MY_controller {
	
	
public function __construct()
{
	parent::__construct();
	$this->load->model('MAbsensi','ma');
	$this->load->model('MKaryawan','mk');
	$this->ma->singkornisasi_absen();
	// $this->ma->setTepat();
	$this->ma->setKeluar();

}

public function absen_online()
{
	$d = [
		'title' => 'Absensi Online',
		'linkView' => 'page/absensi/absensi_online',
		'fileScript' => 'absensi/absen_online.js',
		'bread' => [
			'nama' => '',
			'data' => [
				['nama' => '','link' => '','active' => ''],
			]
		]
	];
	$this->load->view('_main',$d);
}

public function inAbsenOnline()
{
	$id = $this->input->post('id');
	$opsi = $this->input->post('opsi');
	$jam_absen = date('H:m:s');

    $this->load->library('upload');
	
	$err = '';
    $file = '';
    $s = false;
	$msg = 'Gagal melakukan absen';
	$r = 0;

    $config['upload_path']          = 'data/absen_online/';
    $config['allowed_types']        = 'jpg|png|jpeg';
    $config['max_size']             = 0;
    $config['max_width']            = 0;
    $config['max_height']           = 0;

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('bukti')){
        $err = $this->upload->display_errors();
    }else{
        $file = $this->upload->data()['file_name'];
    }

	$cek = $this->db->get_where('absen_online', ['tanggal' => date('Y-m-d'),'karyawan_id' => $id]);
	if ($opsi == 'I') {
		if ($cek->num_rows() == 0) {
			if ($file != '') {
				// Jam Masuk
				$absen = [
					'karyawan_id' => $id,
					'status' => $opsi,
					'bukti' => $file,
					'jam_masuk' => $jam_absen,
					'tanggal' => date('Y-m-d'),	
					'ctdupd' => date('Y-m-d H:i:s'),	

				];

				$this->db->insert('absen_online', $absen);
				$r = $this->db->affected_rows();
				if ($r > 0 ) {
					$msg = 'Berhasil melakukan absen masuk';
					$s = true;	
				} 

			}else{
				$msg = 'Anda harus mengupload foto bukti absen';
			}
		}else{
			$msg = 'Anda sudah melakukan absen masuk hari ini';
		}
		
	}else if($opsi == 'O'){
		if ($cek->num_rows() == 0) {
		// Jam Pulang
		$absen = [
			'karyawan_id' => $id,
			'status' => $opsi,
			'jam_keluar' => $jam_absen,
			'tanggal' => date('Y-m-d'),	
			'ctdupd' => date('Y-m-d H:i:s'),	
		];

		$this->db->update('absen_online', $absen,['tanggal' => date('Y-m-d'),'karyawan_id' => $id]);
		$r = $this->db->affected_rows();
		if ($r > 0 ) {
			$msg = 'Berhasil melakukan absen pulang';
			$s = true;	
		} 
		}else{
			$msg = 'Anda sudah melakukan absen pulang hari ini';
		}
	}

	$resp = [
		'msg' => $msg,
		'err' => $err,
		'status' => $s
	];
	
	echo json_encode($resp);
	
}

public function dt_absen_online_personal()
{
	echo $this->ma->dt_absen_online_personal($this->session->userdata('karyawan_id'));
}

public function hitungJam($date='')
	{
		$jam = explode(' ',$date);
		$jam1 = explode(':',$jam[1]);

		$jamToAngka = $jam1[0]*60;

		return ($jamToAngka + $jam1[1]); 
	}
	
public function index()
{
	$d = [
		'title' => 'Daftar Absensi',
		'linkView' => 'page/absensi/absensi',
		'fileScript' => 'absensi.js',
		'bread' => [
			'nama' => 'Absensi',
			'data' => [
				['nama' => '','link' => site_url('main/finance'),'active' => ''],
			]
		]
	];
	$this->load->view('_main',$d);
}


public function absensiAll()
{
	$d = [
		'title' => 'List Attendance Employess',
		'linkView' => 'page/absensi/absensi',
		'fileScript' => 'absensiAll.js',
		'bread' => [
			'nama' => 'List Attendance Employess ',
			'data' => [
				['nama' => 'List Attendance','link' => '','active' => ''],
			]
			],
		'karyawan' => $this->mk->get()->result()
	];
	
	$this->load->view('_main',$d);
}

public function absenceMember()
{
	$d = [
		'title' => 'List Absence Member',
		'linkView' => 'page/absensi/absensi',
		'fileScript' => 'absenceMember.js',
		'bread' => [
			'nama' => 'List Absence Member',
			'data' => [
				['nama' => 'List Absence Member','link' => '','active' => ''],
			]
		],
		'karyawan' => $this->mk->get()->result()
	];
	
	$this->load->view('_main',$d);
}

public function dtAbsensi()
{
	$s = $this->input->post('s');
	$d = $this->input->post('d');
	$tgl_mulai = $this->input->post('tgl_mulai');
	$tgl_akhir = $this->input->post('tgl_akhir');

	echo $this->ma->dtAbsensi($s,$d,'',$tgl_mulai,$tgl_akhir);
}

public function dtAbsenLeader()
{
	$s = $this->input->post('s');
	$k = $this->input->post('k');
	$d = $this->input->post('d');
	$tgl_mulai = $this->input->post('tgl_mulai');
	$tgl_akhir = $this->input->post('tgl_akhir');

	echo $this->ma->dtAbsensiAll($s,$k,$d,1,$tgl_mulai,$tgl_akhir);
}

public function dtAbsensiBulan($val='')
{
	$val = $this->input->post('bulan');
	echo $this->ma->dtAbsensiReport('bulan',$val);
}

public function dtAbsensiTahun($val='')
{
	$val = $this->input->post('tahun');
	echo $this->ma->dtAbsensiReport('tahun',$val);
}

public function dtAbsensiAll()
{
	$s = $this->input->post('s');
	$k = $this->input->post('k');
	$d = $this->input->post('d');
	$tgl_mulai = $this->input->post('tgl_mulai');
	$tgl_akhir = $this->input->post('tgl_akhir');

	echo $this->ma->dtAbsensiAll($s,$k,'','',$tgl_mulai,$tgl_akhir);
}

public function rekap_bulanan()
{
	$d = [
		'title' => 'Report',
		'linkView' => 'page/absensi/rekap_bulanan',
		'fileScript' => 'absensi.js',
		'bread' => [
			'nama' => 'Report',
			'data' => [
				['nama' => 'Daftar Absen','link' => site_url('main/finance'),'active' => ''],
			]
		]
	];
	$this->load->view('_main',$d);
}

public function detail_rekap_bulanan()
{
	$d = [
		'title' => 'Detail Rekap Bulanan',
		'linkView' => 'page/absensi/detail_rekap_bulanan',
		'fileScript' => 'absensi.js',
		'bread' => [
			'nama' => 'Report',
			'data' => [
				['nama' => '','link' => '#','active' => ''],
			]
		]
	];
	$this->load->view('_main',$d);
}

public function dtAbsensiBulanan()
{
	$bulan = $this->input->post('m');
	echo $this->ma->dtAbsensiBulanan();
}	

public function request()
{
	$d = [
		'title' => 'Attendance Request',
		'linkView' => 'page/absensi/request',
		// 'linkView' => 'fixing',
		'fileScript' => 'absensi.js',
		'bread' => [
			'nama' => 'Form Pengajuan',
			'data' => [
				['nama' => '','link' => site_url('Hcm/my_list_izin_cuti'),'active' => ''],
			]
		]
	];
	$this->load->view('_main',$d);
}

public function requestPengajuan()
{
	$nama = $this->session->userdata('karyawan_id');
	echo $this->ma->requestPengajuan($nama);


	// $this->ma->requestPengajuan();
}

public function report()
{
	$d = [
		'title' => 'Report',
		'linkView' => 'page/absensi/report',
		'fileScript' => 'absensi.js',
		'bread' => [
			'nama' => 'Report',
			'data' => [
				['nama' => '','link' => site_url('main/finance'),'active' => ''],
			]
		]
	];
	$this->load->view('_main',$d);
}

	public function rekap_tahunan()
	{
		$d = [
			'title' => 'Report',
			'linkView' => 'page/absensi/rekap_tahunan',
			'fileScript' => 'absensi.js',
			'bread' => [
				'nama' => 'Report',
				'data' => [
					['nama' => 'Daftar Absen','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function detail_rekap_tahunan($id='')
	{	
		$masukList = [];
		$cutiList = [];
		$izinList = [];
		$sakitList = [];
		$telatList = [];

		$absenBulan = [];
		$bulan = $this->bantuan->bulan();
		
		
		foreach ($bulan as $v) {
			$data = [
				'bulan' => $v[1],
				'masuk' => $this->ma->jmlMaAbKaBulan($id,$v[0]),
				'cuti' => $this->ma->jmlMaCuKaBulan($id,$v[0]),
				'izin' => $this->ma->jmlMaIzKaBulan($id,$v[0]),
				'sakit' => $this->ma->jmlMaSkKaBulan($id,$v[0]),
				'telat' => $this->ma->jmlMaTelatKaBulan($id,$v[0]),
			];


			array_push($absenBulan,$data);

			array_push($masukList,$this->ma->jmlMaAbKaBulan($id,$v[0]));
			array_push($cutiList,$this->ma->jmlMaCuKaBulan($id,$v[0]));
			array_push($izinList,$this->ma->jmlMaIzKaBulan($id,$v[0]));
			array_push($sakitList,$this->ma->jmlMaSkKaBulan($id,$v[0]));
			array_push($telatList,$this->ma->jmlMaTelatKaBulan($id,$v[0]));
		}

		$xc = [[
			'label' => '# Masuk',
			'data' => $masukList,
			'backgroundColor' => [
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
				'rgba(46, 184, 114, 1)',
			]
			],[
			'label' => 'Izin',
			'data' => $izinList,
			'backgroundColor' => [
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)',
			'rgba(56, 66, 89, 1)'
			]
		],[
			'label' => 'Cuti',
			'data' => $cutiList,
			'backgroundColor' => [
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			'rgba(249, 89, 89, 1)',
			]
		],[
			'label' => 'Sakit',
			'data' => $sakitList,
			'backgroundColor' => [
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			'rgba(33, 101, 131, 1)',
			]
		],[
			'label' => 'Telat',
			'data' => $telatList,
			'backgroundColor' => [
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			'#fd7e14',
			]
		]];

		$d = [
			'title' => 'Report',
			'linkView' => 'page/absensi/detail_rekap_tahunan',
			'fileScript' => 'absensi.js',
			'bread' => [
				'nama' => 'Report',
				'data' => [
					['nama' => 'Daftar Absen','link' => site_url('main/finance'),'active' => ''],
				]
			],
			'absenBulan' => $absenBulan,
			'nama' => $this->mk->get($id)->row()->nama,
			'grafikAbsen' => json_encode($xc)

		];
		$this->load->view('_main',$d);
	}

	// Pengaturan
	public function pengaturan()
	{
		$d = [
			'title' => 'Pengaturan Absensi',
			'linkView' => 'page/absensi/pengaturan',
			'fileScript' => 'absensi/pengaturan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function dt_pengaturan_absensi()
	{
		echo $this->ma->dt_pengaturan_absensi();
	}

	public function get_pengaturan_absensi($id='')
	{
		$p = $this->ma->get_pengaturan_absensi($id);
		if($p->num_rows() == 0) show_404();
		echo json_encode($p->row());
	}

	public function in_pengaturan_absensi()
	{
		$s = false;
		$m = "Gagal melakukan operasi";
		
		$tgl_mulai = $this->input->post('tgl_mulai');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$jam_telat = $this->input->post('jam_telat');

		$data = [
			'tgl_mulai' => $tgl_mulai,
			'tgl_akhir' => $tgl_akhir,
			'jam_telat' => $jam_telat,
		];

		$x = $this->ma->in_pengaturan_absensi($data);
		if ($x) {
			$s = true;
			$m = 'Berhasil mengubah';
		}

		$rsp = [
			'status'=> $s,
			'msg' => $m
		];
		echo json_encode($rsp);
	}

	public function up_pengaturan_absensi()
	{
		$s = false;
		$m = "Gagal melakukan operasi";
		
		$tgl_mulai = $this->input->post('e_tgl_mulai');
		$tgl_akhir = $this->input->post('e_tgl_akhir');
		$jam_telat = $this->input->post('e_jam_telat');
		$id = $this->input->post('id');

		$data = [
			'tgl_mulai' => $tgl_mulai,
			'tgl_akhir' => $tgl_akhir,
			'jam_telat' => $jam_telat,
		];

		$x = $this->ma->up_pengaturan_absensi($data,['id' => $id]);
		if ($x) {
			$s = true;
			$m = 'Berhasil mengubah Jam Absensi';
		}

		$rsp = [
			'status'=> $s,
			'msg' => $m
		];

		echo json_encode($rsp);
	}

	public function singkornisasi_absen($r='')
	{
		$s = false;
		$m = 'Tidak ada data untuk disingkronisasi';

		$id = $this->input->post('id');

		$sing = $this->ma->singkornisasi_absen($id);
		if ($sing[0]) {
			$s = true;
			$m = 'Berhasil singkronisasi '.$sing[1].' data absensi.';
		}

		$rsp = [
			'status' => $s,
			'msg' => $m
		];

		if ($r == '') {
			echo json_encode($rsp);
		}else{
			return $rsp;
		}
	}

}
