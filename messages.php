<?php
require('header.php');
session_start();
$sid = $_SESSION['userId'];
try {
        require('project_connection.php');
        $sql="SELECT * FROM auctions WHERE (OWNER_ID = $sid OR WINNER_ID = $sid) AND STATUS is not null";
        $sql1="SELECT USERNAME FROM users WHERE USER_ID =?";
        $msg1 = $db->prepare($sql1);
        $rs=$db->query($sql);
        ?>
        <html>
        <head>
        <body>
          <header class="masthead bg-primary text-white text-center px-md-2">
              <div class="container d-flex align-items-center flex-column">
                  <!-- Masthead Heading-->
                  <h1 class="masthead-heading">Messages</h1>
                  <!-- Icon Divider-->
                  <div class="divider-custom divider-light">
                      <div class="divider-custom-line"></div>
                      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                      <div class="divider-custom-line"></div>
                  </div>
              </div>
          </header>
          <div class='container'>
        <table class='table table-striped table-primary'>
          <?php
          while($row = $rs->fetch())
          {
              if($sid == $row['WINNER_ID'])
                $person_id = $row['OWNER_ID'];
              else
                $person_id = $row['WINNER_ID'];

                echo "<tr>";
                $msg1->execute(array($person_id));
                if($username = $msg1->fetch())
                  echo "<td><h2>".$username[0].": ".$row["AUCTION_NAME"]."</h2></td>";  // name is the first element so [0]
                echo "<td><a href='chat.php?id=". $row['AUCTION_ID']."&rid=".$person_id."'> <img src='images/message.png' width='50px' height='50px' > </a></td>";
                echo "</tr>";

            echo "<br>";
          }
          ?>
          </table>
        </div>
          </body>
          </html>
        <?php

$db =null;   //NO SPACE between = and null because it gives error sometimes
}
catch (PDOException $e) { //$e is the error object
  die("Error Message ".$e->getMessage());
}
