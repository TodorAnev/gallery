<?php 

require_once("configuration.php");

class Database {


	public $connection;
	function __construct(){ // gets each time when an instance is created
		$this->open_db_connection();
	}


	public function open_db_connection(){
		$this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); # this ia an object we apply the property to connection
		($this->connection->connect_errno) ? die("Database connection failed" . $this->connection->connect_error) : ""; 
	}


	public function query($sql){
		$result = $this->connection->query($sql);
		$this->confirmQuery($result);
		if(!$result){die("Query failed" . $this->connection->error);}
		return $result;
	}


	private function confirmQuery($result){ # we won't use it outside the class
		if(!$result){die("Query failed" . $this->connection->error);}
	}

	public function escape_string($string){
		return mysqli_real_escape_string($this->connection,$string);
	}

	public function insert_id(){
		return mysqli_insert_id($this->connection);
	}


}

$database = new Database();

 ?>