<?php
require_once 'login.php';

$username = $password = "";

if(isset($_POST['username'])){
 $username = fix_string($_POST["username"]);
}
if(isset($_POST['password'])){
 $password = fix_string($_POST["password"]);
}

$fail = validate_username($username);
$fail .= validate_password($password);

function validate_username($field) {
return ($field == "") ? "No Username was entered.\n" : "";
};

// Function for PHP validation of the submitted Password field if it's entered or not.
function validate_password($field) {
return ($field == "") ? "Please Enter your Password.\n" : "";
};

//==============================================================================
if(isset($_POST['login'])){
  global $hostname,$username_db, $password_db, $database, $username, $password;
  $connection= getconn($hostname,$username_db, $password_db, $database);
  validateUser($connection, $username, $password);
    $connection -> close();
}
//==============================================================================

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
          if($token == $row[3])  {
            echo 'Logged In';
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $row[1];
            $_SESSION['password']=$token;
            header("location: welcome.php");
        }
        else die("Invalid username/password combination");
      }
      else die("Invalid username/password combination");
}
//====================================================================================
/* Function to create connection between php and mysqli
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

//====================================================================================


 ?>
