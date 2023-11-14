<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSCMMobil extends CI_Model {

    public $t = 'pnjm_pengajuan';
    public $t_mobil = 'pnjm_mobil';
    public $see = '*';
    private $pnjm_id_mobil = 'pnjm_id_mobil';
    private $pnjm_id = 'pnjm_id';
    public function setStatus($status_peminjaman='')
    {
        $s = 'Tidak Diketahui';
        if ($status_peminjaman != '') {
            if ($status_peminjaman == 1) {
                $s = "<span class='lbl lbl-warning'>Belum Di Proses</span>";
            }else if ($status_peminjaman == 2) {
                $s = "<span class='lbl lbl-primary'>Di Setujui</span>";
            }else if ($status_peminjaman == 3) {
                $s = "<span class='lbl lbl-danger'>Di Tolak, Ada Prioritas Pengajuan Lain</span>";
            }else if ($status_peminjaman == 4) {
                $s = "<span class='lbl lbl-danger'>Di Tolak</span>";
            }else if ($status_peminjaman == 5) {
                $s = "<span class='lbl lbl-success'>Selesai</span>";
            }else if ($status_peminjaman == 6) {
                $s = "<span class='lbl lbl-danger'>Di Batalkan</span>";
            }else if ($status_peminjaman == 7) {
                $s = "<span class='lbl lbl-danger'>Pembatalan Extend</span>";
            }
            
           return $s; 
        }
    }

    public function setStatusPPM($status_peminjaman='')
    {
        $s = 'Tidak Diketahui';
        if ($status_peminjaman != '') {
            if ($status_peminjaman == '0' ) {
                $s = "<span class='lbl lbl-primary'>Tersedia</span>";
            }else{
                $s = "<span class='lbl lbl-danger'>Terpakai</span>";
            }
            
           return $s; 
        }
    }
    public function setStatuskPPM($status_peminjaman='')
    {
        $s = 'Tidak Diketahui';
        if ($status_peminjaman != '') {
            if ($status_peminjaman == 1) {
                $s = "<span class='lbl lbl-danger'>Opty</span>";
            }else if($status_peminjaman == 2){
                $s = "<span class='lbl lbl-warning'>Lelang / Bid </span>";
            }else if($status_peminjaman == 3){
                $s = "<span class='lbl lbl-warning'>Running</span>";
            }else if($status_peminjaman == 4){
                $s = "<span class='lbl lbl-warning'>Other </span>";
            }else{
                $s = "<span class='lbl lbl-primary'>$status_peminjaman</span>";
            }
            
           return $s; 
        }
    }

    function get_extend(){
        $hasil=$this->db->query("SELECT * FROM pnjm_pengajuan");
        return $hasil;
    }
    function get_change(){
        $hasil=$this->db->query("SELECT * FROM pnjm_pengajuan");
        return $hasil;
    }
    public function get($pnjm_id='',$where='',$query='',$limit='',$start='')
    {
        $q = false;

        if ($pnjm_id != '') {
            $this->db->order_by('pnjm_id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, [$this->pnjm_id => $pnjm_id]);
        }elseif ($where != '') {
            $this->db->order_by('pnjm_id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, $where);
        }elseif ($query != '') {
            $q = $this->db->query($query);
        }elseif($limit != ''){
            $this->db->order_by('pnjm_id', 'desc');
            $this->db->select($this->see);
            $q = $this->db->get_where($this->t,$where,$limit,$start);
        }else{
            $this->db->order_by('pnjm_id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get($this->t);
        }

        return $q;
    }
    public function get_mobil($pnjm_id_mobil='',$arr='')
    {
        // if ($pnjm_id_mobil != '') {
        //     $this->db->where('pnjm_id_mobil', $pnjm_id_mobil);
        // }
        $q = $this->db->get('pnjm_mobil');
        return $q; 
    }

    public function cek_pengajuan_mobil($pnjm_id='',$arr='')
    {
        if ($pnjm_id != '') {
            $this->db->where('pnjm_id', $pnjm_id);
        }
        $q = $this->db->get('pnjm_pengajuan');
        return $q; 
    }
    
    public function get_pengajuan_peminjaman_mobil($pnjm_id='')
    {
        $s = 0;
        if ($pnjm_id != '') { 
            $p = $this->db->query('SELECT 
            fk.nama,
            gk.status_pengajuan,
            pk.pnjm_persetujuan_keterangan,
            pk.pnjm_status_keterangan,
            pk.pnjm_tanggal_persetujuan 
            FROM pnjm_persetujuan_mobil pk
            left join karyawan fk on fk.id=pk.pnjm_persetujuan_nip
            inner join pnjm_pengajuan gk on gk.pnjm_id=pk.pnjm_id where pk.pnjm_id = '.$pnjm_id);
            $s = $p->num_rows();
        }

        return [$p->result(),$s];
    }
    public function get_log_kendaraan($pnjm_id='')
    {
        $s = 0;
        if ($pnjm_id != '') { 
            $p = $this->db->query('SELECT 
            user,tanggal,aktifitas
            FROM pnjm_log_kendaraan 
            where pnjm_id = '.$pnjm_id);
            $s = $p->num_rows();
        }

        return [$p->result(),$s];
    }

     public function dt_pengajuan()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t. ' pk';
        // Set orderable column fields
        $CI->dt->column_order = ['fk.nama','pnjm_keterangan','pnjm_waktu_pengajuan','status_pengajuan','tmp','tsp'];
        // Set searchable column fields
        // $CI->dt->column_search = ['pnjm_nip_pengajuan', 'status_pengajuan'];
        $CI->dt->column_search = ['pnjm_nip_pengajuan', 'status_pengajuan','pnjm_waktu_pengajuan','tmp','tsp'];
        // Set select column fields
        $CI->dt->select = 'tmp,tsp,pnjm_nip_pengajuan,pnjm_keterangan,pnjm_waktu_pengajuan,status_pengajuan,pnjm_id,fk.nama,mk.pnjm_plat_mobil,mk.pnjm_merek_mobil';
        // Set default order
        $CI->dt->order = ['pk.pnjm_waktu_pengajuan' => 'desc'];

        // $condition = [
        //     ['where',$this->t.'.pnjm_nip_pengajuan',$this->session->userdata('id')],
        // ];
        $condition = [
            // ['where',$this->t.'.status',$status],
            ['join','karyawan fk','fk.id = pk.pnjm_nip_pengajuan','left'],
            ['join','pnjm_mobil mk','mk.pnjm_id_mobil = pk.pnjm_mobil_id','left'],
            ['where','pk.pnjm_nip_pengajuan',$this->session->userdata('karyawan_id')],
        ];
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            if ($dt->status_pengajuan != 2) {
                $data[] = array(
                    //$i,
                    $dt->pnjm_merek_mobil." | ".$dt->pnjm_plat_mobil,
                    $dt->nama,
                    // $dt->pnjm_waktu_pengajuan,
                    test($dt->pnjm_waktu_pengajuan),
                    test($dt->tmp),
                    test($dt->tsp),
                    $this->setStatus($dt->status_pengajuan),
                    // str_ireplace("\n","<br />",$dt->status_pengajuan),
                    '<a data-toggle="tooltip1" title="Batal" class="btn btn-danger" href="'.site_url('SCM/add_pembatalan_pengajuan/').$dt->pnjm_id.'" style="display: none;"><i class="fa fa-minus-circle"></i></a>',
                    '<a data-toggle="tooltip2" title="Pakai" class="btn btn-primary" href="'.site_url('SCM/form_pengajuan_persetujuan_mobil/').$dt->pnjm_id.'" style="display: none;"><i class="fa fa-edit"></i></a>',
                    '<a title="Extend" class="btn btn-success" data-toggle="modal" data-target="#modal_extend'.$dt->pnjm_id.'" style="display: none;"><i class="fa fa-plus"></i></a>',
                    '<a data-toggle="tooltip4" title="Detail" class="btn btn-info" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id.'"><i class="fa fa-info"></i></a>',
                );
            }else{
                
                $data[] = array(
                    //$i,
                    $dt->pnjm_merek_mobil." | ".$dt->pnjm_plat_mobil,
                    $dt->nama,
                    test($dt->pnjm_waktu_pengajuan),
                    test($dt->tmp),
                    test($dt->tsp),
                    $this->setStatus($dt->status_pengajuan),
                    // str_ireplace("\n","<br />",$dt->status_pengajuan),
                    '<a data-toggle="tooltip1" title="Batal" class="btn btn-danger"  href="'.site_url('SCM/add_pembatalan_pengajuan/').$dt->pnjm_id.'"><i class="fa fa-minus-circle"></i></a>',
                    '<a data-toggle="tooltip2" title="Pakai" class="btn btn-primary" href="'.site_url('SCM/form_pengajuan_persetujuan_mobil/').$dt->pnjm_id.'"><i class="fa fa-edit"></i></a>',
                    '<a title="Extend" class="btn btn-success" data-toggle="modal" data-target="#modal_extend'.$dt->pnjm_id.'"><i class="fa fa-plus"></i></a>',
                    '<a data-toggle="tooltip4" title="Detail" class="btn btn-info" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id.'"><i class="fa fa-info"></i></a>',
                );
            }
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function dt_pengajuan_all()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t. ' pk';
        // Set orderable column fields
        $CI->dt->column_order = ['fk.nama','pnjm_keterangan','pnjm_waktu_pengajuan','status_pengajuan'];
        // Set searchable column fields
        $CI->dt->column_search = ['pnjm_nip_pengajuan', 'status_pengajuan','pnjm_waktu_pengajuan','tmp','tsp'];
        // Set select column fields
        $CI->dt->select = 'pnjm_nip_pengajuan,pnjm_keterangan,pnjm_waktu_pengajuan,tmp,tsp,status_pengajuan,pnjm_id,fk.nama,mk.pnjm_plat_mobil,mk.pnjm_merek_mobil';
        // Set default order
        $CI->dt->order = ['pk.pnjm_waktu_pengajuan' => 'desc'];

        // $condition = [
        //     ['where',$this->t.'.pnjm_nip_pengajuan',$this->session->userdata('id')],
        // ];
        $condition = [
            // ['where',$this->t.'.status',$status],
            ['join','karyawan fk','fk.id = pk.pnjm_nip_pengajuan','left'],
            ['join','pnjm_mobil mk','mk.pnjm_id_mobil = pk.pnjm_mobil_id','left']
            // ['where','pk.pnjm_nip_pengajuan',$this->session->userdata('id')],
        ];
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->pnjm_merek_mobil." | ".$dt->pnjm_plat_mobil,
                $dt->nama,
                test($dt->pnjm_waktu_pengajuan),
                test($dt->tmp),
                test($dt->tsp),
                $this->setStatus($dt->status_pengajuan),
                // str_ireplace("\n","<br />",$dt->status_pengajuan),
                '<a class="btn btn-default btn-sm" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id.'"><i class="fa fa-info-circle"></i></a>',
            );
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    public function dt_persetujuan()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');


        $CI->dt->table = $this->t. ' pk';
        // Set orderable column fields
        $CI->dt->column_order = ['fk.nama','pnjm_keterangan','pnjm_waktu_pengajuan','status_pengajuan'];
        // Set searchable column fields
        $CI->dt->column_search = ['pnjm_nip_pengajuan', 'status_pengajuan'];
        // Set select column fields
        $CI->dt->select = 'pnjm_nip_pengajuan,pnjm_keterangan,pnjm_waktu_pengajuan,status_pengajuan,pnjm_id,fk.nama,mk.pnjm_plat_mobil,mk.pnjm_merek_mobil';
        // Set default order
        $CI->dt->order = ['pk.pnjm_waktu_pengajuan' => 'desc'];

        $condition = [
            //['where',$this->t.'.status',$status],
            ['join','karyawan fk','fk.id = pk.pnjm_nip_pengajuan','left'],
			['join','pnjm_mobil mk','mk.pnjm_id_mobil = pk.pnjm_mobil_id','left'],
        ];

        // $condition = [
        //     ['where',$this->t.'.status_pengajuan', 1],
        // ];
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);


        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            if ($dt->status_pengajuan == 1 ) {
                            $data[] = array(
                                //$i,
                                $dt->pnjm_merek_mobil." | ".$dt->pnjm_plat_mobil,
                                $dt->nama,
                                $dt->pnjm_keterangan,
                                test($dt->pnjm_waktu_pengajuan),
                                $this->setStatus($dt->status_pengajuan),
                                // str_ireplace("\n","<br />",$dt->status_pengajuan),
                                // '<a class="btn btn-default btn-sm" href="'.site_url('SCM/form_test/').$dt->pnjm_id.'"><i class="fa fa-edit"></i></a>',
                                '<a data-toggle="tooltip1" title="Batal" class="btn btn-danger" href="'.site_url('SCM/add_pembatalan_pengajuan/').$dt->pnjm_id.'" style="display: none;"><i class="fa fa-minus-circle"></i></a>',
                                '<a data-toggle="tooltip2" title="Approve" class="btn btn-primary" href="'.site_url('SCM/form_persetujuan_peminjaman_mobil/').$dt->pnjm_id.'" ><i class="fa fa-edit"></i></a>',
                                '<a title="Change" class="btn btn-warning" data-toggle="modal" data-target="#modal_change'.$dt->pnjm_id.'" style="display: none;"><i class="fa fa-car"></i></a>',
                                '<a data-toggle="tooltip3" title="Detail" class="btn btn-info" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id.'"><i class="fa fa-info"></i></a>',
                            );
            }elseif ($dt->status_pengajuan == 2 ) {
                $data[] = array(
                            //$i,
                            $dt->pnjm_merek_mobil." | ".$dt->pnjm_plat_mobil,
                            $dt->nama,
                            $dt->pnjm_keterangan,
                            test($dt->pnjm_waktu_pengajuan),
                            $this->setStatus($dt->status_pengajuan),
                            // str_ireplace("\n","<br />",$dt->status_pengajuan),
                            // '<a class="btn btn-default btn-sm" href="'.site_url('SCM/form_test/').$dt->pnjm_id.'"><i class="fa fa-edit"></i></a>',
                            '<a data-toggle="tooltip1" title="Batal" class="btn btn-danger" href="'.site_url('SCM/add_pembatalan_pengajuan/').$dt->pnjm_id.'" ><i class="fa fa-minus-circle"></i></a>',
                            '<a data-toggle="tooltip2" title="Approve" class="btn btn-primary" href="'.site_url('SCM/form_persetujuan_peminjaman_mobil/').$dt->pnjm_id.'" style="display: none;"><i class="fa fa-edit"></i></a>',
                            '<a title="Change" class="btn btn-warning" data-toggle="modal" data-target="#modal_change'.$dt->pnjm_id.'"><i class="fa fa-car"></i></a>',
                            '<a data-toggle="tooltip3" title="Detail" class="btn btn-info" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id.'"><i class="fa fa-info"></i></a>',
                        );
            }else{
                $data[] = array(
                    //$i,
                    $dt->pnjm_merek_mobil." | ".$dt->pnjm_plat_mobil,
                    $dt->nama,
                    $dt->pnjm_keterangan,
                    test($dt->pnjm_waktu_pengajuan),
                    $this->setStatus($dt->status_pengajuan),
                    // str_ireplace("\n","<br />",$dt->status_pengajuan),
                    // '<a class="btn btn-default btn-sm" href="'.site_url('SCM/form_test/').$dt->pnjm_id.'"><i class="fa fa-edit"></i></a>',
                    '<a data-toggle="tooltip1" title="Batal" class="btn btn-danger" href="'.site_url('SCM/add_pembatalan_pengajuan/').$dt->pnjm_id.'" style="display: none;"><i class="fa fa-minus-circle"></i></a>',
                    '<a data-toggle="tooltip2" title="Approve" class="btn btn-primary" href="'.site_url('SCM/form_persetujuan_peminjaman_mobil/').$dt->pnjm_id.'" style="display: none;"><i class="fa fa-edit"></i></a>',
                    '<a title="Change" class="btn btn-warning" data-toggle="modal" data-target="#modal_change'.$dt->pnjm_id.'" style="display: none;"><i class="fa fa-car"></i></a>',
                    '<a data-toggle="tooltip3" title="Detail" class="btn btn-info" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id.'"><i class="fa fa-info"></i></a>',
                );

            }
            
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    
    public function del($where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;

        if ($where != '') {
            $q = $this->db->delete($this->t, $where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success delete data";
                $status = 1;
            }else{
                $msg = "Failed delete data";
            }
        }

        return [$msg,$status];
        
    }

    public function up($obj='',$where='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
		
		$db_debug=$this->db->db_debug;
		$this->db->db_debug=false;

        if ($obj != '' || $where != '') {
            $q = $this->db->update($this->t, $obj,$where);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = 1;
            }else{
                $msg = "Failed update data";
            }
        }
		
		$this->db->db_debug=$db_debug;

        return [$msg,$status];
        
    }
	
	public function in($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

		$db_debug=$this->db->db_debug;
		$this->db->db_debug=false;

        if ($obj != '') {
            $q = $this->db->insert($this->t, $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

		$this->db->db_debug=$db_debug;
		
        return [$msg,$status,$id];
        
    }

    // model master data mobil
    public function dt_daftar_mobil()
    {
        // Definisi
        $condition = '';
        $data = [];

        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');

        // Set table name
        $CI->dt->table = $this->t_mobil;
        // Set orderable column fields
        $CI->dt->column_order = ['pnjm_id_mobil','pnjm_merek_mobil','pnjm_plat_mobil','pnjm_status_pemakaian','pnjm_status_keterangan'];
        // Set searchable column fields
        $CI->dt->column_search = ['pnjm_merek_mobil', 'pnjm_plat_mobil','pnjm_status_pemakaian'];
        // Set select column fields
        $CI->dt->select = 'pnjm_id_mobil,pnjm_merek_mobil,pnjm_plat_mobil,pnjm_status_pemakaian,pnjm_status_keterangan';
        // Set default order
        $CI->dt->order = ['pnjm_id_mobil' => 'asc'];

        // $condition = [
        //     ['where',$this->t.'.pnjm_nip_pengajuan',$this->session->userdata('nip')],
        // ];
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);

        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                //$i,
                $dt->pnjm_id_mobil,
                $dt->pnjm_merek_mobil,
                $dt->pnjm_plat_mobil,
                $this->setStatusPPM($dt->pnjm_status_pemakaian),
                // $this->setStatusPPM($dt->pnjm_status_keterangan),
                // str_ireplace("\n","<br />",$dt->status_pengajuan),
                '<a class="btn btn-default btn-sm" href="'.site_url('SCM/form_mobil/').$dt->pnjm_id_mobil.'"><i class="fa fa-edit"></i></a>',
                // '<a class="btn btn-default btn-sm" href="'.site_url('SCM/detail_peminjaman_mobil/').$dt->pnjm_id_mobil.'"><i class="fa fa-info-circle"></i></a>',
            );
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dt->countAll($condition),
            "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
            "data" => $data,
        );

        // Output to JSON format
        return json_encode($output);
    }

    // model master data mobil
    public function get_id_mobil($pnjm_id_mobil='',$where='',$query='',$limit='',$start='')
    {
        $q = false;

        if ($pnjm_id_mobil != '') {
            $this->db->order_by('pnjm_id_mobil', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t_mobil, [$this->pnjm_id_mobil => $pnjm_id_mobil]);
        }elseif ($where != '') {
            $this->db->order_by('pnjm_id_mobil', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t_mobil, $where);
        }elseif ($query != '') {
            $q = $this->db->query($query);
        }elseif($limit != ''){
            $this->db->order_by('pnjm_id_mobil', 'desc');
            $this->db->select($this->see);
            $q = $this->db->get_where($this->t_mobil,$where,$limit,$start);
        }else{
            $this->db->order_by('pnjm_id_mobil', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get($this->t_mobil);
        }

        return $q;
    }
    public function in_mobil($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = 0 ;
        $id = 0;

		$db_debug=$this->db->db_debug;
		$this->db->db_debug=false;

        if ($obj != '') {
            $q = $this->db->insert($this->t_mobil, $obj);
            $id = $this->db->insert_id();
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data";
                $status = 1;
            }else{
                $msg = "Failed insert data";
            }
        }

		$this->db->db_debug=$db_debug;
		
        return [$msg,$status,$id];
        
    }
    public function resizeImage($folder,$img)
    {
       $source_path = $_SERVER['DOCUMENT_ROOT'] . $folder. $img;
       $target_path = $_SERVER['DOCUMENT_ROOT'] . $folder;
       $config_manip = array(
           'image_library' => 'gd2',
           'source_image' => $source_path,
           'new_image' => $target_path,
           'maintain_ratio' => TRUE,
           'width' => 500,
       );
    
       $this->load->library('image_lib', $config_manip);
       if (!$this->image_lib->resize()) {
           echo $this->image_lib->display_errors();
       }
    
       $this->image_lib->clear();
    }

    function update_pengajuan_mobil($pnjm_id){


        $query = $this->db->get_where('pnjm_pengajuan', array('pnjm_id' => $_POST['pnjm_id']));
        foreach ($query->result() as $row)
        {
                $get_img_start = $row->img_start;
                $get_img_end = $row->img_end;
        }

        if ($get_img_start != "") {
                // $folder = './data/mobil/img_end/';
                $img_end = $pnjm_id."-img_end-".md5(time());
                $config['upload_path']          = './data/mobil/img_end/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']            = $img_end;
                $config['overwrite']			= true;
                $config['encrypt_name'] = TRUE;
                $config['max_size']             = 5000; // 1MB
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('img_end')) {
                   
                    $pnjm_mobil_id = $this->input->post('pnjm_mobil_id');
                    $this->db->set('pnjm_status_pemakaian', '0');
                    $this->db->set('pnjm_status_keterangan', '0');
                    $this->db->where('pnjm_id_mobil',  $pnjm_mobil_id);
                    $this->db->update('pnjm_mobil');

                    $img =  $this->upload->data()['file_name']; 
                    // $this->resizeImage($folder,$img);
                    $pnjm_id=$this->input->post('pnjm_id');
                    $km_end=$this->input->post('km_end');
                    $bensin_end=$this->input->post('bensin_end');
                    $status_kendaraan=$this->input->post('status_kendaraan');
                    $this->db->set('km_end', $km_end);
                    $this->db->set('bensin_end', $bensin_end);
                    $this->db->set('status_kendaraan', $status_kendaraan);
                    $this->db->set('img_end', $img);
                    // $this->db->set('pnjm_waktu_selesai_peminjaman', '');
                    $this->db->set('status_pengajuan', '5');
                    $this->db->where('pnjm_id', $pnjm_id);
                    $result=$this->db->update('pnjm_pengajuan');
                     // log
                     $user = $this->session->userdata('karyawan_id');
                     $status = 7;
                     $aktifitas = "pengisisan form akhir peminjaman kendaraan";
                     $this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
                     // end log
                    
                     return true;
                }else{
                    return false;
                }
        }else{    
                // $folder = './data/mobil/img_start/';
                $img_start = $pnjm_id."-img_str-".md5(time());
                $config['upload_path']          = './data/mobil/img_start/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']            = $img_start;
                $config['overwrite']			= true;
                $config['encrypt_name'] = TRUE;
                $config['max_size']             = 5000; // 1MB
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('img_start')) {
                    $img =  $this->upload->data()['file_name']; 
                    // $this->resizeImage($folder,$img);

                    $pnjm_id=$this->input->post('pnjm_id');
                    $km_start=$this->input->post('km_start');
                    $bensin_start=$this->input->post('bensin_start');
                    $this->db->set('km_start', $km_start);
                    $this->db->set('bensin_start', $bensin_start);
                    $this->db->set('img_start', $img);
                    $this->db->where('pnjm_id', $pnjm_id);
                    $result=$this->db->update('pnjm_pengajuan');
                    // log
                    $user = $this->session->userdata('karyawan_id');
                    $status = 6;
                    $aktifitas = "pengisisan form awal peminjaman kendaraan";
                    $this->bantuan->log_kendaraan($pnjm_id,$user,$status,$aktifitas);
                    // end log

                    // update status ketersediaan mobil

                    $pnjm_mobil_id = $this->input->post('pnjm_mobil_id');
                    $this->db->set('pnjm_status_pemakaian', '1');
                    $this->db->set('pnjm_status_keterangan', '1');
                    $this->db->where('pnjm_id_mobil',  $pnjm_mobil_id);
                    $this->db->update('pnjm_mobil');

                    return true;
                }else{
                    return false;
                }
        }

		
	}


    // end model master data mobil
    
	
}