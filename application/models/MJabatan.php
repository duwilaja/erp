<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MJabatan extends CI_Model {

    private $t = 'jabatan';
    public $see = '*';
    private $id = 'id';

    public function get($id='',$where='',$query='',$limit='',$start='')
    {
        $q = false;

        if ($id != '') {
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, [$this->id => $id]);
        }elseif ($where != '') {
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get_where($this->t, $where);
        }elseif ($query != '') {
            $q = $this->db->query($query);
        }elseif($limit != ''){
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
            $q = $this->db->get_where($this->t,$where,$limit,$start);
        }else{
            $this->db->order_by('id', 'desc');
            $this->db->select($this->see);
           $q = $this->db->get($this->t);
        }

        return $q;
    }

    public function getHJabatan($idKaryawan='')
    {
        $q = '';
        if ($idKaryawan != '') {
            $this->db->select('nma_jabatan,j.id as idj,hj.id as id,period');
            $this->db->join('jabatan j', 'j.id = hj.jabatan_id', 'inner');
            $q = $this->db->get_where('h_jabatan hj', ['karyawan_id' => $idKaryawan]);
        }

        return $q;
    }

    public function getHJid($id='')
    {
        return $this->db->get('h_jabatan',['id' => $id])->row();
    }
   
    public function get_jabatan_grp($id='')
    {
        if ($id != '') {
            $q = $this->db->get_where('jabatan_grp',['id' => $id]);
        }else{
           $q = $this->db->get('jabatan_grp');
        }
        
        return $q;
    }

    // Datatabele Jabatan
    public function dt_jabatan($parent='',$leader='', $aktif=1)
    {
         // Definisi
         $condition = [] ;
         $data = [];
 
         $CI = &get_instance();
         $CI->load->model('DataTable', 'dt');
 
         // Set table name
         $CI->dt->table = 'jabatan j';
         // Set orderable column fields
         $CI->dt->column_order = [null, 'nma_jabatan', 'leader', 'nama_group'];
         // Set searchable column fields
         $CI->dt->column_search = ['nma_jabatan', 'nama_group'];
         // Set select column fields
         $CI->dt->select = 'j.id,nma_jabatan,leader,nama_group,grp_jabatan_id,parent_id';
         // Set default order
         $CI->dt->order = ['j.id' => 'desc'];
 
         $con4 = ['join','jabatan_grp jg','jg.id = j.grp_jabatan_id','left'];
         array_push($condition,$con4);
        
        if ($parent != '') {
            $con8 = ['where','j.parent_id',$parent];
            array_push($condition,$con8);
        }

        if ($leader != '') {
            $con8 = ['where','j.leader',$leader];
            array_push($condition,$con8);
        }

        if ($aktif != '') {
            $con8 = ['where','j.aktif',$aktif];
            array_push($condition,$con8);
        }
         
         // Fetch member's records
         $dataTabel = $this->dt->getRows($_POST, $condition);
         $i = $this->input->post('start');
         foreach ($dataTabel as $dt) {
             $i++;
             
             $data[] = array(
                 $i,
                 $dt->nma_jabatan,
                 $this->set_leader($dt->leader),
                 $dt->nama_group,
                 $this->get_jbtn_parent($dt->parent_id),
                 '<a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_form_edt_jabatan" onclick="edit_form_jabatan('.$dt->id.')"><i class="fa fa-edit"></i></a>
                 <a href="#" class="btn btn-default btn-sm" onclick="hapus_jabatan('.$dt->id.')"><i class="fa fa-trash"></i></a>'
             );
         }
 
         $output = array(
             "draw" => $this->input->post('draw'),
             "recordsTotal" => $this->dt->countAll($condition),
             "recordsFiltered" => $this->dt->countFiltered($_POST, $condition),
             "data" => $data,
         );
 
         // Output to JSON format
         return json_encode($output);
    }

    private function set_leader($leader='')
    {
        if($leader == '') return '';
        if($leader == '1') return 'Ya';
        if($leader == '0') return 'Bukan';
    }

    public function get_jbtn_parent($parent_id='')
    {
        if($parent_id == '') return '';
        $q = $this->db->get_where('jabatan',['id' => $parent_id]);
        if ($q->num_rows() > 0) {
            $x = $q->row();
            return $x->nma_jabatan;
        }
        return '';
    }

    // Insert Jabatan
    public function in_jabatan($obj='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = false;
        $id = 0;

        if ($obj != '') {
            $q = $this->db->insert($this->t, $obj);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success insert data";
                $status = true;
            }else{
                $msg = "Failed insert data";
            }
        }

        return [$msg,$status,$id];   
    }

    // Update jabatan
    public function up_jabatan($obj='',$id='')
    {
        $q = [];
        $msg = 'Object or Array is null';
        $status = false ;

        if ($obj != '' || $where != '') {
            $q = $this->db->update('jabatan', $obj,['id' => $id]);
            if ($this->db->affected_rows() > 0) {
                $msg = "Success update data";
                $status = false;
            }else{
                $msg = "Failed update data";
            }
        }

        return [$msg,$status];
        
    }
}