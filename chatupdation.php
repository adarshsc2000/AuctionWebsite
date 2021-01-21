<?php
 date_default_timezone_set('Asia/Bahrain');
 extract($_POST);
 session_start();
 try
 {
   $current = Date('y-m-d H:i:s');
   require('project_connection.php');
   if(isset($send))
  {
    $sql = "insert into messages(AUCTION_ID, MESSAGE, USER_ID, MESSAGE_TIME) values(?,?,?,?);";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($id,$chat1, $_SESSION['userId'], $current));
  }
    unset($send);
     $db =null;
     header("Location: chat.php?id=".$id."&rid=".$rid."#message-box");
 }
 catch(PDOException $e)
 {
   die("Error Message".$e->getMessage());
 }
 ?>
