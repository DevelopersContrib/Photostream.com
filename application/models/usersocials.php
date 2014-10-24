<?php
class UserSocials extends CI_Model {
	private $table = "photo_user_socials";
	
	private $table2 = "photo_users";
	private $pk = "social_id";
	
	private $pk2 = "userid";
	
	private $fb_userid = "fb_userid";
	
	private $twitter_userid = "twitter_userid";
	private $date = null;

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
  
  function update($id,$data2){
     $query = $this->db->query("Select * from `$this->table` where $this->pk = '$id'"); 
	 if ($query->num_rows() > 0){
	     $this->db->where($this->pk, $id);
		 $this->db->update($this->table, $data2);
		 return $id;
	 } else {
	 	if ($this->date){
	 	  $this->db->set($this->date, 'NOW()', FALSE);
	 	}
	 	$this->db->insert($this->table, $data2);
	 	return $this->db->insert_id();
	 }
   }
  
   
  function delete($field,$value){
  	return $this->db->delete($this->table, array($field => $value)); 
  }
  
  
  function facebook_signup_form($user_profile2,$country,$id)
  {
	$data = array(
		'fb_userid' => $user_profile2['id'],
		'photo_users_country_id' => $country,
		'userid' => $id
	);
	
	$fb_id = $user_profile2['id'];
	
	$query = $this->db->query("Select * from `$this->table` where $this->fb_userid ='$fb_id'");
	
	if($query->num_rows > 0)
        {
            return;
        }
        else{
        $this->db->insert($this->table,$data);
        }
        return;
	



  }
  
  
  
  function facebook_exist($user_profile2)
  {
	$fb_id = $user_profile2['id'];
	$query = $this->db->query("Select * from `$this->table` where $this->fb_userid ='$fb_id'");
	if($query->num_rows > 0)
        {
            return 1;
        }
	else{
		return 0;
	}
  }
  
  function tweeter_exist($tweet_profile)
  {
	$tweeter_id = $tweet_profile->id;
	$query = $this->db->query("Select * from `$this->table` where $this->twitter_userid='$tweeter_id'");
	if($query->num_rows > 0)
	{
		return 1;
	}
	else{
		return 0;
	}
  }
  
  
  public function logintwitter($tweet_profile){
      $returnValue = false;
      $tweet_id = $tweet_profile->id;
      $query = $this->db->query("SELECT count(*) as count FROM `$this->table` WHERE `twitter_userid` = '".$tweet_id."'");
      if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
         {
           $count =  $row->count;
         }
     }
     if ($count > 0){
       $newdata = array(
                   'username'  => $tweet_profile->name,
		   'userid'     => $this->getinfo('userid','twitter_userid',$tweet_id),
                   'logged_in' => TRUE
               );

         $this->session->set_userdata($newdata);
        $returnValue = true;   
     }
    return $returnValue;
   
   }
   
   public function loginfb($user_profile2){
	
      $returnValue = false;
      $fb_id = $user_profile2['id'];
      $query = $this->db->query("SELECT count(*) as count FROM `$this->table` WHERE `fb_userid` = '".$fb_id."'");
      if ($query->num_rows() > 0){
        foreach ($query->result() as $row)
         {
           $count =  $row->count;
         }
     }
     if ($count > 0){
       $newdata = array(
                   'username'  => $fb_id,
		   'userid'     => $this->getinfo('userid','fb_userid',$fb_id),
                   'logged_in' => TRUE
               );

         $this->session->set_userdata($newdata);
        $returnValue = true;   
     }
    return $returnValue;
	
   }
  
  
  function sync_data()
  {
	$query = $this->db->query("UPDATE `$this->table`, `$this->table2` SET $this->table.$this->pk2 = (SELECT MAX($this->pk2) FROM $this->table2
				  where $this->table.$this->pk2 = '0')");
  }
  
  
  
  
	
}