<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PM extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MProject','pm');
		$this->load->model('MSerdev','ms');
	}

	public function index()
	{


		// $vpsb = [];
		// $vdismantle = [];

		// $projek = [];
	
		// $id = $this->input->get('id');
		// // if($id == '') echo "ngapain si loe ?"; return false; 

		// $this->pm->see = "tt.id,tt.task_name,tt.kategori,tt.start_date,tt.end_date";
		// $qp = $this->pm->getTimeline($id)->result_array();
		// foreach ($qp as $v) {
		// 	$projek[] = [
		// 		'id' => $v['id'],
		// 		'psb' => [],
		// 		'dismantle' => [],
		// 		'kategori' => $this->pm->setKategoriTimeline($v['kategori']),
		// 		'projek' => $v['task_name'],
		// 		'start_date' => $v['start_date'],
		// 		'end_date' => $v['end_date'],
		// 		'calc' => [],
		// 	];
		// }

	    // // Tabel timeline_psb
		// $psb = [
		// 	['id' => 1,'pk_id' => 1,'nama' => 'HSG','nilai' => 30],
		// 	['id' => 2,'pk_id' => 1,'nama' => 'SWITCH POE','nilai' => 40],
		// 	['id' => 3,'pk_id' => 1,'nama' => 'R730','nilai' => 50],
		// 	['id' => 3,'pk_id' => 2,'nama' => 'HSG','nilai' => 53],
		// 	['id' => 3,'pk_id' => 2,'nama' => 'SWITCH POE','nilai' => 53],
		// 	['id' => 3,'pk_id' => 2,'nama' => 'R730','nilai' => 53],
		// ];

		// $this->pm->see = "tp.id,tp.pk_id,sd.device as nama,tp.jml as nilai";
		// $psb = $this->pm->getTimelinePSB($id)->result_array();

		// // Tabel timeline_dismantle
		// $dismantle = [
		// 	['id' => 1,'pk_id' => 1,'nama' => 'HSA','nilai' => 30],
		// 	['id' => 2,'pk_id' => 1,'nama' => 'R740','nilai' => 40],
		// 	['id' => 2,'pk_id' => 2,'nama' => 'HSA','nilai' => 41],
		// 	['id' => 2,'pk_id' => 2,'nama' => 'R740','nilai' => 41],
		// ];
		// $dismantle = $this->pm->getTimelineDISMANTLE($id)->result_array();

		// foreach (@$projek as $k => $v) {
			
		// 	foreach ($this->genSND($v['start_date'],$v['end_date'])['data'] as $vz) {
		// 		$projek[$k]['calc'][] = $vz['date'];
		// 	}

		// 	foreach ($psb as $vx) {
		// 		$vpsb[] = $vx['nama'];
		// 		if($vx['pk_id'] == $v['id']) $projek[$k]['psb'][] = $vx['nilai'];
		// 	}

		// 	foreach ($dismantle as $vc) {
		// 		$vdismantle[] = $vc['nama'];
		// 		if($vc['pk_id'] == $v['id']) $projek[$k]['dismantle'][] = $vc['nilai'];
		// 	}
		// }

	    // echo json_encode(array_values($vdismantle));		
	    // echo json_encode(array_values($vpsb));		

		// echo json_encode($projek);
	}

	public function genSND($sd,$ed)
	{
		$bulan = [];
		$tahun = [];
		$dx = [];

		// $sd = "2020-06-01";
		// $ed = "2021-07-30";
		
		$tgl_sd = explode('-',$sd);
		$tgl_ed = explode('-',$ed);

		$last_sd = date("t", strtotime($sd));
		$last_ed = date("t", strtotime($ed));
		
		$w = 1;
		$dx['week'][1] = ['date' => $sd,'nama' => 'W'.$w,'kode' => md5($tgl_sd[0].$tgl_sd[1])];

		for ($t=$tgl_sd[0]; $t <= $tgl_ed[0] ; $t++) { 
			// $dx['tahun'][] = (int) $t;
			$bln = [];
			$no=1;
			for ($i=1; $i <= 12 ; $i++) {
				if ($t == $tgl_sd[0] && $i < $tgl_sd[1]) {
					continue;
				}

				if ($t == $tgl_ed[0] && $i > $tgl_ed[1]) {
					continue;
				}

				$bl = $i;
				if (strlen($i) == 1) {
					$bl = '0'.$i;
				}

				$bln[] = $i; 
				// $dx['tahun'][$t][$bln] = $bln;
				$dx['month'][md5($t.$bl)] = ['month' => $t.','.$i,'kode' => md5($t.$bl)];
				
				// Tanggal
				$tgx = [];
				$ltgl = date("t", strtotime($t.'-'.$i.'-01'));
				$jmlmount = 1;
				for ($tg=1; $tg <= $ltgl ; $tg++) { 

					if ($t == $tgl_sd[0] && $i == $tgl_sd[1] && $tg < $tgl_sd[2]) {
						continue;
					}

					if ($t == $tgl_ed[0] && $i == $tgl_ed[1] && $tg > $tgl_ed[2]) {
						continue;
					}
					$tgx[] = $tg;
					$dx['month'][md5($t.$bl)]['jml'] = $jmlmount++;	
					
					$tgll = $tg;
					if (strlen($tg) == 1) {
						$tgll = '0'.$tg;
					}
					
					$rs = '';
					if ($no > 7) {
						$no = 1;
						$w += 1;
						$dx['week'][$w] = ['date' => $t.'-'.$bl.'-'.$tgll,'nama' => 'W'.$w,'kode' => md5($t.$bl)];
					}

					$dx['week'][$w]['jml'] = $no;	
					
					$dx['data'][] = ['date' => $t.'-'.$bl.'-'.$tgll,'tgl' => $tgll,'no' => $no++,'kode' => md5($t.$bl)];
				}
			}

		}

		return $dx;
	}
	

	public function work_order()
	{
		$d = [
			'title' => 'Work Order PM',
			'linkView' => 'page/pm/work_order',
			'fileScript' => 'pm/work_order.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => 'asdsadas','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dt_projek()
	{
		echo $this->pm->dt_projek();
	}

	public function detail_work_order($id)
	{
		$d = [
			'title' => 'Detail Work Order',
			'linkView' => 'page/pm/detail_work_order',
			'fileScript' => 'pm/detail_work_order.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
			'projekPm' => $this->pm->getProjPm($id)->row(),
			'projekPK' => $this->pm->getPK($id)->row(),
			'pm_drm' => $this->pm->get_drm('',['pk_id' => $id])->row(),
			'custend' => $this->pm->getCustend($id)->row(),
			'cust' => $this->pm->getCust($id)->row(),
			'kendala' => $this->pm->getCountTrouble($id),
		];
		$this->load->view('_main',$d);
	}

	public function addTimeline()
    {
		$msg = 'Gagal menambahkan data';
		$status = false;

		$nama_file = $this->input->post('nama_file_timeline');
		$file = $this->do_upload('file_timeline','./data/projek/file/');
		$pk_id =$this->input->post('idpk');
		
		$obj = [
			'file' => $file[1],
			'status' => 1,
			'ctdBy' => $this->session->userdata('karyawan_id'),
			'ctdDate' => date('Y-m-d H:i:s'),
			'pk_id' => $pk_id,
			'jenis' => 0,
			'nama_file' => $nama_file,
		];

		$in = $this->pm->inProjekKontrakFile($obj);
        if ($in != '') {
            
			$data_history = [
				'keterangan' => 'Menambahkan File Timeline '.$nama_file,
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'file' => $file[1],
				'nama_file' => $nama_file,
				'pk_id' => $pk_id
			];
			
			$inHistory = $this->pm->inProjekHistory($data_history);
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

	public function addDRM()
    {
		$msg = 'Gagal menambahkan data';
		$status = false;

		$pk_id = $this->input->post('idpk');
		$iddrm = $this->input->post('iddrm');
		$catatan = $this->input->post('catatan');
		$nama_file = $this->input->post('nama_file');
		$jenis = $this->input->post('jenis');
		// $file = $this->do_upload('file','./data/projek/file/');
		
		$ctt = [
			"pk_id" => $pk_id,
			"catatan" => $catatan,
			'ctdBy' => @$this->session->userdata('karyawan_id'),
			'ctdDate' => date('Y-m-d H:i:s'),
		];

		// $cek_drm = $this->pm->get_drm('',['pk_id' => $pk_id]); 
		if ($iddrm != 0) {
			
			$this->db->update('pm_drm', $ctt,['id' => $iddrm]);
			$status = true;
			$msg = "Berhasil mengubah data";
			
		}else{
			$this->pm->in_drm($ctt);
			$id_wo = $this->db->insert_id();
		}
		
		if (isset($_FILES['file'])) {
			$file = $this->upload_files('./data/projek/file/','pk'.date('Ymdhis'),$_FILES['file']);
			for ($i=0; $i < count($file); $i++) {
				$data = [
					'pk_id' => $pk_id,
					'ctdBy' => @$this->session->userdata('karyawan_id'),
					'ctdDate' => date('Y-m-d H:i:s'),
					'nama_file' => $nama_file[$i],
					'file' => $file[$i],
					'status' => 1,
					'jenis' => $jenis[$i],
					'drm_id' => $iddrm
				];
	
				$x = $this->pm->inProjekKontrakFile($data);
			}  
		} 
	
	
			if ($x != '') {
				
				for ($i=0; $i < count($file); $i++) {
					$data_history = [
						'keterangan' => 'Menambahkan File DRM '.$nama_file[$i],
						'ctdDate' => date('Y-m-d H:i:s'),
						'ctdBy' => $this->session->userdata('karyawan_id'),
						'file' => $file[$i],
						'nama_file' => $nama_file[$i],
						'pk_id' => $pk_id
					];
				
					$inHistory = $this->pm->inProjekHistory($data_history);
				}
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

	public function getDRM()
	{
		$pk_id = $this->input->post('pk_id');
		$data = $this->pm->get_drm('',['pk_id' => $pk_id])->row();
		$dataa = [
			'catatan' => $data->catatan
		];
		echo json_encode($dataa);
	}

	public function set_nonaktif_fdrm($id)
	{
		$data = [
            'status' => 0
        ];

		$x = $this->pm->upProjekKontrakFile($data,['id' => $id]);
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

	public function dt_pk_histori()
	{
		$pk_id = $this->input->post('pk_id');
		echo $this->pm->dt_pk_histori($pk_id);
	}

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'pdf|jpg|png|jpeg|xlsx|docx',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }

	public function do_upload($name='',$path='')
    {
            $this->load->library('upload');
            
            $d = '';
            $s = 0;
            $msg = '';

            $config['upload_path']          = $path;
            $config['allowed_types']        = 'pdf|jpg|png|jpeg|xlsx|docx';
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


	public function getPM()
	{
		$pm_data = [];
		$file = '';

		$id = $this->input->get('id');
		$this->pm->see = "pk.id,service,no_kontrak,qty,pk.pipeline_id,pm.id as pm_idx,pm_id,pm.status,remarks,nama,pm.*";
		$pm = $this->pm->getPM($id);
		
		if ($pm->num_rows() > 0) {
			$status = true;
			$x = $pm->row();

			$kl = $this->db->get_where('act_kontrak', ['pipeline_id' => @$x->pipeline_id]);
            if ($kl->num_rows() > 0) {
                $k = $kl->row();
                $file .= '<a href="'.base_url('data/sls/kontrak/'.$k->kontrak).'" class="btn btn-outline-danger btn-sm ml-1 mr-2 w-100">View Kontrak</a>';
            }

            $po = $this->db->get_where('act_po', ['pipeline_id' => $x->pipeline_id]);
            if ($po->num_rows() > 0) {
                $p = $po->row();
                $file .= '<a href="'.base_url('data/sls/po/'.$p->po).'" class="btn btn-outline-danger btn-sm ml-1 mr-2 w-100">View PO</a>';
            }
			
			$pm_data = [
				'id' => $x->id,
				'pm' => $x->pm_idx,
				'service' => $x->service,
				'no_kontrak' => $x->no_kontrak,
				'qty' => $x->qty == '' ? 0 : $x->qty ,
				'po' => $file,
				'pp' => '<a href="'.site_url('pm/project_plan?id='.$x->id).'" class="btn btn-outline-danger btn-sm" id="po" style="width: 100%;">View</a>',
				'pipeline_id' => $x->pipeline_id,
				'pm_id'=>$x->pm_id,
				'nama_pm'=>$x->nama,
				'status' => $x->status,
				'remarks' => $x->remarks
			];
		}

		$data = [
			'status' => $status,
			'data' => $pm_data
		];	

		echo json_encode($data);
	}

	public function upPM()
	{
		$id = $this->input->post('pm_id');
		$pk_id = $this->input->post('pk_id');
		$pm = $this->input->post('pm');
		$status = $this->input->post('status');
		$remark = $this->input->post('remark');

		$up = [
			'pm_id' => $pm,
			'status' => $status,
			'remarks' => $remark
		];
		
		$this->db->update('projek_pm', $up,['id' => $id]);

		$obj = [
			'pm_id' => $id,
			'pk_id' => $pk_id,
			'status' => $status,
			'remarks' => $remark,
			'ctdDate' => date('Y-m-d H:i:s'),
			'ctdBy' => $this->session->userdata('karyawan_id')
		];

		$this->pm->inPMStatus($obj);

		$data = [
			'msg' => "Berhasil mengubah Projek",
			'status' => true,
		];

		echo json_encode($data);
	}
	
	public function getPMStatus()
	{
		$pm_id = $this->input->get('pm_id');
		$x = $this->pm->getPMStatus($pm_id);
		echo json_encode($x);
	}

	public function dtProjek()
	{
		echo $this->pm->dtProjek();
	}

	public function project_plan()
	{
		// Tabel projek_timeline, projek_kontrak, projek, timeline_task
		$vpsb = [];
		$vdismantle = [];	

		$id = $this->input->get('id');
		// if($id == '') echo "ngapain si loe ?"; return false; 
		if ($id == '') { echo "Siapa kamu ??"; }else{

		$this->pm->see = "pt.start_date,pt.end_date,psb,dismantle";
		$pl = $this->pm->getPTimeline($id);
		
		$projek_plan = [
			'start_date' => '',
			'end_date' => '',
		];
		
		if($pl->num_rows() > 0) {
			$projek_plan = $pl->row_array();
		}else{
			show_404();
		};

		$sd = $projek_plan['start_date'];
		$ed = $projek_plan['end_date'];
			
		$this->pm->see = "tt.id,tt.task_name,tt.kategori,tt.start_date,tt.end_date,pt.start_date as sd,pt.end_date as ed";
		$qp = $this->pm->getTimeline($id)->result_array();

		foreach ($qp as $v) {
			
			$projek[] = [
				'id' => $v['id'],
				'psb' => [],
				'dismantle' => [],
				'kategori' => $this->pm->setKategoriTimeline($v['kategori']),
				'projek' => $v['task_name'],
				'start_date' => $v['start_date'],
				'end_date' => $v['end_date'],
				'calc' => [],
			];

		}

		$this->pm->see = "tp.id,tp.tt_id,tp.pk_id,sd.device as nama,tp.jml as nilai";
		$psb = $this->pm->getTimelinePSB($id)->result_array();

		$dismantle = $this->pm->getTimelineDISMANTLE($id)->result_array();

		if (@count($projek) > 0) {
			foreach (@$projek as $k => $v) {
				
				if($v['start_date'] != NULL || $v['end_date']){
					foreach ($this->genSND($v['start_date'],$v['end_date'])['data'] as $vz) {
						@$projek[$k]['calc'][] = $vz['date'];
					}
				}

				foreach ($psb as $vx) {
					@$vpsb[] = $vx['nama'];
					if($vx['tt_id'] == $v['id'] && $vx['tt_id'] != null) $projek[$k]['psb'][] = $vx['nilai'];
				}

				foreach ($dismantle as $vc) {
					@$vdismantle[] = $vc['nama'];
					if($vc['tt_id'] == $v['id'] && $vx['tt_id'] != null) $projek[$k]['dismantle'][] = $vc['nilai'];
				}
			}
		}

		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/project_plan',
			'fileScript' => 'pm/projek_plan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
			'pl' => $projek_plan,
			'projek' => $projek,
			'dx' => $this->genSND($sd,$ed),
			'psb' => $this->pm->getTimelinePSB($id,'device_id')->result(),
			'dismantle' =>  $this->pm->getTimelineDISMANTLE($id,'device_id')->result(),
		];
		
		$this->load->view('_main',$d);

		}
	}

	public function inTimeline()
	{
		$psb = '';
		foreach ($this->input->post('psb') as $x) {
			$psb .= $x.',';
		}

		$dismantle = '';
		foreach ($this->input->post('dismantle') as $x) {
			$dismantle .= $x.',';
		}

		$this->db->update('projek_timeline',[
			'pk_id' => $this->input->post('pk_id'),
			'start_date' => $this->input->post('start'),
			'end_date' => $this->input->post('end'),
			'psb' => $psb,
			'dismantle' => $dismantle,
			'ctdDate' => date('Y-m-d'),
			'ctdBy' => $this->session->userdata('karyawan_id')
		],['pk_id' => $this->input->post('pk_id')]);


			$xc = [];	
			foreach ($this->input->post('pekerjaan') as $key => $value) {

				$this->db->insert('timeline_task', [
					'pk_id' => $this->input->post('pk_id'),
					'task_name' => $value,
					'start_date' => @$this->input->post('start_date')[$x],
					'end_date' => @$this->input->post('end_date')[$x],
					'ket' => @$this->input->post('ket')[$x],
					'kategori' => @$this->input->post('kategori')[$x],
					'ctdDate' => date('Y-m-d'),
					'ctdBy' => $this->session->userdata('karyawan_id')
				]);

				$psb = [];
				foreach ($this->input->post('xpsb') as $xc) {
					$device_id = array_keys($xc)[0];
					$psb[] = [
						'device_id' => $device_id,
						'pk_id' => $this->input->post('pk_id'),
						'jml' => $xc[$device_id]
					];
				}

				$dismantle = [];
				foreach ($this->input->post('xdismantle') as $xc) {
					$device_id = array_keys($xc)[0];
					$dismantle[] = [
						'device_id' => $device_id,
						'pk_id' => $this->input->post('pk_id'),
						'jml' => $xc[$device_id]
					];
				}
			}

			if(@count($psb) > 0 ) $this->db->insert_batch('timeline_psb', $psb);
			if(@count($dismantle) > 0 ) $this->db->insert_batch('timeline_dismantle', $dismantle);
	
		$dataaa = [
			'msg' => "Berhasil menambahkan timeline",
			'status' => true,
		];

		echo json_encode($dataaa);

	}

	public function project_running()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/project_running',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function pr_timeline()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/pr_timeline',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function pr_datek()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/pr_datek',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function pr_summary()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/pr_summary',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function documentation()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/documentation',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function detail_documentation()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/pm/detail_documentation',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => '',
				'data' => [
					
				]
			],
		];
		$this->load->view('_main',$d);
	}

	// Projek

	public function getProjek()
	{
		$this->pm->see = 'pk.id, p.id as pid, service';
		$data = $this->pm->getProjek('',1)->result_array();
		echo json_encode($data);
	}


	// Laporan hari

	public function laporan_hari()
	{
		$d = [
			'title' => 'Laporan Hari',
			'linkView' => 'page/pm/laporan_hari',
			'fileScript' => 'pm/laporan_hari.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	// Laporan Minggu

	public function laporan_minggu()
	{
		$d = [
			'title' => 'Laporan Minggu',
			'linkView' => 'page/pm/laporan_minggu',
			'fileScript' => 'pm/laporan_minggu.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	// Control Project

	public function control_project()
	{
		$d = [
			'title' => 'Control Project',
			'linkView' => 'page/pm/control_project',
			'fileScript' => 'pm/control_project.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dt_projek_trouble()
	{
		echo $this->pm->dt_projek_trouble();
	}

	public function dt_trouble($pk_id='')
	{
		echo ($this->pm->dt_trouble($pk_id));
	}
	
	public function detail_control_project($pk_id='')
	{
		$d = [
			'title' => 'Detail Control Project',
			'linkView' => 'page/pm/detail_control_project',
			'fileScript' => 'pm/detail_control_project.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
			'projek' => $this->pm->getProjekTrouble($pk_id)->row(),
		];
		$this->load->view('_main',$d);
	}

	public function getProjekService($id='')
    {
        $data = '';
        if ($id != '') {
            $this->pm->see = "service,p.id as idp";
           $q = $this->pm->getProjek($id)->row();
        }else{
            $this->pm->see = "service,p.id as idp";
            $q = $this->pm->getProjek()->result();
        }

        $data = [
            // 'jabatan' => $this->mj->get()->result(),
            'service' => $q,
        ];

        echo json_encode($data);
	}
	
	public function addKendala()
    {
		$this->_validate_kendala();
		$msg = 'Gagal menambahkan kendala';
		$status = false;


		$projek = $this->input->post('projek');
		$kendala = $this->input->post('kendala');

		for ($i=0; $i < count($kendala); $i++) {
			$data = [
				'pk_id' => $projek[$i],
				'ppm_id' => $projek[$i],
				'ctd_by' => @$this->session->userdata('karyawan_id'),
				'ctd_date' => date('Y-m-d'),
				'kendala' => $kendala[$i],	
			];

			$x = $this->pm->in_data_kendala($data);
		}   


		if ($x) {
			$status = true;
			$msg = "Berhasil menambahkan kendala";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);
	}
	
	private function _validate_kendala()
    {
        $data['status'] = TRUE;

        if($this->input->post('projek') == '')
        {
            $data['status'] = FALSE;
        }

        if($this->input->post('kendala') == '')
        {
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
			$data['msg'] = 'Gagal menambahkan data';
            echo json_encode($data);
            exit();
        }
    }

	// File Manager

	public function file_manager()
	{
		$d = [
			'title' => 'File Manager',
			'linkView' => 'page/pm/file_manager',
			'fileScript' => 'pm/file_manager.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
			'data' => $this->pm->getFilePm()
		];
		$this->load->view('_main',$d);
	}

	public function getProjekPm()
	{
		$this->pm->see = 'pm.id,pk.id as pkid, p.id as pid, service';
		$data = $this->pm->getProjekPm()->result_array();
		echo json_encode($data);
	}

	function getFilePM()
    {
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$get_kategori = $this->input->get('kategori');
		$get_projek = $this->input->get('projek');
		$get_cari = $this->input->get('cari');
		$get_where = $this->input->get('get_where');
		$where = $this->input->get('where');
		$status = $this->input->get('status');
        $data = $this->pm->getFilePM($get_kategori,$get_projek,$limit, $start,$get_cari,$get_where,$where,$status)->result_array();
		echo json_encode($data);
    }

	public function pilih_projek()
	{
		$d = [
			'title' => 'Pilih Projek',
			'linkView' => 'page/pm/pilih_projek',
			'fileScript' => 'pm/pilih_projek.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dt_pilih_projek()
	{
		echo $this->pm->dt_pilih_projek();
	}

	public function pilihP($id)
	{
		$data = [
            'pm' => @$this->session->userdata('karyawan_id')
        ];

		$x = $this->pm->upProj($data,['id' => $id]);

		$dataa = [
			'pk_id' => $id,
			'status' => 0,
			'ctd_by' => @$this->session->userdata('karyawan_id'),
			'ctd_date' => date('Y-m-d'),
		];

		$x = $this->pm->inProjPm($dataa);
		
		if ($x) {
			$status = true;
			$msg = "Berhasil memilih projek";
		}

		$response = [
			'msg' => $msg,
			'status' => $status
		];

		echo json_encode($response);
	}

	public function setStatus($s)
	{
		if($s == 1){
			$s = "Approval";
		  }else if ($s == 2) {
			$s = "DRM";
		  }else if ($s == 3) {
			$s = "KOM";
		  }else if ($s == 4) {
			$s = "Implementasi Projek";
		  }else if ($s == 5) {
			$s = "BAST Projek";
		  }else if ($s == 6) {
			$s = "Closed";
		  }
		return $s;
	}

	public function setStatusPm()
	{
		$msg = 'Gagal mengubah status';
		$sts = false;

		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$pk_id = $this->input->post('pk_id');
		$data = [
            'status' => $status
        ];

		$x = $this->pm->upProjPm($data,['id' => $id]);
		
		if ($x != '') {
            
			$data_history = [
				'keterangan' => 'Mengubah Status Projek menjadi '.$this->setStatus($status),
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'pk_id' => $pk_id
			];
			
			$inHistory = $this->pm->inProjekHistory($data_history);
			if ($inHistory[1] == 1) {
				$sts = true;
				$msg = "Berhasil mengubah data";
			}
			
		}else{
			$sts = false;
			$msg = "Gagal mengubah data";
		}

		$response = [
			'msg' => $msg,
			'status' => $sts
		];

		echo json_encode($response);
	}

	public function setDevision($d)
	{
		if($d == 1){
			$d = "Development";
		  }else if ($d == 2) {
			$d = "Serdev";
		  }else if ($d == 3) {
			$d = "Development & Serdev";
		  }
		return $d;
	}

	public function setDevisionPm()
	{
		$msg = 'Gagal mengubah devision';
		$sts = true ;

		$devision = $this->input->post('devision');
		$id = $this->input->post('id');
		$data = [
            'work_devision' => $devision
        ];

		if ($devision == 2 && $devision == 3) {
			$this->in_wo_serdev($id);
		}
		$x = $this->pm->upProj($data,['id' => $id]);
		
		if ($x != '') {
            
			$data_history = [
				'keterangan' => 'Mengubah Devision menjadi '.$this->setDevision($devision),
				'ctdDate' => date('Y-m-d H:i:s'),
				'ctdBy' => $this->session->userdata('karyawan_id'),
				'pk_id' => $id
			];
			
			$inHistory = $this->pm->inProjekHistory($data_history);
			if ($inHistory[1] == 1) {
				$sts = true;
				$msg = "Berhasil mengubah devision";
			}
			
		}else{
			$sts = false;
			$msg = "Gagal mengubah devision";
		}
		
		$response = [
			'msg' => $msg,
			'status' => $sts
		];

		echo json_encode($response);
	}
	
	public function in_wo_serdev($pk_id='')
	{
		$this->load->model('MSerdev','msd');
		$this->load->model('MNotif','notif');
		$this->load->model('MKaryawan','mk');
		
			$wo = [
				'status' => '1',
				'qty' => 0,
				'pk_id' => $pk_id
			];
			
			$cek_wo = $this->msd->get_wo('',['pk_id' => $pk_id]); 
			if ($cek_wo->num_rows() == 0) {
				
				$this->msd->in_wo($wo);
				$id_wo = $this->db->insert_id();
				
				$this->notif->inNotif(
					'New Projek',
					$this->session->userdata('karyawan_id'),
					$this->mk->get('',['jabatan_id' => '36'])->row()->id,
					'<span class="label label-info">'.'New Projek'.'</span></br>Ada projek baru dengan ID <b><u>'.$id_wo.'</u></b>',
					'Serdev/detail_project_new?id='.$id_wo);
			}
		
	}


	public function total_all()
	{
		$task = 0;
		$complete = 0;
		$progress = 0;
		$pending = 0;
		$persentase = 0;

		$s = $this->sdv_total(true);
		$d = $this->dev_total(true);
		$devision = $this->input->post('devision');
		$pk_id = $this->input->post('pk_id');
		
		if ($devision == 3) {
			$task = $s['task']+$d['task'];
			$complete = $s['complete']+$d['complete'];
			$progress = $s['progress']+$d['progress'];
			$pending = $s['pending']+$d['pending'];
			
			if($s['complete'] != 0 && $d['complete'] != 0 ) $persentase = $s['persentase']/$d['persentase']*100;
		}else if($devision == 2){
			$task = $s['task'];
			$complete = $s['complete'];
			$progress = $s['progress'];
			$pending = $s['pending'];
			
			if($s['complete'] != 0 ) $persentase = $s['persentase'];
		}else if($devision == 1){
			$task = $d['task'];
			$complete = $d['complete'];
			$progress = $d['progress'];
			$pending = $d['pending'];
			
			if($d['complete'] != 0 ) $persentase = $d['persentase'];
		}
	
		$data = [
			'task' => $task,
			'complete' => $complete,
			'progress' => $progress,
			'pending' => $pending,
			'persentase' => $persentase
		];

		echo json_encode($data);
	}

	// Detail Work Order Data Serdev

	#Total
	public function sdv_total($r=false)
	{
		$data = [];

		$pk_id = $this->input->post('pk_id');	
		$persentase = 0;

		$this->ms->see = "count(*) as jml";

		$task = $this->ms->get_total_install($pk_id)->row();
		$complete = $this->ms->get_total_install($pk_id,'','',['si.status' => '3'])->row();
		$progress = $this->ms->get_total_install($pk_id,'','',['si.status' => '1'])->row();
		$pending = $this->ms->get_total_install($pk_id,'','',['si.status' => '2'])->row();
		
		if($complete->jml != '0') $persentase = ($complete->jml/$task->jml*100);
		
		
		$data = [
			'task' => $task->jml,
			'complete' => $complete->jml,
			'progress' => $progress->jml,
			'pending' => $pending->jml,
			'persentase' => $persentase
		];

		if(!$r) echo json_encode($data);
		if($r) return $data;
	}

	#Datatable
	public function dt_serdev()
	{
		$pk_id = $this->input->post('pk_id');
		echo $this->ms->dt_serdev($pk_id);
	}

	// Development

	public function dev_total($r=false)
	{
		$data = [];

		// $pk_id = $this->input->post('pk_id');	
		// $persentase = 0;

		// $this->ms->see = "count(*) as jml";

		// $task = $this->ms->get_total_install($pk_id)->row();
		// $complete = $this->ms->get_total_install($pk_id,'','',['si.status' => '3'])->row();
		// $progress = $this->ms->get_total_install($pk_id,'','',['si.status' => '1'])->row();
		// $pending = $this->ms->get_total_install($pk_id,'','',['si.status' => '2'])->row();
		
		// if($complete->jml != '0') $persentase = ($complete->jml/$task->jml*100);
		
		
		$data = [
			'task' => 0,
			'complete' => 0,
			'progress' => 0,
			'pending' => 0,
			'persentase' => 0
		];

		if(!$r) echo json_encode($data);
		if($r) return $data;
	}
}
