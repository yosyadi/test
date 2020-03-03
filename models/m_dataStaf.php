<?php 

class DataStaf{
	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_staf";
		if($id != null){
			$sql .= " WHERE kode_staf = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}
}

 ?>