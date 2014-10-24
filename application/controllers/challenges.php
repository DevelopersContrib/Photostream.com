<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Challenges extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->library('curlclient');
		$this->load->library('email');
		$this->load->model('photofriends');
        $this->load->model('photousers');
        $this->load->model('photostream');
        $this->load->model('photopics');
        $this->load->model('photochallenge');
        $this->load->model('photosubmissions');
        $this->load->database();
	}
	
	
	public function index(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$number = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = 'Photostream - Challenges';
			}
			else{
			$data['title'] = '('.$number->num_rows().')PhotoStream - Challenges ';
			}
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['challenges_open'] = $this->photochallenge->getbyattribute('is_closed','0');
			$data['challenges_closed'] = $this->photochallenge->getbyattribute('is_closed','1');
			$data['user_challenges'] = $this->photochallenge->getbyattribute('userid',$userid);
			
			$this->load->view('backend/challenges_index',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function create(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "PhotoStream - Challenges";
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
			
			$this->load->view('backend/create_challenge',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function info(){
		if($this->session->userdata('logged_in')){
		
			$challenge_id = $this->uri->segment(3);
			
			$userid = $this->session->userdata('userid');
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "PhotoStream - Challenge";
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
			if($this->photochallenge->checkexist('challenge_id',$challenge_id) == true){
				$challenge_details = $this->photochallenge->getbyattribute('challenge_id',$challenge_id);
				foreach($challenge_details->result() AS $detail){
					$data['title'] = $detail->title;
					$data['description'] = $detail->description;
					$data['status'] = $detail->is_closed;
					$data['date_posted'] = date("M d, Y g:i A", strtotime($detail->date_posted));
					$data['poster_fullname'] = $this->photousers->getinfobyid('firstname',$detail->userid)." ".$this->photousers->getinfobyid('lastname',$detail->userid);
					$data['poster_avatar_url'] = $this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$detail->userid));
					$data['poster_userid'] = $detail->userid;
				}
				
				$data['challenge_submissions'] = $this->photosubmissions->getbyattribute('challenge_id',$challenge_id);
				$data['challenge_id'] = $challenge_id ;
				
				if($this->photosubmissions->checkexist('challenge_id',$challenge_id,'userid',$userid) === true){
					$data['show_join_btn'] = 0;
				}else if($userid == $data['poster_userid']){
					$data['show_join_btn'] = 0;
				}else{
					$data['show_join_btn'] = 1;
				}
				
			}else{
				redirect('/challenges');
			}
			
			$this->load->view('backend/challenge_details',$data);
			
		}else{
			
		}
		
	}
	
	public function saveChallenge(){
		$userid = $this->session->userdata('userid');
		$title = $this->db->escape_str($this->input->post('title'));
		$description = $this->db->escape_str($this->input->post('description'));
		
		
		$save_data = array('title' => $title,'description' => $description, 'userid' => $userid);
		$challenge_id = $this->photochallenge->update(0,$save_data);
		
		if($challenge_id > 0){
			redirect('challenges/info/'.$challenge_id);
		}else{
			echo "An error occurred: ".$challenge_id;
		}
		
	}
	
	public function savesubmit(){
		$userid = $this->session->userdata('userid');
		$challenge_id = $this->uri->segment(3);
		$selected_photo_url = $this->db->escape_str($this->input->post('selected_photo_url'));
		$caption = $this->db->escape_str($this->input->post('caption'));
		$description = $this->db->escape_str($this->input->post('description'));
		$challenge_id = $this->db->escape_str($this->input->post('challenge_id'));
		$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
		$now = new DateTime();
		$date_submitted = $now->format('Y-m-d H:i:s');
		
		$data = array('filename' => $selected_photo_url,
		'date_submitted' => $date_submitted,
		'challenge_id' => $challenge_id,
		'userid' => $userid,
		'description' => $description,
		'caption' => $caption);
		
		$insert_id = $this->photosubmissions->update(0,$data);
		
		
	
		if($insert_id > 0){
			//redirect('challenges/entry/'.$insert_id);
			redirect('challenges/viewSubmission/'.$challenge_id);
		}else{
			echo "error occurred.";
		}
	}
	
	
	public function showSelectFromStream(){
		$userid = $this->session->userdata('userid');
		$data['user_streams'] = $this->photostream->getbyattribute('userid',$userid);
		$this->load->view('backend/showStreamforChallenge',$data);
	}
	
	public function showStreamContents(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$data['stream_images'] = $this->photopics->getbyattribute('stream_id',$stream_id);
		$this->load->view('backend/loadStreamContentsforchallenge',$data);
	}
	
	public function getFilename(){
		$photo_id = $this->db->escape_str($this->input->post('photo_id'));
		$url = $this->photopics->getinfobyid('filename',$photo_id);
		echo $url;
	}
	
	public function viewSubmission(){
		
		
		
		//---------------------------------------------------------------------------------------------
		
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "PhotoStream - Challenges";
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
			
			$challenge_id = $this->uri->segment(3);
			//echo $challenge_id;
			$data['challenge_pics'] = $this->photosubmissions->getbyattribute('challenge_id',$challenge_id);
			
			$challenge_details = $this->photochallenge->getbyattribute('challenge_id',$challenge_id);
			foreach($challenge_details->result() AS $detail){
				$data['title'] = $detail->title;
				$data['description'] = $detail->description;
				$data['status'] = $detail->is_closed;
				$data['date_posted'] = date("M d, Y g:i A", strtotime($detail->date_posted));
				$data['poster_fullname'] = $this->photousers->getinfobyid('firstname',$detail->userid);
				$data['poster_avatar_url'] = $this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$detail->userid));
				$data['poster_userid'] = $detail->userid;
			}
			$challenge_pics2 = $this->photosubmissions->getbyattribute('challenge_id',$challenge_id);
			foreach($challenge_pics2->result() AS $detail2){
				$data['date_submitted'] = $detail2->date_submitted;
				
			}
			$this->load->view('backend/challenges_submission',$data);
			
		}else{
			redirect(base_url());
		}
		
	}
	
}//end of class
?>