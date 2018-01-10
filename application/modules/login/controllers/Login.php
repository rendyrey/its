<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $data;
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('Login_m');
		$this->load->model('pengguna/Pengguna_m');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	//menampilkan form login
	public function index(){
		if ($this->session->userdata('logged_in')==TRUE)
		{
			redirect('Dashboard');
		}else{
			$data['message'] = '';
			$this->load->view('login/vlogin',$data);
			// echo "hai";
		}


	}

	//method untuk cek login
	public function logincek(){

		$email =  $this->input->post('email');
		$password =  $this->input->post('password');
    //
    //
		// //panggil model
		$login = $this->Login_m->login($email, $password);
		if($login){
			redirect('Dashboard');
		}else{
			$this->session->set_flashdata('message','Maaf username atau password salah');
			$data['message'] = $this->session->flashdata('message');
			$this->load->view('vlogin',$data);

		}
		// echo "hai";

	}

	//Method untuk logout
	public function logout(){
		$this->session->sess_destroy();
		redirect('/','refresh');
		exit;
	}
	public function registrasi()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		if($this->form_validation->run()==FALSE){
			echo "gagagl";
		}else{
			$this->load->library('upload');
			$nmfile = "file_".time();
			$path   = './assets/upload/user/';
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['overwrite']=TRUE;
			$config['max_size'] = '3000000';
			$config['max_width']  = '5000000';
			$config['max_height']  = '5000000';
			$config['file_name'] = uniqid();
			$this->upload->initialize($config);
			if(!empty($_FILES['gambar']['name']))
			{
				if($this->upload->do_upload('gambar'))
				{
					$foto=$this->upload->data();

					$data=array(
						'image'		=>$foto['file_name'],
						'username'	=> $this->input->post('username'),
						'nama'		=> $this->input->post('nama'),
						'password'	=> md5($this->input->post('password')),
						'email'		=> $this->input->post('email'),
						'active'	=> 1,
						'terdaftar_dari'=>date('Y-m-d H:i:s'),
						'level'		=>'murid'
					);
					$save=$this->Pengguna_m->insert($data);
					$this->session->set_flashdata('pesan', 'Data User Berhasil Ditambah');
					redirect('login','refresh');
				}
			}else {

			}

		}
	}


}
