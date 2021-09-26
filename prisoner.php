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
    <h1>Prisoner Management</h1>
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
        <h5>Add new prisoner</h5>

        <form method="POST" action="prisoner.php">
          <table>
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            <tr>
              <td>Prisoner ID:</td> 
              <td><input type="text" name="id"></td>
              <td></td>
            </tr>
            <tr>
              <td>Name:</td>
              <td><input type="text" name="P_Name"> </td>
              <td></td>
            </tr>
            <tr>
              <td>Gender:</td>
              <td><input type="text" name="gender"></td>
              <td></td>
            </tr>
            <tr>
              <td>Job:</td>
              <td><input type="text" name="job"></td>
              <td></td>
            </tr>
            <tr>
              <td>Cell:</td>
              <td><input type="text" name="cell_ID"></td>
              <td></td>
            </tr>
            <tr>
              <td>Sentence:</td>
              <td><input type="date" name="sentence"></td>
              <td></td>
            </tr>
            
            <tr>
              <td></td>
              <td></td>
              <td><input type="submit" value="Add" name="addPrisoner"></td>
            </tr>
          </table>
    
          
        </form>


        <h5>Update prisoner</h5>
        <form method="POST" action="prisoner.php">
          <table>
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            <tr>
              <td>Prisoner ID:</td>
              <td><input type="text" name="id"></td>
              <td>Exist Prisoner</td>
            </tr>
            <tr>
              <td>Name:</td>
              <td><input type="text" name="P_Name"></td>
              <td><input type="submit" value="Update" name="updatePrisoner_P_Name"></td>
            </tr>
            <tr>
              <td>Gender(M or F):</td>
              <td><input type="text" name="gender"></td>
              <td><input type="submit" value="Update" name="updatePrisoner_Gender"></td>
            </tr>
            <tr>
              <td>Job:</td>
              <td><input type="text" name="job"></td>
              <td><input type="submit" value="Update" name="updatePrisoner_job"></td>
            </tr>
            <tr>
              <td>Cell ID:</td>
              <td><input type="text" name="cell_ID"></td>
              <td><input type="submit" value="Update" name="updatePrisoner_CellID"></td>
            </tr>
            <tr>
              <td>Sentence: </td>
              <td><input type="date" name="sentence"></td>
              <td><input type="submit" value="Update" name="updatePrisoner_Sentence"></td>
            </tr>
            <tr>
              <td>Performance Credit:</td>
              <td><select id="performanceCredit" name="performanceCredit">
                  <option value="-10">-10</option>
                  <option value="-9">-9</option>
                  <option value="-8">-8</option>
                  <option value="-7">-7</option>
                  <option value="-6">-6</option>
                  <option value="-5">-5</option>
                  <option value="-4">-4</option>
                  <option value="-3">-3</option>
                  <option value="-2">-2</option>
                  <option value="-1">-1</option>
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  </select></td>
              <td><input type="submit" value="Update" name="updatePrisoner_performanceCredit"></td>
            </tr>
          </table>
        </form> 

        <h5>Delete prisoner</h5>




        <form method="POST" action="prisoner.php">
          <table>
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            <tr>
              <td>Prisoner ID:</td>
              <td><input type="text" name="id"></td>
              <td><input type="submit" value="Delete" name="deletePrisoner"></td>
            </tr>
          </table>
        </form>

        <h5>Display prisoner</h5>
        <form method="GET" action="prisoner.php">
          <table>
            <input type="hidden" id="printQueryRequest" name="printQueryRequest">
            <td>Prisoner ID:</td>
            <td><input type="text" name="get_id"></td>
            <td><input type="submit" value="Print" name="printPrisoner"></td>
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

    function handleUpdateRequest() {
      global $conn;
      $id = $_POST['id'];
      $attr = NULL;
      if (isset($_POST['updatePrisoner_P_Name'])) {
        $attr = $_POST['P_Name'];
        $sql = "UPDATE Prisoner SET P_Name='$attr' WHERE P_ID = $id";
      }
      else if (isset($_POST['updatePrisoner_Gender'])) {
        $attr = $_POST['gender'];
        $sql = "UPDATE Prisoner SET gender = '$attr' WHERE P_ID = $id";
      }
      else if (isset($_POST['updatePrisoner_job'])) {
        $attr = $_POST['job'];
        $sql = "UPDATE Prisoner_job_credit SET job = '$attr' WHERE P_ID = $id";
      }
      else if (isset($_POST['updatePrisoner_CellID'])) {
        $attr = $_POST['cell_ID'];
        $sql = "UPDATE Prisoner_cell SET Cell_ID = $attr WHERE P_ID = $id";
      }
      else if (isset($_POST['updatePrisoner_Sentence'])) {
        $attr = date('Y-m-d', strtotime($_POST['sentence']));
        $sql = "UPDATE Prisoner_cell SET sentence = '$attr' WHERE P_ID = $id";
      }
      else if (isset($_POST['updatePrisoner_performanceCredit'])) {
        $attr = $_POST['performanceCredit'];
        $sql = "UPDATE Prisoner_job_credit SET performance_credit = $attr WHERE P_ID = $id";
      }
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }

    }

    function handlePrintRequest() {
      global $conn;
      $attr = $_GET['get_id'];
      $sql = "SELECT * FROM Prisoner p, Prisoner_cell c, Prisoner_job_credit j, Prisoner_credit_status s 
                WHERE p.P_ID = j.P_ID AND 
                      p.P_ID = c.P_ID AND 
                      j.performance_credit = s.performance_credit AND
                      p.P_ID = $attr";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Prisoner ID</th>
                <th>Prisoner Name</th>
                <th>Gender</th>
                <th>Cell ID</th>
                <th>Sentence Until</th>
                <th>Performance Credit</th>
                <th>Status</th>
                <th>Job</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['P_ID']}</td>
                    <td>{$row['P_Name']}</td>
                    <td>{$row['Gender']}</td>
                    <td>{$row['Cell_ID']}</td>
                    <td>{$row['Sentence']}</td>
                    <td>{$row['performance_credit']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['Job']}</td>
                    </tr>";
        }
        echo "</table>";
      } else {
        echo "<br/>";
        echo "<strong>0 results from your search</strong>";
      }
    }

    function handleDeleteRequest() {
      global $conn;
      $tuple = $_POST['id'];
      $sql = "DELETE FROM Prisoner_cell WHERE P_ID=$tuple;";
      $sql .= "DELETE FROM Prisoner_job_credit WHERE P_ID=$tuple;";
      $sql .= "DELETE FROM Prisoner WHERE P_ID=$tuple";
      echo "<br/>";
      if ($conn -> multi_query($sql)) {
        do {
          // Store first result set
          if ($result = $conn -> store_result()) {
            while ($row = $result -> fetch_row()) {
              printf("%s\n", $row[0]);
            }
          $result -> free_result();
          }
          // if there are more result-sets, the print a divider
          if ($conn -> more_results()) {
            printf("-------------\n");
          }
          //Prepare next result set
        } while ($conn -> next_result());
      }
    }

    function handleInsertRequest() {
      global $conn;
      $bind1 = $_POST['id'];
      $bind2 = $_POST['P_Name'];
      $bind3 = $_POST['gender'];
      $bind4 = !empty($_POST['job']) ? $_POST['job'] : "NULL";
      $bind5 = $_POST['cell_ID'];
      $bind6 = date('Y-m-d', strtotime($_POST['sentence']));
      $bind7 = $_POST['performanceCredit'];
      $sql = "INSERT INTO Prisoner(P_ID, P_Name, Gender) VALUES ($bind1, '$bind2', '$bind3');";
      $sql .= "INSERT INTO Prisoner_job_credit(P_ID, Job, performance_credit)  VALUES ($bind1, '$bind4', $bind7);";
      $sql .= "INSERT INTO Prisoner_cell(P_ID, Cell_ID, Sentence) VALUES ($bind1, $bind5, '$bind6')";
      echo "<br/>";
      if ($conn -> multi_query($sql)) {
        do {
          // Store first result set
          if ($result = $conn -> store_result()) {
            while ($row = $result -> fetch_row()) {
              printf("%s\n", $row[0]);
            }
          $result -> free_result();
          }
          // if there are more result-sets, the print a divider
          if ($conn -> more_results()) {
            printf("-------------\n");
          }
          //Prepare next result set
        } while ($conn -> next_result());
      }
    }

    function handlePOSTRequest() {
      if(array_key_exists('updateQueryRequest', $_POST)) {
        handleUpdateRequest();
      } else if(array_key_exists('deleteQueryRequest', $_POST)) {
        handleDeleteRequest();
      } else if(array_key_exists('insertQueryRequest', $_POST)) {
        handleInsertRequest();
      }
    }
    function handleGETRequest() {
      if (array_key_exists('printQueryRequest', $_GET)) {
          handlePrintRequest();
      }
    }
    
    //Prisoner handle
    if (isset($_POST['updatePrisoner_P_Name'])
        || isset($_POST['updatePrisoner_Gender'])
        || isset($_POST['updatePrisoner_job'])
        || isset($_POST['updatePrisoner_CellID'])
        || isset($_POST['updatePrisoner_Sentence'])
        || isset($_POST['updatePrisoner_status'])
        || isset($_POST['updatePrisoner_performanceCredit'])
        || isset($_POST['addPrisoner'])
        || isset($_POST['deletePrisoner'])) {
      handlePOSTRequest();
    } else if (isset($_GET['printPrisoner'])) {
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
