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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intelligence Prison Management System</title>
     <link rel="stylesheet" href="css/rpSystem.css">
     <link rel="stylesheet" href="css/normal-menu.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
</head>
<body>
  <div class="top-container">
    <h1>Reward and Punishment System</h1>
    <h3>Intelligence Prison Management System</h3>
  </div>
    <div class="ulnavi">
      <ul>
        <li>
          <a href="mainPage.php">Main Page</a>
        </li>
      </ul>
    </div>
    <div class="flexbox-container">
        <div class="flex-item">
            <!--    <p id="image_logo"><img src="images/prison.png"></p>-->
            <div class="sep" name="login_control">
                <input class="loginButton" type="button" value="Reward" onclick="location.href='rpSystem_reward.php'"/>
                <input class="loginButton" type="button" value="Punishment" onclick="location.href='rpSystem_punish.php'"/>
            </div>
            <div class="sep" name="login_control">
                <input class="loginButton" type="button" value="Prisoner Status Visualization" onclick="location.href='rpSystem_status.php'"/>
                <input class="loginButton" type="button" value="Prisoner Performance Summary" onclick="location.href='rpSystem_summary.php'"/>
            </div>
            <div class="sep" name="login_control">
                <input class="loginButton" type="button" value="Other Useful Statistics" onclick="location.href='rpSystem_division.php'"/>
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