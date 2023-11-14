<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MFinance extends CI_Model {

  //Reimburse All
  public function get_reimburse()
  {
      $q = $this->db->get('fnc_reimburse');
      return $q;
  }    

  //Get Reimburse id
  public function get_reimburse_id($id='')
  {
      if($id == '') return false;

      if ($id != '') {
          $q = $this->db->get_where('fnc_reimburse',['id' => $id]);
      }

      return $q;
  }    

  // get datatable reimburse
  public function dt($type='')
  {
      // Definisi
      $condition = [];
      $data = [];

      $CI = &get_instance();
      $CI->load->model('DataTable', 'dt');

    //   $kar = $this->get($this->session->userdata('karyawan_id'))->row();
      // Set table name
      $CI->dt->table = 'fnc_reimburse fr';
      // Set orderable column fields
      $CI->dt->column_order = [null, 'fr.tgl_pengajuan', 'k.nama','p.service',null,null,null];
      // Set searchable column fields
      $CI->dt->column_search = ['k.nama', 'p.service'];
      // Set select column fields
      $CI->dt->select = 'fr.id,fr.pk_id,fr.tgl_pengajuan,k.nama,fr.other,p.service,fr.status';
      // Set default order
      $CI->dt->order = ['fr.id' => 'desc'];

     
      $con3 = ['join','karyawan k','k.id = fr.ctdby','inner'];
      array_push($condition,$con3);
      $con3 = ['join','projek_kontrak pk','pk.id = fr.pk_id','left'];
      array_push($condition,$con3);
      $con3 = ['join','projek p','p.id = pk.projek_id','left'];
      array_push($condition,$con3);
      
      if ($type==1) { //Leader
        if ($this->session->userdata('leader') == 1) {
            $con5 = ['join','jabatan j','j.id = k.jabatan_id','inner'];
            array_push($condition,$con5);
            
            $con7 = ['where','j.parent_id',$this->session->userdata('level')];
            array_push($condition,$con7);
        }
      }else if($type==2){ //Personal
         $con7 = ['where','k.id',$this->session->userdata('karyawan_id')];
         array_push($condition,$con7);
      }
      
      //Jika type tidak di isi, maka masuknya ke finance
      
      $dataTabel = $this->dt->getRows($_POST, $condition);
      $i = $this->input->post('start');
      foreach ($dataTabel as $dt) {
          $i++;
          $data[] = array(
              $i,
              $this->bantuan->tgl_indo($dt->tgl_pengajuan),
              $dt->nama,
              $this->cek_pk($dt),
              $this->get_dr_total($dt->id),
              $this->set_status($dt->status),
              '<a href="'.site_url('Finance/detail_reimburse/').$dt->id.'" class="btn btn-dark btn-sm"><i class="far fa-eye"></i></a>'
          );
      }

      $output = array(
          "draw" => $this->input->post('draw'),
          "recordsTotal" => $this->dt->countAll($condition),
          "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
          "data" => $data,
      );

      // Output to JSON format
      return json_encode($output);
  }

  private function cek_pk($dt)
  {
    if ($dt->pk_id != '' || $dt->pk_id != 0) {
        return $dt->service;
    }else{
        return $dt->other;
    }
  }

  // function untuk ubah status

  public function set_status($status='')
  {
      if ($status == 1) {
          return '<span class="status pending">pending</span>';
      }elseif ($status == 2) {
          return '<span class="status on_progress">on progress</span>';
      }elseif ($status == 3) {
        return '<span class="status paid">paid</span>';
        return 'paid';
      }elseif ($status == 4) {
        return '<span class="status tolak">Di Tolak</span>';
      }elseif ($status == 5) {
        return '<span class="status batal">batal</span>';
      }else{
        return '<span class="status td">Tidak Diketahui</span>';
      }
  }

    // function untuk status history 

    public function set_history_status($status_confirm='',$pic_status='')
    {
        if ($status_confirm != "" && $pic_status != 0) {
            if ($status_confirm == 1 && $pic_status == 1) {
                return "Di Setujui oleh";
            }
            if ($status_confirm == 2 && $pic_status == 1) {
                return "Di Tolak oleh";
            }
            if ($status_confirm == 1 && $pic_status == 2) {
                return "Di Ketahui oleh";
            }
            if ($status_confirm == 2 && $pic_status == 2) {
                return "Di Tolak oleh";
            }
        }else{
            return "Mengajukan Reimburse";
        }
    }

  // function untuk mengambil total rembes
  public function get_dr_total($fnc_r_id='')
  {
    $total = 0; 
    $this->db->select('sum(total) as jml');
    $this->db->group_by('fnc_r_id');
    $qry_total = $this->db->get_where('fnc_d_reimburse',['fnc_r_id' => $fnc_r_id]);
    $get_total = ($qry_total->num_rows() > 0) ? $qry_total->row()->jml : $total ;

    return torp($get_total);
    

  }

  public function get_detail_reimburse($id='')
  {
    $CI = &get_instance();
    $CI->load->model('MKaryawan', 'mk');

    $dt = [];
    $diketahui = "";
    $disetujui = "";
    $tgl_pengajuan= "";
    $projek = "";
    $status = "";
    $nama = "";
    $tombol = "";
    $pic_status = "";
    $status_confirm = "";
    
    $fr = $this->db->get_where('fnc_reimburse',['id' => $id])->row();
    $x = $CI->mk->get_kary_n_parent($fr->ctdby);
    $jabatan_id = $CI->mk->get('',['id' => $this->session->userdata('karyawan_id')])->row()->jabatan_id;
    // echo $x['leader_id'];
    // echo $jabatan_id;
    // echo $fr->status;

    // if ($jabatan_id == 54  || $x['leader_id'] == $this->session->userdata('karyawan_id')) {
    //     if ($fr->status != 3 || $fr->status != 4) {
    //         $tombol = '<div class="tombol_setuju" style="position: absolute;right: 0;">
    //             <button class="btn btn-success" onclick="terima_pengajuan()">Terima</button>
    //             <button class="btn btn-danger" onclick="tolak_pengajuan()">Tolak</button>
    //         </div>';
    //     }
    // }
    $cek_approval = $this->db->get_where('fnc_r_confirm',['fnc_r_id' => $id])->result();
    foreach ($cek_approval as $value) {
        $pic_status = $value->pic_status;
        $status_confirm = $value->status_confirm;
    }
    if ($x['leader_id'] == $this->session->userdata('karyawan_id')) {
        if ($fr->status != 3 || $fr->status != 4) {
            if ($pic_status == "") {
                $tombol = '<div class="tombol_setuju" style="position: absolute;right: 0;">
                <button class="btn btn-success" onclick="terima_pengajuan()">Setuju</button>
                <button class="btn btn-danger" onclick="tolak_pengajuan()">Tolak</button>
                </div>';
            }else{
                $tombol = '';
            }
           
        }
    }

    if ($jabatan_id == 54 ) {
         if ($fr->status != 3 || $fr->status != 4) {

            if ($pic_status == 2 && $pic_status != '' && $status_confirm != '' && $status_confirm == 1) {
                $tombol = '<div class="tombol_setuju" style="position: absolute;right: 0;">
                <button class="btn btn-success" onclick="terima_pengajuan()">Setuju</button>
                <button class="btn btn-danger" onclick="tolak_pengajuan()">Tolak</button>
                </div>';
            }else{
                $tombol = '';
            }
           
        }
    }

    // pengaju reimburse
    $this->db->select('fr.id,fr.tgl_pengajuan,k.nama,p.service,fr.status');
    $this->db->from('fnc_reimburse fr');
    $this->db->join('karyawan k','k.id = fr.ctdby','inner');
    $this->db->join('projek_kontrak pk','pk.id = fr.pk_id','left');
    $this->db->join('projek p','p.id = pk.projek_id','left');
    $qry = $this->db->get_where('',['fr.id'=>$id])->result();

    foreach ($qry as $value) {
         $nama = $value->nama;
         $tgl_pengajuan =  $this->bantuan->tgl_indo($value->tgl_pengajuan);
         $projek =  $value->service;
         $status = $this->set_status($value->status);
    }

    // diketahui
    $this->db->select('k.nama');
    $this->db->from('fnc_r_confirm frc');
    $this->db->join('karyawan k','k.id = frc.pic_confirm','inner');
    $qry_diketahui = $this->db->get_where('',['frc.fnc_r_id'=>$id,'frc.pic_status'=> 2])->result();
    foreach ($qry_diketahui as $value) {
        $diketahui = $value->nama;
     }

    // disetujui
    $this->db->select('k.nama');
    $this->db->from('fnc_r_confirm frc');
    $this->db->join('karyawan k','k.id = frc.pic_confirm','inner');
    $qry_disetujui = $this->db->get_where('',['frc.fnc_r_id'=>$id,'frc.pic_status'=> 1])->result();
    foreach ($qry_disetujui as $value) {
        $disetujui = $value->nama;
     }

    // history
    // $this->db->select('fhr.ctddate,k.nama,frc.status_confirm,frc.pic_status');
    $this->db->select('fhr.ctddate,k.nama,fhr.pic_status,fhr.status_confirm_h as status_confirm');
    $this->db->from('fnc_h_reimburse fhr');
    $this->db->join('karyawan k','k.id = fhr.pic_confirm_h','inner');
    $this->db->order_by('fhr.ctddate','DESC');
    $qry_history = $this->db->get_where('',['fhr.fnc_r_id'=>$id])->result();

    $dt =[
        'reimburse'=> [
            'nama' => $nama,
            'tgl_pengajuan' => $tgl_pengajuan,
            'projek' => $projek,
            'status' => $status,
        ],
        'daftar_reimburse'=> [
            'dt_daftar' => $this->db->get_where('fnc_d_reimburse',['fnc_r_id'=>$id])->result(),
            'total_keseluruhan' =>  $this->get_dr_total($id),
        ],
        'bukti_struk'=> [
            'file' => $this->db->get_where('fnc_d_r_struk',['fnc_r_id'=>$id])->result(),
        ],
        'approval'=> [
            'diketahui' => $diketahui,
            'disetujui' => $disetujui,
        ],
        'history' => $qry_history,
        'tombol' => $tombol

    ];
    return $dt;
  }

  //tamabah reimburse
  public function in_reimburse($rmb=[])
  {
    if (!empty($rmb)) {
        $rmb['tgl_pengajuan'] = date('Y-m-d');
        $rmb['ctdtime'] = date('H:i:s');
        $rmb['ctdby'] = $this->session->userdata('karyawan_id');
        $rmb['aktif'] = 1;
        $rmb['status'] = 1;

        $this->db->insert('fnc_reimburse', $rmb);
        return [true,$this->db->insert_id()];
    }

    return [false,0];
    
  }

  public function in_d_reimburse($arr=[])
  {
     if(!empty($arr)){
        $arr['ctddate'] = date('Y-m-d');
        
        $this->db->insert('fnc_d_reimburse', $arr);
        return [true,$this->db->insert_id()];
     }

     return [false,0];
  }

  public function in_h_reimburse($h_r=[])
  {
     if(!empty($h_r)){
        $h_r['ctddate'] = date('Y-m-d');
        $h_r['ctdtime'] = date('H:i:s');
        
        $this->db->insert('fnc_h_reimburse', $h_r);
        return true;
     }

     return false;
  }

  public function in_d_r_struk($drstruk=[])
  {
     if(!empty($drstruk)){
        $drstruk['ctddate'] = date('Y-m-d');
        
        $this->db->insert('fnc_d_r_struk', $drstruk);
        return true;
     }

     return false;
  }

  public function terima_reimburse($fnc_r_id='',$catatan='')
  {
      $pic_status = 1;

      $cek_reimburse = $this->db->get_where('fnc_reimburse',['id' => $fnc_r_id])->result();
      foreach ($cek_reimburse as $value) {
            $status = $value->status;
      }
      if ($status == 2) {
         $this->db->update('fnc_reimburse', ['status' => 3],['id' => $fnc_r_id]);
      }else{
         $this->db->update('fnc_reimburse', ['status' => 2],['id' => $fnc_r_id]);
      }
     
      $k = $this->db->get_where('karyawan k', ['id' => $this->session->userdata('karyawan_id')]);
      if ($k->row()->jabatan_id != '54') {
          $pic_status  = 2;
      }


      $this->db->insert('fnc_r_confirm', [
            'fnc_r_id' => $fnc_r_id,
            'status_confirm' => '1',
            'pic_confirm' => $this->session->userdata('karyawan_id'),
            'ctddate' => date('Y-m-d'),
            'ctdtime' => date('H:i:s'),
            'pic_status' => $pic_status,
            'catatan_confirm' => $catatan
      ]);

      $this->db->insert('fnc_h_reimburse', [
        'fnc_r_id' => $fnc_r_id,
        'pic_confirm_h' => $this->session->userdata('karyawan_id'),
        'ctddate' => date('Y-m-d'),
        'ctdtime' => date('H:i:s'),
        'status_confirm_h' => '1',
        'pic_status' => $pic_status,
		'catatan_h' => 'Approve Reimburse',
      ]);
      
      return true;
  }

  public function tolak_reimburse($fnc_r_id='',$catatan='')
  {
      $pic_status = 1;
      $this->db->update('fnc_reimburse', ['status' => 4],['id' => $fnc_r_id]);
      $k = $this->db->get_where('karyawan k', ['id' => $this->session->userdata('karyawan_id')]);
      if ($k->row()->jabatan_id != '54') {
          $pic_status  = 2;
      }
      
      $this->db->insert('fnc_r_confirm', [
          'fnc_r_id' => $fnc_r_id,
          'status_confirm' => '2',
          'pic_confirm' => $this->session->userdata('karyawan_id'),
          'ctddate' => date('Y-m-d'),
          'ctdtime' => date('H:i:s'),
          'pic_status' => $pic_status,
          'catatan_confirm' => $catatan
      ]);

      $this->db->insert('fnc_h_reimburse', [
        'fnc_r_id' => $fnc_r_id,
        'pic_confirm_h' => $this->session->userdata('karyawan_id'),
        'ctddate' => date('Y-m-d'),
        'ctdtime' => date('H:i:s'),
        'status_confirm_h' => 2,
        'pic_status' => $pic_status,
		'catatan_h' => 'Tolak Reimburse',
      ]);

      return true;
  }
    
}