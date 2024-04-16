<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM staffs WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($password == $row['password']) {
            session_start();
            $_SESSION['username'] = $username; 
            header("Location: a_s_dashboard.php");
            exit();
        } else {
            echo "<div style='background-color: #00ffa7; color: red; padding: 5px;'>Invalid Password</div>";
        }
    } else {
        echo "<div style='background-color: #00ffa7; color: red; padding: 10px;'>User Not Found</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin and Staff Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<a href="login1.php" class="back-btn"><i class="far fa-hand-point-left"></i><span>Back</span></a>
<style>
body {
    background-color: white;
    color: white;
}

.logo {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 0;
}

.logo img {
    width: 100%; /* Adjust as needed */
}

.container {
    background-color: black;
    padding: 30px;
    border-radius: 20px;
    max-width: 500px;
    margin: 0 auto;
}

h2 {
    text-align: center;
    color: white;
}

.input-group {
    margin-bottom: 20px;
}

.input {
    max-width: 300px;
    height: 44px;
    background-color: transparent;
    border-radius: .5rem;
    padding: 0 1rem;
    border: 2px solid transparent;
    font-size: 1rem;
    transition: border-color .3s cubic-bezier(.25,.01,.25,1) 0s, color .3s cubic-bezier(.25,.01,.25,1) 0s,background .2s cubic-bezier(.25,.01,.25,1) 0s;
}

.label {
    display: block;
    margin-bottom: .3rem;
    font-size: .9rem;
    font-weight: bold;
    color: white;
    transition: color .3s cubic-bezier(.25,.01,.25,1) 0s;
}

.input:focus {
    background-color: white;
    color: black;
}

.input:not(:focus):not(:placeholder-shown) {
    background-color: transparent;
    color: white;
}

button[type="submit"] {
    background-color: black;
    color: white;
    border: none;
    border-radius: .5rem;
    padding: 1px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #05060f;
    border: 1px solid red;
    transform: scale(1);
}

button[type="submit"]:active {
    transform: scale(1) rotateZ(2deg);
}

a {
    color: white;
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
</style>
<center>
    <div class="logo">
        <a href="index.php">
            <img src="logo.png" alt="Logo">
        </a>
    </div>
</center>
<br>
<div class="container">
    <center>
    <h2>LOGIN</h2>
    <h4 style="color: gray;">(ADMIN / STAFF)</h4>
    </center>
    <form action="login_a_s.php" method="post">
        <br>
        <div class="input-group">
            <label class="label" for="username">Username:</label>
            <input autocomplete="off" name="username" id="username" class="input" type="text" required>
            <div></div>
        </div>
        <div class="input-group">
            <label class="label" for="password">Password:</label>
            <input autocomplete="off" name="password" id="password" class="input" type="password" required>
            <div></div>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
