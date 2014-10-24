<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stream extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('instagram_api');
		$this->load->library('twconnect2');
		$this->load->model('photousers');
		$this->load->model('photostream');
		$this->load->model('photopics');
		$this->load->library('curlclient');
		$this->load->model('photosocials');
		$this->load->model('piccomments');
		$this->load->model('picslikes');
		$this->load->model('picshares');
		$this->load->model('photofriends');
		$this->load->model('photoupdates');
		$this->load->model('photofollowers');
		$this->load->database();
		$fb_config = array(
			       'appId'  => '397317987043545',
			       'secret' => '6759ba06b0ad773fff581bb7b0309e09'
			   );
		$this->load->library('facebook', $fb_config);
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			
			//---------------------------------------------------------
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream';
			}
			
			
			//--------------------------------------------------------
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
				
			$data['user_streams'] = $this->photostream->getbyattribute('userid',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			$array_items = array('tw_access_token' => '', 'tw_status' => '');
			$this->session->unset_userdata($array_items);
			$this->load->view('backend/user_streams',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	
	
	public function streamtesters(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			
			//---------------------------------------------------------
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream';
			}
			
			
			//--------------------------------------------------------
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
				
			$data['user_streams'] = $this->photostream->getbyattribute('userid',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			$array_items = array('tw_access_token' => '', 'tw_status' => '');
			$this->session->unset_userdata($array_items);
			$this->load->view('backend/user_streams_test',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function album(){
		$stream_id = $this->uri->segment(4);
		$userid = $this->session->userdata('userid');
		$data['user_profile'] = 0;
		$data['user_profile2'] = 0;
		$data['stream_id'] = $stream_id;
		$user_userid = $this->photostream->getinfo('userid','stream_id',$stream_id);
		$data['user_username'] = ucwords($this->photousers->getinfo('username','userid',$user_userid));
		$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
		$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
		$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
		$data['follower_count'] = $this->photofollowers->getcountbyattribute('followed_id', $user_userid);
		$data['followed_count'] = $this->photofollowers->getcountbyattribute('user_id',$user_userid);
		$data['recent_follows'] = $this->photofollowers->recentfollow('user_id',$user_userid);
		
		
		
		$array_items = array('tw_access_token' => '', 'tw_status' => '');
		$this->session->unset_userdata($array_items);
		
		
		$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
		if($avatar_id>0)
			$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
		else
			$data['avatar'] = base_url().'img/avatar.gif';
		
		$stream_info = $this->photostream->getbyattribute('stream_id',$stream_id);
		$data['album_pics'] = $this->photopics->getbyattribute('stream_id',$stream_id);
		$isAdmin = $this->photousers->isAdmin($userid);
		$data['stream_title'] = "none";
		foreach($stream_info->result() AS $info){
			$data['stream_title'] = $info->title;
			$data['stream_description'] = $info->description;
			$data['stream_date'] = $info->date_created;
		}
		
		
		
		
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);			
			
				/*check if logged in user views his own stream*/
			
			if($data['stream_title'] == "none"){
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "4 oh 4!";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream ';
			}
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$this->load->view('backend/error_log',$data);
			}
			else{
				$data['title'] = $data['user_fname'].' '.$data['user_lname'].' PhotoStream - '.ucwords($data['stream_title']);
				if($this->photostream->checkexist('userid',$userid,'stream_id',$stream_id) === true || $isAdmin == 1){
				$this->load->view('backend/view_album_manage',$data);
				}else{
					$this->load->view('backend/view_album',$data);
				}
			}
				
			
		}else{
			
			
			
			
			if($data['stream_title'] == "none"){
				$data['title'] = "404 PhotoStream";
				$data['success'] = false;
				$this->load->view('public/error_log',$data);
			}
			else{
				$data['title'] = $data['user_fname'].' '.$data['user_lname'].' PhotoStream - '.ucwords($data['stream_title']);
				$this->load->view('public/view_album_public',$data);
			}
			
		}
	}
	
	public function albumtest(){
		$stream_id = $this->uri->segment(3);
		$userid = $this->session->userdata('userid');
		$data['user_profile'] = 0;
		$data['user_profile2'] = 0;
		$data['stream_id'] = $stream_id;
		$user_userid = $this->photostream->getinfo('userid','stream_id',$stream_id);
		$data['user_username'] = ucwords($this->photousers->getinfo('username','userid',$user_userid));
		$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
		$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
		$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
		
		$array_items = array('tw_access_token' => '', 'tw_status' => '');
		$this->session->unset_userdata($array_items);
		
		
		$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
		if($avatar_id>0)
			$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
		else
			$data['avatar'] = base_url().'img/avatar.gif';
		
		$stream_info = $this->photostream->getbyattribute('stream_id',$stream_id);
		$data['album_pics'] = $this->photopics->getbyattribute('stream_id',$stream_id);

		foreach($stream_info->result() AS $info){
			$data['stream_title'] = $info->title;
			$data['stream_description'] = $info->description;
			$data['stream_date'] = $info->date_created;
		}
		
		$data['title'] = $data['user_fname'].' '.$data['user_lname'].' PhotoStream - '.ucwords($data['stream_title']);
		
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);			
			
				/*check if logged in user views his own stream*/
				
			if($this->photostream->checkexist('userid',$userid,'stream_id',$stream_id) === true){
				$this->load->view('backend/view_album_manage_test',$data);
			}else{
				$this->load->view('backend/view_album',$data);
			}
			
			
		}else{
			$this->load->view('public/view_album_public',$data);
		}
	
	
	
	
	
	}
	
	public function create(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			//$data['title'] = "Dashboard - PhotoStream";
			//------------------------------------------------------
			
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "Dashboard - PhotoStream";
			}
			else{
			$data['title'] = '('.$number->num_rows().') Dashboard - PhotoStream';
			}
			
			
			
			
			//------------------------------------------------------
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$this->load->view('backend/create_stream',$data);
		}else {
			redirect(base_url());
		}
	}
	
	public function upload(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->db->escape_str($this->input->post('stream_id'));
			$data['stream_id'] = $stream_id;
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			
			//--------------------------------------------------------------
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "PhotoStream - Upload Photos";
			}
			else{
			$data['title'] = '('.$number->num_rows().') PhotoStream - Upload Photos';
			}
			
			
			
			
			//--------------------------------------------------------------
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
			if($stream_id == ""){	/*new stream*/		
					$title = $this->db->escape_str($this->input->post('name'));
					$description = $this->db->escape_str($this->input->post('description'));
					$is_public = 0;
					if($this->input->post('show_to_public') == true){
						$is_public = 1;
					}
					
					$insert_data = array('userid' => $userid,
								  'title' => $title,
								  'description' => $description,
								  'is_public' => $is_public);
								  
					$insert_id = $this->photostream->update(0,$insert_data);
					/*$message = 'created stream';
					$slug = url_title($title);
					$link = '/stream/album/'.$slug.'/'.$insert_id;
					$insert_updates = array('userid' => $userid,
											'message' => $message,
											'link' => $link);
					
					$member_id = $this->photoupdates->update(0, $insert_updates);*/
					
					
					
					if($insert_id > 0){
						$data['stream_id'] = $insert_id;
						$data['stream_title'] = $title;
						$data['is_public'] = $is_public;
						$this->session->set_userdata('stream_id', $insert_id);
					}else{
						$data['upload_error'] = 1;
					}
			}else{
				//upload more photos to existing stream
				$this->session->set_userdata('stream_id', $stream_id);
				$infos = $this->photostream->getbyattribute('stream_id',$stream_id);
				if($infos->num_rows() > 0){
					foreach($infos->result() AS $info){
					$data['stream_title'] = $info->title;
					$data['is_public'] = $info->is_public;
					}
				}
				else{
					$data['upload_error'] = 1;
				}
				
				
			}
			
		}else{
			redirect(base_url());
		}
		//-------------------------------------------------------------------------------------------------------------
		$array_items = array('tw_access_token' => '', 'tw_status' => '');
		$this->session->unset_userdata($array_items);
		$this->load->view('backend/upload',$data);
		//-------------------------------------------------------------------------------------------------------------
		
	}
	
	public function facebook_photos(){
		
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->db->escape_str($this->input->post('stream_id'));
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "PhotoStream - Upload Photos";
			}
			else{
			$data['title'] = '('.$number->num_rows().') PhotoStream - Upload Photos';
			}
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
		
			$user = $this->facebook->getUser();
			if ($user) {
		       try {
			   $data2 = $this->facebook->api('/me');
			   $data['profile'] = $this->facebook->api('/me');
			   $data['photos'] = $this->facebook->api('/2898406417052/photos?fields=source,picture');
			   $data['albums'] = $this->facebook->api('/me/albums');
			   $user_profile2 = $this->facebook->api('/me');
			   
			   $x = base_url();
			   $params = array('next' => $x.'/dashboard/logout_fb');
			   $data['logout_url'] = $this->facebook->getLogoutUrl($params);
			   $data['test'] = $data2['name'];
			   
			   $stream_id = $this->uri->segment(3);
			   $this->load->view('backend/fb_import',$data);
				       
		       } catch (FacebookApiException $e) {
			   $user = null;
		       }
		   } 
	   
		       else {
			$data['stream_id'] = $this->db->escape_str($this->input->post('stream_id'));
		       $this->load->view('backend/upload',$data);
		   }
		}
		else{
			redirect(base_url());
		}
	}
	
	
	
	public function save_instagram_pics(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->session->userdata('stream_id');
			$image_url_array = $this->db->escape_str($this->input->post('selected_pics'));
			$counter = $this->db->escape_str($this->input->post('counter'));
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$message = 'uploaded photo from instragram';
			$x= date("l, F d, Y " ,time());
			$title = "instagram ".$x;
			foreach($image_url_array AS $insta_img){
				$data = array('filename'=> $insta_img,
							'stream_id' => $stream_id,
							'social_id' => '2',
							'title' => $title);
				$insert_id = $this->photopics->update(0,$data);
			}
			
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
	
			$data2 = array('userid'=>$userid,'message'=>$message,'link' => $link,'stream_id' => $stream_id,'photo_count' => $counter);
			
			$this->photoupdates->update(0,$data2);
			$this->session->unset_userdata('stream_id');
			echo "OK";
			
		}else{
			redirect(base_url());
		}
	}
	
	public function save_pinterest_pics(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->session->userdata('stream_id');
			$image_url_array = $this->db->escape_str($this->input->post('selected_pics'));
			$counter = $this->db->escape_str($this->input->post('counter'));
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$message = 'uploaded photo from pinterest';
			$x= date("l, F d, Y " ,time());
			$title = "pinterest ".$x;
			foreach($image_url_array AS $insta_img){
				$data = array('filename'=> $insta_img,
							'stream_id' => $stream_id,
							'social_id' => '2',
							'title' => $title);
				$insert_id = $this->photopics->update(0,$data);
			}
			
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
	
			$data2 = array('userid'=>$userid,'message'=>$message,'link' => $link,'stream_id' => $stream_id, 'photo_count' => $counter);
			
			$this->photoupdates->update(0,$data2);
			$this->session->unset_userdata('stream_id');
			echo "OK";
			
		}else{
			redirect(base_url());
		}
	}
	
	public function save_facebook_pics(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->session->userdata('stream_id');
			$image_url_array = $this->db->escape_str($this->input->post('selected_pics'));
			$counter  = $this->db->escape_str($this->input->post('counter'));
			$message = 'uploaded photo from facebook';
			$x= date("l, F d, Y " ,time());
			$title = "facebook ".$x;
			foreach($image_url_array AS $fb_img){
				$data = array('filename'=> $fb_img,
							'stream_id' => $stream_id,
							'social_id' => '1',
							'title' => $title);
				$insert_id = $this->photopics->update(0,$data);
			}
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
			
			$data2 = array('userid' =>$userid,'message'=>$message,'link'=>$link,'stream_id' => $stream_id, 'photo_count' => $counter);
			
			$this->photoupdates->update(0,$data2);
			$this->session->unset_userdata('stream_id');
			
			echo "OK";
			
			
		
		
		}else{
			redirect(base_url());
		}
	
	
	}
	
	
	public function save_twitter_pics(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->session->userdata('stream_id');
			$image_url_array = $this->db->escape_str($this->input->post('selected_pics'));
			$counter = $this->db->escape_str($this->input->post('counter'));
			$message = 'uploaded photo from twitter';
			$x= date("l, F d, Y " ,time());
			$title = "twitter ".$x;
			foreach($image_url_array AS $tweet_img){
				$data = array('filename'=> $tweet_img,
							'stream_id' => $stream_id,
							'social_id' => '1',
							'title' => $title);
				$insert_id = $this->photopics->update(0,$data);
			}
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
			
			$data2 = array('userid' =>$userid,'message'=>$message,'link'=>$link,'stream_id' => $stream_id, 'photo_count' => $counter );
			
			$this->photoupdates->update(0,$data2);
			$this->session->unset_userdata('stream_id');
			
			echo "OK";
			
			
		
		
		}else{
			redirect(base_url());
		}
	
	
	}
	
	public function save_flickr_pics(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->session->userdata('stream_id');
			$image_url_array = $this->db->escape_str($this->input->post('selected_pics'));
			$counter = $this->db->escape_str($this->input->post('counter'));
			$message = 'uploaded photo from flickr';
			$x= date("l, F d, Y " ,time());
			$title = "flickr ".$x;
			foreach($image_url_array AS $flickr_img){
				$data = array('filename'=> $flickr_img,
							'stream_id' => $stream_id,
							'social_id' => '1',
							'title' => $title);
				$insert_id = $this->photopics->update(0,$data);
			}
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
			
			$data2 = array('userid' =>$userid,'message'=>$message,'link'=>$link,'stream_id' => $stream_id, 'photo_count' => $counter);
			
			$this->photoupdates->update(0,$data2);
			$this->session->unset_userdata('stream_id');
			
			echo "OK";
			
			
		
		
		}else{
			redirect(base_url());
		}
	
	
	
	}
	
	
	public function save_google_pics(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->session->userdata('stream_id');
			$image_url_array = $this->db->escape_str($this->input->post('selected_pics'));
			$counter = $this->db->escape_str($this->input->post('counter'));
			$message = 'uploaded photo from flickr';
			$x= date("l, F d, Y " ,time());
			$title = "google plus ".$x;
			foreach($image_url_array AS $google_img){
				$data = array('filename'=> $google_img,
							'stream_id' => $stream_id,
							'social_id' => '1',
							'title' => $title);
				$insert_id = $this->photopics->update(0,$data);
			}
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
			
			$data2 = array('userid' =>$userid,'message'=>$message,'link'=>$link,'stream_id' => $stream_id, 'photo_count' => $counter);
			
			$this->photoupdates->update(0,$data2);
			$this->session->unset_userdata('stream_id');
			
			echo "OK";
			
			
		
		
		}else{
			redirect(base_url());
		}
	
	
	
	}
	
	public function editStreamInfo(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->db->escape_str($this->input->post('stream_id'));
			if($this->photostream->checkexist('userid',$userid,'stream_id',$stream_id) === true){
				$stream_info = $this->photostream->getbyattribute('stream_id',$stream_id);
				if($stream_info->num_rows() > 0){
					foreach($stream_info->result() as $datum){
						$is_public = '';
						if(($datum->is_public) == "1"){
							$is_public = "checked = 'checked'";
						}
						echo "
							<label class='control-label' for='name'>Title</label>
						      <div class='controls'>
						        <input type='text' id='new_title' value='".$datum->title."' />
						      </div>
						    </div>
							
							<label class='control-label' for='description'>Description</label>
						      <div class='controls'>
						       <textarea id='new_description' class='span4' rows='4' name='new_description'>".$datum->description."</textarea>
						      </div>
						    </div>
							 
							 <div class='control-group'>
				            <div class='controls'>
				              <label class='checkbox'>
				               <input type='checkbox' name='new_is_public' ".$is_public." id='new_is_public' /> Visible to public
				              </label>
								<p class='help-block'><strong>Note:</strong> If you choose to set your stream to public, it will become searchable in search engines.</p>
							 </div>
				          </div>
							";
					}
				}else{
					echo "Your programmer did something wrong. Possible reasons are:<br>
						a. The passed stream_id is not in database. Another developer must have deleted it manually.<br>
						b. Everything is just soooo wrong.";
				}
			}else{
				echo "You are not allowed to complete this action.";
			}
		}else{
			echo "Your session has timed out. Please login and try again.";
		}
	}
	
	public function deleteStreamInfo(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->db->escape_str($this->input->post('stream_id'));
			if($this->photostream->checkexist('userid',$userid,'stream_id',$stream_id) === true){
				$stream_info = $this->photostream->getbyattribute('stream_id',$stream_id);
				if($stream_info->num_rows() > 0){
					foreach($stream_info->result() as $datum){
						$datetime = strtotime($datum->date_created);
						$formatted_date = date("M d, Y g:i A", $datetime);
					
						echo "<b>".$datum->title."</b>";
						echo "<p>".$datum->description."
							<br>".$formatted_date."
						</p>";
					}
				}else{
					echo "Your programmer did something wrong. Possible reasons are:<br>
						a. The passed stream_id is not in database. Another developer must have deleted it manually.<br>
						b. Everything is just soooo wrong.";
				}
			}else{
				echo "You are not allowed to complete this action.";
			}
		}else{
			echo "Your session has timed out. Please login and try again.";
		}
	}
	
	public function updateStream(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$title = $this->db->escape_str($this->input->post('title'));
		$description = $this->db->escape_str($this->input->post('description'));
		$is_public = $this->db->escape_str($this->input->post('is_public'));
			
			$data = array('title'=>$title,
						  'description' => $description,
						  'is_public' => $is_public);
						  
		$this->photostream->update($stream_id,$data);
		
		echo "OK";
	}
	
	public function deleteStream(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		//delete from photo_pics
			$this->photopics->delete('stream_id',$stream_id);
		//delete from photo_stream
			$this->photostream->delete('stream_id',$stream_id);
		echo "OK";
	}
	
	public function deleteSelectedFromAlbum(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$delete_pic_arr = $this->db->escape_str($this->input->post('image_id_array'));
		

		foreach($delete_pic_arr as $image_id){
			$this->photopics->delete('photo_id',$image_id);
		}
		
		//check if album cover is deleted.
		//If yes, randomize from remaining images from that album
		$current_cover_id = $this->photostream->getinfobyid('cover_pic',$stream_id);
		if($this->photopics->checkexist('photo_id',$current_cover_id) === false){
			$new_cover = $this->photopics->getinfo('photo_id','stream_id',$stream_id);
			$data = array('cover_pic' => $new_cover);
			$this->photostream->update($stream_id,$data);
		}
		
		echo "OK";
	}
	
	public function updateStreamCover(){
		$cover_id = $this->db->escape_str($this->input->post('photo_id'));
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		
		$data = array('cover_pic' => $cover_id);
		$this->photostream->update($stream_id,$data);
		echo "OK";
	}
	
	public function updateAvatar(){
		$avatar_id = $this->db->escape_str($this->input->post('photo_id'));
		$userid = $this->session->userdata('userid');
		
		$data = array('avatar_id' => $avatar_id);
		$this->photousers->update($userid,$data);
		echo "OK";
	}
	
	public function albumfb(){
		$stream_id = $this->uri->segment(3);
		$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "PhotoStream - Upload Photos";
			}
			else{
			$data['title'] = '('.$number->num_rows().') PhotoStream - Upload Photos';
			}
		$data['user_profile'] = 0;
		$data['user_profile2'] = 0;
		$data['stream_id'] = $stream_id;
		$userid = $this->session->userdata('userid');
		$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
		
		$stream_info = $this->photostream->getbyattribute('stream_id',$stream_id);
		$data['album_pics'] = $this->photopics->getbyattribute('stream_id',$stream_id);

				foreach($stream_info->result() AS $info){
					$data['stream_title'] = $info->title;
					$data['stream_description'] = $info->description;
				}
		
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);			
			
				/*check if logged in user views his own stream*/
				
			if($this->photostream->checkexist('userid',$userid,'stream_id',$stream_id) === true){
				$this->load->view('backend/view_album_manage',$data); //create new page for fb style
			}else{
				$this->load->view('backend/view_album',$data); //create new page for fb style
			}
			
			
		}else{
			$this->load->view('public/view_album_public_fb_style.php',$data);
		}
	}
	
	public function albumblog(){
		$stream_id = $this->uri->segment(3);
		$data['title'] = "Streams - PhotoStream";
		$data['user_profile'] = 0;
		$data['user_profile2'] = 0;
		$data['stream_id'] = $stream_id;
		$userid = $this->session->userdata('userid');
		$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
		$stream_info = $this->photostream->getbyattribute('stream_id',$stream_id);
		$data['album_pics'] = $this->photopics->getbyattribute('stream_id',$stream_id);

				foreach($stream_info->result() AS $info){
					$data['stream_title'] = $info->title;
					$data['stream_description'] = $info->description;
				}
		
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);			
			
				/*check if logged in user views his own stream*/
				
			if($this->photostream->checkexist('userid',$userid,'stream_id',$stream_id) === true){
				$this->load->view('backend/view_album_manage',$data); //create new page for fb style
			}else{
				$this->load->view('backend/view_album',$data); //create new page for fb style
			}
			
			
		}else{
			$this->load->view('public/view_album_public_blog_style.php',$data);
		}
	}
	
	
	public function fb_photos(){
	
	$userid = $this->session->userdata('userid');
	
	$data['stream_id'] = $this->uri->segment(3);
	$userid = $this->session->userdata('userid');
	$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
	$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
	
	//---------------------------------------------------------
	
	
	$number = $this->photofriends->getWaitingInvites($userid);
		if($number->num_rows() == 0)
		{
			$data['title'] = "Facebook Photos - PhotoStream";
		}
		else{
		$data['title'] = '('.$number->num_rows().') Facebook Photos - PhotoStream';
		}
	
	
	
	//---------------------------------------------------------
	$data['user_profile'] = 0;
	$data['user_profile2'] = 0;
	
        $albums2 = $this->input->post('albums2');
	$data['albums3'] = $this->input->post('albums2');
	
	 $data['photos'] = $this->facebook->api('/'.$albums2.'/photos?fields=source,picture');
        
        //$this->index();
        $this->load->view('backend/fb_photos',$data);
        
    }
    
    
	
	
    public function twitter_redirect(){
	$ok = $this->twconnect2->twredirect('stream/twitter_photos');

	if (!$ok) {
		echo 'Could not connect to Twitter. Refresh the page or try again later.';
	}
    }
    
    public function twitter_photos(){
	$ok = $this->twconnect2->twprocess_callback();
		
		if ( $ok ) {
			
			$this->twconnect2->twaccount_verify_credentials();

			//echo 'Authenticated user info ("GET account/verify_credentials"):<br/><pre>';
			//print_r($this->twconnect2->tw_user_info); echo '</pre>';
			
			if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$stream_id = $this->db->escape_str($this->input->post('stream_id'));
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			$data['stream_id'] = $this->session->userdata('stream_id');
			
			
			//------------------------------------------------------
			
			$number = $this->photofriends->getWaitingInvites($userid);
				if($number->num_rows() == 0)
				{
					$data['title'] = "PhotoStream - Upload Photos";
				}
				else{
				$data['title'] = '('.$number->num_rows().') PhotoStream - Upload Photos';
				}
			
			
			
			
			//------------------------------------------------------
			
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			
			$data['tweet'] = $this->twconnect2->tw_user_info;
			
			$this->load->view('backend/twitter_photos',$data);
			
			
			}
			else{
				redirect(base_url());
			}
			}
			else {
				$this->load->view('error');
				
			}
    }
    
    public function clearsession() {

		$this->session->sess_destroy();
		
		
		

		redirect('stream/upload');
	}  
    
    
    
   
} // end of class