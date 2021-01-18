<?php
 extract($_POST);
 session_start();

 try
 {
   require('project_connection.php');
  if(isset($send_to_winner))
  {
    $stmt = $db->prepare("insert into messages(AUCTION_ID,MESSAGE) values(?,?);");
    $stmt->execute(array($_SESSION['auction_id'],$chat1));
  }
  else if(isset($send_to_owner))
   {
     $stmt = $db->prepare("insert into messages(AUCTION_ID,MESSAGE) values(?,?);");
     $stmt->execute(array($_SESSION['auction_id'],$chat2));
   }
     $db =null;
     //header('Location: view.php');
 }
 catch(PDOException $e)
 {
   die("Error Message".$e->getMessage());
 }
 try
 {
   $current = Date('y-m-d h:i:s');
   require('project_connection.php');
   if(isset($send))
  {
    $sql = "insert into messages(AUCTION_ID, MESSAGE, USER_ID, time) values(?,?,?,?);";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($_SESSION['auction_id'],$chat1, $_SESSION['userId'], $current));
  }
    unset($send);
     $db =null;
     header("Location: messages.php");
 }
 catch(PDOException $e)
 {
   die("Error Message".$e->getMessage());
 }
 ?>
