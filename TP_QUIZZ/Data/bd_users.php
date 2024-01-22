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

  $file_db->exec("CREATE TABLE IF NOT EXISTS quizz (
    id INTEGER PRIMARY KEY,
    quiz_name TEXT
  )");

  $file_db->exec("CREATE TABLE IF NOT EXISTS user_quizz (
    id_user INTEGER,
    id_quiz INTEGER,
    score INTEGER,
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_quiz) REFERENCES quizz(id),
    PRIMARY KEY (id_user, id_quiz)
  )");


  $users=array(
    array('username' => 'irvyncsm',
      'password' => 'irvyncsm'),
    array('username' => 'amael',
      'password' => 'amael')
    );

    $quizz = array(
      array('quiz_name' => 'Quiz PHP'),
      array('quiz_name' => 'Quiz Python')
  );

  $insertQuiz = "INSERT INTO quizz (quiz_name) VALUES (:quiz_name)";
  $stmtQuiz = $file_db->prepare($insertQuiz);
  $stmtQuiz->bindParam(':quiz_name', $quizName);

  foreach ($quizz as $q) {
      $quizName = $q['quiz_name'];
      $stmtQuiz->execute();
  }

  $insertQuiz = "INSERT INTO user_quizz (id_user, id_quiz, score) VALUES (:id_user, :id_quiz, :score)";
  $stmtQuiz = $file_db->prepare($insertQuiz);
  $stmtQuiz->bindParam(':id_user', $idUser);
  $stmtQuiz->bindParam(':id_quiz', $idQuiz);
  $stmtQuiz->bindParam(':score', $score);

  $idUser = 1;
  $idQuiz = 1;
  $score = 10;
  $stmtQuiz->execute();

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
        echo "Insertion de $username en base réussie !<br/>";
    } else {
        echo "L'utilisateur $username existe déjà, il n'a pas été ajouté.<br/>";
    }
}
  
  echo "Insertion en base reussie !";

  // on va tester le contenu de la table users
  $result=$file_db->query('SELECT * from users');
  foreach ($result as $m){
    echo "<br/>\n".$m['username'];
  }
  // on ferme la connexion
  $file_db=null;



}catch(PDOException $ex){
    echo $ex->getMessage();
}
?>