<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
        $this->load->model('photousers');
        $this->load->model('photofriends');
        $this->load->model('photopics');
		$this->load->model('photostream');
		$this->load->model('photofollowers');
        $this->load->database();
	}
	
	
	public function index(){
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
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			//$data['title'] = "PhotoStream - Search Friends";
			$data['user_profile'] = 0;
			
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
			$data['latest_users'] = $this->db->query("SELECT * FROM `photo_users` WHERE `is_verified` = '1' ORDER BY `userid` DESC LIMIT 1,5");
			
			$data['current_user_friends'] = $this->photofriends->getUserFriends($userid);
			$data['current_user_invited'] = $this->photofriends->getInvited($userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			$this->load->view('backend/friends_index',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function search(){
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
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			//$data['title'] = "PhotoStream - Search Friends";
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['latest_users'] = $this->db->query("SELECT * FROM `photo_users` WHERE `is_verified` = '1' ORDER BY `userid` DESC LIMIT 1,5");
			$data['latest_streams'] = $this->photostream->getlateststreams(20);
			
			$this->load->view('backend/search',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function getresults(){
		$keyword = $this->db->escape_str($this->input->post('keyword'));
		$results = $this->photousers->match($keyword);
		
		$html = "";
		
		if($results->num_rows() > 0){
			$html = '<ul class="news-items" >';
			foreach($results->result() AS $result){
				if($result->avatar_id == '0' || $result->avatar_id == NULL){
					$my_avatar = 'http://d2qcctj8epnr7y.cloudfront.net/sheina/photostream/avatar.png';
				}else{
					$my_avatar = $this->photopics->getinfobyid('filename',$result->avatar_id);
				}
				/*$html .= '<li>
							<div class="news-item-detail">										
								<a href="/profile/username/'.$result->username.'" class="news-item-title">'.$result->firstname." ".$result->lastname.'</a>
								<p class="news-item-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
							</div>
							
							<div class="news-item-date">
								<img style="width:50px;height:50px" src="'.$my_avatar.'"></img>
							</div>
						</li>';*/
						
			/*-----------------------------------------------------------------------------------------------------*/
			
					$html .= '<li>
								<div class="news-item-detail">										
									<a href="/profile/username/'.$result->username.'" class="news-item-title">'.$result->firstname." ".$result->lastname.'</a>
									<p class="news-item-preview">Member Since '.date("M d, Y g:i A", strtotime($result->date_signedup)).'&nbsp <span>Follower ('.$this->photofollowers->getcountbyattribute('followed_id', $result->userid).')</span><span>|</span><span>Following ('.$this->photofollowers->getcountbyattribute('user_id',$result->userid).')</span></p></p>
								</div>
								&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
								<div class="news-item-date">
									<img style="width:50px;height:50px" src="'.$my_avatar.'"></img>
								</div>
							</li>';
			
			/*-----------------------------------------------------------------------------------------------------*/
						
						
						
						
						
						
			}
			$html .= '</ul>';
		}else{
			$html = "<strong>No match found.</strong>";
		}
		echo $html;
	}
	
	public function add_friend(){
		$add_userid = $this->db->escape_str($this->input->post('to_add_userid'));
		$userid = $this->session->userdata('userid');
		$data = array('userid_id' => $userid,
					  'friend_id' => $add_userid);
		$added = $this->photofriends->update(0,$data);
		if($added > 0){
			echo "OK";
		}
	}
	
	public function acceptFriend(){
		$accept_id = $this->db->escape_str($this->input->post('accept_id'));
		$data = array('accept'=>'1');
		if($this->photofriends->update($accept_id,$data) == $accept_id){
			echo "OK";
		}else{
			echo "You are not allowed to this action.";
		}
	}
	
	public function cancelRequest(){
		$cancel_id = $this->db->escape_str($this->input->post('cancel_request_id'));
		$this->photofriends->delete('id',$cancel_id);
		echo "OK";
	}
	
	public function unfriend(){
		$friendship_id = $this->db->escape_str($this->input->post('friendship_id'));
		$this->photofriends->delete('id',$friendship_id);
		echo "OK";
	}
		
}// friends
?>