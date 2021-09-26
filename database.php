<html>
  <title>Intelligence Prison Management System</title>
  <body>
  <h1>Database Management - Intelligence Prison Management System</h1>
  <hr>
    <a href="mainPage.php">Main Page</a>
<!--  <a href="index.php">Main Page</a> -->
<!--  <a href="prisoner.php">Prisoner</a> -->
<!--  <a href="database.php">Schedule</a> -->
<!--  <a href="schedule.php">Database</a> -->
  
  <hr>
  <h3>Display All</h3>
  <p>Display everything</p>
  <form>
  
  </form>
  <hr>
  <h3>Reset</h3>
  <p>Reset whole database</p>
  <form method="POST" action="database.php">
    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
    <p><input type="submit" value="Reset" name="reset"></p>
  </form>
  <?php
    echo "Good day! ";
    echo "<br>";
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

    function handleResetRequest() {
        
    }

    function handleUpdateRequest() {

    }

    function handleCountRequest() {

    }

    function handlePrintRequest() {

    }

    function handleDeleteRequest() {

    }

    function handlePOSTRequest() {
      if(array_key_exists('resetTablesRequest', $_POST)) {
        handleResetRequest();
      } else if(array_key_exists('updatePrisoner', $_POST)) {
        handleUpdateRequest();
      } else if(array_key_exists('deletePrisoner', $_POST)) {
        handleDeleteRequest();
      }
    }
    function handleGETRequest() {
      if (array_key_exists('countTuples', $_GET)) {
          handleCountRequest();
      } else if (array_key_exists('printTuples', $_GET)) {
          handlePrintRequest();
      }
    }
    
    //Prisoner handle
    if (isset($_POST['reset']) || isset($_POST['updateDatabase']) || isset($_POST['addDatabase']) || isset($_POST['deleteDatabase'])) {
      handlePOSTRequest();
    } else if (isset($_GET['printTupleRequest']) || isset($_GET['printPrisonerCellRequest'])) {
      handleGETRequest();
    }

    
    //disconnect
    $mysqli->close();
  ?>
  </body>
</html>  