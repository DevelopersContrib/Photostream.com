<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pinterest extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->library('instagram_api');
		$this->load->library('session');
		$this->load->library('curlclient');
		$this->load->model('photofriends');
		
		$this->load->model('photousers');
        $this->load->model('photostream');
		$this->load->model('photopics');
        $this->load->database();
	}
	
	public function index(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			
			//-------------------------------------------------------------------------
			
			$number = $this->photofriends->getWaitingInvites($userid);
			if($number->num_rows() == 0)
			{
				$data['title'] = "PhotoStream - Import from pinterest";
			}
			else{
			$data['title'] = '('.$number->num_rows().') PhotoStream - Import from pinterest';
			}
			
			
			
			
			//--------------------------------------------------------------------------
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['user_profile'] = 0;
				
			$this->load->view('backend/pinterest_index',$data);
			
		}else {
			redirect(base_url());
		}
		
	}
	
	public function getphotos(){
	
		if ($this->session->userdata('logged_in')){
			if($this->input->post('link')){
				$link = str_replace('/pins/','/pins',$this->input->post('link'));
				$api_url = str_replace('pinterest.com','pinterestapi.co.uk',$link);
				
				$userid = $this->session->userdata('userid');
				$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
				$data['title'] = "PhotoStream - Import from pinterest";
				$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
				$data['user_profile'] = 0;
				
				//$api_url = "http://pinterestapi.co.uk/ennaapee/pins";
				
				$url = $api_url;
				$this->curlclient->get($url);
				$result = $this->curlclient->currentResponse('body');
				$res = json_decode($result,true);
				$i=0;
				
				
				if($res != NULL){
				foreach($res["body"] as $pins){
				
					$photos[$i]=array("url"=>str_replace('192x','736x',$pins["src"]),"title"=>$pins["desc"]);
					
					//$photos['url'][$i] = str_replace('192x','736x',$pins["src"]);
					//$photos['title'][$i] = $pins["desc"];
					$i++;
				}
				$data['photos'] = $photos;
				}else{
					$data['photos'] = 0;
				
				}
				
				
				$this->load->view('backend/pinterest_data',$data);
			}else{
				redirect(base_url().'pinterest');
			}
		}
		else {
			redirect(base_url());
		}		
	
	}
		
	public function savephotos(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$url = $this->db->escape_str($this->input->post('url'));
			$title = $this->db->escape_str($this->input->post('title'));
			$stream_id = $this->input->post('stream_id');
		
			$data = array('title'=> $title,'filename'=> $url,'stream_id' => $stream_id,'social_id' => '6' );
			$this->photopics->update(0,$data);
			
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