<?php

date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appellera contacts.sqlite3
  $file_db=new PDO('sqlite:contacts.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  
  echo "<h1>Ma liste de contacts</h1>";
  // on va tester le contenu de la table contacts
  $result=$file_db->query('SELECT * from contacts');
  echo "<ul>";
  foreach ($result as $m){
    echo "<li>".$m['prenom'].' '.$m['nom'].' '.date('Y-m-d H:i:s',$m['time'])."</li>";
  }
  echo "</ul>";
  // on ferme la connexion
  $file_db=null;



}catch(PDOException $ex){
    echo $ex->getMessage();
}
?>