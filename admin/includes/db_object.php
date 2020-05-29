<?php 

class Db_object
{

	public $errors       	 = array(); // we put the errors in here and we display the errors the the user
	public $UploadErrors 	 = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
	);
	
	public static function find_all(){
		return static::find_by_query("SELECT * FROM " .static::$db_table. " "); // late static binding static::

	}

	public static function find_by_id($id){

		$result = static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id = ".$id." LIMIT 1");

		return !empty($result) ? array_shift($result) : false; // array_shift grabs the first item of the array and returns it
	}

	public static function find_by_query($query){
		global $database;
		$result = $database->query($query);
		$object_array = []; // empty array to put our objects in
		while($row = mysqli_fetch_array($result)){ // fetch the $result we get from the DB
			$object_array[] = static::instantiate($row); // we use the instantiate method to loop through the record of the DB. We just put the result of the instantiation into an array		
		}							// $row = the fetched results
		return $object_array; // here is an array of objects that we foreach and we can get each username with $user->f_name
	}

	public static function instantiate($found){ // create array into object
		$calling_class = get_called_class();
	    $object = new $calling_class();

	    //$object->id = $found['u_username'] - this is what we do dynamically here

	    foreach ($found as $attribute => $value) { //$found = full return of the DB  $attribute == KEY of $found that is returned from the DB(u_username,u_password.....) $value = actual username and password
	    	if($object->has_attribute($attribute)){ // the object must have that property from the database so we check for it
	    		$object->$attribute = $value; // and then we assign the object attribute to the value
	    	}//$attribute == $found and $value == ['u_username']
	    }
        return $object;
    }

    private function has_attribute($attribute){
    	$object_properties = get_object_vars($this); // returns all class properties
    	return array_key_exists($attribute, $object_properties); // compareres the field returned from the database($attribute) to the public varaibles in the class
    }

    protected function properties(){
    	$properties = array();
    	foreach (static::$db_table_fields as $db_field) { 
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
	$sql = "INSERT INTO " .static::$db_table. "(" . implode(",", array_keys($properties)) . ")"; // 1st paramater devides they keys from array_keys($properties)
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
	$sql = "UPDATE " .static::$db_table. " SET ";
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
	$sql = "DELETE FROM  " .static::$db_table. " ";
	$sql .= " WHERE id= " . $database->escape_string($this->id);
	$sql .= " LIMIT 1"; // security, it is sure that we delete only 1
	$database->query($sql);
	return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}

	public static function count_all(){
		global $database;
		$sql="SELECT COUNT(*) FROM " . static::$db_table;
		$result_set = $database->query($sql);
		$row = mysqli_fetch_array($result_set);
		return array_shift($row); // we pull only tha value with array shift
	}
}