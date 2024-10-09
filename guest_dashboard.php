<?php
session_start();
if ($_SESSION['role'] != 'guest') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guest Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome, Guest</h2>
            <p>You have limited access. Please contact admin for more information.</p>
            <a href="logout.php" class="logout-button">Log Out</a>
        </div>
    </div>
</body>
</html>
