<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    private $nik_teleg = '';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MHcm','mhcm');
        $this->load->model('MTeleg','te');
        $this->load->model('MTagihan','mt');
       
    }

    public function index()
    {
        echo json_encode($this->bantuan->menu());
    }

    public function menu($level='',$block='',$status=1)
    {
        $this->load->model('MMenu','m');
        $status = false;
        $msg = "Gagal meload data menu";
        $menus = [];
        $submenus = [];

       $menu =  $this->m->menu('',$level,$status);
       foreach ($menu->result() as $v) {
           $submenu = $this->m->submenu('',$v->id,$block,$status);
           foreach ($submenu->result() as $vx) {
               $sub = [
                   'id_submenu' => $vx->id,
                   'submenu' => $vx->submenu,
                   'target' =>  $vx->target
               ];

               array_push($submenus,$sub);
           }

           $men = [
               'id_menu' => $v->id,
               'menu' => $v->menu,
               'dropdown' => $v->type,
               'target' => ($v->target == '') ? null : $v->target ,
               'submenu' => $submenus
           ];
           array_push($menus,$men);
       }

       if (count($menus) > 0) {
           $status = true;
           $msg = "sukses load data menu";
       }

       $data = [
           'status' => true,
           'msg' => $msg,
           'data' => $menus
       ];

       return $data;
    }

    public function cekTgh()
    {
        // // Setiap 2 minggu sebelum penagihan kirim notif
        $q = $this->db->query("SELECT datediff(tghDate, DATE(NOW())) as nilai FROM tgh_list WHERE datediff(tghDate, DATE(NOW())) = 14 AND YEAR(tghDate) = YEAR(NOW())");
        if ($q->num_rows() > 0) {
            $qq = $q->row();
            $col = slistdata('collection.php','#emailpd');
            $msg = slistdata('collection.php','#msgnotif')[0];
            foreach ($col as $email) {
                $this->mail($email,"Remainder Collection Juni",$msg);
            }
            log_message('info', '#success,Kirim notif ke devisi : '.$qq->nilai);
        }
        
        // Ubah status menjadi terhutang apabila terdapat invoice yang sudah lewat due date 45 hari
        $q = $this->mt->setTerhutangOto();
        log_message('info', 'Status Hutang Terubah : '.$q);
        
        $this->removeAllFile();
    }

    public function mail($email='',$subject='',$msg='')
    {
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

				$this->email->to($email);
				$this->email->from('info@matrik.co.id', 'Info Matrik');
				// $this->email->reply_to('info@matrik.co.id', 'Collection');
				$this->email->subject($subject);
				$this->email->message($msg);

			if ($this->email->send()) {
                log_message('info', 'Kirim email ke '.$email.', Berhasil');
			} else {
				log_message('error',$this->email->print_debugger());
			}

			} catch (\Throwable $th) {
				throw $th;
			}

            return true;
    }

    public function kirim_email()
    {
        $e = $this->db->get_where('email',['status' => '0'])->result();
        foreach ($e as $v) {
            $username = $v->username;
            $password = $v->password;
            $email = $v->email;

            $msg = '<p>Dear Team,<p>
            <p>Untuk memonitor jumlah pemakaian internet pada kantor, kami implementasikan Landing Page pada Wifi kantor yang akan dimulai Senin, 23 November 2020.<br>
            Berikut adalah user password yang dapat digunakan untuk login pada Landing Page,<br>
            User   : '.$username.'<br>
            Pass   : '.$password.'<br>
            </p>
            <p>Demikian, terimakasih.</p>
            Regards,<br>
            IT Operation.';

                $config = array(
                    'protocol'      => 'mail',
                    'smtp_host'     => 'mail.matrik.co.id',
                    'smtp_port'     =>  465,
                    'smtp_user'     => 'info@matrik.co.id',
                    'smtp_pass'     => 'sahrul666!.',
                    'smtp_crypto'   => 'ssl',
                    'mailtype'      => 'html',
                    'wordwrap'      => TRUE,
                    'charset'       => 'utf-8',
                    'priority'      => 1
                );

                $config['crlf'] = "\r\n";      //should be "\r\n"
                $config['newline'] = "\r\n";   //should be "\r\n"
                
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");
                
                // $this->email->attach('./uploads/persyaratan/' . $namaPdf . '.pdf');
                // $this->load->view('mail', $data);

                $this->email->to($email);
                $this->email->from('info@matrik.co.id', 'Info Matrik');
                // $this->email->reply_to('info@matrik.co.id', 'Collection');
                $this->email->subject('Implementasi Landing Page Wifi Kantor');
                $this->email->message($msg);

            if ($this->email->send()) {
                @log_message('info', 'Kirim email ke '.$email.', Berhasil');
                $this->db->update('email', ['status' => '1'],['id' => $v->id]);
            } else {
                @log_message('error',$this->email->print_debugger());
            }
        }

    }

    private function removeAllFile($path='./data/sample/')
    {
        $this->load->helper('directory');
        $map = directory_map($path);
        if ($map != '') {
            foreach ($map as $file) {
                if (file_exists('./data/sample/'.$file)) {
                    @unlink('./data/sample/'.$file);
                }
            }
        }
    }

    private function ubahData($file='',$nama_field='',$nilai_baru='')
    {
        $c = '';
        $line = null;

        if ($nama_field == '' && $file == '') return false; 
        $file = "./sample/".$file;
        $lines = file( $file , FILE_IGNORE_NEW_LINES );
        
        // Cari line
        foreach ($lines as $l => $linesx) {
            $xx = explode('|',$linesx);
            
            if ($xx[0] == $nama_field) {
                $line = $l;
                break;
            }
        }
       
        if ($line == null) return false; 
       
        $x = explode('|',$lines[$line]);
        $x[1] = $nilai_baru;
        $c .= implode('|',$x);
        $lines[$line] = $c;
        file_put_contents($file , implode( "\n", $lines ) );

        return true;
    }

    private function listData($file='',$nama_field='')
    {
        $c = '';
        $line = null;

        if ($nama_field == '' && $file == '') return false; 
        $file = "./sample/".$file;
        $lines = file( $file , FILE_IGNORE_NEW_LINES );
        
        // Cari line
        foreach ($lines as $l => $linesx) {
            $xx = explode('|',$linesx);
            
            if ($xx[0] == $nama_field) {
                $line = $l;
                break;
            }
        }
       
        if ($line == null) return false; 
       
        $x = explode('|',$lines[$line]);
        $kom = explode(',',$x[1]);
        return $kom;
    }

    public function srlen($n='')
    {
        $x = str_replace([0,1,2,3,4,5,6,7,8,9],['z%','x$','j#','k!','i`','u&','b*','a(','c)','f_'],$n);
        $okz= base64_encode($x);
        return $okz;
    }

    public function srlde($okj='')
    {
        
        $nama = base64_decode($okj);
        // Kalau banyak
        $x = str_replace(['z%','x$','j#','k!','i`','u&','b*','a(','c)','f_'],[0,1,2,3,4,5,6,7,8,9],$nama);

        return $x;
    }

    public function t()
    {
        echo json_encode($this->mt->getTgh(1,mingguDepan())->result());

        // $aksi = $this->input->get('aksi');
        // if ($aksi == "cust") {
        //     $this->db->group_by('cust_id');
        //     $q = $this->db->get('projek_2')->result();
        //     foreach ($q as $v) {
        //         if ($v->cust_id != '') {
        //          $this->db->insert('cust', [
        //              'customer' => $v->cust_id,
        //              'ctdDate' => date('Y-m-d')
        //             ]);
        //         }
        //     }
        // }else if ($aksi == "custend") {
        //     $this->db->group_by('cust_end_id');
        //     $q = $this->db->get('projek')->result();
        //     foreach ($q as $v) {
        //         if ($v->cust_end_id != '') {
        //             $this->db->insert('cust_end', [
        //                 'custend' => $v->cust_end_id,
        //                 'ctdDate' => date('Y-m-d')
        //                 ]);
        //             }
        //         }
        // }else{

            // Data Table Tagihan Aktif
            // echo $this->mt->dtTagihanAktif()();
    }

    public  function cekRegTel()
    {
        $x = $this->te->getApi('getUpdates');
        foreach ($x['data']->result as $v) {
            // echo 'id : '.$v->message->from->id.'</br>';
            // echo 'pesan : '.$v->message->text.'</br>';
            if (@$v->message) {
                $id = @$v->message->from->id;
                $m = explode('#',@$v->message->text);
                $unixtime = $v->message->date;
            }else{
                $id = @$v->edited_message->from->id;
                $m = explode('#',@$v->edited_message->text);
                $unixtime = $v->edited_message->date;
            }
            
            $time = date("Y-m-d",$unixtime);

            if ($m[0] == "REG" && $time == date('Y-m-d')) {
                $k = $this->db->get_where('karyawan',['nip' => $m[1]]);
                if ($k->num_rows() > 0) {
                    $kr = $this->db->get_where('karyawan',['nip' => $m[1],'chat_id in ("",null)']);
                    if ($kr->num_rows() > 0) {
                        $this->db->update('karyawan', ['chat_id' => $id],['nip' => $m[1]]);
                        $this->bantuan->sendTeleg($id,'Wah selamat ya <b>'.ucwords($m[2]).'</b>, sekarang akun telegram kamu udah didaftarin di Aplikasi ERM loh jadi sekarang aku udah boleh kirim notifikasi ke kamu ya, kalau begitu salam kenal ya <b>'.ucwords($m[2]).'</b> dan makasih sebelumnya  :D');
                    }else{
                        // echo "error 3 eksekusi gagal";
                    }
                }else{
                    // echo "error 2";
                }
            }else{
                // echo "ERROR 1";
            }
        }
    }

    public function teleg($ok)
    {
        $req = [
            'chat_id' => '@sahrulrizal22',
            'text' => urldecode($ok),
            'parse_mode' => 'html'
        ];
        
        echo $this->te->getApiSendMsg('sendMessage',$req,'sahru');
    }

    public function list_tabel()
	{
        $data['tabel'] = $this->db->list_tables();
        $this->load->view('lab/tabel', $data);

    }
    
    public function getKolom($t)
	{
        if ($this->db->table_exists($t))
        {
            $data['field'] = $this->db->list_fields($t);
        }else{
           echo "gak ada tabel";
        }

        $this->load->view('lab/kolom', $data);
    }

    public function cek($t)
    {
        $data = [
            'nama_controller' => 'cek',
            'nama_model' => 'mCek',
            'field' => $this->db->list_fields($t)
        ];
       $data = $this->load->view('lab/controller', $data,TRUE); 
       
       $data = str_replace('<%php','<?php',$data);

       write_file(APPPATH.'controllers/lab/'.ucfirst('nama_controller').'.php', $data);
       chmod(APPPATH.'controllers/lab/'.ucfirst('nama_controller').'.php',0777);
    }

}
