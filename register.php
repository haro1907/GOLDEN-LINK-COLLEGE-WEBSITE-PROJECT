<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the file to store user data
$userFile = 'users.txt';

// Get form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Check if the file exists
if (!file_exists($userFile)) {
    // Create the file if it doesn't exist
    file_put_contents($userFile, "");
}

// Read the contents of the file and store them in an array
$users = file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Check if the username already exists
foreach ($users as $user) {
    list($storedUsername, $storedPassword) = explode(',', $user);
    if ($storedUsername === $username) {
        echo "<script>alert('Username already exists. Please choose another.'); window.history.back();</script>";
        exit();
    }
}

// Save new user data (hash the password for security)
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$newUser = $username . "," . $hashedPassword . "\n"; // Prepare the new line

// Append the new user data to the file and check for errors
if (file_put_contents($userFile, $newUser, FILE_APPEND) === false) {
    echo "<script>alert('Error: Unable to write to file.'); window.history.back();</script>";
} else {
    echo "<script>
        alert('Registration successful! You will be redirected to the login page.');
        window.location.href = 'index.html';
    </script>";
}
?>
