<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Search extends CI_Controller {	function __construct()	{		parent::__construct();		$this->load->helper(array('form', 'url'));		$this->load->helper('html');		$this->load->library('session');        $this->load->model('photousers');        $this->load->model('photostream');        $this->load->model('photopics');	$this->load->model('photofriends');        $this->load->database();	}		private $per_page = 20;		public function index(){		if($this->session->userdata('logged_in')){			$userid = $this->session->userdata('userid');			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);			//$key = $this->uri->segment(3);			$key = $this->db->escape_str($this->input->post('header_search_key'));						$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);			$data['title'] = "PhotoStream - Search ".$key;			$data['user_profile'] = 0;			$data['user_profile2'] = 0;			$data['key'] = $key;			$per_page = $this->per_page;			$data['current_page'] = 1;						$data['search_results'] = $this->db->query("SELECT `photo_pics`.*,`photo_stream`.`title` AS `stream_title`,`photo_stream`.`userid` FROM `photo_pics`,`photo_stream`			WHERE `photo_stream`.`is_public` = '1' AND `photo_pics`.`stream_id` = `photo_stream`.`stream_id` AND `photo_pics`.`title` LIKE '%".$key."%' ORDER BY `photo_id` DESC LIMIT 0,".$per_page." ");						$get_count = $this->db->query("SELECT `photo_pics`.*,`photo_stream`.`title`,`photo_stream`.`userid` FROM `photo_pics`,`photo_stream`			WHERE `photo_stream`.`is_public` = '1' AND `photo_pics`.`stream_id` = `photo_stream`.`stream_id` AND `photo_pics`.`title` LIKE '%".$key."%' ORDER BY `photo_id` DESC ");						/*$data['search_results'] = $this->db->query("SELECT `photo_pics`.*,`photo_stream`.`userid` FROM `photo_pics`,`photo_stream`			WHERE `photo_stream`.`is_public` = '1' AND `photo_pics`.`stream_id` = `photo_stream`.`stream_id` ORDER BY `photo_id` DESC LIMIT 0,".$per_page." ");						$get_count = $this->db->query("SELECT `photo_pics`.*,`photo_stream`.`userid` FROM `photo_pics`,`photo_stream`			WHERE `photo_stream`.`is_public` = '1' AND `photo_pics`.`stream_id` = `photo_stream`.`stream_id`");*/						$data['per_page'] = $per_page;			$data['results_count'] = $get_count->num_rows();									$this->load->view('backend/search_pics',$data);					}else{			redirect(base_url());		}	}		public function getnextpage(){		$key = $this->db->escape_str($this->input->post('key'));		$page = $this->db->escape_str($this->input->post('page'));				$per_page = $this->per_page;				$start = ($page * $per_page) - $per_page;				$search_results = $this->db->query("SELECT `photo_pics`.*,`photo_stream`.`title` AS `stream_title`,`photo_stream`.`userid` FROM `photo_pics`,`photo_stream`			WHERE `photo_stream`.`is_public` = '1' AND `photo_pics`.`stream_id` = `photo_stream`.`stream_id` AND `photo_pics`.`title` LIKE '%".$key."%' ORDER BY `photo_id` DESC LIMIT $start,".$per_page);					foreach($search_results->result() AS $result){			echo '<a href="'.base_url().'stream/album/'.$result->stream_id.'">						<li>							<img src="'.$result->filename.'" alt="'.$result->title.'" />							<p>'.$result->title.'</p>						</li>				  </a>';		}		}	}?>