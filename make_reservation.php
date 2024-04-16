<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $student_id = $_SESSION['username'];
    $purpose = $_POST['purpose'];
    $lab_room = $_POST['lab_room'];
    $time_in = $_POST['time_in'];

    $sql = "INSERT INTO reservations (student_id, purpose, lab_room, time_in)
     VALUES ('$student_id', '$purpose', '$lab_room', '$time_in')";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='background-color: #00ffa7; color: black; padding: 10px;'>Reservation made successfully!</div>";
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
    <title>Make Reservation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: white;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
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
    </style>
</head>
<body>
<a href="student_dashboard.php" class="back-btn"><i class="far fa-hand-point-left"></i><span>Back</span></a>

<div class="container">
    <h2>Make Reservation</h2>
<br>
    <form action="make_reservations.php" method="post">
        <div class="input-group">
            <label class="label" for="purpose">Purpose:</label>
            <select id="purpose" name="purpose" class="input" required>
                <option value="Java">Java</option>
                <option value="C++">C++</option>
                <option value="HTML">HTML</option>
                <option value="Python">Python</option>
                <option value="PHP">PHP</option>
                <option value="C">C</option>
            </select>
        </div>
        <div class="input-group">
            <label class="label" for="lab_room">Laboratory Room:</label>
            <select id="lab_room" name="lab_room" class="input" required>
                <option value="524">524</option>
                <option value="526">526</option>
                <option value="528">528</option>
                <option value="542">542</option>
            </select>
        </div>
        <div class="input-group">
            <label class="label" for="time_in">Time-In:</label>
            <input type="datetime-local" id="time_in" name="time_in" class="input" required>
        </div>
        <button class="submit" type="submit" name="make_reservation">Submit Reservation</button>
    </form>
    
</div>

</body>
</html>