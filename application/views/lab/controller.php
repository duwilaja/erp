	public function partner_list()
	{
		$d = [
			'title' => 'Partner List',
			'linkView' => 'page/vm/partner_list',
			'fileScript' => 'vm/partner_list.js',
			'bread' => [
				'nama' => 'Partner List',
				'data' => [
					['nama' => '','link' => site_url('Sharedev/list_document'),'active' => 'active'],
				]
			],
			'category' => $this->vm->getCategory()->result() 
		];
		$this->load->view('_main',$d);
	}
	
	public function dtPartner()
	{
		echo $this->vm->dtPartner();
	}

	public function inPartner()
	{
		$var = [
			"name" => $this->input->post("name"),
			"aktif" => 1,
			"phone" => $this->input->post("phone"),
			"address" => $this->input->post("address"),
			"cp_id" => $this->input->post("cp_id"),
			"area" => $this->input->post("area"),
			"location" => $this->input->post("location"),
			"status" => $this->input->post("status"),
			"remaks" => $this->input->post("remarks"),
			"created_date" => date('Y-m-d'),
			"created_by" => $this->session->userdata('karyawan_id')
		];

		$q = $this->db->insert('part_person',$var);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses menambahkan data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal menambahkan data baru');
		}

		echo $jsn;
	}

	public function upPartner()
	{
		$var = [
			"name" => $this->input->post("e_name"),
			"aktif" => $this->input->post("e_aktif"),
			"cp_id" => $this->input->post("e_category"),
			"phone" => $this->input->post("e_phone"),
			"address" => $this->input->post("e_address"),
			"area" => $this->input->post("e_area"),
			"location" => $this->input->post("e_location"),
			"status" => $this->input->post("e_status"),
			"remaks" => $this->input->post("e_remark"),
			"created_date" => date('Y-m-d'),
			"created_by" => $this->session->userdata('karyawan_id')
		];

		$q = $this->db->update('part_person',$var,['id' => $this->input->post('e_id')]);
		$q1=$this->db->affected_rows();
		if ($q1 > 0) {
			$jsn = ctojson($var,1,'Sukses mengubah data baru');
		}else{
			$jsn = ctojson($var,0,'Gagal mengubah data baru');
		}

		echo $jsn;
	}

	public function dePartner()
	{
		$id = $this->input->get('id');
		$g = $this->db->delete('part_person',['id' => $id]);
		
		echo ctojson('',1,'Sukses menghapus data');
	}

	public function getPartner()
	{
		$id = $this->input->get('id');
		$g = $this->db->get_where('part_person',['id' => $id]);
		if ($g->num_rows() > 0) {
			$data = $g->row();
			
			if ($data->cp_id != '') $data->ncategory = $this->vm->getCategory($data->cp_id)->row()->category;
			$data->nstatus = $this->vm->setStatus($data->status);

			$jsn = ctojson($data,1,'Sukses menampilkan data');
		}else{
			$jsn = ctojson('',0,'Gagal menampilkan data');
		}

		echo $jsn;
	}