<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instagram extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->library('instagram_api');
		$this->load->library('session');
		$this->load->model('photofriends');
		$this->load->model('photousers');
        $this->load->model('photostream');
        $this->load->database();
	}
	
	public function index(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			
			//-------------------------------------------------------------------
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "PhotoStream - Import from Instagram";
			}
			else{
			$data['title'] = '('.$number->num_rows().') PhotoStream - Import from Instagram ';
			}
			
			
			
			//-------------------------------------------------------------------
			
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
				if(isset($_GET['code']) && $_GET['code'] != '') {
			
					$auth_response = $this->instagram_api->authorize($_GET['code']);
					$this->session->set_userdata('instagram-token', $auth_response->access_token);
					$this->session->set_userdata('instagram-username', $auth_response->user->username);
					$this->session->set_userdata('instagram-profile-picture', $auth_response->user->profile_picture);
					$this->session->set_userdata('instagram-user-id', $auth_response->user->id);
					$this->session->set_userdata('instagram-full-name', $auth_response->user->full_name);
					
					$this->instagram_api->access_token = $this->session->userdata('instagram-token');
					// Get the user data
					$data['user_data'] = $this->instagram_api->getUser($this->session->userdata('instagram-user-id'));
				
					// Get the user feed
					$data['user_feed'] = $this->instagram_api->getUserRecent($this->session->userdata('instagram-user-id'));
					
					//$this->load->view('backend/instagram_index',$data);
					
				}
				
				else if($this->session->userdata('instagram-token')){
					$this->instagram_api->access_token = $this->session->userdata('instagram-token');
					// Get the user data
					$data['user_data'] = $this->instagram_api->getUser($this->session->userdata('instagram-user-id'));
				
					// Get the user feed
					$data['user_feed'] = $this->instagram_api->getUserRecent($this->session->userdata('instagram-user-id'));
				}
				
				$this->load->view('backend/instagram_index',$data);
			
		}else {
			redirect(base_url());
		}
		
		
	}
	
	public function this_is_my_first(){
		if(isset($_GET['code']) && $_GET['code'] != '') {

			$auth_response = $this->instagram_api->authorize($_GET['code']);
			//var_dump($auth_response);
			// Set up session variables containing some useful Instagram data
			$this->session->set_userdata('instagram-token', $auth_response->access_token);
			$this->session->set_userdata('instagram-username', $auth_response->user->username);
			$this->session->set_userdata('instagram-profile-picture', $auth_response->user->profile_picture);
			$this->session->set_userdata('instagram-user-id', $auth_response->user->id);
			$this->session->set_userdata('instagram-full-name', $auth_response->user->full_name);
			$this->load->view('backend/my_instagram');
			//echo "Your access token : ".$this->session->userdata('instagram-token');
		}else{
		// Get popular media using the client id call
			$data['popular_media'] = $this->instagram_api->getPopularMedia();
			$data['main_view'] = 'welcome_message';
		
			$this->load->vars($data);
		
			$this->load->view('backend/my_instagram',$data);
		}
	}
	
}// end of class

?>