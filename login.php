<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get identifier (username or email) and password
    $identifier = trim($_POST['identifier']); // Username or Email
    $password = trim($_POST['password']);

    // Read the users.txt file
    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $isAuthenticated = false;

    foreach ($users as $user) {
        $data = explode(',', $user);

        // Assuming structure: lastname, firstname, middlename, dob, contact, email, username, password
        $storedEmail = trim($data[5]);
        $storedUsername = trim($data[6]);
        $storedPassword = trim($data[7]);

        // Check if identifier matches either email or username
        if (($identifier === $storedUsername || $identifier === $storedEmail) && $password === $storedPassword) {
            // Store user data in session for future use
            $_SESSION['userData'] = [
                'lastname' => trim($data[0]),
                'firstname' => trim($data[1]),
                'middlename' => trim($data[2]),
                'dob' => trim($data[3]),
                'contact' => trim($data[4]),
                'email' => $storedEmail,
                'username' => $storedUsername,
            ];
            $isAuthenticated = true;
            break;
        }
    }

    // If user is authenticated, redirect to profile page
    if ($isAuthenticated) {
        header("Location: profile.php");
        exit();
    } else {
        echo "<script>alert('Wrong username/email or password. Please try again.'); window.location.href = 'index.html';</script>";
        exit();
    }
}
?>
