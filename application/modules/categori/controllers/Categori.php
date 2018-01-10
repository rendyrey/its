<?php if(!defined('BASEPATH'))exit('No direct access allowed');
/**
* 
*/
class Categori extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categori_m');
		$this->load->library('form_validation');
	}
	
	public function index ()
	{
		if($this->session->userdata('logged_in')!=TRUE){
			redirect('Login');
		}
		else {
		$this->data['categorilist']=$this->Categori_m->tampil();
		$this->data['halaman']="categori/vcategori";
		$this->load->view('_main',$this->data);
	}
	}
	public function save()
	{
		if ($this->session->userdata('logged_in')!=TRUE) 
		{
			redirect('Login');
		}
		else 
		{
			$this->form_validation->set_rules('nama_categori','nama','required');
			
			if ($this->form_validation->run()==FALSE) 
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='categori/vcategori';
				$this->load->view('_main',$this->data);
			}
			else
			{	
				$data=array(
						'nama_categori'		=>$this->input->post('nama_categori'),
						'by'				=>$this->session->userdata('username'),
						'active'			=>1
					);
				$insert=$this->Categori_m->insert($data);
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
				echo json_encode(array("status"=>TRUE));
			}
		}
	}
	public function delete($categori_id)
	{
		$this->Categori_m->delete($categori_id);
		echo json_encode(array("status"=>TRUE));
	}
	public function update($categori_id)
	{
		$data=$this->Categori_m->getid($categori_id);
		echo json_encode($data);
	}
	public function updateaction()
	{
		$data=array(
				'nama_categori'	=>$this->input->post('nama_categori')
			);
		$this->Categori_m->actionupdate(array('categori_id'=>$this->input->post('categori_id')),$data);
		echo json_encode(array("status"=>TRUE));
	}
}