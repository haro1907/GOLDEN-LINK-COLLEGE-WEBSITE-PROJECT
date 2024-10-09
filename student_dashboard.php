<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Student Dashboard</h2>
        <p>Welcome, Student <?php echo $_SESSION['username']; ?>!</p>
        
        <div class="student-actions">
            <h3>Your Courses:</h3>
            <ul>
                <li><a href="view_courses.php">View All Courses</a></li>
                <li><a href="view_assignments.php">View Assignments</a></li>
                <li><a href="view_grades.php">View Grades</a></li>
            </ul>
        </div>

        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
