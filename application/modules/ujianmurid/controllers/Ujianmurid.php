<?php if(!defined('BASEPATH'))exit('No direct access allowed');
/**
*
*/
class Ujianmurid extends CI_Controller
{
	public $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kursus/Kursus_m');
		$this->load->model('ujian/Ujian_m');
		// $this->load->model('categori/Categori_m');
		//$this->load->model('kelas/Kelas_m');
		$this->load->model('murid/Murid_m');
		$this->load->library('form_validation');
	}
	public function index()
	{
		if($this->input->post('token')==$this->session->userdata('token'))
		{
			exit('cant resubmit form');
		}
		if ($this->session->userdata('logged_in')==FALSE)
		{
			$this->session->set_userdata('back_url',current_url());
			redirect('login','refresh');
		}

		$result_id=$this->Ujian_m->evaluasi_hasil();
		if ($result_id) {
			$this->session->set_userdata('token',$this->input->post('token'));
			$this->hasil_detail($result_id);
		}else
		{

			$message='ada kesalahan';
			$this->ujian($message);
		}
	}

	public function materi ($pesan='')

	{


		if($this->session->userdata('logged_in')!=TRUE){
			redirect('login');
		}
		else {

				$userid=$this->session->userdata('user_id');
				$this->data['pesan']=$pesan;
				$this->data['doc']=$this->Kursus_m->ambil_materi();
				$this->data['hasils']=$this->Murid_m->saran($userid);
			//	$this->data['hasilss']=$this->Murid_m->saran2($this->data['hasils']=$this->Murid_m->saran($userid));
				$this->data['halaman']='vmateri';
				$this->load->view('_murid',$this->data);
			}

	}


	public function ujian($message="")
	{
		if($this->session->userdata('pretest')==1){
			$data=array();
			$this->data['ujian']=$this->Ujian_m->get_all_ujian();
			// $this->data['categories']=$this->Categori_m->getcategori();
			//$this->data['kelass']=$this->Kelas_m->getkelas();
			$this->data['message']=$message;
			$this->data['halaman']='vlistujian';
			$this->load->view('_murid',$this->data);
		}else{
			redirect('Murid/materi');
		}

	}

	public function pretest($message=""){
		$data=array();
		$this->data['ujian']=$this->Ujian_m->get_all_pretest();
		// $this->data['categories']=$this->Categori_m->getcategori();
		//$this->data['kelass']=$this->Kelas_m->getkelas();
		$this->data['message']=$message;
		$this->data['halaman']='ujianmurid/vlistujian_pretest';
		$this->load->view('_murid',$this->data);
	}
	public function view_ujian_summery($id='',$message='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['message']=$message;
		$this->data['ujian']=$this->Ujian_m->get_ujian_by_id($id);
		if (!$this->data['ujian']) {
			show_404();
		}
		$this->data['halaman']='vujian_summery';
		$this->load->view('_murid',$this->data);

	}
	public function view_ujian_instructions($id='',$message='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['message']=$message;
		$this->data['ujian']=$this->Ujian_m->get_ujian_by_id($id);
		if (!$this->data['ujian']) {
			show_404();
		}
		$this->data['halaman']='vinstruction';
		$this->load->view('_murid',$this->data);
	}
	public function mulai_ujian($id='',$message='')
	{
		$this->load->helper('cookie');
		if(($id=='') OR !is_numeric($id)) show_404();
		if(!$this->session->userdata('logged_in')){
			$this->session->set_userdata('back_url',current_url());
			redirect(site_url('login'));
		}
		$data=array();
		$this->data['message']=$message;
		$this->data['ujian']=$this->Ujian_m->get_ujian_by_id($id);
		if(!$this->data['ujian'])show_404();
		if($this->input->cookie('UjianTimeDuration'))
		{
			$this->data['duration']=$this->input->cookie('UjianTimeDuration',TRUE)-1;
		}else
		{
			$this->data['duration']=$this->data['ujian']->duration;
		}
		$total_pertanyaan=$this->Ujian_m->get_ujian_detail($id);
		$counter=count($total_pertanyaan);
		$pertanyaan=array();
		$i=0;
		do {
			$index=rand(0,$counter-1);
			if (array_key_exists($index, $pertanyaan)) {
				continue;
			}
			$pertanyaan[$index]=$total_pertanyaan[$index];
			$i++;
		} while ($i < $this->data['ujian']->acak_soal);
		$this->data['pertanyaan']=$pertanyaan;
		$this->data['per_count']=$counter;
		$this->data['jawaban']=$this->Ujian_m->get_ujian_jawaban($this->data['pertanyaan']);
		$this->data['halaman']='vmulai';
		$this->data['no_contact_form']=TRUE;
		$this->load->view('_murid',$this->data);
	}

	public function hasil_detail($id='',$message='')
	{
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login','refresh');
		}
		if(!is_numeric($id)){show_404();}
		$author=$this->Ujian_m->hasil_detail_m($id);
		if(empty($author))
		{
			$message="tidak ada";
			$this->hasil($message);
		}else
		{
			if($author->participant_id != $this->session->userdata('user_id'))
			{
				echo "yayayay";
			}else
			{
				$data=array();

				$this->session->set_userdata('pretest',1);
				$this->Murid_m->update_pretest($this->session->userdata('user_id'));
				$this->data['message']=$message;
				$this->data['hasils']=$author;
				$this->data['halaman']='vhasil_detail';
				$this->load->view('_murid',$this->data);
			}
		}
	}
	public function hasil($message="")
	{
		$userid=$this->session->userdata('user_id');
		$data=array();
		if($this->session->userdata('level')== 'murid')
		{
			$this->data['hasil']=$this->Murid_m->get_my_hasilujian($userid);
			$this->data['halaman']="vresults";
			$this->load->view('_murid',$this->data);
		}
	}
	public function lihat_ujian_detail($id='',$pesan='')
	{
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
		if(!is_numeric($id)){show_404();}
		$author=$this->Ujian_m->hasil_detail_m($id);
		if(empty($author))
		{
			$pesan='tidak ada';
			$this->hasil($pesan);
		}else
		{
			if(($author->participant_id != $this->session->userdata('user_id')) && $this->session->userdata('level')!='superadmin')
			{
				exit('kamu tidak berhak');
			}else
			{
				$data=array();
				$this->data['pesan']=$pesan;
				$this->data['hasils']=$author;
				$this->data['halaman']='ujian_detail';
				$this->load->view('_murid',$this->data);
			}
		}
	}

}
