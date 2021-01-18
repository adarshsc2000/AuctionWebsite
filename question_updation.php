<?php
 extract($_POST);
 session_start();

 try
 {
   require('project_connection.php');
  if(isset($submit1))
  {
    $stmt = $db->prepare("update questions set ANSWER = ? where QUESTION_ID =".$qid);
    $stmt->execute(array($answer));
  }
  else if(isset($submit2))
   {
         $stmt = $db->prepare("insert into questions (AUCTION_ID, QUESTION) values (?, ?);");
         $stmt->execute(array($_SESSION['auction_id'], $question));
   }
     $db =null;
     header('Location: view.php');
 }
 catch(PDOException $e)
 {
   die("Error Message".$e->getMessage());
 }
 ?>
 ?>
