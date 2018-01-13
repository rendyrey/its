<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Indikator_m extends CI_Model {

  var $table='indikator';
public function insert($data)
  {
      $this->db->insert($this->table,$data);
      return $this->db->insert_id();
  }
  public function getall()
  {
      $result =$this->db->select('indikator.*, mapel.nama_mapel,kompetensi.nama_kompetensi')
              ->from('indikator')
              ->join('mapel','mapel.mapel_id = indikator.mapel_id','left')
              ->join('kompetensi','kompetensi.kompetensi_id = indikator.kompetensi_id','left')
              ->get()
              ->result();
      return $result;
  }

  public function deleteindikator($id)
  {
      $this->db->where('id_indikator',$id);
      $this->db->delete($this->table);
  }

  public function get_indikator_detail($id)
  {
      $result =   $this->db->select('indikator.*, mapel.nama_mapel')
                  ->where('id_indikator',$id)
                  ->from('indikator')
                  ->join('mapel','mapel.mapel_id=indikator.mapel_id','left')
                  ->get()
                  ->row();
      return $result;
  }

  public function actionupdate($id,$data)
  {

      $this->db->where('id_indikator', $id);
      $this->db->update($this->table, $data);
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/lIndikator_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)  /Indikator_m/:application/models/${1/(.+)/l.php/}} */
