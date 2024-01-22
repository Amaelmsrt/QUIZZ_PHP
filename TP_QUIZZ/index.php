<?php
require 'Data/bd_users.php';
$file_db = new PDO('sqlite:users.sqlite3');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Quiz Selection</title>
</head>
<body>
    <h1>Choississez un quiz</h1>
    <ul class="quiz-list">
        <?php
        $query = $file_db->query("SELECT * FROM quizz");

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $quizName = $row['quiz_name'];
            $quizId = $row['id'];
            echo "<li>";
            echo "<a href='quiz{$quizId}.php'>";
            echo "<img src='Data/images/{$quizId}.png' alt='{$quizName}'>";
            echo "<span>{$quizName}</span>";
            echo "</a>";
            echo "</li>";
        }
        ?>
    </ul>
    <a href='logout.php'>Logout</a>
</body>
</html>
