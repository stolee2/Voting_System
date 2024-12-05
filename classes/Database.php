<?php


class Database {
    private $host = 'localhost'; 
    private $dbName = 'voting'; 
    private $username = 'root';
    private $password = ''; 
    public $connection; 

   
    public function connect() {
        $this->connection = null;

        try {
          
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName; 
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
           
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $this->connection; 
    }
}

?>
