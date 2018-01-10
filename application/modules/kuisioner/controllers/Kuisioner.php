<?php if(!defined('BASEPATH'))exit('No direct access allowed');
/**
* 
*/
class Kuisioner extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kuisioner_m');
		$this->load->model('categori/Categori_m');
		$this->load->library('form_validation');
	}
	
	public function index ()
	{
		if($this->session->userdata('logged_in')!=TRUE){
			redirect('login');
		}
		else {
			if($this->session->userdata('quis')==='1'){
				redirect('dashboard','refresh');	
			} else {
				$this->data['quis']=$this->Kuisioner_m->tampil();
				$this->load->view('vkuisioner',$this->data);
			}
		}
	}
	public function simpan()
	{
		if ($this->session->userdata('logged_in')!=TRUE) 
		{
			redirect('Login');
		}
		else 
		{
			$jml = count($this->input->post('kuisioner_id'));
			$user = $this->session->userdata('user_id');
			for($i=0;$i<$jml;$i++){
				$id = $this->input->post('kuisioner_id')[$i];
				$data=array(
					'kuisioner_id' => $id,
					'user_id' => $user,
					'jawab' => $this->input->post('jawab_'.$id)
					);
				$insert=$this->Kuisioner_m->insert_hasil($data);
			}
			$update=$this->Kuisioner_m->updatequis($user);
			$this->session->set_userdata(array('quis'=>'1'));
			$this->session->set_flashdata('pesan', 'Terima kasih sudah berpartisipasi dalam mengisi kuisioner.');
			redirect('dashboard');
			
		}
	}
	public function delete($categori_id)
	{
		$this->Categori_m->delete($categori_id);
		echo json_encode(array("status"=>TRUE));
	}
	public function update($categori_id)
	{
		$data=$this->Categori_m->getid($categori_id);
		echo json_encode($data);
	}
	public function updateaction()
	{
		$data=array(
				'nama_categori'	=>$this->input->post('nama_categori')
			);
		$this->Categori_m->actionupdate(array('categori_id'=>$this->input->post('categori_id')),$data);
		echo json_encode(array("status"=>TRUE));
	}
}