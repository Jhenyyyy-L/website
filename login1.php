<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    switch ($role) {
        case 'admin':
            header('Location: login_a_s.php');
            break;
        case 'student':
            header('Location: login.php');
            break;
        default:
            echo "Invalid role selected.";
            break;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style10.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
.card-container {
    display: flex;
    justify-content: space-around;
}

.card {
  box-sizing: border-box;
  width: 300px;
  height: 300px;
  background: black;
  border: 1px solid white;
  box-shadow: 12px 17px 51px rgba(0, 0, 0, 0.22);
  backdrop-filter: blur(6px);
  border-radius: 17px;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s;
  display: flex;
  align-items: center;
  justify-content: center;
  user-select: none;
  font-weight: bolder;
  color: white;
  margin: 20px;
}

.card:hover {
  border: 5px solid red;
  transform: scale(1.05);
}

.card:active {
  transform: scale(0.95) rotateZ(1.7deg);
}

.card p {
    margin: 0;
    font-size: 20px;
}

.card a {
    color: inherit;
    text-decoration: none;
    width: 100%;
    height: 20%;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
</head>
<body>
<div class="card-container">
    <div class="card">
        <a href="login_a_s.php">
            <p>ADMIN / STAFF</p>
        </a>
    </div>
    
    <div class="card">
        <a href="login.php">
            <p>USER</p>
        </a>
    </div>
</div>
</body>
</html>
