<html>
  <title>Intelligence Prison Management System</title>
  <body>
  <h1>Welcome to Intelligence Prison Management System</h1>
  <h3>Reset</h3>
  <p>Reset whole database</p>
  <form method="POST" action="index.php">
    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
    <p><input type="submit" value="Reset" name="reset"></p>
  </form>
  <h3>Prisoner</h3>
  <p>Add new prisoner</p>
  <form method="POST" action="index.php">
    <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
    <p><input type="submit" value="Add" name="add"></p>
  </form>
  <p>Update prisoner</p>
  <form method="POST" action="index.php">
    <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
    <p>
    Prisoner ID: <input type="text" name="id"> <br/><br/>
    New Information: <br/><br/>
    Name: <input type="text" name="P_Name"> <br/>
    Gender: <input type="text" name="gender"> <br/>
    Job:  <input type="text" name="job"> <br/>
    Cell: <input type="text" name="cell_ID"> <br/>
    Sentence: <input type="text" name="sentence"> <br/>
    Status: <input type="text" name="status"> <br/>
    performance_credit: <input type="text" name="performanceCredit"> <br/>
    <input type="submit" value="Update" name="updatePrisoner"></p>
  </form>
  <?php
    echo "Good day!";
    //connect
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '123456';
    $db_db = 'information_schema';
    $db_port = 8888;

    $mysqli = new mysqli(
      $db_host,
      $db_user,
      $db_password,
      $db_db
    );
    
    if ($mysqli->connect_error) {
      echo 'Errno: '.$mysqli->connect_errno;
      echo '<br>';
      echo 'Error: '.$mysqli->connect_error;
      exit();
    }

    echo 'Success: A proper connection to MySQL was made.';
    echo '<br>';
    echo 'Host information: '.$mysqli->host_info;
    echo '<br>';
    echo 'Protocol version: '.$mysqli->protocol_version;

    function handlePOSTRequest() {
      if(array_key_exists('resetTablesRequest', $_POST)) {
        handleResetRequest();
      } else if(array_key_exists('updateSubmit', $_POST)) {
        handleUpdateRequest();
      }
    }
    function handleGETRequest() {
      if (array_key_exists('countTuples', $_GET)) {
          handleCountRequest();
      } else if (array_key_exists('printTuples', $_GET)) {
          handlePrintRequest();
      }
    }
    

    if (isset($_POST['reset']) || isset($_POST['updatePrisoner']) || isset($_POST['insertSubmit'])) {
      handlePOSTRequest();
    } else if (isset($_GET['countTupleRequest']) || isset($_GET['printTupleRequest'])) {
      handleGETRequest();
    }

    //disconnect
    $mysqli->close();
  ?>
  </body>
</html>