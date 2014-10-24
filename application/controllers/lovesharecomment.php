<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lovesharecomment extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('instagram_api');
		$this->load->library('twconnect');
		$this->load->model('photousers');
		$this->load->model('photostream');
		$this->load->model('photopics');
		$this->load->library('curlclient');
		$this->load->model('photosocials');
		$this->load->model('picslikes');
		$this->load->database();
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			redirect(base_url().'dashboard');
		}else{
			redirect(base_url());
		}
	}
	
	public function likephoto(){
		if ($this->session->userdata('logged_in')){
			$photoID = $this->db->escape_str($this->input->post('photoID'));
			$userID = $this->db->escape_str($this->input->post('userID'));
			
			
			if($this->picslikes->checkexist('photo_id',$photoID,'userid',$userID)===FALSE){
			
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
	

   
} // end of class