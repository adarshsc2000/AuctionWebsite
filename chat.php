<?php
session_start();
	  try
	     {
		        require('project_connection.php');
		        $sql1 = "select * from auctions where AUCTION_ID =". $_GET['id'];
		        $sql2 = "select * from messages where AUCTION_ID =". $_GET['id'];
        		$rs1 = $db->query($sql1);
        		$rs2 = $db->query($sql2);
    ?>
        		<html>
        		<head>
        				<title> Chat </title>
        		</head>
        		<body>
        				<h3 align ='center'> Welcome </h3>
        				<table>
    <?php
            					if($row1 = $rs1->fetch())
            					{
                        $owner = $row1['OWNER_ID'];
                        $winner = $row1['WINNER_ID'];
                      }

/**************************************** owner part message ***********************************************/

														 if ($owner == $_SESSION['userId'])
			             					 {
                              echo "<tr>";
                        ?>
																<form class='font-weight-bold' method="post" action='chatupdation.php'>
																 <textarea class="form-control"  name="chat1"></textarea> <br/> <br/>
																 <input class='btn btn-lg btn-secondary' type="submit" name="send_to_winner" value="send"/>
															 </form>
														 </tr>
										<?php
							              	} // closing of main if of owner part
//*****************************************************************************************************************************//

//********************************************* Winner part message ***********************************************************
        					if ($winner = $_SESSION['userId'])
        					{
                             echo "<tr>";
										?>
																<form class='font-weight-bold' method="post" action='chatupdation.php'>
																 <textarea class="form-control"  name="chat2"></textarea> <br/> <br/>
																 <input class='btn btn-lg btn-secondary' type="submit" name="send_to_owner"  value="send"/>
															 </form>
														    </tr>
        				<?php
							     }   //closing of main if of winner part
// **************************************************************************************************************************//
        				?>
        				</table>
        				<br/> <br/> <br/>
        			</body>
        		</html>
        <?php
        		$db =null;
	}
	catch(PDOException $e)
	{
		die("Error Message".$e->getMessage());
	}

?>
<?php
require('header.php');
$sid = $_SESSION['userId'];
$rid = $_GET['rid'];
	  try
	     {
		        require('project_connection.php');
		        $sql1 = "select * from auctions where AUCTION_ID =". $_GET['id'];
		        $sql2 = "select * from messages where AUCTION_ID =". $_GET['id'];
						$sql3 = "select USERNAME from users where USER_ID =".$rid;
						$sql4 = "select USERNAME from users where USER_ID =".$sid;
        		$rs1 = $db->query($sql1);
        		$rs2 = $db->query($sql2);
						$rs3 = $db->query($sql3);
						$rs4 = $db->query($sql4);
    ?>
        		<html>
        		<head>
        				<title> Chat </title>
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
							<section class='text-white'>
								<div class='container'>
        				<table class='table table-striped table-primary'>
    <?php

/**************************************** owner part message ***********************************************/
				$sname = " ";
				$rname = " ";
						if($row = $rs3->fetch())
							$rname = $row[0];

						if($row = $rs4->fetch())
								$sname = $row[0];
						while($row = $rs2->fetch())
						{		 echo "<tr>";
								 if($row['USER_ID'] == $sid)
								 		echo "<td><h3>  $sname: </h3></td>";
									else
										echo "<td><h3>  $rname: </h3></td>";

									echo "<td><h2>".$row['MESSAGE']."</h2></td>";
									echo "<td><h5>".$row['time']."</h5></td>";
								echo "</tr>";
						}
        ?>
		 </table>
			 </div>
			</section>
			<section>
				<div class='container'>
						<form class='font-weight-bold' method="post" action='chatupdation.php'>
						 <textarea class="form-control"  name="chat1" placeholder='Send your message.'></textarea> <br/>
						 <input class='btn btn-lg btn-secondary btn-block' type="submit" name="send" value="send"/>
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
