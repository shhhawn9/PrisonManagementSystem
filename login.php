<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intelligence Prison Management System</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
</head>
<body>
<h2 class="welcome">Intelligence Prison Management System</h2>
<div id="page-container">
<!--    <p id="image_logo"><img src="images/prison.png"></p>-->

    <form method="post" action="login.php">
        <p><label class="label_input">Employee：</label><input type="text" name="employee" class="text_field"/></p>
        <p><label class="label_input">Password：</label><input type="text" name="password" class="text_field"/></p>
        <div id="login_control">
            <input class="loginButton" type="submit" value="Login">
            <input type="reset" value="&nbsp;Reset&nbsp;" class="loginButton">
        </div>
    </form>
</div>
<div class='footer'>
    Copyright &copy; 2021 - 2021 Sharon Liu & Shawn Gu & Kaining Zheng
</div>
                <?php
                include 'connect.php';
                session_start();
                $user = $_POST['employee'];
                $password = $_POST['password'];
                $conn = OpenCon();
                $sql = "SELECT Employee_ID,password FROM Administration WHERE Employee_ID = $user AND password ='$password'";
                $result = mysqli_query($conn, $sql) or die("Failed to query database ".mysqli_error());
                $row = mysqli_fetch_array($result);
                echo $row;
                if ($row['Employee_ID'] === $user && $row['password'] === $password) {
                $_SESSION['username'] = $user;
                $_SESSION['password'] = $password;
                CloseCon($conn);
                header('location:mainPage.php'. "?username=$user");
                } else {
                    echo "Failed to login!";
                    }
                ?>
</body>
</html>

