<?php

date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appellera users.sqlite3
  $file_db=new PDO('sqlite:users.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  $file_db->exec("CREATE TABLE IF NOT EXISTS users ( 
    id INTEGER PRIMARY KEY,
    nom TEXT,
    prenom TEXT)");

  $users=array(
    array('nom' => 'Coursimault',
      'prenom' => 'Irvyn'),
    array('nom' => 'Maserati',
      'prenom' => 'Amael')
    );

    $insert="INSERT INTO users (nom, prenom) VALUES (:nom, :prenom )";
  $stmt=$file_db->prepare($insert);
  // on lie les parametres aux variables
  $stmt->bindParam(':nom',$nom);
  $stmt->bindParam(':prenom',$prenom);

  foreach ($users as $u) {
    $nom = $u['nom'];
    $prenom = $u['prenom'];

    // Vérifier si l'utilisateur existe déjà
    $checkIfExists = $file_db->prepare("SELECT COUNT(*) FROM users WHERE nom = :nom AND prenom = :prenom");
    $checkIfExists->bindParam(':nom', $nom);
    $checkIfExists->bindParam(':prenom', $prenom);
    $checkIfExists->execute();

    // Si l'utilisateur n'existe pas, alors l'ajouter
    if ($checkIfExists->fetchColumn() == 0) {
        $stmt->execute();
        echo "Insertion de $prenom $nom en base réussie !<br/>";
    } else {
        echo "L'utilisateur $prenom $nom existe déjà, il n'a pas été ajouté.<br/>";
    }
}
  
  echo "Insertion en base reussie !";

  // on va tester le contenu de la table users
  $result=$file_db->query('SELECT * from users');
  foreach ($result as $m){
    echo "<br/>\n".$m['prenom'].' '.$m['nom'];
  }
  // on ferme la connexion
  $file_db=null;



}catch(PDOException $ex){
    echo $ex->getMessage();
}
?>