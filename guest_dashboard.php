<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'guest') {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Guest Dashboard</h2>
        <p>Welcome, Guest <?php echo $_SESSION['username']; ?>!</p>
        
        <div class="guest-info">
            <h3>General Information:</h3>
            <ul>
                <li><a href="announcements.php">View Announcements</a></li>
                <li><a href="programs.php">Available Programs</a></li>
                <li><a href="contact.php">Contact Information</a></li>
            </ul>
        </div>

        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
