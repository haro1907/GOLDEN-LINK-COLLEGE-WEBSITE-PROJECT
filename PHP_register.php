<?php
session_start();

// Database connection details
$host = 'localhost';
$db = 'webglc_database';
$user = 'root'; // Default MySQL username in XAMPP
$pass = '';     // Default MySQL password (usually empty in XAMPP)

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

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
    $role = $_POST['role'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match. Please re-enter the password.'); window.history.back();</script>";
        exit();
    }

    // Validate email format to end with @goldenlink.ph
    if (!preg_match("/@goldenlink\.ph$/", $email)) {
        echo "<script>alert('Email must end with @goldenlink.ph.'); window.history.back();</script>";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Validate that all required fields are filled
    if (empty($id) || empty($lastname) || empty($firstname) || empty($dob) || empty($username) || empty($contact) || empty($email) || empty($password) || empty($role)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }

    // Check for existing ID
    $id_check = $pdo->prepare("SELECT COUNT(*) FROM glc_users WHERE id = :id");
    $id_check->execute([':id' => $id]);
    if ($id_check->fetchColumn() > 0) {
        echo "<script>alert('ID already exists. Please use a different ID.'); window.history.back();</script>";
        exit();
    }

    // Check for existing username
    $username_check = $pdo->prepare("SELECT COUNT(*) FROM glc_users WHERE username = :username");
    $username_check->execute([':username' => $username]);
    if ($username_check->fetchColumn() > 0) {
        echo "<script>alert('Username already taken. Please choose a different username.'); window.history.back();</script>";
        exit();
    }

    // Prepare the SQL query to insert the user data into the MySQL database
    $sql = "INSERT INTO glc_users (id, username, email, hashedPassword, lastname, firstname, middlename, dob, contact, role) 
            VALUES (:id, :username, :email, :password, :lastname, :firstname, :middlename, :dob, :contact, :role)";
    $stmt = $pdo->prepare($sql);

    // Execute the query
    if ($stmt->execute([
        ':id' => $id,
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':middlename' => $middlename,
        ':dob' => $dob,
        ':contact' => $contact,
        ':role' => $role
    ])) {
        // Redirect to login page after successful registration
        header("Location: HTML_glc_login.html");
        exit();
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
        exit();
    }
}
?>
