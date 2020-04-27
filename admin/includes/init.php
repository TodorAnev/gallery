<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // 'DS' = \     , here we define our separator which we name DS and is \ 
// if is defined return null , else define the DS to \

define('SITE_ROOT', DS . 'xampp' . DS . 'htdocs' . DS . 'gallery'); // here we define the 'SITE_ROOT' 
// if is defined return null , else define the SITE_ROOT to where our site is

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
// define includes_path in admin



require_once("functions.php");
require_once("database.php");
require_once("user.php");
require_once("photo.php");
require_once("db_object.php");
require_once("session.php");
 

 ?>