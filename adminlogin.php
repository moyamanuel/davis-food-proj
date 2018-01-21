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

if(isset($_POST['login'])){
  global $hostname,$username_db, $password_db, $database, $username, $password;
  $connection= getconn($hostname,$username_db, $password_db, $database);
  validate_credentials($connection, $username, $password);
    $connection -> close();
}
//=============================================================================
// Function to check if the admin credentials are valid or not
// returns 1 if valid else program dies.
// @param- connection to use the query
// @param- username and password to match from the database

function validate_credentials($connection, $username, $password)
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
          if($token == $row[1]){
            //intializing the session to session_start
            session_start();
            $_SESSION['username'] = $row[0];
           // Redirect the admin to page where they want to be 
           
           
           
           
        }
        else{
          echo '<p> Credentials not valid </p>';
        }
      }
      else die("Invalid username/password combination");
}
//===============================================================================
/* Function to validate if username entered matches the condition or not
*/
function validate_malwarename($field) {
return ($field == "") ? "No Forename was entered<br>": "";
}

function validate_adminFile($field) {
return ($field == "") ? "No file was entered<br>": "";
}

 //===================================================================================

 function fix_string($string) {
   if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
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
