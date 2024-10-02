<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <form action="delete_account.php" method="POST">
            <input type="submit" value="Delete Account" name="delete_account">
        </form>
        <form action="logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
