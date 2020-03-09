<?php

// DB params

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shareposts');





// this is our file and we want our root til app,
// lets use dirname to the parent one till app
// C:\xampp\htdocs\BradPHP\LESSONS\raedmvc_one_part2\app\config\config.php

// App root
define('APPROOT', dirname(dirname(__FILE__)));

//this brings this file including php
// echo __FILE__; 
// this till this witout config but without the extenstion php
// echo __DIR__;


// URL  
define('URLROOT','http://localhost/RaedPHP/shareposts');

// Site name
define('SITENAME', 'sharePosts');

// App version
define('APPVERSION', '1.0.0');



?>