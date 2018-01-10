<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model { 
	public function login($email, $password){ 
		$password = md5($password); 
		$this->db->where('email',$email);
        $this->db->where('password',$password);
        $query = $this->db->get('user');
        if($query->num_rows()==1){
            foreach ($query->result() as $row){
                $data = array(
                            'username'      =>$row->username,
                            'nama'          =>$row->nama,
                            'email'         =>$row->email,
                            'level'         =>$row->level,
                            'active'        =>$row->active,
                            'quis'          =>$row->quis,
                            'user_id'       =>$row->id,
                            'logged_in'     =>TRUE
                        );
            }
            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
      }    
    }
    public function logout()
    {
        
    }
     
    
}
