<?php
session_start();
$file_db=new PDO('sqlite:users.sqlite3');
// Check if the user is already logged in, redirect to index.php if true
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate user authentication (replace this with your actual authentication logic)
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Vérifier si l'utilisateur existe déjà
    $checkIfExists = $file_db->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND password = :password");
    $checkIfExists->bindParam(':username', $username);
    $checkIfExists->bindParam(':password', $password);
    $checkIfExists->execute();

    if ($checkIfExists->fetchColumn() > 0) {
        // Authentication successful, set user session
        $_SESSION['user_id'] = 1; // Replace with the actual user ID from your system
        header("Location: index.php");
        exit();
    } else {
        // Authentication failed, show error message
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <div class="login">
        <form action="login.php" method="post">
            <div id="username">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div id="password">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div id="buttons">
                <input type="submit" value="Login">
                <a href="register.php">Register</a>
            </div>
            
        </form>
    </div>
</body>
</html>
