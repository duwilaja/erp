<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Mdttbl','md');
    }
    
    public function index()
    {
        $d = [
            'title' => 'Login to Matrik Application System',
            'fileScript' => 'datatable.js',
		];
		$this->load->view('datatable',$d);
    }

}
