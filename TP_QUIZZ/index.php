<?php
require 'Data/bd_users.php';

session_start();

$file_db=new PDO('sqlite:users.sqlite3');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {
    $query = $file_db->prepare("SELECT username FROM users WHERE id = :user_id");
    $query->bindParam(":user_id", $_SESSION['user_id']);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $username = $result['username'];
    }
}

    echo "<link rel='stylesheet' href='styles/style.css'>";
    echo "<nav>";
    echo "<div class='navbar'>";
    echo "<div class='infos'>";
    echo "<p>Bonjour, ".$username."!</p>";
    echo "<a href='consulter.php'>Consulter</a>";
    echo "<form action='logout.php' method='post'>";
    echo "<input type='submit' value='Logout'>";
    echo "</form>";
    echo "</div>";
    echo "</nav>";
    
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
