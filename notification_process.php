<html>
<?php
require('header.php');
extract($_POST);
session_start();
$sid=$_SESSION['userId'];
require("project_connection.php");
try{
  $db->beginTransaction();
  if (isset($newstatus)) {//seller clicked submit button
    if ($newstatus=="success") {
      $sql="UPDATE auctions SET STATUS='success' WHERE AUCTION_ID=".$Auc_id;
      $update=$db->exec($sql);
      //extracting buyer_id frm auction id
      $sql="SELECT WINNER_ID FROM auctions WHERE AUCTION_ID=".$Auc_id;
      $stmnt=$db->query($sql);
      $row=$stmnt->fetch();
      $buyer_id=$row['WINNER_ID'];
      if (is_numeric($buyer_id)) {
        $star=(int)$star;
        //updating buyer's rating
        $sql="UPDATE users SET BUYER_RATING_SUM=BUYER_RATING_SUM+".$star.",  BUYER_RATING_COUNT=BUYER_RATING_COUNT+1 WHERE USER_ID=".$buyer_id;
        $result=$db->exec($sql);

      }
      header("Location: browse.php");
    }
    elseif ($newstatus=="fail") {
      $sql="UPDATE auctions SET STATUS='failed' WHERE AUCTION_ID=".$Auc_id;
      $update=$db->exec($sql);
      //extracting buyer_id frm auction id
      $sql="SELECT WINNER_ID FROM auctions WHERE AUCTION_ID=".$Auc_id;
      $stmnt=$db->query($sql);
      $row=$stmnt->fetch();
      $buyer_id=$row['WINNER_ID'];
      if (is_numeric($buyer_id)) {
      $star=(int)$star;
      //updating seller's rating
      $sql="UPDATE users SET BUYER_RATING_SUM=BUYER_RATING_SUM+".$star.",  BUYER_RATING_COUNT=BUYER_RATING_COUNT+1 WHERE USER_ID=".$buyer_id;
      $result=$db->exec($sql);
      }
      header("Location: browse.php");

    }
    elseif ($newstatus=="republish") {
      //mark auction as failed, create a duplicate auction
      $sql="UPDATE auctions SET STATUS='failed' WHERE AUCTION_ID=".$Auc_id;
      $update=$db->exec($sql);
      //extracting buyer_id frm auction id
      $sql="SELECT WINNER_ID FROM auctions WHERE AUCTION_ID=".$Auc_id;
      $stmnt=$db->query($sql);
      $row=$stmnt->fetch();
      $buyer_id=$row['WINNER_ID'];
      if (is_numeric($buyer_id)) {
      $star=(int)$star;
      //updating seller's rating
      $sql="UPDATE users SET BUYER_RATING_SUM=BUYER_RATING_SUM+".$star.",  BUYER_RATING_COUNT=BUYER_RATING_COUNT+1 WHERE USER_ID=".$buyer_id;
      $result=$db->exec($sql);
      }
      $sql="SELECT * FROM auctions where AUCTION_ID=".$Auc_id;
      $stmnt=$db->query($sql);
      $row=$stmnt->fetch();

?>
  <body class='bg-primary'>
<header class="masthead bg-primary text-white text-center px-md-2">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="masthead-heading">Republish Auction</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
    </div>
</header>
<section>
<div class='container align-items-center font-weight-bold'>
<form method="POST" enctype="multipart/form-data" >
<table class='table table-borderless'>
  <div class="form-group">
     <tr>
        <label class='col-form-label-lg'><h3>Name of the product:</h3></label>
        <input class="form-control" type = 'text'  name = 'nop' value='<?php echo $row['AUCTION_NAME']; ?>' 'required'>
    </tr>
  </div>

  <div class="form-group">
     <tr>
        <label class='col-form-label-lg'><h3>Description</h3></label>
        <textarea  class="form-control" name="descr" required><?php echo $row['DESCRIPTION']; ?></textarea>
     </tr>
  </div>

  <div class="form-group">
     <tr>
       <label class='col-form-label-lg'><h3>Start date:</h3></label>
       <input class="form-control" type="date" name="start_date" <?php echo "min =".date('Y-m-d') ?> required />"
     </tr>
    </div>


  <div class="form-group">
     <tr>
         <label class='col-form-label-lg'><h3>Start Time:</h3></label>
         <input class="form-control" type="time" name="stime" required>
     </tr>
   </div>

  <div class="form-group">
   <tr>
      <label class='col-form-label-lg'><h3>End Date:</h3></label>>
      <input class="form-control" type="date" name="end_date" <?php echo " min =".date('Y-m-d')." required />";?>
   </tr>
 </div>

  <div class="form-group">
     <tr>
         <label class='col-form-label-lg'><h3>End Time:</h3></label>
         <input class="form-control" type="time" name="etime" required>
     </tr>
  </div>


  <div class="form-group">
    <tr>
  	<label class='col-form-label-lg'><h3> Enter start price: </h3></label>
    <input class="form-control" type="number" name="sprice" step="0.001" required>
  	</tr>
  </div>

  <input type='hidden' name='oldAuc_id' value=<?php echo $Auc_id; ?>>
</table>

<div class="form-group">
  <input class='btn btn-secondary btn-lg btn-block' type ='submit'  name ='recreate' value = 'Create'/>
</div>
</form>
</div>
</section>
<br/> <br/> <br/>
</body>

<?php
    }
  }
    elseif (isset($recreate)) { //repiblish form submitted
            $start = $start_date." ".$stime.":00";
            $end = $end_date." ".$etime.":00";
            $sql="insert into auctions (AUCTION_NAME, OWNER_ID, DESCRIPTION,START_TIME_DATE,END_TIME_DATE,START_PRICE) values (:AUCTION_NAME, :OWNER_ID, :DESCRIPTION,:START_TIME_DATE,:END_TIME_DATE,:START_PRICE)";
                $preparestatement=$db->prepare($sql);
                $preparestatement->execute(['AUCTION_NAME'=>$nop,'OWNER_ID'=>$_SESSION['userId'], 'DESCRIPTION'=>$descr,'START_TIME_DATE'=>$start,'END_TIME_DATE'=>$end,'START_PRICE'=>$sprice]);

             $insertId = $db->lastInsertId();
            //retreiving old pics and making a copy for new auction
             $sql="SELECT * FROM pictures WHERE AUCTION_ID=".$oldAuc_id;
             $oldPics=$db->query($sql);

             foreach ($oldPics as $row) {
               $sql="INSERT INTO pictures (AUCTION_ID,PICTURE) VALUES(".$insertId.", ".$oldPics['PICTURE'].")";
               $rs=$db->exec($sql);
             }

      $_SESSION['auction_id']=$insertId;
      header("Location: view.php");
    }
  elseif (isset($winnerAddr)) { //winner completed buying process
    $sql="UPDATE auctions SET WINNER_ADDR='".$winnerAddr."' WHERE AUCTION_ID=".$Auc_id;
    $update=$db->exec($sql);
    //extracting seller_id frm auction id
    $sql="SELECT OWNER_ID FROM auctions WHERE AUCTION_ID=".$Auc_id;
    $stmnt=$db->query($sql);
    $row=$stmnt->fetch();
    $seller_id=$row['OWNER_ID'];
    if (is_numeric($seller_id)) {
    $star=(int)$star;
    //updating seller's rating
    $sql="UPDATE users SET SELLER_RATING_SUM=SELLER_RATING_SUM+".$star.",  SELLER_RATING_COUNT=SELLER_RATING_COUNT+1 WHERE USER_ID=".$buyer_id;
    $result=$db->exec($sql);
    }
  }

  $db->commit();
}//end of try
catch(PDOException $e){
  $db->rollBack();
  echo "error message:".$e->getMessage();
  echo "<script>alert('Unexpected database error');</script>";
  //header("Location: index.php");
}

?>

</html>