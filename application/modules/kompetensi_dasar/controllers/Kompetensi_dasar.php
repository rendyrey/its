<?php if(!defined('BASEPATH')) exit('No direct access allowed');
/**
*
*/
class Kompetensi_dasar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categori/Categori_m');
		$this->load->model('mapel/Mapel_m');
		$this->load->model('Kompetensi_m');

	}
	public function index($message='',$cat_id='')
	{
		$data=array();
		$userid=$this->session->userdata('user_id');
		//$this->data['categoris']=$this->Kursus_m->getsubcategori();
		if ($this->session->userdata('level')=='superadmin')
		{


			$this->data['kompetensi']=$this->Kompetensi_m->getall();

		$this->data['message']=$message;
		$mapel = $this->Mapel_m->tampil();
		foreach($mapel as $row){
			$this->data['mapel'][] = $row->nama_mapel;
			$this->data['mapel_id'][] = $row->mapel_id;
		}
		$this->data['halaman']="kompetensi_dasar/vkompetensi";
		$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda tidak berhak";
		}
	}
	public function addkompetensi ()
	{
		if ($this->session->userdata('level')=='superadmin')
		{
			$mapel = $this->Mapel_m->tampil();
			foreach($mapel as $row){
				$this->data['mapel'][] = $row->nama_mapel;
				$this->data['mapel_id'][] = $row->mapel_id;
			}
			$this->data['halaman']='addkompetensi';
			$this->load->view('_main',$this->data);
		}else
		{
			redirect('login','refresh');
		}
	}

	public function getsubcategoriajax($id)
	{
		 $sub_cat = $this->Kompetensi_m->get_subcategori_by_cat_id($id);
        $str = '<select name="mapel" class="chosen-select" style="width:300px;" required>';
        $str.='<option value="">Pilih Mata Pelajaran</option>';
        foreach ($sub_cat as $value) {
            $str.='<option value="'.$value->mapel_id.'">'.$value->nama_mapel.'</option>';
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
	public function edit_kompetensi_detail($id,$pesan='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['categories']=$this->Categori_m->get_categories();
		$this->data['pesan']=$pesan;
		$this->data['kompetensi']=$this->Kompetensi_m->get_kompetensi_detail($id);
		$this->data['halaman']="kompetensi_dasar/editkompetensi";
		$this->load->view('_main',$this->data);
	}

	public function simpankompetensi()
	{
		$this->form_validation->set_rules('mapel', 'Mapel', 'required');
		$this->form_validation->set_rules('kompetensi', 'Kompetensi', 'required');
		if($this->form_validation->run()==FALSE){
			echo "gagagl";
		}else{
			$data=array(
			'nama_kompetensi'	=> $this->input->post('kompetensi'),
			'mapel_id'	=> $this->input->post('mapel')
			);
			$save=$this->Kompetensi_m->insert($data);
			$this->session->set_flashdata('pesan', 'Data Berhasil Di Tambah');
			redirect('kompetensi_dasar','refresh');

		}
	}
	public function hapus_kompetensi($id)
	{
		$data = array();

        $this->Kompetensi_m->deletekompetensi($id);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('kompetensi_dasar','refresh');
	}
	public function update_kompetensi()
	{
			$kompetensi_id=$this->input->post('kompetensi_id');
			$mapel= $this->input->post('mapel');
			$kompetensi= $this->input->post('kompetensi');
			$status=$this->input->post('status');

			$this->form_validation->set_rules('mapel','Mapel','required');
			$this->form_validation->set_rules('kompetensi','Kompetensi','required');
			$this->form_validation->set_rules('status','Status','required');

			if($this->form_validation->run()==FALSE)
			{
				redirect('kompetensi_dasar/edit_kompetensi_detail/$id','refresh');
			}else
			{

                $data = array(
                    'nama_kompetensi' => $kompetensi,
                    'mapel_id' => $mapel,
                    'active' => $status
                );

          	    $this->Kompetensi_m->actionupdate($kompetensi_id, $data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Di Update');
                redirect('kompetensi_dasar');
			}
	}

}
