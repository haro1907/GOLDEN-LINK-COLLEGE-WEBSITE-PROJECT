<?php
session_start();

// Path to the CSV file
$csvFile = 'ACC_glc_users.csv';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture all form fields
    $id = $_POST['id'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $dob = $_POST['dob'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role']; // Capturing the role
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match. Please re-enter the password.";
        exit();
    }
    
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Validate that all required fields are filled
    if (empty($id) || empty($lastname) || empty($firstname) || empty($dob) || empty($username) || empty($contact) || empty($email) || empty($password) || empty($role)) {
        echo "All fields are required.";
        exit();
    }

    // Check if the CSV file exists or create it with headers
    if (!file_exists($csvFile)) {
        $file = fopen($csvFile, 'w');
        if ($file === FALSE) {
            echo "Unable to create the file. Please check permissions.";
            exit();
        }
        // Add headers if creating the file
        fputcsv($file, ['ID Number', 'Username', 'Email', 'Password', 'Last Name', 'First Name', 'Middle Name', 'Date of Birth', 'Contact', 'Role']);
        fclose($file);
    }

    // Ensure the file is writable
    if (is_writable($csvFile)) {
        // Open the CSV file for appending
        $file = fopen($csvFile, 'a');

        // Store the user data
        $userData = [
            $id,
            $username,
            $email,
            $hashedPassword,
            $lastname,
            $firstname,
            $middlename,
            $dob,
            $contact,
            $role // Storing the role
        ];

        // Write user data to the CSV file
        fputcsv($file, $userData);

        // Close the file
        fclose($file);

        // Redirect to login page after successful registration
        header("Location: HTML_glc_login.html");
        exit();
    } else {
        echo "Unable to write to the file. Please check file permissions.";
        exit();
    }
}
?>
