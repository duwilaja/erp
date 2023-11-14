<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MKaryawan','mk');
        $this->load->model('MSetting','ms');
        $this->load->model('MLembur','ml');
    }
   
    public function dt_gj_karyawan()
    {
        echo $this->mk->dtGaji_Karyawan();
    }

    public function dt_gj_karyawan_all()
    {
        echo $this->mk->dtGaji_Karyawan_all();
    }
    
    public function data_gaji_karyawan()
	{
		$d = [
			'title' => 'My Salary History',
			'linkView' => 'page/payroll/dg_karyawan',
			'fileScript' => 'dg_karyawan.js',
			'bread' => [
				'nama' => 'My Salary History',
				'data' => [
					['nama' => 'My Salary History','link' => site_url('payroll/data_gaji_karyawan'),'active' => 'active']
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function data_gaji_karyawan_all()
	{
        $this->mk->see = 'k.id';
        $cek = 0;
        $kj = $this->mk->getKaryawanLevel(['71','54']);
        foreach ($kj->result() as $v) {
            if ($v->id == $this->session->userdata('karyawan_id')) {
                $cek = 1;
            }
        }

        if($cek == 0) redirect($_SERVER['HTTP_REFERER']);

		$d = [
			'title' => 'Salary History',
			'linkView' => 'page/payroll/dg_karyawan',
			'fileScript' => 'dg_karyawan_all.js',
			'bread' => [
				'nama' => 'Salary History',
				'data' => [
					['nama' => 'Salary History','link' => site_url('payroll/data_gaji_karyawan_all'),'active' => '']
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function uploadSlipExcel()
    {
        $err = [];
        $file = '';
        $status = false;
        $msg = "Gagal Upload Slip";
        $sheet = [];


        $config['upload_path']          = 'data/sample/';
        $config['allowed_types']        = 'xls|xlsx';
        $config['encrypt_name']         = true;
        $config['overwrite']            = true;
		$config['file_ext_tolower']     = true;
		$config['max_size']             = 0;
		$config['max_width']            = 0;
		$config['max_height']           = 0;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('slip'))
		{
            $err = $this->upload->display_errors();
		}else{
            $file  = $this->upload->data()['file_name'];
            $status = true;
            $msg = "Berhasil Upload Slip";
                $sheet = $this->renderExcelGetSheet($file);
        }
        
        $data = [
            'status' => $status,
            'err' => $err,
            'msg' => $msg,
            'data' => [
                'file' => $file,
                'sheets' => @$sheet[2]
            ]
        ];

        echo json_encode($data);
    }

    public function importSlip()
    {
        $data = [];
        $status = false;
        $msg = "Gagal import slip gaji";

        $tanggal = $this->input->post('tanggal');
        $file = $this->input->post('file');
        $sheet = $this->input->post('sheet');
        
        $x = $this->renderExcelGetSheet($file,$sheet,$tanggal);

        if ($x[0] != '') {
            $status = $x[0];
        }

        if ($x[1] != '') {
            $msg = $x[1];
        }

        if (@$x[2] != '') {
            $data = $x[2];
        }
 
        $data = [
            'data' => $data,
            'status' => $status,
            'msg' => $msg
        ];
        echo json_encode($data);
    }

    private function renderExcelGetSheet($file='',$sheetx='',$tanggal='')
    {
        $h_salary = [];
        $gtk = [];
        // var_dump();
        
        if ($file != '') {
            // Load plugin PHPExcel nya
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

            // Customer
            $arr = [];

            if ($tanggal == '') {
                $tanggal = date('Y-m-d H:i:s');
            }

            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./data/sample/'.$file); // Load file yang telah diupload ke folder excel
            $getSheet = $loadexcel->getSheetNames();
            if ($sheetx != '') {
                
                $status = false;
                $msg = "Import slip gaji gagal";

                foreach ($getSheet as $rows) {
                    if ($rows == $sheetx) {
                        $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
                        $data = [];
                        $numrow = 1;
                        foreach ($sheet as $row) {
                            if ($numrow == 2 && $row['B'] != 'NIP') {
                                return [false,"File yang anda masukan tidak sesuai dengan format yang tersedia.",''];
                                break;
                            }
                            if ($numrow > 4) {
                                if ($row['B'] != '') {
                                $gp = $loadexcel->getSheet(0)->getCell('L'.$numrow)->getOldCalculatedValue();  //sesuai gaji pokok
                                $tkah = $loadexcel->getSheet(0)->getCell('M'.$numrow)->getOldCalculatedValue(); //tunjangan keahlian
                                $tj = $loadexcel->getSheet(0)->getCell('N'.$numrow)->getOldCalculatedValue(); //tunjangan jabatan
                                $tk = $row['O']; //tunjangan khusus
                                $to = $loadexcel->getSheet(0)->getCell('P'.$numrow)->getOldCalculatedValue(); //Oprarasioanal
                                $bpjs_kes = $loadexcel->getSheet(0)->getCell('R'.$numrow)->getOldCalculatedValue(); //bpjs kesehatan
                                $bpjs_ket = $loadexcel->getSheet(0)->getCell('S'.$numrow)->getOldCalculatedValue(); // bpjs ketenagakerjaan
                                $pph21 = $loadexcel->getSheet(0)->getCell('AA'.$numrow)->getOldCalculatedValue(); //PPH21
                                $lembur = $loadexcel->getSheet(0)->getCell('AF'.$numrow)->getCalculatedValue(); //lembur
                                $ta = $loadexcel->getSheet(0)->getCell('T'.$numrow)->getCalculatedValue(); //Tunjangan Asuransi Mandiri inhealt
                                $pja = $loadexcel->getSheet(0)->getCell('AH'.$numrow)->getOldCalculatedValue(); //potongan inhealt
                                $pinjaman = $row['AG']; //potongan pinjaman
                                $karyawan_id = @$this->db->get_where('karyawan',['nip' => $row['B']])->row()->id; // nip
                                $departemen = $row['G'];
                                $grade = $row['H'];
                                $phoriz = $row['I'];
        
                                // Kalkulasi
        
                                $total_gj_kotor = $gp+$tkah+$tj+$tk+$to+$bpjs_kes+$bpjs_ket+$pph21+$lembur+$ta;
                                $total_gj_potongan = $bpjs_kes+$bpjs_ket+$pph21+$pinjaman+$ta+$pja;
                                $total_gj_bersih = $total_gj_kotor - $total_gj_potongan;
                                $total_tj = $gp+$tkah+$tj+$tk+$to;
                                $total_tj_lainnya = $bpjs_kes+$bpjs_ket+$pph21+$lembur+$ta+$pja;
                                // $total_gj_kotor = $gp+$tj+$tk+$to+$bpjs_kes+$bpjs_ket+$pph21+$lembur+$pa;
        
                                // GTK
                                $gtk_arr = array(
                                    'idslip' => $row['B'], // nip
                                    // 'no_rekening' => $row['AR'],
                                    'karyawan_id' => $karyawan_id,
                                    'bulan' => $this->bantuan->bulan(date('m'))[0][1],
                                    'tahun' => date('Y'),
                                    'tgl_transfer' => $tanggal,
                                    'created_date' => date('Y-m-d H:i:s'),
                                    'created_by' => $this->session->userdata('karyawan_id'),
                                    'total_tj' => srlen($total_tj),
                                    'total_tj_lainnya' => srlen($total_tj_lainnya),
                                    'total_gj_kotor' => srlen($total_gj_kotor),
                                    'total_gj_potongan' => srlen($total_gj_potongan),
                                    'total_gj_bersih' => srlen($total_gj_bersih),
                                );
                                
                                $this->db->insert('gaji_tf_karyawan',$gtk_arr);
                                $gtk_id = $this->db->insert_id();
        
                                // $gtk_id = 0;
        
                                $obj = array(
                                    'gp' => srlen($gp), // Gaji Pokok
                                    'tkah' => srlen($tkah), // Tunjangan khusus
                                    'tj' => srlen($tj), // Tunjangan Jabatan
                                    'tk' => srlen($tk), // Tunjangan Kesehatan
                                    'to' => srlen($to) , // Tunjangan Operasional
                                    'bpjs_kes' => srlen($bpjs_kes), // BPJS Kesehatan
                                    'bpjs_ket' => srlen($bpjs_ket), // BPJS Ketenagakerjaan
                                    'pph21' => srlen($pph21) , // PPH21
                                    'lembur' => srlen($lembur), // Lembur
                                    'ta' => srlen($ta), // Tunjangan Asuransi
                                    'pja' => srlen($pja), // Penambahan Kenaikan Tujangan Asuransi
                                    'p_gp' => srlen($gp), // Serial Number
                                    'p_tk' => srlen($tk), // Potongan Tunjangan Kesehatan
                                    'p_to' => srlen($to), // Tunjangan Oprational
                                    'p_ta' => srlen($ta), // Tunjangan Asuransi
                                    'p_bpjs_kes' => srlen($bpjs_kes), // BPJS Kesehatan
                                    'p_bpjs_ket' => srlen($bpjs_ket), // BPJS Ketenagarkerjaan
                                    'p_pph21' => srlen($pph21), // PPH21
                                    'p_pinjaman' => srlen($pinjaman), // pinjaman
                                    'p_pja' => srlen($pja), // potongan kenaikan asuransi
                                    'karyawan_id' => $karyawan_id,
                                    'created_date' => date('Y-m-d H:i:s'),
                                    'created_by' => $this->session->userdata('karyawan_id'),
                                    'total_gj_kotor' => srlen($total_gj_kotor),
                                    'total_gj_potongan' => srlen($total_gj_potongan),
                                    'total_gj_bersih' => srlen($total_gj_bersih),
                                    'gtk_id' => $gtk_id
                                );
                                
                                array_push($h_salary, $obj);
                                }
                            } 

                            $numrow++; // Tambah 1 setiap kali looping
                        }
                    }
                }

                if (count($h_salary) > 0) {
                    $msg = "Data slip gaji ".$sheetx." berhasil diimport";
                    $status = true;
                    $this->db->insert_batch('h_salary', $h_salary);
                }

                if (file_exists('./data/sample/'.$file)) {
                    @unlink('./data/sample/'.$file);
                }

                return [$status,$msg,''];
            }else{
                $msg = 'Gagal scanning data';
                $status = false;

                foreach ($getSheet as $rows) {
                    if ($rows != '') {
                        array_push($arr,['sheet' => $rows]);
                    }
                }

                if ($sheetx == '') {
                    $msg = "Tidak ada sheet yang dipilih";
                }else{
                    if (count($arr) > 0) {
                        $msg = "Scanning Sheet dari excel berhasil";
                        $status = true;
                    }
                }
                
                return [$status,$msg,$arr];

            }            
        }else{
            return [false,"Dikarenakan file kosong",''];
        }
					
    }
    
    public function detail_gj_karyawan($id='',$idx='')
	{
        $slr = $this->db->get_where('gaji_tf_karyawan',['id' => $idx,'karyawan_id' => $this->session->userdata('karyawan_id')]);
        $this->mk->see = 'k.id';
        $kj = $this->mk->getKaryawanLevel(['71','54']);
        foreach ($kj->result() as $v) {
            if ($v->id == $this->session->userdata('karyawan_id')) {
                $slr = $this->db->get_where('gaji_tf_karyawan',['id' => $idx]);
            }
        }
        
        if ($slr->num_rows() < 1) {
            $this->session->set_flashdata('error','Mohon Maaf terjadi penolakan akses saat anda memuat halaman tersebut.');
            redirect('payroll/data_gaji_karyawan');
        }else{
            $d = [
                'title' => 'Detail Salary History',
                'linkView' => 'page/payroll/detail_gj_karyawan',
                'fileScript' => 'dg_karyawan.js',
                'bread' => [
                    'nama' => '',
                    'data' => [
                        ['nama' => '','link' => site_url('payroll/data_gaji_karyawan'),'active' => '']
                    ]
                ],
                'config' => $this->ms->get()->row(),
                'tf_gaji' => $this->db->get_where('gaji_tf_karyawan',['id' => $idx])->row(),
                'karyawan' => $this->mk->getKaryawan($id)->row(),
                'salary' => $this->db->get_where('h_salary',['gtk_id' => $idx])->row(),
                'slr' => $slr->row(),
                // 'total' => number_format($total_salary,'0','.','.'),
                'terbilang' => $this->bantuan->terbilang(srlde($this->db->get_where('h_salary',['gtk_id' => $idx])->row()->total_gj_bersih)).' Rupiah'
            ];
            $this->load->view('_main',$d);
         }
        
	}

	public function lembur_karyawan()
	{
		$d = [
			'title' => 'Lembur Karyawan',
			'linkView' => 'page/payroll/lembur_karyawan',
			'fileScript' => 'lembur_karyawan.js',
			'bread' => [
				'nama' => 'Lembur Karyawan',
				'data' => [
					['nama' => 'Data Lembur Karyawan','link' => site_url('payroll/lambar_karywan'),'active' => 'active']
				]
			]
		];
		$this->load->view('_main',$d);
    }   
    
    public function tf_gaji_karyawan()
    {
        $bulan = [
            [1,'January'],
            [2,'February'],
            [3,'March'],
            [4,'April'],
            [5,'May'],
            [6,'June'],
            [7,'July'],
            [8,'August'],
            [9,'September'],
            [10,'October'],
            [11,'November'],
            [12,'December']
        ];

        $salary = [
            ['gp','Gaji Pokok'],
            ['tf','Tunjangan Fungsional'],
            ['ts','Tunjangan Struktural'],
            ['t','Transport'],
            ['bpjs_kes','BPJS Kesehatan'],
            ['bpjs_ket','BPJS Ketenaga Kerjaan'],
            ['pph21','PPH 21'],
        ];

        $potongan = [
            ['p_gp',0,'Gaji Pokok'],
            ['p_tf',0,'Tunjangan Fungsional'],
            ['p_ts',0,'Tunjangan Struktural'],
            ['p_t',0,'Transport'],
            ['p_bpjs_kes',0,'BPJS Kesehatan'],
            ['p_bpjs_ket',0,'BPJS Ketenaga Kerjaan'],
            ['p_pph21',0,'PPH 21'],
        ];
        
        $d = [
			'title' => 'Transfer Gaji Karyawan',
			'linkView' => 'page/payroll/tf_gaji_karyawan',
            'fileScript' => 'tf_gaji_karyawan.js',
            'titleForm' => 'Form Transfer Gaji Karyawan',
            'action' => 'payroll/inTf_gaji_karyawan',
			'bread' => [
				'nama' => 'Transfer Gaji Karyawan',
				'data' => [
                    ['nama' => 'Data Gaji Karyawan','link' => site_url('payroll/data_gaji_karyawan'),'active' => ''],
                    ['nama' => 'Transfer Gaji Karyawan','link' => '','active' => 'active'],
				]
            ],
            'karyawan' => $this->mk->get()->result(),
            'bulan' => $bulan,
            'salary' => $salary,
            'potongan' => $potongan,
            'lembur' => $this->getLembur()
		];
		$this->load->view('_main',$d);
    }

    public function inTf_gaji_karyawan()
    {
      
       $tf_gaji = [
        'karyawan_id' => $this->input->post('karyawan'),
        'total_tj' => $this->input->post('total_tj'),
        'total_tj_lainnya' => $this->input->post('total_tj_lainnya'),
        'total_gj_kotor' => $this->input->post('total_gj_kotor'),
        'total_gj_bersih' => $this->input->post('total_gj_bersih'),
        'total_gj_potongan' => $this->input->post('total_gj_potongan'),
        'tahun' => date('Y'),
        'bulan' => $this->input->post('bulan_tf'),
        'idslip' => $this->input->post('idslip'),
        'created_by' =>$this->session->userdata('id'),
        'created_date' => date('Y-m-d H:i:s'),
       ];
    
        //    Transfer Gaji Karyawan
        $this->mk->t = 'gaji_tf_karyawan';
        $tfGaji = $this->mk->in($tf_gaji);

       if ($tfGaji[1] == 1) {
           $gtk_id = $tfGaji[2];

            $salary = [
                'karyawan_id' => $this->input->post('karyawan'),
                'gp' => $this->input->post('gp'),
                'tj' => $this->input->post('tj'),
                'tk' => $this->input->post('tk'),
                'to' => $this->input->post('to'),
                'ta' => $this->input->post('ta'),
                'bpjs_kes' => $this->input->post('bpjs_kes'),
                'bpjs_ket' => $this->input->post('bpjs_ket'),
                'pph21' => $this->input->post('pph21'),
                'p_ta' => $this->input->post('p_ta'),
                'p_bpjs_kes' => $this->input->post('p_bpjs_kes'),
                'p_bpjs_ket' => $this->input->post('p_bpjs_ket'),
                'p_pph21' => $this->input->post('p_pph21'),
                'p_pinjaman' => $this->input->post('p_pinjaman'),
                'lembur' => $this->input->post('lembur'),
                'total_gj_kotor' => $this->input->post('total_gj_kotor'),
                'total_gj_bersih' => $this->input->post('total_gj_bersih'),
                'total_gj_potongan' => $this->input->post('total_gj_potongan'),
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('id'),         
                'gtk_id' => $gtk_id            
            ];
            
            $inSalary = $this->db->insert('h_salary',$salary);           

            if ($inSalary) {
                $this->session->set_flashdata('success', 'Data has been added');
                redirect('payroll/data_gaji_karyawan');
            }
       }

       $this->session->set_flashdata('error', "Data failed to add");
       redirect('payroll/tf_gaji_karyawan');
    
    }

    // Other

    public function getLembur($aksi=1)
    {
        $q = $this->ms->getLembur();
        if ($aksi == 1) {
            return $q;
        }elseif($aksi == 2){
            echo json_decode($q);
        }
    }

    public function penyebutUang($uang='')
    {
        echo json_encode($this->bantuan->penyebut($uang).' Rupiah');
    }
}
