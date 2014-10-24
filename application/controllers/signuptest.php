<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signuptest extends CI_Controller {
	
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
	        //redirect(base_url());	
			echo 'redirect';
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
					
					echo 'backend/dashboard';
					//$this->load->view('backend/dashboard',$data);
					}
					else{
						echo 'test';
						//$this->load->view('test');
					}
				}
				else{
					echo 'public/signup <br><br>';
					var_dump($user_profile2);
					//$this->load->view('public/signup',$data);	
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
						
						echo 'twitter backend/dashboard';
						//$this->load->view('backend/dashboard',$data);
						//redirect('dashboard');
					}
					else{
						echo 'twitter test';
						//$this->load->view('test');
					}
				}
				else{
					echo 'twitter public/signup';
					//$this->load->view('public/signup',$data);
					//$this->load->view('backend/dashboard',$data);
				}
			}
			else{
				//redirect ('login/failure');
				$data['user_profile2'] = 0;
				
				//echo 'public/signup with data';
				//var_dump($data);
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

}