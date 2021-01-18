<?php
require('header.php');

function timer($date, $id){
    date_default_timezone_set("Asia/Bahrain"); //changing time to london(uk) time.
    $endtime = strtotime($date); //converting the string from database into time form
    $idtemp = $id; //Returns the current time
    ?>
    <script>
    (function(){
        //convert server time to milliseconds
        var server_current = <?php echo time(); ?> * 1000,
            server_end_time = <?php echo $endtime; ?> * 1000,
            client_current_time = new Date().getTime(),
            finish_time = server_end_time - server_current + client_current_time, //server end time - server current time + client current time
            timer,
            uniqueID = '<?php echo json_encode($idtemp); ?>';

        function countdown(){
            var now = new Date();
            var left = finish_time - now;

            //Following code convert the remaining milliseconds into hours, minutes and days.
            //milliseconds conversion
            //1000-second 60,000-minute
            //3,600,000-hour  86,400,400-hour
            var day = Math.floor( (left/86000000));
            var hour = Math.floor( (left % 86000000 ) / 3600000 );
            var minute = Math.floor( (left % 3600000) / 60000 );
            var second = Math.floor( (left % 60000) / 1000 );

            document.getElementById(uniqueID).innerHTML = day+"d "+hour+"h "+minute+"m "+second+"s";
        }
        timer = setInterval(countdown, 1000);
    })();
    </script>
    <?php
  }
try
{
   require("project_connection.php");
   $sql = "select * from auctions where END_TIME_DATE>CURRENT_TIMESTAMP() order by END_TIME_DATE" ;
   $rs=$db->query($sql);
   $stmtpic = $db->prepare("select picture from pictures where auction_id = ? limit 1");
   //$x = $rs->rowcount();

}
catch(PDOException $e){
	die("Error Message".$e->getMessage());
}
?>
<header class="masthead bg-primary text-white text-center px-md-3">
  <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="masthead-heading">Available Aucitons</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
      </div>

    </div>
</header>
<br/><br/>
<section class="text-center">
  <div class="container align-items-center">
    <!--<table class="table table-borderless"> -->
    <table class="table table-borderless">
        <div class='row'>
        <?php
            foreach($rs as $row)
          	{
              echo "<div class='col-6 col-md-4'>";
              	  $stmtpic->execute(array($row["AUCTION_ID"]));
              	  if ($pic = $stmtpic->fetch())
                     echo "<img src='".$pic[0]."' height='250px' width='250px'/><br />";
                  else
                     echo "<img src='images/default.jpg' height='250px' width='250px'/><br /><br />";

                   echo "<h3 class='text-bold'>".$row["AUCTION_NAME"]."</h3><br />";
                   $current = date("Y-m-d H:i:s");
                   if ($row["START_TIME_DATE"] > $current)
                      echo "Starts on ".$row["START_TIME_DATE"];
                   else {

                     ###############################################
                          echo "<h5 class='text-bold'> Time Remaining </h4>";
                         $date = $row["END_TIME_DATE"];
                         ?>
                         <script> var uniID = '_' + Math.random().toString(36).substr(2, 9);</script>
                         <?php
                         //echo $uniID."= <script> uniID </script>";
                         //timer($date, $uniID);
                         //echo '<h3 id='.json_encode($uniID).' class="text-bold text-primary">loading...</h3><br />';
                     ################################################
                   }
                  echo "<h5> Ends on: &nbsp;&nbsp;".$row["END_TIME_DATE"]."</h5>";
                  echo "<h5>Starting Price: &nbsp;&nbsp; ".$row["START_PRICE"]."</h5>";
                  if($row["HIGHEST_BID"] == '')
                    echo "<h4 class='text-primary text-bolder'> No Bids Yet! </h4>";
                  else
                    echo "<h4 class='text-bold text-primary'> Highest Bid:".$row["HIGHEST_BID"]."</h4><br />";

                   echo "<form method='get' action='view.php'>";
                       echo "<input type='hidden' name='auction_id' value='".$row["AUCTION_ID"]."'/><br />";
                       echo "<input class='btn btn-secondary btn-lg btn-block' type='submit' name='view' value='View More Details'/> <br />";
                   echo "</form>";
               echo "</div>";
          	}
        ?>
      </div>
    </div>
  </table>
</section>
<br/> <br/> <br/>
</body>
</html>
