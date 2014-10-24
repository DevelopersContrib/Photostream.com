<?

 class Googleplus extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('openid');
        $this->load->library('gopenid');
        $this->load->database();
        $this->load->model('photousers');
        $this->load->library('curlclient');
        $this->load->model('photostream');
        $this->load->library('picasa');
        $this->load->library('session');
        $this->load->model('photofriends');
    }
    
    public function index(){
        
       
        //----------------------------------------------------------------------
        if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "Google Credentials";
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
				
			$data['user_streams'] = $this->photostream->getbyattribute('userid',$userid);
			
			$array_items = array('tw_access_token' => '', 'tw_status' => '');
			$this->session->unset_userdata($array_items);
			 $this->load->view('backend/google_auth',$data);
			
		}else{
			redirect(base_url());
		}
    }
    
    
    public function authentication(){
        
        
       
        
        $gmail = $this->input->post('email');
        $gpass = $this->input->post('password');
        
        
        //$email2 = $this->input->post('email');
          
        $data = array(
                'email' => $gmail,
                'password' => $gpass
            
        );
        
        $this->session->set_userdata($data);
        
        $mail = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        
        $this->picasa->auth($mail,$pass);
        
        $data['albums'] = $this->picasa->getAlbums($mail,$pass);
        $albums2 = $this->picasa->getAlbums($mail,$pass);
        
        //echo $mail;
        
        //$this->config->set_item('gmail',$mail);
        //$this->config->set_item('gpassword',$pass);
       // echo "1";
        $this->picasa_album();
        //$this->pics();
        
    }

    public function picasa_album(){
        
       
        
        //----------------------------------------------------------------------
         if ($this->session->userdata('logged_in')){
			$userid = $this->session->userdata('userid');
			$mail = $this->session->userdata('email');
                        $pass = $this->session->userdata('password');
                        $data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
			$data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
			$data['title'] = "Google Albums";
			$data['user_profile'] = 0;
			$data['user_profile2'] = 0;
				
			$data['user_streams'] = $this->photostream->getbyattribute('userid',$userid);
			
			$array_items = array('tw_access_token' => '', 'tw_status' => '');
			$this->session->unset_userdata($array_items);
			$data['albums'] = $this->picasa->getAlbums($mail,$pass);
                        $albums2 = $this->picasa->getAlbums($mail,$pass);
                        
                       // echo "<h1>".$albums2[0]['id']."</h1>";
                        
                        //$albumID = $albums2[0]['id'];
                        
                        
                        
                        
                       
                        //$data['pics'] = $this->picasa->getPhotos($albumID);
                        
                        
                        
                        $this->load->view('backend/picasa',$data);
			
		}else{
			redirect(base_url());
		}
        
        
        
    }
    
    public function pics(){
        
        
        //----------------------------------------------------------------------
        if ($this->session->userdata('logged_in')){
                $userid = $this->session->userdata('userid');
                $albumID = $this->uri->segment(3);
                $mail = $this->session->userdata('email');
                $pass = $this->session->userdata('password');
                $data['current_user_waiting'] = $this->photofriends->getWaitingInvites($userid);
                $data['name'] = $this->photousers->getinfobyid('firstname',$userid)." ".$this->photousers->getinfobyid('lastname',$userid);
                $data['title'] = "Google Photos";
                $data['user_profile'] = 0;
                $data['user_profile2'] = 0;
                        
                $data['user_streams'] = $this->photostream->getbyattribute('userid',$userid);
                
                
                //echo $mail;
                //$this->config->set_item('gmail',$mail);
                //$mail2 = $this->config->item('gmail');
                
               // echo "<h1>".$mail2."</h1>";
                $array_items = array('tw_access_token' => '', 'tw_status' => '');
                $this->session->unset_userdata($array_items);
               //echo "<h1>".$albumID."</h1>";
                $data['pics'] = $this->picasa->getPhotos($albumID,$mail,$pass);
                
                $pics = $this->picasa->getPhotos($albumID,$mail,$pass);
                
                $this->load->view('backend/picasa_pics',$data);
                
        }else{
                redirect(base_url());
        }
        
        
        
        
        
    }
    
    public function tester(){
        /*$openid->identity = 'https://www.google.com/accounts/o8/id';
        $openid->required = array(
            'namePerson/first',
            'namePerson/last',
            'contact/email',
            'namePerson/friendly',
        );
        $openid->returnUrl = 'http://photostream.com/trial2/login.php'
        
            $openid->authUrl();*/
        //------------------------------------------------------------------
        $this->openid->identity = 'https://www.google.com/accounts/o8/id';
        $this->openid->required = array(
            'namePerson/first',
            'namePerson/last',
            'contact/email',
            'namePerson/friendly'
        );
        $this->openid->returnUrl = 'http://beta.photostream.com/googleplus/login';
        $data['login'] = $this->openid->authUrl();
        $login = $this->openid->authUrl();
        echo anchor($login,'login');
    }
    
    public function login(){
        echo "test";
        
     
    //--------------------------------------------------------------------------
    
   /* if($this->gopenid->mode){
        if($this->gopenid->mode == 'cancel'){
            echo "User has canceled authentication";
        } elseif ($this->gopenid->validate()){
            $data = $this->gopenid->getAttributes();
            $email = $data['contact/email'];
            $first = $data['namePerson/first'];
            echo "Email: $email <br>";
            echo "First name : $first";
        } else {
            echo "The user has not logged in";
        }
    }else{
        echo "Go to index page to log in";
    }
    
    }  */
    }
   
    
 }
    
    
    
   
//}