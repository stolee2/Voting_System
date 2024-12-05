<?php

class Employee {
    private $dbConnection; 
    private $tableName = 'employees'; 

   
    public function __construct($db) {
        $this->dbConnection = $db;
    }

   
    public function getAllEmployees() {
       
        $sql = 'SELECT * FROM ' . $this->tableName;
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    
    public function getAllCategories() {
       
        $sql = 'SELECT * FROM categories';
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    
    public function getEmployeeById($employeeId) {
       
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id = :id';
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $employeeId); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}
?>
