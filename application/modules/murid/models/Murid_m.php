<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Murid_m extends CI_Model {

    public function get_my_hasillatihan($id)
    {
        $hasil  =$this->db->select('*')
                ->from('hasillatihan')
                ->where('hasillatihan.user_id',$id)
                ->order_by('hasillatihan.latihan_taken_date','asc')
                ->join('user','user.id = hasillatihan.user_id','left')
                ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id','left')
                ->get()
                ->result();
        return $hasil;
    }
    public function get_my_hasilujian($id)
    {
        $hasil  =$this->db->select('*')
                ->from('hasil')
                ->where('hasil.user_id',$id)
                ->order_by('hasil.ujian_taken_date','asc')
                ->join('user','user.id = hasil.user_id','left')
                ->join('tbl_ujian','tbl_ujian.title_id = hasil.ujian_id','left')
                ->get()
                ->result();
        return $hasil;
    }
     public function saran($id)
    {
        $hasil  =$this->db->select('*')
                ->from('hasillatihan')
                ->where('hasillatihan.user_id',$id)
                ->join('user','user.id = hasillatihan.user_id','left')
                ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id')
                ->join('categori','categori.categori_id = tbl_latihan.categori_id')
                //->join('categori','categori.categori_id = subcategori.cat_id')
                ->join('kursus','categori.categori_id = kursus.categori_id')
                ->join('kursus_sections','kursus.kursus_id = kursus_sections.kursus_id')
                ->join('kursus_document','kursus_sections.section_id = kursus_document.section_id')
                ->get()
                ->result();
        return $hasil;
    }
     public function saran2($latihan_id)
    {
        $hasil  =$this->db->select('*')
                ->from('hasillatihan')
                ->where('hasillatihan.latihan_id',$latihan_id)
                ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id','left')

                ->get()
                ->result();
        return $hasil;
    }

    public function update_pretest($id){
      $this->db->set('pretest',1);
      $this->db->where('id',$id);
      $this->db->update('user');
    }

}
