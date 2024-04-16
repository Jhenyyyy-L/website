<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Editor</title>
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
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
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
    background-color: black;
    color: white;
    border-radius: 10px;
    padding: 20px;
    width: 400px;
    text-align: center;
}

.input-group {
    margin-bottom: 15px;
}

.label {
    display: block;
    margin-bottom: 5px;
}

.input {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    color: black; /* added to make the font color black */
}

.submit {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.submit:hover {
    background-color: #0056b3;
}
     
.back-btn {
    position: absolute;
    text-decoration: none;
    top: 20px;
    left: 20px;
    cursor: pointer;
    color: black;
    font-size: 20px;
    display: flex; 
    align-items: center;
}

.back-btn span {
    margin-left: 5px;
}

.input:focus {
    outline: none;
}
</style>
</head>
<body>
    <a href="student_dashboard.php" class="back-btn"><i class="far fa-hand-point-left"></i><span>Back</span></a>

<div class="container">
    <?php
    include 'db_config.php';

    $student_id = '';
    $full_name = '';
    $gender = '';
    $email = '';
    $username = '';
    $password = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $student_id = $_POST['student_id'];
        $full_name = $_POST['full_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "UPDATE users SET full_name='$full_name', gender='$gender', email='$email', username='$username', password='$password' WHERE student_id='$student_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<div style='background-color: #00ffa7; color: black; padding: 10px;'>Profile updated successfully!</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
        <center>
        <h2>( Profile )</h2>
        </center>
        <br>
        <form action="edit_profile.php" method="post">
            <div class="input-group">
                <label class="label" for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" class="input" value="<?php echo $student_id; ?>" required>
            </div>
            <div class="input-group">
                <label class="label" for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" class="input" value="<?php echo $full_name; ?>" required>
            </div>
            <div class="input-group">
                <label class="label" for="gender">Gender:</label>
                <input type="text" id="gender" name="gender" class="input" value="<?php echo $gender; ?>" required>
            </div>
            <div class="input-group">
                <label class="label" for="email">Email:</label>
                <input type="email" id="email" name="email" class="input" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <label class="label" for="username">Username:</label>
                <input type="text" id="username" name="username" class="input" value="<?php echo $username; ?>" required>
            </div>
            <div class="input-group">
                <label class="label" for="password">Password:</label>
                <input type="password" id="password" name="password" class="input" value="<?php echo $password; ?>" required>
            </div>
            <button class="submit" type="submit" name="edit_profile">Save Changes</button>
        </form>
    </div>
<div class="sidebar">
    <div class="logo">
        <span>CCS SIT-IN <br> MONITORING SYSTEM</span>
    </div>
    <br>
    <ul class="menu">
            <li><a href="student_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></li>
            <li class="active"><a href="edit_profile.php"><i class="fas fa-user"></i><span>Profile</span></li>
            <li><a href="remaining_sessions.php"><i class="fas fa-calendar-check"></i><span>View Remaining Session</span></li>
            <li><a href="sitin_history.php"><i class="fas fa-history"></i><span>Sitin Logs</span></li>
            <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></li>
        </ul>
    </div>
</div>
</body>
</html>