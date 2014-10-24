<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlist extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('email');
		$this->load->model('photousers');
		$this->load->model('photostream');
		$this->load->model('photofriends');
		$this->load->model('photochallenge');
		$this->load->model('photopics');
		$this->load->model('photousers');
		$this->load->model('photoupdates');
		$this->load->model('picture');
		$this->load->model('photofriends');
		$this->load->database();
		$this->load->library('twconnect');
		$fb_config = array(
		       'appId'  => '303778466421063',
		       'secret' => '514d4d2ee10b04af53736a3547950fde',
		   );
	       $this->load->library('facebook', $fb_config);
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			$test = "exist";
			$this->load->view('backend/user_list',$data);
		}else {
			redirect(base_url());
			
		}
	}
	
	
		
		
		
	
	
}