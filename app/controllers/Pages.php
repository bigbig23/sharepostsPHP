<?php


class Pages extends Controller{
    public function __construct(){
    }

 
    public function index(){
        // by default it calls index method so 
        //it's better creating one
        // $this->view('view does not exist');
        // since we r extending it from Controller we should have access
        // $this->view('index'); to test it;s already connected to views
        
  

        $data = ['title' => 'SharePosts',
            'description' => 'Simple social network built on the RaedMvc
             PHP framework'
    ];
        // $this->view('/pages/index', $data);
        $this->view('/pages/index', $data);
       
    }


    public function about(){
        $data = ['title' => 'About Us',
        'description' => 'App to share posts with other users'];
        // $this->view('/pages/about', $data);
        $this->view('/pages/about', $data);
    }


}





?>