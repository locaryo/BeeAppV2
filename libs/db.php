<?php
class DB{
    private $conn;
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct()
    {
        $this->host = constant('HOST');
        $this->dbname = constant('DB');
        $this->username = constant('USER');
        $this->password = constant('PASSWORD');
    }

    public function conn(){
        
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            // $conn = new PDO("sqlite:sala.db", "", "");
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Success";
            return $this->conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
}

?>