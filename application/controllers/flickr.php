<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flickr extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('curlclient');
		
		$this->load->model('photousers');
        $this->load->model('photostream');
        $this->load->model('photopics');
        $this->load->model('flickrdata');
		$this->load->model('photoupdates');
		$this->load->model('photofriends');
        $this->load->database();
	}
	
	public function index(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['title'] = "PhotoStream - Import from Flickr";
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['user_profile'] = 0;
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			//---------------------------------------------------------
	
	
			$number = $this->photofriends->getWaitingInvites($userid);
				if($number->num_rows() == 0)
				{
					$data['title'] = "Flickr Photos - PhotoStream";
				}
				else{
				$data['title'] = '('.$number->num_rows().') Facebook Photos - PhotoStream';
				}
	
	
	
			//---------------------------------------------------------
			
			
			
			
			$frob = $this->input->get('frob');
			$method = 'flickr.auth.getToken';
			
			if($frob){
				
				$res = $this->flickrdata->GetUserInfo($method,$frob);
				
				if($res["stat"]!='fail'){
				
					$data['status'] = true;
					$data['username'] = $res["auth"]["user"]["username"];
					$data['fullname'] = $res["auth"]["user"]["fullname"];
					
					$nsid = $res["auth"]["user"]["nsid"];
					$method = "flickr.photos.search";
					
					$photos = $this->flickrdata->GetPhotos($method,$nsid);
					//var_dump($photos);
					$i=0;
					
					foreach($photos["photos"]["photo"] as $photo){
						
						$photoID = $photo["id"];
						$farmID = $photo["farm"];
						$serverID = $photo["server"];
						$secretID = $photo["secret"];
						
						$photo['id'] = $photoID;
						$photo['title'] = $photo["title"];
						$photo['url'] = 'http://farm'.$farmID.'.staticflickr.com/'.$serverID.'/'.$photoID.'_'.$secretID.'_b.jpg';
						
						$data['photos'][$i] = $photo;
						$i++;
					}
				}else{
					$data['status'] = false;
				}
			}else{
				$data['status'] = false;
			}	
			
			$this->load->view('backend/flickr_index',$data);
			
		}else {
			redirect(base_url());
		}
		
		
	}
	
	public function savephotos(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			//$id = $this->input->post('id');
			$url = $this->db->escape_str($this->input->post('url'));
			$title = $this->db->escape_str($this->input->post('title'));
			$stream_id = $this->input->post('stream_id');
			$message = 'uploaded photo from flickr';
		
			$data = array('title'=> $title,'filename'=> $url,'stream_id' => $stream_id,'social_id' => '6' );
			$insert_id = $this->photopics->update(0,$data);
			
			$slug = url_title($this->photostream->getinfobyid('title',$stream_id));
			$link = '/photo/comment/'.$slug.'/'.$insert_id;
			//$link = '/photo/comment/'.$insert_id;
			
			$data2 = array('userid'=>$userid,'message'=>$message,'link' => $link,'stream_id' => $stream_id);
			
			$this->photoupdates->update(0,$data2);
			
			$cover_pic = $this->photostream->getinfobyid('cover_pic',$stream_id);
			
			if($cover_pic==''){
				$cover_id = $this->photopics->getinfo('photo_id','filename',$url);
				$stream_update = array('cover_pic' => $cover_id);
				$saved = $this->photostream->update($stream_id,$stream_update);
				$this->session->unset_userdata('stream_id');
			}
			
			echo "OK";
		
		}else{
			redirect(base_url());
		}
	}
	

	
}// end of class

?>