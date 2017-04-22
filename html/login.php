<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "chatterbox";

@mysql_connect($host, $user, $pass);
mysql_select_db($db);

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($password);
    $sql = "SELECT * FROM users WHERE username = '".$username."' AND password ='".$password."'";
    $res = mysql_query($sql);
    if(mysql_num_rows($res) == 1) {
      $_SESSION['username'] = $username;
        //$fp = fopen ( "log.html", 'a' );
        //fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['username'] . " has joined the chat session.</i><br></div>" );
        //fclose ( $fp );
        //keep this stuff in just in case you want it to say this stuff
      header ('location: index.php');
    }
    else {
      echo "<script type='text/javascript'>alert('Failed Login Attempt');</script>";
    }
}
?>
