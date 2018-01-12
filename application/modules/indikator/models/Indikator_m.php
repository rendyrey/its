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
}
/* End of file ${TM_FILENAME:${1/(.+)/lIndikator_m.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)  /Indikator_m/:application/models/${1/(.+)/l.php/}} */
