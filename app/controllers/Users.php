<?php

class Users extends Controller{ 

    public function __construct(){
        $this->userModel = $this->models('User');
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // sanitize POST data; to clear data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
              ];

            //   Validate Name
            if(empty($data['name'])){
            $data['name_err'] = 'Please enter  name';
            }
            //   Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                // Check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email is already taken';
                }
            }
            //   Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }elseif(strlen($data['password']) < 4){
                $data['password_err'] = 'Password must be at least 4 characters'; 
            }
            //   Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            }else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords do not match';  
                }
            }

            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Validate
                // die('SUCCESS');

                  // Hash password
                  $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                  // Register user  ; here we passed all data array
                  if($this->userModel->register($data)){
                      flash('register_success', 'You are registered and can log in '); // did'nt use the class bcoz i want use the default one
                    redirect('users/login/');
                  }else{
                      die('Something went wrong');
                  }

                  

            }else{
                // load view with errors
                $this->view('/users/register', $data);
            }


        }else{
            
            // Init data
        $data =[
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
          ];
          // load form
            // echo 'load form';
            $this->view('/users/register', $data);
        }
    }

     


    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){


          // Process form
          // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',      
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          }
  
          // Check for user/email
          if($this->userModel->findUserByEmail($data['email'])){
            // User found
          } else {
            // User not found
            $data['email_err'] = 'No user found';
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated

              // Check and set logged in user
                // here we did'nt hash the pass bcoz it coming from the form
            // Check and set logged in user
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
  
            if($loggedInUser){
              // Create Session
              $this->createUserSession($loggedInUser);
            } else {
              $data['password_err'] = 'Password incorrect';
  
              $this->view('users/login', $data);
            }
          } else {
            // Load view with errors
            $this->view('users/login', $data);
          }
  
  
        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',        
          ];
  
          // Load view
          $this->view('users/login', $data);
        }
      }

      public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
      }

      public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
      }

      // moving it to session file
      // public function isLogged(){ 
      //     if($_SESSION['user_id']){
      //         return true;
      //     }else{
      //         return false;
      //     }
      // }



}

?>