<?php
session_start();

include 'db_config.php';

if(isset($_POST['logout'])) {
    $reservationId = $_POST['reservationId'];
    $time_out = date('Y-m-d H:i:s');

    $sql_update_reservation = "UPDATE reservations SET time_out = ? WHERE id = ?";
    $stmt_update_reservation = $conn->prepare($sql_update_reservation);
    $stmt_update_reservation->bind_param("si", $time_out, $reservationId);

    if ($stmt_update_reservation->execute()) {

        $sql_get_student_id = "SELECT student_id FROM reservations WHERE id = ?";
        $stmt_get_student_id = $conn->prepare($sql_get_student_id);
        $stmt_get_student_id->bind_param("i", $reservationId);
        $stmt_get_student_id->execute();
        $result_get_student_id = $stmt_get_student_id->get_result();

        if ($result_get_student_id->num_rows > 0) {
            $row_get_student_id = $result_get_student_id->fetch_assoc();
            $student_id = $row_get_student_id['student_id'];

            $sql_update_remaining_slot = "UPDATE users SET remaining_slot = remaining_slot - 1 WHERE student_id = ?";
            $stmt_update_remaining_slot = $conn->prepare($sql_update_remaining_slot);
            $stmt_update_remaining_slot->bind_param("i", $student_id);
            $stmt_update_remaining_slot->execute();
        }
        
        $stmt_get_student_id->close();
    } else {
    }

    $stmt_update_reservation->close();

    $_SESSION['logout_triggered'] = true;
}

if(isset($_SESSION['logout_triggered']) && $_SESSION['logout_triggered'] === true) {

    $sql_reservations = "SELECT * FROM reservations";
    $result_reservations = $conn->query($sql_reservations);

    $sql_remaining_slot = "SELECT student_id, remaining_slot FROM users";
    $result_remaining_slot = $conn->query($sql_remaining_slot);
    $remaining_slots = array();

    if ($result_remaining_slot->num_rows > 0) {
        while($row_remaining_slot = $result_remaining_slot->fetch_assoc()) {
            $remaining_slots[$row_remaining_slot['student_id']] = $row_remaining_slot['remaining_slot'];
        }
    }
    
    unset($_SESSION['logout_triggered']);
} else {

    $sql_reservations = "SELECT * FROM reservations";
    $result_reservations = $conn->query($sql_reservations);

    $sql_remaining_slot = "SELECT student_id, remaining_slot FROM users";
    $result_remaining_slot = $conn->query($sql_remaining_slot);
    $remaining_slots = array();

    if ($result_remaining_slot->num_rows > 0) {
        while($row_remaining_slot = $result_remaining_slot->fetch_assoc()) {
            $remaining_slots[$row_remaining_slot['student_id']] = $row_remaining_slot['remaining_slot'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sitin Records</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
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

.content {
    margin: auto; 
    width: 80%;
    padding: 290px;
}
.submit {
    background-color: black;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
}

.submit:hover {
    background-color: #333;
}

body {
    font-family: Arial, sans-serif;
}

table {
    width: 70%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    color: #333;
}

tr:hover {
    background-color: #f5f5f5;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

.center {
    text-align: center;
}



</style>

<div class="sidebar">
    <div class="logo">
        <span>CCS SIT-IN <br> MONITORING SYSTEM</span>
    </div>
    <br>
    <ul class="menu">
        <li><a href="a_s_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li ><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></i><span>Search</span></a></li>
        <li><a href="delete.php"><i class="fas fa-trash"></i><span>Delete</span></a></li>
        <li class="active"><a href="sit_in_records.php"><i class="fas fa-file"></i><span>View Sitin Records</span></a></li>
        <li><a href="reports.php"><i class="fas fa-book"></i><span>Generate Reports</span></a></li>
        <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>

    </ul>
</div>
<br>
<br>

<center>
        <div class="main-content">
            <h1>Sit In Records</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Purpose</th>
                        <th>Lab Room</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Slots Remaining</th>
                        <th>Log Out</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  if ($result_reservations->num_rows > 0) {
                      while($row = $result_reservations->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>".$row["id"]."</td>";
                          echo "<td>".$row["student_id"]."</td>";
                          echo "<td>".$row["purpose"]."</td>";
                          echo "<td>".$row["lab_room"]."</td>";
                          echo "<td>".$row["time_in"]."</td>";
                          
                          if ($row["time_out"] != null) {
                              echo "<td>".$row["time_out"]."</td>";
                          } else {
                              echo "<td>---</td>";
                          }
                          
                          $student_id = $row["student_id"];
                          $remaining_slot = isset($remaining_slots[$student_id]) ? $remaining_slots[$student_id] : "N/A";
                          echo "<td>".$remaining_slot."</td>";
                          
                          echo "<td>";
                          echo "<form action='' method='post'>";
                          echo "<input type='hidden' name='reservationId' value='".$row['id']."'>"; // Corrected variable name
                          echo "<button type='submit' name='logout' id='logoutButton_'><i class='fas fa-sign-out-alt'></i></button>";
                          echo "</form>";
                          echo "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='8'>No records found</td></tr>";
                  }
                  ?>

                </tbody>
            </table>

        </div>
    </center>
    
<script>
document.addEventListener("DOMContentLoaded", function() {
    var logoutButtons = document.querySelectorAll('.logout-button');
    logoutButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            toggleLogoutButton(this.id);
        });
    });
});
</script>


</body>
</html>