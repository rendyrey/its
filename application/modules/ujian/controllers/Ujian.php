<?php if(!defined('BASEPATH')) exit('No direct access allowed');
/**
*
*/
class Ujian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categori/Categori_m');
		//$this->load->model('kelas/Kelas_m');
		$this->load->model('Ujian_m');
		$this->load->model('mapel/Mapel_m');
		//$this->load->model('Categori/Categori_m');
	}
	public function index($message='')
	{
		$userid=$this->session->userdata('user_id')	;
		$data=array();
		//$this->data['kelas']=$this->Kelas_m->get_kelas();
		if ($this->session->userdata('level')== 'superadmin')
		{
			$this->data['ujian']=$this->Ujian_m->get_all_ujian();
			$this->data['halaman']='ujian/vujian';
			$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda gak boleh ya";
		}
	}
	public function tambah($message='',$cat_id='',$kel_id='')
	{
		$userid=$this->session->userdata('user_id');
		$data=array();
		$this->data['message']=$message;
		// $this->data['cat_id']=$cat_id;
		$this->data['kel_id']=$kel_id;
		// $this->data['categories']=$this->Categori_m->get_categories();
		//$this->data['kelass']=$this->Kelas_m->get_kelas();
		$this->data['halaman']='ujian/vujianform';
		$this->load->view('_main',$this->data);
	}
	public function create_ujian($message='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category','Category','required|integer');
		//$this->form_validation->set_rules('kelas','Kelas','required|integer');
		$this->form_validation->set_rules('ujian_title','Ujian Title','required');
		$this->form_validation->set_rules('passing_score','Passing Score','required');
		if ($this->form_validation->run()==FALSE)
		{
			$this->tambah();
		}else
		{
			$form_info=array();
			if (!empty($_FILES['feature_image']['name']))
			{
				$config['upload_path']		='./assets/upload/ujian/';
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
					$title_id=$this->Ujian_m->add_ujian_title($upload_data['file_name']);
				}
			}else
			{
				$title_id=$this->Ujian_m->add_ujian_title();
			}
			if ($title_id)
			{
				$message='sukses';
				$ujian_title=$this->input->post('ujian_title');
				$this->pertanyaan_form($message,$title_id,$ujian_title);
			}else
			{
				echo "gagal";
			}
		}
	}
	public function pertanyaan_form($message='',$title_id,$ujian_title='create question',$pertanyaan_no=1)
	{
		$data=array();
		$this->data['categories']=$this->Categori_m->get_categories();
		$this->data['message']=$message;
		$this->data['pertanyaan_no']=$pertanyaan_no;
		$this->data['ujian_title']=$ujian_title;
		$this->data['title_id']=$title_id;
		$this->data['halaman']='ujian/vpertanyaan_form';
		$this->load->view('_main',$this->data);
	}
	public function create_pertanyaan($message='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pertanyaan','Pertanyaan','required');
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
			$ujian_id=$this->input->post('per_id',TRUE);
			$ujian_title=$this->input->post('ujian_title',TRUE);
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
					redirect(site_url('Ujian/add_more_pertanyaan/'.$this->input->post('per_id')));
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
			if ($this->Ujian_m->add_pertanyaan($file_name,$file_type))
			{
				if ($this->input->post('done'))
				{
					//$message='sukses';
					//nanti redirect ke sisni
					$this->set_waktu_n_acak_per_no($ujian_id,$ujian_title,$message);
				}else
				{
					$message='berhasil ditambah';
					$pertanyaan_no=$this->input->post('per_no') + 1;
					$this->pertanyaan_form($message,$ujian_id,$ujian_title,$pertanyaan_no);
				}
			}else
			{
				$message='error';
				$this->pertanyaan_form($id='',$message='');
			}
		}
	}

	public function set_waktu_n_acak_per_no($id,$ujian_title='',$message='')
	{
		$data=array();
		$this->data['per_count']=$this->Ujian_m->pertanyaan_count_by_id($id);
		$this->data['message']=$message;
		$this->data['ujian_title']=$ujian_title;
		$this->data['ujian_id']=$id;
		$this->data['halaman']='ujian/vset_time';
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
			$this->set_waktu_n_acak_per_no($this->input->post('ujian_id',TRUE),$this->input->post('ujian_title',TRUE));
		}else
		{
			if ($this->Ujian_m->set_time_n_random_per_no())
			{
				$message='sukses';
				//echo $message;
				//nanti redirect ke index
				redirect('ujian',$message);
			}
			else
			{
				$message = 'error';
				echo $message;
			}
		}
	}
	public function ujiandetail($id, $message='')
	{
		if (!is_numeric($id))
		{
			show_404();
		}
		$data=array();
		$this->data['message']=$message;
		$this->data['ujian_title']=$this->Ujian_m->get_ujian_by_id($id);
		if (!(empty($this->data['ujian_title'])) && (($this->session->userdata('level') == 'superadmin') OR ($this->data['ujian_title']->user_id == $this->session->userdata('user_id'))))
		{
			$this->data['ujians']=$this->Ujian_m->get_ujian_detail($id);
			$this->data['ujian_jawaban']=$this->Ujian_m->get_ujian_jawaban($this->data['ujians']);
			$this->data['halaman']='ujian/ujian_detail';
			$this->data['modal']='ujian/update_pertanyaan';
			$this->load->view('_main',$this->data);
			//$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda tidak berhak";
		}
	}
	public function update_pertanyaan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pertanyaan','Pertanyaan','required');
		$ujian_id=$this->input->post('ujian_id',TRUE);
		if ($this->form_validation->run()==FALSE)
		{
			echo "error";
		}elseif ($this->Ujian_m->update_pertanyaan_m())
		{
			$this->ujiandetail($ujian_id);
		}else
		{
			echo displays_errors();
		}
	}
	public function update_jawaban($per_id)
	{
		echo ($this->Ujian_m->update_jawaban($per_id)) ? 'TRUE' : 'FALSE';
	}
 	public function add_more_pertanyaan($id='',$message='')
 	{
 		if (!is_numeric($id))
 		{
 			show_404();
 		}
 		$ujian=$this->Ujian_m->get_ujian_title($id);
 		if ((empty($ujian)) OR ($ujian->user_id != $this->session->userdata('user_id')))
 		{
 			$message= "hanya author yang bisa menambahkan";
 			$this->Ujian($message);
 		}else
 		{
 			$ujian_title=$ujian->judul_ujian;
 			$title_id=$ujian->title_id;
 			$pertanyaan_no=$this->Ujian_m->pertanyaan_count_by_id($id)+ 1;
 			$this->pertanyaan_form($message,$title_id,$ujian_title,$pertanyaan_no);
 		}
 	}
 	public function delete_pertanyaan ($id)
 	{
		if (!is_numeric($id)) {
			return FALSE;
		}
		$author=$this->Ujian_m->get_pertanyaan_by_id($id);
		if(empty($author) OR ($author->user_id != $this->session->userdata('user_id'))){
			exit('kamu tidak berhak melakkan ini');
		}
		$per_id=$author->ujian_id;
		if ($this->Ujian_m->delete_pertanyaan_dengan_jawaban($id))
		{
			$message='sukses dihapus';
			$this->ujiandetail($per_id,$message);
		}else
		{
			$message="error";
			$this->ujiandetail($per_id,$message);
		}
 	}
 	public function delete_jawaban($id)
 	{
 		if (!is_numeric($id)) {
 			show_404();
 		}
 		$author=$this->Ujian_m->get_jawaban_by_id($id);
 		if (empty($author) OR ($author->user_id != $this->session->userdata('user_id'))) {
 			exit('kamu tidak berhak melakkan ini');
 		}
 		$per_id=$author->ujian_id;
 		if ($this->Ujian_m->delete_jawaban($id))
 		{
 			$message="sukses";
 			$this->ujiandetail($per_id,$message);
 		}else
 		{
 			$message="error";
 			$this->ujiandetail($per_id,$message);
 		}

 	}
 	public function delete_ujian($id)
 	{
 		if (!is_numeric($id))
 		{
 			show_404();
 		}
 		$user_id=$this->session->userdata('user_id');
 		$level=$this->session->userdata('level');
 		if ($level == 'superadmin')
 		{
 			if ($this->Ujian_m->delete_ujian_dengan_pertanyaan($id))
 			{
 				$message="sukses";
 				redirect('ujian',$message);
 			}else
 			{
 				$message="error";
 				redirect('ujian',$message);
 			}
 		}else
 		{
 			$author=$this->Ujian_m->get_ujian_by_id($id);
 			if (empty($author) OR ($level != 'superadmin') && ($author->user_id != $user_id))
 			{
 				exit('anda tidak berhak');
 			}
 		}
 	}
 	public function edit_ujian_detail($id,$message='')
 	{
 		if(!is_numeric($id)){show_404();}
 		$data=array();
 		$this->data['message']=$message;
 		$this->data['ujian']=$this->Ujian_m->get_ujian_detail_m($id);
		$this->data['mapel']=$this->Mapel_m->tampil();
 		$this->data['per_count']=$this->Ujian_m->pertanyaan_count_by_id($id);
 		$this->data['halaman']='ujian/vform_edit';
 		$this->load->view('_main',$this->data);
 	}
 	public function update_ujian($id,$message='')
 	{
 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('category','Category','required|integer');
 		//$this->form_validation->set_rules('kelas','Kelas','required|integer');
		$this->form_validation->set_rules('ujian_title','Ujian Title','required');
		$this->form_validation->set_rules('passing_score','Passing Score','required');
		//$this->form_validation->set_rules('ujian_syllabus','ujian_syllabus','required');
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
				$config['upload_path']		='./assets/upload/ujian/';
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

					$title_id=$this->Ujian_m->add_ujian_title($upload_data['file_name']);
				}
			}else
			{
				$title_id=$this->Ujian_m->update_ujian_m($id);
				//$title_id=$this->Ujian_m->update_ujian_m($upload_data['file_name']);
			}
			if ($title_id)
			{
				$message='sukses';
				$this->session->flashdata('message',$message);
				redirect(site_url('ujian'));
			}else
			{
				$message=mysql_error();
				$this->session->set_flashdata('message',$message);
				redirect('ujian/edit_ujian_detail/'.$id);

			}

		}
 	}
 	public function nonaktif($id)
	{

		if($this->Ujian_m->nonaktif_m($id))
		{
			redirect('ujian',$message);
		}else{
			echo "error";
		}


	}
	public function aktif($id)
	{

		if($this->Ujian_m->aktif_m($id))
		{
			$message='sukses';
			redirect('ujian',$message);
		}else{
			echo "error";
		}


	}
	public function hasil()
	{
			$this->data['hasil']=$this->Ujian_m->hasil();
			$this->data['halaman']="ujian/vhasil";
			$this->load->view('_main',$this->data);
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
				$this->data['halaman']='ujian/vujian_detail_hasil';
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
		$author=$this->Ujian_m->hasil_detail_m($id);
		if(empty($author))
		{
			$message="tidak ada";
			$this->hasil($message);
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
	public function deletehasil($hasil_id)
	{
		$this->Ujian_m->deletehasilujian($hasil_id);
		echo json_encode(array("status"=>TRUE));
	}
}
