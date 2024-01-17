<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reponses'])) {
    if (isset($_SESSION["questions"])) {
        $questions = $_SESSION["questions"];
    }
    

    foreach ($questions as $question) {
        echo "Question: " . $question['question'] . "<br>";
        echo "Votre réponse: " . $_POST['reponses'][$question['id']] . "<br>";
        echo "Réponse correcte: " . $question['reponse'] . "<br><br>";
    }
} else {
    echo "Accès non autorisé.";
}
?>
