<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends MY_controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function links()
    {
        $id = $this->input->get('id');
        $redi = urldecode($this->input->get('redirect'));
        $this->notif->readNotif($id);
        return redirect($redi);
    }

    public function notif()
    {
        $d = [
			'title' => 'Notification',
			'linkView' => 'page/notification',
            'fileScript' => 'notif/notif.js',
			'bread' => [
				'nama' => '',
				'data' => [
					['nama' => '','link' => '','active' => 'active'],
				]
            ],
            'notif' => $this->notif->getMeNotif()[0]
		];
		$this->load->view('_main',$d);
    }

    public function dt_notif()
    {
        echo $this->notif->dt_notif();
    }

}
