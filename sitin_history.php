<?php
session_start();

include 'db_config.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];


$sql = "SELECT * FROM reservations WHERE student_id = (SELECT student_id FROM users WHERE username = '$username') ORDER BY time_in DESC";
$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
    exit(); }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitin History</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        * {
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

        .container {
            margin: 0 auto;
            max-width: 800px; /* Adjust as needed */
            padding: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
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
            <li><a href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="edit_profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <li><a href="remaining_sessions.php"><i class="fas fa-calendar-check"></i><span>View Remaining Session</span></a></li>
            <li class="active"><a href="sitin_history.php"><i class="fas fa-history"></i><span>Sitin Logs</span></a></li>
            <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
        </ul>
    </div>

    <div class="container">
        <h1>Sitin History</h1>
        <table>
            <tr>
                <th>Purpose</th>
                <th>Lab Room</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["purpose"]. "</td><td>" . $row["lab_room"]. "</td><td>" . $row["time_in"]. "</td><td>" . $row["time_out"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No sitin history found.</td></tr>";
            }
            ?>
        </table>
        <a href="student_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
