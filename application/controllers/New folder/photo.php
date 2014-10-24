<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller {
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
		$this->load->database();
	}
	
	public function index(){
		if ($this->session->userdata('logged_in')){
			redirect(base_url().'dashboard');
		}else{
			redirect(base_url());
		}
	}
	
	public function comment(){
		if ($this->session->userdata('logged_in')){
			
			//DATA OF CURRENT USER VIEWING THE PHOTO
			$userid = $this->session->userdata('userid');
			$user_avatar_id = $this->photousers->getinfo('avatar_id','userid',$userid);
			$data['user_avatar'] = $this->photopics->getinfo('filename','photo_id',$user_avatar_id);
			$data['name'] = ucwords($this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid));			
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
					
			
			$photo_id = $this->uri->segment(3);
			
			if($this->photopics->checkexist('photo_id',$photo_id)===TRUE){
				
				//PHOTO DETAILS
				$data['success'] = true;
				$data['loved'] =  $this->picslikes->checkexist('photo_id',$photo_id,'userid',$this->session->userdata('userid'));
				$data['lovecnt'] = $this->picslikes->getcountbyattribute('photo_id',$photo_id);	
				$data['commentcnt'] = $this->piccomments->getcountbyattribute('photo_id',$photo_id);	
				$data['sharecnt'] = 0;	
				$photo = $this->photopics->getbyattribute('photo_id',$photo_id);
				foreach($photo->result() AS $info){
					$data['pic_id'] = $photo_id;
					$data['pic_title'] = $info->title;
					$data['pic_filename'] = $info->filename;
					$data['pic_date_uploaded'] = $info->date_uploaded;
					$data['stream_id'] = $info->stream_id;
					$data['stream_title'] = $this->photostream->getinfo('title','stream_id',$data['stream_id']);
					$data['stream_description'] = $this->photostream->getinfo('description','stream_id',$data['stream_id']);
					$data['stream_date'] = $this->photostream->getinfo('date_created','stream_id',$data['stream_id']);
				}
				
				//FETCH PHOTO COMMENTS
				$data['comments'] = $this->piccomments->getbyattribute('photo_id',$photo_id);
				
				
				//USER DATA OF PHOTO OWNER
				$user_userid = $this->photostream->getinfo('userid','stream_id',$data['stream_id']);
				$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
				$data['avatar'] = $this->photopics->getinfo('filename','photo_id',$avatar_id);
				$data['user_username'] = $this->photousers->getinfo('username','userid',$user_userid);
				$data['user_fname'] = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
				$data['user_lname'] = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
				$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
				
				
				$data['title'] = $data['user_fname']." ".$data['user_lname']." PhotoStream - ".ucwords($data['stream_title']);
				$this->load->view('backend/commentphoto',$data);
			
			}else{
				$data['title'] = "404 PhotoStream";
				$data['success'] = false;
				
				$this->load->view('backend/commentphoto',$data);
			}
			
		}else{
			redirect(base_url());
		}
	}
	
	public function addphotocomment(){
		if ($this->session->userdata('logged_in')){
			$photoID = $this->db->escape_str($this->input->post('photoID'));
			$userID = $this->db->escape_str($this->input->post('userID'));
			$comment = $this->db->escape_str($this->input->post('comment'));
			
			$insert_data = array('comment' => $comment,'photo_id' => $photoID,'userid' => $userID);
				
			$this->piccomments->update(0,$insert_data);
			
			echo 'ok';
			
		}else{
			echo 'error';
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
	
	public function timeline(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$user_userid = $this->photostream->getinfo('userid','stream_id',$stream_id);
		$avatar_id = $this->photousers->getinfo('avatar_id','userid',$user_userid);
		$avatar = $this->photopics->getinfo('filename','photo_id',$avatar_id);
		$user_username = ucwords($this->photousers->getinfo('username','userid',$user_userid));
		$user_fname = ucwords($this->photousers->getinfo('firstname','userid',$user_userid));
		$user_lname = ucwords($this->photousers->getinfo('lastname','userid',$user_userid));
		$album_pics = $this->photopics->getbyattribute('stream_id',$stream_id);
		$html = '';
		
		foreach($album_pics->result() AS $pic){
		
			
			$commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic->photo_id);
			$lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id);
			$loved =  $this->picslikes->checkexist('photo_id',$pic->photo_id,'userid',$this->session->userdata('userid'));
			$laps = abs((time() - strtotime($pic->date_uploaded)) / (60 * 60 * 24));	
			
			if(intval($laps)>0)
				$time = intval($laps).' days ago';
			else if($laps>=0.1)
				$time = intval($laps*10).' hours ago';
			else if($laps>=0.01)
				$time = intval($laps*100).' minutes ago';
			else
				$time = intval($laps*1000).' seconds ago';
			
			$html .= '<div class="fbstyl-brdrtop" style="margin-bottom: 10px;border:none;">';
			$html .= '	<div class="fbstyle-box" style="margin-top: 15px;">';
			$html .= '		<div class="row-fluid">';
			$html .= '			<div class="span12">';
			$html .= '				<div class="span1">';
			$html .= '					<img class="fbstyle-img" src="'.$avatar.'" style="height: 42px;width: 42px;">';
			$html .= '				</div>';
			$html .= '				<div class="span11" style="padding-top: 3px;">';
			$html .= '					<div class="row-fluid">';			
			$html .= '						<a href="'.base_url().''.$user_username.'" target="_blank" class="fbstyle-user-name" style="font-size: 12px">';
			$html .= '							<strong>'.$user_fname.' '.$user_lname.'</strong>';
			$html .= '						</a> ';
			$html .= '						&mdash; <span class="meta-fbstyle-addphts" style="font-size: 11px">added a photo. </span>';
			$html .= '						<span class="meta-fbstyle-hours" style="font-size: 11px">'.$time.'</span>';
			$html .= '						<span><p class="meta-fbstyle-desc">&quot;'.str_replace('_',' ',$pic->title).'&quot;</p></span>';
			$html .= '					</div>';
			$html .= '				</div>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '		<div class="row-fluid">';
			$html .= '			<center><img class="img-polaroid fb-content-img" src="'.$pic->filename.'" style="max-width:96%;width:auto;height:auto;"></center>';
			$html .= '		</div>';
			$html .= '		<div class="row-fluid" style="border-bottom: 1px solid #e9e9e9;">';
			$html .= '			<div style="padding-left: 3px;">';
			$html .= '				<span><a href="javascript:loveTimelinePhoto('.$pic->photo_id.','.$this->session->userdata('userid').');" class="meta-fbstyle-link"><span id="lovetl'.$pic->photo_id.'">'.'<img id="img'.$pic->photo_id.'" src="'.(($loved===TRUE)? base_url().'img/loves.png">': base_url().'img/love.png">').'</span></a></span>';
			//$html .= '				<span><a href="javascript:lovePhoto('.$pic->photo_id.','.$this->session->userdata('userid').')" class="meta-fbstyle-link"><span id="love'.$pic->photo_id.'">'.$lovecnt.'</span> <img id="img'.$pic->photo_id.'" src="'.base_url().($loved===TRUE)?'img/loves.png':'img/love.png'.'"></a></span>';
			$html .= '				<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>';
			$html .= '				<span><a href="javascript:;" class="meta-fbstyle-link"><img src="'.base_url().'img/share.png"></a></span>';
			$html .= '				<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226; </span>';
			$html .= '				<span><a href="'.base_url().'photo/comment/'.$pic->photo_id.'/'.url_title($pic->title).'" class="meta-fbstyle-link"><img src="'.base_url().'img/comment.png"></a></span>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '		<div class="row-fluid" style="margin-bottom: 5px;">';
			$html .= '			<div style="padding-left: 3px;">';
			$html .= '				<span class="meta-fbstyle-text">';
			$html .= '					<a href="javascript:;" class="meta-fbstyle-link"><span id="labeltl'.$pic->photo_id.'">'.$lovecnt.'</span> people</a> love this.';
			$html .= '				</span>';
			$html .= '				and';
			$html .= '				<span class="meta-fbstyle-text">';
			$html .= '					<a href="'.base_url().'photo/comment/'.$pic->photo_id.'/'.url_title($pic->title).'" target="_blank" class="meta-fbstyle-link">'.$commentcnt.' people</a> commented on this.';
			$html .= '				</span>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</div>';
			$html .= '</div>';
		}
		
		echo $html;
		
		
	}
	
	
	public function blogstyle(){
		$stream_id = $this->db->escape_str($this->input->post('stream_id'));
		$album_pics = $this->photopics->getbyattribute('stream_id',$stream_id);
		
	
		$html ='		<div style="border-left: 1px solid #e9e9e9;margin: 15px 10px; 10px; 10px;">';
		$html .='
		<style>
		.unlove{
			
		   background: url("http://www.beta.photostream.com/img/love.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    height: 17px;
    width: 18px;
		}
		.love{
			
		   background: url("http://www.beta.photostream.com/img/loves.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
    height: 17px;
    width: 18px;
		}
		</style>
		';
											
		foreach($album_pics->result() AS $pic){
		
			$commentcnt =  $this->piccomments->getcountbyattribute('photo_id',$pic->photo_id);
			$lovecnt =  $this->picslikes->getcountbyattribute('photo_id',$pic->photo_id);
			$loved =  $this->picslikes->checkexist('photo_id',$pic->photo_id,'userid',$this->session->userdata('userid'));	
				
			$html .='			<div class="row-fluid" style="border-bottom: 2px solid #534741;width: 85%;margin:auto; margin-bottom: 30px;padding-bottom: 4px;">';
			$html .='				<div class="span12">';
			$html .='					<div class="row-fluid">';
			$html .='						<div class="span12" style="text-align: center;">';
			$html .='							<img class="img-polaroid" src="'.$pic->filename.'">';
			$html .='						</div>';
			$html .='					</div>';
			$html .='					<div class="row-fluid" style="margin-top:5px;border-bottom: 1px solid #ccc;padding-bottom: 3px;">';
			$html .='						<div class="span12">';
			$html .='							<div class="row-fluid">';
			$html .='								<div class="span12">';
			$html .='									<div class="row-fluid">';
			$html .='										<div class="span1" style="margin:0;margin-right: 10px;">';
			$html .='											<span class="meta-blogstyle-date" style="float:left;font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 100%;color: #959595;">'.date('j',strtotime($pic->date_uploaded)).'</span>';										
			$html .='											<span class="meta-blogstyle-year" style="float:left;font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;padding-left: 5px;color: #959595;">'.date('My',strtotime($pic->date_uploaded)).'</span>';
			$html .='										</div>';
			$html .='										<div class="span11" style="margin:0">';
			$html .='										<div class="row-fluid" style="margin-top: 5px;">';
			$html .='												<div style="padding-left: 3px;line-height: 15px;">';
			$html .='													<span class="meta-fbstyle-text">';
			$html .='														&quot;'.str_replace('_',' ',$pic->title).'quot;';
			$html .='													</span>';
			$html .='												</div>';
			$html .='											</div>';
			$html .='											<div class="row-fluid" style="">	';																					
			$html .='												<div style="padding: 3px 0 0 3px;display: inline-block;">';
			$html .='													<span class="meta-fbstyle-text">';
			$html .='														<a href="javascript:;" class="meta-fbstyle-link"><span id="labeltl'.$pic->photo_id.'">'.$lovecnt.'</span> people</a> love this.';
			$html .='													</span>';
			$html .='													and';
			$html .='													<span class="meta-fbstyle-text">';
			$html .='														<a href="'.base_url().'photo/comment/'.$pic->photo_id.'/'.url_title($pic->title).'" target="_blank" class="meta-fbstyle-link">'.$commentcnt.' people</a> commented on this.';
			$html .='													</span>';
			$html .='												</div>';
			$html .='												<div style="padding-left: 3px;display: inline-block;float:right">';
			$html .= '				<span><a href="javascript:loveTimelinePhoto('.$pic->photo_id.','.$this->session->userdata('userid').');" class="meta-fbstyle-link"><span id="lovetl'.$pic->photo_id.'">'.
			
			//'<img id="img'.$pic->photo_id.'" src="'.(($loved===TRUE)? base_url().'img/loves.png">': base_url().'img/love.png">').
			'<div id="img'.$pic->photo_id.'" class ="'.(($loved===TRUE)? 'love"': 'unlove"').'></div>'.
			
			'</span></a></span>';
			$html .='													<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226;</span>';
			$html .= '				<span><a href="javascript:;" class="meta-fbstyle-link"><img src="'.base_url().'img/share.png"></a></span>';
			$html .='													<span style="font-size: 12px; font-weight: bold; color: #ccc;"> &#8226;</span>';
			$html .= '				<span><a href="'.base_url().'photo/comment/'.$pic->photo_id.'/'.url_title($pic->title).'" class="meta-fbstyle-link"><img src="'.base_url().'img/comment.png"></a></span>';
			$html .='												</div>';
			$html .='											</div>	';																				
			$html .='										</div>';
			$html .='									</div>';
			$html .='								</div>';
			$html .='							</div>';
			$html .='						</div>';
			$html .='					</div>';
			$html .='				</div>';
			$html .='			</div>';
										
		}
										
		$html .='		</div>';
										
		echo $html;
	}
	
	
 
   
} // end of class