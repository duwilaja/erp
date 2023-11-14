  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
  class Bantuan {
    
    public $menu = '';
    private $mid = false;
    private $sid = false;
    private $f = false;
    private $pending = [];
    private $time = [];
    private $s = '';
    private $pe = 0;
    
    public function __construct() {
    
      $this->CI = &get_instance();
    
    }

    public function access($xx='',$karyawan_id='')
    {
        $r = false;
        
        $q = $this->CI->db->get_where('p_access',['karyawan_id' => $karyawan_id]);
        if ($q->num_rows() > 0) {
            $x = $q->row();
            $b = explode(',',$x->m_access_id);
            for ($i=0; $i < count($b) ; $i++) { 
              if ($xx == $b[$i]) {
                 $r = true;               
              }
            }
        }
        return $r;
    }

    public function accMenu($m='',$s='',$karyawan_id='')
    { 
      $r = false;
        
        $q = $this->CI->db->get_where('p_access',['karyawan_id' => $karyawan_id]);
        if ($q->num_rows() > 0) {
            $x = $q->row();
            
            $sub = explode(',',$x->m_access_id);
            for ($i=0; $i < count($sub) ; $i++) { 
              if ($s == $sub[$i]) {
                 $this->ids = true;               
              }
            }

            $men = explode(',',$x->sub_acc_id);
            for ($i=0; $i < count($men) ; $i++) { 
              if ($m == $men[$i]) {
                 $this->idm = true;               
              }
            }

            if ($x->leader != 1) {
              if ($this->idm && $this->ids) {
                $r = true;
              }
            }else{
              $r = true;
            }

        }
       
        return $r;
    }

    public function accFitur($m='',$s='',$karyawan_id='',$f='',$ret='')
    { 
      $r = false;
      $retx = '';
        
        $q = $this->CI->db->get_where('p_access',['karyawan_id' => $karyawan_id]);
        if ($q->num_rows() > 0) {
            $x = $q->row();
            
            $sub = explode(',',$x->m_access_id);
            for ($i=0; $i < count($sub) ; $i++) { 
              if ($s == $sub[$i]) {
                 $this->ids = true;               
              }
            }

            $men = explode(',',$x->sub_acc_id);
            for ($i=0; $i < count($men) ; $i++) { 
              if ($m == $men[$i]) {
                 $this->idm = true;               
              }
            }

            $fit = explode(',',$x->fitur);
            for ($i=0; $i < count($fit); $i++) { 
              if ($f == $fit[$i]) {
                 $this->f = true;               
              }
            }

            if ($x->leader != 1) {
              if ($this->idm && $this->ids && $this->f) {
                $r = true;
                $retx = $ret;
              }
            }else{
              $r = true;
              $retx = $ret;
            }

        }
       
        return [$r,$retx];
    }

    public function sendTeleg($chat_id='',$msg="")
    {
      $this->CI->load->model('MTeleg', 'tl');
      $tl = $this->CI->tl;;

      if ($chat_id != '' ) {
        $teleg = $tl->getApiSendMsg($chat_id,$msg);
      }else{
        $teleg = '';
      }

      return $teleg;

    }

    public function sendTelegTo($karyawan_id='',$msg="")
    {
      $teleg = false;
      $this->CI->load->model('MTeleg', 'tl');
      $this->CI->load->model('MKaryawan', 'mk');
      $tl = $this->CI->tl;;
      $mk = $this->CI->mk;;

      $mkk = $mk->get($karyawan_id);
      if ($mkk->num_rows() > 0 ) {
        $chat_id = $mkk->row()->chat_id;
        if ($chat_id != '' ) {
          $teleg = $tl->getApiSendMsg($chat_id,urlencode($msg));
        }
      }

      return $teleg;

    }

    public function sendTelegToJabatan($jabatan_id='',$msg="")
    {
      $teleg = false;
      $this->CI->load->model('MTeleg', 'tl');
      $this->CI->load->model('MKaryawan', 'mk');
      $tl = $this->CI->tl;;
      $mk = $this->CI->mk;;

      $mkk = $mk->get($jabatan_id);
      if ($mkk->num_rows() > 0 ) {
        $chat_id = $mkk->row()->chat_id;
        if ($chat_id != '' ) {
          $teleg = $tl->getApiSendMsg($chat_id,urlencode($msg));
        }
      }

      return $teleg;

    }

    public function cekMenuLevel($mode)
    {
      if ($mode != 2) {
        $this->CI->load->model('MMenu', 'm');
        
        $uri = $this->CI->uri;
        $allow = [];
        $mtarget = [];
        $starget = [];

        $allow_menu = [
          'absensi',
          'dashboard',
          'payroll',
          'hcm',
          'finance',
          'training'
        ];

        $level = $this->CI->session->userdata('level');
        $menu = $this->CI->m->menu('',$level)->result();
        foreach ($menu as $m) {
          $mt = explode('/',$m->target);
          if ($mt[0] != '') {
            array_push($mtarget,$mt[0]);
          }
          $submenu = $this->CI->m->submenu('',$m->id)->result();
          foreach ($submenu as $s) {
            $st = explode('/',$s->target);
            if ($st[0] != '') {
              array_push($starget,$st[0]);
            }
          }
        }

        $mr1 = array_merge($mtarget,$starget);
        $mr2 = array_merge($mr1,$allow_menu);
        $allow = array_unique($mr2);
        
        if (!in_array($uri->segment(1), $allow)) redirect('/');
      }

    }

    public function menu($level='',$block='',$status=1)
    {
      if ($level == '') {
         $level = $this->CI->session->userdata('level');
      }

      if ($block == '') {
        $block = $this->CI->session->userdata('karyawan_id');
      }

        $this->CI->load->model('MMenu', 'm');
        $status = false;
        $msg = "Gagal meload data menu";
        $menus = [];
        $submenus = [];

       $menu =  $this->CI->m->menu('',$level,$block,$status);
       foreach ($menu->result() as $v) {
           $submenus = []; 
           $submenu = $this->CI->m->submenu('',$v->id,$block,$status);
              foreach ($submenu->result() as $vx) {
                $sub = [
                      'id_submenu' => $vx->id,
                      'submenu' => $vx->submenu,
                      'icon' => $vx->icon == '' ? 'far fa-circle' : $vx->icon,
                      'target' =>  ($vx->target == '') ? '#' : site_url($vx->target)
                  ];

                  array_push($submenus,$sub);
              }

           $men = [
               'id_menu' => $v->id,
               'menu' => $v->menu,
               'icon' => $v->icon == '' ? 'fas fa-file-alt' : $v->icon,
               'type' => $v->type,
               'dropdown' => $v->type == 2 ? 'fas fa-angle-left' : '',
               'target' => ($v->target == '') ? base_url($this->CI->uri->uri_string()).'#' : site_url($v->target),
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
    
    public function setup_menu()
    {
       $mn = '';
       $m = $this->menu();
       $s = $m['status'];
       $d['submenu'] = [];

       $lvl = $this->CI->session->userdata('level');
       if ($lvl != '') {
         
        if ($s) {
          foreach ($m['data'] as $d) {
            
          $mn .= '<li class="nav-item has-treeview"> 
              <a href="'.$d['target'].'?'.md5('idmenuaccess').'='.base64_encode(md5($d['id_menu'])).'" class="nav-link">
                <i class="nav-icon '.$d['icon'].'"></i>
                <p>
                  '.$d['menu'].'<i class="right '.$d['dropdown'].'"></i>
                </p>
              </a>'; //li utama
              
              if (@count(@$d['submenu']) > 0 && $d['type'] == 2) { 
                $mn .= '<ul class="nav nav-treeview fn14" style="display: none;">'; //ul utama
                
                foreach ($d['submenu'] as $sub) {
                    $mn .= '<li class="nav-item has-treeview">
                        <a href="'.$sub['target'].'?'.md5('idmenuaccess').'='.base64_encode(md5($d['id_menu'])).'" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>'.$sub['submenu'].'</p>
                        </a>    
                      </li>';
                  }

                $mn .= '</ul>'; //tutup ul utama
              }
            $mn .= '</li>'; //tutup li utama
          }

          echo $mn;
        
        }else{
          echo "tidak ada";
        }
        
       }
       
    }

    public function menus()
    {
      
      $this->CI->load->model('MMenu', 'mm');
      return $this->CI->mm;
    }
    
    public function submenu_db($target='')
    {
      
      $this->CI->load->model('MMenu', 'mm');
      $m1 = $this->CI->mm->get('',['target' => $target])->row();
      $m = $this->CI->mm->get('',['induk_menu' => $m1->induk_menu,'induk_menu !=' => 0 ])->result();
      return $m;
    }
    
    public function getUser()
    {
      $data = [
        'username' => '',
        'nama' => ''
      ];
      
      $this->CI->load->model('MUsers', 'mu');
      $id = $this->CI->session->userdata('id');
      
      $q = $this->CI->mu->getUser('',['u.id' => $id]);
      
      if ($q->num_rows() > 0) {
        $q = $q->row();
        $data = [
          'username' => $q->username,
          'nama' => $q->nama
        ];
      }
      
      return $data; 
      
    }
    
    public function submenu()
    {
      $submenu = [
        ['Dashboard','main/index'],
        ['Products','main/products'],
        ['Programs','main/programs'],
        ['Sales','main/sales'],
        ['Projects','main/projek'],
        ['Cash','main/cash'],
        ['Perfomansi','main/perfomansi'],
        ['HCM','main/hcm'],
      ];
      
      return  $submenu;
    }
    
    public function cekMenu($ret='',$v1='',$v2='')
    {
      
      $this->menu = $v1[1];
      
      if ($v1==$v2) {
        return $ret;
      }else{
        return $ret.','.$v1.','.$v2;
      }
    }
    
    public function hjt($ok='',$ok2='') //Hitung jarak Tanggal
    {
      $tanggal = [];
      
      // Menghitung list tanggal dari tanggal yang sudah ditentukan sampai tanggal target
      $tm = strtotime($ok);
      $ta = strtotime($ok2);
      
      $timeDiff = abs($tm - $ta);
      
      $numberDays = $timeDiff/86400;  // 86400 seconds in one day
      
      // and you might want to convert to integer
      $numberDays = intval($numberDays);
      $lama_cuti = $numberDays;
      
      $num_lop = abs(($lama_cuti));
      array_push($tanggal,$ok);
      
      for ($i=0; $i < $num_lop ; $i++) { 
        $tm = $tm+86400;
        $time = date('Y-m-d',$tm);
        array_push($tanggal,$time);
      }
      
      return $tanggal;
    }
    
    public function htdt($ok='',$ok2='') //Hitung tanggal diantara target 
    {
      $tanggal = [];
      
      // Menghitung list tanggal dari tanggal yang sudah ditentukan sampai tanggal target
      $tm = strtotime($ok);
      $ta = strtotime($ok2);
      
      $timeDiff = abs($tm - $ta);
      
      $numberDays = $timeDiff/86400;  // 86400 seconds in one day
      
      // and you might want to convert to integer
      $numberDays = intval($numberDays);
      $lama_cuti = $numberDays+1;
      
      $num_lop = abs(($lama_cuti)-2);
      
      for ($i=0; $i < $num_lop ; $i++) { 
        $tm = $tm+86400;
        $time = date('Y-m-d',$tm);
        array_push($tanggal,$time);
      }
      
      return $tanggal;
    }

    public function tgl_indo($tanggal){
      $bulan = array (
        1=>'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
      $tgl = explode(' ',$tanggal);
      $pecahkan = explode('-', $tgl[0]);
      return @$pecahkan[2] . ' ' . @$bulan[ (int)$pecahkan[1] ] . ' ' . @$pecahkan[0]. ' ';
    }
    
    function waktu_indo($tanggal)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($tanggal));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($tanggal));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($tanggal));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($tanggal));
    $jam = date( 'H:i:s', strtotime($tanggal));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    // return "$hari, $tanggal $bulan $tahun";
    return $jam;
}

    public function salary($nilai='')
    {
      $salary = [
         'gp' => 'Gaji Pokok',
         'tf'=> 'Tunjangan Fungsional',
         'ts' => 'Tunjangan Struktural',
         't' => 'Transport',
         'bpjs_kes' => 'BPJS Kesehatan',
         'bpjs_ket' => 'BPJS Ketenaga Kerjaan',
         'pph21' => 'PPH 21',
      ];

      return $salary[$nilai];

    }

    public function penyebut($nilai='') {
      $nilai = abs($nilai);
      $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      $temp = "";
      if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
      } else if ($nilai <20) {
        $temp = $this->penyebut($nilai - 10). " belas";
      } else if ($nilai < 100) {
        $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
      } else if ($nilai < 200) {
        $temp = " seratus" . $this->penyebut($nilai - 100);
      } else if ($nilai < 1000) {
        $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
      } else if ($nilai < 2000) {
        $temp = " seribu" . $this->penyebut($nilai - 1000);
      } else if ($nilai < 1000000) {
        $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
      } else if ($nilai < 1000000000) {
        $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
      } else if ($nilai < 1000000000000) {
        $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
      } else if ($nilai < 1000000000000000) {
        $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
      }     
      return $temp;
    }
   
    public function terbilang($nilai='') {
      if($nilai<0) {
        $hasil = "minus ". trim($this->penyebut($nilai));
      } else {
        $hasil = trim($this->penyebut($nilai));
      }     		
      return $hasil;
    }

    public function bulan()
    {
      $bulan = [
        ['1','Januari'],
        ['2','Februari'],
        ['3','Maret'],
        ['4','April'],
        ['5','Mei'],
        ['6','Juni'],
        ['7','Juli'],
        ['8','Agustus'],
        ['9','September'],
        ['10','Oktober'],
        ['11','November'],
        ['12','Desember'],
      ];

      return $bulan;
    }

    public function kary_resp($jtdk='',$data_id='',$s='')
    {
      $status = false;

      $get_id = $this->CI->db->get_where('kary_respon',['data_id' => $data_id,'jtdk_id' => $jtdk]);
      $date = date('Y-m-d H:i:s');
      $r = $get_id->num_rows();
      
      if ($s == '') {
          $data = [ 
            "ckary_id" => $this->CI->session->userdata('karyawan_id'),
            "jtdk_id" => $jtdk,
            "data_id" => $data_id,
            "tgl_post" => $date,
            "status" => $s,
          ];
      }else{
        if ($s == '1') {
          $data = [ 
            "tkary_id" => $this->CI->session->userdata('karyawan_id'),
            "tgl_dtidk" => $date,
            "kalk_waktu_t" => @calcHours(@$r->tgl_post,$date),
            "status" => $s,
          ]; 
        }else if($s == '2'){
          $data = [ 
            "tkary_id" => $this->CI->session->userdata('karyawan_id'),
            "tgl_finish" => $date,
            "kalk_waktu_f" => @calcHours(@$r->tgl_dtidk,$date),
            "status" => $s
          ]; 
        }
      }

      if ($get_id->num_rows() > 0) {
        $x = $this->CI->db->update('kary_respon',$data,['data_id' => $data_id,'jtdk_id' => $jtdk]);
        if ($this->CI->db->affected_rows() > 0) {
          $status = true;
        }
      }else{
        $x = $this->CI->db->insert('kary_respon',$data);
        if ($this->CI->db->affected_rows() > 0) {
          $status = true;
        }
      }

      return $status;
    }

    // Notifiaksi

    // public function clknotif($id='',$redi='')
    // { 
    //   // $this->CI->notif->readNotif($id);
    //   return site_url($redi);
    // }

    // Time To Response
    public function ttr($id='')
    {
      $this->pe = '';
      $this->pending = [];
      $this->s = '';
      $this->time = [];

      $q = $this->CI->db->get_where('h_ticket', ['ticket_id' => $id]);
        foreach ($q->result() as $v) {

            if ($v->status == 'pending') {
                array_push($this->pending,$v->created_date);
                $this->pe = $v->created_date;
            }
            
            if ($v->status != 'pending') {
                if ($this->pe != '' && $this->s == 'pending') {
                    $ok = calc_minute($this->pe,$v->created_date);
                    array_push($this->time,$ok);
                }
            }

            $this->s = $v->status;
        }

      
        $pending = array_sum($this->time);

        $hs = calc_minute(@$q->first_row()->created_date,@$q->last_row()->created_date);
        $h = $hs-$pending;
        return $h;
    }

    public function send_notif($judul='',$to='',$pesan='',$redirect='')
    {
       $this->CI->load->model('Notif','notif');
       $this->CI->notif->inNotif(
        $judul,
        $this->CI->session->userdata('karyawan_id'),
        $to,
        '<span class="label label-info">'.$judul.'</span></br>'.$pesan,
        $redirect);
    }

    public function send_notif_to_leader($judul='',$pesan='',$redirect='')
    {
       $this->CI->load->model('Notif','notif');
       $this->CI->load->model('MKaryawan','mk');

       $to = $this->CI->mk->get_kary_n_parent($this->CI->session->userdata('karyawan_id'));

       $this->CI->notif->inNotif(
        $judul,
        $this->CI->session->userdata('karyawan_id'),
        $to['leader_id'],
        '<span class="label label-info">'.$judul.'</span></br>'.$pesan,
        $redirect);
    }

    public function send_notif_to_lvl($judul='',$lvl='',$pesan='',$redirect='')
    {
       $this->CI->load->model('Notif','notif');
       $this->CI->load->model('MKaryawan','mk');

       $id_lvl = $this->CI->mk->get('',['jabatan_id' => $lvl])->row()->id;

       $this->CI->notif->inNotif(
        $judul,
        $this->CI->session->userdata('karyawan_id'),
        $id_lvl,
        '<span class="label label-info">'.$judul.'</span></br>'.$pesan,
        $redirect);
    }
    // public function log_kendaran($pnjm_id='',$id_user='',$status='',$aktifitas='',$change_ida='',$change_idb='')
    // {
    //   $log = false;
    //   $this->CI->load->model('MKaryawan','mk');
    //   $get_nama = $this->CI->mk->get('',['id' => $id_user])->row()->nama;

    //    if ($status != 8 ) {
    //     $data = [ 
    //       "pnjm_id" => $pnjm_id,
    //       "user" => $get_nama,
    //       "status" => $status,
    //       "aktifitas" => $aktifitas
    //     ]; 
            
    //       $x = $this->CI->db->insert('pnjm_log_kendaraan',$data); 
    //       if ($this->CI->db->affected_rows() > 0) {
    //         $log = true;
    //       }
    //    }else{
    //     $data1 = [ 
    //       "pnjm_id" => $change_ida,
    //       "user" => $get_nama,
    //       "status" => $status,
    //       "aktifitas" => $aktifitas
    //     ]; 
        
    //     $x = $this->CI->db->insert('pnjm_log_kendaraan',$data1);
    //     if ($this->CI->db->affected_rows() > 0) {
    //       $log = true;
    //     } 
    //     $data2 = [ 
    //       "pnjm_id" => $change_idb,
    //       "user" => $get_nama,
    //       "status" => $status,
    //       "aktifitas" => $aktifitas
    //     ]; 
    //     $x = $this->CI->db->insert('pnjm_log_kendaraan',$data2);
    //     if ($this->CI->db->affected_rows() > 0) {
    //       $log = true;
    //     } 

    //    }
    //    return $log;
    // }

     public function log_kendaraan($pnjm_id='',$id_user='',$status='',$aktifitas='',$aktifitasa='',$aktifitasb='',$change_ida='',$change_idb='')
     {
       $log = false;
       $this->CI->load->model('MKaryawan','mk');
       $get_nama = $this->CI->mk->get('',['id' => $id_user])->row()->nama;
       if ($status != '') {
          if ($status != 8 ) {
                $data = [ 
                  "pnjm_id" => $pnjm_id,
                  "user" => $get_nama,
                  "status" => $status,
                  "aktifitas" => $aktifitas
                ]; 
                $this->CI->db->insert('pnjm_log_kendaraan',$data);
                if ($this->CI->db->affected_rows() > 0) {
                  $log = true;
                }
          }else{

              $data = array(
                array(
                        'pnjm_id' => $change_ida,
                        'user' => $get_nama,
                        'status' => $status,
                        'aktifitas' => $aktifitasa
                ),
                array(
                        'pnjm_id' => $change_idb,
                        'user' => $get_nama,
                        'status' => $status,
                        'aktifitas' => $aktifitasb
                )
             );
             $this->CI->db->insert_batch('pnjm_log_kendaraan', $data); 
              if ($this->CI->db->affected_rows() > 0) {
                $log = true;
              }
          }
       }else{
         $log = false;
       }
        
        return $log;
     }
  }