<?php

class Posts extends Controller{

    public function __construct(){
        // redirect you no matter waht is method is 
        //but if u want restrict access to a certain method , u should do this is in a method not in constructor
        // if(!isset($_SESSION['user_id'])){
            if(!(isLogged())){
            redirect('users/login');
        }

        $this->postModel = $this->models('Post');
        $this->userModel = $this->models('User');
    }

    public function index(){
        // this cod got error, i sould look at it later
        //error type: net::ERR_TOO_MANY_REDIRECTS
        // if(isLogged()){
        //     redirect('posts');
        // }

        // Get Posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] ==  'POST'){
            //clearn it up 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => trim($_SESSION['user_id']),
                'title_err' => '',
                'body_err' => ''
            ]; 

            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body text';
            }

            // Make sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])){
                // Validated
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }

            }else{
                // load veiw with errors
                $this->view('posts/add', $data);
            }

        }else{
            $data = [
                'title' => '',
                'body' => ''
            ]; 
        }
        $this->view('posts/add', $data);
    }


    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
               //clearn it up 
               $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

               $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'user_id' => trim($_SESSION['user_id']), //we don't need it but we left it,
                'body' => trim($_POST['body']), 
                'title_err' => '',
                'body_err' => ''
            ]; 
            
            // Validate data
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body text';
            }
            // Make sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])){
                // Validated
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }

            }else{
                // load veiw with errors
                $this->view('posts/edit', $data);
            }

        }else{
            // Get existing post from the model
            $post = $this->postModel->getPostById($id);

            // check for owner user
            if($post->user_id == !$_SESSION['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ]; 
        }
        $this->view('posts/edit', $data);
        }



    public function show($id){
      $post =  $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);

        $data = ['post' => $post, 'user' => $user];

        $this->view('posts/show', $data);
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // Get existing post from the model
            $post = $this->postModel->getPostById($id);
            
             // check for owner user
            if($post->user_id !== $_SESSION['user_id']){
                redirect('posts');
            }
            if($this->postModel->deletePost($id)){
                flash('post_message', 'Post Removed');
                redirect('posts');
            }else{
                die('something went wrong');
            }
        }else{
            redirect('posts');
        }
    }



}


?>