<?php
session_start();

// Define the file to store user data
$userFile = 'users.txt';

// Retrieve form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Check if the file exists and load users
if (!file_exists($userFile)) {
    echo "<script>alert('No registered users found.'); window.history.back();</script>";
    exit();
}

// Read the file line by line
$users = file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Validate user credentials
foreach ($users as $user) {
    list($storedUsername, $storedPasswordHash) = explode(',', $user);
    
    // Check if the entered username matches the stored username
    if ($storedUsername === $username) {
        // Use password_verify() to compare the entered password with the stored hash
        if (password_verify($password, $storedPasswordHash)) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            echo "<script>alert('Invalid username or password'); window.history.back();</script>";
            exit();
        }
    }
}

// If no match is found
echo "<script>alert('Invalid username or password'); window.history.back();</script>";
?>
