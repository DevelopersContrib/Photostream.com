<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('photousers');
		$this->load->model('photocountry');
		$this->load->model('usersocials');
		$this->load->library('twconnect');
		$this->load->model('photostream');
		$this->load->model('photoupdates');
		$this->load->model('photofriends');
		$this->load->model('photopics');
		$this->load->database();
		$this->load->library('form_validation');
		$fb_config = array(
		       'appId'  => '303778466421063',
		       'secret' => '514d4d2ee10b04af53736a3547950fde',
		   );
	       $this->load->library('facebook', $fb_config);
		
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
	        redirect(base_url());		
		}else {
			$data['title'] = "Photo Stream - Signup";
			
			
			if($query = $this->photocountry->getCountry())
			{
			    $data['country'] = $query;
			}
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			//-------------------------------------------------------------------------------
			
			$user = $this->facebook->getUser();

				if ($user) {
			    try {
				$data['user_profile'] = $this->facebook->api('/me');
				$user_profile2 = $this->facebook->api('/me');
				
				if($query = $this->photocountry->getCountry())
				{
				    $data['country'] = $query;
				}
				
				if($this->usersocials->facebook_exist($user_profile2)==1)
				{
					if($this->usersocials->loginfb($user_profile2)===true)
					{
					$data['title'] = "Dashboard - PhotoStream";
					$data['user_profile2'] = 2;
					 $x = base_url();
					$params = array('next' => $x.'/dashboard/logout_fb');
					$data['logout_url'] = $this->facebook->getLogoutUrl($params);
					$userid = $this->session->userdata('userid');
					$data['user'] = $userid;
					$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
					$data['updates'] = $this->photoupdates->getall();
					$data['latest_streams'] = $this->photostream->getlateststreams(20);
					$data['user_suggest'] = $this->photousers->getall();
					$this->load->view('backend/dashboard',$data);
					}
					else{
						$this->load->view('test');
					}
				}
				else{
					$this->load->view('public/signup',$data);	
				}
				//header( 'Location: /dashboard' );
				
				
				
				//$this->load->
			    } catch (FacebookApiException $e) {
				$user = null;
			    }
			    
			}
			
			else{
			$data['login_url'] = $this->facebook->getLoginUrl();
		//-----------------------------------------------------------------------
		
			$ok = $this->twconnect->twprocess_callback();
		
			if ( $ok ){
				$this->twconnect->twaccount_verify_credentials();
				$data['tweet_profile'] = $this->twconnect->tw_user_info;
				$tweet_profile = $this->twconnect->tw_user_info;
				$data['user_profile'] = 2;
				$data['user_profile2'] = 1;
				if($this->usersocials->tweeter_exist($tweet_profile)==1)
				{
					
					//echo "1";
					//echo $tweet_profile->id;
					//$this->load->view('backend/dashboard',$data);
					if($this->usersocials->logintwitter($tweet_profile)===true)
					{
						$data['title'] = "Dashboard - PhotoStream";
						$this->twconnect->twaccount_verify_credentials();
						$data['tweet_profile'] = $this->twconnect->tw_user_info;
						$tweet_profile = $this->twconnect->tw_user_info;
						$data['user_profile2'] = 1;
						$data['twitter'] = 0;
						$data['fb'] = 1;
						$data['latest_streams'] = $this->photostream->getlateststreams(20);
						$data['updates'] = $this->photoupdates->getall();
						$userid = $this->session->userdata('userid');
						$data['user'] = $userid;
						$data['user_suggest'] = $this->photousers->getall();
						$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
						$this->load->view('backend/dashboard',$data);
						//redirect('dashboard');
					}
					else{
						$this->load->view('test');
					}
				}
				else{
				$this->load->view('public/signup',$data);
				//$this->load->view('backend/dashboard',$data);
				}
				}
			else{
				//redirect ('login/failure');
				$data['user_profile2'] = 0;
				$this->load->view('public/signup',$data);
				//$this->load->view('backend/dashboard',$data);
			}
			
			
		//-----------------------------------------------------------------------
			//$this->load->view('public/signup',$data);
			}
			
			
			
			
			//-------------------------------------------------------------------------------
			//$this->load->view('public/signup',$data);
		}
	}
	
	public function signuppost()
	{
		
			
			$firstname = $this->db->escape_str($this->input->post('firstname'));
			$lastname = $this->db->escape_str($this->input->post('lastname'));
			$email = $this->db->escape_str($this->input->post('email'));
			$username = $this->db->escape_str($this->input->post('uname'));
			$password = md5($this->db->escape_str($this->input->post('password')));
			$country = $this->db->escape_str($this->input->post('country'));
			$code = $this->photousers->generateCode();
			$fb_code = $this->db->escape_str($this->input->post('fb_id'));
			$twitter_code = $this->db->escape_str($this->input->post('twitter_id'));
			
			
			
			if($this->photousers->email_exist($email)===1){
				echo "2";
			}
			
			elseif($this->photousers->username_exist($username)===1){
				echo "3";
			}
			else{
			
			
			$data = array(
			    'firstname' => $firstname,
			    'lastname' => $lastname,
			    'email' => $email,
			    'password' => $password,
			    'country_id' => $country,
			    'code' => $code,
			    'username' => $username
			);
			
			$id = $this->photousers->update(0,$data);
			
			$data2 = array(
				'fb_userid' => $fb_code,
				'userid' => $id,
				'photo_users_country_id' => $country,
				'twitter_userid' => $twitter_code
			);
			if($fb_code!=""){
			
			$id2 = $this->usersocials->update(0,$data2);
			}
			if($twitter_code!=""){
				$id3 = $this->usersocials->update(0,$data2);
			}
			
			if(!empty($id)){
			    $this->photousers->SendNotification($email,$code);
			    $data['message'] = "please check your email";
			    $data['title'] = "Success";
			     $this->session->sess_destroy();
			    echo "1";
			    
			   
			    
			}else{
			    $data['message'] = "something went wrong in saving data.";
			    
			}
			}
			
			
		    
		
	}
	
	
	
	public function verification(){
        
	$code= $this->uri->segment(3);
	$query = $this->photousers->getbyattribute('code',$code);
	$data['show_second_phase'] = 'no';
	if ($query->num_rows() > 0){
	foreach ($query->result() as $row)
	{
	   if ($row->is_verified==0){
	       $memdata = array(
	    'is_verified' => 1,
	    'code' => ''
		);
		$this->photousers->update($row->userid,$memdata);
		$data['message'] = "You successfuly verified your account";
		$data['show_login'] = true;
		$data['userid'] = $row->userid;
		$data['show_second_phase'] = 'yes';
	    }else {
	       $data['message'] = "This account was already verified";
	     $data['show_login'] = true;
	     } 
	}
	}else {
	 $data['message'] = "Account code does not exist";
	 $data['show_login'] = false;
	}
	
	$data['title'] = "Photostream - Email Verification";
	$this->load->view('public/verification', $data);
	
       }
	
	public function prompt(){
		$data['title'] = "Verification page";
		$data['message'] = 'please check your email';
		$this->load->view('public/success',$data);
	}
	
	public function redirect2() {
		$ok = $this->twconnect->twredirect('signup');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}
	
	
}