<?php
	// Assuming there is a php file where the users rating is fetched
	session_start();
	if(!isset($_SESSION['user_id']) && !isset($_SESSION['auction_id']))
		die("Please login again!!!");
	extract($_POST);

	try
	{
		require('project_connection.php');
		$sql1 = "select * from auctions where auciton_id = ".$_SESSION['auction_id'];
		$sql2 = "select * from users where user_id = ".$_SESSION['user_id'];
		$stmt1 = $db->query($sql1);
		$stmt2 = $db->query($sql2);

		if($row1 = $stmt1->fetch() && $row2 = $stmt2->fetch())
		{
			$owner = $row1['owner_id'];
			$winner = $row1['winner_id'];

			if ($owner = $_SESSION["user_id"])
			{
				$r_sum = $rating + $row2["buyer_rating_sum"];
				$r_count = $row2["buyer_rating_count"] + 1;
				$sql = "update users set buyer_rating_sum = $r_sum , buyer_rating_count = $r_count where user_id = $_SESSION['user_id']";
			}
			else if ($winner = $_SESSION["user_id"])
			{
				$r_sum = $rating + $row2["seller_rating_sum"];
				$r_count = $row2["seller_rating_count"] + 1;
				$sql = "update users set seller_rating_sum = $r_sum , seller_rating_count = $r_count where user_id = $_SESSION['user_id']";
			}
			$stmt = $db->exec($sql);
		}
		$db = null;
		header("Locaton: ") // the original file
	}
	catch(PDOException $e)
	{
		die("Error Message".$e->getMessage());
	}
?>
