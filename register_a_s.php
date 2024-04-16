<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO staffs (username, password, email) 
            VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login_a_s.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body style="background-color: white; color: white; font-family: 'Roboto', sans-serif;">
<style>
.container {
    position: relative;
    background-color: black;
    padding: 20px;
    border-radius: 20px;
    max-width: 300px;
    margin: 0 auto;
}

.input-group {
    margin-bottom: 20px;
}

.input {
    max-width: 800px;
    height: 30px;
    background-color: gray;
    border-radius: .5rem;
    padding: 0 1rem;
    border: 2px solid transparent;
    font-size: 1rem;
    color: white;
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

.input:hover, .input:focus, .input-group:hover .input {
    outline: none;
    border-color: #05060f;
}

.input-group:hover .label, .input:focus {
    color: #05060fc2;
}

.submit {
    display: inline-block;
    transition: all 0.2s ease-in;
    position: relative;
    overflow: hidden;
    z-index: 1;
    color: #090909;
    padding: 0.7em 1.7em;
    cursor: pointer;
    font-size: 14px;
    border-radius: 0.5em;
    background: #e8e8e8;
    border: 1px solid #e8e8e8;
}

.submit:active {
    color: #666;
    box-shadow: inset 4px 4px 12px #c5c5c5, inset -4px -4px 12px #ffffff;
}

.submit:before {
    content: "";
    position: absolute;
    left: 50%;
    transform: translateX(-50%) scaleY(1) scaleX(1.25);
    top: 100%;
    width: 140%;
    height: 180%;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.submit:after {
    content: "";
    position: absolute;
    left: 55%;
    transform: translateX(-50%) scaleY(1) scaleX(1.45);
    top: 180%;
    width: 160%;
    height: 190%;
    background-color: #009087;
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.submit:hover {
    color: #ffffff;
    border: 1px solid #009087;
}

.submit:hover:before {
    top: -35%;
    background-color: #009087;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

.submit:hover:after {
    top: -45%;
    background-color: #009087;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}


.cancel {
    display: right corner;
    transition: all 0.2s ease-in;
    position: absolute;
    right: 10px;
    overflow: hidden;
    z-index: 1;
    color: #090909;
    padding: 0.7em 1.7em;
    cursor: pointer;
    font-size: 14px;
    border-radius: 0.5em;
    background: #e8e8e8;
    border: 1px solid #e8e8e8;
}

.cancel:active {
    color: #666;
    box-shadow: inset 4px 4px 12px #c5c5c5, inset -4px -4px 12px #ffffff;
}

.cancel:before {
    content: "";
    position: absolute;
    left: 50%;
    transform: translateX(-50%) scaleY(1) scaleX(1.25);
    top: 100%;
    width: 140%;
    height: 180%;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.cancel:after {
    content: "";
    position: absolute;
    left: 55%;
    transform: translateX(-50%) scaleY(1) scaleX(1.45);
    top: 180%;
    width: 160%;
    height: 190%;
    background-color: #FF204E;
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.cancel:hover {
    color: #ffffff;
    border: 1px solid #FF204E;
}

.cancel:hover:before {
    top: -35%;
    background-color: #FF204E;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

.cancel:hover:after {
    top: -45%;
    background-color: #FF204E;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}
</style>
<br>
<br>
<br>
<br>
<br>
<div class="container">
<br>
    <center>
    <h2>Registration Form</h2>
    <h4 style="color: gray;">(ADMIN / STAFF)</h4>
    
    <br>
    <form action="register_a_s.php" method="post">
        <div class="input-group">
            <label class="label">Username</label>
            <input required="" type="text" id="username" name="username" class="input">
        </div>
        <br>
        <div class="input-group">
            <label class="label">Password</label>
            <input required="" type="password" id="password" name="password" class="input">
        </div>
        <br>
        <div class="input-group">
            <label class="label">Confirm Password</label>
            <input required="" type="password" id="confirm_password" name="confirm_password" class="input">
            <span id="password_error" style="color: red;"></span>
        </div>
        <br>
        <div class="input-group">
            <label class="label">Email</label>
            <input required="" type="email" id="email" name="email" class="input">
        </div>
</center>
        <br>
        <br>
        <button class="submit" type="submit" name="register">Submit</button>
        <button class="cancel" type="reset" onclick="cancelRegistration()">Cancel</button>
    </form>
</div>

<script>
    function cancelRegistration() {
        window.location.href = 'login_a_s.php';
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");
        var password_error = document.getElementById("password_error");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords don't match");
                password_error.innerHTML = "Passwords don't match";
            } else {
                confirm_password.setCustomValidity("");
                password_error.innerHTML = "";
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    });
</script>
</body>
</html>
