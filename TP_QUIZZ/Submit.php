<?php
require 'Classes/autoloader.php'; 
Autoloader::register(); 
use Form\Question;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reponses'])) {
    if (isset($_SESSION["questions"])) {
        $questions = $_SESSION["questions"];
    }
    $score = 0;
    $nombre_questions = count($questions);
    foreach ($questions as $key => $value) {
        if ($value->getType() == "text") {
            $reponseUser = strtolower(strip_tags(trim($_POST['reponses'][$value->getUuid()])));
        } else {
            $reponseUser = $_POST['reponses'][$value->getUuid()];
        }
        if ($reponseUser == $value->getAnswer()) {
            $score += $value->getScore();
        }
    }
    echo "<link rel='stylesheet' href='styles/style.css'>";
    echo "<h1> Votre score : ".$score."/".$nombre_questions."</h1>";
    foreach ($questions as $key => $value) {
        echo "<section>";
        echo "<h3>".$value->getText()."</h3>";
        if ($value->getType() == "text") {
            $reponseUser = strtolower(strip_tags(trim($_POST['reponses'][$value->getUuid()])));
        } else {
            $reponseUser = $_POST['reponses'][$value->getUuid()];
        }
        if ($reponseUser == $value->getAnswer()) {
            echo "<p class='correct'>&#x2705; Bravo ! Bonne réponse. </p>";
        } else {
            echo "<p class='incorrect'>&#x274C; Désolé ! Mauvaise réponse. </p>";
        }
        echo "<p> Votre réponse : ".$_POST['reponses'][$value->getUuid()]."</p>";
        echo "<p> La réponse attendue : ".$_POST['reponses_hidden'][$value->getUuid()]."</p>";
        echo "</section>";
    }
    echo "<div class='bottom'>";
    echo "<a href='index.php'>Recommencer le quizz</a>";
    echo "</div>";
} else {
    echo "Accès non autorisé.";
}
?>
