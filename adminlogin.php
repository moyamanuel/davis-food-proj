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
            header("location: admin_malware.php");
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
function validate_username($field) {
if ($field == "") return "No Username was entered<br>";
else if (strlen($field) < 5) return "Usernames must be at least 5 characters<br>";
else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
     return "Only letters, numbers, - and _ in usernames<br>";
     return "";
}

function validate_password($field) {
if ($field == "") return "No Password was entered<br>";
else if (strlen($field) < 6)
return "Passwords must be at least 6 characters<br>";
else if (!preg_match("/[a-z]/", $field) ||
         !preg_match("/[A-Z]/", $field) ||
         !preg_match("/[0-9]/", $field))
   return "Passwords require 1 each of a-z, A-Z and 0-9<br>"; return "";
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
 echo <<<_END
 <head>
   <style type="text/css">
   body{
     background-color: #33C4FF
   }
   .login{
     margin: auto;
     display: block;
     text-align: center;
   }
   #uname,#pass{
     font-size: 20px;
   }
   .header{
     text-align: center;
     font-size: 20px;
   }
   .error{
     margin: auto;
     display: block;
     text-align: center;
   }
   </style>
   <script>
   function validate(form) {
   fail += validateUsername(form.username.value)
   fail += validatePassword(form.password.value)
   if (fail == "") return true
   else {
     alert(fail); return false
      }
   }

   function validateUsername(field) {
   if (field == "") return "No Username was entered.\n"
   else if (field.length < 5) return "Usernames must be at least 5 characters.\n"
    else if (/[^a-zA-Z0-9_-]/.test(field))
      return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
      return ""
   )

   function validatePassword(field) {
     if (field .. "") return "No Password was entered"
     else if (field.length < 6) return "Passwords must be at least 6 characters"
     else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) || !/[0-9]/.test(field))
       return "Passwords require one each of given char"
       return ""
   }

   </script>
 </head>
 <title> AntiVirus 2017 </title>
   <body>
   <div class="header">
     <h1> Admin Login </h1>
   </div>
   <div class="error">
   Sorry, the following errors were found<br>
   in your form: <p><font color=black size= 4><i>$fail</i></font></p>
   </div>

     <div class="login">
     <form method="post" action="adminlogin.php" onSubmit="return validate(this)">
       Username: <input type="text" name="username" id="uname" /> <br> <br>
       PassWord: <input type="password" name="password" id="pass"/> <br> <br>
               <button type="submit" name="login"> Login </button>
      </form>
     </div>
       <br><br><br><br><hr>
   </body>
_END;
 ?>
