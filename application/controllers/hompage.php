<?php
class HomePage extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('photousers');
        $this->load->model('photocountry');
        $this->load->library('form_validation');
        $this->load->model('usersocials');
        $this->load->model('photostream');
        $this->load->model('photopics');
        $fb_config = array(
            'appId'  => '303778466421063',
            'secret' => '514d4d2ee10b04af53736a3547950fde'
        );
        $this->load->library('facebook', $fb_config);
        $this->load->database();
    }
    
    public function index(){
    	    $data['title'] = "PhotoStream Homepage";
    	    $this->load->view('homepage/index',$data);
   }
   
   
}    