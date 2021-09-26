<?php
session_start();
$user = $_SESSION['username'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intelligence Prison Management System</title>
    <style>
    /*This table template is reference to*/
    /*https://blog.csdn.net/qq_36407310/article/details/104334915*/
            table {
                border-collapse: collapse;
                font-family: Futura, Arial, sans-serif;
            }
            caption {
                font-size: larger;
                margin: 1em auto;
            }
            th, td {
                font-size: 13px;
                padding: .85em;
            }
            th {
                background: #fff nonerepeat scroll 0 0;
                border: 1px solid #777;
                color: #fff;
            }
            td {
                border: 1px solid#777;
            }
            th {
                background: #696969;
                color:#FFFFFF;
            }
            tbody tr:nth-child(odd) {
                background: #ccc;
            }
            tbody tr:nth-child(even) {
                background: #fffdfd;
            }
        </style>
    <link rel="stylesheet" href="css/rpSystem.css">
    <link rel="stylesheet" href="css/normal-menu.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">

</head>
<body>
<div class="top-container">
    <h1>Other Useful Statistics</h1>
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
<h3>1. Display all the prisoners who were rewarded or punished by all employees:</h3>
        <?php
        include 'connect.php';
        $conn = OpenCon();
        $sqlavg = "SELECT avg(pjc.performance_credit) as averagePC
                           FROM (Prisoner p inner join Prisoner_job_credit pjc on p.P_ID = pjc.P_ID)
                           inner join Prisoner_credit_status pcs on pjc.performance_credit = pcs.performance_credit";
        $resultavg = mysqli_query($conn, $sqlavg) or die("Failed to query database ".mysqli_error());
        $rowavg = mysqli_fetch_array($resultavg);
        $avg = $rowavg['averagePC'];

        $sqlmin = "SELECT min(pjc.performance_credit) as minPC
                           FROM (Prisoner p inner join Prisoner_job_credit pjc on p.P_ID = pjc.P_ID)
                           inner join Prisoner_credit_status pcs on pjc.performance_credit = pcs.performance_credit";
        $resultmin = mysqli_query($conn, $sqlmin) or die("Failed to query database ".mysqli_error());
        $rowmin = mysqli_fetch_array($resultmin);

        $min = $rowmin['minPC'];
        $sqlmax = "SELECT max(pjc.performance_credit) as maxPC
                           FROM (Prisoner p inner join Prisoner_job_credit pjc on p.P_ID = pjc.P_ID)
                           inner join Prisoner_credit_status pcs on pjc.performance_credit = pcs.performance_credit";
        $resultmax = mysqli_query($conn, $sqlmax) or die("Failed to query database ".mysqli_error());
        $rowmax = mysqli_fetch_array($resultmax);
        $max = $rowmax['maxPC'];

        $sql = "SELECT p.P_ID,P_Name,pjc.performance_credit,status
                FROM (Prisoner p inner join Prisoner_job_credit pjc on p.P_ID = pjc.P_ID)
                inner join Prisoner_credit_status pcs on pjc.performance_credit = pcs.performance_credit
                WHERE NOT EXISTS (
                    SELECT * FROM Administration a
                    WHERE NOT EXISTS (
                        SELECT b.P_ID FROM (select arp.Employee_ID, pgrp.P_ID from Assign_RP arp inner join Prisoner_gets_RP pgrp on arp.RP_ID = pgrp.RP_ID) b
                        WHERE a.Employee_ID = b.Employee_ID and p.P_ID = b.P_ID
                    )
                )";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        echo "<table border='0'>
        <tr>
        <th>Prisoner ID</th>
        <th>Prisoner Name</th>
        <th>Performance Credit</th>
        <th>Status</th>
        </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['P_ID'] . "</td>";
        echo "<td>" . $row['P_Name'] . "</td>";
        echo "<td>" . $row['performance_credit'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "0 results";
        }
        CloseCon($conn);
        ?>
</div>
</div>
<div class="top-container">
<h3>2. The prisoners' average performance credit is <?php echo $avg;?>;</h3>
<h3>The prisoners' minimum performance credit is <?php echo $min;?>;</h3>
<h3>The prisoners' maximum performance credit is <?php echo $max;?>.</h3>
</div>
<div class='footer'>
    Copyright &copy; 2021 - 2021 Sharon Liu & Shawn Gu & Kaining Zheng
    <a href="login.php">Log Out</a>
</div>
</body>
</html>
