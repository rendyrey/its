<?php if(!defined('BASEPATH')) exit('No direct access allowed');
/**
*
*/
class Bank_soal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categori/Categori_m');
		$this->load->model('Soal_m');
		$this->load->model('mapel/Mapel_m');
	}
	public function index($message='',$cat_id='')
	{
		$data=array();
		$userid=$this->session->userdata('user_id');
		//$this->data['categoris']=$this->Kursus_m->getsubcategori();
		if ($this->session->userdata('level')=='superadmin')
		{
		if(isset($_GET['mapel']) && $_GET['mapel']!='' && isset($_GET['kompetensi']) && $_GET['kompetensi']!=''){
			$this->data['soal']=$this->Soal_m->getallcat($_GET['mapel'],$_GET['kompetensi']);
		} else {
			$this->data['soal']=array();
		}
		$this->data['message']=$message;
		$this->data['cat_id']=$cat_id;
		// $this->data['categories']=$this->Categori_m->get_categories();
		$this->data['halaman']="bank_soal/vsoal";
		$mapel = $this->Mapel_m->tampil();
		foreach($mapel as $row){
			$this->data['mapel'][] = $row->nama_mapel;
			$this->data['mapel_id'][] = $row->mapel_id;
		}
		$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda tidak berhak";
		}
	}
	public function addsoal ()
	{
		if ($this->session->userdata('level')=='superadmin')
		{
			$this->data['categories']=$this->Categori_m->get_categories();
			$this->data['halaman']='addsoal';
			$mapel = $this->Mapel_m->tampil();
			foreach($mapel as $row){
				$this->data['mapel'][] = $row->nama_mapel;
				$this->data['mapel_id'][] = $row->mapel_id;
			}
			$this->load->view('_main',$this->data);
		}else
		{
			redirect('login','refresh');
		}
	}
	public function getsubcategoriajax($id)
	{
		 $sub_cat = $this->Soal_m->get_subcategori_by_cat_id($id);
        $str = '<select name="mapel" class="chosen-select" style="width:300px;" onChange="getState2(this.value)" required>';
        $str.='<option value="">Pilih Mata Pelajaran</option>';
        foreach ($sub_cat as $value) {
            $str.='<option value="'.$value->mapel_id.'">'.$value->nama_mapel.'</option>';
        }
        $str .= '</select>';
        echo $str;
	}
	public function getsubcategoriajax2($id)
	{
		 $sub_cat = $this->Soal_m->get_subcategori_by_map_id($id);
        $str = '<select name="kompetensi" class="chosen-select" style="width:70%;" required>';
        $str.='<option value="" disabled>Pilih Kompetensi Dasar</option>';
        foreach ($sub_cat as $value) {
            $str.='<option value="'.$value->kompetensi_id.'">'.$value->nama_kompetensi.'</option>';
        }
        $str .= '</select>';
        echo $str;
	}
	public function creat_kursus_sections($title_id=0,$kursus_title='Create Sections')
	{
		$data=array();
		$this->data['kursus_title']=$kursus_title;
		$this->data['title_id']=$title_id;
		$this->data['halaman']="Kursus/vsections";
		$this->load->view('_main',$this->data);
	}
	public function kursusdelete($id)
	{
		if (!is_numeric($id)) {
			show_404();
		}
		$have_sections=$this->db->get_where('kursus_sections',array('kursus_id'=>$id))->result();
		if (!empty($have_sections))
		{
			$message='<div class="alert aler-danger">please delete sections</div>';
			$this->session->set_flashdata('message',$message);
			redirect('Kursus','refresh');
		}
		else{
			$kursus_id=$this->db->get_where('kursus',array('kursus_id'=>$id))->row()->kursus_id;
			$this->db->where('kursus_id',$id);
			$this->db->delete('kursus');
			if ($this->db->affected_rows()==1)
			{
				$message ="sukses";
			}else{
				$message="error";
			}
			$this->session->set_flashdata('message',$message);
			redirect('Kursus/'.$kursus_id,'refresh');
		}
	}
	public function kursusdetail($id='', $pesan='')
	{
		if (empty($id)){show_404();}
		if (!is_numeric($id)){show_404();}
		$data=array();
		$this->data['pesan']=$pesan;
		$this->data['kursus']=$this->Kursus_m->get_kursus_detail($id);
		$this->data['sections']=$this->Kursus_m->get_sections($id);
		$this->data['halaman']="kursus/vkursusdetail";
		$this->load->view('_main',$this->data);
	}
	public function edit_soal_detail($id,$pesan='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['pesan']=$pesan;
		$this->data['soal']=$this->Soal_m->get_soal_detail($id);
		$this->data['halaman']="bank_soal/editsoal";
		$this->load->view('_main',$this->data);
	}

	private function nomor($no)
	{
		switch ($no) {
			case '0': $nomor = "A"; break;
			case '1': $nomor = "B"; break;
			case '2': $nomor = "C"; break;
			case '3': $nomor = "D"; break;
			case '4': $nomor = "E"; break;
			default: $nomor = "A"; break;
		}
		return $nomor;
	}
	public function simpansoal()
	{

		$this->form_validation->set_rules('mapel', 'Mapel', 'required');
		// $this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('kompetensi', 'Kompetensi', 'required');
		$this->form_validation->set_rules('kesulitan', 'Kesulitan', 'required');
		$this->form_validation->set_rules('soal', 'Soal', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe Jawaban', 'required');
		$this->form_validation->set_rules('nilai', 'Nilai benar', 'required');

		if($this->form_validation->run()==FALSE){
			echo "gagagl";
		}else{
			$data=array(
			'deskripsi'	=> $this->input->post('soal'),
			// 'categori_id'	=>$this->input->post('category'),
			'mapel_id'	=> $this->input->post('mapel'),
			'kompetensi_id'	=> $this->input->post('kompetensi'),
			'kesulitan'	=> $this->input->post('kesulitan'),
			'tipe'	=> $this->input->post('tipe'),
			'nilai'	=> $this->input->post('nilai'),
			'user_id'	=> $this->session->userdata('user_id'),
			);
			$save=$this->Soal_m->insert($data);
			// echo json_encode($data);
			if($save){

				if($this->input->post('tipe')=="Single"){
					$correct = $this->input->post('correct_ans');
					for($i=0;$i<5;$i++){
						$benar = ($correct === $this->nomor($i)) ? "1" : "0";
						$data_d = array(
							'nomor' => $this->nomor($i),
							'pilihan' => $this->input->post('option_'.$this->nomor($i)),
							'benar' => $benar,
							'soal_id' => $save
						);
						$save_d=$this->Soal_m->insert_array($data_d);
					}
				} else {

					for($i=0;$i<5;$i++){
						$correct = $this->input->post('correct_ans_'.$this->nomor($i));
						$benar = ($correct === $this->nomor($i)) ? "1" : "0";
						$data_d = array(
							'nomor' => $this->nomor($i),
							'pilihan' => $this->input->post('check_option_'.$this->nomor($i)),
							'benar' => $benar,
							'soal_id' => $save
						);
						$save_d=$this->Soal_m->insert_array($data_d);
					}
				}

				$this->session->set_flashdata('pesan', 'Data Berhasil Di Tambah');
			} else {
				$this->session->set_flashdata('pesan', 'Gagal di tambah');
			}
			redirect('bank_soal','refresh');
			// print_r($this->input->post());

		}
	}
	public function hapus_soal($id)
	{
		$data = array();

        $this->Soal_m->deletesoal($id);
        $detail = $this->Soal_m->getsubcategori($id);
        $jml = count($detail);
        for($i=0;$i<$jml;$i++) {
        	$this->Soal_m->deletesoaldet($detail[$i]->soaldetail_id);
        }
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('bank_soal','refresh');
	}
	public function update_soal()
	{
		$soal_id = $this->input->post('soal_id');
		$this->form_validation->set_rules('mapel', 'Mapel', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('kompetensi', 'Kompetensi', 'required');
		$this->form_validation->set_rules('kesulitan', 'Kesulitan', 'required');
		$this->form_validation->set_rules('soal', 'Soal', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe Jawaban', 'required');
		$this->form_validation->set_rules('nilai', 'Nilai benar', 'required');

			if($this->form_validation->run()==FALSE)
			{
				redirect('bank_soal/edit_soal_detail/$id','refresh');
			}else
			{

                $data = array(
                    'deskripsi'	=> $this->input->post('soal'),
					'categori_id'	=>$this->input->post('category'),
					'mapel_id'	=> $this->input->post('mapel'),
					'kompetensi_id'	=> $this->input->post('kompetensi'),
					'kesulitan'	=> $this->input->post('kesulitan'),
					'tipe'	=> $this->input->post('tipe'),
					'nilai'	=> $this->input->post('nilai'),
					'user_id'	=> $this->session->userdata('user_id'),
                );

          	    $this->Soal_m->actionupdate($soal_id, $data);

          	    	if($this->input->post('tipe')=="Single"){
						$correct = $this->input->post('correct_ans');
						for($i=0;$i<5;$i++){
							$benar = ($correct === $this->nomor($i)) ? "1" : "0";
							$data_d = array(
								'nomor' => $this->nomor($i),
								'pilihan' => $this->input->post('option_'.$this->nomor($i)),
								'benar' => $benar,
							);
							$save_d=$this->Soal_m->actionupdate_arr($soal_id, $this->nomor($i), $data_d);
						}
					} else {

						for($i=0;$i<5;$i++){
							$correct = $this->input->post('correct_ans_'.$this->nomor($i));
							$benar = ($correct === $this->nomor($i)) ? "1" : "0";
							$data_d = array(
								'nomor' => $this->nomor($i),
								'pilihan' => $this->input->post('check_option_'.$this->nomor($i)),
								'benar' => $benar,
							);
							$save_d=$this->Soal_m->actionupdate_arr($soal_id, $this->nomor($i), $data_d);
						}
					}

                $this->session->set_flashdata('pesan', 'Data Berhasil Di Update');
                redirect('bank_soal');
			}
	}

}
