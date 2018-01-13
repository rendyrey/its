<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Latihan_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_latihan()
    {
        $result =$this->db->select('*')
                ->select('tbl_latihan.active AS latihan_active')
                ->from('tbl_latihan')
               // ->join('categori','subcategori.cat_id = categori.categori_id','left')
                //->join('subkelas','subkelas.id = tbl_latihan.kelas_id','left')
                //->join('kelas','subkelas.kel_id = kelas.kelas_id','left')
                ->join('user','user.id = tbl_latihan.user_id')
                ->get()
                ->result();
        return $result;
    }


    public function add_latihan_title($upload_data='')
    {
       // date_default_timezone_set($this->session->userdata['time_zone']);
        $info=array();
        $info['categori_id']    =$this->input->post('category',TRUE);
       // $info['kelas_id']    =$this->input->post('kelas',TRUE);
        $info['judul_latihan']     =$this->input->post('latihan_title',TRUE);
        $info['user_id']        =$this->session->userdata('user_id',TRUE);
        //$info['syllabus']       =$this->input->post('latihan_syllabus',TRUE);
        $info['nilai']      =$this->input->post('passing_score',TRUE);
        $info['latihan_created']  =date('Y-m-d H:i:s');
        $info['public']         =$this->input->post('public',TRUE);

        $info['feature_image_name']   =($upload_data=='')?'':$upload_data;
        $info['last_modified_by']=$this->session->userdata('user_id');
        $if_exist=$this->db->get_where('tbl_latihan',array('judul_latihan'=>$info['judul_latihan']),1)->result();
        if ($if_exist) {
            return FALSE;
        }else
        {
            $this->db->insert('tbl_latihan', $info);
            if ($this->db->affected_rows()==1)
            {
                return $this->db->insert_id();
            }else{
                return FALSE;
            }
        }
    }
    public function update_latihan_m($id, $upload_data = '')
    {
        $info=array();
        // $info['categori_id']    =$this->input->post('category',TRUE);
       // $info['kelas_id']    =$this->input->post('kelas',TRUE);
        $info['judul_latihan']     =$this->input->post('latihan_title',TRUE);
        $info['user_id']        =$this->session->userdata('user_id',TRUE);
        //$info['syllabus']       =$this->input->post('latihan_syllabus',TRUE);
        $info['nilai']      =$this->input->post('passing_score',TRUE);
        $info['durasi_waktu']  =$this->input->post('duration',TRUE);
        $info['acak_soal']  =$this->input->post('random_per',TRUE);
        $info['latihan_created']  =date('Y-m-d H:i:s');
        $info['public']         =$this->input->post('public',TRUE);

        //$info['feature_image_name']   =$upload_data;
        $info['last_modified_by']=$this->session->userdata('user_id');


        if ($upload_data != '') {
            $info['feature_image_name'] = $upload_data;
        }
        $this->db->where('title_id',$id);
        $this->db->update('tbl_latihan',$info);
        if ($this->db->affected_rows() == 1)
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function add_pertanyaanlatihan($file_name='',$file_type='')
    {
        $info=array();
        $info['pertanyaanlatihan']=$this->input->post('pertanyaanlatihan',TRUE);
        $info['latihan_id']=$this->input->post('per_id',TRUE);
        $info['option_type']=$this->input->post('jaw_type',TRUE);
        $info['media_type']=$file_type;
        $info['media_link']=$file_name;
        $this->db->insert('pertanyaanlatihan',$info);
        $last_per_id=$this->db->insert_id();
        if ($last_per_id) {
            $data['per_id']=$last_per_id;
            $opt=array_filter($this->input->post('options'));
            $r_jaw=array_filter($this->input->post('right_jaw'));
            foreach ($opt as $key =>$option)
            {
                $data['jawabanlatihan']=$option;
                if (isset($r_jaw[$key]) && $r_jaw[$key]!='')
                {
                    $data['right_jaw']=1;
                }else{
                    $data['right_jaw']=0;
                }
                $this->db->insert('jawabanlatihan',$data);
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function pertanyaanlatihan_count_by_id($id)
    {
        $total  =$this->db->where('latihan_id',$id)
                ->from('pertanyaanlatihan')
                ->count_all_results();
        return $total;
    }
    public function set_time_n_random_per_no()
    {
        $data=array();
        $data['durasi_waktu']=$this->input->post('duration',TRUE);
        $data['acak_soal']=$this->input->post('random_per',TRUE);
        $this->db->where('title_id',(int)$this->input->post('latihan_id',TRUE));
        $this->db->update('tbl_latihan',$data);
        if ($this->db->affected_rows()==1)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    public function get_latihan_by_id($id)
    {
        $result =$this->db->select('*')
                ->select("TIME_TO_SEC(tbl_latihan.durasi_waktu) AS duration")
                ->from('tbl_latihan')
                ->where('tbl_latihan.title_id',$id)
                // ->join('categori','categori.categori_id=tbl_latihan.categori_id','left')
                //->join('categori','subcategori.cat_id=categori.categori_id','left')
                ->get()
                ->row();
        return $result;
    }
    public function get_latihan_detail($id)
    {
        if (!is_numeric($id))
        {
            return FALSE;
        }
        $this->db->where('latihan_id',$id);
        $result=$this->db->get('pertanyaanlatihan')->result();
        return $result;
    }
    public function get_latihan_jawabanlatihan($info)
    {
        $data=array();
        foreach($info as $value)
        {
            $data[$value->per_id][]=$this->db->where('per_id', $value->per_id)
            ->from('jawabanlatihan')
            ->get()
            ->result();
        }
        return $data;
    }
    public function update_pertanyaanlatihan_m()
    {
        $data=array();
        $data['pertanyaanlatihan']=$this->input->post('pertanyaanlatihan',TRUE);
        $this->db->where('per_id',(int)$this->input->post('per_id'));
        $this->db->where('latihan_id',(int)$this->input->post('latihan_id'));
        $this->db->update('pertanyaanlatihan',$data);
        if ($this->db->affected_rows()== 1 ) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function update_jawabanlatihan($per_id)
    {
        $name=$this->input->post('name');
        $data=array();
        if ($name == 'jaw-text')
        {
            $data['jawabanlatihan']=$this->input->post('value',TRUE);
        }elseif ($name=='right-jaw')
        {
            $type=$this->db->get_where('pertanyaanlatihan',array('per_id'=>$per_id),1)->row();
            if (($type->option_type=='Radio') && ($this->input->post('value',TRUE))==1)
            {
                $have   =$this->db->select('right_jaw')
                        ->from('jawabanlatihan')
                        ->where('per_id',$per_id)
                        ->where('right_jaw',1)
                        ->get()
                        ->row();
                if ($have)
                {
                    return FALSE;
                }else
                {
                    $data['right_jaw']=$this->input->post('value',TRUE);
                }
            }else
            {
                $data['right_jaw']=$this->input->post('value',TRUE);
            }
        }else
        {
            return FALSE;
        }
        $this->db->where('per_id',$per_id);
        $this->db->where('jaw_id',(int) $this->input->post('pk'));
        $this->db->update('jawabanlatihan',$data);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    public function get_latihan_title($id)
    {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->select('*');
        $this->db->where('title_id',$id);
        $this->db->from('tbl_latihan');
        $result=$this->db->get()->row();
        return $result;
    }
    public function get_pertanyaanlatihan_by_id($id)
    {
        $result     =$this->db->select('*')
                    ->from('pertanyaanlatihan')
                    ->where('pertanyaanlatihan.per_id',$id)
                    ->join('tbl_latihan','tbl_latihan.title_id = pertanyaanlatihan.latihan_id','left')
                    ->get()
                    ->row();
        return $result;
    }
    public function delete_pertanyaanlatihan_dengan_jawabanlatihan($id)
    {
        $this->db->where('per_id',$id);
        $this->db->delete('pertanyaanlatihan');
        if ($this->db->affected_rows()==1) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_jawabanlatihan_by_id($id)
    {
        $result     =$this->db->select('*')
                    ->from('jawabanlatihan')
                    ->where('jawabanlatihan.jaw_id',$id)
                    ->join('pertanyaanlatihan','pertanyaanlatihan.per_id = jawabanlatihan.per_id','left')
                    ->join('tbl_latihan','tbl_latihan.title_id = pertanyaanlatihan.latihan_id','left')
                    ->get()
                    ->row();
        return $result;
    }
    public function delete_jawabanlatihan($id)
    {
        $this->db->where('jaw_id',$id);
        $this->db->delete('jawabanlatihan');
        if ($this->db->affected_rows()==1)
        {
            return TRUE;
        }else
        {
        return FALSE;
        }
    }
    public function delete_latihan_dengan_pertanyaanlatihan($id)
    {
        $this->db->where('title_id',$id);
        $this->db->delete('tbl_latihan');
        if ($this->db->affected_rows()==1) {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    public function evaluasi_hasillatihan()
    {
        $latihan_id = $this->input->post('latihan_id');
        $latihan_detail = $this->db->where('title_id', $latihan_id)->get('tbl_latihan')->row();



        $jawabanslatihan = $this->input->post('jaw');
        $right_jaw_count = 0;
        if ($jawabanslatihan) {
            $result_json = '{';
            foreach ($jawabanslatihan as $key => $jawabanlatihan) {
                $result_json .= '"'.$key.'"';
                $result_json .= ':';
                $result_json .= '"';

                $temp = $this->db->where('per_id', $key)->from('jawabanlatihan')->get()->result_array();
                if (is_array($jawabanlatihan)) {
                    $tmp_count = array_count_values(array_column($temp,'right_jaw'))['1'];
                    $temp_jaw_count = 0;
                    foreach ($jawabanlatihan as $tmp_jaw) {
                        foreach ($temp as $tmp_val) {
                            if (($tmp_jaw == $tmp_val['jaw_id']) AND ($tmp_val['right_jaw'] == 1)) {
                                $temp_jaw_count++;
                            }
                        }
                        $result_json .= $tmp_jaw.',';
                    }
                    if($temp_jaw_count == $tmp_count){
                        $right_jaw_count++;
                    }
                } else {
                    foreach ($temp as $tmp_val) {
                        if (($jawabanlatihan == $tmp_val['jaw_id']) AND ($tmp_val['right_jaw'] == 1)) {
                            $right_jaw_count++;
                        }
                    }
                    $result_json .= $jawabanlatihan.',';
                }
                $result_json = substr($result_json, 0, -1);
                $result_json .= '",';
            }
            $result_json = substr($result_json, 0, -1);
            $result_json .= '}';
            $data['result_json'] = trim($result_json);
        } else {
            return FALSE;
        }


        //date_default_timezone_set($this->session->userdata['time_zone']);
        $result = round(($right_jaw_count / $latihan_detail->acak_soal) * 100, 2);
        $data['latihan_id'] = $latihan_id;
        $data['user_id'] = $this->session->userdata('user_id');
        $data['result_persen'] = $result;
        $data['pertanyaanlatihan_dijawablatihan'] = $latihan_detail->acak_soal;
        $data['latihan_taken_date'] = date('Y-m-d H:i:s');

        // echo "<pre/>"; print_r($data); exit();

        $this->db->insert('hasillatihan', $data);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }


    public function delete_result($id)
    {
        $this->db->where('result_id', $id)
                ->delete('result');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function hasillatihan_detail_m($id)
    {
        $hasillatihan      =$this->db->select('*')
                    ->select('hasillatihan.user_id AS participant_id')
                    ->from('hasillatihan')
                    ->where('hasillatihan.hasillatihan_id',$id)
                    ->join('user','user.id = hasillatihan.user_id','left')
                    ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id','left')
                    ->get()
                    ->row();
        return $hasillatihan;
    }
    public function get_latihan_detail_m($id)
    {
        $hasillatihan      =$this->db->select('*')
                    ->where('title_id',$id)
                    ->from('tbl_latihan')
                   // ->join('categori','subcategori.cat_id=categori.categori_id')
                    //->join('subkelas','subkelas.id=tbl_latihan.kelas_id')
                    //->join('kelas','subkelas.kel_id=kelas.kelas_id')
                    ->join('user','user.id=tbl_latihan.user_id')
                    ->get()
                    ->row();
        return $hasillatihan;
    }
    public function nonaktif_m($id)
    {
        $data=array();
        $data['active']=0;
        $this->db->where('title_id',(int)$id);
        $this->db->update('tbl_latihan',$data);
        if ($this->db->affected_rows()== 1 ) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
     public function aktif_m($id)
    {
        $data=array();
        $data['active']=1;
        $this->db->where('title_id',(int)$id);
        $this->db->update('tbl_latihan',$data);
        if ($this->db->affected_rows()== 1 ) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function hasillatihan()
    {
        $hasillatihan  =$this->db->select('*')
                ->from('hasillatihan')
                ->order_by('hasillatihan.latihan_taken_date','asc')
                ->join('user','user.id = hasillatihan.user_id','left')
                ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id','left')
                ->get()
                ->result();
        return $hasillatihan;
    }
    public function deletehasillatihan($hasillatihan_id)
    {
        $this->db->where('hasillatihan_id',$hasillatihan_id);
        $this->db->delete('hasillatihan');
    }
      public function saran($id)
    {
        $hasillatihan=$this->db->select('*')
                    ->select('hasillatihan.user_id AS participant_id')
                    ->from('hasillatihan')
                    ->where('hasillatihan.hasillatihan_id',$id)
                    ->join('user','user.id = hasillatihan.user_id','left')
                    ->join('tbl_latihan','tbl_latihan.title_id = hasillatihan.latihan_id','left')
                    ->join('categori','categori.categori_id = tbl_latihan.categori_id','left')
                 //   ->join('categori','categori.categori_id = subcategori.cat_id','left')
                    ->join('kursus','kursus.categori_id = categori.categori_id','left')
                    ->join('kursus_sections','kursus.kursus_id = kursus.kursus_id','left')
                    ->join('kursus_document','kursus_sections.section_id= kursus_document.section_id')
                    ->get()
                    ->row();
        return $hasillatihan;
    }
}
