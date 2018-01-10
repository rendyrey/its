<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
       	$this->load->model('Login_m');
		
	}
	public function index()
	{
		if ($this->session->userdata('logged_in')==TRUE)
		{
			redirect('dashboard','refresh');
		}
		else
		{
		//$this->data['halaman']="vlogin";
		$this->load->view('vlogin');
		}
	}
	

}

/* End of file logih.php */
/* Location: ./application/controllers/logih.php */