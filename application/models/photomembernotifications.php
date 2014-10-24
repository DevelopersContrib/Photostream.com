<?php
class PhotoMemberNotifications extends CI_Model {
	private $table = "photo_MemberNotifications";
	private $pk = "member_notification_id";
	private $userid = "userid";

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
	
	
	public function getinfo($field1,$field2,$value, $field3=null, $value3=null){
	      $v = "";
	      if ($field3 && $value3){
	      	$query = $this->db->query("SELECT $field1 as val FROM `$this->table` WHERE `$field2` = '".$value."' AND  `$field3` = '".$value3."'");
	      }else {
	        $query = $this->db->query("SELECT $field1 as val FROM `$this->table` WHERE `$field2` = '".$value."' ");
	      }
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
	
  function getbyattribute($key=null,$value=null,$key2=null, $value2=null){
  	if (($key2) && ($value2)){
  		 return  $this->db->query("SELECT * FROM $this->table where `$key` = '".$value."' AND `$key2` = '".$value2."'");
  	}else if ($key && $value){
  	  return  $this->db->query("SELECT * FROM $this->table where `$key` = '".$value."'");
  	}else {
  		return  $this->db->query("SELECT * FROM $this->table ");
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
	 	$this->db->insert($this->table, $data);
	 	return $this->db->insert_id();
	 }
   }
  
  function delete($id){
  	return $this->db->delete($this->table, array($this->pk => $id)); 
  }
  
  function getnotificationsbyid($id){
  	
	return $this->db->query("Select * from `$this->table` where userid = '$id' AND `read_notif` = 0");
	
  }
  
 public function getmembernotificationsdashboard($member_id,$read_status = null){
		if($read_status){
			$query = $this->db->query("SELECT 
  photo_MemberNotifications.`date_notified`,
  photo_Notifications.`message`,
  photo_Notifications.`url`,photo_Notifications.`notification_type`
 FROM photo_MemberNotifications
 JOIN photo_Notifications ON photo_Notifications.`notification_id` = photo_MemberNotifications.`notification_id`
 WHERE photo_MemberNotifications.`userid` = '".$member_id."' AND photo_MemberNotifications.`read_notif` = '".$read_status."' ORDER BY photo_MemberNotifications.`member_notification_id` DESC LIMIT 0,6");
		}else{
			$query = $this->db->query("SELECT 
			  photo_MemberNotifications.`date_notified`,photo_MemberNotifications.`read_notif`,
			  photo_Notifications.`message`,
			  photo_Notifications.`url`,photo_Notifications.`notification_type`
			 FROM photo_MemberNotifications
			 JOIN photo_Notifications ON photo_Notifications.`notification_id` = photo_MemberNotifications.`notification_id`
			 WHERE photo_MemberNotifications.`userid` = '".$member_id."' ORDER BY photo_MemberNotifications.`member_notification_id` DESC LIMIT 0,6");
		}
		return $query;
	}
	
	
	
	
	public function getmembernotifications($member_id,$read_status = null){
		if($read_status){
			$query = $this->db->query("SELECT 
  photo_MemberNotifications.`date_notified`,
  photo_Notifications.`message`,
  photo_Notifications.`url`,photo_Notifications.`notification_type`
 FROM photo_MemberNotifications
 JOIN photo_Notifications ON photo_Notifications.`notification_id` = photo_MemberNotifications.`notification_id`
 WHERE photo_MemberNotifications.`userid` = '".$member_id."' AND photo_MemberNotifications.`read_notif` = '".$read_status."' ORDER BY photo_MemberNotifications.`member_notification_id` DESC");
		}else{
			$query = $this->db->query("SELECT 
			  photo_MemberNotifications.`date_notified`,photo_MemberNotifications.`read_notif`,
			  photo_Notifications.`message`,
			  photo_Notifications.`url`,photo_Notifications.`notification_type`
			 FROM photo_MemberNotifications
			 JOIN photo_Notifications ON photo_Notifications.`notification_id` = photo_MemberNotifications.`notification_id`
			 WHERE photo_MemberNotifications.`userid` = '".$member_id."' ORDER BY photo_MemberNotifications.`member_notification_id` DESC");
		}
		return $query;
	}
	
	
	function update2($id,$data){
     $query = $this->db->query("Select * from `$this->table` where `userid` = '$id'"); 
	 if ($query->num_rows() > 0){
	     $this->db->where($this->userid, $id);
		 $this->db->update($this->table, $data);
		 return $id;
	 }
   }
}