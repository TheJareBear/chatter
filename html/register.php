<!DOCTYPE html>
<html>
  <head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "chatterbox";

@mysql_connect($host, $user, $pass);
mysql_select_db($db);

if (isset($_POST['username'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

//cases that registration shouldn't work
    if(empty($fname)){echo 'First Name Required';}
    else if(strlen($fname) < 1 || strlen($fname) > 16){echo 'First name must be between 1 and 16 characters';}
    else if(empty($lname)){echo 'Last Name Required';}
    else if(strlen($lname) < 1 || strlen($lname) > 16){echo 'Last name must be between 2 and 16 characters';}
    else if(empty($username)){echo 'Username Required';}
    else if(strlen($username) < 2 || strlen($username) > 16){echo 'Username must be between 2 and 16 characters';}
    else if(empty($password)){echo 'Password Required';}
    else if(strlen($password) < 6){echo 'Password must be longer than 6 characters';}
    else if($confirm != $password){echo 'Passwords do not match';}
//end of cases

    else
      {
        $sql = "SELECT * FROM users WHERE username = '".$username."'";
        $res = mysql_query($sql);
        if(mysql_num_rows($res) > 0) {
          echo 'Username taken';
        }
  else {
      $password = sha1($password);
      $sql = "INSERT INTO `users`(`fname`, `lname`, `username`, `password`) VALUES ('".$fname."', '".$lname."', '".$username."','".$password."')";
      mysql_query($sql);
      session_start();
      $_SESSION['username'] = $username;
      $fp = fopen ( "logs/homechat.html", 'a' );
      fwrite ( $fp, "<div class='msgln'><i>Welcome " . $_SESSION ['username'] . " to their first chat session!</i><br></div>" );
      fclose ( $fp );
      header ('location: index.php');
    }
  }
}

?>

<h2>Register:</h2>
<form method="post" action="register.php">
  First Name: <input type="text" name="fname">
  <br><br>
  Last Name: <input type="text" name="lname">
  <br><br>
  Username: <input type="text" name="username">
  <br><br>
  Password: <input type="password" name="password">
  <br><br>
  Confirm: <input type="password" name="confirm">
  <br><br>
  <input type="submit" name="submit" value="Register and Login">
</form></br>
<a href="index.php">Home</a>

</body>
</html>
