<?php if(!defined('BASEPATH'))exit('No direct access allowed');
/**
*
*/
class Murid extends CI_Controller
{
	public $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kursus/Kursus_m');
		$this->load->model('saran/Saran_m');
		$this->load->model('latihan/Latihan_m');
		$this->load->model('categori/Categori_m');
		//$this->load->model('kelas/Kelas_m');
		$this->load->model('Murid_m');
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

		$result_id=$this->Latihan_m->evaluasi_hasillatihan();
		if ($result_id) {
			$this->session->set_userdata('token',$this->input->post('token'));
			$this->hasil_detail($result_id);
		}else
		{

			$message='ada kesalahan';
			$this->latihan($message);
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
				$this->data['doc']=$this->Kursus_m->tampil();
				//$this->data['hasils']=$this->Murid_m->saran($userid);
				$this->data['hasils']=$this->Saran_m->tampil();
			//	$this->data['hasilss']=$this->Murid_m->saran2($this->data['hasils']=$this->Murid_m->saran($userid));
				$this->data['halaman']='vmateri';
				$this->load->view('_murid',$this->data);
			}

	}


	public function latihan($message="")
	{
		$data=array();
		$this->data['latihan']=$this->Latihan_m->get_all_latihan();
		$this->data['categories']=$this->Categori_m->getcategori();
		//$this->data['kelass']=$this->Kelas_m->getkelas();
		$this->data['message']=$message;
		$this->data['halaman']='vlistlatihan';
		$this->load->view('_murid',$this->data);
	}
	public function view_latihan_summery($id='',$message='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['message']=$message;
		$this->data['latihan']=$this->Latihan_m->get_latihan_by_id($id);
		if (!$this->data['latihan']) {
			show_404();
		}
		$this->data['halaman']='vlatihan_summery';
		$this->load->view('_murid',$this->data);

	}
	public function view_latihan_instructions($id='',$message='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['message']=$message;
		$this->data['latihan']=$this->Latihan_m->get_latihan_by_id($id);
		if (!$this->data['latihan']) {
			show_404();
		}
		$this->data['halaman']='vinstruction';
		$this->load->view('_murid',$this->data);
	}
	public function mulai_latihan($id='',$message='')
	{
		$this->load->helper('cookie');
		if(($id=='') OR !is_numeric($id)) show_404();
		if(!$this->session->userdata('logged_in')){
			$this->session->set_userdata('back_url',current_url());
			redirect(site_url('login'));
		}
		$data=array();
		$this->data['message']=$message;
		$this->data['latihan']=$this->Latihan_m->get_latihan_by_id($id);
		if(!$this->data['latihan'])show_404();
		if($this->input->cookie('LatihanTimeDuration'))
		{
			$this->data['duration']=$this->input->cookie('LatihanTimeDuration',TRUE)-1;
		}else
		{
			$this->data['duration']=$this->data['latihan']->duration;
		}
		$total_pertanyaanlatihan=$this->Latihan_m->get_latihan_detail($id);
		$counter=count($total_pertanyaanlatihan);
		$pertanyaanlatihan=array();
		$i=0;
		do {
			$index=rand(0,$counter-1);
			if (array_key_exists($index, $pertanyaanlatihan)) {
				continue;
			}
			$pertanyaanlatihan[$index]=$total_pertanyaanlatihan[$index];
			$i++;
		} while ($i < $this->data['latihan']->acak_soal);
		$this->data['pertanyaanlatihan']=$pertanyaanlatihan;
		$this->data['per_count']=$counter;
		$this->data['jawabanlatihan']=$this->Latihan_m->get_latihan_jawabanlatihan($this->data['pertanyaanlatihan']);
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
		$author=$this->Latihan_m->hasillatihan_detail_m($id);
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
			$this->data['hasil']=$this->Murid_m->get_my_hasillatihan($userid);
			$this->data['halaman']="vresults";
			$this->load->view('_murid',$this->data);
		}
	}
	public function lihat_latihan_detail($id='',$pesan='')
	{
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
		if(!is_numeric($id)){show_404();}
		$author=$this->Latihan_m->hasillatihan_detail_m($id);
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
				$this->data['halaman']='latihan_detail';
				$this->load->view('_murid',$this->data);
			}
		}
	}

	public function profile(){

				if($this->session->userdata('logged_in')!=TRUE){
					redirect('login');
				}
				else {

				// n2($this->data['hasils']=$this->Murid_m->saran($userid));
						$this->data['halaman']='profile_murid';
						$this->load->view('_murid',$this->data);
					}
	}

}
