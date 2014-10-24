<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('photousers');
		$this->load->model('photocountry');
		$this->load->model('usersocials');
		$this->load->model('photofriends');
		$this->load->model('photoupdates');
		$this->load->model('photopics');
		$this->load->model('photostream');
		$this->load->database();
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
			$data['title'] = "Login :: PhotoStream";
//------------------------------------------------------------------------------------------------
			
			//$this->load->view('public/signin',$data);
		
			
			$data['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'user_photos','redirect_uri'=>'http://www.photostream.com/login/fb_login'));

			$this->load->view('public/signin',$data);
//------------------------------------------------------------------------------------------------
			
		}
	}
	
	public function fb_login(){
		
		$user = $this->facebook->getUser();
			$data['user_profile2'] = 0;

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
					$data['title'] = "Photo Stream - Signup";
					$this->load->view('public/signup',$data);	
				}
				//header( 'Location: /dashboard' );
				
				
				
				//$this->load->
			    } catch (FacebookApiException $e) {
				$user = null;
			    }
			    
			}
			
			else{
			
			$data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri'=>'http://www.photostream.com/stream/fb_login'));
			
			$this->load->view('public/signin',$data);
			}
			//echo "test";
	
	}
	
	public function process(){
		 $email = $this->db->escape_str($this->input->post('email'));
		 $password = $this->db->escape_str($this->input->post('password'));
		 if ($this->photousers->LoginUser($email,md5($password))===true){
		  echo "1";
		 }else{
		 	echo "0";
		 }
		 
	}
	
	public function sendLoginDetails(){


        $email = $this->db->escape_str($this->input->post('email'));

        if($this->photousers->checkexist('email',$email) === true){

            $password = $this->photousers->getinfo('password','email',$email);

            $firstname = $this->photousers->getinfo('firstname','email',$email);

            $this->photousers->sendLoginDetails($email,$password,$firstname);

            echo "success";

        }else{

            echo "not_in_db";

        }

    }

    public function reset_password(){

        $data['title'] = "PhotoStream - Reset password";

        $this->load->view('public/reset_password',$data);
	

    }


    public function saveNewPassword(){


        $email = $this->db->escape_str($this->input->post('email'));
        $password = $this->db->escape_str($this->input->post('password'));
        $secret_code = $this->db->escape_str($this->input->post('secretcode'));
        $exist = $this->photousers->checkexist('email',$email,'password',$secret_code);

        //echo "secret code: ".$secret_code."exist = ".$exist;

        if( $exist == "1" || $exist == true){

            $userid = $this->photousers->getinfo('userid','email',$email);

            $new_data = array('password' => md5($password));

            $this->photousers->update($userid,$new_data);

            echo "OK";

        }else{

            echo "wrong";

        }


    }


}// end of class LOGIN