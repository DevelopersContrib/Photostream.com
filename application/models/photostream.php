<?php
class PhotoStream extends CI_Model {
	private $table = "photo_stream";
	private $pk = "stream_id";
	private $date = 'date_created';
	
	private $userid = 'userid';

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
   
   
   function update2($id,$data5){

     $query = $this->db->query("Select * from `$this->table` where $this->pk = '$id'"); 

	 if ($query->num_rows() > 0){

	     $this->db->where($this->pk, $id);

		 $this->db->update($this->table, $data5);

		 return $id;

	 } else {

	 	if ($this->date){

	 	  $this->db->set($this->date, 'NOW()', FALSE);

	 	}

	 	$this->db->insert($this->table, $data5);

	 	return $this->db->insert_id();

	 }

   }
  
   
  function delete($field,$value){
  	return $this->db->delete($this->table, array($field => $value)); 
  }
  
  
  
  
  
  
   public function get_all($id)
   {
	$query = $this->db->query("Select * from `$this->table` where $this->userid='$id'");
	return $query->result();
   }
   
    public function get_rows($id)
   {
	$query = $this->db->query("Select * from `$this->table` where $this->userid='$id'");
	return $query->num_rows();
   }
   
   public function join($id)
   {
	$query = $this->db->query("SELECT photo_stream.`stream_id`, photo_stream.`description`,photo_stream.`title`,photo_stream.`userid`, photo_pics.`filename` FROM (photo_stream INNER JOIN photo_pics ON photo_stream.cover_pic = photo_pics.`photo_id`) WHERE userid = '$id'");
	return $query->result();
   }
  	public function getlateststreams($show_count){		return $this->db->query("SELECT * FROM photo_stream WHERE is_public = '1' ORDER BY stream_id DESC LIMIT $show_count ");	}
  
  
	
}