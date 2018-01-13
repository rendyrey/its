<?php if(!defined('BASEPATH')) exit('No direct access allowed');
/**
* s
*/
class Latihan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categori/Categori_m');
		$this->load->model('mapel/Mapel_m');
		//$this->load->model('kelas/Kelas_m');
		$this->load->model('Latihan_m');


	}
	public function index($message='')
	{
		$userid=$this->session->userdata('user_id')	;
		$data=array();
		$this->data['categories']=$this->Categori_m->get_categories();
		//$this->data['kelas']=$this->Kelas_m->get_kelas();
		if ($this->session->userdata('level')== 'superadmin')
		{
			$this->data['latihan']=$this->Latihan_m->get_all_latihan();
			$this->data['halaman']='latihan/vlatihan';
			$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda gak boleh ya";
		}
	}
	public function tambah($message='',$categori_id='',$kel_id='')
	{
		$userid=$this->session->userdata('user_id');
		$data=array();
		$this->data['message']=$message;
		$this->data['categori_id']=$categori_id;
		$this->data['kel_id']=$kel_id;
		$this->data['categories']=$this->Categori_m->get_categories();
		//$this->data['kelass']=$this->Kelas_m->get_kelas();
		$this->data['halaman']='latihan/vlatihanform';
		$this->load->view('_main',$this->data);
	}
	public function create_latihan($message='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category','Category','required|integer');
		//$this->form_validation->set_rules('kelas','Kelas','required|integer');
		$this->form_validation->set_rules('latihan_title','Latihan Title','required');
		$this->form_validation->set_rules('passing_score','Passing Score','required');
		if ($this->form_validation->run()==FALSE)
		{
			$this->tambah();
		}else
		{
			$form_info=array();
			if (!empty($_FILES['feature_image']['name']))
			{
				$config['upload_path']		='./assets/upload/latihan/';
				$config['allowed_types']	='gif|jpg|png|jpeg';
				$config['file_name']		=uniqid();
				$config['overwrite']		=TRUE;
				$config['max_size'] = '3000000';
        		$config['max_width']  = '5000000';
        		$config['max_height']  = '5000000';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('feature_image'))
				{
					echo "error";
				}else
				{
					$upload_data=$this->upload->data();
					$title_id=$this->Latihan_m->add_latihan_title($upload_data['file_name']);
				}
			}else
			{
				$title_id=$this->Latihan_m->add_latihan_title();
			}
			if ($title_id)
			{
				$message='sukses';
				$latihan_title=$this->input->post('latihan_title');
				$this->pertanyaanlatihan_form($message,$title_id,$latihan_title);
			}else
			{
				echo "gagal";
			}
		}
	}
	public function pertanyaanlatihan_form($message='',$title_id,$latihan_title='create question',$pertanyaanlatihan_no=1)
	{
		$data=array();
		$this->data['categories']=$this->Categori_m->get_categories();
		$this->data['message']=$message;
		$this->data['pertanyaanlatihan_no']=$pertanyaanlatihan_no;
		$this->data['latihan_title']=$latihan_title;
		$this->data['title_id']=$title_id;
		$this->data['halaman']='latihan/vpertanyaanlatihan_form';
		$this->load->view('_main',$this->data);
	}
	public function create_pertanyaanlatihan($message='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pertanyaanlatihan','Pertanyaan','required');
		//$this->form_validation->set_rules('right_jaw','jawaban yang benar','required');
		$this->form_validation->set_rules('jaw_type','jawaban type', 'required');
		$this->form_validation->set_rules('options[1]','option1','required');
		$this->form_validation->set_rules('options[2]','option2','required');
		if ($this->form_validation->run()==FALSE)
		{
			//$a=$this->form_validation->display_errors();
			echo validation_errors();
			//$this->pertanyaan_form('',$this->input->post('per_id'));
		}else
		{
			$latihan_id=$this->input->post('per_id',TRUE);
			$latihan_title=$this->input->post('latihan_title',TRUE);
			$file_name='';
			$file_type='';
			if(!empty($_FILES['media']['name']))
			{
				$config['upload_path']='./assets/upload/pertanyaan-media/'.$this->input->post('media_type').'/';
				if ($this->input->post('media_type')=='image')
				{
					$config['allowed_types']='gif|jpg|jpeg|png';
				}
				else if($this->input->post('media_type')=='audio')
				{
					$config['allowed_types']='application/ogg|mp3|wav';
				}
				$config['file_name']=uniqid();
				$config['overwrite']=TRUE;
				$this->load->library('upload',$config);
				if (!$this->upload->do_upload('media'))
				{
					redirect(site_url('Latihan/add_more_pertanyaanlatihan/'.$this->input->post('per_id')));
				}else
				{
					$upload_data=$this->upload->data();
					$file_name=$this->input->post('media_type').'/'.$upload_data['file_name'];
					$file_type=$this->input->post('media_type');
				}
			}else if($this->input->post('media',TRUE))
			{
				$file_name=$this->input->post('media');
				$file_type=$this->input->post('media_type');
			}
			if ($this->Latihan_m->add_pertanyaanlatihan($file_name,$file_type))
			{
				if ($this->input->post('done'))
				{
					//$message='sukses';
					//nanti redirect ke sisni
					$this->set_waktu_n_acak_per_no($latihan_id,$latihan_title,$message);
				}else
				{
					$message='berhasil ditambah';
					$pertanyaanlatihan_no=$this->input->post('per_no') + 1;
					$this->pertanyaanlatihan_form($message,$latihan_id,$latihan_title,$pertanyaanlatihan_no);
				}
			}else
			{
				$message='error';
				$this->pertanyaanlatihan_form($id='',$message='');
			}
		}
	}

	public function set_waktu_n_acak_per_no($id,$latihan_title='',$message='')
	{
		$data=array();
		$this->data['per_count']=$this->Latihan_m->pertanyaanlatihan_count_by_id($id);
		$this->data['message']=$message;
		$this->data['latihan_title']=$latihan_title;
		$this->data['latihan_id']=$id;
		$this->data['halaman']='latihan/vset_time';
		$this->load->view('_main',$this->data);
	}
	public function update_time_n_random_per_no()
	{
		$per_count=$this->input->post('per_count',TRUE)+1;
		$data=array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('duration','time duration','required|min_length[5]|max_length[8]');
		$this->form_validation->set_rules('random_per','totalrandom pertanyaan','required|integer|less_than['.$per_count.']');
		if ($this->form_validation->run()==FALSE)
		{
			$this->set_waktu_n_acak_per_no($this->input->post('latihan_id',TRUE),$this->input->post('latihan_title',TRUE));
		}else
		{
			if ($this->Latihan_m->set_time_n_random_per_no())
			{
				$message='sukses';
				//echo $messagde;
				//nanti redirect ke index
				redirect('latihan',$message);
			}
			else
			{
				$message = 'error';
				echo $message;
			}
		}
	}
	public function latihandetail($id, $message='')
	{
		if (!is_numeric($id))
		{
			show_404();
		}
		$data=array();
		$this->data['message']=$message;
		$this->data['latihan_title']=$this->Latihan_m->get_latihan_by_id($id);
		if (!(empty($this->data['latihan_title'])) && (($this->session->userdata('level') == 'superadmin') OR ($this->data['latihan_title']->user_id == $this->session->userdata('user_id'))))
		{
			$this->data['latihans']=$this->Latihan_m->get_latihan_detail($id);
			$this->data['latihan_jawabanlatihan']=$this->Latihan_m->get_latihan_jawabanlatihan($this->data['latihans']);
			$this->data['halaman']='latihan/latihan_detail';
			$this->data['modal']='latihan/update_pertanyaanlatihan';
			$this->load->view('_main',$this->data);
			//$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda tidak berhak";
		}
	}
	public function update_pertanyaanlatihan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pertanyaanlatihan','Pertanyaan','required');
		$latihan_id=$this->input->post('latihan_id',TRUE);
		if ($this->form_validation->run()==FALSE)
		{
			echo "error";
		}elseif ($this->Latihan_m->update_pertanyaanlatihan_m())
		{
			$this->latihandetail($latihan_id);
		}else
		{
			echo displays_errors();
		}
	}
	public function update_jawabanlatihan($per_id)
	{
		echo ($this->Latihan_m->update_jawabanlatihan($per_id)) ? 'TRUE' : 'FALSE';
	}
 	public function add_more_pertanyaanlatihan($id='',$message='')
 	{
 		if (!is_numeric($id))
 		{
 			show_404();
 		}
 		$latihan=$this->Latihan_m->get_latihan_title($id);
 		if ((empty($latihan)) OR ($latihan->user_id != $this->session->userdata('user_id')))
 		{
 			$message= "hanya author yang bisa menambahkan";
 			$this->Latihan($message);
 		}else
 		{
 			$latihan_title=$latihan->judul_latihan;
 			$title_id=$latihan->title_id;
 			$pertanyaanlatihan_no=$this->Latihan_m->pertanyaanlatihan_count_by_id($id)+ 1;
 			$this->pertanyaanlatihan_form($message,$title_id,$latihan_title,$pertanyaanlatihan_no);
 		}
 	}
 	public function delete_pertanyaanlatihan ($id)
 	{
		if (!is_numeric($id)) {
			return FALSE;
		}
		$author=$this->Latihan_m->get_pertanyaanlatihan_by_id($id);
		if(empty($author) OR ($author->user_id != $this->session->userdata('user_id'))){
			exit('kamu tidak berhak melakkan ini');
		}
		$per_id=$author->latihan_id;
		if ($this->Latihan_m->delete_pertanyaanlatihan_dengan_jawabanlatihan($id))
		{
			$message='sukses dihapus';
			$this->latihandetail($per_id,$message);
		}else
		{
			$message="error";
			$this->latihan($per_id,$message);
		}
 	}
 	public function delete_jawabanlatihan($id)
 	{
 		if (!is_numeric($id)) {
 			show_404();
 		}
 		$author=$this->Latihan_m->get_jawabanlatihan_by_id($id);
 		if (empty($author) OR ($author->user_id != $this->session->userdata('user_id'))) {
 			exit('kamu tidak berhak melakkan ini');
 		}
 		$per_id=$author->latihan_id;
 		if ($this->Latihan_m->delete_jawabanlatihan($id))
 		{
 			$message="sukses";
 			$this->latihandetail($per_id,$message);
 		}else
 		{
 			$message="error";
 			$this->latihandetail($per_id,$message);
 		}

 	}
 	public function delete_latihan($id)
 	{
 		if (!is_numeric($id))
 		{
 			show_404();
 		}
 		$user_id=$this->session->userdata('user_id');
 		$level=$this->session->userdata('level');
 		if ($level == 'superadmin')
 		{
 			if ($this->Latihan_m->delete_latihan_dengan_pertanyaanlatihan($id))
 			{
 				$message="sukses";
 				redirect('latihan',$message);
 			}else
 			{
 				$message="error";
 				redirect('latihan',$message);
 			}
 		}else
 		{
 			$author=$this->Latihan_m->get_latihan_by_id($id);
 			if (empty($author) OR ($level != 'superadmin') && ($author->user_id != $user_id))
 			{
 				exit('anda tidak berhak');
 			}
 		}
 	}
 	public function edit_latihan_detail($id,$message='')
 	{
 		if(!is_numeric($id)){show_404();}
 		$data=array();
 		$this->data['message']=$message;
		$this->data['mapel'] = $this->Mapel_m->tampil();
 		$this->data['latihan']=$this->Latihan_m->get_latihan_detail_m($id);
 		$this->data['per_count']=$this->Latihan_m->pertanyaanlatihan_count_by_id($id);
 		$this->data['halaman']='latihan/vform_edit';
 		$this->load->view('_main',$this->data);
 	}
 	public function update_latihan($id,$message='')
 	{
 		$this->load->library('form_validation');
 		// $this->form_validation->set_rules('category','Category','required|integer');
 		//$this->form_validation->set_rules('kelas','Kelas','required|integer');
		$this->form_validation->set_rules('latihan_title','Latihan Title','required');
		$this->form_validation->set_rules('passing_score','Passing Score','required');
		//$this->form_validation->set_rules('latihan_syllabus','latihan_syllabus','required');
		$this->form_validation->set_rules('duration','Durasi','required');
		$this->form_validation->set_rules('random_per','Random Soal','required');
		if($this->form_validation->run()==FALSE)
		{
			$this->tambah();
		}else
		{
			$form_info=array();
			if (!empty($_FILES['feature_image']['name']))
			{
				$config['upload_path']		='./assets/upload/latihan/';
				$config['allowed_types']	='gif|jpg|png|jpeg';
				$config['file_name']		=uniqid();
				$config['overwrite']		=TRUE;
				$config['max_size'] = '3000000';
        		$config['max_width']  = '5000000';
        		$config['max_height']  = '5000000';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('feature_image'))
				{
					//$error=array('error'=>$this->display_errors());
					echo "gagal";
					//redirect(base_url('ujian/edit_ujian_detail/'.$id));
				}else
				{
					$upload_data=$this->upload->data();

					$title_id=$this->Latihan_m->add_latihan_title($upload_data['file_name']);
				}
			}else
			{
				$title_id=$this->Latihan_m->update_latihan_m($id);
				//$title_id=$this->Ujian_m->update_ujian_m($upload_data['file_name']);
			}
			if ($title_id)
			{
				$message='sukses';
				$this->session->flashdata('message',$message);
				redirect('latihan');
			}else
			{
				$message=mysql_error();
				$this->session->set_flashdata('message',$message);
				// redirect(base_url('latihan/edit_latihan_detail/'.$id));
				echo "hai";
			}

		}
 	}
 	public function nonaktif($id)
	{

		if($this->Latihan_m->nonaktif_m($id))
		{
			redirect('latihan',$message);
		}else{
			echo "error";
		}


	}
	public function aktif($id)
	{

		if($this->Latihan_m->aktif_m($id))
		{
			$message='sukses';
			redirect('latihan',$message);
		}else{
			echo "error";
		}


	}
	public function hasillatihan()
	{
			$this->data['hasillatihan']=$this->Latihan_m->hasillatihan();
			$this->data['halaman']="latihan/vhasillatihan";
			$this->load->view('_main',$this->data);
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
			$this->hasillatihan($pesan);
		}else
		{
			if(($author->participant_id != $this->session->userdata('user_id')) && $this->session->userdata('level')!='superadmin')
			{
				exit('kamu tidak berhak');
			}else
			{
				$data=array();
				$this->data['pesan']=$pesan;
				$this->data['hasilslatihan']=$author;
				$this->data['halaman']='latihan/vlatihan_detail_hasillatihan';
				$this->load->view('_main',$this->data);
			}
		}
	}
	public function cetak($id='',$message='')
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
			$this->hasillatihan($message);
		}else
		{
			if(($author->participant_id != $this->session->userdata('user_id')) && $this->session->userdata('level')!='superadmin')
			{
				echo "yayayay";
			}else
			{
				$data=array();
				$this->data['message']=$message;
				$this->data['hasilslatihan']=$author;

				//$this->data['halaman']='latihan/vcetaknilai';

				$this->load->helper('dompdf');
				$cetak=$this->load->view('vcetaknilai',$this->data,true);
				pdf_create($cetak,$this->data['hasilslatihan']->nama);

			}
		}
	}
	public function deletehasillatihan($hasillatihan_id)
	{
		$this->Latihan_m->deletehasillatihan($hasillatihan_id);
		echo json_encode(array("status"=>TRUE));
	}
}
