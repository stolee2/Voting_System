<?php
class Vote {
    private $dbConnection; 
    private $tableName = 'votes'; 

   
    public function __construct($db) {
        $this->dbConnection = $db;
    }

    
    public function submitVote($categoryId, $nomineeId, $voterId, $comment) {
       
        $sql = 'INSERT INTO ' . $this->tableName . ' (category_id, nominee_id, voter_id, comment) 
                VALUES (:category_id, :nominee_id, :voter_id, :comment)';
        
       
        $stmt = $this->dbConnection->prepare($sql);
        
       
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':nominee_id', $nomineeId);
        $stmt->bindParam(':voter_id', $voterId);
        $stmt->bindParam(':comment', $comment);
        
       
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
}
?>
