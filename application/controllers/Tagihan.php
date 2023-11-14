<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

    private $msg = 'Tidak dapat menampilkan data';
    private $status = false;
    private $count = 0;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MTagihan','mt');
        $this->load->model('MSelma','ms');
        $this->load->library('upload');

        // if ($this->session->userdata('grp') != 8) { //Collection
        //     redirect($_SERVER['HTTP_REFERER']);
        // }
    }
    

    public function index()
    {
        //// 1 Minggu yag lalu
        // echo date('Y-m-d',strtotime('1 weeks'));

       // // 2 Bulan yag lalu
        // echo date('Y-m-d',strtotime('-2 months'));

       //Range date  
    //     $period = new DatePeriod(
    //         new DateTime('2010-10-01'),
    //         new DateInterval('P1D'),
    //         new DateTime('2010-10-05')
    //    );

    //    foreach ($period as $key => $value) {
    //     echo $value->format('Y-m-d')."<br>";     
    //    }
        
        // $jml = 0;
        // $tables = $this->db->list_tables();

        // foreach ($tables as $table)
        // {
        //     $jml += $this->db->get($table)->num_rows();
        // }

        // echo $jml;
        // $data = $this->input->get(null,TRUE);
        // if (isset($_GET('dada')) {
        //     $this->mt->add($data);
        // }

        //     if ($this->db->affected_rows() > 0) {
        //         $param = array("success" => "xx");
        //     }else{
        //         $param = array("success" => "salah");
        //     }
        //     echo json_encode($param);

        // $v = ' 4,032,017,000';
        // $rp =  stripos($v,',') ? $v  : number_format($v,0,',',',');
        // echo $rp;

        echo phpinfo();

    }
    
    public function tagihan_now()
    {
        $d = [
            'title' => 'Data Termin',
            'desk' => 'Menampilkan daftar termin pada bulan ini dan yang sudah terlewat pada bulan sebelumnya',
            'linkView' => 'page/tagihan/tagihan',
            'jsUtama' => 'tagihan/tagihan.js',
            'fileScript' => 'tagihan/tagihan_now.js',
            'datajml' => [
                'total_estimasi' => torp($this->mt->getJmlTgh('','2',date('Y-m-d'))),
                'total_terbayar' => torp($this->mt->getJmlTgh(3,'2',date('Y-m-d'))),
            ],
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function tagihan_next()
    {
        $d = [
            'title' => 'Data Termin Bulan Depan',
            'desk' => 'Menampilkan data termin pada bulan depan',
            'linkView' => 'page/tagihan/tagihan',
            'jsUtama' => 'tagihan/tagihan.js',
            'fileScript' => 'tagihan/tagihan_next.js',
            'datajml' => [
                'total_estimasi' => torp($this->mt->getJmlTgh('','2',date('Y-m-d',strtotime('first day of +1 month')))),
                'total_terbayar' => torp($this->mt->getJmlTgh(3,'2',date('Y-m-d',strtotime('first day of +1 month')))),
            ],
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function tagihan_aktif()
    {
        $d = [
            'title' => 'Projek Aktif',
            'desk' => 'Menampilkan data projek untuk termin yang masih berjalan',
            'linkView' => 'page/tagihan/tagihan_aktif_non',
			'fileScript' => 'tagihan/tagihan_aktif.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function tagihan_tidak_aktif()
    {
        $d = [
            'title' => 'Projek Tidak Aktif',
            'desk' => 'Menampilkan data projek untuk termin yang sudah tidak berjalan',
            'linkView' => 'page/tagihan/tagihan_aktif_non',
			'fileScript' => 'tagihan/tagihan_non_aktif.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    // Laporan Per Devisi
    public function laporan_data()
    {
        $d = [
			'title' => 'Laporan Data',
            'linkView' => 'page/tagihan/laporan_data',
            'jsUtama' => 'tagihan/tagihan.js',
			'fileScript' => 'tagihan/laporan_data.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    public function pengaturan()
    {
        $d = [
            'title' => 'Peraturan',
            'desk' => 'Peratorang monitoraing tagihan',
            'linkView' => 'page/tagihan/pengaturan',
			'fileScript' => 'tagihan/pengaturan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('main/finance'),'active' => ''],
				]
			]
		];
		$this->load->view('_main',$d);
    }

    // Detail Tagihan
    public function detail_tagihan($p_id='',$tlid='')
    {
        $this->mt->see = "*,tl.status as tlstatus,tl.ket as tlket,p.ket as ket,p.status as status,tl.terhutang,tl.terbayar";
        $getTgh = $this->mt->getTghId($p_id,$tlid);
        
        if ($getTgh->num_rows() == 0) {
            redirect($_SERVER['HTTP_REFERER']);
            exit;
        }

        $dt = $getTgh->row();

        $status = $dt->tlstatus;

        $ket = $dt->tlket;
        if ($ket == '') {
            $ket = $dt->ket;
        }

        // Dokumen projek
        $this->mt->see = "jl";
        $dok = $this->projek_dok_bygroup($p_id,$tlid)[0];

        $detailTgh = [
            'service' => $dt->service,
            'customer' => $dt->customer,
            'custend' => $dt->custend,
            'total' => $dt->total,
            'tglsubmit' => $dt->tglsubmit,
            'masa_kontrak' => $dt->masa_kontrak,
            'terbayar' => (float) $dt->terbayar,
            'terhutang' => (float) $dt->terhutang,
            'total_kon_ppn' => $dt->total_kon_ppn,
            'ket' => $ket,
            'dok' => $dok,
            'st' => $status,
            'status' => $this->mt->getStatusTgh($status)
        ];

        $d = [
			'title' => 'Detail Tagihan',
			'linkView' => 'page/tagihan/detail_tagihan',
			'fileScript' => 'tagihan/detail_tagihan.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => ''],
				]
            ],
            'detailTgh'=> $detailTgh,
            'jenisLamp' => $this->mt->getJenisLamp()->result()
		];
		$this->load->view('_main',$d);
    }    

    public function detail_projek($id='')
    {
        if($this->ms->getProjek($id)->num_rows() == 0) show_404();
            $d = [
                'title' => 'Detail Projek',
                'linkView' => 'page/tagihan/detail_projek',
                'fileScript' => 'tagihan/detail_projek.js',
                'dt' => $this->mt->getProjekTgh($id),
                'bread' => [
                    'nama' => '',
                    'data' => [
                        ['nama' => '','link' => '','active' => ''],
                    ]
                ],
                'jenisLamp' => $this->mt->getJenisLamp()->result()
            ];
            $this->load->view('_main',$d);
    }

    public function getDetailProjekTgh()
    {
        $data = [];
        $id = $this->input->get('id');
        $q = $this->mt->getProjekTgh($id);        
        if (count($q) > 0) {
            $data = [
                'projek_id' => $q['projek_id'],
                'no_kontrak' => $q['no_kontrak'],
                'masa_kontrak' => $q['masa_kontrak'],
                'nominal' => $q['tt'],
                'start_date' => $q['start_date'],
                'end_date' => $q['end_date']
            ];
        }

        echo json_encode($data);
    }

    public function upDetailProjekTgh()
    {
   
        //  $key = array_keys($this->input->post());
    //  foreach ($key as $v) {
    //     $s = (string)$v;
    //      echo "$".$s." = ".'$'."this->input->post('".$s."');<br>";
    //   }

      $msg = 'Gagal Mengoperasikan Fitur';
      $status = false;
      $tl = [];
      $msg1 = '';

      $id = $this->input->post('id');
      $masa_kontrak = $this->input->post('masa_kontrak');
      $total_kon_ppn = $this->input->post('total_kon_ppn');
      $start_date = $this->input->post('start_date');
      $end_date = $this->input->post('end_date');
      $nilai = $this->input->post('nilai');

      $bulan = $this->input->post('bulan');
      $tagihan = $this->input->post('tagihan');

      $pk = [
        'masa_kontrak' => $masa_kontrak,
        'total_kon_ppn' => $total_kon_ppn,
        'start_date' => $start_date,
        'end_date' => $end_date,
      ];

      $total = $this->input->post('tagihan');

      $inKontrak = $this->db->update('projek_kontrak',$pk,['projek_id' => $id]);
      $jmlink = $this->db->affected_rows();

      $msg = 'Berhasil mengubah tagihan';
      $status = true;
      
      if ($nilai > 0) {
          foreach ($bulan as $k => $v) {
            $bulanTgh = $v.'-01';
              $tgh = [
                  'projek_id' => $id,
                  'ctdDate' => date('Y-m-d'),
                  'tghDate' => $bulanTgh,
                  'total' => $total[$k],
                  'ctdBy' => $this->session->userdata('karyawan_id')
              ];
              array_push($tl,$tgh);
          }
          $this->db->insert_batch('tgh_list', $tl);
          if ($this->db->affected_rows() > 0) {
              if ($jmlink > 0 ) { 
                  $msg = "Berhasil mengubah dan  menambahkan data tagihan baru";
                  $status = true;
              }else{
                  $msg = "Berhasil menambahkan data tagihan baru";
                  $status = true;
              }
              
          }
          
      }
      
      $data = [
          'msg' => $msg,
          'status' => $status
      ];

      echo json_encode($data);

    }

    public function rmTghList($id='')
    {
      $msg = 'Gagal Menghapus Data';
      $status = false;

      $id = $this->input->post('id');

      $this->db->delete('tgh_list', ['id' => $id]);
      if ($this->db->affected_rows() > 0) {
        $msg = "Berhasil menghapus data";
        $status = true;
      }
      
      $data = [
          'msg' => $msg,
          'status' => $status
      ];

      echo json_encode($data);
    }

    // Laporan Tagihan

    public function Laporan()
    {
        $d = [
            'title' => 'Laporan Monitoring Tagihan',
            'linkView' => 'page/tagihan/laporan',
            'fileScript' => 'tagihan/laporan.js',
            'bread' => [
                'nama' => '',
                'data' => [
                    ['nama' => '','link' => '','active' => ''],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }


    // API Tagihan

    public function apiGetTgh()
    {
       $data = [];
       $mt = $this->mt; 
       $aksi = $this->input->get('aksi');
       $status =  $this->input->get('status');
       $limit =  $this->input->get('limit');
       $cari =  $this->input->get('cari');
       if ($limit == "") {
        $limit = 10;
       }

       if ($aksi == 1) {
           //Mengambil data tagihan minggu ini
           $mt->see = "p.id as projek_id,tl.terbayar,customer,pk.no_kontrak,custend,total,service,tghDate,masa_kontrak,total_kon_ppn,tl.id as tgh_list_id,tl.status,tl.terhutang,tl.ket,tl.updDate";
           $mt->lim = $limit;
           $getTgh = $mt->getTgh('3',date('Y-m-d'),$status,$cari);
           
        }elseif($aksi == 2){
            $mt->see = "p.id as projek_id,tl.terbayar,customer,pk.no_kontrak,custend,total,service,tghDate,masa_kontrak,total_kon_ppn,tl.id as tgh_list_id,tl.status,tl.terhutang,tl.ket,tl.updDate";
            $mt->lim = $limit;
            $getTgh = $mt->getTgh('2',date('Y-m-d'),$status,$cari);
       }else{
           echo ctojson();
       }

       $this->count = @$getTgh->num_rows();

       if ($this->count > 0) {
          $this->msg = "Berhasil menampilkan data Tagihan"; 
          $this->status = true;
       }
       
       foreach (@$getTgh->result() as $v) { 
        $doc = $this->mt->getProjekDoc($v->projek_id,$v->tgh_list_id)->result();
           $n = $this->db->query("SELECT sum(total) as total,sum(total-terbayar+terhutang) as sisa_tagihan FROM `tgh_list` where projek_id = ".$v->projek_id)->row();
           $tgh = [
               'projek_id' => $v->projek_id,
               'status' => $this->mt->getStatusTgh($v->status),
               'tstatus' => $v->status,
               'terhutang' => torp((float)$v->terhutang),
               'sisa_tagihan' => torp($n->sisa_tagihan),
               'ket' => $v->ket == ''? '-' : $v->ket,
               'terbayar' => $v->terbayar == '' || $v->terbayar == 0 ? '' : torp((float)$v->terbayar),
               'nterbayar' => torp((float)$v->terbayar),
               'tgh_list_id' => $v->tgh_list_id,
               'customer' => $v->customer,
               'custend' => $v->custend,
               'total' => torp($n->total),
               'tghTotal' => torp($v->total),
               'service' => character_limiter($v->service,20),
               'service2' => $v->service,
               'no_kontrak' => $v->no_kontrak,
               'tghDate' => $this->bantuan->tgl_indo($v->tghDate),
               'updDate' => $v->updDate == '0000-00-00' ? '-' : $v->updDate ,
               'masa_kontrak' => $v->masa_kontrak,
               'total_kon_ppn' => torp($v->total_kon_ppn),
               'doc' => $doc 
           ];
           array_push($data,$tgh);
       }

       echo ctojson($data,$this->status,$this->msg,$this->count);
    }

    // Tagihan Data Table

    public function dtTagihan()
    {
        $s = $this->input->post('a');
        echo $this->mt->dtTagihan($s);
    }

    // Upload Dokumen Tagihan

    public function uploadDok()
    {
        $his = '';
        $msg = [];
        $files = [];
        $data = [];
       
        $p = $this->input->post('projek_id');
        $tlid = $this->input->post('tgh_list_id');

        $file = [];
        $inp = [];

        foreach (array_keys($_FILES) as $v) {
            if (stripos($v,'@')) {
                $n = explode('@',$v);
                array_push($file,[$n[0],$n[1]]);
            }
        }

        foreach (array_keys($_POST) as $v) {
            if (stripos($v,'@')) {
                $n = explode('@',$v);
                array_push($inp,[$n[0],$n[1]]);
            }
        }

        $dir_p = './data/projek/'.$p;
        $dir_tlid = './data/projek/'.$p.'/'.$tlid;
        
        if (!file_exists($dir_p)) {
            mkdir($dir_p,0777);
        }

        if (!file_exists($dir_tlid)) {
            mkdir($dir_tlid,0777);
        }

        if (count($file) > 0) {
            foreach ($file as $k => $ok ) {
                $x = strtolower($this->input->post('namaDoc@'.$ok[1]));
                $object = ['jl' => $x];
                $q = $this->db->get_where('jenis_lamp',$object);
                if ($q->num_rows() == 0) {
                    
                    $folder = $dir_tlid.'/'.$x;
                    if (!file_exists($folder)) {
                        mkdir($folder);
                    }
                    
                    $this->db->insert('jenis_lamp', $object);
                    $jlid = $this->db->insert_id();
                    
                    $config['upload_path']          = $folder;
                    $config['allowed_types']        = 'xls|xlsx|doc|docx|pdf|zip|rar';
                    $config['encrypt_name']         = TRUE;
                    $config['max_size']             = 0;
                    $config['max_width']            = 0;
                    $config['max_height']           = 0;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('doc@'.$ok[1])){
                        $msgx = $this->upload->display_errors();
                        array_push($msg,$msgx);
                    }else{
                        $file = $this->upload->data()['file_name'];
                        $this->db->insert('projek_doc',[
                            'file' => $file,
                            'projek_id' => $p,
                            'tgh_list_id' => $tlid,
                            'jl_id' => $jlid,
                            'status' => 1,
                            'ctddate' => date('Y-m-d'),
                            'ctdBy' => $this->session->userdata('karyawan_id'),
                        ]);
                        
                        $his .= "{".$this->mt->getJenisLamp($jlid)->row()->jl." : ".$file."}";

                        $this->status = true;

                        // Ubah status menjadi on progress / tertagih
                        $this->mt->upStatusTgh($p,$tlid,1);
                        // Set Status Projek    
                        $this->mt->setStatusProjek($p); 
                    }
                }
            }
        }

        $jl = $this->mt->getJenisLamp()->result();
        foreach ($jl as $v) {
           
            $folder = $dir_tlid.'/'.$v->jl;
                    if (!file_exists($folder)) {
                        mkdir($folder);
                    }
                    
            
            $tf = $this->input->post('tf'.$v->id);
            if ($tf != '') {
                $config['upload_path']          = $folder;
                $config['allowed_types']        = 'xls|xlsx|doc|docx|pdf|zip|rar';
                $config['encrypt_name']         = TRUE;
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('f'.$v->id)){
                    $msgx = $this->upload->display_errors();
                    array_push($msg,$msgx);
                }else{
                    $file = $this->upload->data()['file_name'];
                    $this->db->insert('projek_doc',[
                        'file' => $file,
                        'projek_id' => $p,
                        'tgh_list_id' => $tlid,
                        'jl_id' => $v->id,
                        'status' => 1,
                        'ctddate' => date('Y-m-d'),
                        'ctdBy' => $this->session->userdata('karyawan_id'),
                    ]);
                    
                    $his .= "{".$this->mt->getJenisLamp($v->id)->row()->jl." : ".$file."}";

                    $this->status = true;

                    // Ubah status menjadi on progress / tertagih
                    $this->mt->upStatusTgh($p,$tlid,1);
                    // Set Status Projek    
                    $this->mt->setStatusProjek($p); 
                }
            }
        }

        if ($this->status) {
            // Insert History
            $this->mt->inProjekTghH($p,$tlid,"Dokumen diupload ".$his);
        }

        $data = [
            'msg'=> $msg,
            'files' => $files,
            'status' => $this->status
        ];

        echo json_encode($data);

    }

    // API GET -> Dokumen Projek

    public function apiGetDokProjek($p='',$tlid='')
    {
        $data = [];

        if ($p != '' && $tlid != '') {
           $this->mt->see = "jl,nma_jabatan as jabatan,file,nama,pc.ctdDate";
           $q =  $this->mt->getProjekDoc($p,$tlid);
           $this->count = $q->num_rows();
           if ($this->count > 0) {
               $this->status = true;
               $this->msg = "Berhasil mendapatkan data dari dokumen projek";

               foreach ($q->result() as $x) {
                   $d = [
                       'nama' => $x->nama,
                       'jl' => $x->jl,
                       'file' => $x->file,
                       'jabatan' => $x->jabatan,
                       'ctdDate' =>  $this->bantuan->tgl_indo($x->ctdDate) 
                   ];

                   array_push($data,$d);
               }
           }
        }

        echo ctojson($data,$this->status,$this->msg,$this->count);
    }
    
    //Menghaous file  Dokumen Projek
    public function rmFile()
    {
        $p = $this->input->post('p');
        $tlid = $this->input->post('tlid');
        $jl = $this->input->post('jl');
        $file = $this->input->post('file');
        
        $path = './data/projek/'.$p.'/'.$tlid.'/'.$jl.'/'.$file;
        $ok = @unlink($path);
        if ($ok) {
            $this->status = true;
            $this->msg = "berhasil menghapus file";
            $this->db->delete('projek_doc',['file' => $file]);

            // Insert History
            $this->mt->inProjekTghH($p,$tlid,"Dokumen ".$jl." [".$file."] Dihapus");
        }

        echo ctojson($path,$this->status,$this->msg,$this->count);
    }

    // Datatable history projek

    public function dtProjekTghH()
    {
        $p = $this->input->post('p');
        $tlid = $this->input->post('tlid');
        
        echo $this->mt->dtProjekTghH($p,$tlid);
    }

    // Ubah Status dan Keterangan Tagihan

    public function upUbahStatus()
    {
        $data = [];
        $tgl_submit = $this->input->post('tgl_submit');
        $status = 1;
        $terbayar = $this->input->post('terbayar');
        $terhutang = $this->input->post('terhutang');
        $keterangan = $this->input->post('keterangan');

        $p = $this->input->post('projek_id');
        $tlid = $this->input->post('tlid');

        if ($terhutang > 0) {
            $status = 2;
        }else{
            if ($terbayar > 0) {
                $status = 3;
            }else{
                if($tgl_submit != '' || $tgl_submit != '0000-00-00'){
                    $status = 4;
                }
            }
        }

        $obj = [
            'tglsubmit' => $tgl_submit,
            'status' => $status,
            'terbayar' => $terbayar,
            'terhutang' => $terhutang,
            'ket' => $keterangan,
        ];

        if ($p != '' && $tlid != '') {
            $q = $this->db->update('tgh_list', $obj, [
                'id ' => $tlid,
                'projek_id' => $p
            ]);
            $q1 = $this->db->affected_rows();
            $this->count = $q1;
        }

        if ($this->count > 0 ) {
           $this->msg = "Sukses ubah Terbayar, Terhutang & Keterangan";
           $this->status = true;

           // ubah updDate
           $this->mt->upStatusTghField($p,$tlid,[
            'updDate' => date('Y-m-d H:i:s')
            ]);

           // Insert History
           $this->mt->inProjekTghH($p,$tlid,"Ubah Terbayar : ".$terbayar.", Terhutang : ".$terhutang." dan Keterangan : '".$keterangan."' ");
           // Set Status Projek    
           $this->mt->setStatusProjek($p); 
        }

        echo ctojson([
            'st' => $status,
            'tterbayar' => $terbayar,
            'tterhutang' => $terhutang,
            'tglsubmit' => $this->bantuan->tgl_indo($tgl_submit),
            'ttglsubmit' => $tgl_submit,
            'terbayar' => torp((float)$terbayar),
            'terhutang' => torp((float)$terhutang),
            'status' =>  $this->mt->getStatusTgh($status),
            'ket' => $keterangan
        ],$this->status,$this->msg,$this->count);
    }

    // Get Dokumen Projek List By Group

    public function projek_dok_bygroup($p='',$tlid='',$json='')
    {
        $this->mt->see = "jl.id,jl";
        $doc = $this->mt->getProjekDoc($p,$tlid,1);
        if ($json == 1) {
           return json_encode($doc->result());
        }else{
            return [$doc->result(),$doc->num_rows()];
        }
    }

    // Get Jenis lampiran
    public function apiJl()
    {
        $in = [8,4,5,3];
        $q = $this->mt->getJenisLamp('',$in)->result();
        echo json_encode($q);
    }

    // setTerbayar

    public function setTerbayar()
    {
        $n = str_replace([',','.'],['',''],$this->input->post('n'));
        $p = $this->input->post('p');
        $tlid = $this->input->post('tlid');

        $s = $this->mt->setTerbayar($n,$tlid);
        if ($s) {
            $this->status = true;
            $this->msg = "Berhasil terbayarkan";
            // ubah updDate
            $this->mt->upStatusTghField($p,$tlid,[
                'updDate' => date('Y-m-d H:i:s')
            ]);
            
            // Insert History
            $this->mt->inProjekTghH($p,$tlid,"Sudah Terbayar ".torp((float)$n));

            // Cek pembayaran bikin ngutang atau nggak, kalau bikin ngutang input ke db
            $this->mt->cekNgutangTgh($p,$tlid,$n);

           
        }else{
            $this->msg = "Gagal terbayarkan";
        }

        $data = [
            'status' => $this->status,
            'msg' => $this->msg
        ];

        echo json_encode($data);
    }

    // DataTable Tgh list by projek

    public function dtTghList()
    {
        $projek_id = $this->input->post('projek_id');
        $status = $this->input->post('status');

        if ($projek_id != '') {
            echo $this->mt->dtTghList($projek_id,$status);
        }else{
            echo "Anda kenapa ? ";
        }
    }

    // API Get Jumlah Projek Tagihan

    public function apiJmlProjekTgh()
    {
        echo json_encode($this->mt->getJmlProjekTgh('',3));
    }

    // API Get Statistik Status

    public function ApiStatLaporan()
    {
        $date = '';
        $no = '';
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');
        
        if ($tahun != '') {
            $no = 3;
            $date = $tahun.'-'.date('m')."-01";
        }

        if ($bulan != '') {
            $no = 2;
            $date = date('Y').'-'.$bulan."-01";
        }

        if ($tahun != '' && $bulan != '') {
            $no = 32;
            $date = $tahun.'-'.$bulan."-01";
        }

        // Status
        $datax = $this->mt->getJmlProjekTgh('',3,$date);
       
        $data = [
            'status' => [$datax['jml_p_lunas'],$datax['jml_p_tidak_aktif'],$datax['jml_p_berjalan']],
            'jumlah' => [
                't_tagihan' => $datax['jml_t_tagihan']['val'],
                't_terbayar' => $datax['jml_t_terbayar']['val'],
                't_terhutang' => $datax['jml_t_terhutang']['val'],
                'max' => $datax['jml_t_tagihan']['max']
            ],
            'harga' => [
                'tagihan' => $datax['h_tagihan']['val'],
                'terhutang' => $datax['h_terhutang']['val'],
                'terbayar' => $datax['h_terbayar']['val'],
                'tertunda' => $datax['h_tertunda']['val'],
                'max' => $datax['h_tagihan']['max']
            ],
            'jml_harga' => [
                'tagihan' => torp($datax['t_tagihan']),
                'terbayar' => torp($datax['t_terbayar']),
                'terhutang' => torp($datax['t_terhutang']),
                'sisa_tagihan' => torp($datax['t_sisa_tagihan'])
            ],
            'margin' => [
                'income' => $datax['m_income']['val'],
                'lose' => $datax['m_lose']['val'],
                'max' => $datax['m_lose']['max']
            ]
        ];

        echo json_encode($data);
    }

    // Api Datatable Tagihan Laporan

    public function dtTagihanLaporan()
    {
        $tahun = $this->input->post('tahun');
        $status = $this->input->post('status');
        echo $this->mt->dtTagihanLaporan($status,$tahun);
    }

    public function addTagihan()
    {
        $data = [];
        $status = false;
        $msg = "Gagal menambahkan data tagihan";
        $projek = $this->input->post('projek');
        $bulanTgh = $this->input->post('bulan').'-01';
        $date=date_create($bulanTgh);
        $bulan  = date_format($date,"M");
        $total = $this->input->post('tagihan');

        if ($total == '' || $total < 0) {
            $msg = "Estimasi Tagihan tidak boleh kosong";
        }else{
            $qp = $this->db->get_where('projek',['id' => $projek])->num_rows();
            if ($qp > 0) {
                $this->db->where('MONTH(tghDate) = MONTH("'.$bulanTgh.'") AND YEAR(tghDate) = YEAR("'.$bulanTgh.'") AND projek_id = '.$projek);
                $byDate = $this->db->get('tgh_list t');
                if ($byDate->num_rows() < 1) {
                    $this->db->insert('tgh_list', [
                        'projek_id' => $projek,
                        'tghDate' => $bulanTgh,
                        'total' => $total,
                        'updDate' => date('Y-m-d H:i:s'),
                        'ctdDate' => date('Y-m-d')
                    ]);
                    $x = $this->db->affected_rows();
                    if ($x > 0) {
                        $status = true;
                    }
                    $msg = "Berhasil menabahkan data tagihan";
                }else{
                    $msg = "Data tagihan bulan ".$bulan." sudah ada, mohon masukan masukan data tagihan yang lain!";
                }
            }else{
                $msg = "Data Projek Kosong";
            }
        }
            
        $data = [
            'status' => $status,
            'msg' => $msg
        ];

        echo json_encode($data);
    }

    private function setTerhutangOto()
    {
        $this->mt->setTerhutangOto();
    }

    // notifikasi
    
    public function seNotifikasi()
    {
        $email = slistdata('collection.php','#emailpd');
        $pesan = slistdata('collection.php','#msgnotif');

        $data = [
            'data' =>[
                'email' => $email,
                'pesan' => $pesan
            ],
            'status' => true
        ];

        echo json_encode($data);
    }

    public function upNotifikasi()
    {
        $pemail = $this->input->post('email');
        $ppesan = $this->input->post('pesan');

        $e = implode('^',$pemail);


        $email = subahdata('collection.php','#emailpd',$e);
        $pesan = subahdata('collection.php','#msgnotif',$ppesan);

        $data = [
            'data' =>[
                'email' => $email,
                'pesan' => $pesan
            ],
            'status' => true
        ];

        echo json_encode($data);
    }

}

/* End of file Tagihan.php */
