<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sharedev extends MY_controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MSharedev','ms');
	}
    
	public function list_document()
	{
		$d = [
			'title' => 'Document',
			'linkView' => 'page/sharedev/document',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => 'List Document',
				'data' => [
					['nama' => 'List Document','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

	public function dtDocument()
	{
		echo $this->ms->dt();
	}

	public function add_document()
	{
		$d = [
			'title' => 'Add Document',
			'linkView' => 'page/sharedev/add_document',
			'fileScript' => 'sharedev.js',
			'bread' => [
				'nama' => 'Add Document',
				'data' => [
					['nama' => 'List Document','link' => site_url('Sharedev/list_document'),'active' => ''],
					['nama' => 'Add Document','link' => '','active' => 'active'],
				]
			],
		];
		$this->load->view('_main',$d);
	}

}
