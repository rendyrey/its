<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapel_m extends CI_Model {

    var $table='mapel';
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
    public function delete($mapel_id)
    {
        $this->db->where('mapel_id',$mapel_id);
        $this->db->delete($this->table);
    }
    public function getid($categori_id)
    {
        $this->db->from($this->table);
        $this->db->where('categori_id',$categori_id);
        $query=$this->db->get();
        return $query->row();

    }
    public function actionupdate($id,$data)
    {

        $this->db->where('mapel_id', $id);
        $this->db->update($this->table, $data);
    }
    public function get_mapel_detail($id)
    {
        $result =   $this->db->select('mapel.*, categori.nama_categori')
                    ->where('mapel_id',$id)
                    ->from('mapel')
                    ->join('categori','categori.categori_id=mapel.categori_id','left')
                    ->get()
                    ->row();
        return $result;
    }
    public function getall()
    {
        $result =$this->db->select('mapel.*')
                ->from('mapel')
                ->get()
                ->result();
        return $result;
    }
    public function getallcat($id)
    {
        $result =$this->db->select('mapel.*, categori.nama_categori')
                ->where('mapel.categori_id',$id)
                ->from('mapel')
                ->join('categori','categori.categori_id = mapel.categori_id','left')
                ->get()
                ->result();
        return $result;
    }

}
