<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Staff Dashboard</title>
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

.container {
  width: 100%;
  height: 100%;
  --s: 100px;
  --c1: #f8b195;
  --c2: #355c7d;

  --_g: var(--c2) 6% 14%, var(--c1) 16% 24%, var(--c2) 26% 34%,
    var(--c1) 36% 44%, var(--c2) 46% 54%, var(--c1) 56% 64%, var(--c2) 66% 74%,
    var(--c1) 76% 84%, var(--c2) 86% 94%;
  background: radial-gradient(
      100% 100% at 100% 0,
      var(--c1) 4%,
      var(--_g),
      #0008 96%,
      #0000
    ),
    radial-gradient(
        100% 100% at 0 100%,
        #0000,
        #0008 4%,
        var(--_g),
        var(--c1) 96%
      )
      var(--c1);
  background-size: var(--s) var(--s);
}

</style>
<br>
<center>
    <h1> WELCOME CCS STUDENT! </h1>
</center>

<div class="sidebar">
    <div class="logo">
        <span>CCS SIT-IN <br> MONITORING SYSTEM</span>
    </div>
    <br>
    <ul class="menu">
        <li class="active"><a href="#"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li><a href="search.php"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
        <li><a href="delete.php"><i class="fas fa-trash"></i><span>Delete</span></a></li>
        <li><a href="sit_in_records.php"><i class="fas fa-file"></i><span>View Sitin Records</span></a></li>
        <li><a href="reports.php"><i class="fas fa-book"></i><span>Generate Reports</span></a></li>
        <li class="logout"><a href="a_s_logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
    </ul>
</div>
</body>
</html>
