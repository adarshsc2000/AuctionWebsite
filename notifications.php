<?php require('header_special.php');
session_start();
$sid=$_SESSION['userId'];?>
<html>

<head>
<style>

    table,tr,td{
      border:1px solid black ;
      border-collapse: collapse;
      width:900px;
      margin-left:auto;
      margin-right:auto;
      text-align:center;
      padding:10px 3px;
    }

    .txt-center {
      text-align: center;
    }
    .hide {
      display: none;
    }

    .clear {
      float: none;
      clear: both;
    }

    .rating {
        width: 90px;
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
        position: relative;
    }

    .rating > label {
        float: right;
        display: inline;
        padding: 0;
        margin: 0;
        position: relative;
        width: 1.1em;
        cursor: pointer;
        color: #000;
    }

    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input.radio-btn:checked ~ label {
        color: transparent;
    }

    .rating > label:hover:before,
    .rating > label:hover ~ label:before,
    .rating > input.radio-btn:checked ~ label:before,
    .rating > input.radio-btn:checked ~ label:before {
        content: "\2605";
        position: absolute;
        left: 0;
        color: #FFD700;
    }


</style>
</head>
<body>
  <header class="masthead bg-primary text-white text-center px-md-2">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading">Notifications</h1>
          <!-- Icon Divider-->
          <div class="divider-custom divider-light">
              <div class="divider-custom-line"></div>
              <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
              <div class="divider-custom-line"></div>
          </div>
      </div>
  </header>
<?php

try{
  require('project_connection.php');
  $db->beginTransaction();
  //set all auctions with status = null to pending.if auction expired
  $sql="UPDATE auctions SET STATUS ='pending' WHERE (CURRENT_TIMESTAMP()> END_TIME_DATE) AND STATUS IS NULL";  //time ran out
  $update=$db->exec($sql);
  //fetch pending auctions related to user(owner or winner) and display
  $sql="SELECT * FROM auctions WHERE STATUS = 'pending' AND (OWNER_ID= '".$sid."' OR WINNER_ID = '".$sid."' )";
  $stmt=$db->query($sql);
  $result = $stmt->fetchAll();
  if (empty($result)) {
  echo "<div style='margin-top:200px; margin-right:300px; margin-left:300px; text-align:center;'>no notifications available!</div>";
  }
  else {
  echo "<br><br><br><br>";
  $i=0;
  foreach ($result as $row)
  {
      $i++;
      if ($sid==$row['OWNER_ID']) {
        if ($row['HIGHEST_BID']==null) {//noone bid
          $buyerstep='none';
        }
        elseif (strlen($row['WINNER_ADDR']) >0) { //winner completed buying process
          $buyerstep='completed';
          }
        elseif (strlen($row['WINNER_ADDR'])==null) {
          $buyerstep='incomplete';
    }
?>
<table class='table table-dark text-center table-striped'>
<tr>
<td>
<?php echo $row['AUCTION_NAME']; ?>
</td>
<td style='width:20%;'>
<?php
if ($buyerstep=='none')
  echo "no bids";
elseif ($buyerstep=="completed")
  echo "Buying Process Completed";
elseif ($buyerstep=="incomplete")
  echo "Buyng Process Incomplete";

?>
</td>
<form method='post' action='notification_process.php'>
<td style='width:15%; padding:0px 10px;'>
<div class="rating">
  <input id="star5<?php echo $i; ?>" name="star" type="radio" value="5" class="radio-btn hide" />
  <label for="star5<?php echo $i; ?>">☆</label>
  <input id="star4<?php echo $i; ?>" name="star" type="radio" value="4" class="radio-btn hide" />
  <label for="star4<?php echo $i; ?>">☆</label>
  <input id="star3<?php echo $i; ?>" name="star" type="radio" value="3" class="radio-btn hide" />
  <label for="star3<?php echo $i; ?>">☆</label>
  <input id="star2<?php echo $i; ?>" name="star" type="radio" value="2" class="radio-btn hide" />
  <label for="star2<?php echo $i; ?>">☆</label>
  <input id="star1<?php echo $i; ?>" name="star" type="radio" value="1" class="radio-btn hide" />
  <label for="star1<?php echo $i; ?>">☆</label>
  <div class="clear"></div>
</div>
</td>
<td style='width:20%;'>
<select name="newstatus" required>
<option value='success'>Mark as success</option>
<option value='fail'>Mark as failed</option>
<option value='republish'>Republish</option>
</select>
</td>
<td style='width:15%;'>
<input type='submit' name='Auc_id'>
<input type='hidden' name='Auc_id' value='<?php echo $row['AUCTION_ID']; ?>'>
</td>
</form>
</tr>
</table>
<?php
}//if user is seller

elseif ($sid==$row['WINNER_ID']) { //if user is winner
$sql2="SELECT * FROM addresses WHERE USER_ID=".$sid;
$addrStmnt=$db->query($sql2);
$addrResult=$addrStmnt->fetchAll();
echo "<table>";
echo "<tr>";
echo "<form method='post' action='notification_process.php'>";
echo "<td>".$row['AUCTION_NAME']."</td>";
echo "<td style='width:60%;'>";
echo "<select name='winnerAddr' required>";

foreach ($addrResult as $addr) {
    if (strlen($addr['ADDRESS'])>0)
        echo "<option value='".$addr['ADDRESS']."'>".$addr['ADDRESS']."</option>";
}
?>
</select>
</td>
<td style='width:15%;'>
<input type='submit' name='Submit'>
<input type='hidden' name='Auc_id' value='<?php echo $row['AUCTION_ID']; ?>'>
</td>
</form>
</tr>
</table>

<?php

}
    }//foreach end
  }//else when notifs avalable
  $db->commit();
}//try end
 catch(PDOException $e){
  $db->rollBack();
  echo "error message:".$e->getMessage();

}

?>

</table>
</body>
</html>
