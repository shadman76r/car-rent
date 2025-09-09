<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);

    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required!";
    }

    if (empty($password)) {
        $errors[] = "Password is required!";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
 
        $valid_username = 'prima'; 
        $valid_password = '1234';  

        if ($username === $valid_username && $password === $valid_password) {
         
            $_SESSION['username'] = $username;

           
            header('Location: home.html');  
            exit();
        } else {
          
            echo "<p style='color:red;'>Invalid username or password!</p>";
        }
    }
}
?>

<!-- done -->
