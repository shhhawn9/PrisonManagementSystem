<?php
session_start();
$user = $_SESSION['username'];
include 'connect.php';
$conn = OpenCon();
$sql = "SELECT Employee_name FROM Administration where Employee_ID = $user";
$result = mysqli_query($conn, $sql) or die("Failed to query database ".mysqli_error());
$row = mysqli_fetch_array($result);
$name = $row['Employee_name'];
CloseCon($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intelligence Prison Management System</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
</head>
<body>
<h2 class="welcome">The Intelligence Prison Management System</h2>
<div class="flexbox-container">
    <div class="flex-item">
    <!--    <p id="image_logo"><img src="images/prison.png"></p>-->
        <div name="login_control">
            <input class="loginButton" type="button" value="Manage Prisoner" onclick="location.href='prisoner.php'"/>
            <input class="loginButton" type="button" value="Manage Correlation Officer" onclick="location.href='officer.php'"/>
        </div>
        <div name="login_control">
            <input class="loginButton" type="button" value="Manage Schedule" onclick="location.href='schedule.php'"/>
            <input class="loginButton" type="button" value="Reward and Punishment System" onclick="location.href='rpSystem.php'"/>
        </div>
    </div>
</div>
<div class='footer'>
    Copyright &copy; 2021 - 2021 Sharon Liu & Shawn Gu & Kaining Zheng
    <div>The employee now logged in successfully is: <?php echo $name;?></div>
    <a href="login.php">Log Out</a>
</div>
</body>
</html>
