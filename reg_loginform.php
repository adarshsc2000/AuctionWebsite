<html>
<head>
  <script> src="reg_loginformvalidation.js" </script>
</head>

<body style='background:#8ee041;'>

 <div style="margin-top:50px; margin-left:auto; margin-right:auto; width:700px; border: 2px solid black; padding:5px;">
 <!--registration-->
 <h2><u>Registration Form</u></h2>
 <form onSubmit="return checkRegistrationInputs();" method='post' action='reg_login.php'>
    <b>Name</b> (max 50 char):
    <input type='text' name='name' onkeyup="checkFN(this.value)" size='50' required><span id='name_msg'></span><br>

    <b>Email</b> (30 char max with valid email format):
    <input type='text' name='mail' onkeyup="checkMAIL(this.value)" size='30' required><span id='mail_msg'></span><br>

    <b>Username</b> (5-20)(first char letter/num rest chars letter/num/_):
    <input type='text' name='username' onkeyup="checkUN(this.value,'reg_username_msg')" size='20' required><span id='reg_username_msg'></span><br>

    <b>Password</b>( 6-20 chars least one numeric digit, one uppercase and one lowercase letter):
    <input type='password' name='password' onkeyup="checkPWD(this.value,'reg_pwd_msg')" size='20' required><span id='reg_pwd_msg'></span><br>

    <b>Confirm password</b>
    <input type='password' name='cnfm_password' onkeyup="confirmPWD(this.value)" size='20' required><span id='cfmpwd_msg'></span><br>
    <b>Country</b> (code)
    <select name="country_code" onchange="checkMBL(document.forms[0].mobile.value)" required >
      <option value="+973" selected>Bahrain</option>
      <option value="+966">Saudi Arabia</option>
      <option value="+971">United Arab Emirates</option>
    </select><br>

    <b>Contact num</b>(8 digits for bahrain,8-10 others):
    <input type='text' name='mobile' onkeyup="checkMBL(this.value)" size='10' required><span id='mobile_msg'></span><br>
    <b>Address</b>
    <input type='text' name='address' onkeyup="checkAddr(this.value)" size='50' required><span id='addr_msg'></span><br>

    <input type='hidden' name='JSEnabled' value='false'>
    <input type='submit' name='register_user' value='register'>
  </form>

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
  echo "<script> alert('Need to log in before acessing ther pages!'); </script>";
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
