<?php

date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appellera users.sqlite3
  $file_db=new PDO('sqlite:users.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  $file_db->exec("CREATE TABLE IF NOT EXISTS users ( 
    id INTEGER PRIMARY KEY,
    username TEXT,
    password TEXT)");

  $users=array(
    array('username' => 'irvyncsm',
      'password' => 'irvyncsm'),
    array('username' => 'amael',
      'password' => 'amael')
    );

    $insert="INSERT INTO users (username, password) VALUES (:username, :password )";
  $stmt=$file_db->prepare($insert);
  // on lie les parametres aux variables
  $stmt->bindParam(':username',$username);
  $stmt->bindParam(':password',$password);

  foreach ($users as $u) {
    $username = $u['username'];
    $password = $u['password'];

    // Vérifier si l'utilisateur existe déjà
    $checkIfExists = $file_db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $checkIfExists->bindParam(':username', $username);
    $checkIfExists->execute();

    // Si l'utilisateur n'existe pas, alors l'ajouter
    if ($checkIfExists->fetchColumn() == 0) {
        $stmt->execute();
    }
}


  // on va tester le contenu de la table users
  $result=$file_db->query('SELECT * from users');
  // on ferme la connexion
  $file_db=null;



}catch(PDOException $ex){
    echo $ex->getMessage();
}
?>