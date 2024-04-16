<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<style>
.card {
    max-width: 750px;
    min-height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 35px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    background-color: #000;
    color: #fff;
    box-shadow: 0 0 10px 1px rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(100px);
    position: relative;
}

.card p {
    color: #fff;
}

.card-footer {
    font-size: .8em;
    color: #fff;
}

.button {
    box-sizing: border-box;
    max-width: 200px;
    padding: 10px 20px;
    margin-top: auto;
    background-color: black;
    color: #fff;
    border: 2px solid white;
    border-radius: 20px;
    cursor: pointer;
    position: absolute;
    bottom: 20px;
    right: 20px;
    transition: all 0.5s;
}

.button:hover {
    background-color: red;
}

.button:active {
    transform: scale(0.95);
}

body {
    background-color: #fff;
    color: #fff;
}
</style>
<center>
    <div class="logo">
        <a href="index.php">
            <img src="logo.png" alt="Logo" class="logo">
        </a>
    </div>
    <br>
    <div class="card">
  <p>Introducing the CCS Sit-In Monitoring System app, designed exclusively for students at the College of Computer Science. This innovative application streamlines the process of reserving computer laboratory sessions with ease. Students can now effortlessly book specific time slots in advance, ensuring a seamless experience for accessing the resources they need. With real-time updates on remaining session availability, students can plan their study sessions effectively. Say goodbye to waiting in queues or uncertainty about lab availability the CCS Sit-In Monitoring System app puts control in the palm of your hand.</p>
  <p class="card-footer">Created by ( JHENY LAUSA )</p>
    </div>
            <button class="button" onclick="window.location.href='login1.php'">Get Started</button>   
    </div>
</center>
<script>
function applyTypingEffect(element, text, delay) {
    let i = 0;
    const type = () => {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, delay);
        }
    };
    type();
}

const cardParagraph = document.querySelector('.card p');
const originalText = cardParagraph.textContent;
cardParagraph.textContent = '';
applyTypingEffect(cardParagraph, originalText, 20);
</script>
</body>
</html>
