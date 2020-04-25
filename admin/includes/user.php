<?php 


/**
 * 
 */
class User 
{

	protected static $db_table = "tbl_users";
	protected static $db_table_fields = array('u_username','u_password','f_name','l_name');
	public $id;
	public $u_username;
	public $u_password;
	public $f_name;
	public $l_name;
	
	public static function find_all_users(){
		return self::find_this_query("SELECT * FROM tbl_users");

	}

	public static function find_user_by_id($u_id){

		$result = self::find_this_query("SELECT * FROM tbl_users WHERE id = $u_id LIMIT 1");

		return !empty($result) ? array_shift($result) : false; // array_shift grabs the first item of the array and returns it
	}

	public static function find_this_query($query){
		global $database;
		$result = $database->query($query);
		$object_array = []; // empty array to put our objects in
		while($row = mysqli_fetch_array($result)){ // fetch the $result we get from the DB
			$object_array[] = self::instantiate($row); // we use the instantiate method to loop through the record of the DB. We just put the result of the instantiation into an array		
		}							// $row = the fetched results
		return $object_array; // here is an array of objects that we foreach and we can get each username with $user->f_name
	}

	public static function verify_user($u_username,$u_password){ // User Input
		global $database;
		$u_username = $database->escape_string($u_username); 
		$u_password = $database->escape_string($u_password);
		$query = "SELECT * FROM tbl_users WHERE u_username = '$u_username' AND u_password = '$u_password' LIMIT 1";
		//$query = $database->p_statement("SELECT * FROM tbl_users WHERE u_username=? AND u_password=? LIMIT 1", "ss", [$u_username,$u_password]);
		$result = self::find_this_query($query);
		return !empty($result) ? array_shift($result) : false; //array_shift grabs the first item of the array and returns it
	}

	public static function instantiate($u_found){ // create array into object
	    $object = new self();

	    //$object->id = $u_found['u_username'] - this is what we do dynamically here

	    foreach ($u_found as $attribute => $value) { //$u_found = full return of the DB  $attribute == KEY of $u_found that is returned from the DB(u_username,u_password.....) $value = actual username and password
	    	if($object->has_attribute($attribute)){ // the object must have that property from the database so we check for it
	    		$object->$attribute = $value; // and then we assign the object attribute to the value
	    	}//$attribute == $u_found and $value == ['u_username']
	    }
        return $object;
    }

    private function has_attribute($attribute){
    	$object_properties = get_object_vars($this); // returns all class properties
    	return array_key_exists($attribute, $object_properties); // compareres the field returned from the database($attribute) to the public varaibles in the class
    }

    protected function properties(){
    	$properties = array();
    	foreach (self::$db_table_fields as $db_field) { 
    		if(property_exists($this, $db_field)){
    			$properties[$db_field] = $this->$db_field;
    		}
    	}
    	return $properties; // this is what this returns : Array ( [u_username] => Pesho [u_password] => gesho [f_name] => mesho [l_name] => bakshesho )
    }

    protected function clean_properties(){
    	global $database;
    	$clean_properties = array();
    	foreach ($this->properties() as $key => $value) {
    		$clean_properties[$key] = $database->escape_string($value); // same thing as $properties, but cleaned
    	}
    	return $clean_properties;
    }

    public function create(){
	global $database;
	$properties = $this->clean_properties();// returns all object properties
	$sql = "INSERT INTO " .self::$db_table. "(" . implode(",", array_keys($properties)) . ")"; // 1st paramater devides they keys from array_keys($properties)
	//imploding - separating each value with a comma and we use array_keys to pull out the keys of the array(u_username, u_password, f_name.......)
	$sql .= "VALUES ('". implode("','", array_values($properties)) ."')";
	if($database->query($sql)){
		$this->id = $database->insert_id(); // pulling the id of the last query
		return true;
	} else {
		return false;
	}
	
	}

	public function update(){
	global $database;

	$properties = $this->clean_properties();
	$properties_pairs = array();
	foreach ($properties as $key => $value) {
		$properties_pairs[] = "{$key}='{$value}'";
	}
	$sql = "UPDATE " .self::$db_table. " SET ";
	$sql .= implode(", ", $properties_pairs); // final result:Array ( [0] => u_username='Pesho' [1] => u_password='gesho' [2] => f_name='mesho' [3] => l_name='bakshesho' ) from this:
	//$sql .= "u_username= '" . $database->escape_string($this->u_username) . "', ";
	$sql .= " WHERE id= " . $database->escape_string($this->id);
	$database->query($sql);

	return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}

	public function save(){
    	return isset($this->id) ? $this->update() : $this->create(); // if the id is here we want to update and if it is not we update
    }

	public function delete(){
	global $database;
	$sql = "DELETE FROM  " .self::$db_table. " ";
	$sql .= " WHERE id= " . $database->escape_string($this->id);
	$sql .= " LIMIT 1"; // security, it is sure that we delete only 1
	$database->query($sql);
	return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}
} // End of Class User


 ?>