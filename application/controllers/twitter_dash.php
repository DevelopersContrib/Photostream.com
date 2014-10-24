<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter_dash extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('twconnect');
    }
    
    public function twitter_dashboard(){
		$ok = $this->twconnect->twprocess_callback();
		if ( $ok ) { $this->twconnect->twaccount_verify_credentials();
				$data['tweet_profile'] = $this->twconnect->tw_user_info;
				$tweet_profile = $this->twconnect->tw_user_info;
				$data['user_profile'] = 1;
				$data['user_profile2'] = 1;
				$this->load->view('backend/dashboard',$data); }
			else redirect ('twtest/failure');
    }
    
    public function tweeter_logout_dum() {

		$this->session->sess_destroy();

		redirect('twitter_dash/redirect');
		
	}
	
	public function redirect() {
		$ok = $this->twconnect->twredirect('twitter_dash/twitter_dashboard');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}
    
    



    
    
}