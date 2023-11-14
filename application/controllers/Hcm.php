<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hcm extends MY_controller {
    
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('MHcm','mhcm');
		$this->load->model('MNotif','n');
		$this->load->model('MLowongan','l');
		$this->load->model('MKaryawan','mk');
		$this->load->model('MJabatan','mj');
    }

    public function list_izin_cuti()
	{
		$d = [
			'title' => 'Daftar Pengajuan',
			'linkView' => 'page/hcm/submission',
			'fileScript' => 'hcm.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }
	
	public function my_list_izin_cuti()
	{
		$d = [
			'title' => 'Daftar Pengajuan Saya',
			'linkView' => 'page/hcm/mysubmission',
			'fileScript' => 'hcm.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }
    
    public function list_receive()
	{
		$d = [
			'title' => 'Daftar Pengajuan Diterima',
			'linkView' => 'page/hcm/submission',
			'fileScript' => 'submission_receive.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}
	
	public function detailSubmission($id='')
	{
		if($this->mhcm->get_pengajuan($id)->num_rows() == 0) show_404();

		$hpeng = [];
		foreach ($this->mhcm->getHPeng($id)[0] as $v) { 
			$ok = [
				'nama' => $v->nama,
				'approve' => $this->mhcm->setApprove($v->approve),
				'status' => $this->mhcm->setStatus($v->status),
				'tgl' => $this->bantuan->tgl_indo($v->created_date),
				'alasan' => $v->alasan
			];

			array_push($hpeng,$ok);
		}

		if ($id != '') {
			$d = [
				'title' => 'Detail Pengajuan',
				'linkView' => 'page/hcm/detail_submission',
				'fileScript' => 'detail_submission.js',
				'bread' => [
					'nama' => '',
					'data' => [
						['nama' => '','link' => site_url('main/hcm'),'active' => ''],
					]
				],
				'k' => $this->mhcm->get_pengajuan($id)->row(),
				'peng' => $this->mhcm->getPeng($id)[0],
				'jenis' => $this->mhcm->getPeng($id)[1],
				'hpeng' => $hpeng
			];
			$this->load->view('_main',$d);
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}

    }
    
    public function list_reject()
	{
		$d = [
			'title' => 'Daftar Pengajuan Ditolak',
			'linkView' => 'page/hcm/submission',
			'fileScript' => 'submission_reject.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }
    
    public function izin_cuti()
	{
		$d = [
			'title' => 'Izin Cuti',
			'linkView' => 'page/hcm/izin_cuti',
			'fileScript' => 'izin_cuti.js',
			'bread' => [
				'nama' => 'Izin Cuti',
				'data' => [
					['nama' => 'Daftar Izin Cuti','link' => site_url('main/hcm'),'active' => ''],
					['nama' => 'Izin Cuti','link' => site_url('main/izin_hcm'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function list_lowongan()
	{
		$d = [
			'title' => 'List Submission Reject',
			'linkView' => 'page/hcm/list_lowongan',
			'fileScript' => 'lowongan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }
    
    public function detail_lowongan($id='')
	{
		$d = [
			'title' => 'List Submission Reject',
			'linkView' => 'page/hcm/detail_lowongan',
			'fileScript' => 'detail_lowongan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			],
			'val' => [
				'lowongan' => $this->l->get('',['status' => 1,'id' => $id])->row()
			]
		];
		$this->load->view('_main',$d);
    }
    
    public function add_lowongan()
	{
		$d = [
			'title' => 'List Submission Reject',
			'linkView' => 'page/hcm/add_lowongan',
			'fileScript' => 'submission_reject.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function add_pelamar()
	{
		$d = [
			'title' => 'List Submission Reject',
			'linkView' => 'page/hcm/add_pelamar',
			'fileScript' => 'submission_reject.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function historical_position()
	{
		$d = [
			'title' => 'List Histrorical Position',
			'linkView' => 'page/hcm/historical_position',
			'fileScript' => 'historical_position.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function historical_detail($idKaryawan)
	{
		$d = [
			'title' => 'Historical Detail',
			'linkView' => 'page/hcm/historical_detail',
			'fileScript' => 'historical_position.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			],
			'val' => [
				'namaKaryawan' => $this->mk->get($idKaryawan)->row()->nama,
				'hjabatan' => $this->mj->getHJabatan($idKaryawan)->result()
			]
		];
		$this->load->view('_main',$d);
	}

    // Action / Proses

    public function dt()
    {
        echo ($this->mhcm->dt('0'));
	}
	
	public function dtMY()
    {
        echo ($this->mhcm->dt('',1));
    }

    public function dtReceive()
    {
        echo ($this->mhcm->dt('1'));
    }

    public function dtReject()
    {
        echo ($this->mhcm->dt('2'));
    }

    public function inIzinCuti()
    {
        $tm = strtotime($this->input->post('tgl_mulai'));
        $ta = strtotime($this->input->post('tgl_akhir'));

        $timeDiff = abs($tm - $ta);

        $numberDays = $timeDiff/86400;  // 86400 seconds in one day

        // and you might want to convert to integer
        $numberDays = intval($numberDays);
        $lama_cuti = $numberDays;

        $obj = [
            'tgl_pengajuan' => date('Y-m-d H:i:s'),
            'tgl_mulai' => date($this->input->post('tgl_mulai')),
            'tgl_akhir' => date($this->input->post('tgl_akhir')),
            'lama_cuti' => $lama_cuti,
            'status_pengajuan' => 0,
            'alasan' => $this->input->post('alasan'),
            'karyawan_id' => 1
        ];
        
        $in = $this->mhcm->inPc($obj);
        if ($in[1] == 1) {
           
            $data_pc = [
                'tgl_sah' => date('Y-m-d H:i:s'),
                'tgl_mulai' => date($this->input->post('tgl_mulai')),
                'tgl_akhir' => date($this->input->post('tgl_akhir')),
                'pengajuan_cuti_id' => $in[2],
                'approval' => '1',
                'status_cuti' => 2,
            ];

            $inCuti = $this->mhcm->inCuti($data_pc);
            if ($inCuti[1] == 1) {
                $this->session->set_flashdata('success', 'Success to added data izin cuti');
                redirect('main/hcm');
            }
        
        }else{
            $this->session->set_flashdata('failed', 'Success to added data izin cuti');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function terima($id='')
    {
		$id = $this->input->post('idt');
		$this->mhcm->terima($id);
		$q =  $this->mhcm->get_pengajuan($id)->row();

		$this->n->inNotif(
			'Pengajuan Izin',
			$this->session->userdata('karyawan_id'),
			$q->karyawan_id,
			$q->nama.' pengajuan anda diterima',
			'Hcm/detailSubmission/'.$id
		);

		echo json_encode([
			'status' => true,
			'msg' => "Berhasil menerima pengajuan"
		]);
    }

    public function tolak()
    {
		$id = $this->input->post('idt');
		echo json_encode($this->mhcm->tolak($id));	
		$q =  $this->mhcm->get_pengajuan($id)->row();
		$this->n->inNotif(
			'Pengajuan Izin',
			$this->session->userdata('karyawan_id'),
			$q->karyawan_id,
			$q->nama.' pengajuan anda ditolak',
			'Hcm/detailSubmission/'.$id
		);

		echo json_encode([
			'status' => true,
			'msg' => "Berhasil Tolak pengajuan"
		]);
	}
	
	// Lowongan

	public function dtLowongan($status='')
	{
		echo $this->l->dtLowongan(1);
	}

	public function inLowongan()
	{
		$data = [
			"pekerjaan" => $this->input->post("pekerjaan"),
			"status" => 1,
			"kualifikasi" => $this->input->post("kualifikasi"),
			"deskripsi" => $this->input->post("deskripsi"),
			"tgl_mulai" => $this->input->post("tgl_mulai"),
			"tgl_akhir" => $this->input->post("tgl_akhir"),
			"pengalaman" => $this->input->post("pengalaman"),
			"ed_date" => date('Y-m-d H:i:s'),
			"created_by" => $this->session->userdata('karyawan_id'),
		];

		$this->db->insert('lowongan', $data);
		$this->session->set_flashdata('success', 'Success to added Lowongan');
		redirect($_SERVER['HTTP_REFERER']);
		
	}

	public function deLowongan($id='')
	{
		if ($id != '') {

			$this->l->de(['id' => $id]);
			$this->session->set_flashdata('success', 'Success to remove Lowongan');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Pelamar

	public function dtPelamar($id='')
	{
		$this->load->model('MPelamar','p');
		echo $this->p->dtPelamar($id);
	}

	public function inPelamar()
	{
		$this->load->model('MPelamar','p');

		$config['upload_path']          ='./data/cv';
		$config['allowed_types']        = 'pdf|docx|doc';
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('cv'))
		{
			$cv = '';
		}else{
			$cv  = $this->upload->data()['file_name'];
		}

		$data = [ 
			"nama" => $this->input->post("nama"),
			"pendidikan" => $this->input->post("pendidikan"),
			"email" => $this->input->post("email"),
			"no_tlp" => $this->input->post("no_tlp"),
			"cv" => $cv,
			"craeted_date" => date('Y-m-d H:i:s'),
			'status' => 1,
			"created_by" => $this->session->userdata('karyawan_id'),
			"lowongan_id" => $this->input->post("lowongan_id"),
		];

		$this->db->insert('pelamar', $data);
		$id = $this->db->insert_id();

		$h_pelamar = [
			'penerima_id' => $this->session->userdata('karyawan_id'),
			'pelamar_id' => $id,
			'status' => 1,
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('karyawan_id'),
			'lowongan_id' => $this->input->post("lowongan_id")
		];
		$this->p->inHPelamar($h_pelamar);

		$this->session->set_flashdata('success', 'Success to add pelamar');
		redirect($_SERVER['HTTP_REFERER']);

	}

	public function upPelamarStatus($id='',$r='')
	{
		$this->load->model('MPelamar','p');

		$data = [
			'status' => $this->input->post('status')
		];

		if ($id != '') {
			$this->db->update('pelamar', $data,['id' => $id]);
			$l = $this->p->get($this->input->post('id'))->row();

			$h_pelamar = [
				'penerima_id' => $this->session->userdata('karyawan_id'),
				'pelamar_id' => $id,
				'status' => $this->input->post('status'),
				'created_date' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('karyawan_id'),
				'lowongan_id' => $l->lowongan_id
			];

			$this->p->inHPelamar($h_pelamar);
		}
		
		if ($r == '1') {
			$data = [
				'msg' => 'Success update status',
				'status' => 1
			];
			echo json_encode($data);
		}else{
			$this->session->set_flashdata('success', 'Success update status');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function getPelamar($id)
	{
		$this->load->model('MPelamar','p');
		$this->p->see = "status,id";
		$q = $this->p->get('',['id' => $id])->row();
		echo json_encode($q);
		
	}

	// Jabatan Group
	public function get_jabatan_grp()
	{
		$q = $this->mj->get_jabatan_grp();
		echo json_encode($q->result());
	}

	// Jabatan
	public function get_jabatan()
	{
		$q = $this->mj->get('',['aktif' => 1]);
		echo json_encode($q->result());
	}

	// History Jabatan
	public function inHJabatan()
	{
		$data = [
			"created_by" => $this->session->userdata('karyawan_id'),
			"jabatan_id" => $this->input->post("jabatan"),
			"karyawan_id" => $this->input->post("idk"),
			"period" => $this->input->post("periode"),
			"created_date" => date('Y-m-d H:i:s'),
		];
		$this->db->insert('h_jabatan', $data);
		
		$this->mk->up(['jabatan_id' => $this->input->post("jabatan")],['id' => $this->input->post("idk")]);
		
		$this->session->set_flashdata('success', 'Success add position');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function deHJabatan($id='')
	{
		if ($id != '') {

			$this->db->delete('h_jabatan',['id' => $id]);
			$this->session->set_flashdata('success', 'Success to remove Position');
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Get Pengajuan
	public function get_pengajuan_id()
	{
		$id = $this->input->get('id');
		$this->db->select('tgl_pengajuan,tgl_mulai,tgl_akhir,lama, alasan, jenis, karyawan_id,who_approve,nama,p.id,p.status_pengajuan');
		$q = $this->mhcm->get_pengajuan_id($id);
		$p = $q->row();
		// $hpeng = $this->db->get_where('h_peng',['peng_id' => $id]);
		// if ($hpeng->num_rows() > 0 ) {
		// 	$hp =  $hpeng->row();
		// 	$p->alasan_leader = $hp->alasan;
		// }
		echo json_encode($p);
	}

	public function tracking_covid()
	{
		$d = [
			'title' => 'Tracking Covid',
			'linkView' => 'page/hcm/tracking_covid/index',
			'fileScript' => 'hcm/tracking_covid.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function dt_jabatan()
	{
		$leader = $this->input->post('leader');
		$parent = $this->input->post('parent');

		echo $this->mj->dt_jabatan($parent,$leader);
	}

	public function get_jabatan_id()
	{
		$id = $this->input->get('id');
		$q = $this->mj->get($id)->row();
		echo json_encode($q);
	}

	public function in_jabatan()
	{
		$d = [
			"nma_jabatan" => $this->input->post("jabatan"),
			"parent_id" => $this->input->post("induk_jabatan"),
			"leader" => $this->input->post("leader"),
			"grp_jabatan_id" => $this->input->post("group"),
		];
		$x = $this->mj->in_jabatan($d);
		echo json_encode([
			'msg' => 'Berhasil menambahkan jabatan',
			'status' => true
		]);
	}

	public function up_jabatan()
	{
		$d = [
			"nma_jabatan" => $this->input->post("e_jabatan"),
			"parent_id" => $this->input->post("e_induk_jabatan"),
			"leader" => $this->input->post("e_leader"),
			"grp_jabatan_id" => $this->input->post("e_group"),
		];
		$x = $this->mj->up_jabatan($d,$this->input->post("e_id"));
		echo json_encode([
			'msg' => 'Berhasil ubah data jabatan',
			'status' => true
		]);
	}

	public function del_jabatan($id='')
	{
		$d = [
			"aktif" => 0
		];
		$x = $this->mj->up_jabatan($d,$id);
		echo json_encode([
			'msg' => 'Berhasil hapus data jabatan',
			'status' => true
		]);
	}

	public function tracking_covk()
	{
		$d = [
			'title' => 'Tracking Covid',
			'linkView' => 'page/hcm/tracking_covid/tracking_covk',
			'fileScript' => 'hcm/tracking_covk.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
				],
				'id' => $this->session->userdata('karyawan_id')
		];
		$this->load->view('_main',$d);
	}

	public function in_tracking_covid()
    {
		$msg = 'Gagal menambahkan data';
		$status = false;

		$karyawan_id = $this->input->post('karyawan_id');
		$status_covid = $this->input->post('status_covid');
		$tgl_mulai_sakit = $this->input->post('tgl_mulai_sakit');
		$tgl_tes = $this->input->post('tgl_tes');
		$tes_covid = $this->input->post('tes_covid');
		$act_ming_kang = $this->input->post('act_ming_kang');
		$act_luar_kntr = $this->input->post('act_luar_kntr');
		$catatan = $this->input->post('catatan');
		$file = $this->do_upload('file','./data/covid/');
		
		if ($karyawan_id != ''){
			$obj = [
				'karyawan_id' => $karyawan_id,
				'status_covid' => $status_covid,
				'tgl_mulai_sakit' => $tgl_mulai_sakit,
				'tgl_tes' => $tgl_tes,
				'tes_covid' => $tes_covid,
				'act_ming_kang' => $act_ming_kang,
				'act_luar_kntr' => $act_luar_kntr,
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'catatan' => $catatan,
				'file' => $file[1],
				'aktif' => 1
			];
		}else{
			$karyawan_id = $this->session->userdata('karyawan_id');
			$obj = [
				'karyawan_id' => $karyawan_id,
				'status_covid' => $status_covid,
				'tgl_mulai_sakit' => $tgl_mulai_sakit,
				'tgl_tes' => $tgl_tes,
				'tes_covid' => $tes_covid,
				'act_ming_kang' => $act_ming_kang,
				'act_luar_kntr' => $act_luar_kntr,
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'catatan' => $catatan,
				'file' => $file[1],
				'aktif' => 1
			];
		}

		$in = $this->mhcm->inTrackCov($obj);
        if ($in != '') {
            
			$data_history = [
				'karyawan_id' => $karyawan_id,
				'status_covid' => $status_covid,
				'trac_cov_id' => $in,
				'pesan' => $catatan,
				'tes_covid' => $tes_covid,
				'tgl_catatan' => $tgl_tes,
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'file' => $file[1],
			];
			
			$inHistory = $this->mhcm->inHistoryCov($data_history);
			if ($inHistory[1] == 1) {
				$status = true;
				$msg = "Berhasil menambahkan data";
			}
			
		}else{
			$status = false;
			$msg = "Gagal menambahkan data";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);
    }

    public function up_tracking_covid()
    {
		$id = $this->input->post('idtc');
		$karyawan_id = $this->input->post('karyawan_id');
		$status_covid = $this->input->post('status_covid');
		$tgl_catatan = $this->input->post('tgl_catatan');
		$tgl_tes = $this->input->post('tgl_tes');
		$tes_covid = $this->input->post('tes_covid');
		$obat = $this->input->post('obat');
		$catatan = $this->input->post('catatan');
		$file = $this->do_upload('file','./data/covid/');

		if ($tgl_tes && $status_covid != '') {
			
			$obj = [
				'status_covid' => $status_covid,
				'tgl_tes' => $tgl_tes,
				'tgl_catatan' => $tgl_catatan,
				'tes_covid' => $tes_covid,
				'obat' => $obat,
				'catatan' => $catatan,
				'ctdUpd' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'file' => $file[1]
			];

		} else {
			$obj = [
				'tgl_catatan' => $tgl_catatan,
				'obat' => $obat,
				'catatan' => $catatan,
				'ctdUpd' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'file' => $file[1]
			];
		}
		
		
		$up = $this->mhcm->upTrackCov($obj,['idtc' => $id]);
		if ($up) {
			
			$data_history = [
				'karyawan_id' => $karyawan_id,
				'trac_cov_id' => $id,
				'pesan' => $catatan,
				'tes_covid' => $tes_covid,
				'tgl_tes' => $tgl_tes,
				'tgl_catatan' => $tgl_catatan,
				'obat' => $obat,
				'status_covid' => $status_covid,
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'file' => $file[1],
			];
			
			$inHistory = $this->mhcm->inHistoryCov($data_history);
			if ($inHistory[1] == 1) {
				$status = true;
				$msg = "Berhasil mengupdate data";
			}
			
		}else{
			$status = false;
			$msg = "Gagal mengupdate data";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);
	}
	
	public function do_upload($name='',$path='')
    {
            $this->load->library('upload');
            
            $d = '';
            $s = 0;
            $msg = '';

            $config['upload_path']          = $path;
            $config['allowed_types']        = 'pdf|jpg|png|jpeg';
            $config['max_size']             = 0;
            $config['max_width']            = 0;
            $config['max_height']           = 0;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload($name)){
                $msg = $this->upload->display_errors();
            }else{
                $d = $this->upload->data()['file_name'];
                $s = 1;
            }

            return [$s,$d,$msg,$this->upload->data(),$config];
    }  

	public function dt_tracking_covid()
	{
		echo $this->mhcm->dt_tracking_covid();
	}

	public function dt_tracking_covidk($id)
	{
		echo $this->mhcm->dt_tracking_covidk($id);
	}

	public function dt_histori_covid($tcid)
	{
		echo $this->mhcm->dt_histori_covid($tcid);
	}

	public function getKaryawan($id='')
    {
        $data = '';
        if ($id != '') {
            $this->mk->see = "nama,k.id as idk,j.id as idj,j.nma_jabatan";
           $q = $this->mk->getKaryawan($id)->row();
        }else{
            $this->mk->see = "nama,k.id as idk,j.id as idj,j.nma_jabatan";
            $q = $this->mk->getKaryawan()->result();
        }

        $data = [
			'nama' => $q,
        ];

        echo json_encode($data);
	}

	public function getTrackCov($id='')
    {
        $data = '';
        if (!empty($id)) {
            $this->mhcm->see = "nama,k.id as idk,j.id as idj,j.nma_jabatan,act_ming_kang,act_luar_kntr";
           $q = $this->mhcm->getTrackCov($id)->row();
        }else{
            $this->mhcm->see = "nama,k.id as idk,j.id as idj,j.nma_jabatan,act_ming_kang,act_luar_kntr";
            $q = $this->mhcm->getTrackCov()->result();
        }

        $data = [
			'nama' => $q,
        ];

        echo json_encode($data);
	}
	
	public function set_nonaktif($id)
	{
		$data = [
            'aktif' => 0
        ];

		$x = $this->mhcm->upTrackCov($data,['idtc' => $id]);

		// $dataa = [
		// 	'pk_id' => $id,
		// 	'status' => 0,
		// 	'ctd_by' => @$this->session->userdata('karyawan_id'),
		// 	'ctd_date' => date('Y-m-d'),
		// ];

		// $x = $this->pm->inProjPm($dataa);
		
		if ($x) {
			$status = true;
			$msg = "Berhasil menghapus data";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);
	}

	public function report_covid()
	{
		$d = [
			'title' => 'Report Covid',
			'linkView' => 'page/hcm/tracking_covid/report_covid',
			'fileScript' => 'hcm/report_covid.js',
			'bread' => [
				'nama' => 'Report Covid',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
				],
				'tracking' => $this->mhcm->getTrackCov(null,null,2)
		];
 		$this->load->view('_main',$d);
	}

	public function getTahun()
	{
		$tahun = $this->input->get('tahun');

		$get_tahun = "";
		if ($tahun != "") {
			$get_tahun = $tahun;
		}else{
			$default = explode('-', date("Y-m-d"));
		    $get_tahun = $default[0];
		}

		return $get_tahun;
	}

	public function getBulan()
	{
		$bulan = $this->input->get('bulan');

		$get_bulan = "";
		if ($bulan != "") {
			$get_bulan = $bulan;
		}else{
			$default = explode('-', date("Y-m-d"));
		    $get_bulan = $default[1];
		}
		
		return $get_bulan;
	}

	public function getDate()
	{
		// $tanggal = date('Y-m-d');
		$tanggal = $this->input->get('tanggal');

		$get_date = "";
		if ($tanggal != "") {
			$get_date = $tanggal;
		}else{
			$default = explode('-', date("Y-m-d"));
		    $get_date = $default[2];
		}
		
		return $get_date;
	}

	public function totalTrackCov($bulan='',$tahun='',$tanggal='',$direktorat='')
	{
		$get_tahun = $this->getTahun();
		$get_bulan = $this->getBulan();
		$get_date = $this->getDate();
		$get_direktorat = $this->input->get('direktorat');

		
		$ok = [
			'totalCovid' => $this->mhcm->totalTrackCov($get_tahun,$get_bulan,$get_date,$get_direktorat)->num_rows(),
			'totalPositif' => $this->mhcm->totalCov(2,$get_tahun,$get_bulan,$get_date,$get_direktorat)->num_rows(),
			'totalNegatif' => $this->mhcm->totalCov(1,$get_tahun,$get_bulan,$get_date,$get_direktorat)->num_rows(),
			'totalKaryawan' => $this->mhcm->totalKaryawan($get_direktorat)->num_rows(),
			'totalPerTahun' => $this->mhcm->totalPositifPerTahun(2, $get_tahun)->num_rows(),
			'totalPerPoBulan' => $this->mhcm->totalPerBulan(2, $get_bulan, $get_tahun)->num_rows(),
			'totalPerNeBulan' => $this->mhcm->totalPerBulan(1, $get_bulan, $get_tahun)->num_rows(),
			'tidakTerpapar' => (intval($this->mhcm->totalKaryawan($get_direktorat)->num_rows()) - intval($this->mhcm->totalTrackCov($get_tahun,$get_bulan,$get_date,$get_direktorat)->num_rows())),
			'divisiTerbanyak' => $this->mhcm->divisiTerbanyak($get_tahun, $get_bulan, $get_date, $get_direktorat)
		];
		
		echo json_encode($ok);
	}

	public function dataGraphCovJson($bulan='',$tahun='', $tanggal='',$direktorat='')	
	{
		$get_tahun = $this->getTahun();
		$get_bulan = $this->getBulan();
		$get_date = $this->getDate();
		$get_direktorat = $this->input->get('direktorat');
		
		$dt_total = $this->mhcm->graph($get_bulan,$get_tahun,$get_date,$get_direktorat);
		$dataTotal = [];
		$dataLabel = [];
		foreach ($dt_total as $key => $data) {
                    $dataTotal[$key] = intval($data->Total);;
                    $dataLabel[$key] = $data->nma_jabatan;
                }

		$densityData = [
			'label' => 'Jumlah Positif',
			'data' => $dataTotal,
			'backgroundColor' => 'rgba(50, 130, 184, 1)',
			'borderWidth' => 0,
		];
		  
		$planetData = [
			'labels' => $dataLabel,
			'datasets' => [$densityData]
		];

		echo json_encode($planetData);
	}

	public function jabatan()
	{
		$d = [
			'title' => 'Mangement Jabatan',
			'linkView' => 'page/hcm/jabatan',
			'fileScript' => 'hcm/jabatan.js',
			'bread' => [
				'nama' => 'Management Jabatan',
				'data' => [
					['nama' => '','link' => site_url('main/hcm'),'active' => ''],
				]
				]
		];
 		$this->load->view('_main',$d);
	}
}
