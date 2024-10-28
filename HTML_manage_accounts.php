<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: HTML_glc_login.html");
    exit();
}

// Read users from CSV file
$users = [];
if (($handle = fopen("ACC_glc_users.csv", "r")) !== FALSE) {
    // Get the header row
    $header = fgetcsv($handle);
    // Read each row and push to users array
    while (($data = fgetcsv($handle)) !== FALSE) {
        $users[] = array_combine($header, $data);
    }
    fclose($handle);
}
?>
<!DOCTYPE html> 
<html>
<head>
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="CSS_glc_login.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <a href="HTML_glc_dashADMIN.html" class="back-button">Back</a>

            <!-- Display users from CSV file -->
            <h2>All Users</h2>
                <table border ="1">
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
                                <td><?php echo htmlspecialchars($user['ID Number']); ?></td>
                                <td><?php echo htmlspecialchars($user['Username']); ?></td>
                                <td><?php echo htmlspecialchars($user['Email']); ?></td>
                                <td><?php echo htmlspecialchars($user['First Name']); ?></td>
                                <td><?php echo htmlspecialchars($user['Middle Name']); ?></td>
                                <td><?php echo htmlspecialchars($user['Last Name']); ?></td>
                                <td><?php echo htmlspecialchars($user['Date of Birth']); ?></td>
                                <td>
                                    <?php 
                                        // Calculate age from the date of birth
                                        $dob = new DateTime($user['Date of Birth']);
                                        $today = new DateTime();
                                        $age = $today->diff($dob)->y;
                                        echo $age; // Display age
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($user['Contact']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
</body>
</html>
