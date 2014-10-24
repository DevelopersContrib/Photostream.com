<?

class Home extends CI_Controller{
    
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
    }
    
    
    function index(){
         if($query = $this->photocountry->getCountry())
        {
            $data['country'] = $query;
        }
        $this->load->view('public/index',$data);
    }
   
    
    
    public function signuppost()
    {
        $data['title'] = "Photostream Homepage";
        
        $this->form_validation->set_rules('firstname','First Name','trim|required');
	$this->form_validation->set_rules('lastname','Last Name', 'trim|required');
	$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
	$this->form_validation->set_rules('password','Password','trim|required|min_length[4]');
	$this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
        
        if($this->form_validation->run() == FALSE){
            $this->index();
        }
        else{
        $firstname = $this->db->escape_str($this->input->post('firstname'));
        $lastname = $this->db->escape_str($this->input->post('lastname'));
        $email = $this->db->escape_str($this->input->post('email'));
        $username = $this->db->escape_str($this->input->post('username'));
        $password = md5($this->db->escape_str($this->input->post('password')));
        $country = $this->db->escape_str($this->input->post('country'));
        $code = $this->photousers->generateCode();
        
        
        
        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'username' => $username,
            'country_id' => $country,
            'code' => $code
        );
        
        $id = $this->photousers->update(0,$data);
        
        if(!empty($id)){
            $this->photousers->SendNotification($email,$code);
            $data['message'] = "please check your email";
            
        }else{
            $data['message'] = "something went wrong in saving data.";
            
        }
        return $this->load->view('public/success',$data);
        }
        
    }
    
    
    
    
    public function verification(){
        $code= $this->uri->segment(3);
        //$data['test']= $this->uri->segment(3);
        $query = $this->photousers->getbyattribute('code',$code);
	$data['show_second_phase'] = 'no';
        if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
        {
           if ($row->is_verified==0){
               $memdata = array(
                                 'is_verified' => 1,
				 'code' => ''
                              );
              $this->photousers->update($row->userid,$memdata);
              $data['message'] = "<p>You successfuly verified your account. </p>";
              $data['userid'] = $row->userid;
	      $data['show_second_phase'] = 'yes';
          }else {
             $data['message'] = "<p>This account was already verified.</p>";
           } 
        }
      }else {
        $data['message'] = "<p>Account code does not exist.</p>";
      }
       
     $data['title'] = "Verification page";
     $this->load->view('public/verification', $data);
   }
   
    
    
   
    
    /*public function facebook(){
        
        $fb_confic = array(
            'appId' => $this->config->item('appID'),
            'secret' => $this->config->item('appSecret')
            
        );
        
        $this->load->library('facebook', $fb_config);
        
        $user = $this->facebook->getUser();
        
        if($user){
            try{
                $data['user_profile'] = $this->facebook->api('/me');
        } catach(FacebookApiException $e){
            $user = null;
        }
        
        if($user){
            $params = array('next' =>'url');
            $data['logout_url'] = $this->facebook->getLogoutUrl($params);
            
        }else{
            $data['login_url'] = $this->facebook->getLoginUrl(array('scopr' => 'user_photos'));
            
        }
        
    }*/
    
    
    public function checkExist(){
        $field = $this->db->escape_str($this->input->post('field'));
        $value = $this->db->escape_str($this->input->post('value'));
        if($this->photousers->checkexist($field,$value)===false){
            echo "ok";
        }else {
            echo $field." is already taken by another user. ";
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        $this->load->view();
    }
    
    function test(){
        $firstname = $this->db->escape_str($this->input->post('firstname'));
        
        echo $firstname;
    }
    
    public function loginUser(){
	$email =  $this->db->escape_str($this->input->post('email'));
	$password = $this->db->escape_str($this->input->post('password'));
	if ($this->photousers->LoginUser($email,$password)===true){
		echo "success";
	}else {
		echo 'Account does not exist, not yet verified, or not yet approved by admin.';
	    }
			
	}
    
    
    
    
    
}