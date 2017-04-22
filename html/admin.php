<html>
<body>
<link rel="stylesheet" type="text/css" href="style.css" />
<?php
session_start();
    if(isset($_SESSION['username']))
    {
      if($_SESSION['username'] == 'admin')
        {
          echo '<a href="users.php">Users</a><br><br>
                <a href="postFunctions/clearhome.php">Clear Home</a>  |
                <a href="postFunctions/cleargaming.php">Clear Gaming</a>  |
                <a href="postFunctions/clearhelp.php">Clear Help</a>  |  
                <a href="postFunctions/clearrand.php">Clear Random</a><br><br>
                <a href="index.php">Back</a><br><br>';
        }
    else
      echo 'Sorry only admin is allowed in here<br><br><a href="index.php">Home</a>';
    }
    else
      echo 'Sorry only admin is allowed in here<br><br><a href="index.php">Home</a>';
?>
</body>
</html>
