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
  <h1>Correction Officer Management</h1>
  <h3>Intelligence Prison Management System</h3>
  </div>
  <div class="ulnavi">
      <ul>
        <li>
          <a href="mainPage.php">Main Page</a>
        </li>
      </ul>
    </div>
<table width=100%><tr><td>
<div class="left-container">
  <h5>Add new officer</h5>

  
  <form method="POST" action="officer.php">
  <table>
    <tr>
      <td>
        <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
      </td>
    </tr>
    
    <tr>
      <td>Officer ID: </td>
      <td><input type="text" name="Officer_ID"></td>
      <td></td>
    </tr>
    <tr>
      <td>Name: </td>
      <td><input type="text" name="Officer_name"></td>
      <td></td>
    </tr>
    <tr>
      <td>Taser ID: </td>
      <td><input type="text" name="taser_ID"></td>
      <td></td>
    </tr>
    <tr>
      <td>Supervisor ID: </td>
      <td><input type="text" name="supervisor_ID"></td>
      <td></td>
    </tr>
    <tr>
      <td>Routine ID:</td> 
      <td>  <select id="R_ID" name="R_ID">
              <option value="1">Inside</option>
              <option value="2">Outside</option>
            </select>
      </td>
      <td></td>
    </tr>
    <tr>
      <td>
        
      </td>
      <td></td>
      <td><input type="submit" value="Add" name="addOfficer"></td>
    </tr>
  </table>
  </form>

  <h5>Update officer</h5>

  <table>
   <form method="POST" action="officer.php">
    <tr>
      <td>
        <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
      </td>
    </tr>
    
    <tr>
      <td><strong>Officer ID:</strong></td>
      <td><input type="text" name="Officer_ID"></td>
      <td></td>
    </tr>
    <tr>
      <td>Name: </td>
      <td><input type="text" name="Officer_name"></td>
      <td><input type="submit" value="Update" name="updateOfficer_Officer_Name"></td>
    </tr>
    <tr>
      <td>Taser ID: </td>
      <td><input type="text" name="taser_ID"></td>
      <td><input type="submit" value="Update" name="updateOfficer_taser_ID"></td>
    </tr>
    <tr>
      <td>Supervisor ID:</td>
      <td><input type="text" name="supervisor_ID"></td>
      <td><input type="submit" value="Update" name="updateOfficer_supervisor_ID"></td>
    </tr>
    <tr>
      <td>Routine ID: </td>
      <td><select id="R_ID" name="R_ID">
        <option value="1">Inside</option>
        <option value="2">Outside</option>
      </select></td>
      <td><input type="submit" value="Update" name="updateOfficer_R_ID"></td>
    </tr>
  </form>
  </table>


  <h5>Delete officer</h5>
  <table>
    <form method="POST" action="officer.php">
    <tr><td><input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest"></td></tr>
  
    
    <tr>
      <td>Officer ID:</td>
      <td><input type="text" name="Officer_ID"></td>
      <td><input type="submit" value="Delete" name="deleteOfficer"></td>
    </tr>
  </form>
  </table>

  <h5>Display officer</h5>
  <table>
  <form method="GET" action="officer.php">
    <input type="hidden" id="printQueryRequest" name="printQueryRequest">
    <tr>
      <td>Officer ID:</td>
      <td><input type="text" name="Officer_ID"></td>
      <td><input type="submit" value="Print" name="printOfficer"></td>
    </tr>
  </form>
  </table>
  </div>
  </td>
  <td>
  <div class="right-container">
  <p>

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
      $attr = $_GET['Officer_ID'];
      $sql = "SELECT * FROM Correction_Officer
                WHERE Officer_ID = $attr";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Officer ID</th>
                <th>Officer Name</th>
                <th>Taser ID</th>
                <th>Supervisor ID</th>
                <th>Routine ID</th>
                </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['Officer_ID']}</td>
                    <td>{$row['Officer_name']}</td>
                    <td>{$row['taser_ID']}</td>
                    <td>{$row['supervisor_ID']}</td>
                    <td>{$row['R_ID']}</td>
                    </tr>";
        }
        echo "</table>";
      } else {
        echo "<br/>";
        echo "<strong>0 results from your search</strong>";
      }
    }

    function handleUpdateRequest() {
      global $conn;
      $id = $_POST['Officer_ID'];
      $attr = NULL;
      $sql = NULL;
      if (isset($_POST['updateOfficer_Officer_ID'])) {
        $attr = $_POST['New_Officer_ID'];
        $sql = "UPDATE Correction_Officer SET Officer_ID=$attr WHERE Officer_ID=$id";
      }
      else if (isset($_POST['updateOfficer_Officer_Name'])) {
        $attr = $_POST['Officer_name'];
        $sql = "UPDATE Correction_Officer SET Officer_name='$attr' WHERE Officer_ID=$id";
      } 
      else if (isset($_POST['updateOfficer_taser_ID'])) {
        $attr = $_POST['taser_ID'];
        $sql = "UPDATE Correction_Officer SET taser_ID=$attr WHERE Officer_ID=$id";
      }
      else if (isset($_POST['updateOfficer_supervisor_ID'])) {
        $attr = ($_POST['supervisor_ID'] !== $_POST['Officer_ID']) ? $_POST['supervisor_ID'] : "NULL";
        $sql = "UPDATE Correction_Officer SET supervisor_ID=$attr WHERE Officer_ID=$id";
      }
      else if (isset($_POST['updateOfficer_R_ID'])) {
        $attr = $_POST['R_ID'];
        $sql = "UPDATE Correction_Officer SET R_ID=$attr WHERE Officer_ID=$id";
      }
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }
    
    function handleInsertRequest() {
      global $conn;
      $bind1 = $_POST['Officer_ID'];
      $bind2 = $_POST['Officer_name'];
      $bind3 = $_POST['taser_ID'];
      $bind4 = (!empty($_POST['supervisor_ID'])) ? $_POST['supervisor_ID'] : "NULL";
      $bind5 = $_POST['R_ID'];
      $sql = "INSERT INTO Correction_Officer(Officer_ID, Officer_name, taser_ID, supervisor_ID, R_ID) 
                VALUES ($bind1, '$bind2', $bind3, $bind4, $bind5)";
      echo "<br/>";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function handleDeleteRequest() {
      global $conn;
      $id = $_POST['Officer_ID'];
      $sql = "DELETE FROM Correction_Officer WHERE Officer_ID = $id";
      echo "<br/>";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    function handlePOSTRequest() {
      if(array_key_exists('updateQueryRequest', $_POST)) {
        handleUpdateRequest();
      } else if (array_key_exists('deleteQueryRequest', $_POST)) {
        handleDeleteRequest();
      } else if (array_key_exists('insertQueryRequest', $_POST)) {
        handleInsertRequest();
      }
    }

    function handleGETRequest() {
      if (array_key_exists('printQueryRequest', $_GET)) {
        handlePrintRequest();
      }
    }

    //Officer handle
    if (isset($_POST['updateOfficer_Officer_Name'])
        || isset($_POST['updateOfficer_Officer_ID'])
        || isset($_POST['updateOfficer_taser_ID'])
        || isset($_POST['updateOfficer_supervisor_ID'])
        || isset($_POST['updateOfficer_R_ID'])
        || isset($_POST['addOfficer'])
        || isset($_POST['deleteOfficer'])) {
      handlePOSTRequest();
    } else if (isset($_GET['printOfficer'])) {
      handleGETRequest();
    }
    
    $conn->close();
  ?>

  </p>
    </div>
    </td>
  </tr>
  </table>
  </body>
</html>