<?php
require('header.php');
session_start();
$sid = $_SESSION['userId'];
try {
        require('project_connection.php');
        $sql="SELECT * FROM auctions WHERE (OWNER_ID = $sid OR WINNER_ID = $sid) AND STATUS is not null";
        $sql1="SELECT USERNAME, PROFILE_PIC FROM users WHERE USER_ID =?";
        $msg1 = $db->prepare($sql1);
        $rs=$db->query($sql);
        ?>
        <html>
        <head>
          <style>
            .table
            {
              border: 20px solid white;
            }
            tr
            {
              border: 10px solid white;
            }
            .send
            {
              font-weight: 1000;
              border: 5px solid black;
              background-color: #050505;
              color: white;
            }
            .send:hover
            {
              background-color: #3687f4;
              color: #050505;;
            }
          </style>
        </head>
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
          <div>
         <table class='table table-striped bg-primary text-white'>
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
                  {
                    echo "<td><img src='uploadedfiles/".$username[1]."' width='100px' height='100px' ></td>";
                    echo "<td><h2>".$username[0].": "."</h2></td>";  // name is the first element so [0]
                  }
                echo "<td><h2>".$row["AUCTION_NAME"]."</h2></td>";
                echo "<td><h2>";
                  echo "<form method='get' action='chat.php'>";
                    echo "<input hidden name='id' value='".$row['AUCTION_ID']."'/>";
                    echo "<input hidden name='rid' value='".$person_id."'/>";
                    echo "<input class='btn btn-outline-secondary my-4 my-lg-3 btn-lg send' type='submit' value='MESSAGE'/>";
                  echo "</form>";
                echo "</h2></td>";
                echo "</tr>";

            echo "<br>";
          }
          ?>
        </table>
        </div>
          </br>
          </body>
          </html>
        <?php

$db =null;   //NO SPACE between = and null because it gives error sometimes
}
catch (PDOException $e) { //$e is the error object
  die("Error Message ".$e->getMessage());
}
