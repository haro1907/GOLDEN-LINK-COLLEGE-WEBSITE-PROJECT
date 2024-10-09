<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome, Student</h2>
            <p>You have access to your courses and grades.</p>
            <a href="logout.php" class="logout-button">Log Out</a>
        </div>
    </div>
</body>
</html>
