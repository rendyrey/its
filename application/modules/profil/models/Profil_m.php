<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_m extends CI_Model {

	public function getid($id)
    {
        $this->db->from('user');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row();
    }
    public function updateprofil($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

}

/* End of file profil_m.php */
/* Location: ./application/models/profil_m.php */