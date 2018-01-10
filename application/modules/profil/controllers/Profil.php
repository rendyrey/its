<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MX_Controller {
	public $data;
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Profil_m');
		
		
	}
	public function index()
	{
		$id=$this->session->userdata('user_id');
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect('/','refresh');
		}else
		{
			$this->data['getid']=$this->Profil_m->getid($id);
			
			$this->data['halaman']='vedit';
			$this->load->view('_murid',$this->data);
		}
	}
	public function saveedit()
	{
			$id=$this->input->post('id');
			$username= $this->input->post('username');
			$password= md5($this->input->post('password'));
			$email=$this->input->post('email');
			$nama	= $this->input->post('nama');
			

			$this->form_validation->set_rules('username','username','required');
			$this->form_validation->set_rules('email','email','required');
			$this->form_validation->set_rules('nama','nama','required');
			//$this->form_validation->set_rules('password','password','password');
			
			if($this->form_validation->run()==FALSE)
			{
				redirect('profil','refresh');
			}else
			{
	            $config = array(
                'file_name' => "file_".time(),
                'upload_path' => "./assets/upload/user/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => true,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "5000000",
                'max_width' => "5000000"
            );
	            $this->load->library('Upload', $config);
            	$this->upload->initialize($config);

            	if ($this->upload->do_upload('gambar')) {
            	$user_data = $this->db->get_where('user', array('id' => $id))->row();
            	$path = './assets/upload/user/'.$user_data->image;
      			
                $path = $this->upload->data();
                $image = $path['file_name'];
                $data = array();
                $data = array(
                    'id' => $id,
                    'image' => $image,
                    'nama' => $nama,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'active'	=> 1,
						'terdaftar_dari'=>date('Y-m-d H:i:s'),
						'level'		=>'murid'
                    
                    
                );
            	}else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                   'id' => $id,
                    'nama' => $nama,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'active'	=> 1,
					'terdaftar_dari'=>date('Y-m-d H:i:s'),
					'level'		=>'murid'
                    
                );
          	  }

          	   $this->Profil_m->updateprofil($id, $data);
          	 
               $this->session->set_flashdata('pesan', 'data  Berhasil Di Update');
              redirect('dashboard');
			}
	}
	

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */