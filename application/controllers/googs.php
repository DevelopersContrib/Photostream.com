<?
class Googs extends CI_Controller
{
    function __construct(){
        parent::__construct();
       // $link  = 'photostream.com/trial2';
        $this->load->library('openid');
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
        $this->load->view('backend/google_auth',$data);
    }
    
    public function login(){
        echo "test";
        
        
        
    }
}