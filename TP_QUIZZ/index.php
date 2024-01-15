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


foreach ($question as $key => $value) {

    $questions[$key] =  new Question($value["uuid"], $value["name"], $value["type"], $value["text"], $value["choices"], $value["answer"], $value["score"]);

}


foreach ($questions as $key => $value) {
    echo "<section>";
    echo "<h1>".$value->getText()."</h1>";
    
    if ($value->getType() == "radio") {
        foreach ($value->getChoices() as $key => $value) {
            echo "<input type='radio' name='radio' value='".$value."'>".$value."<br>";
        }
    }
    
    echo "</section>";
    
    
    
    
}

?>
    
</body>
</html>


