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
    echo "<h1> Vos réponses </h1>";
    foreach ($questions as $key => $value) {
        echo "<h3>".$value->getText()."</h3>";
        echo "<p> Votre réponse : ".$_POST['reponses'][$value->getUuid()]."</p>";
        echo "<p> La réponse attendue : ".$value->getAnswer()."</p>";
        if ($_POST['reponses'][$value->getUuid()] == $value->getAnswer()) {
            echo "<p> Bonne réponse ! </p>";
        } else {
            echo "<p> Mauvaise réponse ! </p>";
        }
    }



} else {
    echo "Accès non autorisé.";
}
?>
