<?php



$username = $description = $exp_date = $image_path = "";

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(isset($_SESSION['username']) || !empty($_SESSION['username']) && isset($_SESSION['name']) || !empty($_SESSION['name'])  )
{
  global $username;
  $username = $_SESSION['username'];
  $password = $_SESSION['password'] ;
  $connection = createConnection($GLOBALS['hn'],$GLOBALS['db'], $GLOBALS['un'],$GLOBALS['pw']);
  validateSession($connection,$username,$password);
  $connection->close();
}
else{
  header("location: insertCredentials.php");
  exit;
};

// Functions to validate if the donor is for real
function validateSession($connection,$username,$password){
  $sql_username =  mysql_entities_fix_string($connection, $username);
  $sql_password =  mysql_entities_fix_string($connection, $password);
  $sql = "SELECT * FROM admin_tbl WHERE username = '$sql_username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $result->close();
          if($password != $row[3])  {
            die("Sorry Some Error occured-User not authorized Please login again <a href=login.php>Click Here to Login</a> ");
          }
        else "";
      }
      else die("Sorry Some Error occured-User not authorized Please login again <a href=login.php>Click Here to Login</a> ");
  }

// Store the information into variable $description
if(isset($_POST['description'])){
  $description = fix_string($_POST["description"]);
}
// Store the information into variable reg_password
if(isset($_POST['exp_date'])){
 $exp_date = fix_string($_POST["exp_date"]);
}

if(isset($_POST['image_path'])){
 $image_path = fix_string($_POST["image_path"]);
}

//Validate the description, expiration_date and imagePath to check the conditions
$fail = validate_description($description);
$fail .= validate_exp_date($exp_date);
$fail .= validate_image_path($image_path);

//===============================================================================
/* Function to validate if username entered matches the condition or not
*/
function validate_description($description) {
return ($field == "") ? "No Username was entered.\n" : "";
};
// Function for PHP validation of the submitted Password field if it's entered or not.
function validate_exp_date($exp_date) {
return ($field == "") ? "Please Enter your Password.\n" : "";
};
function validate_image_path($image_path){
return ($field == "") ? "No Location was entered.\n" : "";
};

//======================================================================================

if(isset($_POST['upload'])){
  global $hostname,$username_db, $password_db, $database,$description,$exp_date,$image_path,$username;
  $connection= getconn($hostname,$username_db, $password_db, $database);
  insertData($description,$exp_date,$image_path,$connection,$username);
}



//======================================================================================
  function insertData($description,$exp_date,$image_path,$conn,$username){
    $username= mysql_entities_fix_string($conn,$username);
    $description= mysql_entities_fix_string($conn, $description);
    $exp_date= mysql_entities_fix_string($conn,$exp_date);
    $image_path = mysql_entities_fix_string($conn,$image_path);
      $sql = "INSERT INTO upload (uname, description, exp_date, image_path)
      VALUES ('$username', '$description', '$exp_date', '$image_path')";
      $result = $connection->query($sql);
      if (!$result) die ("Database access failed: " . $connection->error);
      else{
        //Redirect to whever you want.
      }
}










//======================================================================================

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

 ?>
