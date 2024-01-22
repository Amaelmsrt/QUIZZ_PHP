<?php

session_start();

// SPL autoloader
require 'Classes/autoloader.php'; 
Autoloader::register(); 

use Form\Type\Text;
use Form\Type\Checkbox;
use Form\Type\Hidden;
use Form\Type\Textarea;
use Form\Question;

$fichier = file_get_contents("./Data/questions_2.json");
$question = json_decode($fichier, true);
$questions = [];

$_SESSION["id_quiz"] = 2;

echo "<link rel='stylesheet' href='styles/style.css'>";

echo "<h1> Répondez aux questions</h1>";

foreach ($question as $key => $value) {
    $questions[$key] =  new Question($value["uuid"], $value["name"], $value["type"], $value["text"], $value["answer"], $value["score"], $value["choices"]);
}
$_SESSION["questions"] = $questions;


echo "<form action='Submit.php' method='post'>";
foreach ($questions as $key => $value) {
    echo "<ul>";
    echo "<li>";
    echo "<section>";
    echo "<h3>".$value->getText()."</h3>";
    
    if ($value->getType() == "radio") {
        foreach ($value->getChoices() as $choice) {
            echo "<input type='radio' name='reponses[".$value->getUuid()."]' value='".$choice."' required>".$choice."<br>";
            echo "<input type='hidden' name='reponses_hidden[".$value->getUuid()."]' value='".$value->getAnswer()."'>";
            echo "<input type='hidden' name='scores_reponses[".$value->getUuid()."]' value='".$value->getScore()."'>";
        }
    } else if ($value->getType() == "text") {
        echo "<input type='text' name='reponses[".$value->getUuid()."]' value=''>";
        echo "<input type='hidden' name='reponses_hidden[".$value->getUuid()."]' value='".$value->getAnswer()."'>";
        echo "<input type='hidden' name='scores_reponses[".$value->getUuid()."]' value='".$value->getScore()."'>";
    }    
    echo "</section>";
    echo "</li>";
    echo "</ul>";
}
echo "<div class='envoyer'>";
echo "<input type='submit' value='Envoyer'>";
echo "</div>";
echo "</form>";

?>