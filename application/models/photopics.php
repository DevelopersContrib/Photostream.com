<?php
class PhotoPics extends CI_Model {
	private $table = "photo_pics";
	private $pk = "photo_id";
	private $date = 'date_uploaded';
	
	private $stream_id = 'stream_id';

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
  }    function getbyattributelimit($key,$value,$show_count,$key2=null, $value2=null){  	if (($key2) && ($value2)){  		 return  $this->db->query("SELECT * FROM $this->table where `$key` = '".$value."' AND `$key2` = '".$value2."' LIMIT 1, $show_count");  	}else {  	  return  $this->db->query("SELECT * FROM $this->table where `$key` = '".$value."' ORDER BY RAND() LIMIT 1, $show_count");  	}  }
  
  
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
  
  function update($id,$data3){
     $query = $this->db->query("Select * from `$this->table` where $this->pk = '$id'"); 
	 if ($query->num_rows() > 0){
	     $this->db->where($this->pk, $id);
		 $this->db->update($this->table, $data3);
		 return $id;
	 } else {
	 	if ($this->date){
	 	  $this->db->set($this->date, 'NOW()', FALSE);
	 	}
	 	$this->db->insert($this->table, $data3);
	 	return $this->db->insert_id();
	 }
   }
  
   
  function delete($field,$value){
  	return $this->db->delete($this->table, array($field => $value)); 
  }
  
  
   public function get_all($id)
   {
	$query = $this->db->query("Select * from `$this->table` where $this->stream_id='$id'");
	return $query->result();
   }
   
    public function get_rows($id2)
   {
	$query = $this->db->query("Select * from `$this->table` where $this->stream_id = '$id2'");
	return $query->num_rows();
   }
   
   public function get_stream($id2)
   {
	$query = $this->db->query("Select * from `$this->table` where $this->stream_id = '$id2'");
	return $query->result();
   }      public function getQueryResult($query)   {		return $this->db->query($query);      }
  
  
  
	
}