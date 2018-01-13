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

  public function hapus_indikator($id)
	{
		$data = array();

        $this->Indikator_m->deleteindikator($id);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('Indikator','refresh');
	}

  public function edit_indikator($id){
    if(!is_numeric($id)){show_404();}
		// $this->data['categories']=$this->Categori_m->get_categories();
		// $this->data['pesan']=$pesan;
		$this->data['indikator']=$this->Indikator_m->get_indikator_detail($id);
		$this->data['halaman']="Indikator/editindikator";
		$this->load->view('_main',$this->data);
  }
  public function update_indikator()
  {
      $id=$this->input->post('id_indikator');
      $mapel= $this->input->post('mapel_id');
      $nama_indikator= $this->input->post('nama_indikator');
      $status=$this->input->post('status');

      $this->form_validation->set_rules('mapel_id','Mapel','required');
      $this->form_validation->set_rules('id_indikator','Indikator','required');
      $this->form_validation->set_rules('status','Status','required');

      if($this->form_validation->run()==FALSE)
      {
        redirect('Indikator/edit_indikator_detail/$id','refresh');
      }else
      {

                $data = array(
                    'nama_indikator' => $nama_indikator,
                    'mapel_id' => $mapel,
                    'active' => $status
                );

                $this->Indikator_m->actionupdate($id, $data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Di Update');
                redirect('Indikator');
      }
  }
}
/* End of file ${TM_FILENAME:${1/(.+)/l.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)//:application/controllers/${1/(.+)/l.php/}} */
