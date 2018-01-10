<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
	public $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();		
	}
	public function index()
	{
		if ($this->session->userdata('logged_in')==TRUE)
		{	
			if($this->session->userdata('quis')==='0' && $this->session->userdata('level')!='superadmin'){
				redirect('kuisioner','refresh');
			}
			if($this->session->userdata('level')=='superadmin')
			{
				$this->data['halaman']='home';
				$this->load->view('_main',$this->data);
			}else
			{
				$this->data['halaman']='home';
				$this->load->view('_murid',$this->data);
			}

		}
		else
		{
		//$this->data['halaman']="vlogin";
		redirect('login','refresh');
		}
	}
	

}

/* End of file logih.php */
/* Location: ./application/controllers/logih.php */