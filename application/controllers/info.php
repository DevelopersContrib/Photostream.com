<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
	}
	
	public function index(){
		redirect('/info/about');
	}
	
	public function about(){
		$data['title'] = "PhotoStream.com - About";
		$this->load->view('public/about',$data);
	}
	
	public function terms_and_condition(){
		$data['title'] = "PhotoStream.com - Terms and Condition";
		$this->load->view('public/terms_and_condition',$data);
	}
	
	public function privacy_policy(){
		$data['title'] = "PhotoStream.com - Privacy Policy";
		$this->load->view('public/privacy_policy',$data);
	}
	public function contact_us(){
		$data['title'] = "PhotoStream.com - Contact Us";
		$this->load->view('public/contact_us',$data);
	}
	
	public function services(){
		$data['title'] = "PhotoStream.com - Services";
		$this->load->view('public/services',$data);
	}
	
	public function partnership(){
		$data['title'] = "PhotoStream.com - Partnership";
		$this->load->view('public/partnership',$data);
	}

}//end of class
?>