<?php
require 'Classes/autoloader.php'; 
Autoloader::register(); 
use Form\Question;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reponses'])) {
    if (isset($_SESSION["questions"])) {
        $questions = $_SESSION["questions"];
    }

    // AFFICHAGE DES REPONSES
    echo "<link rel='stylesheet' href='styles/style.css'>";
    echo "<h1> Vos réponses </h1>";
    foreach ($questions as $key => $value) {
        echo "<section>";
        echo "<h3>".$value->getText()."</h3>";
        if ($_POST['reponses'][$value->getUuid()] == $value->getAnswer()) {
            echo "<p class='correct'>&#x2705; Bravo! Bonne réponse. </p>";
        } else {
            echo "<p class='incorrect'>&#x274C; Désolé! Mauvaise réponse. </p>";
        }
        echo "<p> Votre réponse : ".$_POST['reponses'][$value->getUuid()]."</p>";
        echo "<p> La réponse attendue : ".$_POST['reponses_hidden'][$value->getUuid()]."</p>";
        echo "</section>";
    }



} else {
    echo "Accès non autorisé.";
}
?>
