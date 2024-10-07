<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Calculate user's age from date of birth
$dob = new DateTime($_SESSION['dob']);
$today = new DateTime();
$age = $today->diff($dob)->y;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>User Profile</title>
</head>
<body>
    <div class="profile-container">
        <h2>Welcome, <?php echo $_SESSION['firstname']; ?>!</h2>
        <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $_SESSION['lastname'] . " " . $_SESSION['firstname'] . " " . $_SESSION['middlename']; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $_SESSION['dob']; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $_SESSION['contact']; ?></p>

        <!-- Add a delete account form -->
        <form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <input type="submit" value="Delete Account" class="delete-button">
        </form>

        <!-- Add a logout button -->
        <form action="logout.php" method="post">
            <input type="submit" value="Logout" class="logout-button">
        </form>
    </div>
</body>
</html>
