<?php
session_start();

$file_db = new PDO('sqlite:users.sqlite3');
$username = '';

if (isset($_SESSION['user_id'])) {
    $query = $file_db->prepare("SELECT username FROM users WHERE id = :user_id");
    $query->bindParam(":user_id", $_SESSION['user_id']);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $username = $result['username'];
    }

    echo "<h1>".$username.", voici les quizz que vous avez effectués</h1>";

    $liste_quizz = $file_db->query("SELECT * FROM user_quizz natural join quizz where id_user= :id_user");
    $query->bindParam(":id_user", $_SESSION['user_id']);
    $liste_quizz->execute();
    $result = $liste_quizz->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $quizz) {
        echo "<div class='quizz'>";
        echo "<h2>".$quizz['quiz_name'];"</h2>";
        echo "<p>Score : ".$quizz['score']."</p>";
        echo "<a href='quizz.php?id=".$quizz['id']."'>Voir le quizz</a>";
        echo "</div>";
    }
}

?>

