<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->library('curlclient');
		$this->load->library('email');
        $this->load->model('photousers');
        $this->load->model('photostream');
        $this->load->model('photopics');
        $this->load->model('photosocials');
        $this->load->database();
	}
	
	public function oauth(){
		
			$oauth_token='Fis441u2AoE5Sa7SgK1JWRYXoCXmMFZMUlyCSLSU';
			//$oauth_token='49571712-RXT484kdXDFCNluz6lv7wWfeT5ZwzReEzaU4i2S8';
						  
			echo anchor('https://api.twitter.com/oauth/authenticate?oauth_token='.$oauth_token,'Login to twitter');
			
		
		//echo '<a href="https://api.twitter.com/oauth/request_token?oauth_callback=".base_url()."/twitter/oauth"> LOGIN TO TWITTER</a>';
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "Dashboard - PhotoStream";
			$data['user_profile'] = 0;
				
			
				 /*$link = $this->input->post('link');
				  
				 for($i = 1; $i < 10; $i++){ //160 because twitter returns only max of 3200 status updates, 20 each call.
					
				  $api_url = "https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=sheinavi&include_entities=true&page=".$i;
				   
				   $url = $api_url;
				   $this->curlclient->get($url);
				   $result = $this->curlclient->currentResponse('body');
				   $res = json_decode($result,true);
				   $html = '';
				   
					foreach($res AS $r){
						if(isset($r['entities'])){
							foreach($r['entities'] AS $e){
								
								if(isset($e[0]["media_url"])){
										$html .= '<li><img src="'.$e[0]['media_url'].'" /></li>';	
								}
							}
						}
					}
				 }
				 
					$data['gallery'] = $html;*/
  
			
			$this->load->view('backend/twitter_index',$data);
			
		}else{
			redirect(base_url());
		}
	}
	
	public function test(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "Dashboard - PhotoStream";
			$data['user_profile'] = 0;
				
			
				 $link = $this->input->post('link');
				  
					
					   $api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=sheinavi&include_entities=true&count=20";
					   
					   $url = $api_url;
					   $this->curlclient->get($url);
					   $result = $this->curlclient->currentResponse('body');
					   $res = json_decode($result,true);
					   
					   var_dump($res);
					   
						/*foreach($res AS $r){
							
								foreach($r['entities'] AS $e){
									
									var_dump($e);
									echo "<br><br>";
									
								}
							
						}*/			
				
		}else{
			redirect(base_url());
		}
	}
	
	public function getGalleryContents(){
			$twitter_username = $this->db->escape_str($this->input->post('twitter_username'));
	
					
				  $api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=".$twitter_username."&include_entities=true&count=200";
				   
				   $url = $api_url;
				   $this->curlclient->get($url);
				   $result = $this->curlclient->currentResponse('body');
				   $res = json_decode($result,true);
				 
				   
					foreach($res AS $r){
						if(isset($r['entities'])){
							foreach($r['entities'] AS $e){
								
								if(isset($e[0]["media_url"])){
										//echo '<li><img src="'.$e[0]['media_url'].'" /></li>';	
									echo '<div class="gallery-grid">
											<div class="imgholder">
											 <img src="'.$e[0]['media_url'].'" />
											</div>
											<div class="meta">'.$r['text'].'</div>
										   </div>';
								}
							}
						}else if(isset($r['errors'])){
							echo "The username ".$twitter_username." does not exist.";
						}else if(isset($r['error'])){
							echo "This user does not authorize access.";
						}
					}
				
	}
	
} // class end	
?>