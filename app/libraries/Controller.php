<?php
 
/**
 * Base Controller
 * Load the model and views
 */

 class Controller{
    //  load model file
    public function models($model){
        // Require model file
        require_once('../app/models/' . $model . '.php');
        // Inititate the model
        return new $model();
    } 

    // load view
    // $data = [] , we want pass data into view, dynamically
    public function view($view, $data = []){
 
        // Check for file
        // if(file_exists('../app/views/'. $view . '.php')){
        if(file_exists('../app/views/'. $view . '.php')){
            require_once '../app/views/'. $view . '.php';
        }else{
            // View does not exist , use die to stopr the application
            die('View does not exist');
        }

    }
 }  





?>