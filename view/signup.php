<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    $usernameValid = true;
    for ($i = 0; $i < strlen($username); $i++) {
        $charCode = ord($username[$i]);
        if (!((($charCode >= 48 && $charCode <= 57) ||  
              ($charCode >= 65 && $charCode <= 90) ||  
              ($charCode >= 97 && $charCode <= 122) || 
              $charCode == 95))) {  
            $usernameValid = false;
            break;
        }
    }

    if (!$usernameValid || strlen($username) < 3 || strlen($username) > 20) {
        $errors[] = "Username should be alphanumeric (with underscores) and between 3 to 20 characters.";
    }

  
    if (strlen($email) < 6) {
        $errors[] = "Email must be at least 6 characters long.";
    }

  
    $specialCharCount = 0;
    for ($i = 0; $i < strlen($email); $i++) {
        $charCode = ord($email[$i]);
        if (!((($charCode >= 48 && $charCode <= 57) ||
              ($charCode >= 65 && $charCode <= 90) || 
              ($charCode >= 97 && $charCode <= 122) || 
              $charCode == 46 || 
              $charCode == 64))) { 
            $errors[] = "Email contains invalid characters.";
            break;
        }

      
        if ($charCode == 46 || $charCode == 64) {
            $specialCharCount++;
        }
    }

    if ($specialCharCount === 0) {
        $errors[] = "Email must contain at least one special character (@ or .)";
    }

   
    if (strlen($contact) !== 11) {
        $errors[] = "Contact number must be exactly 11 digits.";
    } else {
        for ($i = 0; $i < strlen($contact); $i++) {
            $charCode = ord($contact[$i]);
            if ($charCode < 48 || $charCode > 57) {
                $errors[] = "Contact number should only contain digits.";
                break;
            }
        }
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    $hasNumber = false;
    for ($i = 0; $i < strlen($password); $i++) {
        $charCode = ord($password[$i]);
        if ($charCode >= 48 && $charCode <= 57) {
            $hasNumber = true;
        }

        if (!((($charCode >= 65 && $charCode <= 90) || 
               ($charCode >= 97 && $charCode <= 122) ||
               ($charCode >= 48 && $charCode <= 57)))) { 
            $errors[] = "Password should only contain letters and numbers, no special characters allowed.";
            break;
        }
    }

    if (!$hasNumber) {
        $errors[] = "Password must contain at least one number.";
    }
 
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }
  
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        
        echo "<p style='color:green;'>Form submitted successfully!</p>";

        header('Location: home.html'); 
        exit(); 
    }
}
?>
