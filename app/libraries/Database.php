<?php

  /*
   * PDO Database Class
   * Connect to database
   * Create prepared statements
   * Bind values
   * Return rows and results
   */
  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,//this checks to see if the db is already connected or nor
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION//handling error
            // there is alot u can check out the document
        );

        // Creaate POD instance
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);

        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
          }
    }

    // Prepare statement with query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type= null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type= PDO::PARAM_BOOL;
                    break;
                case is_bool($value):
                    $type= PDO::PARAM_NULL;
                    break;
                default:
                    $type= PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param,$value,$type);
    }

    // Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result  set as array of objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

      // Get single record as  objects
      public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
  }




//   EX OF DB SIMPLE OF PREVIOUS EXAMPLE
	// $host = 'localhost';
	// $user = 'root';
	// $password = '123456';
	// $dbname = 'pdotest';

	// // Set DSN
	// $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

	// // Create a PDO instance
	// $pdo = new PDO($dsn, $user, $password);
	// $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	// // $status = 'admin';

	// // $sql = 'SELECT * FROM users WHERE status = :status';
	// // $stmt = $pdo->prepare($sql);
	// // $stmt->execute(['status' => $status]);
	// // $users = $stmt->fetchAll();

	// // foreach($users as $user){
	// // 	echo $user->name.'<br>';
	// // }

	// $name = 'Karen Williams';
	// $email = 'kwills@gmail.com';
	// $status = 'guest';

	// $sql = 'INSERT INTO users(name, email, status) VALUES(:name, :email, :status)';
	// $stmt = $pdo->prepare($sql);
	// $stmt->execute(['name'=> $name, 'email' => $email, 'status' => $status]);
	// echo 'Added User';

 

?>

 