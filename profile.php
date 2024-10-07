<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userData'])) {
    header("Location: index.html");
    exit();
}

// Function to calculate age
function calculateAge($dob) {
    $dob = new DateTime($dob);
    $today = new DateTime('today');
    return $today->diff($dob)->y;
}

// Retrieve user data from session
$userData = $_SESSION['userData'];
$lastname = $userData['lastname'];
$firstname = $userData['firstname'];
$middlename = $userData['middlename'];
$dob = $userData['dob'];
$contact = $userData['contact'];
$email = $userData['email'];
$username = $userData['username'];
$age = calculateAge($dob); // Calculate the age

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h2>Your Profile Information</h2>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Full Name:</strong> <?php echo $firstname . ' ' . $middlename . ' ' . $lastname; ?></p>
        <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
        <p><strong>Age:</strong> <?php echo $age; ?> years old</p>
        <p><strong>Contact Number:</strong> <?php echo $contact; ?></p>
        <p><strong>Email Address:</strong> <?php echo $email; ?></p>
        <br>
        <a href="logout.php">Logout</a>
        <br><br>
        <!-- Delete Account Button -->
        <form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <input type="submit" value="Delete Account" class="delete-button">
        </form>
    </div>
</body>
</html>
