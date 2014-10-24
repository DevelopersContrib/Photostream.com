<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('email');
        $this->load->model('photousers');
		$this->load->model('photofriends');
		$this->load->model('photousers');
        $this->load->database();
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			
				 header ("Location: ".base_url()."dashboard");
				exit; 
			
			
		}else {
			$data['title'] = "Photo Stream - Stream your life";
			$this->load->view('public/index',$data);
		}
	}
	
	public function not(){
	
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['user'] = $userid;
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
			
			
		}else {
			$data['title'] = "Photo Stream - Stream your life";
			$this->load->view('public/index',$data);
		}
	
	}
	
	
}