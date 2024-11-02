<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: HTML_glc_login.html");
    exit();
}

// Database connection details
$host = 'localhost';
$db = 'webglc_database';
$user = 'root'; // Default MySQL username in XAMPP
$pass = '';     // Default MySQL password (usually empty in XAMPP)

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch user data by ID
    $stmt = $pdo->prepare("SELECT * FROM glc_users WHERE id = ?");
    $stmt->execute([$_SESSION['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Calculate user's age from date of birth
    $dob = new DateTime($user['dob']);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
<!DOCTYPE html> 
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS_glc_login.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <h2>Admin Dashboard</h2>
            <p><strong>Identification Number:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
            <p><strong>Middle Name:</strong> <?php echo htmlspecialchars($user['middlename']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
            <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
            <a href="HTML_glc_dashADMIN.html" class="back-button">Back</a>

            <!-- Delete Account Option -->
            <form action="PHP_delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
                <input type="submit" value="Delete Account" class="delete-button">
            </form>
        </div>
    </div>
</body>
</html>
