<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller {
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
		$this->load->model('picslikes');
		$this->load->model('piccomments');
		$this->load->model('photofriends');
		$this->load->model('picshares');
		$this->load->model('photomembernotifications');
		$this->load->model('photonotifications');
		$this->load->model('photoviewcount');
		$this->load->model('photofollow');
		$this->load->database();
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			redirect(base_url().'dashboard');
		}else{
			redirect(base_url());
		}
	}
	
	public function comment(){
		if ($this->session->userdata('logged_in')){
			
			//DATA OF CURRENT USER VIEWING THE PHOTO
			$userid = $this->session->userdata('userid');
			$user_avatar_id = $this->photousers->getinfo('avatar_id','userid',$userid);
			$data['user_avatar'] = $this->photopics->getinfo('filename','photo_id',$user_avatar_id);
			$data['name'] = ucwords($this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid));			
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
					
			
			$photo_id = $this->uri->segment(4);
			
			$slug = $this->uri->segment(3);
			
			if($this->photopics->checkexist('photo_id',$photo_id)===TRUE){
				
				//PHOTO DETAILS
				$data['success'] = true;
				$data['loved'] =  $this->picslikes->checkexist('photo_id',$photo_id,'userid',$this->session->userdata('userid'));
				$data['lovecnt'] = $this->picslikes->getcountbyattribute('photo_id',$photo_id);	
				$data['commentcnt'] = $this->piccomments->getcountbyattribute('photo_id',$photo_id);	
				$data['sharecnt'] = 0;	
				$photo = $this->photopics->getbyattribute('photo_id',$photo_id);
				foreach($photo->result() AS $info){
					$data['pic_id'] = $photo_id;
					$data['pic_title'] = $info->title;
					$data['pic_filename'] = $info->filename;
					$data['pic_date_uploaded'] = $info->date_uploaded;
					$data['stream_id'] = $info->stream_id;
					$data['stream_title'] = $this->photostream->getinfo('title','stream_id',$data['stream_id']);
					$data['stream_description'] = $this->photostream->getinfo('description','stream_id',$data['stream_id']);
					$data['stream_date'] = $this->photostream->getinfo('date_created','stream_id',$data['stream_id']);
				}
				
				//FETCH PHOTO COMMENTS
				$data['comments'] = $this->piccomments->getbyattribute('photo_id',$photo_id);
				
				
				//USER DATA OF PHOTO OWNER
				$user_userid = $this->photostream->getinfo('userid','stream_id',$data['stream_id']);
				$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
				$data['slug'] = $slug;
				$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
				$data['user_username'] = $this->photousers->getinfo('username','userid',$user_userid);
				$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
				$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
				$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
				$data['userid'] = $userid;
				$data['owner_id'] = $user_userid;
				if($userid != $user_userid){
					
					$data_photo_view_count = array(
							"photo_id" => $photo_id,
							"user_id" => $user_userid);
							
					$id = $this->photoviewcount->update(0,$data_photo_view_count);
				
				}
				
				$data['viewcount'] = $this->photoviewcount->getbyattribute('user_id',$user_userid,'photo_id',$photo_id)->num_rows();
				$data['title'] = $data['user_fname']." ".$data['user_lname']." PhotoStream - ".ucwords($data['stream_title']);
				$this->load->view('backend/commentphoto',$data);
			
			}else{
				$data['title'] = "404 PhotoStream";
				$data['success'] = false;
				
				$this->load->view('backend/commentphoto',$data);
			}
			
		}else{
		
			
					
			
			$photo_id = $this->uri->segment(4);
			
			if($this->photopics->checkexist('photo_id',$photo_id)===TRUE){
				
				//PHOTO DETAILS
				$data['success'] = true;
				$data['loved'] =  $this->picslikes->checkexist('photo_id',$photo_id,'userid',$this->session->userdata('userid'));
				$data['lovecnt'] = $this->picslikes->getcountbyattribute('photo_id',$photo_id);	
				$data['commentcnt'] = $this->piccomments->getcountbyattribute('photo_id',$photo_id);	
				$data['sharecnt'] = $this->picshares->getcountbyattribute('photo_id',$photo_id);	
				$photo = $this->photopics->getbyattribute('photo_id',$photo_id);
				foreach($photo->result() AS $info){
					$data['pic_id'] = $photo_id;
					$data['pic_title'] = $info->title;
					$data['pic_filename'] = $info->filename;
					$data['pic_date_uploaded'] = $info->date_uploaded;
					$data['stream_id'] = $info->stream_id;
					$data['stream_title'] = $this->photostream->getinfo('title','stream_id',$data['stream_id']);
					$data['stream_description'] = $this->photostream->getinfo('description','stream_id',$data['stream_id']);
					$data['stream_date'] = $this->photostream->getinfo('date_created','stream_id',$data['stream_id']);
				}
				
				//FETCH PHOTO COMMENTS
				$data['comments'] = $this->piccomments->getbyattribute('photo_id',$photo_id);
				
				
				//USER DATA OF PHOTO OWNER
				$user_userid = $this->photostream->getinfo('userid','stream_id',$data['stream_id']);
				$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
				$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
				$data['user_username'] = $this->photousers->getinfo('username','userid',$user_userid);
				$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
				$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
				
				
				
				$data['title'] = $data['user_fname']." ".$data['user_lname']." PhotoStream - ".ucwords($data['stream_title']);
				$data_photo_view_count = array(
							"photo_id" => $photo_id,
							"user_id" => $user_userid);
				$id = $this->photoviewcount->update(0,$data_photo_view_count);
				$data['viewcount'] = $this->photoviewcount->getbyattribute('user_id',$user_userid,'photo_id',$photo_id)->num_rows();
				$this->load->view('public/photo_view_public',$data);
			
			}else{
				$data['title'] = "404 PhotoStream";
				$data['success'] = false;
				$this->load->view('public/error_log',$data);
				//$this->load->view('/commentphoto',$data);
			}
			
			
		}
	}
	
	public function addphotocomment(){
		if ($this->session->userdata('logged_in')){
			$photoID = $this->db->escape_str($this->input->post('photoID'));
			$userID = $this->db->escape_str($this->input->post('userID'));
			$comment = $this->db->escape_str($this->input->post('comment'));
			$slug = $this->db->escape_str($this->input->post('slug'));
			$owner_id = $this->db->escape_str($this->input->post('owner_id'));
			$name = ucwords($this->photousers->getinfobyid('firstname',$userID)." ".$this->photousers->getinfobyid('lastname',$userID));
			$message = $name." commented on your photo";
			
			$url = base_url()."photo/comment/".$slug."/".$photoID;
			$insert_data = array('comment' => $comment,'photo_id' => $photoID,'userid' => $userID);
			$this->piccomments->update(0,$insert_data);
			if($owner_id != $userID){
				$insert_notification_data = array('message' =>$message,'notification_type'=>'comment','url' => $url);
				$notification_id = $this->photonotifications->update(0,$insert_notification_data);
				$member_notification_data = array('notification_id'=>$notification_id,'read_notif' => 0,'userid'=>$owner_id);
				$this->photomembernotifications->update(0,$member_notification_data);
				$photo_follow_data = array('photo_id' => $photoID,'userid' => $userID);
				$this->photofollow->update(0,$photo_follow_data);
			}else{
				$photo_follow = $this->photofollow->checkexist('photo_id',$photoID);
				if($photo_follow){
					$photo_follow = $this->photofollow->getbyattribute('photo_id',$photoID);
					$message2 = $name." commented on uploaded photo";
					foreach($photo_follow->result() as $follow){
					
						$insert_notification_data = array('message' =>$message2,'notification_type'=>'reply','url' => $url);
						$notification_id = $this->photonotifications->update(0,$insert_notification_data);
						$member_notification_data = array('notification_id'=>$notification_id,'read_notif' => 0,'userid'=>$follow->userid);
						$this->photomembernotifications->update(0,$member_notification_data);
						$photo_follow_data = array('photo_id' => $photoID,'userid' => $userID);
					
					}
				
				}
			
			}
			
			echo 'ok';
			
		}else{
			echo 'error';
		}
	}
	
	
	public function commentcount(){
	
		
	
	
	}
	
	public function deletecomment(){
		if($this->session->userdata('logged_in')){
			$id = $this->db->escape_str($this->input->post('id'));
		
			
			$this->piccomments->delete('comment_id',$id);
		
		
		}else{
		
			echo 'error';
		
		}
	
	
	
	}
	
	public function viewcomments(){
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['userid'] = $userid;
			
			$photoID = $this->db->escape_str($this->input->post('photoID'));
			$data['photoID'] = $photoID;
			$data['comments'] = $this->piccomments->getbyattribute('photo_id',$photoID);
			$this->load->view('backend/viewcomments',$data);
		}else{
		
			echo 'error';
		}
	
	
	}
	
	public function editcomment(){
		if($this->session->userdata('logged_in')){
			$id = $this->db->escape_str($this->input->post('id'));
			$photoID = $this->db->escape_str($this->input->post('photoID'));
			$userid = $this->session->userdata('userid');
			$data['userid'] = $userid;
			$data['photoID'] = $photoID;
			$data['comments'] = $this->piccomments->getbyattribute('comment_id',$id);
			$this->load->view('backend/editcomment',$data);
		
		
		}else{
		
			echo 'exists';
		}
		
		
	
	}
	
	public function savecommentedit(){
		if($this->session->userdata('logged_in')){
			$id = $this->db->escape_str($this->input->post('id'));
			$comment =  $this->db->escape_str($this->input->post('text'));
			
			$insert_data = array(
				'comment' => $comment
			);
			
			$this->piccomments->update($id,$insert_data);
			
		
		}else{
		
			echo 'exists';
		}
	
	
	
	}
	
	public function likephoto(){
		if ($this->session->userdata('logged_in')){
			$photoID = $this->db->escape_str($this->input->post('photoID'));
			$userID = $this->db->escape_str($this->input->post('userID'));
			
			
			
			
			
			if($this->picslikes->checkexist('photo_id',$photoID,'userid',$userID)===FALSE){
				
				$stream_id = $this->photopics->getinfobyid('stream_id',$photoID);
				$photo_owner_id = $this->photostream->getinfobyid('userid',$stream_id);
				
				if($this->session->userdata('userid') != $photo_owner_id){
				
					$name = ucwords($this->photousers->getinfobyid('firstname',$userID)." ".$this->photousers->getinfobyid('lastname',$userID));
					$message = $name." likes your photo";
					$title = $this->photopics->getinfobyid('title',$photoID);
					$slug = url_title($title);
				/*---------------------------------------------------------------------------*/
					$url = base_url()."photo/comment/".$slug."/".$photoID;
					$insert_notification_data = array('message' =>$message,'notification_type'=>'like','url' => $url);
					$notification_id = $this->photonotifications->update(0,$insert_notification_data);
					$member_notification_data = array('notification_id'=>$notification_id,'read_notif' => 0,'userid'=>$photo_owner_id);
					$this->photomembernotifications->update(0,$member_notification_data);
				/*---------------------------------------------------------------------------*/
				
				
				}
				
			
				$insert_data = array('photo_id' => $photoID,'userid' => $userID);
				
				$this->picslikes->update(0,$insert_data);
				
				$lovecnt = $this->picslikes->getcountbyattribute('photo_id',$photoID);								
				
				echo $lovecnt;
				
			}else{			
				echo 'exists';
			}		
			
		}else{
			echo 'error';
		}
	}
	
	public function dislikephoto(){
	
			$photoID = $this->db->escape_str($this->input->post('photo_id'));
			$userID = $this->db->escape_str($this->input->post('user_id'));
			
			if($this->picslikes->checkexist('photo_id',$photoID,'userid',$userID)===TRUE){
			
				$this->picslikes->deletelike('photo_id','userid',$photoID,$userID);
				
				$lovecnt = $this->picslikes->getcountbyattribute('photo_id',$photoID);
				echo $lovecnt;
				
			}else{
				echo 'does not exists';
			}

		
	}
	
	public function sharephoto(){

			$photoID = $this->db->escape_str($this->input->post('id'));
			$userID = $this->db->escape_str($this->input->post('userid'));
			
				$insert_data = array('photo_id' => $photoID, 'userid' => $userID);
				
				$this->picshares->update(0,$insert_data);
				
				$sharecnt = $this->picshares->getcountbyattribute('photo_id',$photoID);
				
				echo $sharecnt;

	}
	
	public function timeline(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$user_userid = $this->photostream->getinfo('userid','stream_id',$stream_id);
		$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
		$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
		$data['user_username'] = ucwords($this->photousers->getinfo('username','userid',$user_userid));
		$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
		$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
		$data['album_pics'] = $this->photopics->getbyattribute('stream_id',$stream_id);
		
		$html = '';
		
		$pic_data = array();
		$limit = 10;
		$cnt = 0;
		$album_pics = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."' LIMIT 0,$limit");
		$album_pic = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."'");
		
		foreach($album_pics->result() as $pic){
		
			$pic_data[$cnt]['photo_id'] = $pic->photo_id;
			$pic_data[$cnt]['title'] = $pic->title;
			$pic_data[$cnt]['date_uploaded'] = $pic->date_uploaded;
			$pic_data[$cnt]['filename'] = $pic->filename;
			$cnt++;
		
		}
		
		$data['pic_data'] = $pic_data;
		$data['curr_page'] = 1;	
		$data['limit'] = $limit;
		$data['results_cnt'] = $album_pic->num_rows();
		$data['stream_id'] = $stream_id;
		$data['reg'] = date("U");
		$data['feedlimit'] = $limit;
		$data['feedstart'] = 10;
		
		
		
		
		$this->load->view('backend/timeline',$data);
		
		
	}
	
	public function loadnextpagetimeline(){
		
		
		$pic_data = array();
		$limit = 10;
		$cnt = 0;
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$curr_page = $this->db->escape_str($this->input->post('page'));
		
		$user_userid = $this->photostream->getinfo('userid','stream_id',$stream_id);
		$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
		$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
		$data['user_username'] = ucwords($this->photousers->getinfo('username','userid',$user_userid));
		$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
		$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
		
		$start = ($curr_page * $limit) - $limit;
		
		$album_pic = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."'");
		$album_pics = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."' LIMIT ".$start.",".$limit);
		
		foreach($album_pics->result() as $pic){
			$pic_data[$cnt]['photo_id'] = $pic->photo_id;
			$pic_data[$cnt]['title'] = $pic->title;
			$pic_data[$cnt]['date_uploaded'] = $pic->date_uploaded;
			$pic_data[$cnt]['filename'] = $pic->filename;
			$cnt++;
		}
		
		$data['reg'] = date("U");
		$data['pic_data'] = $pic_data;
		$data['curr_page'] = $curr_page;	
		$data['limit'] = $limit;
		$data['results_cnt'] = $album_pic->num_rows();
		$data['stream_id'] = $stream_id;
		$data['page2'] = $curr_page+1;
		
		$this->load->view('backend/timeline',$data);
	
	
	}
	
	
	public function blogstyle(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$data['album_pics'] = $this->photopics->getbyattribute('stream_id',$stream_id);
		
		$pic_data = array();
		$limit = 10;
		$cnt = 0;
		$album_pics = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."' LIMIT 0,$limit");
		$album_pic = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."'");
		
		foreach($album_pics->result() as $pic){
		
			$pic_data[$cnt]['photo_id'] = $pic->photo_id;
			$pic_data[$cnt]['title'] = $pic->title;
			$pic_data[$cnt]['date_uploaded'] = $pic->date_uploaded;
			$pic_data[$cnt]['filename'] = $pic->filename;
			$cnt++;
		
		}
		
		$data['pic_data'] = $pic_data;
		$data['curr_page'] = 1;	
		$data['limit'] = $limit;
		$data['results_cnt'] = $album_pic->num_rows();
		$data['stream_id'] = $stream_id;
		
		$this->load->view('backend/blog',$data);
	}
	
	public function loadnextpageblog(){
	
		$pic_data = array();
		$limit = 10;
		$cnt = 0;
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$curr_page = $this->db->escape_str($this->input->post('page'));
		
		$user_userid = $this->photostream->getinfo('userid','stream_id',$stream_id);
		$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
		$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
		$data['user_username'] = ucwords($this->photousers->getinfo('username','userid',$user_userid));
		$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
		$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
		
		$start = ($curr_page * $limit) - $limit;
		
		$album_pic = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."'");
		$album_pics = $this->photopics->getQueryResult("Select * from photo_pics where stream_id = '".$stream_id."' LIMIT ".$start.",".$limit);
		
		foreach($album_pics->result() as $pic){
			$pic_data[$cnt]['photo_id'] = $pic->photo_id;
			$pic_data[$cnt]['title'] = $pic->title;
			$pic_data[$cnt]['date_uploaded'] = $pic->date_uploaded;
			$pic_data[$cnt]['filename'] = $pic->filename;
			$cnt++;
		}
		
		$data['pic_data'] = $pic_data;
		$data['curr_page'] = $curr_page;	
		$data['limit'] = $limit;
		$data['results_cnt'] = $album_pic->num_rows();
		$data['stream_id'] = $stream_id;
		
		$this->load->view('backend/blog',$data);
	
	
	}
	
	public function uploadfromfile(){
	
	if($this->session->userdata('logged_in')){
		$userid = $this->session->userdata('userid');
		$user_avatar_id = $this->photousers->getinfo('avatar_id','userid',$userid);
		$data['user_avatar'] = $this->photopics->getinfo('filename','photo_id',$user_avatar_id);
		$data['stream_id'] = $this->uri->segment(3);
		$data['name'] = ucwords($this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid));	$data['user_profile'] = 0;
		$data['user_profile2'] = 0;
		$data['title'] = "Upload from file";
		$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
		$this->load->view('backend/upload2',$data);
		
	}else{
		redirect(base_url());
	}

	}
	
	public function uploadpic(){
	
			header('Access-Control-Allow-Origin: *');
		 //$this->load->library('uploadhandler');
			$options = array( 'upload_dir' => './uploads/profile/',
            'upload_url' =>base_url().'/uploads/profile/',
			'accept_file_types'=>'/\.(gif|jpeg|jpg|png)$/i');
			$this->load->library('uploadhandler',$options);
	}
	
	
	public function savefileimage(){
	
		$userid = $this->session->userdata('userid');
		$filename = $this->input->post('filename');
		$stream_id = $this->input->post('stream_id');
		$x= date("l, F d, Y " ,time());
		$title = "file ".$x;
		
		/*$config['source_image'] = '/uploads/profile/'.$filename;
		$config['wm_text'] = 'Copyright 2014 - Photostream.com';
		$config['wm_type'] = 'text';
		$config['wm_font_size'] = '16';
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '20';
		$this->load->library('image_lib',$config);
		$this->image_lib->initialize($config);
		
		$this->image_lib->watermark();
		 if(!$this->image_lib->watermark()){
			var_dump($config);
             die($this->image_lib->display_errors());
        }else{*/
			//echo "OK";
		/*}
       // $this->image_lib->clear();*/
	   
	   
	
		/*$data = array('filename'=> 'http://photostream.com/uploads/profile/'.$filename,
							'stream_id' => $stream_id,
							'social_id' => '7',
							'title' => $title);
		
		$insert_id = $this->photopics->update(0,$data);
		echo "OK";*/
		
		
		 $uploaded_file_path ='./uploads/profile/'. $filename;
		 $processed_file_path = './uploads/profile/thumbnail/' . preg_replace('/\.[^\.]+$/', '.jpg', $filename);
		
		 $result = $this->createwatermark($uploaded_file_path, $processed_file_path);
		 if ($result === false) {
			return false;
		 } else {
			$image_path = array($uploaded_file_path, $processed_file_path);
			$filename2 = str_replace("./","",$image_path[1]);
			$image_location = base_url().$filename2;
			
			
			$data = array('filename'=> $image_location,
							'stream_id' => $stream_id,
							'social_id' => '7',
							'title' => $title);
		
			$insert_id = $this->photopics->update(0,$data);
			echo "OK";
			
			
		 }
		
		
	
	
	}
	
	public function createwatermark($source_file_path, $output_file_path){
	
			$watermark = imagecreatefrompng('./img/logo-photostream-resize.png');  

			$watermark_width = imagesx($watermark);  

			$watermark_height = imagesy($watermark);  

			$image = imagecreatetruecolor($watermark_width, $watermark_height);  

			//$image = imagecreatefromjpeg($source_file_path);  

			$size = getimagesize($source_file_path);
			
			 if ($size['mime'] === NULL) {
				return false;
			 }
			 switch ($size['mime']) {
				 case 'image/gif':
					$image = imagecreatefromgif($source_file_path);
				 break;
				 
				 case 'image/jpeg':
					$image = imagecreatefromjpeg($source_file_path);
				 break;
				 
				 case 'image/png':
					$image = imagecreatefrompng($source_file_path);
				 break;
				 
				 default:
				 return false;
			 }
			
			
			  

			$dest_x = $size[0] - $watermark_width - 5;  

			$dest_y = $size[1] - $watermark_height - 5;  

			imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, 50);  

			imagejpeg($image,$output_file_path);  


			imagedestroy($image);  

			imagedestroy($watermark);
			
			

	}
	
	public function getUnreadNotificationsCount(){
		$userid = $this->session->userdata('userid');
		$unread_count = $this->photomembernotifications->getnotificationsbyid($userid)->num_rows();
		
		if($unread_count > 0){
			
			echo $unread_count;
		
		}else{
		
			echo '0';
		}
		
	}
	
	public function getUnreadNotificatios(){
		
		
		$userid =  $this->session->userdata('userid');
		//$res = $this->membernotifications->getnotificationsbyid($userid);
		
		$res = $this->photomembernotifications->getmembernotificationsdashboard($userid,0);
		$data['notifications'] = $res;
		
		/*if($res->num_rows() > 0){
		
			foreach($res->result() as $notifications){
			
				echo "<div class='msg-cont'>
							<p class='ellipsis'>
									".$this->notificationsdata->getinfo('messsage','notification_id',$notifications->notification_id)."
							</p>
						</div>";

			}
		}else{
		
			echo '0';
		
		}*/
		
		$this->load->view('backend/dropdown_notifications',$data);
		
	
	
	
	}
	
	function setReadNotification(){
	
		$userid = $this->session->userdata('userid');
		$member_notif_array = array('read_notif'=>'1');
		$this->photomembernotifications->update2($userid,$member_notif_array);
	}
	
	function notificationpage(){
	
	
		if($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$user_avatar_id = $this->photousers->getinfo('avatar_id','userid',$userid);
			$data['user_avatar'] = $this->photopics->getinfo('filename','photo_id',$user_avatar_id);
			$data['stream_id'] = $this->uri->segment(3);
			$data['name'] = ucwords($this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid));	$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
			$data['title'] = "Notification page";
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$userid =  $this->session->userdata('userid');
		
		
			$res = $this->photomembernotifications->getmembernotifications($userid);
			$data['notifications'] = $res;
		
		
			$this->load->view('backend/notificationpage',$data);
		}else{
		
			redirect(base_url());
		}
	
	
	
	
	
	}
	
	

	
	
 
   
} // end of class