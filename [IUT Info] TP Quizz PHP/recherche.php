<?php
date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appelle contacts.sqlite3
  $file_db=new PDO('sqlite:contacts.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  
  $stmt=$file_db->query("SELECT * from contacts where id='"
.$_GET['ID']."'");
  $pers=$stmt->fetchObject();
 echo $pers->prenom.' '.$pers->nom.' '.date('Y-m-d',$pers->time);
  // on ferme la connexion
  $file_db=null;
}
catch(PDOException $ex){
  echo $ex->getMessage();
}