<?php require('header.php') ;
session_start();
if (!isset($_SESSION['userId']))
  header('location: reg_loginform.php?error=1');
?>
<html>
<head>
<title>
AUCTIONS.COM
</title>
<style>
h1 {text-align: center;}
h2 {text-align: center;}
          body {
  background-image: url('https://alicewalkersgarden.com/wp-content/uploads/Broadway-Grass2.jpg');
}
</style>
</head>

<body>
<br><br><br><br><br>
<h1> Hii!</h1>

<h1> WELCOME TO AUCTIONS.COM </h1>


<h1> BY: SHAIKH TAHMIDUR RAHMAN</h1>
<h1>  ADARSH SHINJU CHANDRAN</h1>
<h1>  ASHRAF HARIS</h1>
<h1>  ALAWI HASIB</h1>
<h1>  REEMA SHAIKH</h1>
<style>
</style>

</body>
<!--test line-->
</html>
