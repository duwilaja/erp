
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MUsers','mu');
	}

    public function getPIC($group='')
    {
        $this->mu->see = "k.nama,u.username,k.id as id,u.id as uid";
        $q = $this->mu->getUser('',['group' => $group]);
        echo json_encode($q->result());
    }   

}
