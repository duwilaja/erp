
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Oprations extends MY_controller {

    private $njudul = 'Ticketing';
    private $progress = [];
    private $pending = [];
    private $time = [];
    private $s = '';
    private $pe = 0;
    private $pr = 0;
    private $cl = 0;
    
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MOprations','mo');
		$this->load->model('MCustomers','mc');
        $this->load->model('MKaryawan','mk');
        $this->load->helper('custom');
        $this->load->library('upload');
    }

    public function index()
    {
        $q = $this->db->get_where('h_ticket', ['ticket_id' => '20201019013817']);
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

        $hs = calc_minute($q->first_row()->created_date,$q->last_row()->created_date);
        $h = $hs-$pending;
        echo 'Total perhitungan dari mulai  - akhir : '.$hs.'<br>';
        echo 'Hitungan pending : '.$pending.'<br>';
        echo 'Hasil total - pending : '.$h;

    }

	public function dtTicket()
	{
		echo $this->mo->dt();
    }  
    
    // Kategori 
    public function dtTicCategory()
	{
		echo $this->mo->dtTicCategory();
    }  

    public function getTicCategory($id='')
    {
        $k = $this->db->get_where('tic_kategori',['id' => $id]);
        if ($k->num_rows() > 0) {
            echo json_encode($k->row());
        }    
    }

    // Subject
    public function getTicSubject($id='')
    {
        $k = $this->db->get_where('tic_subject',['id' => $id]);
        if ($k->num_rows() > 0) {
            echo json_encode($k->row());
        }    
    }

    public function dtTicSubject()
	{
		echo $this->mo->dtTicSubject();
    } 
    
    
    public function ticketAgree()
    {
        $resl = ''; 
        $val = $this->input->post('val');
        $id = $this->input->post('id');
        $pic = $this->input->post('pic');

        if (!$pic) {
            $object = [
                'pic' => $this->session->userdata('karyawan_id'),
                'known' => 1,
            ];
            $this->db->update('tickets', $object,['id' => $id]);
            $resl = ctojson('',1,'Berhasil menerima tugas');

            $this->bantuan->kary_resp('1',$id,'1'); //ticketing tindak

        }else{

            $object = [
                'known' => 1,
            ];
            $this->db->update('tickets', $object,['id' => $id]);
            $resl = ctojson('',1,'Berhasil menerima tugas');

            $this->bantuan->kary_resp('1',$id,'1'); //ticketing tindak
        }
        
        $obj = [
            'note' => 'Saya menyetujui ticket ini untuk ditindak lanjuti',
            'ticket_id' => $id,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('karyawan_id')
        ];

        $q = $this->db->insert('h_ticket', $obj);

        echo $resl;

    }
    
    // History Ticketing

    public function dtTicketHistory($id='')
	{
		echo $this->mo->dt($id,'history');
    }

    public   function inHTicket()
    {
        $resl = [];
        $file = '';
        $ctddone = '';
        $note= '';
        $msg2 = '';

            $config['upload_path']          ='./data/ticket';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf|jpeg|jpg|png';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('h_file')){
				$msg = $this->upload->display_errors();
			}else{
				$file = $this->upload->data()['file_name'];
            }
        $ht1 = $this->db->get('h_ticket',['ticket_id' => $this->input->post('h_ticket_id')]);
        $note .= $this->input->post('h_note');
        if ($ht1->num_rows() > 0) {
            $ht = $ht1->last_row();
            $karyawan = '';
            $kr = $this->mk->get($this->input->post('hpic'));
            
            if (@$kr->num_rows() > 0) {
                $karyawan = $kr->row()->nama; 
                
                if ($this->input->post('h_status') == "closed") {
                    $tsc = $this->db->get_where('tic_s_closed',['id' => $this->input->post('s_closed')])->row()->s_closed;
                    $note .= ' '.$tsc;
                }

                if ($ht->pic != $this->input->post('hpic')) {
                     //Kirim Notif Ke User
                    if ($this->input->post("hpic") != '' && $this->session->userdata('karyawan_id') != $this->input->post("hpic")) {
                        $this->notif->inNotif(
                        $this->njudul,
                        $this->session->userdata('karyawan_id'),
                        $this->input->post("hpic"),
                        '<span class="label label-info">'.$this->njudul.'</span></br>Tiket telah dialih tugaskan kepada anda, dengan Nomor Tiket <b><u>'.$this->input->post('h_ticket_id').'</u></b>',
                        urlencode('oprations/my_ticket?history=true&idt='.$this->input->post('h_ticket_id')));
                        $msg2 = 'Nomor Tiket '.$this->input->post('h_ticket_id').' telah dialih tugaskan';
                        $note = 'Mengoper tugaskan ke <u>'.$karyawan.'</u><br>'.$note;
                        
                        $this->stele2($this->input->post("hpic"),urlencode("<a href='https://erp.matrik.co.id/oprations/my_ticket?history=true&idt=".$this->input->post('h_ticket_id')."'>Tiket telah dialih tugaskan kepada anda, dengan Nomor Tiket <b>".$this->input->post('h_ticket_id')."</b></a>"));
                    }

                }
                
            }
            
        }
       
        $obj = [
            'status' => $this->input->post('h_status'),
            'grp' => $this->input->post('hgrp'),
            'pic' => $this->input->post('hpic'),
            //'file' => $this->input->post('h_file'),
            'note' => $note,
            'file' => $file,
            'ticket_id' => $this->input->post('h_ticket_id'),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('karyawan_id')
        ];

        if ($this->input->post('h_status') == 'closed') {
            $ctddone = date('Y-m-d H:i:s'); 
        }

        $obj2 = [
            'grp' => $this->input->post('hgrp'),
            'pic' => $this->input->post('hpic'),
            's_closed_id' => $this->input->post('s_closed'),
            //'file' => $file,
            'status' => $this->input->post('h_status'),
            'notes' => $this->input->post('h_note'),
            'ctddone' => $ctddone,
            'updby' => $this->session->userdata('karyawan_id')
        ];

        $this->db->update('tickets', $obj2,['id' => $this->input->post('h_ticket_id')]);
        
        $q = $this->db->insert('h_ticket', $obj);
        $count = $this->db->affected_rows();
        if ($count > 0) {
            $this->bantuan->kary_resp('1',$this->input->post('h_ticket_id'),'2'); //ticketing success
            $resl = ctojson($obj,1,['Success to add history ticketing',$msg2]);
        }else{
            $resl = ctojson($obj,0,['Failed to add history ticketing','']);
        }

        echo $resl;
    }

    // My Ticketing

    public function dtMyticket($pic='')
	{
		echo $this->mo->dt($this->session->userdata('karyawan_id'),'myticket');
    }

    public function dtMygroup($grp='')
	{
		echo $this->mo->dt($grp,'mygroup');
    }
    
    public function my_ticket()
    {
        $d = [
			'title' => 'My Ticket',
			'linkView' => 'page/oprations/ticket',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtMyticket/1',
			'bread' => [
				'nama' => 'My Ticket',
				'data' => [
					['nama' => 'My Ticket','link' => site_url('oprations/my_ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result(),
            'tic_kategori' => $this->mo->tic_kategori()->result()
		];
		$this->load->view('_main',$d);
    }

    public function my_group()
    {
        $d = [
			'title' => 'My Group',
			'linkView' => 'page/oprations/ticket',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtMygroup/'.$this->session->userdata('group'),
			'bread' => [
				'nama' => 'My Group',
				'data' => [
					['nama' => 'My Group','link' => site_url('oprations/my_group'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result(),
            'tic_kategori' => $this->mo->tic_kategori()->result()
		];
		$this->load->view('_main',$d);
    }
    
    public function all_ticket()
	{
		$d = [
			'title' => 'List Ticket',
			'linkView' => 'page/oprations/ticket',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => 'All Ticket',
				'data' => [
					['nama' => 'All Ticket','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result(),
            'tic_kategori' => $this->mo->tic_kategori()->result()
		];
		$this->load->view('_main',$d);
    }

    public function getKategoriJson()
    {
        $id = $this->input->get('id');
        if ($id != '') {
            $q = $this->mo->tic_kategori($id)->result();
        }else{
            $q = $this->mo->tic_kategori()->result();
        }
        echo json_encode($q);
    }

    public function getSubjectJson()
    {
        $tic_ktg_id = $this->input->get('tic_ktg_id');
        if ($tic_ktg_id != '') {
            $q = $this->mo->tic_subject('',$tic_ktg_id)->result();
        }else{
            $q = $this->mo->tic_subject()->result();
        }
        echo json_encode($q);
    }
    
    public function getTicket($id ='')
    {
        $q = $this->mo->get($id);
        if ($q->num_rows() > 0) {
            echo json_encode($q->row());
        }else{
            echo json_encode([null]);
        }
    }

    public function getTicket2($id ='')
    {
        $ctddone = '-';
        $gt = $this->mo->getTicket($id)->row();
        if ($gt->ctddone != '' && $gt->status == 'closed') {
            $ctddone = $this->bantuan->ttr($id).' detik';
        }
        $data = [
            'ticketno' => $gt->id,
            'customer' => $gt->custend,
            'provinsi' => $gt->provinsi,
            'alamat' => $gt->alamat,
            'kota' => $gt->kota,
            'node_id' => $gt->node_id == '' ? $gt->node : $gt->node_id,
            'reporter' => $gt->reporter,
            'layanan_id' => $gt->tic_layanan_id,
            'layanan' => $gt->layanan,
            'pic' => $gt->pic,
            'grp' => $gt->grp,
            'kpic' => $gt->kpic,
            'sla' => $this->mo->cekSla($gt->sla),
            'category' => $gt->nama_kategori,
            'subject' => $gt->nama_subject,
            'status' => $gt->status,
            's_closed_id' => $gt->s_closed_id,
            'lastupd' => $gt->lastupd,
            'detail' => $gt->body,
            'notes' => $gt->notes,
            'file' => $gt->file,
            'wp' => $ctddone,
        ]; 

        echo json_encode($data);
    }

    public function getHTicket($id='')
    {
        $this->db->select('t.*,nama');
        $this->db->order_by('id', 'desc');
        $this->db->join('karyawan k', 'k.id = t.created_by', 'inner');
        $h = $this->db->get_where('h_ticket t',['ticket_id' => $id]);
        echo json_encode($h->result());
    }
    

    public function inCreateTicket()
    {
        $msg = "Failed to create ticket";
        $status = 0;
        $iddate = date('Ymdhis');
        $q_node = '';
    
        $file = '';

            $config['upload_path']          ='./data/ticket';
			$config['allowed_types']        = 'xlx|xlsx|doc|docx|pdf|jpg|jpeg|png';
			$config['max_size']             = 0;
			$config['max_width']            = 0;
			$config['max_height']           = 0;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')){
				$msg = $this->upload->display_errors();
			}else{
				$file = $this->upload->data()['file_name'];
            }
            

        $t = [ 
        "id" => $iddate,
        "ticketno" => 'TLK-'.$iddate,
        'createdby' => $this->session->userdata('id'),
        "customer" => $this->input->post("i_customer"),
        "tic_layanan_id" => $this->input->post("i_layanan"),
        "dtm" => date('Y-m-d H:i:s'),
        "alamat" => $this->input->post("i_alamat"),
        "reporter" => $this->input->post("i_reporter"),
        "sla" => $this->input->post("i_sla"),
        "tic_ktg_id" => $this->input->post("i_kategori"),
        "tic_subject_id" => $this->input->post("i_subject"),
        "body" => $this->input->post("i_body"),
        "node_id" => $this->input->post("i_node_id_inp"),
        "tic_node_id" => $this->input->post("i_node_id"),
        "grp" => $this->input->post("i_grp"),
        "pic" => $this->input->post("i_pic"),
        "prov_id" => $this->input->post("i_provinsi"),
        "kota_id" => $this->input->post("i_kota"),
        "status" => $this->input->post("i_status"),
        "notes" => $this->input->post("i_notes"),
        "lastupd" => date('Y-m-d H:i:s'),
        "updby" => $this->session->userdata('karyawan_id'),
        "file" => $file,
        ];

        $th = [ 
            "id" => $iddate,
            "ticketno" => 'TLK-'.$iddate,
            'createdby' => $this->session->userdata('id'),
            "customer" => $this->input->post("i_customer"),
            "dtm" => date('Y-m-d H:i:s'),
            "reporter" => $this->input->post("i_reporter"),
            "sla" => $this->input->post("i_sla"),
            "tic_ktg_id" => $this->input->post("i_kategori"),
            "tic_subject_id" => $this->input->post("i_subject"),
            "body" => $this->input->post("i_body"),
            "node_id" => $this->input->post("i_node_id_inp"),
            "tic_node_id" => $this->input->post("i_node_id"),
            "grp" => $this->input->post("i_grp"),
            "pic" => $this->input->post("i_pic"),
            "status" => $this->input->post("i_status"),
            "notes" => $this->input->post("i_notes"),
            "lastupd" => date('Y-m-d H:i:s'),
            "updby" => $this->session->userdata('karyawan_id'),
            ];

        $q = $this->mo->in($t);
        $tx = $this->mo->in_h($th);

        if ($q[1] == 1) {
          $status = 1;
          $msg = "Success to create ticket";
          $this->bantuan->kary_resp('1',$iddate,''); //ticketing tindak

          if (!empty($this->input->post("i_node_id"))) {
              $q_node = $this->mo->get_node($this->input->post("i_node_id"))->row()->node;
          }

          $this->stele($this->input->post("i_pic"),$this->input->post("i_customer"),$q_node,$this->input->post("i_grp"));
          
          //Kirim Notif Ke User
          if ($this->input->post("i_pic") != '' && $this->session->userdata('karyawan_id') != $this->input->post("i_pic")) {
                $this->notif->inNotif(
                $this->njudul,
                $this->session->userdata('karyawan_id'),
                $this->input->post("i_pic"),
                '<span class="label label-info">'.$this->njudul.'</span></br>Anda baru saja mendapatkan tugas baru, dengan Nomor Tiket <b><u>'.$iddate.'</u></b>',
                'oprations/my_ticket');
            }

        }

        $arr = [
            'msg' => $msg,
            'no_ticket' => $iddate,
            'status' => $status
        ];

        echo json_encode($arr);
    }

    // Send To telegram
    public function stele($idk='',$idc='',$node_id='',$grp='')
    {
        if ($idk == '' && $grp != '') {
            $this->mk->see = 'k.id,chat_id';
            $kg = $this->mk->getKaryawanChatByGrp($grp);
            if ($kg->num_rows() > 0) {
                foreach ($kg->result() as $kar) {
                    $chat_id = $kar->chat_id;
                    $cust = $this->db->get_where('cust_end',['id' => $idc ])->row()->custend;
                    $msg = "<a href='https://erp.matrik.co.id/oprations/my_group' >Attantion this '".$node_id."' at ".$cust." problem, please check !</a>";
                    $this->bantuan->sendTeleg($chat_id,$msg);
                 }
            }
        }else{
            $k = $this->db->get_where('karyawan',['id' => $idk]);
            if ($k->num_rows() > 0 ) {
                $kar = $k->row();
                $chat_id = $kar->chat_id;
                
                $cust = $this->db->get_where('cust_end',['id' => $idc ])->row()->custend;
                $msg = "<a href='https://erp.matrik.co.id/oprations/my_ticket' >Attantion this '".$node_id."' at ".$cust." problem, please check !</a>";
                $this->bantuan->sendTeleg($chat_id,$msg);
            }
        }
    }

    public function stele2($idk='',$msg='')
    {
        if($msg == '') return false;

        $k = $this->db->get_where('karyawan',['id' => $idk]);
        if ($k->num_rows() > 0 ) {
            $kar = $k->row();
            $chat_id = $kar->chat_id;
            
            if ($chat_id != '') {
                $this->bantuan->sendTeleg($chat_id,$msg);
            }
        }

        return true;

    }

    public function report()
    {
        $d = [
			'title' => 'Report',
			'linkView' => 'page/oprations/report',
            'fileScript' => 'report_ticket.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/report'),'active' => 'active'],
				]
            ],
            'pic' => $this->mo->getPicTicket(),
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function upTicket()
    {
        $msg = "Failed to change ticket";
        $status = 0;
       

        $t = [ 
        "customer" => $this->input->post("customert"),
        "reporter" => $this->input->post("reporter"),
        "sla" => $this->input->post("sla"),
        "tic_ktg_id" => $this->input->post("kategori"),
        "tic_subject_id" => $this->input->post("subject"),
        "tic_layanan_id" => $this->input->post("layanant"),
        "alamat" => $this->input->post("alamat"),
        "body" => $this->input->post("body"),
        "prov_id" => $this->input->post("provinsi"),
        "kota_id" => $this->input->post("kota"),
        // "status" => $this->input->post("status"),
        // "notes" => $this->input->post("notes"),
        "updBy" => $this->session->userdata('karyawan_id'),
        "lastupd" => date('Y-m-d H:i:s'),
        ];

        $th = [ 
            "id" => $this->input->post("id"),
            "ticketno" => $this->input->post("ticketno"),
            "customer" => $this->input->post("customert"),
            "createdBy" => $this->input->post("createdBy"),
            "reporter" => $this->input->post("reporter"),
            "dtm" => $this->input->post("dtm"),
            "sla" => $this->input->post("sla"),
            "tic_ktg_id" => $this->input->post("kategori"),
            "tic_subject_id" => $this->input->post("subject"),
            "body" => $this->input->post("body"),
            // "status" => $this->input->post("status"),
            // "notes" => $this->input->post("notes"),
            "lastupd" => date('Y-m-d H:i:s'),
            "updBy" => $this->session->userdata('karyawan_id'),
            ];

        $q = $this->mo->up($t,['id' => $this->input->post('id')]);
        

        $q = $this->mo->in_h($th);
        if ($q[1] == 1) {
          $status = 1;
          $msg = "Success to change ticket";
          $this->stele($this->input->post("pic"),$this->input->post("customer"),$this->input->post("node_id"));
        }
        $arr = [
            'msg' => $msg,
            'status' => $status
        ];

        echo json_encode($arr);
    }

    public function maintenance()
    {
        $d = [
			'title' => 'Maintenance',
			'linkView' => 'page/oprations/maintenance',
            'fileScript' => 'maintenance.js',
			'bread' => [
				'nama' => 'Maintenance',
				'data' => [
					['nama' => 'Maintenance','link' => site_url('oprations/maintenance'),'active' => 'active'],
				]
            ],
		];
		$this->load->view('_main',$d);
    }

    // Preventive Maintenance 

    public function countPm(){
        $data = $this->mo->getTglPm()->result();
        $count = 0;
        foreach($data as $d){
            if($d->status == 1){
                $count++;
            }
        }
        echo json_encode($count);
    }

    public function preventive()
	{
        $pm = [];
        $html_pm = '';
        $no = 1;

        // foreach ($this->mo->getPmJoinTglPm()->result() as $v) {
        //     $html_pm .= "<tr>";
        //     $html_pm .= "<td>".$no++."</td>";
        //     $html_pm .= "<td>".$v->nama_customer."</td>";
        //     $html_pm .= "<td>".$v->lokasi."</td>";
        //     $html_pm .= "<td>".$v->nama."</td>";
        //     $html_pm .= "<td>".$this->bantuan->tgl_indo($v->tanggal)."</td>";
        //     $html_pm .= "<td>".$v->problem."</td>";
        //     $html_pm .= "<td>".$v->description."</td>";
        //     $html_pm .= "<td>".$v->hasil."</td>";
        //     $html_pm .= "<td>".$this->setStatusPm($v->status)."</td>";
        //     $html_pm .= "<td>".$this->bantuan->accFitur('1','1',$this->session->userdata('karyawan_id'),'u','<a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="setPrev('.$v->idtm.')">Update</a>')[1]."</td>";
        //     $html_pm .= "</tr>";
        // }

		$d = [
			'title' => 'Preventive Maintenance',
			'linkView' => 'page/oprations/preventive',
            'fileScript' => 'prev_maintenance.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result(),
            'pm' => $html_pm
		];
		$this->load->view('_main',$d);
    }

    public function add_preventive()
	{
		$d = [
			'title' => 'Add Preventive Maintenance',
			'linkView' => 'page/oprations/add_preventive',
            'fileScript' => 'add_preventive.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result(),
            'teknisi' => $this->mk->get()->result(),
		];
		$this->load->view('_main',$d);
    }

    public function dt_pm()
    {
        echo $this->mo->dt_pm();
    }

    public function upPm()
    {
        $id = $this->input->post('id');
        $hasil = $this->input->post('hasil');
        $desc = $this->input->post('description');
        $status = $this->input->post('status');
        $date = $this->input->post('tanggal');

        $obj = [
            'hasil' => $hasil,
            'status' => $status,
            'desc' => $desc,
            'tanggal' => $date 
        ];

       $ok = $this->mo->setStatusTglPm($obj, $id);
       echo json_encode($ok);
    }

    public function inPm()
    {   

       foreach ($this->input->post('tanggal') as $v) {
            $obj = [
                'customer_id' => $this->input->post('customer'),
                'lokasi' => $this->input->post('lokasi'),
                'teknisi_id' => $this->input->post('teknisi'),
                'problem' => $this->input->post('problem'),
                'created_by' => $this->session->userdata('id'),
                'tanggal' => $v,
                'created_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            ];
    
            $this->mo->inPm($obj);
        }

        $this->session->set_flashdata('success', 'Success add Schedule Preventive Maintenance');
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function get_pm()
    {
        $id = $this->input->get('id');
        $q = $this->mo->get_pm($id)->row();
        echo json_encode($q);
    }

    public function setPm($id = ''){
        if($id != ''){
            $data = $this->mo->getTglPm($id)->result();
            echo json_encode($data);
        }else
        {
            echo json_encode('no data');
        }
    }

    public function daily_task()
	{
		$d = [
			'title' => 'Daily Task',
			'linkView' => 'page/oprations/daily_task',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function tcustomers_data()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/tcustomers_data',
            'fileScript' => 'tctr.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function add_tcustomer()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/add_tcustomer',
            'fileScript' => 'tctr.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function dttctr()
    {
        echo $this->mo->dttctr();
    }

    public function intctr()
    {
        foreach ($this->input->post('device') as $k => $v) {
          
            $obj = [
                'device' => $this->input->post('device')[$k],
                'ip_address' => $this->input->post('ip')[$k],
                'access' => $this->input->post('access')[$k],
                'port' => $this->input->post('port')[$k],
                'user' => $this->input->post('user')[$k],
                'password' => $this->input->post('password')[$k],
                'enable' => $this->input->post('enable')[$k],
                'customer_id' =>  $this->input->post('customer'),
                'created_date' => date('Y-m-d'),
                'created_by' => $this->session->userdata('id'),
            ];
    
            $this->db->insert('dt_pelanggan',$obj);
        }

        $d = [
            'msg' => "Success Add Teknis Pelanggan",
            'status' => 1,
        ];    

        echo json_encode($d);
    }

    public function setStatusPm($s)
    {
        if ($s == '1') {
            return 'On Schedule';
        }else if($s == '2'){
            return 'Done';
        }else if($s == '3'){
            return 'Close';
        }else if($s == '4'){
            return 'Reschedule';
        }
        
    }

    public function partner_request()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/partner_request',
            'fileScript' => '',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function customer_device()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/customer_device',
            'fileScript' => 'oprations/cust_device.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function detail_cd()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/detail_cd',
            'fileScript' => 'oprations/detail_cd.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function stock()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/stock',
            'fileScript' => 'stock.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            
            'customers' => $this->mc->getEnd()->result(),
		];
		$this->load->view('_main',$d);
    }

    public function get_stock(){
        $data = $this->mo->get_stock();
        echo $data;
    }

    public function add_stock(){
        $rsp = [
            'msg' => 'Gagal menambahkan stok',
            'status' => false
        ];

        $cek_sn = $this->db->get_where('scm_devices',['sn' => $this->input->post('sn')]);
        if ($cek_sn->num_rows() > 0) {
            $rsp['msg'] = "SN sudah pernah di input sebelumnya";
        }else{
            $data = array(
                'model' => $this->input->post('device'),
                'sn' => $this->input->post('sn'),
                'ctddate' => date('Y-m-d'),
                'ctdby' => $this->session->userdata('karyawan_id'),
                'status' => 'baik',
                'allocation' => 'operation',
                'used' => 'n'
            );
            
            $this->db->insert('scm_devices', $data);
            $x = $this->db->affected_rows();
            
            if($x > 0){
                $rsp['msg'] = "Berhasil menambah stok";
                $rsp['status'] = true;
            }
        }
        echo json_encode($rsp);
    }

    public function edit_stock(){
        $data = array(
            'merk' => $this->input->post('emerk'),
            'series' => $this->input->post('eseries'),
            'type' => $this->input->post('etype'),
            'sn' => $this->input->post('esn'),
            'mac' => $this->input->post('emac'),
            'warranty' => $this->input->post('ewarranty'),
            
    );
    
    $this->db->update('stock', $data,['id' => $this->input->post('ids')]);

    $status = $this->db->affected_rows();
    
    if($status > 0){
        redirect('oprations/stock');
    }else{
        echo"tes";
    }
    }

    public function del_stock($id){
        $this->db->delete('stock', array('id' => $id));

        $status = $this->db->affected_rows();
    
        if($status > 0){
            redirect('oprations/stock');
        }
    }

    public function tes2(){
        
        $dat = $this->db->get('stock')->result();
        echo json_encode($dat);

        
    }

    public function rma()
	{
		$d = [
			'title' => 'RMA Devices',
			'linkView' => 'page/oprations/rma',
            'fileScript' => 'oprations/rma.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function replace()
	{
		$d = [
			'title' => 'Technical Customers Data',
			'linkView' => 'page/oprations/replace',
            'fileScript' => 'oprations/replace.js',
            'dtRahasia' => 'dtTicket',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;

        //strtotime() use this function to convert
    }

    
    public function tes($bl = "", $th = ""){
        $all = $this->mo->tes();
        $status = [];
        if($th == ""){
            $th = date("Y");
        }
        if($bl == ""){
            $bl = date("m");
        }
        foreach($all as $a){
            $bln = explode("-",$a->dtm);
            $thn = explode(" ", $bln[0]);
            $forweek = explode(" ", $a->dtm);
            $week = $this->weekOfMonth(strtotime($forweek[0]));

            if($bln[1] == $bl){
                array_push($status, 
                ['status' => $a->status, 
                'bulan' => $bln[1],
                'cus' => $a->nama_customer,
                'week' => $week,
                'tgl' => explode(' ', $a->dtm)[0],
                'detail' => $a->body
                ]);
            }
            }

       echo json_encode($status);
    }

    // Setting

    public function inTicCategory()
    {
        $obj = [
            'nama_kategori' => $this->input->post('category')
        ];

        $k = $this->db->insert('tic_kategori', $obj);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil menambahkan kategori');
        }else{
            $resl = ctojson('',0,'Gagal menambahkan kategori');
        }

        echo $resl;
    }

    public function upTicCategory()
    {
        $obj = [
            'nama_kategori' => $this->input->post('e_category')
        ];

        $k = $this->db->update('tic_kategori', $obj,['id' => $this->input->post('e_id')]);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil mengubah kategori');
        }else{
            $resl = ctojson('',0,'Gagal mengubah kategori');
        }

        echo $resl;
    }

    public function deTicCategory()
    {
        $del = $this->db->delete('tic_kategori',['id' => $this->input->post('id')]);
        echo ctojson('',1,'Berhasil menghapus kategori');
    }

    public function tic_category()
    {
        $d = [
			'title' => 'Ticket Category',
			'linkView' => 'page/oprations/tic_category',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtMyticket/1',
			'bread' => [
				'nama' => 'Ticket Category',
				'data' => [
					['nama' => '','link' => site_url('oprations/my_ticket'),'active' => 'active'],
				]
            ]
		];
		$this->load->view('_main',$d);
    }

    // Ticket Subject

    public function inTicSubject()
    {
        $obj = [
            'nama_subject' => $this->input->post('subject'),
            'tic_ktg_id' => $this->input->post('kategori')
        ];

        $k = $this->db->insert('tic_subject', $obj);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil menambahkan subject');
        }else{
            $resl = ctojson('',0,'Gagal menambahkan subject');
        }

        echo $resl;
    }

    public function upTicSubject()
    {
        $obj = [
            'nama_subject' => $this->input->post('e_subject'),
            'tic_ktg_id' => $this->input->post('e_kategori')
        ];

        $k = $this->db->update('tic_subject', $obj,['id' => $this->input->post('e_id')]);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil mengubah subject');
        }else{
            $resl = ctojson('',0,'Gagal mengubah subject');
        }

        echo $resl;
    }

    public function deTicSubject()
    {
        $del = $this->db->delete('tic_subject',['id' => $this->input->post('id')]);
        echo ctojson('',1,'Berhasil menghapus subject');
    }

    public function tic_subject()
    {
        $d = [
			'title' => 'Ticket Subject',
			'linkView' => 'page/oprations/tic_subject',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtMyticket/1',
			'bread' => [
				'nama' => 'Ticket subject',
				'data' => [
					['nama' => '','link' => site_url('oprations/my_ticket'),'active' => 'active'],
				]
            ]
		];
		$this->load->view('_main',$d);
    }

    // Privilage

    public function privilage_menu()
    {
        $d = [
			'title' => 'Privilage',
			'linkView' => 'page/privilage/privilage_menu',
            'fileScript' => '',
            'dtRahasia' => 'dtMyticket/1',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => 'active'],
				]
            ]
		];
		$this->load->view('_main',$d);
    }

    public function privilage_submenu()
    {
        $d = [
			'title' => 'Privilage',
			'linkView' => 'page/privilage/privilage_submenu',
            'fileScript' => '',
            'dtRahasia' => 'dtMyticket/1',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => 'active'],
				]
            ]
		];
		$this->load->view('_main',$d);
    }

    public function privilage()
    {
        $d = [
			'title' => 'Privilage',
			'linkView' => 'page/privilage/privilage',
            'fileScript' => '',
            'dtRahasia' => 'dtMyticket/1',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => 'active'],
				]
            ]
		];
		$this->load->view('_main',$d);
    }

    // Laporan Ticket 

    private function jmlTicket($tahun='',$bulan='',$group='',$statuss='',$custend='',$tgl_mulai='',$tgl_akhir='')
    {
       $status = [
           'all' => 0,
           'new' => 0,
           'pending' => 0,
           'progress' => 0,
           'resolved' => 0,
           'closed' => 0,
       ];
       
       $q =  $this->mo->jmlAllTicketBy($bulan,$tahun,$group,$statuss,$custend,$tgl_mulai,$tgl_akhir);
       $jml = 0;
       foreach ($q->result() as $k) {
           if ($k->status != '') {
               $status[$k->status] = (int)$k->jml;
               $jml += $k->jml;
               $status['all'] = $jml;
           }
       }

       return  $status;
    }

    public function getTicketByDate()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $pic = $this->input->post('pic');
        $status = $this->input->post('status');
        $custend = $this->input->post('custend');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $date = $tahun.'-'.$bulan.'-01';

        $tgl = [];
        $data = [];
        $max = 0;
        
        $q = $this->mo->getJmlTicketByDate($date,$date,$status,$custend,$tgl_mulai,$tgl_akhir)->result();
        // echo json_encode($q);

        $last =  date("t", strtotime($date));
        for ($i=1; $i <= $last ; $i++) { 
           $tgl[$i] = 0;
        }

        foreach ($q as $v) {
            $jml = (int)$v->jml;
            if ($v->status != '') {
                $tgl[$v->tgl] = $jml;
                if ($max < $jml) {
                    $max = $jml;
                }
            }
        }

        $data = [
            'tgl' => array_keys($tgl),
            'data' => array_values($tgl),
            'max' => $max+5,
            'jml_ticket' => $this->jmlTicket($date,$date,'status',$status,$custend,$tgl_mulai,$tgl_akhir)
        ];

        echo json_encode($data);
    }

    public function dtReportTicket()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $status = $this->input->post('status');
        $custend = $this->input->post('custend');
        // $pic = $this->input->post('pic');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $date = $tahun.'-'.$bulan.'-01';

        echo $this->mo->dtReportTicket($date,$date,$status,$custend,$tgl_mulai,$tgl_akhir);
    }

    public function report_download()
    {
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=report-".date('YmdHis').".xls");

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $status = $this->input->get('status');
        $custend = $this->input->get('custend');
        $tgl_mulai = $this->input->get('tgl_mulai');
        $tgl_akhir = $this->input->get('tgl_akhir');

        $date = $tahun.'-'.$bulan.'-01';
        
        $html = '<style>table tr td {border:solid 1px;text-transform: uppercase;font-size:14px;width:100%;text-align:center;}</style>';

        $html .= '<table style="width:100%;border:solid 1px #DDD;">';
        $html .= '<tr><td colspan="17" style="text-align:center;background:#ffeb3b;">TIC REPORT</td></tr>';
        $html .= '<tr>';
            $html .= '<td>No</td>';
            $html .= '<td>No Ticket</td>';
            $html .= '<td>Open Ticket</td>';
            $html .= '<td>Close Ticket</td>';
            $html .= '<td>Time</td>';
            $html .= '<td>Pic</td>';
            $html .= '<td>Customer</td>';
            $html .= '<td>Node ID</td>';
            $html .= '<td>Kategori</td>';
            $html .= '<td>Problem</td>';
            $html .= '<td>Layanan</td>';
            $html .= '<td>Provinsi</td>';
            $html .= '<td>Status</td>';
            $html .= '<td>Action</td>';
            $html .= '<td>Detail Problem</td>';
            $html .= '<td>Note</td>';
            $html .= '<td>Urgency</td>';
        $html .= '</tr>';
       
        $q = $this->mo->getReportTicket($date,$date,$status,$custend,$tgl_mulai,$tgl_akhir);
        $no = 1; 

        foreach ($q->result() as $v) {
            $html .= '<tr>';
                $html .= '<td>'.$no++.'</td>';
                $html .= '<td>'.$v->id.'</td>';
                $html .= '<td>'.$v->dtm.'</td>';
                $html .= $v->status == 'closed' ? '<td>'.$v->ctddone.'</td>' : '<td>-</td>';
                $html .= $v->status == 'closed' ? '<td>'.$this->bantuan->ttr($v->id).'</td>' : '<td></td>';
                $html .= '<td>'.$v->nama.'</td>';
                $html .= '<td>'.$v->custend.'</td>';
                $html .= $v->node_id == '' ? '<td>'.$v->node.'</td>' : '<td>'.$v->node_id .'</td>';
                $html .= '<td>'.$v->nama_kategori.'</td>';
                $html .= '<td>'.$v->nama_subject.'</td>';
                $html .= '<td>'.$v->layanan.'</td>';
                $html .= '<td>'.$v->provinsi.'</td>';
                $html .= '<td>'.$v->status.'</td>';
                $html .= '<td>'.$v->s_closed.'</td>';
                $html .= '<td>'.$v->body.'</td>';
                $html .= '<td>'.$v->notes.'</td>';
                $html .= '<td>'.$this->mo->cekSla($v->sla,'0').'</td>';
            $html .= '</tr>';
          }

        $html .= '</table>';

        echo $html;
    }

  // Layanan

    public function tic_layanan()
    {
        $d = [
            'title' => 'Ticket Layanan',
            'linkView' => 'page/oprations/tic_layanan',
            'fileScript' => 'ticket.js',
            'dtRahasia' => 'dtMyticket/1',
            'bread' => [
                'nama' => 'Ticket Layanan',
                'data' => [
                    ['nama' => '','link' => site_url('oprations/my_ticket'),'active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }

    public function inTicLayanan()
    {
        $layanan = $this->input->post('layanan');
        
        $gl = $this->db->get_where('layanan',['id' => $layanan]);
        if($gl->num_rows() == 0 ) {
            $this->db->insert('layanan', ['layanan' => $layanan]);
            $layanan = $this->db->insert_id();
        }
         

        $obj = [
            'cust_end_id' => $this->input->post('customer'),
            'layanan_id' => $layanan,
            'ctddate' => date('Y-m-d H:i:s')
        ];

        $k = $this->db->insert('tic_layanan', $obj);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil menambahkan layanan');
        }else{
            $resl = ctojson('',0,'Gagal menambahkan layanan');
        }

        echo $resl;
    }

    public function upTicLayanan()
    {
        $obj = [
            'cust_end_id' => $this->input->post('e_custend'),
            'layanan_id' => $this->input->post('e_layanan')
        ];

        $k = $this->db->update('tic_layanan', $obj,['id' => $this->input->post('e_id')]);
        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = ctojson('',1,'Berhasil mengubah layanan');
        }else{
            $resl = ctojson('',0,'Gagal mengubah layanan');
        }

        echo $resl;
    }

    public function deTicLayanan()
    {
        $del = $this->db->update('tic_layanan',["dele" => 'Y'],['id' => $this->input->post('id')]);
        echo ctojson('',1,'Berhasil menghapus layanan');
    }


    public function dtTicLayanan()
    {
        echo $this->mo->dtTicLayanan();
    }  

    public function getTicLayanan($id='')
    {
        $k = $this->db->get_where('tic_layanan',['id' => $id]);
        if ($k->num_rows() > 0) {
            echo json_encode($k->row());
        }    
    }

    public function getLayananJson()
    {
        $id = $this->input->get('id');
        $cust_end = $this->input->get('cust_end');

        if ($id != '') {
            $q = $this->mo->layanan($id)->result();
        }else{
            $q = $this->mo->layanan()->result();
        }
        echo json_encode($q);
    }

    public function getTicLayananJson()
    {
        $id = $this->input->get('id');
        $cust_end = $this->input->get('cust_end');

        if ($id != '') {
            $q = $this->mo->tic_layanan($id)->result();
        }else if ($cust_end != '') {
            $q = $this->mo->tic_layanan('',$cust_end)->result();
        }else{
            $q = $this->mo->tic_layanan()->result();
        }
        echo json_encode($q);
    }

    // Provinsi
    public function getProvinsiJson()
    {
        $id = $this->input->get('id');
        if ($id != '') {
            $q = $this->db->get_where('provinsi',['id' => $id])->row();
        }else{
            $q = $this->db->get('provinsi')->result();
        }
        echo json_encode($q);
    }

    // Provinsi
    public function getKotaJson()
    {
        $provinsi_id = $this->input->get('provinsi_id');
        $id = $this->input->get('id');
        if ($id != '') {
            $q = $this->db->get_where('kota',['id' => $id])->row();
        }else if ($provinsi_id != '') {
            $q = $this->db->get_where('kota',['province_id' => $provinsi_id])->result();
        }else{
            $q = $this->db->get('kota')->result();
        }
        echo json_encode($q);
    }

    // Customer Device

    public function dt_cust_device()
    {
        $id = $this->input->post('id');
        echo $this->mo->dt_cust_device($id);
    }

    public function download_cd($id='')
    {
        $this->load->helper('download');
        $file = md5($id).'_'.date('ymd').'.xlsx';
        sample_cp('cust_device.xlsx',$file);
        redirect('./sample/'.$file);
    }

    public function import_cd()
    {
        $file = '';
        $msg = '';
        $ds = [];
        
        $id = $this->input->post('id');
        

        $this->load->library('upload');
        
        $config['upload_path']          = './sample/upload/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('device')){
        //    var_dump($this->upload->display_errors());
        }else{
           $file = $this->upload->data()['file_name'];
        }

        if ($file != '') {

            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./sample/upload/'.$file); // Load file yang telah diupload ke folder excel
            $getSheet = $loadexcel->getSheetNames();

            foreach ($getSheet as $rows) {
                $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
                $data = [];
                $numrow = 1;
                foreach ($sheet as $row) {

                    if ($numrow > 1) {
                        $d = [
                            'node_id' => $row['A'],	
                            'sn' => $row['B'],	
                            'model' => $row['C'],	
                            'device' => $row['C'],	
                            'ip' => $row['D'],	
                            'access' => $row['E'],	
                            'port' => $row['F'],	
                            'user' => $row['G'],	
                            'password' => $row['H'],	
                            'enable' => $row['I'],
                            'project' => $id,
                            'ctddate' => date('Y-m-d'),
                            'ctdby' => $this->session->userdata('karyawan_id'),
                            'status' => 'baik',
                            'allocation' => 'client' 
                       ];

                       array_push($ds,$d);

                    }

                    $numrow++; // Tambah 1 setiap kali looping
                }
            }
        }
        
        $rsp['data'] = $ds;

        if (count($ds) > 0) {

            $this->db->insert_batch('scm_devices', $ds);

            $rsp['status'] = true;
            $rsp['msg'] = "Berhasil import device";
            @unlink('./sample/upload/'.$file);
        }else{
            $rsp['status'] = false;
            $rsp['msg'] = "Gagal import device";
        }

        echo json_encode($rsp);
    }
    
    // Manage Divace Operation
    public function manage_device()
    {
        $d = [
			'title' => 'Manage Device',
			'linkView' => 'page/oprations/manage_device',
            'fileScript' => 'oprations/manage_device.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => site_url('oprations/ticket'),'active' => 'active'],
				]
            ],
            'customers' => $this->mc->getEnd()->result()
		];
		$this->load->view('_main',$d);
    }

    public function jsn_s_closed()
    {
       $q =  $this->db->get('tic_s_closed');
        echo json_encode($q->result());
    }

    // Node

    public function tic_node()
    {
        $d = [
            'title' => 'Ticket Node',
            'linkView' => 'page/oprations/node',
            'fileScript' => 'oprations/node.js',
            'bread' => [
                'nama' => 'Ticket Node',
                'data' => [
                    ['nama' => '','link' => site_url('oprations/my_ticket'),'active' => 'active'],
                ]
            ]
        ];
        $this->load->view('_main',$d);
    }

    public function get_node()
    {
        $id = $this->input->get('id');
        $q = $this->db->get_where('tic_node',['id' => $id])->row();
        echo json_encode($q);
    }

    public function in_node()
    {
        $node = $this->input->post('node');
        $cust = $this->input->post('cust');
        $layanan = $this->input->post('layanan');
    
        $this->db->insert('tic_node', [
            'node' => $node,
            'cust_id' => $cust,
            'tic_layanan_id' => $layanan,
        ]);

        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = [
                'msg' => 'Berhasil menambahkan node',
                'status' => true
            ];
        }else{
            $resl = [
                'msg' => 'Gagal menambahkan node',
                'status' => false
            ];
        }

        echo json_encode($resl);
    }

    public function up_node()
    {
        $id = $this->input->post('e_id');
        $node = $this->input->post('e_node');
        $cust = $this->input->post('e_cust');
        $layanan = $this->input->post('e_layanan');
    
        $this->db->update('tic_node', [
            'node' => $node,
            'cust_id' => $cust,
            'tic_layanan_id' => $layanan,
        ],['id' => $id]);

        $c = $this->db->affected_rows();
        if ($c > 0) {
            $resl = [
                'msg' => 'Berhasil mengubah node',
                'status' => true
            ];
        }else{
            $resl = [
                'msg' => 'Gagal mengubah node',
                'status' => false
            ];
        }

        echo json_encode($resl);
    }

    public function de_node()
    {
        $del = $this->db->delete('tic_node',['id' => $this->input->post('id')]);
        echo ctojson('',1,'Berhasil menghapus node');
    }


    public function dt_node()
    {
        echo $this->mo->dt_node();
    } 
    
    public function get_node_cl()
    {
        $cust = $this->input->get('cust');
        $layanan = $this->input->get('layanan');
        
        $q = $this->mo->get_node_cl($cust,$layanan);
        echo json_encode($q->result());
    }

    public function node_sample()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$items = [];

		$sheet->setCellValue('A1', 'Node');
		$sheet->setCellValue('B1', 'Cust');
		$sheet->setCellValue('C1', 'Layanan');
		$sheet->setCellValue('D1', 'Cust ID');
		$sheet->setCellValue('E1', 'Layanan ID');
			
			$xx= 2;
			for ($i=0; $i < @count($this->input->post('cust_id')); $i++) { 
				for ($x=0; $x < $this->input->post('qty')[$i]; $x++) { 
					$sheet->setCellValue('A'.$xx,'');
					$sheet->setCellValue('B'.$xx,$this->mc->getEnd($this->input->post('cust_id')[$i])->row()->custend );
					$sheet->setCellValue('C'.$xx,$this->mo->tic_layanan($this->input->post('tic_layanan_id')[$i])->row()->layanan );
					$sheet->setCellValue('D'.$xx,$this->input->post('cust_id')[$i]);
					$sheet->setCellValue('E'.$xx,$this->input->post('tic_layanan_id')[$i] );
					$xx++;
				}
			}
	
		$writer = new Xlsx($spreadsheet);
		$filename = 'node_'.date('Ymdhis');
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
    }
    
    // Import Node
	public function import_node()
    {
        $file = '';
        $msg = '';
        $node = [];
		$this->load->library('upload');
		
        $id = $this->input->post('id');

		$config['upload_path']          = './data/sample/';
        $config['allowed_types']        = 'xlsx';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_node')){
            $rsp['error'] = ($this->upload->display_errors());
        }else{
            $rsp['file'] = $this->upload->data()['file_name'];
        }
		
        if (!empty($rsp['file'])) {

            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('./data/sample/'.$rsp['file']); // Load file yang telah diupload ke folder excel
            $getSheet = $loadexcel->getSheetNames();
            foreach ($getSheet as $rows) {
                $sheet = $loadexcel->getSheetByName($rows)->toArray(null, true, true, true);
                $data = [];
				$numrow = 1;
                foreach ($sheet as $row) {
                    if ($numrow > 1) {
                        $d = [
							'node' => $row['A'],	
							'cust_id' => $row['D'],	
							'tic_layanan_id' => $row['E'],	
                        ];
                        
					   	array_push($node,$d);
					}
					
                    $numrow++; 
                }
            }
        }
        
        $rsp['data'] = $node;

        if (@count($rsp['data']) > 0) {
            $this->db->insert_batch('tic_node', $rsp['data']);
            $rsp['status'] = true;
            $rsp['msg'] = "Berhasil import node";
            @unlink('./data/sample/'.$rsp['file']);
        }else{
            $rsp['status'] = false;
            $rsp['msg'] = "Gagal import node";
        }

        echo json_encode($rsp);
	}
}
