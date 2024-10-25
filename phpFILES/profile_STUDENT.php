<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: glc_login.html");
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
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="glc_login.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <h2>Student Dashboard</h2>
            <p><strong>Identification Number:</strong> <?php echo $_SESSION['id']; ?></p>
            <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
            <p><strong>First Name:</strong> <?php echo $_SESSION['firstname']; ?></p>
            <p><strong>Middle Name:</strong> <?php echo $_SESSION['middlename']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $_SESSION['lastname']; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $_SESSION['dob']; ?></p>
            <p><strong>Age:</strong> <?php echo $age; ?></p>
            <p><strong>Contact Number:</strong> <?php echo $_SESSION['contact']; ?></p>
            <a href="glc_dashSTUDENT.html" class="back-button">Back</a>

            <!-- Delete Account Option -->
            <form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
                <input type="submit" value="Delete Account" class="delete-button">
            </form>
        </div>
    </div>
</body>
</html>
