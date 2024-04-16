<?php
include "db_config.php";


if(isset($_GET['id']) && !empty($_GET['id'])) {
    
    $delete_query = "DELETE FROM reservations WHERE id = ?";
    
    if($stmt = $conn->prepare($delete_query)) {
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = $_GET['id'];
        
        if($stmt->execute()) {

            $stmt->close();

            $timeout_query = "UPDATE reservations SET time_out = CURRENT_TIMESTAMP WHERE id = ?";
            if($timeout_stmt = $conn->prepare($timeout_query)) {
                
                $timeout_stmt->bind_param("i", $param_id);
                
                $param_id = $_GET['id'];
                
                if($timeout_stmt->execute()){
           
            header("location: delete.php");
            exit();
        } else {
            echo "Failed to update time_out column.";
        }


        $timeout_stmt->close();
    } else {
        echo "Failed to prepare timeout statement.";
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
    }
  }
}

$select = "SELECT r.id, r.student_id, u.full_name, u.email, r.purpose, r.lab_room FROM reservations r INNER JOIN users u ON r.student_id = u.student_id";
$query = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
    width: 100%;
    min-height: 100vh;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
}

table {
    border-collapse: collapse;
    width: 50%;
}

table th,
table td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
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

.delete-button {
    color: red; 
}
</style>
<div class="sidebar">
<div class="logo">
        <span>CCS SIT-IN <br> MONITORING SYSTEM</span>
    </div>
    <br>
    <ul class="menu">
        <li><a href="a_s_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
        <li class="active"><a href="delete.php"><i class="fas fa-trash"></i><span>Delete</span></a></li>
        <li><a href="sit_in_records.php"><i class="fas fa-file"></i><span>View Sitin Records</span></a></li>
        <li><a href="reports.php"><i class="fas fa-book"></i><span>Generate Reports</span></a></li>
        <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
    </ul>
</div>

<table>
    <tr>
        <th>Student ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Purpose</th>
        <th>Lab Room</th>
        <th>Action</th>
    </tr>

<?php
    if ($query && mysqli_num_rows($query) > 0) {
        while ($result = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $result['student_id'] . "</td>";
            echo "<td>" . $result['full_name'] . "</td>";
            echo "<td>" . $result['email'] . "</td>";
            echo "<td>" . $result['purpose'] . "</td>";
            echo "<td>" . $result['lab_room'] . "</td>";
            echo "<td><a href='delete.php?id=" . $result['id'] . "'><i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found</td></tr>";
    }
    ?>
</table>

</body>
</html>
