<?php 

// Just in case we forget to include a class, this is a precaution
function classAutoLoader($class){ 
	$class = strtolower($class);
	$path = "includes/$class.php";
	(is_file($path) && !class_exists($class)) ? include_once $path : "";
	// is_file checks if the file exists in the declared path
}

spl_autoload_register('classAutoLoader');

 ?>