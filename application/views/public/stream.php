<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stream extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('email');
        $this->load->model('photousers');
        $this->load->model('photostream');
        $this->load->database();
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			redirect('/stream/create');
		}else{
			redirect(base_url());
		}
	}
	
	public function create(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['title'] = "Dashboard - PhotoStream";
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$this->load->view('backend/create_stream',$data);
		}else {
			redirect(base_url());
		}
	}
	
	public function upload(){
		if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['title'] = "Dashboard - PhotoStream";
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			
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
			if($insert_id > 0){
				$data['stream_id'] = $insert_id;
				$data['stream_title'] = $title;
				$data['is_public'] = $is_public;
				
				$this->load->view('backend/upload',$data);
			}else{
				$data['upload_error'] = 1;
				$this->load->view('backend/upload',$data);
			}
			
		}else{
			redirect(base_url());
		}
	}
	
} // end of class