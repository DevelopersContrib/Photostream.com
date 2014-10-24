<?
class Google extends CI_Controller
{
    public function index(){
       if ($this->session->userdata('logged_in')){
			
				$userid = $this->session->userdata('userid');
				$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
				$data['title'] = "PhotoStream - Edit Account Settings - ".$data['name'];
				$data['user_profile'] = 0;
				$data['user_profile2'] = 0;
					
					
				echo "test";
			
		}else{
			redirect(base_url());
		}
    }
    
}


?>