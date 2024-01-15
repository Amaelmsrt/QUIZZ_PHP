<html lang="fr">


<body>
<?php
// SPL autoloader
require 'Classes/autoloader.php'; 
Autoloader::register(); 

// Go
use Form\Type\Text;
use Form\Type\Checkbox;
use Form\Type\Hidden;
use Form\Type\Textarea;
use Form\Question;

$fichier = file_get_contents("./Data/questions.json");
$question = json_decode($fichier, true);
$questions = [];

echo "<h1> Répondez aux questions</h1>";

foreach ($question as $key => $value) {

    $questions[$key] =  new Question($value["uuid"], $value["name"], $value["type"], $value["text"], $value["answer"], $value["score"], $value["choices"]);

}

echo "<form action='result.php' method='post'>";
foreach ($questions as $key => $value) {
    echo "<ul>";
    echo "<li>";
    echo "<section>";
    echo "<h3>".$value->getText()."</h3>";
    
    if ($value->getType() == "radio") {
        foreach ($value->getChoices() as $key => $value) {
            echo "<input type='radio' name='radio' value='".$value."'>".$value."<br>";
        }
    } else if ($value->getType() == "text") {
        echo "<textarea name='textarea' rows='1' cols='20'></textarea>";
    } 
    echo "</section>";
    echo "</li>";
    echo "</ul>";
    
    
    
}
echo "<input type='submit' value='Envoyer'>";
echo "</form>";
?>
    
</body>
</html>


