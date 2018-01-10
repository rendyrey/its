<?php if(!defined('BASEPATH')) exit('No direct access allowed');
/**
* 
*/
class Kursus extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('categori/Categori_m');
		$this->load->model('Kursus_m');
		//$this->load->model('Categori/Categori_m');
	}
	public function index($message='',$cat_id='')
	{
		$data=array();
		$userid=$this->session->userdata('user_id');
		//$this->data['categoris']=$this->Kursus_m->getsubcategori();
		if ($this->session->userdata('level')=='superadmin') 
		{
		$this->data['kursus']=$this->Kursus_m->getall();
		$this->data['message']=$message;
		$this->data['cat_id']=$cat_id;
		$this->data['categories']=$this->Categori_m->get_categories();
		$this->data['halaman']="kursus/vkursus";
		$this->load->view('_main',$this->data);
		}
		else
		{
			echo "anda tidak berhak";
		}
	}
	public function addmateri ()
	{
		if ($this->session->userdata('level')=='superadmin') 
		{
			$this->data['categories']=$this->Categori_m->get_categories();
			$this->data['halaman']='addmateri';
			$this->load->view('_main',$this->data);
		}else
		{
			redirect('login','refresh');
		}
	}
	public function save()
	{
		$this->form_validation->set_rules('category','Sub Category','required');
		$this->form_validation->set_rules('kursus_title','Sub Category','required');
		$this->form_validation->set_rules('kursus_intro','Sub Category','required');
		$this->form_validation->set_rules('kursus_description','Sub Category','required');
		$this->form_validation->set_rules('kursus_requirement','Sub Category','required');
		$this->form_validation->set_rules('target_audience','Sub Category','required');
		$this->form_validation->set_rules('what_i_get','Sub Category','required');
		//$this->form_validation->set_rules('price','Sub Category','required');
		if ($this->form_validation->run()==FALSE) 
		{
			echo "gagal";
		}else
		{
			$form_info=array();
			if (!empty($_FILES['feature_image']['name']) )
			{
				$config['upload_path']='./assets/upload/kursus/';
				$config['allowed_types']='gif|jpg|jpeg|png';
				$config['file_name']=uniqid();
				$config['overwrite']=TRUE;
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
					$title_id=$this->Kursus_m->add_kursus_title($upload_data['file_name']);
				}
			}else
			{
				$title_id=$this->Kursus_m->add_kursus_title();
			}
			if ($title_id) 
			{
				$kursus_title=$this->input->post('kursus_title');
				//$this->creat_kursus_sections($title_id,$kursus_title);
				redirect('kursus','refresh');
				
			}
			else
			{
				echo "error";
			}
		}
	}
	public function update_kursus($id,$pesan='')
	{
		if(!is_numeric($id)){show_404();}
		$this->form_validation->set_rules('category','Sub Category','required');
		$this->form_validation->set_rules('kursus_title','Sub Category','required');
		$this->form_validation->set_rules('kursus_intro','Sub Category','required');
		$this->form_validation->set_rules('kursus_description','Sub Category','required');
		$this->form_validation->set_rules('kursus_requirement','Sub Category','required');
		$this->form_validation->set_rules('target_audience','Sub Category','required');
		$this->form_validation->set_rules('what_i_get','Sub Category','required');
		//$this->form_validation->set_rules('price','Sub Category','required');
		if ($this->form_validation->run()==FALSE) 
		{
			$this->Kursus_m->update_kursus_title($id);
		}else
		{
			$form_info=array();
			if (!empty($_FILES['feature_image']['name']) )
			{
				$config['upload_path']='./assets/upload/kursus/';
				$config['allowed_types']='gif|jpg|jpeg|png';
				$config['file_name']=uniqid();
				$config['overwrite']=TRUE;
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
					$title_id=$this->Kursus_m->update_kursus_title($id,$upload_data['file_name']);
				}
			}else
			{
				$title_id=$this->Kursus_m->update_kursus_title($id);
			}
			if($title_id){
				redirect('kursus','refresh');
			}else{
				echo "error";
			}
		}

	}
	public function getsubcategoriajax($id)
	{
		 $sub_cat = $this->Kursus_m->get_subcategori_by_cat_id($id);
        $str = '';
        foreach ($sub_cat as $value) {
            $str.='<option value="'.$value->id.'">'.$value->namasubcategori.'</option>';
        }

        echo $str;
	}
	public function creat_kursus_sections($title_id=0,$kursus_title='Create Sections')
	{
		$data=array();
		$this->data['kursus_title']=$kursus_title;
		$this->data['title_id']=$title_id;
		$this->data['halaman']="Kursus/vsections";
		$this->load->view('_main',$this->data);
	}
	public function kursusdelete($id)
	{
		if (!is_numeric($id)) {
			show_404();
		}
		$have_sections=$this->db->get_where('kursus_sections',array('kursus_id'=>$id))->result();
		if (!empty($have_sections)) 
		{
			$message='<div class="alert aler-danger">please delete sections</div>';
			$this->session->set_flashdata('message',$message);
			redirect('Kursus','refresh');
		}
		else{
			$kursus_id=$this->db->get_where('kursus',array('kursus_id'=>$id))->row()->kursus_id;
			$this->db->where('kursus_id',$id);
			$this->db->delete('kursus');
			if ($this->db->affected_rows()==1) 
			{
				$message ="sukses";
			}else{
				$message="error";
			}
			$this->session->set_flashdata('message',$message);
			redirect('Kursus/'.$kursus_id,'refresh');
		}
	}
	public function kursusdetail($id='', $pesan='')
	{
		if (empty($id)){show_404();}
		if (!is_numeric($id)){show_404();}
		$data=array();
		$this->data['pesan']=$pesan;
		$this->data['kursus']=$this->Kursus_m->get_kursus_detail($id);
		$this->data['sections']=$this->Kursus_m->get_sections($id);
		$this->data['halaman']="kursus/vkursusdetail";
		$this->load->view('_main',$this->data);
	}
	public function edit_kursus_detail($id,$pesan='')
	{
		if(!is_numeric($id)){show_404();}
		$this->data['pesan']=$pesan;
		$this->data['kursus']=$this->Kursus_m->get_kursus_detail($id);
		$this->data['halaman']="kursus/editkursus";
		$this->load->view('_main',$this->data);
	}
	public function addsections($kursus_id='',$message='')
	{
		{
			$data=array();
			$this->data['message']=$message;
			$this->data['kursus_id']=$kursus_id;
			$this->data['kursus_title']=$this->db->get_where('kursus',array("kursus_id"=>$kursus_id))->row()->kursus_title;
			$this->data['halaman']='kursus/addsection';
			$this->load->view('_main',$this->data);
		}
	}
	public function save_sections()
	{
		$this->form_validation->set_rules('section[0]','Section Title 1','required');
		$this->form_validation->set_rules('kursus_id','Kursus ID','required|integer');
		if ($this->form_validation->run()==FALSE) 
		{
			//$this->creat_kursus_sections($this->input->post('kursus_id'));
			echo validation_errors();
		}else
		{
			if ($this->Kursus_m->save_sections_m()) 
			{
				//$message="sukses";
				//$this->session->set_flashdata('message',$message);
				$this->data['sections']=$this->Kursus_m->get_sections($this->input->post('kursus_id'));
				redirect(site_url('kursus/kursusdetail/'.$this->input->post('kursus_id')),$this->data);
				
			}else
			{
				//$this->addsections($this->input->post('kursus_id'),$this->input->post('kursus_title'));
				echo validation_errors();
				echo "gagal";
			}
		}
	}
	public function addvideo($kursus_id='',$pesan='')
	{
		$this->data['sections']=$this->Kursus_m->get_sections($kursus_id);
		$this->data['kursus_id']=$kursus_id;
		$this->data['pesan']=$pesan;
		$this->data['kursus_title']=$this->db->get_where('kursus',array('kursus_id' =>$kursus_id))->row()->kursus_title;
		$this->data['halaman']='kursus/vaddvideo';
		$this->load->view('_main',$this->data);
	}
	public function upload_kursus_videos($pesan='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('section','pilih section','required|integer');
		$this->form_validation->set_rules('video_title','Judul Video','required');
		if($this->form_validation->run()==FALSE)
		{
			echo "a";
		}else
		{
			$form_info=array();
			if(!empty($_FILES['media']['name']))
			{
				$path_parts=pathinfo($_FILES["media"]["name"]);
				$extensi=$path_parts['extension'];
				$directory=$this->input->post('kursus_id');
				if(!is_dir('assets/upload/kursus/video/'.$directory))
				{
					mkdir('./assets/upload/kursus/video/'.$directory,0777,TRUE);
				}
				$config['upload_path']='./assets/upload/kursus/video/'.$directory.'/';
				$config['allowed_types']='mp4|flv|avi|mpeg|ogg|webm|3gp';
				$config['file_name']=$this->input->post('section').'_'.$this->input->post('video_title').'.'.$extensi;
				$config['overwrite']=TRUE;
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('media'))
				{
					$error=$this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect(site_url('kursus/addvideo/'.$this->input->post('kursus_id')));
				}else
				{
					$upload_data=$this->upload->data();
					$video_id=$this->Kursus_m->add_video_m($upload_data['file_name']);
				}
			}
			if($video_id)
			{
				echo "vvv";
			}else
			{
				echo "as";
			}
		}

	}
	public function adddocument($kursus_id='',$pesan='')
	{
		$this->data['sections']=$this->Kursus_m->get_sections($kursus_id);
		$this->data['kursus_id']=$kursus_id;
		$this->data['pesan']=$pesan;
		$this->data['kursus_title']=$this->db->get_where('kursus',array('kursus_id' =>$kursus_id))->row()->kursus_title;
		$this->data['halaman']='kursus/vaddocument';
		$this->load->view('_main',$this->data);
	}
	public function upload_kursus_document($pesan='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('section','pilih section','required|integer');
		$this->form_validation->set_rules('document_title','Judul Video','required');
		if($this->form_validation->run()==FALSE)
		{
			echo "a";
		}else
		{
			$form_info=array();
			if(!empty($_FILES['media']['name']))
			{
				$path_parts=pathinfo($_FILES["media"]["name"]);
				$extensi=$path_parts['extension'];
				$directory=$this->input->post('kursus_id');
				if(!is_dir('assets/upload/kursus/document/'.$directory))
				{
					mkdir('./assets/upload/kursus/document/'.$directory,0777,TRUE);
				}
				$config['upload_path']='./assets/upload/kursus/document/'.$directory.'/';
				$config['allowed_types']='doc|docx|ppt|xls';
				$config['file_name']=$this->input->post('section').'_'.$this->input->post('document_title').'.'.$extensi;
				$config['overwrite']=TRUE;
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('media'))
				{
					$error=$this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect(site_url('kursus/adddocument/'.$this->input->post('kursus_id')));
				}else
				{
					$upload_data=$this->upload->data();
					$document_id=$this->Kursus_m->add_document_m($upload_data['file_name']);
				}
			}
			if($document_id)
			{
				$sukses='materi berhasil di upload';
					$this->session->set_flashdata('pesan', $sukses);
					redirect(site_url('kursus'));
			}else
			{
				echo "as";
			}
		}
	}
	public function hapus_kursus($id)
	{
		if(!is_numeric($id)){show_404();}
		$isimateri=$this->db->get_where('kursus_sections', array('kursus_id'=>$id))->result();
		if(!empty($isimateri))
		{
			$pesan='modul ini mempunyai materi yang telah diupload, silahkan hapus dulu materi ';
			$this->session->set_flashdata('pesan', $pesan);
			redirect(site_url('kursus/kursusdetail/'.$isimateri[0]->kursus_id));
		}else
		{
			$kursus_id=$this->db->get_where('kursus',array('kursus_id'=>$id))->row()->kursus_id;
			$this->db->where('kursus_id',$id);
			$this->db->delete('kursus');
			if($this->db->affected_rows()==1)
			{
				$pesan='sukses';
			}else
			{
				$pesan='ada kesalahan';
			}
			$this->session->set_flashdata('pesan', $pesan);
			redirect(site_url('kursus/'));
		}
	}
	public function hapusisi_modul($id)
	{
		if(!is_numeric($id)){show_404();}
		//$adavideo=$this->db->get_where('kursus_videos',array('section_id'=>$id))->result();
		$adadoc=$this->db->get_where('kursus_document',array('section_id'=>$id))->result();
		if (!empty($adadoc)) 
		{
			$pesan='isi modul ini mempunyai Document, silahkan hapus document nya dulu';
			$this->session->set_flashdata('pesan',$pesan);
			redirect(site_url('kursus/kursusdetail/'.$adadoc[0]->kursus_id));
		}else
		{
			$kursus_id=$this->db->get_where('kursus_sections',array('section_id'=>$id))->row()->kursus_id;
			$this->db->where('section_id',$id);
			$this->db->delete('kursus_sections');
			if($this->db->affected_rows()==1)
			{
				$pesan='sukses';
			}else
			{
				$pesan='ada kesalahan';
			}
			$this->session->flashdata('pesan',$pesan);
			redirect(site_url('kursus/kursusdetail/'.$kursus_id));
		}
	}
	public function section_detail($id,$pesan='')
	{
		if(!is_numeric($id)){show_404();}
		$data=array();
		$this->data['pesan']=$pesan;
		$this->data['materi']=$this->Kursus_m->get_materi_detail_m($id);
		
		$this->data['doc']=$this->Kursus_m->get_materi_doc_m($id,$this->data['materi']->kursus_id);
		$this->data['halaman']='kursus/vmateridetail';
		$this->load->view('_main',$this->data);
	}
	public function delete_document($id)
	{
		if(!is_numeric($id)){show_404();}
		$user_id=$this->session->userdata('user_id');
		$level=$this->session->userdata('level');
		$document=$this->db->where('document_id',$id)->get('kursus_document')->row();
		if($level !='superadmin')
		{
			$author=$this->db->where('kursus_id',$document->kursus_id)->get('kursus')->row()->created_by;
			if($author != $user_id)
			{
				exit('kamu tidak memiliki akses kesini');
			}
		}
		$this->db->where('document_id',$id)->delete('kursus_document');
		if(unlink('kursus_document/'.$document->kursus_id.'/'.$document->document_link))
		{
			$pesan='Document berhasil dihapus';
		}else
		{
			$pesan='terdapat kesalahan';
		}
		$this->session->flashdata('pesan',$pesan);
		redirect(site_url('kursus/section_detail/'.$document->section_id));
	}
	public function adddocumentmateri($section_id='',$pesan='')
	{
		$data=array();
		$this->data['pesan']=$pesan;
		$this->data['section_id']=$section_id;
		$this->data['kursus']=$this->Kursus_m->get_kursus($section_id);
		$this->data['kursus_id']=$this->db->get_where('kursus_sections',array('section_id'=>$section_id))->row()->kursus_id;
		$kursus_id=$this->data['kursus_id'];
		$this->data['kursus_title']=$this->db->get_where('kursus',array('kursus_id'=>$kursus_id))->row()->kursus_title;
		$this->data['section_name']=$this->db->get_where('kursus_sections',array('section_id'=>$section_id))->row()->section_name;
		$this->data['halaman']='kursus/vadddocumentmateri';
		$this->load->view('_main',$this->data);
		
	}
	public function upload_kursus_document_materi($pesan='')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('section','pilih section','required|integer');
		$this->form_validation->set_rules('document_title','Judul Document','required');
		if($this->form_validation->run()==FALSE)
		{
			echo "a";
		}else
		{
			$form_info=array();
			if(!empty($_FILES['media']['name']))
			{
				$path_parts=pathinfo($_FILES["media"]["name"]);
				$extensi=$path_parts['extension'];
				$directory=$this->input->post('kursus_id');
				if(!is_dir('assets/upload/kursus/document/'.$directory))
				{
					mkdir('./assets/upload/kursus/document/'.$directory,0777,TRUE);
				}
				$config['upload_path']='./assets/upload/kursus/document/'.$directory.'/';
				$config['allowed_types']='doc|docx|ppt|xls';
				$config['file_name']=$this->input->post('section').'_'.$this->input->post('document_title').'.'.$extensi;
				$config['overwrite']=TRUE;
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload('media'))
				{
					$error=$this->upload->display_errors();
					$this->session->set_flashdata('pesan', $error);
					redirect(site_url('kursus/adddocument/'.$this->input->post('kursus_id')));
				}else
				{
					$upload_data=$this->upload->data();
					$document_id=$this->Kursus_m->add_document_m($upload_data['file_name']);
				}
			}
			if($document_id)
			{
				$sukses='materi berhasil di upload';
					$this->session->set_flashdata('pesan', $sukses);
					redirect(site_url('kursus/section_detail/'.$this->input->post('section')));
			}else
			{
				echo "as";
			}
		}
	}
	public function simpanmateri()
	{
		$this->form_validation->set_rules('kursus_title', 'Username', 'required');
		$this->form_validation->set_rules('category', 'Nama', 'required');
		$this->form_validation->set_rules('kursus_intro', 'Email', 'required');
		if($this->form_validation->run()==FALSE){
			echo "gagagl";
		}else{
				$this->load->library('upload');
       			$nmfile = "file_".time();
        		$path   = './assets/upload/materi/';
        		$config['upload_path'] = $path;
        		$config['allowed_types'] = 'docx|doc|pdf|txt|xls';
        		$config['overwrite']=TRUE;
     			$config['max_size'] = '300000000000000';
        		
        		$config['file_name'] = uniqid();
				$this->upload->initialize($config);
				if(!empty($_FILES['document']['name']))
				{
					if($this->upload->do_upload('document'))
					{
						$foto=$this->upload->data();

						$data=array(
						'document'	=>$foto['file_name'],
						'kursus_title'	=> $this->input->post('kursus_title'),
						'kursus_intro'	=> $this->input->post('kursus_intro'),
						'categori_id'	=>$this->input->post('category'),
					);
					$save=$this->Kursus_m->insert($data);
					redirect('kursus','refresh');
					}
				}else {
					
				}
				
		}
	}
	public function hapus_materi($id)
	{
		$data = array();
        //$id = $this->input->get('id');
        $user_data = $this->db->get_where('kursus', array('kursus_id' => $id))->row();
        $path = './assets/upload/materi/'.$user_data->document;

        if (!empty($path)) {
            unlink($path);
        }
        $this->Kursus_m->deletemateri($id);
        $this->session->set_flashdata('pesan', 'Berhasil Dihapus');
        redirect('kursus','refresh');
	}
	public function update_materi()
	{
			$kursus_id=$this->input->post('kursus_id');
			$category= $this->input->post('category');
			$kursus_title= $this->input->post('kursus_title');
			$kursus_intro=$this->input->post('kursus_intro');
			

			$this->form_validation->set_rules('category','Category','required');
			$this->form_validation->set_rules('kursus_title','Kursus Titla','required');
			$this->form_validation->set_rules('kursus_intro','Kursus Intro','required');
			
			if($this->form_validation->run()==FALSE)
			{
				redirect('kursus/edit_kursus_detail/$id','refresh');
			}else
			{
	            $config = array(
                'file_name' => "file_".time(),
                'upload_path' => "./assets/upload/materi/",
                'allowed_types' => 'docx|doc|pdf|txt|xls',
                'overwrite' => true,
                'max_size' => "204800000000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
                
            );
	            $this->load->library('Upload', $config);
            	$this->upload->initialize($config);

            	if ($this->upload->do_upload('document')) {
            	$user_data = $this->db->get_where('kursus', array('kursus_id' => $kursus_id))->row();
            	$path = './assets/upload/materi/'.$user_data->document;
      			  if (!empty($path)) {
            	unlink($path);
      			}
                $path = $this->upload->data();
                $image = $path['file_name'];
                $data = array();
                $data = array(
                    'kursus_id' => $kursus_id,
                    'document' => $image,
                    'kursus_title' => $kursus_title,
                    'kursus_intro' => $kursus_intro,
                    'categori_id' => $category
                    
                );
            	}else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'kursus_id' => $kursus_id,
                    'kursus_title' => $kursus_title,
                    'kursus_intro' => $kursus_intro,
                    'categori_id' => $category
                );
          	  }
          	   $this->Kursus_m->actionupdate($kursus_id, $data);
                $this->session->set_flashdata('pesan', 'data  Berhasil Di Update');
                redirect('kursus');
			}
	}

}