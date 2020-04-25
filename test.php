<?php 

/**
 * 
 */
class User25 
{
	
	protected static $db_table_fields = array('u_username','u_password','f_name','l_name');
	public $id = 5;
	public $u_username = 'Pesho';
	public $u_password = 'gesho';
	public $f_name = 'mesho';
	public $l_name = 'bakshesho';

	public function properties25(){
    	$properties = array();
    	foreach (self::$db_table_fields as $db_field) { 
    		if(property_exists($this, $db_field)){
    			$properties[$db_field] = $this->$db_field;
    		}
    	} // this is what this returns : Array ( [u_username] => [u_password] => [f_name] => [l_name] => )

    	$properties_pairs = array();
		foreach ($properties as $key => $value) {
		$properties_pairs[] = "{$key}='{$value}'";
	}
	print_r($properties_pairs);
  }



}

$user155 = new User25;
$user155->properties25();

class User255
{
	
	protected static $db_table_fields = array('u_username','u_password','f_name','l_name');
	public $id = 5;
	public $u_username = 'Pesho';
	public $u_password = 'gesho';
	public $f_name = 'mesho';
	public $l_name = 'bakshesho';

	public function properties255(){
    	$properties = array();
    	foreach (self::$db_table_fields as $db_field) { 
    		if(property_exists($this, $db_field)){
    			$properties[$db_field] = $this->$db_field;
    		}
    	}
     	return $properties; // this is what this returns : Array ( [u_username] => [u_password] => [f_name] => [l_name] => )
    }

    public function clean_properties(){
    	global $database;

    	$clean_properties = array();
    	foreach ($this->properties255() as $key => $value) {
    		$clean_properties[$key] = $database->escape_string($value); // same thing as $properties, but cleaned
    	}
    	print_r($clean_properties);
    }





}

$user155 = new User255;
$user155->properties255();


$test = ['eyes'=>'black', 'skin'=>'pink','hair'=>'black'];
foreach ($test as $key => $value) {
	$clean_properties[$key] = $value; // same thing as $properties, but cleaned
}
print_r($clean_properties);




