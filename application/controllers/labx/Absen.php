<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Absen extends CI_Controller {

	public $cust = '';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$PZ = range('P', 'Z');
		$AZ = range('A', 'Z');
		$BW = range('A', 'W');
		$azz = [];

		foreach ($PZ as $pz) {
			array_push($azz, $pz);
		}

		foreach ($AZ as $az) {
			array_push($azz, 'A'.$az);
		}

		foreach ($BW as $az) {
			array_push($azz, 'B'.$az);
		}

		echo json_encode($azz);
	}

	public function sendMail()
    {
		$emailtujuan = $this->input->get('email'); 
		$msg = '';

		$user = $this->db->query('SELECT u.karyawan_id,k.nip,k.nama,k.email FROM users u INNER JOIN karyawan k ON k.id = u.karyawan_id WHERE u.email not in("","null") GROUP BY u.username');

		foreach ($user->result() as $u) {
			
			$msg = 'Selamat Siang, <b>'.$u->nama.'</b>.'
					.'<p>Terkait sudah kembali diaktifkannya Aplikasi ERM, berikut kami kirimkan ulang Username dan Password baru untuk login ke aplikasi ERM melalui alamat website berikut : <a href="http://erp.matrik.co.id">erp.matrik.co.id</a></p>'
					.'<p>Username : <b>'.$u->nip.'</b></p>'
					.'<p>Password : <b>'.$this->ubahPassword($u->karyawan_id)[1].'</b></p>'
					.'<p>Terimakasih</p>';

			try {

				$config = array(
					'protocol'  	=> 'mail',
					'smtp_host' 	=> 'mail.matrik.co.id',
					'smtp_port' 	=>  465,
					'smtp_user' 	=> 'info@matrik.co.id',
					'smtp_pass' 	=> 'sahrul666!.',
					'smtp_crypto' 	=> 'ssl',
					'mailtype'  	=> 'html',
					'wordwrap'  	=> TRUE,
					'charset'   	=> 'utf-8',
					'priority'  	=> 1
				);

				$config['crlf'] = "\r\n";      //should be "\r\n"
				$config['newline'] = "\r\n";   //should be "\r\n"
				
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
				
				// $this->email->attach('./uploads/persyaratan/' . $namaPdf . '.pdf');
				// $this->load->view('mail', $data);

				$this->email->to($u->email);
				$this->email->from('info@matrik.co.id', 'Info Matrik');
				$this->email->reply_to('info@matrik.co.id', 'Info Matrik');
				$this->email->subject('Information Login ERM');
				$this->email->message($msg);

			if ($this->email->send()) {
				echo "Kirim email berhasil ".$u->email;
			} else {
				print_r($this->email->print_debugger());
			}

			} catch (\Throwable $th) {
				throw $th;
			}

			echo $msg;

		}
		
	}

	public function sendMail2()
    {
		$emailtujuan = $this->input->get('email'); 
		$msg = '';

		$user = $this->db->query('SELECT u.karyawan_id,k.nip,k.nama,k.email FROM users u INNER JOIN karyawan k ON k.id = u.karyawan_id WHERE k.id = 59  GROUP BY u.username');

		foreach ($user->result() as $u) {
			
			$msg = 'Selamat Siang, <b>'.$u->nama.'</b>.'
					.'<p>Terkait sudah kembali diaktifkannya Aplikasi ERM, berikut kami kirimkan ulang Username dan Password baru untuk login ke aplikasi ERM melalui alamat website berikut : <a href="http://erp.matrik.co.id">erp.matrik.co.id</a></p>'
					.'<p>Username : <b>'.$u->nip.'</b></p>'
					.'<p>Password : <b>'.$this->ubahPassword($u->karyawan_id)[1].'</b></p>'
					.'<p>Terimakasih</p>';

			try {

				$config = array(
					'protocol'  	=> 'mail',
					'smtp_host' 	=> 'mail.matrik.co.id',
					'smtp_port' 	=>  465,
					'smtp_user' 	=> 'info@matrik.co.id',
					'smtp_pass' 	=> 'sahrul666!.',
					'smtp_crypto' 	=> 'ssl',
					'mailtype'  	=> 'html',
					'wordwrap'  	=> TRUE,
					'charset'   	=> 'utf-8',
					'priority'  	=> 1
				);

				$config['crlf'] = "\r\n";      //should be "\r\n"
				$config['newline'] = "\r\n";   //should be "\r\n"
				
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
				
				// $this->email->attach('./uploads/persyaratan/' . $namaPdf . '.pdf');
				// $this->load->view('mail', $data);

				$this->email->to($u->email);
				$this->email->from('info@matrik.co.id', 'Info Matrik');
				$this->email->reply_to('info@matrik.co.id', 'Info Matrik');
				$this->email->subject('Information Login ERM');
				$this->email->message($msg);

			if ($this->email->send()) {
				echo "Kirim email berhasil ".$u->email;
			} else {
				print_r($this->email->print_debugger());
			}

			} catch (\Throwable $th) {
				throw $th;
			}

			echo $msg;

		}
		
	}
	
	public function ubahPassword($karyawanId='')
	{
		$pass = $this->randomNumber();
		$q = $this->db->update('users',['password' => md5($pass)],['karyawan_id' => $karyawanId]);
		return [$q,$pass];
	}

	public function randomNumber()
	{
		$id = '';
			for ($i = 1; $i <= 6; $i++) {
				$id .= rand(0,9);
			}
		return  $id;
	}

	public function impGaji()
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Upload
		// $this->filename = $this->upload();	
		$h_salary = [];
		$gtk = [];

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('./data/sample/gaji.xlsx'); // Load file yang telah diupload ke folder excel
		$getSheet = $loadexcel->getSheetNames();
        foreach ($getSheet as $rows) {
			
			if ($rows == "Jan ") {

				$sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
				$data = [];
				$numrow = 1;
				foreach ($sheet as $row) {

					if ($numrow > 2) {
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
						$pinjaman = $loadexcel->getSheet(0)->getCell('AG'.$numrow)->getCalculatedValue(); //potongan pinjaman
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
							'tgl_transfer' => date('Y-m-d H:i:s'),
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
		// Redirect ke halaman awal (ke controller siswa fungsi index)
		$this->db->insert_batch('h_salary', $h_salary);
		
        echo json_encode('ok');
	}
	
	public function tc()
    {
		$aksi = $this->input->get('aksi');
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		// Customer
		$custArr = [];

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('./data/sample/cl.xlsx'); // Load file yang telah diupload ke folder excel
		$getSheet = $loadexcel->getSheetNames();
        foreach ($getSheet as $rows) {
			if ($rows == "Resume 2016 - 2019") {
			
				$sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
				$data = [];
				$numrow = 1;
				$tgh = [];

				
				
				foreach ($sheet as $row) {
				
				
				$PZ = range('P', 'Z');
				$AZ = range('A', 'Z');
				$BW = range('A', 'W');
				$azz = [];
				$tanda = '#'.$row['A'];
				$date = [
					"2020-01-01",
					"2020-02-01",
					"2020-03-01",
					"2020-04-01",
					"2020-05-01",
					"2020-06-01",
					"2020-07-01",
					"2020-08-01",
					"2020-09-01",
					"2020-10-01",
					"2020-11-01",
					"2020-12-01",
					"2021-01-01",
					"2021-02-01",
					"2021-03-01",
					"2021-04-01",
					"2021-05-01",
					"2021-06-01",
					"2021-07-01",
					"2021-08-01",
					"2021-09-01",
					"2021-10-01",
					"2021-11-01",
					"2021-12-01",
					"2022-01-01",
					"2022-02-01",
					"2022-03-01",
					"2022-04-01",
					"2022-05-01",
					"2022-06-01",
					"2022-07-01",
					"2022-08-01",
					"2022-09-01",
					"2022-10-01",
					"2022-11-01",
					"2022-12-01",
					"2023-01-01",
					"2023-02-01",
					"2023-03-01",
					"2023-04-01",
					"2023-05-01",
					"2023-06-01",
					"2023-07-01",
					"2023-08-01",
					"2023-09-01",
					"2023-10-01",
					"2023-11-01",
					"2023-12-01",
					"2024-01-01",
					"2024-02-01",
					"2024-03-01",
					"2024-04-01",
					"2024-05-01",
					"2024-06-01",
					"2024-07-01",
					"2024-08-01",
					"2024-09-01",
					"2024-10-01",
					"2024-11-01",
					"2024-12-01",
				];

					
					if ($numrow > 4) {

						// $gp = $loadexcel->getSheet(0)->getCell('L'.$numrow)->getOldCalculatedValue();
						// $tk = $row['O'];
						// $lembur = $loadexcel->getSheet(0)->getCell('AG'.$numrow)->getCalculatedValue();


						$cust = $row['B'];
						$cust_end = $row['C'];
						$service = $row['D'];
						$ket = $row['G'];

						$no_kontrak = $row['E'];
						$masa_kontrak = $row['H'];
						$total_kon_ppn = $row['I'];
						$sudahInvoice = $row['J']; 
						$tahun = $row['F'];

						$ctdDate = date('Y-m-d');

						if ($aksi == "db") {
							$projek = [
								'tanda' => $tanda,
								'cust_id' => $cust,
								'cust_end_id' => $cust_end,
								'service' => $service,
								'ket' => @$ket,
								'ctdDate' => $ctdDate
							];
	
							$this->db->insert('projek_2', $projek);
							$id_p = $this->db->insert_id();
	
							$kontrak = [
								'projek_id' => $id_p,
								'no_kontrak' => $no_kontrak,
								'masa_kontrak' => $masa_kontrak,
								'total_kon_ppn' => $total_kon_ppn,
								'sudah_invoice' => $sudahInvoice,
								'tahun' => $tahun,
								'ctdDate' => $ctdDate
							];
	
							$this->db->insert('projek_kontrak_2', $kontrak);
						}else if($aksi == 'tgh'){
							foreach ($PZ as $pz) {
								array_push($azz, $pz);
							}
	
							foreach ($AZ as $az) {
								array_push($azz, 'A'.$az);
							}
	
							foreach ($BW as $az) {
								array_push($azz, 'B'.$az);
							}
	
							foreach ($azz as $k => $v) {
								if ($row[$v] != '') {
									$obj = [
										'tanda' => $tanda,
										'tghDate' => $date[$k],
										'total' => $row[$v],
										'ctdDate' => $ctdDate
									];
									$this->db->insert('tgh_list', $obj);
								}
							}
						}

					}
					
					if ($numrow == 65) {
						break;
					}

					$numrow++; // Tambah 1 setiap kali looping
				}
			}
			
        }
		echo json_encode('ok');
	}
	
	public function tc2()
    {
		$aksi = $this->input->get('aksi');
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		// Customer
		$custArr = [];

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('./data/sample/cl.xlsx'); // Load file yang telah diupload ke folder excel
		$getSheet = $loadexcel->getSheetNames();
        foreach ($getSheet as $rows) {
			if ($rows == "Projek 2020") {
			
				$sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
				$data = [];
				$numrow = 1;
				$tgh = [];

				
				
				foreach ($sheet as $row) {
				
				
				$IZ = range('I', 'Z');
				$AR = range('A', 'R');
				$azz = [];
				$tanda = '#'.$row['B'];
				$date = [
					"2020-01-01",
					"2020-02-01",
					"2020-03-01",
					"2020-04-01",
					"2020-05-01",
					"2020-06-01",
					"2020-07-01",
					"2020-08-01",
					"2020-09-01",
					"2020-10-01",
					"2020-11-01",
					"2020-12-01",
					"2021-01-01",
					"2021-02-01",
					"2021-03-01",
					"2021-04-01",
					"2021-05-01",
					"2021-06-01",
					"2021-07-01",
					"2021-08-01",
					"2021-09-01",
					"2021-10-01",
					"2021-11-01",
					"2021-12-01",
					"2022-01-01",
					"2022-02-01",
					"2022-03-01",
					"2022-04-01",
					"2022-05-01",
					"2022-06-01",
					"2022-07-01",
					"2022-08-01",
					"2022-09-01",
					"2022-10-01",
					"2022-11-01",
					"2022-12-01",
				];

					if ($aksi == "cek_tgl") {
						
						foreach ($IZ as $pz) {
							array_push($azz, $pz);
						}

						foreach ($AR as $az) {
							array_push($azz, 'A'.$az);
						}

						foreach ($azz as $k => $v) {
							$invDate = $loadexcel->getActiveSheet()->getCell($v.'4')->getValue();
							array_push($tgh,date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($invDate)));
						}

					}else{

						if ($numrow > 8) {

							// $gp = $loadexcel->getSheet(0)->getCell('L'.$numrow)->getOldCalculatedValue();
							// $tk = $row['O'];
							// $lembur = $loadexcel->getSheet(0)->getCell('AG'.$numrow)->getCalculatedValue();


							// $cust = $row['B'];
							$cust_end = $row['C'];
							$service = $row['D'];
							$ket = $row['F'];

							$no_kontrak = $row['E'];
							$masa_kontrak = $row['H'];
							$total_kon_ppn = $row['G'];

							$ctdDate = date('Y-m-d');

							if ($aksi == "db") {
								$projek = [
									'tanda' => $tanda,
									'cust_end_id' => $cust_end,
									'service' => $service,
									'ket' => @$ket,
									'ctdDate' => $ctdDate
								];
		
								$this->db->insert('projek_2', $projek);
								$id_p = $this->db->insert_id();
		
								$kontrak = [
									'projek_id' => $id_p,
									'no_kontrak' => $no_kontrak,
									'masa_kontrak' => $masa_kontrak,
									'total_kon_ppn' => $total_kon_ppn,
									'ctdDate' => $ctdDate
								];
		
								$this->db->insert('projek_kontrak_2', $kontrak);
							}else if($aksi == 'tgh'){
								foreach ($IZ as $pz) {
									array_push($azz, $pz);
								}
		
								foreach ($AR as $az) {
									array_push($azz, 'A'.$az);
								}
		
								foreach ($azz as $k => $v) {
									if ($row[$v] != '') {
										$obj = [
											'tanda' => $tanda,
											'tghDate' => $date[$k],
											'total' => $row[$v],
											'ctdDate' => $ctdDate
										];
										$this->db->insert('tgh_list', $obj);
									}
								}
							}

						} //numrows > 4

					} //cek_tgl

					
					if ($numrow == 33) {
						break;
					}

					$numrow++; // Tambah 1 setiap kali looping
				}
			}
			
        }
		echo json_encode($tgh);
    }

	public function inu()
	{
		$obj = [
		'Luluk Nurhayati',
		'Irvan Wibowo W',
		'Kurnia Hadi Setiana',
		'Idris Malik Ashari',
		'Ahmad Fahmi Anwari',
		'Rini Andriani',
		'Ferly Eka Febriyani',
		'Noviyan Setiadi',
		'Erma Lestiana',
		'Risa Dewi Volikasari',
		'Silvia Yahya',
		'Fifi Ashari',
		'Della Embun Mutiara Putri',
		'Ahmad Farisy',
		'Kevin Ahmad',
		'Perima',
		'Ihsani',
		'Koswara',
		'Muhamad Ahsanul Adha Aditya P',
		'Rusmana Sidik',
		'Moch. Hafied Fajar Najiyulloh',
		'Tubagus Almer',
		'Kurniawan Akbar',
		'Idhan Khafi',
		'Teo Arif Wibowo',
		'Hery Hartanto',
		'Hery Hartanto',
		'Miqdad Abdul Malik',
		'Aep Ulwani Fatah',
		'Fatra Wicaksono',
		'Muhammad Harri Irfandy',
		'Rahmat Sofyan',
		'Hisyam Khowarik',
		'Ridho Viviyan Adam',
		'Mahesa Gilang',
		'Nisrina Salsabila',
		'Ade Putra Kurniawan',
		'Aldi Oktavian ',
		'Fauzan Nugraha Daulay',
		'Steven CH',
		'Fauzan Nugraha Daulay',
		'Faisal Ayash Fikria',
		'Adi Trikurniawan',
		'Chusnul Efendi',
		'Hengky',
		'Kamal Abdillah',
		'Nurnidiawati',
		'Yuni Dwi Wulandari',
		'Erwin Permadi',
		'Rukim'
		];


		for ($i=0; $i < count($obj) ; $i++) { 
			$c = explode(' ',$obj[$i]);
			$k = $this->db->query('SELECT * FROM karyawan k WHERE nama like "%'.$obj[$i].'%" ')->row();
			$this->db->insert('users', [
				'username' => strtolower($c[0]),
				'password' => md5(strtolower($c[0])),
				'created_date' => date('Y-m-d H:i:s'),
				'karyawan_id' => @$k->id
			]);

			echo $obj[$i];
		}

		echo "sukses kali";
	}

    public function insert()
	{
        $data = json_decode(file_get_contents("php://input"));
        
        if ($data != '') {
			$this->db->truncate('absensi');
            $this->db->insert_batch('absensi', $data);
        }
	}

	public function insert2()
	{
		$x = json_decode(file_get_contents("php://input"));
		
		foreach ($x as $r) {
			$data = [
				'nama' => $r->nama,
				'karyawan_id' => $r->karyawan_id,
				'status' => $r->status,
				'jam_masuk' => $r->jam_masuk,
				'aktif' =>$r->aktif,
				'jam_keluar' => $r->jam_keluar,
				'tanggal' => $r->tanggal,
				'jam' => $r->jam
			];

			$q = $this->db->get_where('absensi', ['tanggal' => $r->tanggal,'karyawan_id' => $r->karyawan_id]);
			
			if ($q->num_rows() < 1) {
				$this->db->insert('absensi', $data);
			}
		}

		return true;
	}

}

