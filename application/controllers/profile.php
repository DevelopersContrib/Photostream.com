<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->library('session');
        $this->load->model('photousers');
        $this->load->model('photostream');
        $this->load->model('photopics');
        $this->load->model('photofriends');
        $this->load->model('photochallenge');
		$this->load->model('photofollowers');
        $this->load->database();
	}
	
	public function index(){
		redirect(base_url());
	}
	
	public function username($param=null,$extra=null){
		if ($extra!=""){
				header('Location: '.base_url().$param);
				exit;
			}
			
		//$username = $this->uri->segment(3);
		
		$pos = strpos($param, '-');
	        if ($pos === false) {
			  $username = $param;
			  $page = "";
	        }else {
	          $string = explode('-',$param);	
	          list($username, $page) = $string; 
	        }
		$profile_userid = 0;
		if($this->photousers->checkexist('username',$username) === true ){
			$profile_userid = $this->photousers->getinfo('userid','username',$username);
			$query_data = $this->photousers->getbyattribute('userid',$profile_userid);
			$data['title'] = "4 oh four";
			foreach($query_data->result() as $info){
				$data['profile_fullname'] = $info->firstname." ".$info->lastname;
				$data['title'] = "Photostream Profile - ".$data['profile_fullname'];
				$data['profile_picture'] = $this->photopics->getinfobyid('filename',$info->avatar_id);
				$data['member_since'] = date("M d, Y g:i A", strtotime($info->date_signedup));
				$userid = $this->session->userdata('userid');
				if($userid == $profile_userid){
					$data['profile_streams'] = $this->photostream->getbyattribute('userid',$profile_userid);
				}else{
					$data['profile_streams'] = $this->photostream->getbyattribute('userid',$profile_userid,'is_public','1');
				}
				
				$data['profile_challenges'] = $this->photochallenge->getbyattribute('userid',$profile_userid);
				$data['profile_userid'] = $profile_userid;
			}
			
			$data['profile_all_friends'] = $this->photofriends->getUserFriends($profile_userid); 
			
		}else{
			$data['title'] = "Username error";
			$data['error'] = "Username not found";
		}
		
		if ($this->session->userdata('logged_in')){
				$userid = $this->session->userdata('userid');
				$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
				$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
				$data['user_profile'] = 0;
				$data['user_profile2'] = 0;
				$data['profileid'] = $profile_userid;
				$data['isSelf'] = 0;
				if($userid == $profile_userid){
					$data['isSelf'] = 1;
				}else{
					$data['isFriends'] = $this->photofriends->checkIfFriends($userid,$profile_userid);
				}
				$data['following'] = $this->photofollowers->checkexist('user_id',$userid,'followed_id',$profile_userid);
				$data['follower_count'] = $this->photofollowers->getcountbyattribute('followed_id', $profile_userid);
				$data['followed_count'] = $this->photofollowers->getcountbyattribute('user_id',$profile_userid);
				$data['prof_following'] = $this->photofollowers->getfollow('user_id',$profile_userid);
				$data['prof_followers'] = $this->photofollowers->getfollow('followed_id',$profile_userid);
				$this->load->view('backend/profile',$data);
		}else{
			$this->load->view('public/profile',$data);
		}
	}
	
	function followuser(){
		$userid = $this->session->userdata('userid');
		$followed_id = $this->db->escape_str($this->input->post('profileid'));
		
		
		if($this->photofollowers->checkexist('user_id',$userid,'followed_id',$followed_id)===FALSE){
		
			$datafollow = array(
			'user_id' => $userid,
			'followed_id' => $followed_id,
			'date_followed' => date('Y-m-d h:i:s')
			);
			$this->photofollowers->update(0,$datafollow);
			
			$followcnt = $this->photofollowers->getcountbyattribute('followed_id',$followed_id);
			
			echo $followcnt;
			
			//echo "ok";
		}else{
			echo "exists";
		}
		
	}
	

	
} //end of class

?>