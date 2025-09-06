// Email Validation (using ASCII values)
function validateEmail(email) {
    let specialCharCount = 0;
    let isValid = true;

    if (email.length < 6) {
        isValid = false;
    }

    for (let i = 0; i < email.length; i++) {
        const charCode = email.charCodeAt(i);

        // Check if the character is a letter (lowercase or uppercase), number, or special character
        if (!((charCode >= 48 && charCode <= 57) || // digits (0-9)
              (charCode >= 65 && charCode <= 90) || // uppercase letters (A-Z)
              (charCode >= 97 && charCode <= 122) || // lowercase letters (a-z)
              charCode === 46 || // period (.)
              charCode === 64)) { // at symbol (@)
            isValid = false;
            break;
        }

        // Count the special characters (should be at least one)
        if (charCode === 46 || charCode === 64) {
            specialCharCount++;
        }
    }

    if (specialCharCount === 0) {
        isValid = false;  // Ensure there is at least one special character
    }

    return isValid;
}

// Contact Number Validation (using ASCII values)
function validateContact(contact) {
    if (contact.length !== 10) {
        return false;  // Ensure it is exactly 10 characters
    }

    for (let i = 0; i < contact.length; i++) {
        const charCode = contact.charCodeAt(i);
        if (charCode < 48 || charCode > 57) {  // Check if it's a digit (0-9)
            return false;
        }
    }

    return true;
}

// Password Validation (using ASCII values)
function validatePassword(password) {
    let hasNumber = false;

    if (password.length < 8) {
        return false;  // Ensure the password is at least 8 characters long
    }

    for (let i = 0; i < password.length; i++) {
        const charCode = password.charCodeAt(i);

        // Check if the character is a letter (lowercase or uppercase) or a number
        if ((charCode >= 48 && charCode <= 57)) {  // Check if it's a number (0-9)
            hasNumber = true;
        }

        if (!(  // Allow only letters (A-Z, a-z), numbers (0-9), and no special characters
            (charCode >= 65 && charCode <= 90) || // uppercase letters (A-Z)
            (charCode >= 97 && charCode <= 122) || // lowercase letters (a-z)
            (charCode >= 48 && charCode <= 57) // digits (0-9)
        )) {
            return false;
        }
    }

    return hasNumber;  // Ensure there's at least one number
}

// Form Submission and Validation
document.getElementById('signupForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission for validation

    // Get form fields
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const contact = document.getElementById('contact');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    // Username Validation (Check ASCII values for alphabets and numbers)
    let usernameValid = true;
    for (let i = 0; i < username.value.length; i++) {
        const charCode = username.value.charCodeAt(i);
        if (!(charCode >= 48 && charCode <= 57) && // digits (0-9)
            !(charCode >= 65 && charCode <= 90) && // uppercase letters (A-Z)
            !(charCode >= 97 && charCode <= 122) && // lowercase letters (a-z)
            charCode !== 95) { // underscore (_)
            usernameValid = false;
            break;
        }
    }
    if (!usernameValid || username.value.length < 3 || username.value.length > 20) {
        alert("Invalid username! It should be alphanumeric (with underscores) and between 3 to 20 characters.");
        return;
    }

    // Email Validation (using ASCII values)
    if (!validateEmail(email.value)) {
        alert("Invalid email! It must be at least 6 characters long and contain special characters.");
        return;
    }

    // Contact Number Validation (using ASCII values)
    if (!validateContact(contact.value)) {
        alert("Invalid contact number! It should be exactly 10 digits.");
        return;
    }

    // Password Validation (using ASCII values)
    if (!validatePassword(password.value)) {
        alert("Password should be at least 8 characters long and contain at least one number.");
        return;
    }

    // Confirm Password Validation
    if (password.value !== confirmPassword.value) {
        alert("Passwords do not match.");
        return;
    }

    // If all validations pass, submit the form
    alert("Form submitted successfully!");
    this.submit();
});
