<?php 
// Load config
require_once 'config/config.php';

// load helper
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Database.php';

//sometimes we have these require onces files can be many and 
//overload the app, so it's better to use autoloader spl_autoload_register
//so that we call it by the class name, to make only the file name 
//is called 

spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});





// init core
// $init = new Core;



















?>
 