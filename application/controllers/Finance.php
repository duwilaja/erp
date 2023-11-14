
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MKaryawan','mk');
		$this->load->model('MUsers','mu');
		$this->load->model('MJabatan','mj');
		$this->load->model('MFinance','mf');
	}
    
    public function finance()
	{
		$d = [
			'title' => 'Daftar Pengeluaran',
			'linkView' => 'page/finance/finance',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => 'Daftar Pengeluaran',
				'data' => [
					['nama' => 'Daftar Pengeluaran','link' => site_url('main/finance'),'active' => ''],
					['nama' => 'Tambah Pengeluaran','link' => site_url('main/tambah_finance'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function tambah_finance()
	{
		$d = [
			'title' => 'Tambah 	Pengeluaran',
			'linkView' => 'page/finance/tambah_finance',
			'fileScript' => 'tambah_finance.js',
			'bread' => [
				'nama' => 'Tambah Pengeluaran',
				'data' => [
					['nama' => 'Daftar Pengeluaran','link' => site_url('main/finance'),'active' => ''],
					['nama' => 'Tambah Pengeluaran','link' => site_url('main/tambah_finance'),'active' => 'active'],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function reimburse()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/reimburse',
			// 'linkView' => 'fixing',
			'fileScript' => 'finance/reimburse.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}
	

	public function reimburse_all()
	{
		// if ($this->session->userdata('leader_id') == 0 ) return redirect($_SERVER['HTTP_REFERER']);
		$d = [
			'title' => '',
			'linkView' => 'page/finance/reimburse',
			// 'linkView' => 'fixing',
			'fileScript' => 'finance/reimburse_all.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}
	

	public function add_reimburse()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/add_reimburse',
			'fileScript' => 'finance/add_reimburse.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function detail_reimburse($id='')
	{
		$id =  $this->uri->segment(3);
		$dt = $this->mf->get_detail_reimburse($id);
		$d = [
			'title' => '',
			'linkView' => 'page/finance/detail_reimburse',
			'fileScript' => 'finance/detail_reimburse.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
				],
			'data' => $dt,	
		];
		$this->load->view('_main',$d);
	}

	public function budget_request()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/budget_request',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function internal()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/internal',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function project()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/project',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function project_detail()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/project_detail',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function list_receipts()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/list_receipts',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function piutang()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/piutang',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function hutang_internal()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/hutang_internal',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function hutang_vendor()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/hutang_vendor',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	public function hutang_supplier()
	{
		$d = [
			'title' => '',
			'linkView' => 'page/finance/hutang_supplier',
			'fileScript' => 'tambah_pengelauran.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
	}

	// reimburse

	public function dt_reimburse() // personal
	{
		echo $this->mf->dt(2);
	}

	public function dt_reimburse_all()
	{
		$type = '';
		if ($this->session->userdata('level') != '54') {
			$type = 1;
		}
		echo $this->mf->dt($type);
	}

	// Tambah Reimburse
	public function in_reimburse()
	{
		$upload_struk = ($this->upload_files('./data/finance/reimburse/','reimburse_',$_FILES['struk']));
		$tgl_klaim =  $this->input->post('tgl_klaim');
		$klaim =  $this->input->post('klaim');
		$keterangan =  $this->input->post('keterangan');
		$total =  $this->input->post('total');
		$other =  @$this->input->post('other');
		$pk_id =  @$this->input->post('pk_id');

		$rmb_d = [];

		$ir = $this->mf->in_reimburse([
			'other' => $other,
			'pk_id' => $pk_id,
		]);
		$fnc_r_id = $ir[1];
		
		foreach ($upload_struk as $k => $v) {
			$idr = $this->mf->in_d_reimburse([
				'fnc_r_id' => $fnc_r_id,
				'tgl_klaim' => $tgl_klaim[$k],
				'keterangan' => $keterangan[$k],
				'total' => $total[$k],
				'klaim' => $klaim[$k],
			]);

			$fnc_d_r_id = $idr[1];
			
			if ($v['filename'] != '' ) {
				$this->mf->in_d_r_struk([
					'file' => $v['filename'],
					'fnc_r_id' => $fnc_r_id,
					'fnc_d_r_id' => $fnc_d_r_id,
				]);
			}
		}

		$this->mf->in_h_reimburse([
			'pic_confirm_h' => $this->session->userdata('karyawan_id'),
			'status_confirm_h' => '',
			'pic_status' => '',
			'catatan_h' => 'Tambah reimburse baru',
			'fnc_r_id' => $fnc_r_id,
		]);
		
		$nama = $this->mk->get($this->session->userdata('karyawan_id'))->row()->nama;
		$this->bantuan->send_notif_to_leader('Pengajuan Reimburse',$nama.' mengajukan reimburse','Finance/detail_reimburse/'.$fnc_r_id);
		$this->bantuan->send_notif_to_lvl('Pengajuan Reimburse','54',$nama.' mengajukan reimburse','Finance/detail_reimburse/'.$fnc_r_id);
		echo json_encode([
			'msg' => 'Berhasil mengajukan reimburse',
			'status' => true,
			'redi' => '../Finance/reimburse'
		]);
		
	}

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'pdf|jpg|png|jpeg',
			'encrypt_name' => true,
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);
        $images = array();

		foreach ($files['name'] as $key => $image) {

            $_FILES['images[]']['name']		= $files['name'][$key];
            $_FILES['images[]']['type']		= $files['type'][$key];
            $_FILES['images[]']['tmp_name']	= $files['tmp_name'][$key];
            $_FILES['images[]']['error']	= $files['error'][$key];
            $_FILES['images[]']['size']		= $files['size'][$key];

            $config['file_name'] = $title .'_'. $image;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
				$data = $this->upload->data();
				
				$images[] = [
					'key' => $key,
					'filename' => $data['file_name'] 
				];
	
            } else {
                $images[] = [
					'key' => $key,
					'filename' => ''
				];
            }
        }

        return $images;
	}
	
	public function terima_reimburse()
	{
		$fnc_r_id = $this->input->post('fnc_r_id');
		$catatan = @$this->input->post('catatan');
		$msg = '';
		$this->mf->terima_reimburse($fnc_r_id,$catatan);

		// $this->mf->in_h_reimburse([
		// 	'catatan_h' => 'Menerima pengajuan reimburse',
		// 	'fnc_r_id' => $fnc_r_id,
		// ]);

		$karyawan_id = $this->mf->get_reimburse_id($fnc_r_id)->row()->ctdby;
		$kk = $this->mk->get_kary_n_parent($karyawan_id);
		
		if ($kk['leader_id'] == $this->session->userdata('karyawan_id')) {
			$msg = 'oleh leader';
		}else if($this->session->userdata('level') == '54'){
			$msg = 'oleh finance';
		}

		$nama = $this->mk->get($karyawan_id)->row()->nama;
		$this->bantuan->send_notif('Pengajuan Reimburse',$karyawan_id,$nama.' pengajuan anda disetujui '.$msg,'Finance/detail_reimburse/'.$fnc_r_id);

		echo json_encode([
			'msg' => "Berhasil menerima pengajuan reimburse",
			'status' => true
		]);
	}

	public function tolak_reimburse()
	{
		$fnc_r_id = $this->input->post('fnc_r_id');
		$catatan = @$this->input->post('catatan');
		$this->mf->tolak_reimburse($fnc_r_id,$catatan);

		// $this->mf->in_h_reimburse([
		// 	'catatan_h' => 'Menolak pengajuan reimburse',
		// 	'fnc_r_id' => $fnc_r_id,
		// ]);

		$karyawan_id = $this->mf->get_reimburse_id($fnc_r_id)->row()->ctdby;
		$kk = $this->mk->get_kary_n_parent($karyawan_id);
		
		if ($kk['leader_id'] == $this->session->userdata('karyawan_id')) {
			$msg = 'oleh leader';
		}else if($this->session->userdata('level') == '54'){
			$msg = 'oleh finance';
		}

		$nama = $this->mk->get($karyawan_id)->row()->nama;
		$this->bantuan->send_notif('Pengajuan Reimburse',$karyawan_id,$nama.' Pengajuan anda ditolak '.$msg,'Finance/detail_reimburse/'.$fnc_r_id);

		echo json_encode([
			'msg' => "Berhasil menolak pengajuan reimburse",
			'status' => true
		]);
	}

	// public function get_detail_reimburse($id='')
	// {
	// 	$id=2;
	// 	$this->db->select('fhr.ctddate,k.nama,frc.status_confirm,frc.pic_status');
	// 	$this->db->from('fnc_h_reimburse fhr');
	// 	$this->db->join('fnc_r_confirm frc','frc.fnc_r_id = fhr.fnc_r_id','inner');
	// 	$this->db->join('karyawan k','k.id = frc.pic_confirm','inner');
	// 	$this->db->order_by('fhr.ctddate','DESC');
	// 	$this->db->get_where('',['fhr.fnc_r_id'=>$id])->result();
	// 	echo $this->db->last_query();
	// 	die();
	// 	$id=2;
	// 	$dt = $this->mf->get_detail_reimburse($id);

	// 	foreach ($dt['history'] as $value) {
			
	// 		    echo $tanggal_history = $this->bantuan->tgl_indo($value->ctddate);
	// 			echo $nama_history = $value->nama;
	// 			$status_confirm = $value->status_confirm;
	// 			$pic_status = $value->pic_status;
	// 			echo $status_history = $this->mf->set_history_status($status_confirm,$pic_status)."<br>";
	// 	}
	// }

}
