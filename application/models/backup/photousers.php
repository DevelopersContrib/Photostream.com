<?php

class PhotoUsers extends CI_Model {
	private $table = "photo_users";
	private $pk = "userid";
	private $date = 'date_signedup';

	public function checkexist($field,$value,$field2=null,$value2=null){
     $returnValue = false;
     if ($field2 && $value2){
     	$query = $this->db->query("SELECT count(*) as count FROM `$this->table` WHERE `$field` = '".$value."' AND  `$field2` = '".$value2."'");
     }else {
      $query = $this->db->query("SELECT count(*) as count FROM `$this->table` WHERE `$field` = '".$value."' ");
     }  
      if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
         {
           $count =  $row->count;
         }
     }
     if ($count > 0){
        $returnValue = true;   
     }
    return $returnValue;
	}
	
	
	public function getinfo($field1,$field2,$value){
	      $v = "";
	      $query = $this->db->query("SELECT $field1 as val FROM `$this->table` WHERE `$field2` = '".$value."' ");
	      if ($query->num_rows() > 0){
	        foreach ($query->result() as $row)
	         {
	           $v =  $row->val;
	         }
	     }
	     
	    return $v;
	  }
	  
  public function getinfobyid($field,$id){
     $returnValue = ""; 
     $query = $this->db->query("SELECT `$field` as val from $this->table where $this->pk=$id");
      if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
         {
           $returnValue =  $row->val;
         }
       }
      return $returnValue;
    }
	
  function getbyattribute($key,$value,$key2=null, $value2=null){
  	if (($key2) && ($value2)){
  		 return  $this->db->query("SELECT * FROM $this->table where `$key` = '".$value."' AND `$key2` = '".$value2."'");
  	}else {
  	  return  $this->db->query("SELECT * FROM $this->table where `$key` = '".$value."'");
  	}
  }
  
  
   function getcountbyattribute($key,$value,$key2=null,$value2=null){
  	if ($key2 && $value2){
  		  $query = $this->db->query("Select count(*) as total from $this->table where `$key` = '".$value."' AND `$key2` = '".$value2."'");
  	}  else {
   	   $query = $this->db->query("Select count(*) as total from $this->table where `$key` = '".$value."' ");
  	}
     if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
         {
           $total =  $row->total;
         }
      }
      return $total;
  }
  
  function update($id,$data){
     $query = $this->db->query("Select * from `$this->table` where $this->pk = '$id'"); 
	 if ($query->num_rows() > 0){
	     $this->db->where($this->pk, $id);
		 $this->db->update($this->table, $data);
		 return $id;
	 } else {
	 	if ($this->date){
	 	  $this->db->set($this->date, 'NOW()', FALSE);
	 	}
	 	$this->db->insert($this->table, $data);
	 	return $this->db->insert_id();
	 }
   }
  
   
  function delete($field,$value){
  	return $this->db->delete($this->table, array($field => $value)); 
  }
  
   public function generateCode ($length = 8)
  {
    $code = "";
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
    $maxlength = strlen($possible);
    if ($length > $maxlength) {
      $length = $maxlength;
    }
    $i = 0; 
    while ($i < $length) { 
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
      if (!strstr($code, $char)) { 
        $code .= $char;
        $i++;
      }

    }
    return $code;

  }
  
  public function SendNotification($email,$code){
      $config['wordwrap'] = TRUE;
      $config['mailtype'] = "html";
      $this->email->initialize($config);
  	  $url = base_url()."signup/verification/$code";
      $subject = "PhotoStream Account Verification";
      $message = 'Hello there!, <br><br>
	Thank you for your signing up in photostream.com.<br> Please <a href="'.$url.'">confirm</a> this email to experience photostream.com.
	Thanks and have a great day.
	<br><br>
	Seph al<br> 
	photostream.com<br><br>
      ';
	 $data = array('date_today' => date("M d, Y"),
       'message' => $message
       );
      //$msg .= ;
      $msg = $this->load->view('public/email_template',$data,true);
      $emailmessage = wordwrap($msg);
      $this->email->from('admin@photostream.com','Photostream Developer Admin');
      $this->email->to($email);
      $this->email->subject($subject);
      $this->email->message($emailmessage);
      $this->email->send();
       
  }    public function generateRandomString($length = 10) {		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';		$randomString = '';		for ($i = 0; $i < $length; $i++) {			$randomString .= $characters[rand(0, strlen($characters) - 1)];		}		return $randomString;	}      public function sendLoginDetails($email,$password,$firstname){		  $secret_code = $this->generateRandomString(10);	  $userid = $this->getinfo('userid','email',$email);		$new_password_code_data = array('password' => $secret_code); 		$this->update($userid,$new_password_code_data);      	  $config['wordwrap'] = TRUE;	  $config['mailtype'] = "html";      $this->email->initialize($config);	  $subject = "PhotoStream Login Details";      $message = 'Hello '.$firstname.', <br><br>			You can reset your password <a href="'.base_url().'login/reset_password">here</a>.			Please use the following as your secret code to reset your password:			<br>			<strong>'.$secret_code.'</strong>			<br>			<br>	Seph al<br> 	photostream.com<br><br>      ';	 $data = array('date_today' => date("M d, Y"),       'message' => $message       );      //$msg .= ;      $msg = $this->load->view('public/email_template',$data,true);      $emailmessage = wordwrap($msg);      $this->email->from('admin@photostream.com','Photostream Developer Admin');      $this->email->to($email);      $this->email->subject($subject);      $this->email->message($emailmessage);      $this->email->send();  }  
  
   public function LoginUser($email,$password){
      $returnValue = false;
      $query = $this->db->query("SELECT count(*) as count FROM `$this->table` WHERE `email` = '".$email."' AND password='".$password."' AND is_verified='1'");
      if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
         {
           $count =  $row->count;
         }
     }
     if ($count > 0){
        $newdata = array(
                   'username'  => $this->getinfo('username','email',$email),
                   'userid'     => $this->getinfo('userid','email',$email),
                   'logged_in' => TRUE
               );

         $this->session->set_userdata($newdata);
        $returnValue = true;   
     }
    return $returnValue;
   
   }
   
   /*public function LoginFb($user_profile)
   {
	$newdata = array(
		'username' => $user_profile['name'],
		'logged_in' => TRUE
	);
	$this->session->set_userdata($newdata);
	$returnValue = true;
   }*/
   
   public function email_exist($email){
	$query = $this->db->query("Select * from `$this->table` where email='$email'");
	if($query->num_rows > 0 ){
		return 1; 
	}
	else{
		return 0;
	}
   }
   
   public function username_exist($username){
	$query = $this->db->query("Select * from `$this->table` where username='$username'");
	if($query->num_rows > 0){
		return 1;
	}
	else{
		return 0;
	}
   }
  
  public function match($search_key){	return $this->db->query("SELECT * FROM `$this->table` WHERE MATCH(firstname,lastname,email,username) AGAINST('".$search_key."') ");  }    public function getall(){	return $this->db->query("SELECT * FROM `$this->table` WHERE `is_verified` = '1' ORDER BY RAND()");  }
  
	
} // end of class