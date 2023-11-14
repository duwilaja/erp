<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPrivilage extends CI_Model {

    // Menu

    public function getMenuJson($id='')
    {
        if ($id != '') {
            $q = $this->db->get_where('m_access',['id' => $id]);
            $r = $q->row();
        }else{
            $q = $this->db->get('m_access');
            $r = $q->result();
        }
        
        if ($q->num_rows() > 0) {
           return $r;
        }

    }


    public function getMenuJabJson($id='')
    {
        $this->db->select('id,menu');
        if ($id != '') {
            $q = $this->db->get_where('m_access',['jabatan_id' => $id]);
            $r = $q->result();
            $c = $q->num_rows();
        }else{
            $q = $this->db->get('m_access');
            $r = $q->result();
            $c = $q->num_rows();
        }
        
        return [$r,$c];
    }

    public function dtMenu()
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'm_access m';
        // Set orderable column fields
        $CI->dt->column_order = [null,'j.nma_jabatan','m.menu'];
        // Set searchable column fields
        $CI->dt->column_search = ['j.nma_jabatan','m.menu'];
        // Set select column fields
        $CI->dt->select = 'm.id,m.menu,j.nma_jabatan';
        // Set default order
        $CI->dt->order = ['m.id' => 'desc'];

        $con = ['join','jabatan j','j.id = m.jabatan_id','inner'];
        array_push($condition,$con);
        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->menu,
                $dt->nma_jabatan,
                '<a href="#" class="btn btn-success btn-sm" onclick="getMenu('.$dt->id.')"><i class="far fa-edit"></i></a>
                 <a href="#" onclick="deMenu('.$dt->id.')" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>',
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

    // Submenu

    public function getSubmenuJson($id='')
    {
        if ($id != '') {
            $this->db->select('msa.*,ma.jabatan_id');
            $this->db->join('m_access ma', 'ma.id = msa.m_access_id', 'inner');
            $q = $this->db->get_where('m_sub_access msa',['msa.id' => $id]);
            $r = $q->row();
            $c = $q->num_rows();
        }else{
            $q = $this->db->get('m_sub_access msa');
            $r = $q->result();
            $c = $q->num_rows();
        }
        
        return [$r,$c];
    }

    public function getSubmenuMenJson($id='')
    {
        $this->db->select('id,submenu,fitur');

        if ($id != '') {
            $q = $this->db->get_where('m_sub_access',['m_access_id' => $id]);
            $r = $q->result();
            $c = $q->num_rows();
        }else{
            $q = $this->db->get('m_sub_access');
            $r = $q->result();
            $c = $q->num_rows();
        }
        
         return [$r,$c];
    }

    public function dtSubmenu()
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'm_sub_access ms';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'j.nma_jabatan','m.menu','ms.submenu'];
        // Set searchable column fields
        $CI->dt->column_search = ['j.nma_jabatan','m.menu','ms.submenu'];
        // Set select column fields
        $CI->dt->select = 'ms.id,m.menu,j.nma_jabatan,ms.submenu';
        // Set default order
        $CI->dt->order = ['ms.id' => 'desc'];

        $con2 = ['join','m_access m','m.id = ms.m_access_id','inner'];
        array_push($condition,$con2);

        $con = ['join','jabatan j','j.id = m.jabatan_id','inner'];
        array_push($condition,$con);

        
        // Fetch member's records
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nma_jabatan,
                $dt->menu,
                $dt->submenu,
                '<a href="#" class="btn btn-success btn-sm" onclick="getSubmenu('.$dt->id.')"><i class="far fa-edit"></i></a>
                 <a href="#" onclick="deSubmenu('.$dt->id.')" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>',
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

    public function dtPrivilage()
    {
        // Definisi
        $condition = [];
        $data = [];
        
        $CI = &get_instance();
        $CI->load->model('DataTable', 'dt');
        
        // Set table name
        $CI->dt->table = 'p_access p';
        // Set orderable column fields
        $CI->dt->column_order = [null, 'k.nama','j.nma_jabatan'];
        // Set searchable column fields
        $CI->dt->column_search = ['k.nama','j.nma_jabatan'];
        // Set select column fields
        $CI->dt->select = 'p.id,karyawan_id,k.nama,j.nma_jabatan';
        // Set default order
        $CI->dt->order = ['p.id' => 'desc'];

        $con2 = ['join','karyawan k','k.id = p.karyawan_id','inner'];
        array_push($condition,$con2);

        $con = ['join','jabatan j','j.id = k.jabatan_id','inner'];
        array_push($condition,$con);

        $this->db->group_by('karyawan_id');
        
        $dataTabel = $this->dt->getRows($_POST, $condition);
        
        $i = $_POST['start'];
        foreach ($dataTabel as $dt) {
            $i++;
            $data[] = array(
                $i,
                $dt->nama,
                $dt->nma_jabatan,
                '<a href="#" class="btn btn-dark btn-sm" onclick="getPrivilage('.$dt->karyawan_id.')" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-info-circle"></i></a>',
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

    // Get Menu with P_access
    public function getMenuPacc($id='')
    {
        $this->db->select('m.id,m.menu');
        $this->db->join('m_access m', 'm.id = p.m_access_id', 'inner');
        $this->db->where('p.karyawan_id', $id);
        $this->db->group_by('p.m_access_id');
        $p = $this->db->get('p_access p');
        return $p;
    }

    // Get Submenu with p_access
    public function getSubmenuPacc($id='')
    {
        $this->db->select('ms.id,ms.submenu,p.m_access_id,p.fitur');
        $this->db->join('m_sub_access ms', 'ms.id = p.sub_acc_id', 'inner');
        $this->db->where('p.karyawan_id', $id);
        $this->db->group_by('p.sub_acc_id');
        $p = $this->db->get('p_access p');
        return $p;
    }
}