<?php
session_start();
$user = $_SESSION['username'];
?>
<?php
include 'connect.php';
$conn = OpenCon();
$sql = "select status,prisoners, concat(prisoners/t2.total) as percentage
               from
                (select status,count(P_ID) as prisoners
                from Prisoner_credit_status psc
                INNER JOIN Prisoner_job_credit pjc ON psc.performance_credit = pjc.performance_credit
                group by status) t1
                cross join
                (select  count(P_ID) as total
                from Prisoner_job_credit) t2";
$result = mysqli_query($conn, $sql) or die("Failed to query database ".mysqli_error());
$status=array();
$percentage=array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$status[] = $row['status'];
$percentage[] = $row['percentage'];
}
}
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

    <meta charset="UTF-8">
<!--ref to https://blog.csdn.net/zht666/article/details/8595558-->
            <script>
                function drawCircle(canvasId, data_arr, color_arr, text_arr)
                {
                    var c = document.getElementById(canvasId);
                    var ctx = c.getContext("2d");
                    var radius = c.height / 2 - 20;
                    var ox = radius + 20, oy = radius + 20;
                    var width = 30, height = 10;
                    var posX = ox * 2 + 20, posY = 30;
                    var textX = posX + width + 5, textY = posY + 10;
                    var startAngle = 0;
                    var endAngle = 0;
                    for (var i = 0; i < data_arr.length; i++)
                    {
                        endAngle = endAngle + data_arr[i] * Math.PI * 2;
                        ctx.fillStyle = color_arr[i];
                        ctx.beginPath();
                        ctx.moveTo(ox, oy);
                        ctx.arc(ox, oy, radius, startAngle, endAngle, false);
                        ctx.closePath();
                        ctx.fill();
                        startAngle = endAngle;
                        ctx.fillStyle = color_arr[i];
                        ctx.fillRect(posX, posY + 20 * i, width, height);
                        ctx.moveTo(posX, posY + 20 * i);
                        ctx.font = 'bold 17px 微软雅黑';
                        ctx.fillStyle = color_arr[i];
                        var percent = text_arr[i] + "：" + 100 * data_arr[i] + "%";
                        ctx.fillText(percent, textX, textY + 20 * i);
                    }
                }

                function init() {
                    var data_arr = <?php echo json_encode($percentage ); ?>;
                    var text_arr = <?php echo json_encode($status ); ?>;
                    var color_arr = ["#34733e", "#c1984d", "#358b94", "#a54929","#b8b8b8"];
                    drawCircle("canvas_circle", data_arr, color_arr, text_arr);
                }
                window.onload = init;
            </script>
</head>
<body>
<div class="top-container">
    <h1>Prisoner Status Visualization</h1>
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
            <canvas id="canvas_circle" width="750" height="450" style="border:0px;" >
            </canvas>
    </div>
</div>
<div class='footer'>
    Copyright &copy; 2021 - 2021 Sharon Liu & Shawn Gu & Kaining Zheng
    <a href="login.php">Log Out</a>
</div>
</body>
</html>
