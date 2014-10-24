<?php

class Upload extends CI_Controller {

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
		$this->load->database();
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			redirect(base_url().'dashboard');
		}else{
			redirect(base_url());
		}
	}

	
	
	
	
}
?>