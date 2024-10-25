<?php
session_start();

// Path to the CSV file
$csvFile = 'users.csv';

// Open the original CSV file for reading
if (($file = fopen($csvFile, 'r')) !== false) {
    // Open a temporary CSV file for writing
    $tempFile = fopen('temp.csv', 'w');

    // Loop through each row in the CSV
    while (($userData = fgetcsv($file)) !== false) {
        $storedUsername = $userData[0]; // Username from CSV

        // If the username does not match the logged-in user's username, write it to the temp file
        if ($storedUsername !== $_SESSION['username']) {
            fputcsv($tempFile, $userData);
        }
    }

    // Close both files
    fclose($file);
    fclose($tempFile);

    // Replace the original CSV file with the temp file
    rename('temp.csv', $csvFile);

    // Destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit();
} else {
    // If file couldn't be opened, display error
    echo "Error: Could not open the file.";
}
?>
