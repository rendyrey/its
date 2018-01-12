<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kompetensi_m extends CI_Model {

    var $table='kompetensi';
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
    public function deletekompetensi($id)
    {
        $this->db->where('kompetensi_id',$id);
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

        $this->db->where('kompetensi_id', $id);
        $this->db->update($this->table, $data);
    }
    public function getsubcategori()
    {
        $this->db->select('*');
        $this->db->from('subcategori');
        $result=$this->db->get()->result();
        return $result;
    }
    public function getall()
    {
        $result =$this->db->select('kompetensi.*, mapel.nama_mapel')
                ->from('kompetensi')
                ->join('mapel','mapel.mapel_id = kompetensi.mapel_id','left')
                ->get()
                ->result();
        return $result;
    }
    public function getallcat($cat,$map)
    {
        $result =$this->db->select('kompetensi.*, mapel.nama_mapel, categori.nama_categori')
                ->where('kompetensi.categori_id',$cat)
                ->where('kompetensi.mapel_id',$map)
                ->from('kompetensi')
                ->join('categori','categori.categori_id = kompetensi.categori_id','left')
                ->join('mapel','mapel.mapel_id = kompetensi.mapel_id','left')
                ->get()
                ->result();
        return $result;
    }
    public function get_categories()
    {
        $this->db->order_by('nama_categori','asc');
        $result=$this->db->get('categori')->result();
        return $result;
    }
    public function get_subcategori_by_cat_id($id)
    {

        $this->db->select('*');
        $this->db->where('categori_id', $id);
        $this->db->from('mapel');
        $result = $this->db->get()->result();
        return $result;
    }
    public function add_kursus_title($upload_data='')
    {
        $info=array();
        $info['kursus_title'] = $this->input->post('kursus_title');
        $info['kursus_intro'] = $this->input->post('kursus_intro', TRUE);
        $info['kursus_description'] = $this->input->post('kursus_description', TRUE);
        $info['kursus_requirement'] = $this->input->post('kursus_requirement', TRUE);
        $info['target_audience'] = $this->input->post('target_audience', TRUE);
        $info['what_i_get'] = $this->input->post('what_i_get', TRUE);
       // $info['kursus_price'] = $this->input->post('price', TRUE);
        $info['categori_id'] = $this->input->post('category', TRUE);
        $info['created_by'] = $this->session->userdata['user_id'];
        $info['feature_image'] = ($upload_data == '')?'':$upload_data;
        $if_exist = $this->db->get_where('kursus', array('kursus_title' => $info['kursus_title']), 1)->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('kursus', $info);
            if ($this->db->affected_rows() == 1) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }

    }
    public function get_kompetensi_detail($id)
    {
        $result =   $this->db->select('kompetensi.*, mapel.nama_mapel')
                    ->where('kompetensi_id',$id)
                    ->from('kompetensi')
                    ->join('mapel','mapel.mapel_id=kompetensi.mapel_id','left')
                    ->get()
                    ->row();
        return $result;
    }
    public function get_sections($id)
    {
        $result     =$this->db->order_by('orderlist', 'asc')
                    ->where('kursus_id', $id)
                    ->get('kursus_sections')
                    ->result();
        return $result;
    }
    public function get_kursus($id)
    {
        $result     =$this->db->select('*')
                    ->where('section_id', $id)
                    ->order_by('orderlist','asc')
                    ->from('kursus_sections')
                    ->get()
                    ->result();
        return $result;
    }
    public function save_sections_m()
    {
       $sections = $this->input->post('section', TRUE);
        $i=1;
        foreach ($sections as $value) {
            if ($value != '') {
                $info = array();
                $info['section_name'] = 'SUB-MATERI '.$i;
                $info['section_title'] = $value;
                $info['kursus_id'] = $this->input->post('kursus_id', TRUE);
                $this->db->insert('kursus_sections', $info);
                $i++;
            }
        }
        return TRUE;
    }

    public function update_kursus_title($id,$upload_data='')
    {
        $info=array();
         $info['kursus_title'] = $this->input->post('kursus_title');
        $info['kursus_intro'] = $this->input->post('kursus_intro', TRUE);
        $info['kursus_description'] = $this->input->post('kursus_description', TRUE);
        $info['kursus_requirement'] = $this->input->post('kursus_requirement', TRUE);
        $info['target_audience'] = $this->input->post('target_audience', TRUE);
        $info['what_i_get'] = $this->input->post('what_i_get', TRUE);
       // $info['kursus_price'] = $this->input->post('price', TRUE);
        $info['categori_id'] = $this->input->post('category', TRUE);
        $info['created_by'] = $this->session->userdata['user_id'];
        $info['feature_image'] = ($upload_data == '')?'':$upload_data;
        $this->db->where('kursus_id',$id);
        $this->db->update('kursus',$info);
        if($this->db->affected_rows()==1){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    public function get_materi_detail_m($id)
    {
        $hasil  = $this->db->select('*')
                ->where('section_id',$id)
                ->from('kursus_sections')
                ->order_by('section_id','asc')
                ->join('kursus','kursus.kursus_id = kursus_sections.kursus_id')
                ->get()
                ->row();
        return $hasil;
    }

    public function ambil_materi()
    {
        $result=$this->db->select('*')
                ->from('kursus_document')
                ->join('kursus_sections','kursus_sections.section_id = kursus_document.section_id ','left')
                ->join('kursus','kursus_sections.kursus_id = kursus.kursus_id','left')
                ->join('categori','categori.categori_id = kursus.categori_id','left')
                //->join('categori','subcategori.cat_id = categori.categori_id')
                ->get()
                ->result();
        return $result;
    }
    public function saranmateri()
    {
        $result=$this->db->select('*')

                ->from('hasillatihan')
                ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id','left')
                ->join('categori','categori.categori_id = tbl_latihan.categori_id','left')
                //->join('categori','subcategori.cat_id = categori.categori_id','left')
                ->join('kursus','kursus.categori_id = categori.categori_id','left')
                ->join('kursus_sections','kursus.kursus_id = kursus_sections.kursus_id','left')
                ->join('kursus_document','kursus.section_id = kursus_sections.section_id')
                ->get()
                ->result();
        return $result;
    }
}
