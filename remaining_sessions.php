<?php
session_start();

include 'db_config.php';

if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedInUsername = $_SESSION['username'];

$sql = "SELECT student_id, full_name, remaining_slot FROM users WHERE username = '$loggedInUsername'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="main--content">';
    while ($row = $result->fetch_assoc()) {
        echo '<br><br><br><br><br><br><br><div class="card--container">';
        echo '<div class="card--wrapper">';
        echo '<div class="header--title">';
        echo '<span>Student Information</span>';
        echo '</div>';
        echo '<div class="user--info">';
        echo '<p><strong>Student ID:</strong> ' . $row["student_id"] . '</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<p><strong>Name:</strong> ' . $row["full_name"] . '</p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<p><strong>Remaining Sessions:</strong> ' . $row["remaining_slot"] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "No data found for this user.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Remaining Sessions</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");
*{
    margin: 0;
    padding: 0;
    border: none;
    outline: none;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    background-color: white;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.sidebar {
    background-color: black;
    color: white;
    width: 250px;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    z-index: 999;
}


.sidebar .logo {
    padding: 20px;
    text-align: center;
}

.sidebar .logo span {
    display: block;
    margin-top: 10px;
    font-size: 18px;
}

.sidebar .menu {
    padding: 0;
    margin: 0;
    list-style: none;
}

.sidebar .menu li {
    padding: 15px 20px;
    border-bottom: 1px solid #333;
}

.sidebar .menu li.active {
    background-color: #333;
}

.sidebar .menu li a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.sidebar .menu li a i {
    margin-right: 10px;
}
</style>
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <span>CCS SIT-IN <br> MONITORING SYSTEM</span>
    </div>
    <br>
    <ul class="menu">
                <li ><a href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></li>
                <li><a href="edit_profile.php"><i class="fas fa-user"></i><span>Profile</span></li>
                <li class="active"><a href="remaining_sessions.php"><i class="fas fa-calendar-check"></i><span>View Remaining Session</span></li>
                <li><a href="sitin_history.php"><i class="fas fa-history"></i><span>Sitin Logs</span></li>
                <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></li>
            </ul>
        </div>
</div>
</body>
</html>