<?
class Picture extends CI_Model {
	private $table = "picture";
	private $pk = "id";
	
	public function update($id,$data){
	
		 $query = $this->db->query("Select * from `$this->table` where $this->pk = '$id'");
		 
		 if ($query->num_rows() > 0){

	     $this->db->where($this->pk, $id);

		 $this->db->update($this->table, $data3);

		 return $id;

		} else {
			$this->db->insert($this->table, $data);

			return $this->db->insert_id();
		}
	
	
	
	
	
	}
	
	public function getall(){
	
		$query = $this->db->query("Select * from `$this->table` ");
		
		return $query;
	
	}




}




?>