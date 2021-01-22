<?php
session_start();
extract($_GET);
if(!isset($_SESSION['user_id']))
	header("Location: login_form.php");

try{
	require('project_connection.php');
	 $sql="SELECT * from auctions WHERE WINNER_ID is NOT NULL";
   $rs=$db->query($sql);
   $x=$rs->rowCount();
   $stmtpic = $db->prepare("select picture from pictures where auction_id = ? limit 1");
	 $db = null;
}
catch(PDOException $e)
{
	die("Error Message".$e->getMessage());
}
?>
<html>
<head>
  <title> History </title>
</head>
<body>
<?php

if ($x == 0)
echo "No history on any Auctions";
else {
	echo "<table border='1'>";
	while($row = $rs->fetch())    // fetching each auction
	{
		  $winner = $row['WINNER_ID'];
			if ($_SESSION['userId']==$winner)  //checking if the logged in user is the winner of that particular auction
	 			{    		 // $stmt->fetch()
	        	 	echo "<tr>";
	          	$stmtpic->execute(array($row["AUCTION_ID"]));
	          	if ($pic = $stmtpic->fetch())
	            	echo "<td rowspan='3'> <img src='".$pic[0]."'/></td>";
	          	else
	            	echo "No picture";

	          	echo "<td> Name: ".$row["AUCTION_NAME"]."</td>";
	        		echo "<br>";
							echo "<td> Description:". $row['DESCRIPTION']."</td>";
	          	echo "<td>Highest Bid: ".$row["HIGHEST_BID"]."</td>";
	        		echo "<br>";
							echo "<hr>";
							echo "</tr>";
	           }
				 	}
}


    echo "</table>";
?>
</body>
</html>
