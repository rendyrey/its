<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function get_all_ujian()
    {
        $result =$this->db->select('*')
                ->select('tbl_ujian.active AS ujian_active')
                ->from('tbl_ujian')
               // ->join('categori','subcategori.cat_id = categori.categori_id','left')
                //->join('subkelas','subkelas.id = tbl_ujian.kelas_id','left')
                //->join('kelas','subkelas.kel_id = kelas.kelas_id','left')
                ->join('user','user.id = tbl_ujian.user_id')
                ->get()
                ->result();
        return $result;
    }

    public function get_all_pretest(){
      $result =$this->db->select('*')
              ->select('tbl_ujian.active AS ujian_active')
              ->from('tbl_ujian')
             // ->join('categori','subcategori.cat_id = categori.categori_id','left')
              //->join('subkelas','subkelas.id = tbl_ujian.kelas_id','left')
              //->join('kelas','subkelas.kel_id = kelas.kelas_id','left')
              ->join('user','user.id = tbl_ujian.user_id')
              ->where('jenis = 1')
              ->get()
              ->result();
      return $result;
    }


    public function add_ujian_title($upload_data='')
    {
       // date_default_timezone_set($this->session->userdata['time_zone']);
        $info=array();
        $info['mapel_id']    =$this->input->post('mapel_id',TRUE);
        $info['kelas_id']    =0;
        $info['judul_ujian']     =$this->input->post('ujian_title',TRUE);
        $info['user_id']        =$this->session->userdata('user_id',TRUE);
        $info['syllabus']       ='silabus';
        $info['nilai']      =$this->input->post('passing_score',TRUE);
        $info['ujian_created']  =date('Y-m-d H:i:s');
        $info['public']         =$this->input->post('public',TRUE);
        $info['jenis'] = $this->input->post('jenis');
        $info['feature_image_name']   =($upload_data=='')?'':$upload_data;
        $info['last_modified_by']=$this->session->userdata('user_id');
        $if_exist=$this->db->get_where('tbl_ujian',array('judul_ujian'=>$info['judul_ujian']),1)->result();
        if ($if_exist) {
            return FALSE;
        }else
        {
            $this->db->insert('tbl_ujian', $info);
            if ($this->db->affected_rows()==1)
            {
                return $this->db->insert_id();
            }else{
                return FALSE;
            }
        }
    }
    public function update_ujian_m($id, $upload_data = '')
    {
        $info=array();
        // $info['categori_id']    =$this->input->post('category',TRUE);
        //$info['kelas_id']    =$this->input->post('kelas',TRUE);
        $info['judul_ujian']     =$this->input->post('ujian_title',TRUE);
        $info['user_id']        =$this->session->userdata('user_id',TRUE);
        //$info['syllabus']       =$this->input->post('ujian_syllabus',TRUE);
        $info['nilai']      =$this->input->post('passing_score',TRUE);
        $info['durasi_waktu']  =$this->input->post('duration',TRUE);
        $info['acak_soal']  =$this->input->post('random_per',TRUE);
        $info['ujian_created']  =date('Y-m-d H:i:s');
        $info['public']         =$this->input->post('public',TRUE);

        //$info['feature_image_name']   =$upload_data;
        $info['last_modified_by']=$this->session->userdata('user_id');


        if ($upload_data != '') {
            $info['feature_image_name'] = $upload_data;
        }
        $this->db->where('title_id',$id);
        $this->db->update('tbl_ujian',$info);
        if ($this->db->affected_rows() == 1)
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function add_pertanyaan($file_name='',$file_type='')
    {
        $info=array();
        $info['pertanyaan']=$this->input->post('pertanyaan',TRUE);
        $info['ujian_id']=$this->input->post('per_id',TRUE);
        $info['option_type']=$this->input->post('jaw_type',TRUE);
        $info['media_type']=$file_type;
        $info['media_link']=$file_name;
        $this->db->insert('pertanyaan',$info);
        $last_per_id=$this->db->insert_id();
        if ($last_per_id) {
            $data['per_id']=$last_per_id;
            $opt=array_filter($this->input->post('options'));
            $r_jaw=array_filter($this->input->post('right_jaw'));
            foreach ($opt as $key =>$option)
            {
                $data['jawaban']=$option;
                if (isset($r_jaw[$key]) && $r_jaw[$key]!='')
                {
                    $data['right_jaw']=1;
                }else{
                    $data['right_jaw']=0;
                }
                $this->db->insert('jawaban',$data);
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function pertanyaan_count_by_id($id)
    {
        $total  =$this->db->where('ujian_id',$id)
                ->from('pertanyaan')
                ->count_all_results();
        return $total;
    }
    public function set_time_n_random_per_no()
    {
        $data=array();
        $data['durasi_waktu']=$this->input->post('duration',TRUE);
        $data['acak_soal']=$this->input->post('random_per',TRUE);
        $this->db->where('title_id',(int)$this->input->post('ujian_id',TRUE));
        $this->db->update('tbl_ujian',$data);
        if ($this->db->affected_rows()==1)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    public function get_ujian_by_id($id)
    {
        $result =$this->db->select('*')
                ->select("TIME_TO_SEC(tbl_ujian.durasi_waktu) AS duration")
                ->from('tbl_ujian')
                ->where('tbl_ujian.title_id',$id)
                // ->join('categori','categori.categori_id=tbl_ujian.categori_id','left')
                //->join('categori','subcategori.cat_id=categori.categori_id','left')
                ->get()
                ->row();
        return $result;
    }
    public function get_ujian_detail($id)
    {
        if (!is_numeric($id))
        {
            return FALSE;
        }
        $this->db->where('ujian_id',$id);
        $this->db->from('pertanyaan');
        $this->db->from('kursus');
        $this->db->where('pertanyaan.kursus_id = kursus.kursus_id');
        $result=$this->db->get()->result();
        return $result;
    }
    public function get_ujian_jawaban($info)
    {
        $data=array();
        foreach($info as $value)
        {
            $data[$value->per_id][]=$this->db->where('per_id', $value->per_id)
            ->from('jawaban')
            ->get()
            ->result();
        }
        return $data;
    }
    public function update_pertanyaan_m()
    {
        $data=array();
        $data['pertanyaan']=$this->input->post('pertanyaan',TRUE);
        $this->db->where('per_id',(int)$this->input->post('per_id'));
        $this->db->where('ujian_id',(int)$this->input->post('ujian_id'));
        $this->db->update('pertanyaan',$data);
        if ($this->db->affected_rows()== 1 ) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function update_jawaban($per_id)
    {
        $name=$this->input->post('name');
        $data=array();
        if ($name == 'jaw-text')
        {
            $data['jawaban']=$this->input->post('value',TRUE);
        }elseif ($name=='right-jaw')
        {
            $type=$this->db->get_where('pertanyaan',array('per_id'=>$per_id),1)->row();
            if (($type->option_type=='Radio') && ($this->input->post('value',TRUE))==1)
            {
                $have   =$this->db->select('right_jaw')
                        ->from('jawaban')
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
        $this->db->update('jawaban',$data);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    public function get_ujian_title($id)
    {
        if (!is_numeric($id)) {
            return FALSE;
        }
        $this->db->select('*');
        $this->db->where('title_id',$id);
        $this->db->from('tbl_ujian');
        $result=$this->db->get()->row();
        return $result;
    }
    public function get_pertanyaan_by_id($id)
    {
        $result     =$this->db->select('*')
                    ->from('pertanyaan')
                    ->where('pertanyaan.per_id',$id)
                    ->join('tbl_ujian','tbl_ujian.title_id = pertanyaan.ujian_id','left')
                    ->get()
                    ->row();
        return $result;
    }
    public function delete_pertanyaan_dengan_jawaban($id)
    {
        $this->db->where('per_id',$id);
        $this->db->delete('pertanyaan');
        if ($this->db->affected_rows()==1) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function get_jawaban_by_id($id)
    {
        $result     =$this->db->select('*')
                    ->from('jawaban')
                    ->where('jawaban.jaw_id',$id)
                    ->join('pertanyaan','pertanyaan.per_id = jawaban.per_id','left')
                    ->join('tbl_ujian','tbl_ujian.title_id = pertanyaan.ujian_id','left')
                    ->get()
                    ->row();
        return $result;
    }
    public function delete_jawaban($id)
    {
        $this->db->where('jaw_id',$id);
        $this->db->delete('jawaban');
        if ($this->db->affected_rows()==1)
        {
            return TRUE;
        }else
        {
        return FALSE;
        }
    }
    public function delete_ujian_dengan_pertanyaan($id)
    {
        $this->db->where('title_id',$id);
        $this->db->delete('tbl_ujian');
        if ($this->db->affected_rows()==1) {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }
    public function evaluasi_hasil()
    {
        $ujian_id = $this->input->post('ujian_id');
        $ujian_detail = $this->db->where('title_id', $ujian_id)->get('tbl_ujian')->row();



        $jawabans = $this->input->post('jaw');
        $right_jaw_count = 0;
        if ($jawabans) {
            $result_json = '{';
            foreach ($jawabans as $key => $jawaban) {
                $result_json .= '"'.$key.'"';
                $result_json .= ':';
                $result_json .= '"';

                $temp = $this->db->where('per_id', $key)->from('jawaban')->get()->result_array();
                if (is_array($jawaban)) {
                    $tmp_count = array_count_values(array_column($temp,'right_jaw'))['1'];
                    $temp_jaw_count = 0;
                    foreach ($jawaban as $tmp_jaw) {
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
                        if (($jawaban == $tmp_val['jaw_id']) AND ($tmp_val['right_jaw'] == 1)) {
                            $right_jaw_count++;
                        }
                    }
                    $result_json .= $jawaban.',';
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
        $result = round(($right_jaw_count / $ujian_detail->acak_soal) * 100, 2);
        $data['ujian_id'] = $ujian_id;
        $data['user_id'] = $this->session->userdata('user_id');
        $data['result_persen'] = $result;
        $data['pertanyaan_dijawab'] = $ujian_detail->acak_soal;
        $data['ujian_taken_date'] = date('Y-m-d H:i:s');

        // echo "<pre/>"; print_r($data); exit();

        $this->db->insert('hasil', $data);
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
    public function hasil_detail_m($id)
    {
        $hasil      =$this->db->select('*')
                    ->select('hasil.user_id AS participant_id')
                    ->from('hasil')
                    ->where('hasil.hasil_id',$id)
                    ->join('user','user.id = hasil.user_id','left')
                    ->join('tbl_ujian','tbl_ujian.title_id = hasil.ujian_id','left')
                    ->get()
                    ->row();
        return $hasil;
    }
    public function get_ujian_detail_m($id)
    {
        $hasil      =$this->db->select('*')
                    ->where('title_id',$id)
                    ->from('tbl_ujian')
                    // ->join('categori','categori.categori_id=tbl_ujian.categori_id')
                   // ->join('categori','subcategori.cat_id=categori.categori_id')
                    //->join('subkelas','subkelas.id=tbl_ujian.kelas_id')
                    //->join('kelas','subkelas.kel_id=kelas.kelas_id')
                    ->join('user','user.id=tbl_ujian.user_id')
                    ->get()
                    ->row();
        return $hasil;
    }
    public function nonaktif_m($id)
    {
        $data=array();
        $data['active']=0;
        $this->db->where('title_id',(int)$id);
        $this->db->update('tbl_ujian',$data);
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
        $this->db->update('tbl_ujian',$data);
        if ($this->db->affected_rows()== 1 ) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function hasil()
    {
        $hasil  =$this->db->select('*')
                ->from('hasil')
                ->order_by('hasil.ujian_taken_date','asc')
                ->join('user','user.id = hasil.user_id','left')
                ->join('tbl_ujian','tbl_ujian.title_id = hasil.ujian_id','left')
                ->get()
                ->result();
        return $hasil;
    }
    public function deletehasilujian($hasil_id)
    {
        $this->db->where('hasil_id',$hasil_id);
        $this->db->delete('hasil');
    }
}
