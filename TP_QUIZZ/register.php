<?php

$file_db = new PDO('sqlite:users.sqlite3');
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordVerify = $_POST['passwordVerify'];

    if ($password != $passwordVerify) {
        $error_message = "Passwords don't match";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $checkIfExists = $file_db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $checkIfExists->bindParam(':username', $username);
        $checkIfExists->execute();

        if ($checkIfExists->fetchColumn() > 0) {
            $error_message = "Ce nom existe déjà";
        } else {
            $stmt = $file_db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            echo '<script>window.location.href = "login.php";</script>';
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/register.css">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>

    <?php
    if (!empty($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <div class="register">
        <form action="register.php" method="post">
            <div class="fields">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="fields">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="passwordVerify">Confirm password</label> 
                <input type="password" id="passwordVerify" name="passwordVerify" required>
            </div>

            <div id="buttons">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>
