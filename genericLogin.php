<?php
require_once 'login_details.php';

$username = $password = "";
if(isset($_POST['username'])){
 $username = fix_string($_POST["username"]);
}
if(isset($_POST['password'])){
 $password = fix_string($_POST["password"]);
}

$fail = validate_username($username);
$fail .= validate_password($password);

if(isset($_POST['login'])){
  global $hostname,$username_db, $password_db, $database, $username, $password;
  $connection= getconn($hostname,$username_db, $password_db, $database);
    if(isset($_REQUEST['select_box']) && $_REQUEST['select_box'] == '0') {
      validateUser($connection,$username,$password )
    } else if ($_REQUEST['select_box'] == '1'){
      validateAdmin($connection, $username, $password);
    }else if($_REQUEST['select_box'] == '2'){
        validateDonor($connection, $username, $password);
    }else{
      echo "Not a valid option";
    }
  }
    $connection -> close();
}


//=============================================================================
// Function to check if the admin credentials are valid or not
// returns 1 if valid else program dies.
// @param- connection to use the query
// @param- username and password to match from the database
function validateAdmin($connection, $username, $password)
{
  $sql = "SELECT * FROM admin WHERE username = '$username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
           $result->close();
          $salt1 = "jau&2js"; $salt2 = "aow@ues";
          $token = hash('ripemd128', "$salt1$password$salt2");
          echo $token;
          if($token == $row[2]){
            //intializing the session to session_start
            session_start();
            $_SESSION['username'] = $row[1];
           // Redirect the admin to page where they want to be




        }
        else{
          echo '<p> Credentials not valid </p>';
        }
      }
      else die("Invalid username/password combination");
}

//=============================================================================
// Function to check if the user credentials are valid or not
// returns 1 if valid else program dies.
// @param- connection to use the query
// @param- username and password to match from the database

function validateUser($connection,$username,$password )
{
  $sql_username =  mysql_entities_fix_string($connection, $username);
  $sql_password =  mysql_entities_fix_string($connection, $password);
  $sql = "SELECT * FROM user WHERE username = '$sql_username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $result->close();
          $salt1 = "l&hga@1"; $salt2 = "pg!@";
          $token = hash('ripemd128', "$salt1$sql_password$salt2");
          if($token == $row[2])  {
            echo 'Logged In';
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password']=$token;
            // Redirect to the specified page



        }
        else die("Invalid username/password combination");
      }
      else die("Invalid username/password combination");
}

//=============================================================================
// Function to check if the donor credentials are valid or not
// returns 1 if valid else program dies.
// @param- connection to use the query
// @param- username and password to match from the database

function validateDonor($connection,$username,$password )
{
  $sql_username =  mysql_entities_fix_string($connection, $username);
  $sql_password =  mysql_entities_fix_string($connection, $password);
  $sql = "SELECT * FROM donor WHERE username = '$sql_username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $result->close();
          $salt1 = "l&hga@1"; $salt2 = "pg!@";
          $token = hash('ripemd128', "$salt1$sql_password$salt2");
          if($token == $row[2])  {
            echo 'Logged In';
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password']=$token;

            // Redirect to the specified page



        }
        else die("Invalid username/password combination");
      }
      else die("Invalid username/password combination");
}


//===============================================================================
/* Function to validate if username entered matches the condition or not
*/
function validate_username($field) {
return ($field == "") ? "No Username was entered.\n" : "";
};
// Function for PHP validation of the submitted Password field if it's entered or not.
function validate_password($field) {
return ($field == "") ? "Please Enter your Password.\n" : "";
};

 //===================================================================================

 function fix_string($string) {
   if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
  }
  //Sanitizing data to be entered to the database.
    function mysql_entities_fix_string($conn, $string)
  	{
  		return htmlentities(mysql_fix_string($conn, $string));
  	}
  	function mysql_fix_string($conn, $string)
  	{
  		if (get_magic_quotes_gpc()) $string = stripslashes($string);
  		return $conn->real_escape_string($string);
  	}
//======================================================================================
  /* Function to create function between php and mysqli
  @param 1: $hostname
  @param2: username
  @param3: PassWord
  @param4: Database
  */
  function getconn($hn, $un, $pw, $db)
  {
    $conn = new mysqli ($hn, $un, $pw, $db);
    if($conn-> connect_error) die ($conn ->connect_error);
    return $conn;
  }
//===================================================================================================

 ?>
