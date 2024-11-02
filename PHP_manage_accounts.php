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

    // Fetch all users from the database
    $stmt = $pdo->query("SELECT id, username, email, firstname, middlename, lastname, dob, contact FROM glc_users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="style_MANAGE_acc.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <a href="HTML_glc_dashADMIN.html" class="back-button">Back</a>

            <!-- Display users from MySQL database -->
            <h2>All Users</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Identification Number</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Age</th> <!-- Added Age column -->
                        <th>Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($user['middlename']); ?></td>
                            <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($user['dob']); ?></td>
                            <td>
                                <?php 
                                    // Calculate age from the date of birth
                                    $dob = new DateTime($user['dob']);
                                    $today = new DateTime();
                                    $age = $today->diff($dob)->y;
                                    echo $age; // Display age
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($user['contact']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
