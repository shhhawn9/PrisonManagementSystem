<html class="bgstyle">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intelligence Prison Management System</title>  
    <link rel="stylesheet" href="css/normal-menu.css">
    <link rel="stylesheet" href = "css/officer.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
  
</head>
<body>
    <div class="icon-bar">
      <a class="active" href="mainPage.html">Main Page</a>
      <a href="prisoner.php">Prisoner</a>
      <a href="officer.php">Officer</a>
      <a href="schedule.php">Schedule</a>
      <a href="rpSystem.php">RP System</a>
  </div>
    <div class="top-container">
    <h1>Schedule Management</h1>
    <h3>Intelligence Prison Management System</h3>
  </div>
  <hr>
    
  <table width=100%>
    <tr>
      <td>
        <div class="left-container">
        <h5>Add new Schedule</h5>
        <form method="POST" action="schedule.php">
          <table>
            <input type="hidden" id="insertScheduleRequest" name="insertScheduleRequest"> 
            <tr>
            <td>Schedule ID:</td>
            <td><input type="text" name="id"></td>
            <td></td>
            </tr>    
            <tr>
            <td>Start time:</td>
            <td><input style="width:200px;" type="datetime-local" name="start"></td>
            <td></td>
            </tr>    
            <tr>
            <td>End time:</td>
            <td><input style="width:200px;" type="datetime-local" name="end"></td>
            <td></td>
            </tr>    

            <tr>
            <td>Prisoner ID:</td>
            <td><input type="text" name="prisoner_id"></td>
            <td></td>
            </tr> 
            <tr>
            <td>Employee ID:</td>
            <td><input type="text" name="employee_id"></td>
            <td></td>
            </tr> 
            <tr>
            <td>Schedule type:</td>
            <td><select style="width:200px;" id="s_type" name="s_type">
                  <option value="V">Visiting</option>
                  <option value="W">Working</option>
                  <option value="A">Activity</option>
                  </select></td>
            <td></td>
            </tr> 
            <tr>
            <td>Facility ID:</td>
            <td><select style="width:200px;" id="facility_id" name="facility_id">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  </select></td>
            <td></td>
            </tr> 
            <tr>
            <td>Routine ID(1 or 2):</td>
            <td><select style="width:200px;" id="r_id" name="r_id">
                  <option value="1">inside Schedule</option>
                  <option value="2">outside Schedule</option>
                  </select></td>
            <td></td>
            </tr> 
            <!-- <hr> -->
            <tr>
            <td>If you choose Visiting for Schedule type, please fill the forms below</td>
            </tr> 
            <tr>
            <td>visitor ID(optional):</td>
            <td><input type="text" name="v_id"></td>
            <td></td>
            </tr>
            <tr>
            <td>visitor name(optional):</td>
            <td><input type="text" name="v_name"></td>
            <td></td>
            </tr> 

            <tr> 
            <td>the relationship of visitor(optional):</td>
            <td><input type="text" name="v_relationship"></td>
            <td></td>
            </tr> 

            <tr>
            <td></td>
            <td><input type="submit" value="Add" name="addSchedule"></td>
            </tr>
          </table>
        </form>

  
<!-- 
  <h2>Delete a Schedule</h2>
    <form method="POST" action="Schedule.php">
      <input type="hidden" id="deleteScheduleRequest" name="deleteScheduleRequest">
      <p>
        Schedule ID: <input type="text" name="id"> <br/><br/>
      <input type="submit" value="Delete" name="deleteSchedule">
      </p>
    </form> -->
  <hr>
  <h5>Display a Schedule</h5>
   
    <form method="GET" action="Schedule.php">
    <table>
      <input type="hidden" id="printOneTuple" name="printOneTuple">    
      <td>Schedule ID:</td>
      <td><input type="text" name="id"> </td>
      <td><input type="submit" value="print" name="printTupleRequest"></td> 
    </table>
    </form>    
   </div> 
  </td> 
  <td>
      <div class="right-container">
  
  <?php
    include 'connect.php';
    $conn = OpenCon();
    echo "Connected Successfully"; 
    echo "<br>";
    // echo 'Success: A proper connection to MySQL was made.';
    // echo '<br>';
    // echo 'Host information: '.$conn->host_info;
    // echo '<br>';
    // echo 'Protocol version: '.$conn->protocol_version;

    function handleInsertRequest() {
      global $conn;
      $bind1 = $_POST['id'];
      $bind2 = $_POST['start'];
      $bind3 = $_POST['end'];
      $bind4 = $_POST['prisoner_id'];
      $bind5 = $_POST['employee_id'];
      $type = $_POST['s_type'];
      $F_ID = $_POST['facility_id'];
      $R_ID = $_POST['r_id'];
      $V_ID = $_POST['v_id'];
      $V_name = $_POST['v_name'];
      $V_rel = $_POST['v_relationsip'];
      echo '<br>'; 
      $sql= "INSERT INTO Schedule (Schedule_ID, start_time, end_time, Employee_ID) VALUES ('$bind1', '$bind2', '$bind3', '$bind5');";
      $sql .= "INSERT INTO Prisoner_follow_Schedule (P_ID, Schedule_ID) VALUES ($bind4, $bind1);";
      $sql .= "INSERT INTO Schedule_control_routine (R_ID, Schedule_ID) VALUES ('$R_ID', '$bind1');";
      

      // mysqli_query($conn, $sql1);
      // mysqli_query($conn, $sql2);
      // mysqli_query($conn, $sql3);
      if ($type == 'V') {
        $sql .="INSERT INTO Visiting (Schedule_ID, visiting_type) VALUES ('$bind1', 'visit');";
        $sql .="INSERT INTO Facility_type(Schedule_ID, F_Type) VALUES ('$bind1', 'visiting');";
        // mysqli_query($conn, $sql4);   
        // mysqli_query($conn, $sql5);
      } else if ($type == 'W') {
        $sql .="INSERT INTO Working (Schedule_ID, working_type) VALUES ('$bind1','work');";
        $sql .="INSERT INTO Facility_type(Schedule_ID, F_Type) VALUES ('$bind1', 'working');";
        // mysqli_query($conn, $sql4);   
        // mysqli_query($conn, $sql5);
      } else if ($type == 'A') {
        $sql .="INSERT INTO Activity (Schedule_ID, activity_type) VALUES ('$bind1','do activity');";
        $sql .="INSERT INTO Facility_type(Schedule_ID, F_Type) VALUES ('$bind1', 'activities');";
        // mysqli_query($conn, $sql4);   
        // mysqli_query($conn, $sql5);
      }

      

      if ($type == 'V') {
        $query_visitor_sql = "SELECT * FROM Visitor_prisoner_relation r WHERE r.Visitor_ID=$V_ID AND r.P_ID=$bind4;";
        $exists = $conn->query($query_visitor_sql);
        // $result = $conn->query($sql);
        if ($exists->num_rows == 0) {
          echo 'there is no such visitor, we will register the visitor information';
          $sql .="INSERT INTO Visitor_prisoner_relation (Visitor_ID, P_ID, relationship) VALUES ('$V_ID', '$bind4', '$V_rel');";
          $sql .="INSERT INTO Visitor (Visitor_ID, V_name) VALUES ('$V_ID', '$V_name');";
        } else if ($exists->num_rows > 0){
          echo 'visitor had came here before';
        }
        echo '<br>';
      }
      $sql .= "INSERT INTO Facility (F_ID, Schedule_ID) VALUES ('$F_ID', '$bind1');";
      

      // if ($conn->query($sql1) === TRUE) {
      //   // mysqli_query($conn, $sql);
      //   echo "New record created successfully";
      // } else {
      //   echo "Error: " . $sql1 . "<br>" . $conn->error;
      // }
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

    function handleDeleteRequest() {
      global $conn;

      $bind1 = $_POST['id'];
      echo '<br>';
      $sql = "DELETE FROM Schedule WHERE Schedule_ID='$bind1';";
      if ($conn->query($sql) === TRUE) {
        // echo "aaa";
        if ($result = mysqli_query($conn, $sql)) {
          // echo "bbb";
          while ($row = mysqli_fetch_row($result)) {
            printf ("Schedule ID %s has been removed successfully\n", $row[0]);
          }
          mysqli_free_result($result);
        }
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    // function handleUpdateRequest() {

    // }

    function handlePrintRequest() {
      global $conn;
      $attr = $_GET['id'];
      $sql = "SELECT * FROM Schedule s WHERE s.Schedule_ID=$attr";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Schedule ID</th>
                <th>start time</th>
                <th>end time</th>
                <th>employee ID</th>
                </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['Schedule_ID']}</td>
                    <td>{$row['start_time']}</td>
                    <td>{$row['end_time']}</td>
                    <td>{$row['Employee_ID']}</td>                    
                    </tr>";
        }
        echo "</table>";
      } else {
        echo "<br/>";
        echo "<strong>0 results from your search</strong>";
      }
    }

    function handlePOSTRequest() {  
      if(array_key_exists('insertScheduleRequest', $_POST)) {
        handleInsertRequest();
      } else if(array_key_exists('deleteScheduleRequest', $_POST)) {
        handleDeleteRequest();
      }
      // else if(array_key_exists('updateSchedule', $_POST)) {
      //   handleUpdateRequest();
      // } 
    }
    function handleGETRequest() {
      if (array_key_exists('countTuples', $_GET)) {
          handleCountRequest();
      } else if (array_key_exists('printOneTuple', $_GET)) {
          handlePrintRequest();
      }
    }
    
    //Prisoner handle
    if (isset($_POST['updateSchedule']) || isset($_POST['addSchedule']) || isset($_POST['deleteSchedule'])) {
      handlePOSTRequest();
    } else if (isset($_GET['printTupleRequest'])) {
      handleGETRequest();
    }

    
    //disconnect
    closeCon($conn);
  ?>
  </div>
  </td>
  </tr>
  </table>
  </body>
</html>