<?php
require("header.php");
session_start();
  extract($_POST);

    if(isset($create))
    {
        try
        {
            require("project_connection.php");
            $db->beginTransaction();
            $start = $start_date." ".$stime.":00";
            $end = $end_date." ".$etime.":00";
            $sql="insert into auctions (AUCTION_NAME, OWNER_ID, DESCRIPTION,START_TIME_DATE,END_TIME_DATE,START_PRICE) values (:AUCTION_NAME, :OWNER_ID, :DESCRIPTION,:START_TIME_DATE,:END_TIME_DATE,:START_PRICE)";
                $preparestatement=$db->prepare($sql);
                $preparestatement->execute(['AUCTION_NAME'=>$nop,'OWNER_ID'=>$_SESSION['userId'], 'DESCRIPTION'=>$descr,'START_TIME_DATE'=>$start,'END_TIME_DATE'=>$end,'START_PRICE'=>$sprice]);

             $insertId = $db->lastInsertId();

             $sql="insert into pictures(AUCTION_ID,PICTURE) values(:AUCTION_ID,:PICTURE)";
             $preparestatement=$db->prepare($sql);

             foreach($_FILES["imagefile"]["name"] as $key => $val)
             {

                 if ((($_FILES["imagefile"]["type"][$key] == "image/gif")
             		|| ($_FILES["imagefile"]["type"][$key] == "image/jpeg")
             		|| ($_FILES["imagefile"]["type"][$key] == "image/pjpeg"))
             		&& ($_FILES["imagefile"]["size"][$key] < 5000000))
             		{
                     if ($_FILES["imagefile"]["error"][$key] > 0)
               			   echo "Return Code: " . $_FILES["imagefile"]["error"][$key] . "<br />";

               			else
               			{
                 				$fdetails = explode(".",$_FILES["imagefile"]["name"][$key]);
                 				$fext= end($fdetails);

                 				$fn="img".time().uniqid(rand()).".$fext"; // to give name

                 				if (!move_uploaded_file($_FILES["imagefile"]["tmp_name"][$key], "uploadedfiles/$fn"))
                            die("Failed to store file");

                         $preparestatement->execute(['AUCTION_ID'=>$insertId,'PICTURE'=>'uploadedfiles/'.$fn]);
                      }
             		  }
                  else
                  {
                    echo"Please upload a correct image file";
                  }
              }
            $db->commit();
          }
         catch(PDOException $ex)
         {
            die("Error Message".$ex->getMessage());
            $db->rollback();
        }

      $_SESSION['auction_id']=$insertId;
      header("Location: view.php");
 }

?>
<body class='bg-primary'>
<header class="masthead bg-primary text-white text-center px-md-2">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="masthead-heading">Create Auction</h1>
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
        <input class="form-control" type = 'text'  name = 'nop' required/>
    </tr>
  </div>

  <div class="form-group">
     <tr>
        <label class='col-form-label-lg'><h3>Description</h3></label>
        <textarea  class="form-control" name="descr" required></textarea>
     </tr>
  </div>

  <div class="form-group">
     <tr>
       <label class='col-form-label-lg'><h3>Start date:</h3></label>
       <input class="form-control" type="date" name="start_date" <?php echo " min =".date('Y-m-d')." required />";?>
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

  <div class="form-group">
     <tr>
         <label class='col-form-label-lg'><h3>Insert picture(s) of the product:</h3></label>
         <input class="form-control-file font-weight-bold text-white" type="file" name="imagefile[]" multiple required/>
     </tr>
  </div>
</table>

<div class="form-group">
  <input class='btn btn-secondary btn-lg btn-block' type ='submit'  name ='create' value = 'Create'/>
</div>
</form>
</div>
</section>
<br/> <br/> <br/>
</body>
</html>
