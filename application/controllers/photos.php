<?
class Photos extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('photousers');
        $this->load->model('photocountry');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('usersocials');
        $this->load->model('photostream');
        $this->load->model('photopics');
    }
    
    
    function facebook(){
        $fb_config = array(
            'appId'  => '303778466421063',
            'secret' => '514d4d2ee10b04af53736a3547950fde',
            'redirect_uri' => 'photostream/beta2/index.php/home/loginUser'
        );
        $this->load->library('facebook', $fb_config);
        //$this->load->model;

        $user = $this->facebook->getUser();
        
        $data['app'] = $this->facebook->getAppId();
        

        if ($user) {
            try {
                //$this->load->model('users_model');
                $data['user_profile'] = $this->facebook->api('/me');
                $data['photos'] = $this->facebook->api('/me/albums?fields=photos');
                $data['albums'] = $this->facebook->api('/me/albums');
                $user_profile2 = $this->facebook->api('/me');
                
                
                $data['test'] = $this->usersocials->facebook_exist($user_profile2);
                
                //$data3 = $data2

                //$data = array()
               
                /*$this->load->model('users_model');*/
                //$this->load->
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } 

        if ($user) {
            $params = array('next' => 'http://www.photostream.com/beta2/index.php/home/fb_logout');
            $data['logout_url'] = $this->facebook->getLogoutUrl($params);
            
            //$this->load->view('test2',$data);
        } else {
            $params = array('scope' => 'user_photos');
            $data['login_url'] = $this->facebook->getLoginUrl($params);
        }
         $this->load->view('public/header',$data);
         
         
    }
    
    
    
     function index(){
        
        if ($this->session->userdata('logged_in')){
			 $id = $this->session->userdata('userid');
			 $data['title'] = "Developers Dashboard Page";
			 $data['name'] = $this->photousers->getinfo('firstname','userid',$id)." ".$this->photousers->getinfo('lastname','userid',$id);
			 $data['keyword'] = "";
                         
                       
                        
                         if($query = $this->photostream->get_all($id))
                        {
                        $data2 = $query;
                        }
                        
                        if(isset($data2)):foreach ($data2 as $row):
                        
                        
                         $id2 = $row->stream_id;
                         break;
                         
                         endforeach;
                         
                         else:
                         $id2 = 0;
                         endif;
                        
                        
                         $data['exist'] = $this->photopics->get_rows($id2);
                         
                         if($query = $this->photopics->get_stream($id2))
                         {
                         $data['get_stream'] = $query;
                         }
                        
                        
                         
			$this->load->view('backend/dashboard',$data);
	}else{
         if($query = $this->photocountry->getCountry())
        {
            $data['country'] = $query;
        }
          /*$this->load->model('users_model');
        
        
         if($query = $this->users_model->get_app_id())
        {
            $data2 = $query;
        }
        
        if(isset($data2)) : foreach($data2 as $row) :
        //$data['app_id'] = $row->app_id;
        $app_id = $row->app_id;
        //$data['app_secret'] = $row->app_secret;
        $app_secret = $row->app_secret;
        
        
        endforeach;
        
        else:
        //none
        
        endif;
        
        

        
         //$this->config->set_item('appID',$this->input->post('appId'));
         $this->config->set_item('appID',$app_id);
         $this->config->set_item('appSecret',$app_secret);*/
        //$this->config->set_item('appSecret',$this->input->post('appSecret'));
        
        
       

       $this->facebook();
       $this->load->view('public/index',$data);
        
        
        }
        
    }
    
    
    



    public function view_photos(){
        
         $field = "title";
            $id = $this->session->userdata('userid');
            $data['title'] = "Developers Dashboard Page";
            $data['name'] = $this->photousers->getinfo('firstname','userid',$id)." ".$this->photousers->getinfo('lastname','userid',$id);
            $data['keyword'] = "";
            
             $fb_config = array(
            'appId'  => '303778466421063',
            'secret' => '514d4d2ee10b04af53736a3547950fde',
            'redirect_uri' => 'photostream/beta2/home/loginuser'
        );
        $this->load->library('facebook', $fb_config);
        //$this->load->model;

        $user = $this->facebook->getUser();
        
        $data['app'] = $this->facebook->getAppId();
        

        if ($user) {
            try {
                //$this->load->model('users_model');
                $data['user_profile'] = $this->facebook->api('/me');
                $data['photos'] = $this->facebook->api('/me/albums?fields=photos');
                $data['albums'] = $this->facebook->api('/me/albums');
                $user_profile2 = $this->facebook->api('/me');
                
                
                $data['test'] = $this->usersocials->facebook_exist($user_profile2);
                
                //$data3 = $data2

                //$data = array()
               
                /*$this->load->model('users_model');*/
                //$this->load->
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } 

        if ($user) {
            $params = array('next' => 'http://www.photostream.com/beta2/home/fb_logout');
            $data['logout_url'] = $this->facebook->getLogoutUrl($params);
            
            //$this->load->view('test2',$data);
        } else {
            $params = array('scope' => 'user_photos','next' => 'http://www.photostream.com/beta2/home/fb_login');
            $data['login_url'] = $this->facebook->getLoginUrl($params);
        }
            
            
             if($query = $this->photostream->get_all($id))
            {
            $data2 = $query;
            }
            
            $id2 = $this->uri->segment(3);
            
            $data['segment'] = $this->uri->segment(3);
            
            
            
             $data['exist'] = $this->photopics->get_rows($id2);
             
             if($query = $this->photopics->get_stream($id2))
             {
             $data['get_stream'] = $query;
             }

        $this->load->view('backend/photos',$data);
        
        
        
    }
    
    public function delete_photo(){
        $value = $this->uri->segment(3);
        $field = "photo_id";
        $this->photopics->delete($field,$value);
    
    }
    
    
    
    
    
    
}