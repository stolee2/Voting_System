<?php

include_once 'classes/Database.php';
include_once 'classes/Employee.php';
include_once 'classes/Vote.php';

$database = new Database();
$dbConnection = $database->connect();

$employeeModel = new Employee($dbConnection);

$categories = $employeeModel->getAllCategories();
$employeesList = $employeeModel->getAllEmployees();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $categoryId = $_POST['category'];
    $nomineeId = $_POST['nominee'];
    $voterId = $_POST['voter'];
    $comment = $_POST['comment'];

    if ($voterId == $nomineeId) {
        echo "You cannot vote for yourself!";
    } else {
        $voteModel = new Vote($dbConnection);
        if ($voteModel->submitVote($categoryId, $nomineeId, $voterId, $comment)) {
            echo "Your vote has been submitted!";
        } else {
            echo "There was an error submitting your vote.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Voting System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Vote for Your Colleague</h1>
        <form action="index.php" method="POST">
          
            <label for="voter">Your Name:</label>
            <select name="voter" id="voter" required>
                <?php while ($employee = $employeesList->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?= $employee['id']; ?>"><?= htmlspecialchars($employee['name']); ?></option>
                <?php } ?>
            </select>

            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <?php while ($category = $categories->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?= $category['id']; ?>"><?= htmlspecialchars($category['name']); ?></option>
                <?php } ?>
            </select>

            <label for="nominee">Nominee:</label>
            <select name="nominee" id="nominee" required>
                <?php
                $employeesList->execute();
                while ($employee = $employeesList->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $employee['id'] . '">' . htmlspecialchars($employee['name']) . '</option>';
                }
                ?>
            </select>

            <label for="comment">Comment:</label>
            <textarea name="comment" id="comment" required></textarea>

            <button type="submit">Submit Vote</button>
        </form>
    </div>
</body>
</html>
