<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR); // 'DS' = \     , here we define our separator which we name DS and is \ 
// if is defined return null , else define the DS to \

define('SITE_ROOT', DS . 'xampp' . DS . 'htdocs' . DS . 'gallery'); // here we define the 'SITE_ROOT' 
// if is defined return null , else define the SITE_ROOT to where our site is

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
// define includes_path in admin

require_once(INCLUDES_PATH . DS . "functions.php");
require_once(INCLUDES_PATH . DS . "database.php");
require_once(INCLUDES_PATH . DS . "db_object.php");
require_once(INCLUDES_PATH . DS . "user.php");
require_once(INCLUDES_PATH . DS . "photo.php");
require_once(INCLUDES_PATH . DS . "comment.php");
require_once(INCLUDES_PATH . DS . "session.php");
require_once(INCLUDES_PATH . DS . "paginate.php");
 

 ?>