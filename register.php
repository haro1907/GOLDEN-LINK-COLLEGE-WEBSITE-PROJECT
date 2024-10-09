<?php
// Path to the CSV file
$csvFile = 'users.csv';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];  // Get the role

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the CSV file is writable
    if (is_writable($csvFile)) {
        // Open the CSV file for writing (append mode)
        $file = fopen($csvFile, 'a');

        // Create a user array (representing a row in the CSV)
        $userData = [$username, $email, $hashedPassword, $lastname, $firstname, $middlename, $dob, $contact, $role];

        // Write the user data to the CSV file
        fputcsv($file, $userData);

        // Close the file
        fclose($file);

        // Redirect back to the login page after registration
        header("Location: index.html");
        exit();
    } else {
        echo "Unable to write to the file. Please check file permissions.";
    }
}
?>
