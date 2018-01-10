<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends CI_Controller {

	public function index()
	{
		$this->data['halaman']='vmodul';
		$this->load->view('_main',$this->data);
	}

}

/* End of file modul.php */
/* Location: ./application/controllers/modul.php */