<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $dob = trim($_POST['dob']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ensure all required fields are filled
    if (empty($lastname) || empty($firstname) || empty($middlename) || empty($dob) || empty($contact) || empty($email) || empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href = 'register.html';</script>";
        exit();
    }

    // Prepare the user data string to write to the file
    $userData = $lastname . ',' . $firstname . ',' . $middlename . ',' . $dob . ',' . $contact . ',' . $email . ',' . $username . ',' . $password . PHP_EOL;

    // Write the data to the file
    $file = fopen('users.txt', 'a');
    fwrite($file, $userData);
    fclose($file);

    // Redirect back to the login page
    echo "<script>alert('Registration successful! You can now log in.'); window.location.href = 'index.html';</script>";
    exit();
}
?>
