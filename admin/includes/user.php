<?php 


/**
 * 
 */
class User 
{

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
}





 ?>