<html>
<head>
<title>Account</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css" />
  <?php
    session_start();
    if(isset($_SESSION['username']))
    {
      echo 'Weclome to your account ' . $_SESSION['username'];
      echo '<br><br><a href="#" onclick="history.back();">Back</a>';
    }
    else
    {
      echo 'You must be logged in to view your account details';
    }
  ?>
</body>
</html>