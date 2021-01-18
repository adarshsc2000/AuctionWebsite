<?php
unset($_SESSION['user_id']);
unset($_SESSION['auction_id']);
session_destroy();
header("location:reg_loginform.php");
?>