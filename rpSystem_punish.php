<?php
session_start();
$user = $_SESSION['username'];
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
    <h1>Punishment Management</h1>
    <h3>Intelligence Prison Management System</h3>
  </div>
    <div class="ulnavi">
      <ul>
        <li>
          <a href="rpSystem.php">Reward & Punishment Page </a>
        </li>
      </ul>
    </div>
<div class="flexbox-container">
    <div class="flex-item">
        <div id="page-container">

            <form method="post" action="rpSystem_punish.php">
                <p><div class="enterPrisoner">Please enter the prisoner id you want to punish:</div></p>
                <p><label class="label_input">Prisoner:</label><input type="text" name="prisonerid" class="text_field"/></p>
                <div id="login_control">
                    <input class="submitButton" type="submit" value="Punish">
                    <input type="reset" value="&nbsp;Reset&nbsp;" class="submitButton">
                </div>
            </form>

        </div>
    </div>
</div>
<div class='footer'>
    Copyright &copy; 2021 - 2021 Sharon Liu & Shawn Gu & Kaining Zheng
    <a href="login.php">Log Out</a>
</div>
<?php
include 'connect.php';
if (isset($_POST['prisonerid'])) {
    $conn = OpenCon();
    $prisoner = $_POST['prisonerid'];
    $sql1 = "INSERT INTO `Reward_and_punishment` (`RP_ID`, `Description`) VALUES (NULL, 'Punishment')";
    if ($conn->query($sql1) === TRUE) { echo "Record insert RP successfully";
    } else {
    echo "Error inserting RP record: " . $conn->error;
    }

    $sqlRPid = "SELECT MAX(RP_ID) as rpid from Reward_and_punishment";
    $resultRPid = mysqli_query($conn, $sqlRPid) or die("Failed to query database ".mysqli_error());
    $rowRPid = mysqli_fetch_array($resultRPid);
    $rpid = $rowRPid['rpid'];
    echo $rpid;

    $sql2 = "INSERT INTO `Prisoner_gets_RP` (`P_ID`, `RP_ID`) VALUES ($prisoner, $rpid)";
    if ($conn->query($sql2) === TRUE) { echo "Record insert RP_Prisoner successfully";
    } else {
    echo "Error inserting RP_Prisoner record: " . $conn->error;
    }

    $sql3 = "INSERT INTO `Assign_RP` (`Employee_ID`, `RP_ID`) VALUES ($user, $rpid)";
    if ($conn->query($sql3) === TRUE) { echo "Record insert RP_Employee successfully";
    } else {
    echo "Error inserting RP_Employee record: " . $conn->error;
    }

    $sqlCheckPC = "SELECT performance_credit FROM Prisoner_job_credit where P_ID = $prisoner";
    $resultPC = mysqli_query($conn, $sqlCheckPC) or die("Failed to query database ".mysqli_error());
    $rowPC = mysqli_fetch_array($resultPC);
    $pc = $rowPC['performance_credit'];

    if ($pc === -10) {
    echo "the performance_credit reached the limit!";
    } else {
    $sql4 = "update Prisoner_job_credit set performance_credit = performance_credit - 1 where P_ID = $prisoner";
    if ($conn->query($sql4) === TRUE) { echo "performance_credit updated successfully";
    } else {
    echo "Error updating performance_credit record: " . $conn->error;
    }
    }
    echo "successfully punish the prisoner";
    CloseCon($conn);

}
?>
</body>
</html>

