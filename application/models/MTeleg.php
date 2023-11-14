<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MTeleg extends CI_Model {
    
    private $token = "949635145:AAGmpoIpI3No34qEjv9yVXvRT4tmDV0FnUI";
    
    public $id_pl = 0;
    public $task = "";
    public $nama_user = "";
    public $pic_sts = "";
    public $pic_tcel = "";
    public $status = "";
    public $priority = "";
    public $detail_task = "";
    public $note = "";
    public $review = "";
    public $kolom = "";
    
    public function kirimPesan($id_tujuan="",$msg="",$req = "")
    {
        // Daftarkan variabel
        $msg = "";
        $data = "";
        $res = "";
        $status = 0;
        
        // Jika req == kosong
        if ($req == "") {
            
            // Kondisi jika paramter wajib disi dua-duanya
            if ($id_tujuan != "" && $msg != "") {
                // Param yg akan di kirim
                $req = [
                    'chat_id' => $id_tujuan,
                    'text' => $msg,
                    'parse_mode' => 'html'
                ];
                
            }else{
                // Gagal karena paramter tidak diisi salah satu atau dua-duanya
                $msg = "id_tujuan dan pesan => tidak di isi atau salah satu nilainya ada yg kosong";
            }
        }
        
        // Request ke api sendMessage Telegram
        $data = $this->getApi('sendMessage',$req);
        
        // Kondisi cek status jika 1 berhasil / 0 => gagal
        if ($data['status'] == 1) {
            $status = 1;
            $msg = "Berhasil kirim pesan ke telegram";
        }
        
        // Jika status (!= 0) => gagal
        $msg = "Model TelegramModel.php -> Error line 29 sampai line atas, kemungkinan response api gagal";
        
        //  Hasil res response 
        $res = [
            'msg' => $msg,
            'data' => $data,
            'status' => $status
        ];
        
        return $res;
    }
    
    #API
    public function getApi($fungsi="",$request_params=[])
    {
        // Daftarkan variabel
        $msg = "";
        $data = "";
        $res = "";
        $status = 0;
        
        // Pengecekan kondisi
        if ($request_params != "" || $fungsi != "") {
            $request_url = "https://api.telegram.org/bot".$this->token."/".$fungsi."?". http_build_query($request_params);
            $data = file_get_contents($request_url);
            
            $msg = "Berhasil ke proses api Telegram";
            $status = 1;
        }else{
            $msg = "Mohon untuk masukan param yg ingin direquest";
        }
        
        //  Hasil res response 
        $res = [
            'msg' => $msg,
            'data' => json_decode($data),
            'status' => $status
        ];
        
        return $res; 
    }

    public function getApiSendMsg($chat_id='',$msg='')
    {
        // Daftarkan variabel
        $data = "";
        $res = "";
        $status = 0;
        
        // Pengecekan kondisi
        if ($chat_id != "" || $fungsi != "") {
            $request_url = "https://api.telegram.org/bot".$this->token."/sendMessage?chat_id=".$chat_id."&text=".$msg."&parse_mode=html";
            $data = file_get_contents($request_url);
            
            $msg = "Berhasil ke proses api Telegram";
            $status = 1;
        }else{
            $msg = "Mohon untuk masukan param yg ingin direquest";
        }
        
        //  Hasil res response 
        $res = [
            'msg' => $msg,
            'data' => json_decode($data),
            'req' => $request_url,
            'status' => $status
        ];
        
        return $res; 
    }

    #OPTIONAL

    public function msgToTelegram($type="")
    {
        $this->load->library('user_agent');
        $this->load->helper('text');
        
        if ($this->agent->is_browser())
        {
            $agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
            $agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
            $agent = $this->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }
        $platform = $this->agent->platform();
        $msg = "";
        
        if ($type == "i") {
           
            $msg .= "<b>INFO PROJECT</b>\n";
            $msg .= "(+) <i>Penambahan Task Baru : </i><a href='http://150.242.111.235/project/Project_List/charter?id_pc=".$this->id_pl."'>".$this->task."</a> \n";
            $msg .= "Oleh User : <code>".$this->nama_user."</code>\n";
            $msg .= "Updated : <code>".date('Y-m-d H:i:s')."</code>\n";
            $msg .= "Platform : <code>".$platform."</code>\n";
            $msg .= "Access : <code>".$agent."</code>\n";
            $msg .= "IP Address : <code>".$this->input->ip_address()."</code>\n\n";
            
            $msg .= "<b>DETAIL</b>\n";
            $msg .= "Task : <code>".$this->task."</code>\n";
            $msg .= "Detail Task : <code>".character_limiter($this->task,60)."</code>\n";
            $msg .= "Pic STS: <code>".$this->pic_sts."</code>\n";
            $msg .= "Pic Tcel: <code>".$this->pic_tcel."</code>\n";
            $msg .= "Status : <code>".$this->status."</code>\n";
            $msg .= "Priority : <code>".$this->priority."</code>\n";
            $msg .= "Note : <code>".character_limiter($this->note, 60)."</code>\n";
            $msg .= "Review : <code>".character_limiter($this->review, 60)."</code>\n";
            $msg .= "<a href='http://150.242.111.235/project/Project_List/charter?id_pc=".$this->id_pl."'> >> Link Detail</a> \n";
        
        }elseif ($type == "u") {
          
            $msg .= "<b>INFO PROJECT</b>\n";
            $msg .= "<i>Edit Task Baru : </i><a href='http://150.242.111.235/project/Project_List/charter?id_pc=".$this->id_pl."'>".$this->task."</a> \n";
            $msg .= "Oleh User : <code>".$this->nama_user."</code>\n";
            $msg .= "Updated : <code>".date('Y-m-d H:i:s')."</code>\n";
            $msg .= "Platform : <code>".$platform."</code>\n";
            $msg .= "Access : <code>".$agent."</code>\n";
            $msg .= "IP Address : <code>".$this->input->ip_address()."</code>\n";
       
        }elseif ($type == "d") {
           
            $msg .= "<b>INFO PROJECT</b>\n";
            $msg .= "(-) <i>Hapus Task : </i><a href='http://150.242.111.235/project/Project_List/project_list'>".$this->task."</a> \n";
            $msg .= "Oleh User : <code>".$this->nama_user."</code>\n";
            $msg .= "Updated : <code>".date('Y-m-d H:i:s')."</code>\n";
            $msg .= "Platform : <code>".$platform."</code>\n";
            $msg .= "Access : <code>".$agent."</code>\n";
            $msg .= "IP Address : <code>".$this->input->ip_address()."</code>\n";

        }
        
        return $msg;
    }

    
}

/* End of file TelegramModel.php */
