<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('photousers');
		$this->load->model('photostream');
		$this->load->model('photofriends');
		$this->load->model('photochallenge');
		$this->load->model('photopics');
		$this->load->model('photousers');
		$this->load->model('photoupdates');
		$this->load->model('picture');
		$this->load->model('photofriends');
		$this->load->model('onboardviewdata');
		$this->load->library('datatables');
		$this->load->database();
		$this->load->library('twconnect');
		$fb_config = array(
		       'appId'  => '303778466421063',
		       'secret' => '514d4d2ee10b04af53736a3547950fde',
		   );
	       $this->load->library('facebook', $fb_config);
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['user'] = $userid;
			$number = $this->photofriends->getWaitingInvites($userid);
			$data['admin'] = $this->photousers->isAdmin($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
			}
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
			$data['updates'] = $this->photoupdates->getall();
			//$data['suggestion'] = $this->photofriends->getall();
			$data['user_suggest'] = $this->photousers->getall();
			//$data['name'] = 0;
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['latest_streams'] = $this->photostream->getlateststreams(20);
			
			$data['onboardview'] = true;
			if($this->onboardviewdata->checkexist('userid',$userid) === true){	
				$data['onboardview'] = false;
			}else{
				$this->setonboardingviewed();
			}
			
			$this->load->view('backend/dashboard',$data);
		}else {
			redirect(base_url());
			
		}
	}
	
	public function setonboardingviewed(){	
		$userid = $this->session->userdata('userid');
		$welcomeData = array('userid' => $userid,'viewed' => '1');
							 
		if($this->onboardviewdata->checkexist('userid',$userid) === false){		
			$this->onboardviewdata->update(0,$welcomeData);
		}
	}
	
	public function ticker(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['user'] = $userid;
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
			}
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
			$data['updates'] = $this->photoupdates->getall();
			$updates = $this->photoupdates->getall();
			//$data['suggestion'] = $this->photofriends->getall();
			$data['user_suggest'] = $this->photousers->getall();
			//$data['name'] = 0;
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['latest_streams'] = $this->photostream->getlateststreams(20);
			
			
			$update_data = array();
			$cnt = 0;

			foreach($updates->result() as $row_up): 

				$update_data[$cnt]['fname'] = $this->photousers->getinfobyid('firstname',$row_up->userid);
				$update_data[$cnt]['lname'] = $this->photousers->getinfobyid('lastname',$row_up->userid);
				$update_data[$cnt]['avatar'] = $this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$row_up->userid));
				$update_data[$cnt]['username'] = $this->photousers->getinfobyid('username',$row_up->userid);
				$update_data[$cnt]['message'] = $row_up->message;
				$update_data[$cnt]['title'] = $this->photostream->getinfobyid('title',$row_up->stream_id);
				$update_data[$cnt]['id'] = $row_up->update_id;
				$update_data[$cnt]['pcount'] = $row_up->photo_count;
				$update_data[$cnt]['stream_id'] = $row_up->stream_id;
				
				$cnt++;
					
			endforeach;
				
				$update_data['count'] = $cnt;
				$update_data['num_rows'] = $updates->num_rows();
				
				echo json_encode($update_data);
			
			
			
			
			
			//$this->load->view('backend/dashboad_ticker_reload',$data);
		}else {
			redirect(base_url());
			
		}
		
	
	
	}
	
	
	public function test2(){
	
			$data['updates'] = $this->photoupdates->getall();
			$this->load->view('backend/test3',$data);
	
	
	}
	
	public function ajax(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['user'] = $userid;
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
			}
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
			$data['updates'] = $this->photoupdates->getall();
			//$data['suggestion'] = $this->photofriends->getall();
			$data['user_suggest'] = $this->photousers->getall();
			//$data['name'] = 0;
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['latest_streams'] = $this->photostream->getlateststreams(20);
			$this->load->view('backend/long_poller',$data);
		}else {
			redirect(base_url());
			
		}
		
		//$this->load->view('backend/ajax');
		
	
	}
	
	public function dashboardtest(){
			if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
			}
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
			$data['updates'] = $this->photoupdates->getall();
			
			//$data['name'] = 0;
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['latest_streams'] = $this->photostream->getlateststreams(20);
			$this->load->view('backend/dashboardtest',$data);
		}else {
			redirect(base_url());
			
		}
		
	
	
	
	
	}
	
	public function tagtest(){
				if ($this->session->userdata('logged_in')){
						$userid = $this->session->userdata('userid');
						$number = $this->photofriends->getWaitingInvites($userid);
						if($number->num_rows() == 0)
						{
							$data['title'] = "Dashboard - PhotoStream";
						}
						else{
						$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
						}
						$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
						$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
						$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
						$data['tags'] = $this->picture->getall();
						$data['user_profile'] = 0;
						$data['user_profile2'] = 0;
						$userid = $this->session->userdata('userid');
						$data['current_user_friends'] = $this->photofriends->getUserFriends($userid);
						$this->load->view('backend/tagtest',$data);
					}else {
						redirect(base_url());
						
					}
					
					/*if ($this->session->userdata('logged_in')){
					$userid = $this->session->userdata('userid');
					$number = $this->photofriends->getWaitingInvites($userid);
					if($number->num_rows() == 0)
					{
						$data['title'] = "Dashboard - PhotoStream";
					}
					else{
					$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
					}
					$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
					$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
					$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
					$data['updates'] = $this->photoupdates->getall();
					
					//$data['name'] = 0;
					$data['user_profile'] = 0;
					$data['user_profile2'] = 0;
					$this->load->view('backend/tagtest',$data);
				}else {
					redirect(base_url());
					
				}*/
					
					
	}
	
	
	
	public function tagsave(){
			
			$name = $this->db->escape_str($this->input->post('tagname'));
			$mousex = $this->db->escape_str($this->input->post('mousex'));
			$mousey = $this->db->escape_str($this->input->post('mousey'));
			
			echo $mousex;
			echo $mousey;
			//$data = array('name' => $name);
			
			//$this->picture->update(0,$data);
		
	}
	
	public function tagdelete(){
			
			$id = $this->db->escape_str($this->input->post('id'));
			
			echo $id;
	
	
	}
	
	public function showLatestStreams(){
		$data['latest_streams'] = $this->photostream->getlateststreams(20);
		$this->load->view('backend/loadlateststreams',$data);
	}
	
	public function showLatestStreamsTest(){
		$data['latest_streams'] = $this->photostream->getlateststreams(20);
		$this->load->view('backend/loadlateststreamstest',$data);
	}
	
	public function showLatestChallenge(){
		$data['latest_challenge'] = $this->photostream->getlateststreams(5);
		$this->load->view('backend/loadlatestchallenges',$data);
	}
	
	public function twitter_dash(){
		$ok = $this->twconnect->twprocess_callback();
		if ( $ok ) { $this->twconnect->twaccount_verify_credentials();
				$data['tweet_profile'] = $this->twconnect->tw_user_info;
				$tweet_profile = $this->twconnect->tw_user_info;
				$data['user_profile'] = 1;
				$data['user_profile2'] = 1;
				$this->load->view('backend/dashboard',$data); }
			else redirect ('twtest/failure');
	}
	
	
	
	/*public function fb_redirect(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['title'] = "Dashboard - PhotoStream";
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$this->load->view('backend/dashboard',$data);
		}else {
			$this->load->view('backend/dashboard',$data);
			
		}
	}*/
	
	
	
    public function logout(){
		$array_items = array('username' => '', 'email' => '', 'userid' => '', 'logged_in' => FALSE);
	    $this->session->unset_userdata($array_items);
	    setcookie('fbs_'.$this->facebook->getAppId(), '', time()-100, '/', 'asia.com');
	    $this->session->sess_destroy();
		session_destroy();
		
	    header ("Location: ".base_url());
         exit; 
	}
	

	public function logout_fb(){
			setcookie('fbs_'.$this->facebook->getAppId(), '', time()-100, '/', 'asia.com');
			session_destroy();
			   
			 $fb_config = array(
			    'appId'  => $this->config->item('appID'),
			    'secret' => $this->config->item('appSecret')
			);
		
			$this->load->library('facebook', $fb_config);
		
			$user = $this->facebook->getUser();
			$user = NULL;
		
			if ($user) {
			    try {
				$data['user_profile'] = $this->facebook->api('/me');
			    } catch (FacebookApiException $e) {
				$user = null;
			    }
			}
		
			if ($user) {
			    $data['logout_url'] = $this->facebook->getLogoutUrl();
			} else {
			    $data['login_url'] = $this->facebook->getLoginUrl();
			}
			$array_items = array('username' => '', 'email' => '', 'userid' => '', 'logged_in' => FALSE);
			$this->session->unset_userdata($array_items);
			header ("Location: ".base_url());
		     exit; 
		 
	}
	
	public function tweeter_logout() {
		
		$array_items = array('username' => '', 'email' => '', 'userid' => '', 'logged_in' => FALSE);
		$this->session->unset_userdata($array_items);

		$this->session->sess_destroy();

		redirect(base_url());
	}
	
	public function tweeter_logout_dum() {

		$this->session->sess_destroy();

		redirect('dashboard/redirect');
		
	}
	
	public function redirect() {
		$ok = $this->twconnect->twredirect('dashboard/twitter_dash');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}
	
	public function photobooth(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['user'] = $userid;
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
			}
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
			$data['updates'] = $this->photoupdates->getall();
			//$data['suggestion'] = $this->photofriends->getall();
			$data['user_suggest'] = $this->photousers->getall();
			//$data['name'] = 0;
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['latest_streams'] = $this->photostream->getlateststreams(20);
			$this->load->view('backend/photobooth',$data);
		}else {
			redirect(base_url());
			
		}
	
	
	}
	
	public function users(){
		if ($this->session->userdata('logged_in')){
				
				$userid = $this->session->userdata('userid');
				$isAdmin = $this->photousers->isAdmin($userid);
				if($isAdmin == 1){
				
				$data['test'] = "exist";
				$data['user'] = $userid;
				$number = $this->photofriends->getWaitingInvites($userid);
				if($number->num_rows() == 0)
				{
					$data['title'] = "Dashboard - PhotoStream";
				}
				else{
				$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
				}
				$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
				$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
				$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
				$data['user_profile'] = 0;
				$data['user_profile2'] = 0;

				$this->load->view('backend/user_list',$data);
				}
			}else {
				redirect(base_url());
				
			}
	}
	
	public function mymemberstable(){
	
	
	if ($this->session->userdata('logged_in')){
				$this->datatables->select('userid AS id,firstname AS firstname, lastname AS lastname, email AS email,admin AS admin')->from('photo_users');
				 echo $this->datatables->generate();
				
			}else {
				redirect(base_url());
				
			}
	
	}
	
	public function makeAdmin(){
	
		$id = $this->db->escape_str($this->input->post('id'));
		
		$insert_data = array('admin' => '1');
		
		$this->photousers->update($id,$insert_data);
		echo "Admin";
	}
	
	public function removeAdmin(){
	
		$id = $this->db->escape_str($this->input->post('id'));
		
		$insert_data = array('admin' => '0');
		
		$this->photousers->update($id,$insert_data);
		
		echo "Make Admin";
	
	}
		
		
		
	
	
}