<?php
session_start();

// Path to the CSV file
$csvFile = 'users.csv';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username_or_email']) || empty($_POST['password'])) {
        echo "Please fill in all required fields.";
    } else {
        $usernameOrEmail = filter_var($_POST['username_or_email'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        // Check if the CSV file exists and is readable
        if (is_readable($csvFile)) {
            // Open the CSV file for reading
            if (($file = fopen($csvFile, 'r')) !== FALSE) {
                $loginSuccess = false;
                while (($userData = fgetcsv($file)) !== FALSE) {
                    $username = $userData[0];
                    $email = $userData[1];
                    $hashedPassword = $userData[2];
                    $lastname = $userData[3];
                    $firstname = $userData[4];
                    $middlename = $userData[5];
                    $dob = $userData[6];
                    $contact = $userData[7];
                    $role = $userData[8]; // Role is stored in index 8

                    // Check if the username or email matches
                    if (($usernameOrEmail == $username || $usernameOrEmail == $email) && password_verify($password, $hashedPassword)) {
                        // Store user data in the session
                        $_SESSION['username'] = $username;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['middlename'] = $middlename;
                        $_SESSION['email'] = $email;
                        $_SESSION['dob'] = $dob;
                        $_SESSION['contact'] = $contact;
                        $_SESSION['role'] = $role;

                        // Redirect based on user role
                        if ($role == 'admin') {
                            header("Location: admin_dashboard.php");
                        } elseif ($role == 'student') {
                            header("Location: student_dashboard.php");
                        } elseif ($role == 'guest') {
                            header("Location: guest_dashboard.php");
                        }
                        $loginSuccess = true;
                        exit();
                    }
                }
                fclose($file);
                
                if (!$loginSuccess) {
                    echo "Incorrect username or password.";
                }
            } else {
                echo "Error reading the user data file.";
            }
        } else {
            echo "User data file is not accessible.";
        }
    }
}
?>
