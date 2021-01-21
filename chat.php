<?php
session_start();
require('header.php');
$sid = $_SESSION['userId'];
$rid = $_GET['rid'];
	  try
	     {
		        require('project_connection.php');
		        $sql1 = "select * from auctions where AUCTION_ID =". $_GET['id'];
		        $sql2 = "select * from messages where AUCTION_ID =". $_GET['id']." order by MESSAGE_TIME ASC";
						$sql3 = "select USERNAME, PROFILE_PIC from users where USER_ID =".$rid;
						$sql4 = "select USERNAME, PROFILE_PIC from users where USER_ID =".$sid;
        		$rs1 = $db->query($sql1);
        		$rs2 = $db->query($sql2);
						$rs3 = $db->query($sql3);
						$rs4 = $db->query($sql4);
    ?>
        		<html>
        		<head>
        				<title> Chat </title>
								<style>
									.dp {
										border-radius: 50%;
									}
									.table
									{
										border: 150px solid #3687f4;
										border-bottom: 10px solid #3687f4;
										border-top: 10px solid #3687f4;
									}
									tr{
										border: 25px solid #3687f4;
									}
									.sender{
										background-color: white;
									}
									.receiver{
										background-color: #050505;
										color: white;
									}
									.sender:hover, .receiver:hover{
										color: #3687f4;
									}
									.message-send{
										border-left: 150px solid #3687f4;
										border-right: 150px solid #3687f4;
									}
									#message-box{
										font-weight: 900;
										font-size: 30px;
									}
								</style>
        		</head>
        		<body class='bg-primary'>
							<header class="masthead bg-primary text-white text-center px-md-2">
		              <div class="container d-flex align-items-center flex-column">
		                  <!-- Masthead Heading-->
		                  <h1 class="masthead-heading">Chat</h1>
		                  <!-- Icon Divider-->
		                  <div class="divider-custom divider-light">
		                      <div class="divider-custom-line"></div>
		                      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
		                      <div class="divider-custom-line"></div>
		                  </div>
		              </div>
		          </header>
							<section>
								<div>
        				<table class='table'>
    <?php
				$sname = "";
				$rname = "";
				$spic = "";
				$rpic = "";

						if($row = $rs3->fetch())
						{
							$rname = $row[0];
							$rpic = $row[1];
						}

						if($row = $rs4->fetch())
						{
							$sname = $row[0];
							$spic = $row[1];
						}

						while($row = $rs2->fetch())
						{
								$t = strtotime($row['MESSAGE_TIME']);
								$color = '';
								 if($row['USER_ID'] == $sid)
								 		{
											echo "<tr class='sender'>";
											echo "<td><img class='dp' src='uploadedfiles/".$spic."' height=75px width=75px/></td>";
											echo "<td><h3>  $sname: </h3></td>";

										}
									else
										{
											echo "<tr class='receiver'>";
											echo "<td><img class='dp' src='uploadedfiles/".$rpic."' height=75px width=75px/></td>";
											echo "<td><h3>  $rname: </h3></td>";

										}


									echo "<td><h2>".$row['MESSAGE']."</h2></td>";
									echo "<td><h5>".date("g:i A, F j, Y", $t)."</h5></td>";
								echo "</tr>";
						}
        ?>
		 </table>
			 </div>
			</section>
			<section>
				<div class='message-send'>
						<form class='font-weight-bold' method="post" action='chatupdation.php'>
						 <textarea class="form-control" id='message-box' name="chat1" placeholder='Send your message.'></textarea></h5> <br/>
						 <input hidden name='id'<?php echo " value='".$_GET["id"]."'/>";?>
						 <input hidden name='rid'<?php echo " value='".$rid."'/>";?>
						 <input class='btn btn-lg btn-secondary btn-block' type="submit" name="send" value="Send"/>
					 </form>
				 </div>
			 </section>
        				<?php
									$db =null;
        				?>
        				<br/> <br/> <br/>
        			</body>
        		</html>
        <?php
	}
	catch(PDOException $e)
	{
		die("Error Message".$e->getMessage());
	}

?>
