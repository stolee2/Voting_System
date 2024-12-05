<?php
include_once 'classes/Database.php';

$database = new Database();
$dbConnection = $database->connect();

$query = "SELECT * FROM categories";
$stmt = $dbConnection->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Results</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container">
        <h1>Voting Results</h1>
        
        <?php foreach ($categories as $category): ?>
            <h2><?= htmlspecialchars($category['name']); ?></h2>
            
            <?php
            $stmt = $dbConnection->prepare(
                "SELECT nominee_id, COUNT(*) AS votes 
                 FROM votes 
                 WHERE category_id = :category_id 
                 GROUP BY nominee_id 
                 ORDER BY votes DESC 
                 LIMIT 1"
            );
            $stmt->bindParam(':category_id', $category['id']);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $stmt = $dbConnection->prepare(
                    "SELECT * FROM employees WHERE id = :nominee_id"
                );
                $stmt->bindParam(':nominee_id', $result['nominee_id']);
                $stmt->execute();
                $nominee = $stmt->fetch(PDO::FETCH_ASSOC);
                
                echo "<ul><li><strong>Winner:</strong> " . htmlspecialchars($nominee['name']) . " with " . $result['votes'] . " votes</li></ul>";
            } else {
                echo "<p class='no-votes'>No votes yet in this category.</p>";
            }
            ?>
        <?php endforeach; ?>
        
        <a href="active_voters.php"><h2>Most Active Voters</h2></a>
    </div>

</body>
</html>
