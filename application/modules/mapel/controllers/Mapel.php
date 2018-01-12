<?php if(!defined('BASEPATH')) exit('No direct access allowed');
/**
*
*/
class Mapel extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categori/Categori_m');
		$this->load->model('Mapel_m');
		//$this->load->model('Categori/Categori_m');
	}
	public function index($message='')
	{
		$data=array();
		$userid=$this->session->userdata('user_id');
		//$this->data['categoris']=$this->Kursus_m->getsubcategori();
		if ($this->session->userdata('level')=='superadmin')
		{

			$this->data['mapel']=$this->Mapel_m->getall();

		$this->data['message']=$message;
		// $this->data['cat_id']=$cat_id;
		$this->data['categories']=$this->Categori_m->get_categories();
		$this->data['halaman']="mapel/vmapel";
		$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda tidak berhak";
		}
	}
	public function addmapel ()
	{
		if ($this->session->userdata('level')=='superadmin')
		{
			// $this->data['categories']=$this->Categori_m->get_categories();
			$this->data['halaman']='addmapel';
			$this->load->view('_main',$this->data);
		}else
		{
			redirect('login','refresh');
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
	public function edit_mapel_detail($id,$pesan='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['categories']=$this->Categori_m->get_categories();
		$this->data['pesan']=$pesan;
		$this->data['mapel']=$this->Mapel_m->get_mapel_detail($id);
		$this->data['halaman']="mapel/editmapel";
		$this->load->view('_main',$this->data);
	}

	public function simpanmapel()
	{
		$this->form_validation->set_rules('mapel_title', 'Mapel', 'required');
		// $this->form_validation->set_rules('category', 'Category', 'required');

		if($this->form_validation->run()==FALSE){
			echo "gagagl";
		}else{
			$data=array(
			'nama_mapel'	=> $this->input->post('mapel_title'),
			'by'			=>$this->session->userdata('username')
			);
			$save=$this->Mapel_m->insert($data);
			$this->session->set_flashdata('pesan', 'Data Berhasil Di Tambah');
			redirect('mapel','refresh');
		}
	}
	public function hapus_mapel($id)
	{
		$data = array();
        $this->Mapel_m->delete($id);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('mapel','refresh');
	}
	public function update_mapel()
	{
			$mapel_id=$this->input->post('mapel_id');
			$category= $this->input->post('category');
			$mapel_title= $this->input->post('mapel_title');
			$status= $this->input->post('status');

			$this->form_validation->set_rules('category','Category','required');
			$this->form_validation->set_rules('mapel_title','Mapel Titla','required');
			$this->form_validation->set_rules('status','Status','required');

			if($this->form_validation->run()==FALSE)
			{
				redirect('mapel/edit_mapel_detail/$id','refresh');
			}else
			{

               $data = array(
                'nama_mapel' => $mapel_title,
                'categori_id' => $category,
                'active' => $status
                );

          	   $this->Mapel_m->actionupdate($mapel_id, $data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Di Update');
                redirect('mapel');
			}
	}

}
