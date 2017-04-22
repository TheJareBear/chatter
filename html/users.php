<link rel="stylesheet" type="text/css" href="style.css" />

<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "chatterbox";

@mysql_connect($host, $user, $pass);
mysql_select_db($db);

session_start();
    if(isset($_SESSION['username']))
    {
      if($_SESSION['username'] == 'admin')
        {
          echo '<a href="admin.php">Back</a><br><br>';

          $result = mysql_query("SELECT * FROM users order by lname");

		echo '<form method="post" action="users.php">';

		echo "<center><table border='1'>
		<tr>
		<th>Last Name</th>
		<th>First Name</th>
		<th>Username</th>
		<th>Delete</th>
		</tr>";

		$users = array();
		$users[0] = array();
		$i = 0;
		while($row = mysql_fetch_array($result))
		  {
		  	$users[$i]['last'] = $row['lname'];
		  	$users[$i]['first'] = $row['fname'];
		  	$users[$i]['user'] = $row['username'];
		  	$i = $i + 1;
		  }

		 for($k = 0; $k < $i; $k = $k + 1)
		 {
		  	echo "<tr>";
			echo "<td>" . $users[$k]['last'] ."</td>";
		  	echo "<td>" . $users[$k]['first'] ."</td>";
		  	echo "<td>" . $users[$k]['user'] ."</td>";
		  	echo '<td><input type="submit" name="deleteItem'.$k.'" value="Delete"/></td>';
		  	echo "</tr>";

		  	if(isset($_POST['deleteItem'. $k]))
					{
		  				$delete = $users[$k]['user'];
		  				$query = "DELETE FROM `users` where `username` = '$delete'";
		  				mysql_query($query);
		  				header ("location: users.php");
					}
		 }

	      echo "</table></center>";
	      echo "</form>";
	      mysql_close();
	    }
    }
?>
