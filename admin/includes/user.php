<?php 

class User extends Db_object
{

	protected static $db_table = "tbl_users";
	protected static $db_table_fields = array('u_username','u_password','f_name','l_name');
	public $id;
	public $u_username;
	public $u_password;
	public $f_name;
	public $l_name;
	

	public static function verify_user($u_username,$u_password){ // User Input
		global $database;
		$u_username = $database->escape_string($u_username); 
		$u_password = $database->escape_string($u_password);
		$query = "SELECT * FROM " .self::$db_table. " WHERE u_username = '$u_username' AND u_password = '$u_password' LIMIT 1";
		//$query = $database->p_statement("SELECT * FROM tbl_users WHERE u_username=? AND u_password=? LIMIT 1", "ss", [$u_username,$u_password]);
		$result = self::find_by_query($query);
		return !empty($result) ? array_shift($result) : false; //array_shift grabs the first item of the array and returns it
	}


} // End of Class User


 ?>