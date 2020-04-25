<?php 

 echo __FILE__ . "<br>"; // ends with file name
 echo __LINE__ . "<br>"; // at which line the current code is
 echo __DIR__ . "<br>"; // ends with the directory path
if(file_exists(__DIR__)){
	echo "Exists <br>";
}

if(is_file(__DIR__)){ // this directory is not a file
	echo "Exists <br>";
} else {
	echo "Doesn't Exist <br>";
}

if(is_file(__FILE__)){ 
	echo "Exists <br>";
} else {
	echo "Doesn't Exist <br>";
}

if(is_dir(__FILE__)){ 
	echo "Exists <br>";
} else {
	echo "Doesn't Exist <br>";
}

echo file_exists(__FILE__) ? "yes" : "no";

 ?>