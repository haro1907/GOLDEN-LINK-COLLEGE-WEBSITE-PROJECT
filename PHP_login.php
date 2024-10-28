<?php
session_start();

// Path to the CSV file
$csvFile = 'ACC_glc_users.csv';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username_or_email']) || empty($_POST['password'])) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
    } else {
        $usernameOrEmail = filter_var($_POST['username_or_email'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        // Check if the CSV file exists and is readable
        if (is_readable($csvFile)) {
            // Open the CSV file for reading
            if (($file = fopen($csvFile, 'r')) !== FALSE) {
                $loginSuccess = false;
                while (($userData = fgetcsv($file)) !== FALSE) {
                    $id = $userData[0];
                    $username = $userData[1];
                    $email = $userData[2];
                    $hashedPassword = $userData[3];
                    $lastname = $userData[4];
                    $firstname = $userData[5];
                    $middlename = $userData[6];
                    $dob = $userData[7];
                    $contact = $userData[8];
                    $role = $userData[9];

                    // Check if the username or email matches
                    if (($usernameOrEmail == $username || $usernameOrEmail == $email) && password_verify($password, $hashedPassword)) {
                        // Store user data in the session
                        $_SESSION['id'] = $id;
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
                            header("Location: HTML_glc_dashADMIN.html");
                        } elseif ($role == 'student') {
                            header("Location: HTML_glc_dashSTUDENT.html");
                        }
                        $loginSuccess = true;
                        exit();
                    }
                }
                fclose($file);
                
                if (!$loginSuccess) {
                    echo "<script>
                        if (confirm('Incorrect username or password. Click OK to try again.')) {
                            window.history.back();
                        }
                    </script>";
                }
            } else {
                echo "<script>alert('Error reading the user data file.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('User data file is not accessible.'); window.history.back();</script>";
        }
    }
}
?>
