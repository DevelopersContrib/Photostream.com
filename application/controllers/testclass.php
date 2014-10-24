<?
class Testclass extends CI_Controller
{
    function __construct(){
        parent::__construct();
       // $link  = 'photostream.com/trial2';
        $this->load->library('openid');
    }
    
    public function index(){
        if($this->openid->mode){
            if($this->openid->mode == 'cancel'){
                echo "User canceled authentication";
            }elseif($this->openid->validate()){
                $data = $this->openid->getAttributes();
                $email = $data['contace/email'];
                $first = $data['namePerson/first'];
                echo "Email : $email <br>";
                echo "First name : $first";
            }else{
                 echo "The user has not logged in";
            }
        }else{
            echo "Go to index page to log in.";

        }
        
        
    }
    
    public function login(){
    }
    
    
    
   
}