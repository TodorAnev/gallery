<?php 

class User extends Db_object
{

	protected static $db_table = "tbl_users";
	protected static $db_table_fields = array('id','u_username','u_password','f_name','l_name','u_image');
	public $id;
	public $u_username;
	public $u_password;
	public $f_name;
	public $l_name;
	public $upload_directory = "images";
	public $image_placeholder = "http://placehold.it/400x400&text=image";

	public function image_placeholder(){
		return empty($this->u_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->u_image;
	}

	public static function verify_user($u_username,$u_password){ // User Input
		global $database;
		$u_username = $database->escape_string($u_username); 
		$u_password = $database->escape_string($u_password);
		$query = "SELECT * FROM " . self::$db_table . " WHERE u_username = '$u_username' AND u_password = '$u_password' LIMIT 1";
		$result = self::find_by_query($query);
		return !empty($result) ? array_shift($result) : false; //array_shift grabs the first item of the array and returns it
	}

} // End of Class User


 ?>