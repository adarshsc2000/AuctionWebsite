<html>
<head>
  <script src="reg_loginformvalidation.js" > </script>
</head>

<body style='background:#8ee041;'>

 <div style="margin-top:50px; margin-left:auto; margin-right:auto; width:700px; border: 2px solid black; padding:5px;">
 <noscript><h1><b>Please enable JavaScript or use another browser for better user experience</b></h1></noscript>

  <h2><u>login form</u></h2>
  <!--login form-->
  <form onSubmit="return checkLoginInputs();" method='post' action='reg_login.php'>
    <b>username</b> (5-20)
    <input type='text' name='username' onkeyup="checkUN(this.value,'login_username_msg')" size='20' required><span id='login_username_msg'></span><br>

    <b>Password</b> ( between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter)
    <input type='password' name='password' onkeyup="checkPWD(this.value,'login_pwd_msg')" size='20' required><span id='login_pwd_msg'></span><br>

    <input type='hidden' name='JSEnabled' value='false'>
    <input type='submit' name='login_user' value='login'>

  </form>

 </div>
<?php

$error=null;
extract($_GET);
if ($error==1) {
  echo "<script> alert('Need to log in before acessing the page!'); </script>";
}
elseif ($error==2) {
  echo "<script> alert('Please enter valid inputs, perhaps turn on client side scripting'); </script>";
}
elseif ($error==3) {
  echo "<script> alert('Invalid credentials!'); </script>";
}
elseif ($error==4) {
  echo "<script> alert('Database error :('); </script>";
}

?>
</body>
</html>
