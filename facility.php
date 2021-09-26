<!DOCTYPE html>
<html class="bgstyle">
  <head>
  <meta charset="utf-8">
    <link rel="stylesheet" href = "css/officer.css">
    <title>Intelligence Prison Management System</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
</head>
  <body>
  <div class="top-container">
    <h1>Facility Management</h1>
    <h3>Intelligence Prison Management System</h3>
  </div>
  <div class="ulnavi">
    <ul>
      <li>
        <a href="mainPage.php">Main Page</a>
      </li>
    </ul>
  </div>
  <table width=100%>
    <tr>
      <td>
        <div class="left-container">
          <p>Display Officer ID and name who has patrolled all facilities:</p>
          <form method="GET" action="facility.php">
            <table>
              <input type="hidden" id="printQueryRequest" name="printQueryRequest">
              <tr>
                <td><input type="submit" value="Display" name="printFacility"></td>
              </tr>
            </table>
          </form>
        </div>
      </td>
      <td>
        <div class="right-container">
          <?php
    include 'connect.php';
    $conn = OpenCon();

    echo 'Success: A proper connection to MySQL was made.';
    echo '<br>';
    echo 'Host information: '.$conn->host_info;
    echo '<br>';
    echo 'Protocol version: '.$conn->protocol_version;

    function handlePrintRequest() {
      global $conn;
      $sql = "SELECT o.Officer_ID, o.Officer_name 
                FROM Correction_Officer o 
                WHERE NOT EXISTS 
                ((SELECT f.F_ID FROM Facility f) 
                EXCEPT 
                (SELECT r.R_ID
                FROM Schedule_Control_Routine r 
                WHERE r.R_ID = o.R_ID";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Officer ID</th>
                <th>Officer Name</th>
                </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['o.Officer_ID']}</td>
                    <td>{$row['o.Officer_name']}</td>
                    </tr>";
        }
        echo "</table>";
      } else {
        echo "<br/>";
        echo "<strong>0 results from your search</strong>";
      }
    }

    function handleGETRequest() {
      if (array_key_exists('printQueryRequest', $_GET)) {
          handlePrintRequest();
      }
    }
    
    if (isset($_GET['printPrisoner'])) {
      handleGETRequest();
    }

    $conn->close();
  ?>
        </div>
      </td>
    </tr>

  </table>
  </body>
</html>
