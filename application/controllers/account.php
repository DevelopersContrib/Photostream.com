<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->library('session');
        $this->load->model('photousers');
		$this->load->model('photofriends');
        $this->load->model('photostream');
        $this->load->model('photopics');
        $this->load->database();
		$fb_config = array(
		       'appId'  => '303778466421063',
		       'secret' => '514d4d2ee10b04af53736a3547950fde',
		);
	    $this->load->library('facebook', $fb_config);
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			
				$userid = $this->session->userdata('userid');
				$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
				$number = $this->photofriends->getWaitingInvites($userid);
				if($number->num_rows()==0){
					$data['title'] = "PhotoStream - Edit Account Settings - ".$data['name'];
				}
				else{
					$data['title'] = '('.$number->num_rows().') PhotoStream - Edit Account Settings - '.$data['name'];
				}
				//$data['title'] = "PhotoStream - Edit Account Settings - ".$data['name'];
				$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
				$data['user_profile'] = 0;
				$data['user_profile2'] = 0;
					
					$get_info = $this->photousers->getbyattribute('userid',$userid);
					foreach($get_info->result() AS $info){
						$data['username'] = $info->username;
						$data['firstname'] = $info->firstname;
						$data['lastname'] = $info->lastname;
						$data['email'] = $info->email;
						$data['password'] = $info->email;
						$data['profile_streams'] = $this->photostream->getbyattribute('userid',$userid);
						
						if($info->avatar_id != NULL || $info->avatar_id == "0"){
							$data['avatar_url'] = $this->photopics->getinfobyid('filename',$info->avatar_id);
						}else{
							$data['avatar_url'] = 'http://d2qcctj8epnr7y.cloudfront.net/images/2013/avatar-photostream-logo.png';
						}
					}
				
				$this->load->view('backend/settings',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function saveChanges(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$firstname = $this->db->escape_str($this->input->post('firstname'));
			$lastname = $this->db->escape_str($this->input->post('lastname'));
			$avatar_id = $this->db->escape_str($this->input->post('selected_photo_url'));
			
			$update_data = array('firstname' => $firstname,
					     'lastname' => $lastname);
			
			$return_id = $this->photousers->update($userid,$update_data);
			if($return_id == $userid){
				echo "OK";
			}else{
				echo "System error. ";
			}
		}else{
			redirect(base_url());
		}
	}
	
	public function saveChangePassword(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$old_password = $this->db->escape_str($this->input->post('old_password'));
			$new_password = $this->db->escape_str($this->input->post('new_password'));
			
				if($this->photousers->checkexist('userid',$userid,'password',md5($old_password)) == true){
					$update_data = array('password' => md5($new_password));
					$return_id = $this->photousers->update($userid,$update_data);
					if($return_id == $userid){
						echo "OK";
					}
				}else{
					echo "The old password provided did not match the system record.";
				}
			
		}else{
			redirect(base_url());
		}
	}
	
	public function getFilename(){
		$photo_id = $this->db->escape_str($this->input->post('photo_id'));
		$url = $this->photopics->getinfobyid('filename',$photo_id);
		echo $url;
		
	}
	
	public function checkPassword(){
		$userid = $this->session->userdata('userid');
		$password = $this->input->post('password');			 
		$db_password = $this->photousers->getinfobyid('password',$userid);
		
		if($db_password == md5($password)){
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('success'=>true)));
		}else{
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('success'=>false)));
		}
	}
	
	public function deleteAccount(){
		$userid = $this->session->userdata('userid');
						
		//$message = $this->db->escape_str($this->input->post('delete_reason'));
			 
		// $this->emailAdminUserDeleteAccount($message,$userid);
			
		$this->photousers->deleteAccount($userid);
			 
		$this->logout();
	}
	
	public function logout(){
		$array_items = array('username' => '', 'email' => '', 'userid' => '', 'logged_in' => FALSE);
	    $this->session->unset_userdata($array_items);
	    setcookie('fbs_'.$this->facebook->getAppId(), '', time()-100, '/', 'asia.com');
	    $this->session->sess_destroy();
		session_destroy();
		
	    header ("Location: ".base_url());
         exit; 
	}
	
} //end of class
?>