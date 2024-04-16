<?php

include 'db_config.php';



$query = "SELECT DISTINCT purpose FROM reservations";
$result = mysqli_query($conn, $query);
$purposes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $purposes[] = $row['purpose'];
}


$query = "SELECT DISTINCT lab_room FROM reservations";
$result = mysqli_query($conn, $query);
$labs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $labs[] = $row['lab_room'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_reports'])) {
    $selected_purpose = $_POST['purpose'] ?? '';
    $selected_lab = $_POST['lab_room'] ?? '';
    $selected_date = $_POST['selected_date'] ?? '';
    $student_id = $_POST['student_id'] ?? '';

    $query_string = "SELECT * FROM reservations WHERE 1";

    
    if (!empty($selected_purpose)) {
        $query_string .= " AND purpose = '$selected_purpose'";
    }
    if (!empty($selected_lab)) {
        $query_string .= " AND lab_room = '$selected_lab'";
    }
    if (!empty($selected_date)) {
        $query_string .= " AND DATE(time_in) = '$selected_date'";
    }
    if (!empty($student_id)) {
        $query_string .= " AND student_id = '$student_id'";
    }

    $result = mysqli_query($conn, $query_string);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Reports</title>
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

body {
    background-color: white;
    margin: 0;
    padding: 0;
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

.calendar-form {
    margin-bottom: 20px;
}
        
table {
    border-collapse: collapse;
    width: 100%;
}   

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
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

button {
  border: none;
  outline: none;
  background-color: black;
  padding: 10px 20px;
  font-size: 12px;
  font-weight: 700;
  color: #fff;
  border-radius: 5px;
  transition: all ease 0.1s;
  box-shadow: 0px 5px 0px 0px gray;
}

button:active {
  transform: translateY(5px);
  box-shadow: 0px 0px 0px 0px white;
}

#export {
            border: none;
            outline: none;
            background-color: black;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            border-radius: 5px;
            transition: all ease 0.1s;
            box-shadow: 0px 5px 0px 0px gray;
            cursor: pointer; /* Add cursor pointer to indicate it's clickable */
        }

        /* Add hover effect */
        #export:hover {
            background-color: #333;
        }

        /* Add active effect */
        #export:active {
            transform: translateY(5px);
            box-shadow: 0px 0px 0px 0px white;
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
        <li><a href="delete.php"><i class="fas fa-trash"></i><span>Delete</span></a></li>
        <li><a href="sit_in_records.php"><i class="fas fa-file"></i><span>View Sitin Records</span></a></li>
        <li class="active"><a href="reports.php"><i class="fas fa-book"></i><span>Generate Reports</span></a></li>
        <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
    </ul>
</div>
<div class="content">
        <h2>Generate Reports</h2>
        <form method="POST" action="">
            <label for="selected_date" class="text-green-400">Select Date:</label>
            <input type="date" id="selected_date" name="selected_date" class="rounded-lg bg-gray-600 text-white px-2 py-1 h-10">

            <label for="student_id" class="text-green-400">Student ID:</label>
            <input type="text" id="student_id" name="student_id" class="rounded-lg bg-gray-600 text-white px-2 py-1 h-10" placeholder="Enter Student ID">

            <label for="lab_room" class="text-green-400">Lab Room:</label>
            <select id="lab_room" name="lab_room" class="rounded-lg bg-gray-600 text-white px-2 py-1 h-10">
                <option value="">All</option>
                <?php foreach ($labs as $lab): ?>
                    <option value="<?php echo $lab; ?>"><?php echo $lab; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="purpose" class="text-green-400">Purpose:</label>
            <select id="purpose" name="purpose" class="rounded-lg bg-gray-600 text-white px-2 py-1 h-10">
                <option value="">All</option>
                <?php foreach ($purposes as $purpose): ?>
                    <option value="<?php echo $purpose; ?>"><?php echo $purpose; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="generate_reports" >Generate Reports</button>
        </form>

<br>
        <div style="overflow-x: auto; margin: 0 auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Purpose</th>
                    <th>Lab Room</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['student_id'] . "</td>";
                    echo "<td>" . $row['purpose'] . "</td>";
                    echo "<td>" . $row['lab_room'] . "</td>";
                    echo "<td>" . $row['time_in'] . "</td>";
                    echo "<td>" . $row['time_out'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
                ?>
            </tbody>
        </table><br>
        <button onclick="exportToExcel()" id="export">Export to Excel</button>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script>
    
    function exportToExcel() {
        
        var table = document.querySelector('table');
      
        var ws = XLSX.utils.table_to_sheet(table);
       
        var wb = XLSX.utils.book_new();
        
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
        
        XLSX.writeFile(wb, "reports.xlsx");
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dateInput = document.getElementById('selected_date');

        dateInput.addEventListener('change', function () {
            this.form.submit();
        });
    });
</script>

</body>
</html>

<?php
     
    
     $conn->close();
?>
