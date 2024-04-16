<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
</style>

<div class="sidebar">
    <div class="logo">
        <span>CCS SIT-IN <br> MONITORING SYSTEM</span>
    </div>
    <br>
    <ul class="menu">
        <li><a href="a_s_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="active"><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i></i><span>Search</span></a></li>
        <li><a href="delete.php"><i class="fas fa-trash"></i><span>Delete</span></a></li>
        <li><a href="sit_in_records.php"><i class="fas fa-file"></i><span>View Sitin Records</span></a></li>
        <li><a href="reports.php"><i class="fas fa-book"></i><span>Generate Reports</span></a></li>
        <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
    </ul>
</div>
<br>
<br>

<center>
<form method="post" action="">
<div class="group">
  <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
    <g>
      <path
        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
      ></path>
    </g>
  </svg>

  <input
    id="query"
    class="input"
    type="search"
    placeholder="Search..."
    name="searchbar"
  />
</div>
</form>

<?php
session_start();

include 'db_config.php';

if(isset($_POST['searchbar'])) {
    $search_value = $_POST['searchbar'];
    
    $sql_users = "SELECT full_name, student_id FROM users WHERE student_id = ?";
    $stmt_users = $conn->prepare($sql_users);
    $stmt_users->bind_param("i", $search_value);
    $stmt_users->execute();
    $result_users = $stmt_users->get_result();

    if ($result_users->num_rows > 0) {
        while($row_users = $result_users->fetch_assoc()) {

            $_SESSION['student_id'] = $row_users['student_id'];

            echo '<center><div class="container">';
            echo "<p>Student ID: " . $row_users["student_id"] . "</p>";
            echo "<p>Student Name: " . $row_users["full_name"] . "</p>";
            
            echo '<div class="reservation-container">';
            echo '<br><h2>Make Reservation</h2>';
            echo '<form action="" method="POST">';
            echo '<div class="input-group">';
            echo '<label class="label" for="purpose">Purpose:</label>';
            echo '<select id="purpose" name="purpose" class="input" required>';
            echo '<option value="Java">Java</option>';
            echo '<option value="C++">C++</option>';
            echo '<option value="HTML">HTML</option>';
            echo '<option value="Python">Python</option>';
            echo '<option value="PHP">PHP</option>';
            echo '<option value="C">C</option>';
            echo '</select>';
            echo '</div>';
            echo '<div class="input-group">';
            echo '<label class="label" for="lab_room">Laboratory Room:</label>';
            echo '<select id="lab_room" name="lab_room" class="input" required>';
            echo '<option value="524">524</option>';
            echo '<option value="526">526</option>';
            echo '<option value="528">528</option>';
            echo '<option value="542">542</option>';
            echo '<option value="544">544</option>';
            echo '<option value="517">517</option>';
            echo '</select>';
            echo '</div>';
            echo '<br>';
            echo '<button class="submit" type="submit" name="make_reservation">SIT-IN</button>';
            echo '</form>';
            echo '</div>';
            echo '</div></center>';
        }
    } else {
        echo "<center><p>No student found with ID: " . $search_value . "</p></center>";
    }

    $stmt_users->close();
}

if(isset($_POST['make_reservation'])) {
    // Retrieve form data
    $purpose = $_POST['purpose'];
    $lab_room = $_POST['lab_room'];
    
    // Assuming student_id is stored in session
    if(isset($_SESSION['student_id'])) {
        $student_id = $_SESSION['student_id'];

        // Insert reservation into the reservations table
        $sql_insert_reservation = "INSERT INTO reservations (student_id, purpose, lab_room) VALUES (?, ?, ?)";
        $stmt_insert_reservation = $conn->prepare($sql_insert_reservation);
        $stmt_insert_reservation->bind_param("iss", $student_id, $purpose, $lab_room);
        
        if($stmt_insert_reservation->execute()) {
            echo "<script>alert('Reservation successfully made.');</script>";
        } else {
            echo "<script>alert('Failed to make reservation. Please try again.');</script>";
        }

        $stmt_insert_reservation->close();
    } else {
        echo "<script>alert('Error: Student ID not found.');</script>";
    }
}

$conn->close();
?>


</center>

<style>
body {
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 250px;
    padding: 10px;
    font-family: "Poppins", sans-serif;
}

.group {
    display: flex;
    align-items: center;
    position: relative;
    max-width: 400px;
}

.input {
    width: 100%;
    height: 60px;
    padding-left: 3rem;
    font-size: 20px;
    background-color: black;
    color: white;
    border-radius: 30px;
}

.search-icon {
    position: absolute;
    left: 1rem;
    fill: #bdbecb;
    width: 1.5rem;
    height: 1.5rem;
    pointer-events: none;
    z-index: 1;
}
</style>
</body>
</html>