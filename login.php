<?php
session_start();

// Path to the CSV file
$csvFile = 'users.csv';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Open the CSV file for reading
    if (($file = fopen($csvFile, 'r')) !== FALSE) {
        while (($userData = fgetcsv($file)) !== FALSE) {
            $username = $userData[0];
            $email = $userData[1];
            $hashedPassword = $userData[2];
            $role = $userData[8]; // Role is stored in index 8

            // Check if the username or email matches
            if (($usernameOrEmail == $username || $usernameOrEmail == $email) && password_verify($password, $hashedPassword)) {
                // Store user data in the session
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirect based on user role
                if ($role == 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($role == 'student') {
                    header("Location: student_dashboard.php");
                } elseif ($role == 'guest') {
                    header("Location: guest_dashboard.php");
                }
                exit();
            }
        }
        fclose($file);
    }
    // If login fails
    echo "Incorrect username or password.";
}
?>
