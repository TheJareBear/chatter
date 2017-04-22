<?php
session_start();
    if(isset($_SESSION['username']))
    {
      if($_SESSION['username'] == 'admin')
        {
            file_put_contents("../logs/helpchat.html", "");
        }
    }
    header ( "Location: ../admin.php" );
?>
