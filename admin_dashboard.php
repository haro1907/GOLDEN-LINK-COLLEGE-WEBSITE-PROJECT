<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome, Admin <?php echo $_SESSION['username']; ?>!</p>
        
        <div class="admin-actions">
            <h3>Admin Actions:</h3>
            <ul>
                <li><a href="view_users.php">View All Users</a></li>
                <li><a href="add_user.php">Add New User</a></li>
                <li><a href="delete_user.php">Delete User</a></li>
                <li><a href="view_logs.php">View Logs</a></li>
                <li><a href="system_settings.php">System Settings</a></li>
            </ul>
        </div>
        
        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
