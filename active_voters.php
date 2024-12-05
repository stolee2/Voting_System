<?php

include_once 'classes/Database.php'; 


$database = new Database();
$dbConnection = $database->connect();


$sqlQuery = "SELECT employees.name, COUNT(votes.nominee_id) AS votes_submitted
             FROM employees
             LEFT JOIN votes ON employees.id = votes.voter_id
             GROUP BY employees.id
             ORDER BY votes_submitted DESC";


$stmt = $dbConnection->prepare($sqlQuery);
$stmt->execute();


$activeVoters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Active Voters</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Most Active Voters</h1>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Employee Name</th>
                    <th>Votes Submitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                $rank = 1;

              
                foreach ($activeVoters as $voter) {
                    echo "<tr>
                            <td>" . $rank++ . "</td>
                            <td>" . htmlspecialchars($voter['name']) . "</td>
                            <td>" . $voter['votes_submitted'] . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
