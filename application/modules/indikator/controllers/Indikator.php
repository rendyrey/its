<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Indikator  extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->database();
		$this->load->model('Indikator_m');
		$this->load->model('pengguna/Pengguna_m');
    $this->load->model('categori/Categori_m');
		$this->load->model('kompetensi_dasar/Kompetensi_m');

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  }
  public function index()
  {
    if ($this->session->userdata('logged_in')==TRUE)
		{
      $data=array();
  		$userid=$this->session->userdata('user_id');
  		//$this->data['categoris']=$this->Kursus_m->getsubcategori();
  		if ($this->session->userdata('level')=='superadmin')
  		{
  		if(isset($_GET['category']) && $_GET['category']!='' && isset($_GET['mapel']) && $_GET['mapel']!=''){
  			$this->data['kompetensi']=$this->Kompetensi_m->getallcat($_GET['category'],$_GET['mapel']);
  		} else {
  			$this->data['kompetensi']=$this->Kompetensi_m->getall();
  		}
  		// $this->data['message']=$message;
  		// $this->data['cat_id']=$cat_id;
  		$this->data['categories']=$this->Categori_m->get_categories();
  		$this->data['halaman']="indikator/vindikator";
  		$this->load->view('_main',$this->data);
  		}
  		else
  		{
  			echo "anda tidak berhak";
  		}
		}else{
			$data['message'] = '';
			$this->load->view('login/vlogin',$data);
			// echo "hai";
		}
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/l.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)//:application/controllers/${1/(.+)/l.php/}} */
