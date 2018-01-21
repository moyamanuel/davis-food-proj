<?php

// Initialize the session
session_start();

// Register username and Register Password variables as reg_username and $reg_password
  $reg_username = $reg_password = $location = "";
  // Store the information into variable reg_username
  if(isset($_POST['reg_username'])){
    $reg_username = fix_string($_POST["reg_username"]);
  }
  // Store the information into variable reg_password
  if(isset($_POST['reg_password'])){
   $reg_password = fix_string($_POST["reg_password"]);
  }

  if(isset($_POST['location'])){
   $location = fix_string($_POST["location"]);
  }

  //Validate the username and password to check the conditions
  $fail = validate_username($reg_username);
  $fail .= validate_password($reg_password);
  $fail .= validate_location($location);


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
  function validate_location($location){
  return ($field == "") ? "No Location was entered.\n" : "";
  };
    //===============================================================================
  // if the user hits the submit button to register then insert the information

  if(isset($_POST['reg'])){
    global $hostname,$username_db, $password_db, $database, $reg_username, $reg_password, $location;
    $connection= getconn($hostname,$username_db, $password_db, $database);
    if(isset($_REQUEST['select_box']) && $_REQUEST['select_box'] == '0') {
      insertUser($conn, $username, $password);
    } else {
      insertDonor($conn, $username, $password, $location);
    }
  }

  //=============================================================================
    /*
    Function to insert the information into admin table in mysql Database
    @param1: connection to use for executing queries
    @param2: username to be entered
    @param3: password to be entered
    */
  function insertUser($conn, $username, $password){
    $username= mysql_entities_fix_string($conn, $username);
    $password= mysql_entities_fix_string($conn,$password);
    $salt1 = "jau&2js"; $salt2 = "aow@ues";
    $token = hash('ripemd128', "$salt1$password$salt2");
    $sql = "INSERT INTO user (username, password, rep_sum, total_reviews))
    VALUES ('$username', '$token', NULL, NULL)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to wherever needed
        //  to whatever PAGE

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn -> close();
  }

  //=============================================================================
    /*
    Function to insert the information into admin table in mysql Database
    @param1: connection to use for executing queries
    @param2: username to be entered
    @param3: password to be entered
    */
  function insertDonor($conn, $username, $password, $location){
    $username= mysql_entities_fix_string($conn, $username);
    $password= mysql_entities_fix_string($conn,$password);
    $location= mysql_entities_fix_string($conn,$location);
    $salt1 = "jau&2js"; $salt2 = "aow@ues";
    $token = hash('ripemd128', "$salt1$password$salt2");
    $sql = "INSERT INTO donor (username, password, rep_sum, total_reviews, location)
    VALUES ('$username', '$token', NULL, NULL, $location)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to wherever needed
        //  to LOGIN PAGE

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn -> close();
  }


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
