<?php if(!defined('BASEPATH'))exit('No direct access allowed');
/**
* 
*/
class Pengguna extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengguna_m');
		//$this->load->model('Kelas/Kelas_m');
		$this->load->library('form_validation');
	}
	
	public function index ()
	{
		if($this->session->userdata('logged_in')!=TRUE){
			redirect('Login');
		}
		else {
		
		$this->data['penggunalist']=$this->Pengguna_m->tampil();
		
		$this->data['halaman']="pengguna/vpengguna";
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
			$this->form_validation->set_rules('username','username','required');
			$this->form_validation->set_rules('nama','nama lengkap','required');
			$this->form_validation->set_rules('password','password','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('level','Level','required');
			if ($this->form_validation->run()==FALSE) 
			{
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal!</div></div>");
				$this->data['halaman']='pengguna/vpengguna';
				$this->load->view('_main',$this->data);
			}
			else
			{
				$data=array(
						'username'		=>$this->input->post('username'),
						'nama'			=>$this->input->post('nama'),
						'password'		=>md5($this->input->post('password')),
						'email'			=>$this->input->post('email'),
						'level'			=>$this->input->post('level'),
						'active'		=>1,
						'terdaftar_dari'=>date('Y-m-d H:i:s')
					);
				$insert=$this->Pengguna_m->insert($data);
				$this->session->set_flashdata("pesan","<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Sukses!</div></div>");
				echo json_encode(array("status"=>TRUE));
			}
		}
	}
	public function delete($id)
	{
		$this->Pengguna_m->delete($id);
		echo json_encode(array("status"=>TRUE));
	}
	public function update($id)
	{
		$data=$this->Pengguna_m->getid($id);
		echo json_encode($data);
	}
	public function updateaction()
	{
		$data=array(
				'username'	=>$this->input->post('username'),
				'nama'=>$this->input->post('nama'),
				'email'	=>$this->input->post('email'),
				'password'	=>$this->input->post('password'),
				'level'		=>$this->input->post('level')
			);
		$this->Pengguna_m->actionupdate(array('id'=>$this->input->post('id')),$data);
		echo json_encode(array("status"=>TRUE));
	}
	public function nonaktifkan_pengguna($id)
	{
		$data=array('active' => 0);
		//$a=$id;
		$this->Pengguna_m->nonaktifkan_pengguna_m(array('id'=>$id),$data);
		echo json_encode(array("status"=>TRUE));
	}
	public function aktifkan_pengguna($id)
	{
		$data=array('active' => 1);
		//$a=$id;
		$this->Pengguna_m->aktifkan_pengguna_m(array('id'=>$id),$data);
		echo json_encode(array("status"=>TRUE));
	}
}