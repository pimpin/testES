<?php

// username and password sent from form 
$postedEmail= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$postedPassword= filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$imputsValid= true;
$errorHtml='';

// validates fields
function _validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE){
      $errorHtml+='Email must be valid.<br/>';
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
function _validatePwd($password) {
    if ($password === ''){
      $errorHtml+='Password must be valid.<br/>';
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

function _getUser($email, $password) {
  //connect to db
  $host="localhost"; // Host name 
  $username=""; // Mysql username 
  $password=""; // Mysql password 
  $db_name="test"; // Database name 
  $tbl_name="members"; // Table name 
  
  // Connect to server and select databse.
  mysql_connect("$host", "$email", "$password")or die("cannot connect"); 
  mysql_select_db("$db_name")or die("cannot select DB");
  
  // To protect MySQL injection (more detail about MySQL injection)
  $myusername = stripslashes($myusername);
  $mypassword = stripslashes($mypassword);
  $myusername = mysql_real_escape_string($myusername);
  $mypassword = mysql_real_escape_string($mypassword);
  $sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
  $result=mysql_query($sql);
  
  // Mysql_num_row is counting table row
  $count=mysql_num_rows($result);
  
  // If result matched $myusername and $mypassword, table row must be 1 row
  if($count==1){
  
  // Register $myusername, $mypassword and redirect to file "login_success.php"
  session_register("myusername");
  session_register("mypassword"); 
  header("location:login_success.php");
  }
  else {
  $errorHtml = "Wrong Username or Password";
  }
}

if ( _validateEmail($postedEmail) && _validatePwd($postedPassword)) {
  _getUser($postedEmail,$postedPassword)
}
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>Test ES</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  </head>
  <body>
    <section id='regex'>
      <h1>Parse numbers</h1>
      <p id='source'>On February 13, 2009, at exactly 23:31:30 (UTC) the decimal representation of Unix time was equal to 1234567890. Parties and other celebrations were held around the world, among various technical subcultures, to celebrate this day.</p>
      <p id='result'></p>
    </section>
    <section id='php'>
      <div id='loginNotice'><?php echo $errorHtml; ?></div>
      <form name='login' method="POST" action="index.php">
        Email: <input type="text" name="email" size="15" /><br />
        Password: <input type="password" name="password" size="15" /><br />
        <p><input type="submit" value="Login" /></p>
      </form>
      <p><?php echo date("D/M/Y H:i"); ?></p>
    </section>
    <script src='script.js'></script>
  </body>
</html>