<?php
require('header.php');
	// view more details clicked from somewhere
	session_start();
	if (!isset($_SESSION['userId']))
	  header('location:reg_loginform.php?error=1');

	extract($_GET);
if(isset($view))
{
	$_SESSION["auction_id"] = $auction_id;
}
try
	{
		require('project_connection.php');
		$stmt = $db->query("select * from auctions where AUCTION_ID =".$_SESSION['auction_id']);
		$stmtpic = $db->query("select PICTURE from pictures where AUCTION_ID =".$_SESSION['auction_id']);
    $stmt2 = $db->prepare("select USERNAME from users where USER_ID = ?");
?>

	<body>
		<header class="masthead bg-primary text-white text-center px-md-2">
		    <div class="container d-flex align-items-center flex-column">
		        <!-- Masthead Heading-->
		        <h1 class="masthead-heading">Auction Details</h1>
		        <!-- Icon Divider-->
		        <div class="divider-custom divider-light">
		            <div class="divider-custom-line"></div>
		            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
		            <div class="divider-custom-line"></div>
		        </div>
		    </div>
		</header>
		<section class='page-section'>
		<div class='container'>
			<table class='table table-borderless'>
			<?php
				if($row = $stmt->fetch())
				{
					echo "<h1 class='page-section-heading text-secondary font-weight'>".$row["AUCTION_NAME"]."</h1>";
					echo "<div class='row'";
						echo "<tr>";
						echo "<td rowspan = 5>";

						if($stmtpic->rowCount() == 0)
                echo "<img src='images/default.jpg' height='400px' width='400px'/><br /><br />";
						else
							{
								while($pic = $stmtpic->fetch())
								{
										echo "<div class='col-6 col-md-4 my-3'>";
										echo "<img src='".$pic[0]."'height=400px width=400px/>";
										echo "</div>";
								}
							}
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<div class='col-6 col-md-4'>";
	            echo "<td colspan=2> <h5> Description: ".$row["DESCRIPTION"]."</h4></td>";
	          echo "</tr>";

	          echo "<tr>";
	          $stmt2->execute(array($row["OWNER_ID"]));
	          if($user = $stmt2->fetch())
	            echo "<td><h5> Sold by: ".$user[0]."</h4></td>";
							echo "<td><h5>Start Date: ".$row["START_TIME_DATE"]."</h4></td>";

	          echo "</tr>";

						echo "<tr>";
							echo "<td><h5>Start Price: ".$row["START_PRICE"]."</h4></td>";
							echo "<td><h5>End Date: ".$row["END_TIME_DATE"]."<h5></td>";
						echo "</tr>";
					echo "</div>";
					echo "</div>";
            echo "<td colspan=2 class='text-primary'><h3>Highest Bid: ";
            if ($row["HIGHEST_BID"] == null)
              echo "No Bids Yet..!!";
            else
              echo $row["HIGHEST_BID"];

							if($row["OWNER_ID"] != $_SESSION["userId"])
							{
								echo "<br/><br/>";
								echo "<form method='POST' action='bid.php'>";
								echo "<div class='form-group'>";
								echo "<input class='btn btn-lg btn-secondary' type='submit' value='Create New Bid' name='newBid'>";
								echo "</div>";
								echo "</form>";
							}
            echo "</td></h3>";
					echo "</tr>  <br> <br/>";

					echo "<br/><br/><br/>";
				}
			?>
			</table>
		</div>
	</section>
	<section class='page-section bg-primary text-white'>
		<div class='container'>
			<h1 class='page-section-heading'>Public Questions</h1>
		</br> </br> </br>
			<?php require("public_questions.php");?>
		</div>
	</section>
	</body>
</html>
<?php
		$db = null;
	}
	catch(PDOException $e)
	{
		die("Error Message".$e->getMessage());
	}


?>
