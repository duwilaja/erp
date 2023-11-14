<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMInventory extends CI_Model {

    // start atasan
    public function cek_bawahan($atasan)
    {
        $this->db->select('k.id as id');
        $this->db->from('karyawan k');
        $this->db->join('jabatan j', 'j.id=k.jabatan_id','inner');
        $this->db->where('j.parent_id', $atasan);
        $query = $this->db->get()->result();
        $list_bawahan = [];
        foreach ($query as $key) {
            //  $list_bawahan[] =  $key->id;
            array_push($list_bawahan, $key->id);
        }
        return $list_bawahan;
    }

    public function cek_karyawan($id)
    {
        $this->db->select('nip,nama');
        $this->db->from('karyawan');
        $this->db->where('id', $id);
        $query = $this->db->get()->result();
        $cek_karyawan = [];
        foreach ($query as $key) {
            //  $cek_karyawan[] =  $key->id;
            // array_push($cek_karyawan, $key->nip."-".$key->nama);
            array_push($cek_karyawan,$key->nama);
        }
        return $cek_karyawan;
    }

    public function cek_barang($id)
    {
        $id_inv_req = null;
        $nama_barang = null;
        $dt_req_brg = $this->db->get_where('scm_inv_req_brng',array('id_inv_req' => $id))->result();
        foreach ($dt_req_brg as $key ) {
            $id_inv_req =  $key->id_inv_req;
        }
        $dt_mstr_brg = $this->db->get_where('scm_inv_data_mstr_brng',array('id' => $id_inv_req))->result();
        foreach ($dt_mstr_brg as $key) {
            $nama_barang = $key->nama_barang;
        }
        return $nama_barang;
    }
    public function cek_status($id)
    {
        $cek_status = " ";
        if ($id == 1) {
           $cek_status = "<span class='badge badge-pill badge-success'>Approved</span>";
        }else if ($id == 2) {
           $cek_status = "<span class='badge badge-pill badge-danger'>Rejected</span>";
        }else{
           $cek_status = "<span class='badge badge-pill badge-warning'>No Action</span>";
        }
        return $cek_status;
    }

    public function cek_to($id)
    {
        $this->db->select('ctdBy');
        $this->db->from('scm_inv_req');
        $this->db->where('id', $id);
        $query = $this->db->get()->result();
        $cek_to = null;
        foreach ($query as $key) {

            $cek_to = $key->ctdBy;
        }

        return $cek_to;
    }
    
    public function inv_dt_tbl($level)
    {
       // Definisi
       $condition = [];
       $data = [];
       $i = $this->input->post();
       $bawahan = $this->cek_bawahan($level);

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_inv_req a';
       // Set orderable column fields
       $CI->dt->column_order = ['a.id','d.nama','c.nama_barang','a.ctdDate','a.sts_action_atsn'];
       // Set searchable column fields
       $CI->dt->column_search = ['a.id','d.nama','c.nama_barang','a.ctdDate','a.sts_action_atsn'];
       // Set select column fields
       $CI->dt->select = 'a.id as id ,d.nama as nama ,c.nama_barang as nama_barang ,a.ctdDate as ctdDate,a.sts_action_atsn as sts_action_atsn';
       // Set default order
       $CI->dt->order = ['a.id' => 'asc'];

       $con = ['join','scm_inv_req_brng b','on a.id=b.id_inv_req','inner'];
       array_push($condition,$con);
       $con = ['join','scm_inv_data_mstr_brng c','b.id_inv_mstr_brng=c.id','inner'];
       array_push($condition,$con);
       $con = ['join','karyawan d','a.ctdBy=d.id','inner'];
       array_push($condition,$con);

       if ($level == 1) {
        $xar = ['where_in','a.ctdBy',$bawahan];
        array_push($condition,$xar);
       }
       if (@$i['anggota'] != '') {
        $xar = ['where','d.nama',@$i['anggota']];
        array_push($condition,$xar);
       }
       if (@$i['barang'] != '') {
        $xar = ['where','c.nama_barang',@$i['barang']];
        array_push($condition,$xar);
       }
       if (@$i['tanggal'] != '') {
        $xar = ['where','a.ctdDate',@$i['tanggal']];
        array_push($condition,$xar);
       }
       if (@$i['status'] != '') {
        $xar = ['where','a.sts_action_atsn',@$i['status']];
        array_push($condition,$xar);
       }

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            if ($dt->sts_action_atsn != null) {
                $data[] = array(
                    // $this->cek_karyawan($dt->ctdBy),
                    $dt->nama,    
                    $dt->nama_barang,
                    $dt->ctdDate,
                    $this->cek_status($dt->sts_action_atsn), 
                    '<a class="btn btn-default btn-sm" href="#" onclick="detail_ats('.$dt->id.')"><i class="fa fa-eye"></i></a>'
                );
            }else{
                $data[] = array(
                    $dt->nama,    
                    $dt->nama_barang,
                    $dt->ctdDate,
                    $this->cek_status($dt->sts_action_atsn), 
                    '<a class="btn btn-default btn-sm" href="#" value="'.$dt->id.'" onclick="edit_ats(this);"><i class="fa fa-edit"></i></a>'.
                    '<a class="btn btn-default btn-sm" href="#" onclick="detail_ats('.$dt->id.')"><i class="fa fa-eye"></i></a>'
                );

            }
        }

       $output = array(
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }
    // public function inv_dt_tbl($level)
    // {
    //             // Definisi
    //             $condition = '';
    //             $data = [];
        
    //             $CI = &get_instance();
    //             $CI->load->model('DataTable', 'dt');
        
    //             // Set table name
    //             $CI->dt->table = 'scm_inv_req';
    //             // Set orderable column fields
    //             $CI->dt->column_order = ['id','atasan','ctdUpdAtasan','ctdTimeAtasan','ctdBy','ctdDate','sts_action_atsn'];
    //             // Set searchable column fields
    //             $CI->dt->column_search = ['id','atasan','ctdUpdAtasan','ctdTimeAtasan','ctdBy','ctdDate','sts_action_atsn'];
    //             // Set select column fields
    //             $CI->dt->select = 'id,atasan,ctdUpdAtasan,ctdTimeAtasan,sts_action_atsn,ctdBy,ctdDate';
    //             // Set default order
    //             $CI->dt->order = ['id' => 'asc'];
    //             $bawahan = $this->cek_bawahan($level);
    //             $condition = [
    //                 ['where_in','ctdBy',$bawahan],
    //             ];
    //             // Fetch member's records
    //             $dataTabel = $this->dt->getRows($_POST, $condition);
        
    //             $i = $this->input->post('start');
    //             foreach ($dataTabel as $dt) {
    //                 $i++;
    //                 if ($dt->sts_action_atsn != null) {
    //                     $data[] = array(
    //                         $this->cek_karyawan($dt->ctdBy),    
    //                         $this->cek_barang($dt->id), 
    //                         $dt->ctdDate,
    //                         $this->cek_status($dt->sts_action_atsn), 
    //                         '<a class="btn btn-default btn-sm" href="#" onclick="detail_ats('.$dt->id.')"><i class="fa fa-eye"></i></a>'
    //                     );
    //                 }else{
    //                     $data[] = array(
    //                         $this->cek_karyawan($dt->ctdBy),    
    //                         $this->cek_barang($dt->id), 
    //                         $dt->ctdDate,
    //                         $this->cek_status($dt->sts_action_atsn), 
    //                         '<a class="btn btn-default btn-sm" href="#" value="'.$dt->id.'" onclick="edit_ats(this);"><i class="fa fa-edit"></i></a>'.
    //                         '<a class="btn btn-default btn-sm" href="#" onclick="detail_ats('.$dt->id.')"><i class="fa fa-eye"></i></a>'
    //                     );

    //                 }
    //             }
        
    //             $output = array(
    //                 "draw" => $this->session->userdata('draw'),
    //                 "recordsTotal" => $this->dt->countAll($condition),
    //                 "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
    //                 "data" => $data,
    //             );
        
    //             // Output to JSON format
    //             return json_encode($output);
    // }

    public function inv_total_ats($level,$status)
    {
        $bawahan = $this->cek_bawahan($level);
        $this->db->select('*');
        $this->db->from('scm_inv_req');
        $this->db->where_in('ctdBy', $bawahan);
        if ($status == 1) {
            $this->db->where('sts_action_atsn ', 1);
        }elseif ($status ==  2) {
            $this->db->where('sts_action_atsn ', 2);
        }elseif ($status ==  3) {
            $this->db->where('sts_action_atsn ', null);
        }
       
        $dt = $this->db->get()->result();
        $total = 0;
        foreach ($dt as $key) {
            $total++;
        }
        return json_encode($total);
        
    }

    public function upd_ats()
    {
        $id = $this->input->post('id_upd');
        $ctdBy = $this->session->userdata('karyawan_id');
        $ctdDate = date('Y-m-d');
        $ctdTime = date('H:i:s');
        $status = $this->input->post('status_upd');
        $catatan = $this->input->post('catatan_upd');

        // update ke tabel scm_inv_req_brng
        // * setting :
        //  catatan & status approve
        $scm_inv_req_brng = array(
            'catatan' => $catatan,
            'status' => $status
        );
        $this->db->where('id_inv_req', $id);
        $this->db->update('scm_inv_req_brng', $scm_inv_req_brng);

        //  update ke tabel scm_inv_req
        // * setting :
        //  atasan , ctdupdattasan , ctdtimeatasan , sts_action_atsn

        $scm_inv_req = array(
            'atasan' => $ctdBy,
            'ctdUpdAtasan' => $ctdDate,
            'ctdTimeAtasan' => $ctdTime,
            'sts_action_atsn' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('scm_inv_req', $scm_inv_req);


        //  insert ke tabel scm_inv_upd
        // * setting :
        //  atasan , ctdupdattasan , ctdtimeatasan , sts_action_atsn

        $scm_inv_upd = array(
            'id_scm_inv_req' => $id,
            'upd' => $status,
            'catatan' => 'Persetujuan Atasan',
            'ctdDate' => $ctdDate,
            'ctdTime' => $ctdTime,
            'ctdBy'   => $ctdBy,
            'who_sts_act' => 1
        );
    
        $this->db->set($scm_inv_upd);
        $this->db->insert('scm_inv_upd');

        // send notif ke karyawan dan admin SCM 
        $judul = "Request Permintaan Barang";
        $to = $this->cek_to($id);
        $pesan = "Pengajuan Sudah disetujui Oleh Atasan";
        $redirect_admin =  "SCM/inv_adm";
        $redirect_karyawan = "SCM/inventoryU";
        $lvl =  50; // level admin scm
        if ($status == 1) {
            $this->bantuan->send_notif($judul,$to,$pesan,$redirect_karyawan);
            $this->bantuan->send_notif_to_lvl($judul,$lvl,$pesan,$redirect_admin);
        }else{
            $this->bantuan->send_notif($judul,$to,$pesan='Pengajuan Anda Ditolak Oleh Atasan',$redirect_karyawan);
        }

        return true;

    }

    // end atasan

    public function dt_inventoryu($kid="",$aktif='1')
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_inv_req sir';
       // Set orderable column fields
       $CI->dt->column_order = [null,'k.nama','sir.ctdDate'];
       // Set searchable column fields
       $CI->dt->column_search = ['k.nama','sir.ctdDate'];
       // Set select column fields
       $CI->dt->select = 'sir.id as id,atasan,admin,ctdUpdAtasan,ctdUpdAdmin,ctdTimeAtasan,ctdTimeAdmin,sts_action_atsn,sts_action_adm,sir.aktif,k.nama,sir.ctdDate,sir.ctdTime';
       // Set default order
       
       $CI->dt->order = ['sir.id' => 'desc'];

       if ($aktif != '') {
           $con = ['where','aktif',$aktif];
           array_push($condition,$con);
       }

       if ($kid != '') {
        $con = ['where','ctdBy',$kid];
        array_push($condition,$con);
    }

       $con = ['join','karyawan k','k.id = sir.ctdBy','left'];
       array_push($condition,$con);

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->nama,
               $dt->ctdDate,
               '<a href="'.site_url('scm/detail_inventoryu?id_req=').$dt->id.'"  class="btn btn-info btn-sm"><i class="far fa-eye "></i></a>'
           );
       }

       $output = array(
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }

    public function dt_master_barang_inv()
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_inv_data_mstr_brng';
       // Set orderable column fields
       $CI->dt->column_order = [null,];
       // Set searchable column fields
       $CI->dt->column_search = [];
       // Set select column fields
       $CI->dt->select = '*';
       // Set default order
       
       $CI->dt->order = ['id' => 'desc'];

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $i,
               $dt->nama_barang,
               $dt->ctddate,
               '<a href="javascript:void(0)" onclick="modal_edit('.$dt->id.')" class="btn btn-warning btn-sm"><i class="far fa-edit text-white"></i></a>
               <a href="javascript:void(0)" onclick="del('.$dt->id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
           );
       }

       $output = array(
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }

    public function getBrng($id='',$id_req='',$kid='')
    {
            // $this->db->select($this->see);
            $this->db->select("sirb.id as id,nama_barang,sirb.catatan,sirb.status,k.nama,j.nma_jabatan,sib.ctdDate,sib.keterangan,sib.sn");
            $this->db->join('scm_inv_req_brng sirb', 'sirb.id = sib.id_inv_req_brng', 'left');
            $this->db->join('scm_inv_data_mstr_brng sidmb', 'sidmb.id = sirb.id_inv_mstr_brng', 'left');
            // $this->db->join('scm_inv_img sii', 'sii.id_inv_brng = sib.id', 'right');
            $this->db->join('karyawan k', 'k.id = sirb.ctdBy', 'left');
            $this->db->join('jabatan j', 'j.id = k.jabatan_id', 'left');

            if ($kid != '') {
                $this->db->where('sirb.ctdBy', $kid);
            }
            
            if ($id != '') {
                $this->db->where('sib.id', $id);
            }else if($id_req != ''){
                $this->db->order_by('sib.id', 'desc');
                $this->db->where('sib.id_inv_req', $id_req);
            }else {
                $this->db->order_by('sib.id', 'desc');
            }

            $ok = $this->db->get('scm_inv_brng sib');
            return $ok;
    }

    public function tes()
    {
        // $this->db->select("sib.id as id,sii.file");
        // $this->db->join('scm_inv_img sii', 'sii.id_inv_brng = sib.id', 'inner');

        $ok = $this->db->get_where('scm_inv_img', array('id_inv_brng'=> '1'));
        return $ok;
    // Inventory Kantor
    }

    public function dt_inventory_kantor()
    {
       // Definisi
       $condition = [];
       $data = [];

       $CI = &get_instance();
       $CI->load->model('DataTable', 'dt');

       // Set table name
       $CI->dt->table = 'scm_inv_brng sib';
       // Set orderable column fields
       $CI->dt->column_order = [null,'sib.sn','sib.nama_barang'];
       // Set searchable column fields
       $CI->dt->column_search = ['sib.sn','sib.nama_barang'];
       // Set select column fields
       $CI->dt->select = 'sib.id as id,sib.nama_barang,sib.sn,sib.pic_penerima';
       // Set default order
       
       $CI->dt->order = ['sib.id' => 'desc'];

       // Fetch member's records
       $dataTabel = $this->dt->getRows(@$_POST, $condition);

       $i = @$_POST['start'];
       foreach ($dataTabel as $dt) {
           $i++;
           $data[] = array(
               $dt->sn,
               $dt->nama_barang,
               $dt->pic_penerima,
               '<a href="'.site_url('scm/detail_inventory_kantor)?id=').$dt->id.'"  class="btn btn-info btn-sm"><i class="far fa-edit "></i></a>'
           );
       }

       $output = array(
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->dt->countAll($condition),
           "recordsFiltered" => $this->dt->countFiltered(@$_POST, $condition),
           "data" => $data,
       );

       // Output to JSON format
       return json_encode($output);
    }
	

    private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'pdf',
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
                return $this->upload->data('file_name');
            } else {
                return false;
            }
        }

        return $images;
    }

    public function in_inventory_kantor()
    {
        $rsp = [];
        $obj = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_brng' => $this->input->post('harga_brng'),
            'id_vendor' => $this->input->post('id_vendor'),
            'sn' => $this->input->post('sn'),
            'keterangan' => $this->input->post('keterangan'),
            'kondisi_brng' => $this->input->post('kondisi_brng'),
            'id_data_mster_brng' => $this->input->post('id_data_mster_brng'),
            'garansi' => $this->input->post('garansi'),
            'warna_brng' => $this->input->post('warna_brng'),
            'ctdDate' => date('Y-m-d'),
            'ctdBy' => $this->session->userdata('karyawan_id'),
            'aktif' => 1,
        ];

       $this->db->insert('scm_inv_brng', $obj);
       $rsp['count'] = $this->db->affected_rows();
        
       $file =  $this->upload_files('./data/scm/inv/','',$_FILES['img_brng']);
       $file_arr = [];
       foreach ($file as $v) {
           $file_arr[] = [
            'file' => $v,
            'path' => 'data/scm/inv/',
            'ctdDate' => date('Y-m-d'),
            'ctdTime' => date('H:i:s'),
            'ctdBy' => $this->session->userdata('karyawan_id')
           ];
       } 

       if(count($file_arr) > 0) $this->db->insert_batch('scm_inv_img', $file_arr);
       
       return $rsp;
    }
}