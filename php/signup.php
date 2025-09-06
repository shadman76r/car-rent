<?php
// Define error messages
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Username Validation (Check ASCII values for alphabets and numbers)
    $usernameValid = true;
    for ($i = 0; $i < strlen($username); $i++) {
        $charCode = ord($username[$i]);
        if (!((($charCode >= 48 && $charCode <= 57) || // digits (0-9)
              ($charCode >= 65 && $charCode <= 90) || // uppercase letters (A-Z)
              ($charCode >= 97 && $charCode <= 122) || // lowercase letters (a-z)
              $charCode == 95))) { // underscore (_)
            $usernameValid = false;
            break;
        }
    }

    if (!$usernameValid || strlen($username) < 3 || strlen($username) > 20) {
        $errors[] = "Invalid username! It should be alphanumeric (with underscores) and between 3 to 20 characters.";
    }

    // Email Validation (Must have at least 6 characters with special characters)
    if (strlen($email) < 6) {
        $errors[] = "Invalid email! It must be at least 6 characters long.";
    }

    $specialCharCount = 0;
    for ($i = 0; $i < strlen($email); $i++) {
        $charCode = ord($email[$i]);

        // Check if the character is a letter (lowercase or uppercase), number, or special character
        if (!((($charCode >= 48 && $charCode <= 57) || // digits (0-9)
              ($charCode >= 65 && $charCode <= 90) || // uppercase letters (A-Z)
              ($charCode >= 97 && $charCode <= 122) || // lowercase letters (a-z)
              $charCode == 46 || // period (.)
              $charCode == 64))) { // at symbol (@)
            $errors[] = "Invalid email! It contains invalid characters.";
            break;
        }

        // Count the special characters (should be at least one)
        if ($charCode == 46 || $charCode == 64) {
            $specialCharCount++;
        }
    }

    if ($specialCharCount === 0) {
        $errors[] = "Email must contain at least one special character (@ or .)";
    }

    // Contact Number Validation (Should be exactly 10 digits)
    if (strlen($contact) !== 10) {
        $errors[] = "Invalid contact number! It should be exactly 10 digits.";
    } else {
        for ($i = 0; $i < strlen($contact); $i++) {
            $charCode = ord($contact[$i]);
            if ($charCode < 48 || $charCode > 57) { // Check if it's not a digit (0-9)
                $errors[] = "Invalid contact number! It should only contain digits.";
                break;
            }
        }
    }

    // Password Validation (At least 8 characters with at least one number)
    if (strlen($password) < 8) {
        $errors[] = "Password should be at least 8 characters long.";
    }

    $hasNumber = false;
    for ($i = 0; $i < strlen($password); $i++) {
        $charCode = ord($password[$i]);

        // Check if the character is a letter (lowercase or uppercase) or a number
        if ($charCode >= 48 && $charCode <= 57) { // Check if it's a number (0-9)
            $hasNumber = true;
        }

        if (!(  // Allow only letters (A-Z, a-z), numbers (0-9), and no special characters
            ($charCode >= 65 && $charCode <= 90) || // uppercase letters (A-Z)
            ($charCode >= 97 && $charCode <= 122) || // lowercase letters (a-z)
            ($charCode >= 48 && $charCode <= 57) // digits (0-9)
        )) {
            $errors[] = "Password should only contain letters and numbers, no special characters allowed.";
            break;
        }
    }

    if (!$hasNumber) {
        $errors[] = "Password should contain at least one number.";
    }

    // Confirm Password Validation
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // If there are any errors, display them
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // If validation passes, process the form (e.g., save data to the database)
        echo "<p style='color:green;'>Form submitted successfully!</p>";
    }
}
?>

<!-- HTML form for the signup page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>

    <form method="POST" action="signup.php">
        <!-- username -->
        <input type="text" name="username" placeholder="Username"> <br>
        <!-- email -->
        <input type="email" name="email" placeholder="Email"> <br>
        <!-- contact number -->
        <input type="text" name="contact" placeholder="Contact Number"> <br>
        <!-- new password -->
        <input type="password" name="password" placeholder="New Password"> <br>
        <!-- confirm password -->
        <input type="password" name="confirmPassword" placeholder="Confirm Password"> <br>

        <button type="submit">Sign Up</button> <br>
    </form>
</body>
</html>
