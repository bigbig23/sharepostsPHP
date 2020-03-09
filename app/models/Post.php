<?php
class Post{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPosts(){
        $this->db->query("SELECT *,
                        posts.id as postId,
                        users.id as userId,
                        posts.created_at as postsCreated,
                        users.created_at as usersCreated
                        FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY posts.created_at DESC");
    
        $result = $this->db->resultSet();
        return $result;
    }


    public function addPost($data){
        $this->db->query('INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body )');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function updatePost($data){
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }



    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

 


    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
          } else {
            return false;
          }
    }













    // in cas u want to addd index pagination add below code 
    //I have implemented the Pagination functionality to the index page of posts, 
    //have a look! made the following changes to the getPosts() function in the post model

    // public function getPosts($limit='', $start=''){
    //     $this->db->query('SELECT *,
    //                     posts.id as postId,
    //                     users.id as userId,
    //                     posts.created_at as postCreated,
    //                     users.created_at as userCreated
    //                      FROM posts
    //                      INNER JOIN users
    //                      ON posts.user_id = users.id
    //                      ORDER BY posts.created_at DESC
    //                      LIMIT :start, :limit');
    //     $this->db->bind(':start', $start);
    //     $this->db->bind(':limit', $limit);
   
    //     $results = $this->db->resultSet();
   
    //     return $results;
    //   }
  // This is the index method of the posts controller
//   public function index(){
//         $limit = 5;
//         if(isset($_GET['page'])){
//           $page = $_GET['page'];
//         }else {
//           $page = 0;
//         }
//         $totalRows = $this->postModel->getAllRows();
//         $start = $page * $limit;
//         $posts = $this->postModel->getPosts($limit, $start);
//         $numOfPages = ceil($totalRows/$limit); 
//         $data = [
//           'posts' => $posts,
//           'page_num' => $page,
//           'start' => $start,
//           'total_rows' => $totalRows,
//           'num_of_pages' => $numOfPages
//         ];
//         $this->view('posts/index', $data);
//       }
//   // This is the index view
//   <div class="card card-body mb-3">
//     <nav aria-label="Page navigation example">
//       <ul class="pagination">
//         <?php
//           if(!isset($_GET['page']) or $_GET['page'] == 0){
//             echo '<li class="page-item disabled"><a href="#" class="page-link"><<</a></li>';
//           } else {
//             $prevPage = $data['page_num'] - 1;
//             echo '<li class="page-item"><a href="?page='.$prevPage.'" class="page-link"><<</a></li>';
//           }
//           $pageText = 0;
//           for($page=$data['page_num'];$page<$data['num_of_pages'];$page++){
//             $pageText = $page + 1;
//             if(isset($_GET['page']) and $_GET['page'] == $page){
//               echo '<li class="page-item active"><a class="page-link" href="?page='.$page.'">'.$pageText.'</a></li>';
//             } else {
//               echo '<li class="page-item"><a class="page-link" href="?page='.$page.'">'.$pageText.'</a></li>';
//             }
//           }
//           $nxtPage = $data['page_num'] + 1;
//           if((isset($_GET['page'])) and ($_GET['page'] == ($data['num_of_pages'] - 1))){
//             echo '<li class="page-item disabled"><a class="page-link" href="?page='.$data['page_num'].'">>></a></li>';
//           } else {
//             echo '<li class="page-item"><a class="page-link disabled" href="?page='.$nxtPage.'">>></a></li>';
//           }
        //
 //       </ul> -->
 //     </nav> -->



}



?>