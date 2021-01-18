<?php
	require('noheader.php');
	session_start();
	$sid=$_SESSION['userId'];
	extract($_POST);

	try
	{
		require('project_connection.php');
		$stmt = $db->query("select START_PRICE, HIGHEST_BID from auctions where AUCTION_ID =".$_SESSION['auction_id']);

		if($row = $stmt->fetch())
			$min = max($row[0], $row[1]);

		if (isset($submit))
				{
						if($submit == 'Create New Bid')
						{
								$result = $db->exec("update auctions set HIGHEST_BID='$biddingamount', WINNER_ID='$sid' where AUCTION_ID =".$_SESSION['auction_id']);
								echo "Successfully updated the database";
								$db = null;
								header("Location: view.php");
						}
						else
								header("Location: view.php");
				}
?>
				<body class='bg-secondary align-text-middle'>
				</br> </br> </br> </br> </br></br></br>
				<section class='page-section bg-primary'>
					<div class='container d-flex justify-content-center align-self-center'>
							<!--creating form for the user to enter bid amount.-->
							<form method='POST'>
								<div class='form-group'>
									<label> <h1 class='font-weight-bold text-white'>Bidding Amount</h1></label>
									<input class='form-control form-control-lg' type='number' step="0.001" name='biddingamount' <?php echo " min='$min'>";?>
								</div>
								<input class='btn btn-lg btn-secondary ' type='submit' value='Create New Bid' name='submit'> &nbsp; &nbsp;
								<input class='btn btn-lg btn-secondary ' type='submit' value='Cancel' name='submit'>
							</form>
					</div>
				</section>
				</body>
			</html>
<?php

	}
	catch(PDOException $ex)
	{
		echo "Error occured !";
		die($ex->getMessage());
	}
?>
