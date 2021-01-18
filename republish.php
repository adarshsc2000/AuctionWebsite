<?php
require('header.php');
session_start();
extract($_GET);
try
{
	require('project_connection.php');
  $stmt = $db->query("select * from auctions where STATUS='failed' and WINNER_ID = ".$_SESSION['userId']);
  $count=$stmt->rowCount();
  // checks if there are failed auctions or not first !
  if($count==0)
  {
    echo"There are no failed auctions.";
  }
  else
  {
    echo "<table border='1'>";
    while($rows = $stmt->fetch())
      {
        echo "<tr>";
          $stmtpic->execute(array($rows["AUCTION_ID"]));
          if ($pic = $stmtpic->fetch())
          {
            echo "<td rowspan='3'> <img src='".$pic[0]."'/></td></tr>";
            echo "No picture";
            echo "<td> <h4> Name: ".$rows["AUCTION_NAME"]."</h4></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> <h4> Auction desciption".$rows["DESCRIPTION"]."</h4></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Start date: ".$rows["START_TIME_DATE"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>End date: ".$rows["END_TIME_DATE"]."</td>";
            echo "</tr>";
            echo"<tr>";
            echo "<td>Highest Bid: ".$rows["HIGHEST_BID"]."</td>";
            echo "</tr>";
            echo"<form method='POST'>";
            echo"<label>Edit failed Auctions:</label>";
          	echo"<input type='submit' value= 'Edit auction'name='edit'>";
          	echo"</form>";
          }
          else
          {
	        echo "No picture";
	        echo "<td> <h4> Name: ".$rows["AUCTION_NAME"]."</h4></td>";
	        echo "</tr>";
	        echo "<tr>";
	        echo "<td> <h4> Auction desciption".$rows["DESCRIPTION"]."</h4></td>";
	        echo "</tr>";
	        echo "<tr>";
	        echo "<td>Start date: ".$rows["START_TIME_DATE"]."</td>";
	        echo "</tr>";
	        echo "<tr>";
	        echo "<td>End date: ".$rows["END_TIME_DATE"]."</td>";
	        echo "</tr>";
	        echo"<tr>";
	        echo "<td>Highest Bid: ".$rows["HIGHEST_BID"]."</td>";
	        echo "</tr>";
	        echo"<form method='POST'>";
	        echo"<label>Edit failed Auctions:</label>";
	      	echo"<input type='submit' value= 'Edit auction'name='edit'>";
	      	echo"</form>";
         }
      }
        if(isset($submit))
        {
          echo"<html>";
          echo"<body>";
          echo"<form method='POST'>";
          echo "<input type='date' name='sdate' value='date('Y-m-d')'>";
          echo "<input type='date' name='edate' value='date('Y-m-d')'>";
          echo "<input type='number' step='0.001' name='biddingamount'>";
          echo"</form>";
          echo"</body>";
          echo"</html>";
          $result = $db->exec("update auctions set START_TIME_DATE='$sdate',HIGHEST_BID='$biddingamount',END_TIME_DATE='$edate' where AUCTION_ID =".$_SESSION['auction_id']);
          echo "Successfully updated the database";
          $db=null;
        header("Location: view.php");
        }
}
}
catch(PDOException $e)
{
	die("Error Message".$e->getMessage());
}
