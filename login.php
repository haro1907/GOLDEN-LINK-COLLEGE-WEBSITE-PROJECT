<?php
// Path to the CSV file
$csvFile = 'users.csv';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if login and password fields are set
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login']; // Can be email or username
        $password = $_POST['password'];

        // Open the CSV file for reading
        if (($file = fopen($csvFile, 'r')) !== false) {
            while (($userData = fgetcsv($file)) !== false) {
                $storedUsername = $userData[0];
                $storedEmail = $userData[1];
                $storedPassword = $userData[2];

                // Check if the entered login matches either username or email
                if (($login === $storedUsername || $login === $storedEmail) && password_verify($password, $storedPassword)) {
                    // Correct login, redirect to profile page
                    session_start();
                    $_SESSION['username'] = $storedUsername;
                    $_SESSION['email'] = $storedEmail;
                    $_SESSION['lastname'] = $userData[3];
                    $_SESSION['firstname'] = $userData[4];
                    $_SESSION['middlename'] = $userData[5];
                    $_SESSION['dob'] = $userData[6];
                    $_SESSION['contact'] = $userData[7];

                    // Redirect to profile page
                    header("Location: profile.php");
                    exit();
                }
            }

            // Close the file after reading
            fclose($file);
        }

        // If we reach here, login failed
        echo "Incorrect username or password.";
    } else {
        echo "Please fill in both the username/email and password.";
    }
} else {
    echo "Invalid request method.";
}
?>
