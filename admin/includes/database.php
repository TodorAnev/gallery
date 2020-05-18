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

	// public function p_statement($query_string = "", $type = "", $vars = []) {
	// $prepare_query = $this->connection->prepare($query_string); // Object style
 //    //$prepare_query = mysqli_prepare($this->connection, $query_string); // Procedural style
 //    //assign $type to first index of $vars
 //    array_unshift($vars, $type);

 //    //Turn all values into reference since call_user_func_array
 //    //expects arguments of bind_param to be references
 //    //@see mysqli::bind_param() manpage
 //    foreach ($vars as $key => $value) {
 //        $vars[$key] =& $vars[$key];
 //    }

 //    call_user_func_array(array($prepare_query, 'bind_param'), $vars);
 //    $this->confirmQuery($prepare_query);
 //    $prepare_query->execute();

 //    // INSERT, SELECT, UPDATE and DELETE have each 6 chars, you can
 //    // validate it using substr() below for better and faster performance
 //    if (strtolower(substr($query_string, 0, 6)) == "select") {
 //        $result = $prepare_query->get_result();
 //    } else {
 //        $result = $prepare_query->affected_rows;
 //    }

 //    $prepare_query->close();
 //    return $result;
	// }

	public function insert_id(){
		return mysqli_insert_id($this->connection);
	}


}

$database = new Database();

 ?>