<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categori_m extends CI_Model { 
    public function __construct() {

parent::__construct();

}
    
    var $table='categori';
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
    public function delete($categori_id)
    {
        $this->db->where('categori_id',$categori_id);
        $this->db->delete($this->table);
    }
    public function getid($categori_id)
    {
        $this->db->from($this->table);
        $this->db->where('categori_id',$categori_id);
        $query=$this->db->get();
        return $query->row();

    }
    public function actionupdate($where,$data)
    {
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }
    public function getcategori()
    {
        $this->db->order_by('nama_categori','asc');
        $result=$this->db->get('categori')->result();
        return $result;
    }
     public function get_categories()
    {
        $this->db->order_by('nama_categori','asc');
        $result=$this->db->get('categori')->result();
        return $result;
    }
    
}
