<?php

  /*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */ 

   class Core{
       protected $currentController = 'Pages';//it there is no other controller this one gonna load
       protected $currentMethod = 'index';
       protected $params = [];

       public function __construct(){
        //    print_r($this->getUrl());
           $url =  $this->getUrl();

        // Look in controllers for first value
        // path is as we are in index.php of public, that's why we put ../app...
        // ucwords to capitalize the first letter

        if(file_exists('../app/controllers/' .ucwords($url[0]). '.php')){
        // if exists, set controller, which override the var Pages
        $this->currentController = ucwords($url[0]);
        // unset index 0
        unset($url[0]);
       } 

       //Require the controller
       require_once('../app/controllers/' . $this->currentController . '.php');
    //    initiaiate controller class just like: $pages = new Pages
    //  require the respective controller and instantiate it since it's a class
       $this->currentController  = new $this->currentController;

 
      //  Check for second part of url
      if(isset($url[1])){
         // check to see if method exist in controller
         if(method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];
            // Unset index 1
            unset($url[1]);
         } 
         // echo $this->currentMethod;
      }

      // GET PARAMS
      $this->params =$url ? array_values($url) : [];

      
      // Call a callback with array of function 
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

       public function getUrl(){
           /*
           = http://localhost/BradPHP/LESSONS/raedmvc_one/index.php?url=test
            = we need to add index.php?url=test as we set index.php is only
            that is accessible from public, but we set too the url=test to anything we put there
            so we dont need even to url=sth, check .htaccess to know
            */
        //    echo $_GET['url'];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // now lets explode it , ex if in url there is /post/edit/i
            //explode breaks it to post and edit and   1
            $url = explode('/',$url);
            return $url;
        }
       }
   }


  












?>

 