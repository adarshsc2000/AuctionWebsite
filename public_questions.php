<?php

	extract($_POST);
	try
	{
		require('project_connection.php');
		$sql1 = "select * from auctions where AUCTION_ID = ".$_SESSION['auction_id'];
		$sql2 = "select * from questions where AUCTION_ID  = ".$_SESSION['auction_id'];
		$stmt1 = $db->query($sql1);
		$stmt2 = $db->query($sql2);
?>
				<table class='table table-borderless text-white'>

				<?php
				 $count = 1;
					if($row1 = $stmt1->fetch())
						$owner = $row1['OWNER_ID'];

					while($row = $stmt2->fetch())
					{
						  	echo "<tr>";
							  echo "<td><h3> Question $count :</h3></td>";
								echo "<td><h3>".$row["QUESTION"]."</h3></td>";
							  $count += 1;
						    echo "</tr>";
						    echo "<tr>";
								echo "<td><h3> Answer : </h3></td>";
						   if($row["ANSWER"] == null)
						   {
							    if ($owner == $_SESSION['userId'])
							    {
												?>
										   <td>
												 <form method="post" class="font-weight-bold" action='question_updation.php'>
											       <textarea class='form-control' rows="10" cols="100" name="answer"></textarea> <br/> <br/>
														 <input hidden name='qid' <?php echo " value='".$row['QUESTION_ID']."'/>";?>
											       <input class='btn btn-lg btn-secondary' type="submit" name="submit1"/>
											    </form>
										  </td>
			        	<?php
							     }
								}
						else
							echo "<td><h3>".$row["ANSWER"]."</h3></td>";
						echo "</tr>";
					}
					if ($owner != $_SESSION['userId'])
					{
			?>
							<tr>
								<td>
									  <form class='font-weight-bold' method="post" action='question_updation.php'>
									    <label><h2>Ask a question:</h2></label>
									    <textarea class="form-control" rows="6" cols="100" name="question"></textarea> <br/> <br/>
									    <input class='btn btn-lg btn-secondary' type="submit" name="submit2"/>
									  </form>
								</td>
							</tr>
		<?php	}	?>
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
