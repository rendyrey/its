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
    $this->load->model('mapel/Mapel_m');

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

  			$this->data['indikator']=$this->Indikator_m->getall();

  		// $this->data['message']=$message;
  		// $this->data['cat_id']=$cat_id;
      $mapel = $this->Mapel_m->tampil();
  		foreach($mapel as $row){
  			$this->data['mapel'][] = $row->nama_mapel;
  			$this->data['mapel_id'][] = $row->mapel_id;
  		}
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

  public function addindikator(){
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
      $mapel = $this->Mapel_m->tampil();
  		foreach($mapel as $row){
  			$this->data['mapel'][] = $row->nama_mapel;
  			$this->data['mapel_id'][] = $row->mapel_id;
  		}
  		$this->data['halaman']="indikator/addindikator";
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
  public function simpanindikator()
	{
		$this->form_validation->set_rules('mapel', 'Mapel', 'required');
		$this->form_validation->set_rules('kompetensi', 'Kompetensi', 'required');
		if($this->form_validation->run()==FALSE){
			echo "gagagl";
		}else{
			$data=array(
			'nama_indikator'	=> $this->input->post('nama_indikator'),
			'kompetensi_id'	=> $this->input->post('kompetensi'),
			'mapel_id'	=> $this->input->post('mapel')
			);
			$save=$this->Indikator_m->insert($data);
			$this->session->set_flashdata('pesan', 'Data Berhasil Di Tambah');
			redirect('Indikator','refresh');

		}
	}
}
/* End of file ${TM_FILENAME:${1/(.+)/l.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)//:application/controllers/${1/(.+)/l.php/}} */
