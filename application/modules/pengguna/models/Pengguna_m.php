<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna_m extends CI_Model { 
    var $table='user';
	public function insert($data)
    { 
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    
    public function tampil()
    {
    	$this->db->from($this->table);
		$query=$this->db->get();
		return $query->result();
    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    public function getid($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row();

    }
    public function actionupdate($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }
    public function nonaktifkan_pengguna_m($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }
    public function aktifkan_pengguna_m($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }
    
}
