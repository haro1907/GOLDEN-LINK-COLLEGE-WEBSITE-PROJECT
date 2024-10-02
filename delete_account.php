<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Define the file to store user data
$userFile = 'users.txt';
$usernameToDelete = $_SESSION['username'];

// Check if the file exists
if (file_exists($userFile)) {
    // Read all lines into an array
    $users = file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Open the file for writing (overwrite mode)
    $file = fopen($userFile, 'w');

    // Iterate through users and write back all except the one to delete
    foreach ($users as $user) {
        list($storedUsername, $storedPassword) = explode(',', $user);
        if ($storedUsername !== $usernameToDelete) {
            fwrite($file, $user . PHP_EOL);
        }
    }

    // Close the file
    fclose($file);

    // Unset the session and log the user out
    session_unset();
    session_destroy();

    // Redirect to the login page with a message
    echo "<script>
        alert('Your account has been deleted successfully.');
        window.location.href = 'index.html';
    </script>";
} else {
    echo "<script>
        alert('Error: User file not found.');
        window.location.href = 'index.html';
    </script>";
}
?>
