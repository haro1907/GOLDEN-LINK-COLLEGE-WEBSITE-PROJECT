<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome, Admin</h2>
            <p>You have full access to the system.</p>
            <a href="logout.php" class="logout-button">Log Out</a>
        </div>
    </div>
</body>
</html>
