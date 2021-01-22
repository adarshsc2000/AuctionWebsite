<?php
require('header.php');
	// Search box from index.php
	session_start();
	extract($_POST);

	if(!isset($_SESSION['userId']))
		header("Location:login_form.php?error=1");

if (!isset($search)) {
	header("Location: index.php?error=5"); //nothing sent through form
}
elseif (trim($search)=="" ) {
	header("Location: index.php?error=6"); //search field empty
}
	try
	{
		require('project_connection.php');
		$sql = "select * from auctions where auction_name like '%".$search."%' and END_TIME_DATE>CURRENT_TIMESTAMP() order by start_time_date DESC ;";
		$stmt = $db->query($sql);
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
				<title> Search Results </title>
			</head>
			<body>
				<header class="masthead bg-primary text-white text-center px-md-2">
				    <div class="container d-flex align-items-center flex-column">
				        <!-- Masthead Heading-->
				        <h1 class="masthead-heading">Search Results</h1>
				        <!-- Icon Divider-->
				        <div class="divider-custom divider-light">
				            <div class="divider-custom-line"></div>
				            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
				            <div class="divider-custom-line"></div>
				        </div>
				    </div>
				</header>
			</br>	</br> </br>
	<section class="text-center">
	  <div class="container align-items-center">
				<table class='table table-borderless'>
					<div class='row'>
				<?php
					if($stmt->rowCount() == 0)
						echo "<h3 class='text-primary'>No search results found !!!</h3>";

					while($row = $stmt->fetch())
					{
				  	echo "<div class='col-6 col-md-4'>";
							$stmtpic->execute(array($row["AUCTION_ID"]));
							if ($pic = $stmtpic->fetch())
								echo "<img src='".$pic[0]."' height='250px' width='250px'/><br />";
							else
							echo "<img src='images/default.jpg' height='250px' width='250px'/><br /><br />";

							echo "<h3 class='text-bold'>".$row["AUCTION_NAME"]."</h3><br />";
							echo "Starts on ".$row["START_TIME_DATE"];

							echo "<h5> Ends on: &nbsp;&nbsp;".$row["END_TIME_DATE"]."</h5>";
							echo "<h5>Starting Price: &nbsp;&nbsp; ".$row["START_PRICE"]."</h5>";
							if($row["HIGHEST_BID"] == '')
								echo "<h4 class='text-primary text-bolder'> No Bids Yet! </h4>";
							else
								echo "<h4 class='text-bold text-primary'> Highest Bid: ".$row["HIGHEST_BID"]." </h4><br />";

							 echo "<form method='get' action='view.php'>";
									 echo "<input type='hidden' name='auction_id' value='".$row["AUCTION_ID"]."'/><br />";
									 echo "<input class='btn btn-secondary btn-lg btn-block' type='submit' name='view' value='View More Details'/> <br />";
							 echo "</form>";
						echo "</div>";
					}
				?>
				</table>
			</div>
		</section>
				<br/> <br/> <br/>
			</body>
		</html>
<?php
?>
