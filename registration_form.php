<?php
  require("header_newuser.php");
?>
<html>
<head>
  <script src="reg_loginformvalidation.js" > </script>
  <style>
  #register {
      margin-top:135px;
      margin-left:auto;
      margin-right:auto;
      margin-bottom:70px;
      width:700px;
      padding:80px;
      padding-bottom: 25px;
      padding-top: 40px;
      border-radius: 5%;
      border: 5px solid black;
  }
  .register {
    font-size: 50px;
  }
  .form-control {
    font-size: 20px;
    font-weight: bolder;
  }
  .form-control::placeholder {
    font-weight: 50;
  }
  </style>
</head>

<body class='bg-primary'>
 <div id='register' class='bg-secondary text-white container align-items-center'>
   <noscript><h1><b>Please enable JavaScript or use another browser for better user experience</b></h1></noscript>
 <!--registration-->
 <div class="container d-flex align-items-center flex-column">
     <!-- Masthead Heading-->
     <h1 class="masthead-heading register">Register</h1>
     <!-- Icon Divider-->
     <div class="divider-custom divider-light">
         <div class="divider-custom-line"></div>
         <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
         <div class="divider-custom-line"></div>
     </div>
 </div>
 <form onSubmit="return checkRegistrationInputs();" method='post' action='reg_login.php'>
    <label><h3>Name:</h3></label>
    <input class='form-control' type='text' name='name' placeholder="maximum 50 characters" onkeyup="checkFN(this.value)" size='50' required><span id='name_msg'></span><br>

    <label><h3>Email:</h3></label>
    <input class='form-control' type='text' name='mail' placeholder="abc@example.com (30 characters max)" onkeyup="checkMAIL(this.value)" size='30' required><span id='mail_msg'></span><br>

    <label><h3>Username:</h3></label>
    <input class='form-control' type='text' name='username' placeholder="5-20 characters" onkeyup="checkUN(this.value,'reg_username_msg')" size='20' required><span id='reg_username_msg'></span><br>

    <label><h3>Password:</h3></label>
    <input class='form-control' type='password' name='password' placeholder="6-20 characters (big and small letters, and numbers)" onkeyup="checkPWD(this.value,'reg_pwd_msg')" size='20' required><span id='reg_pwd_msg'></span><br>

    <label><h3>Confirm Password:</h3></label>
    <input class='form-control' type='password' name='cnfm_password' placeholder="6-20 characters" onkeyup="confirmPWD(this.value)" size='20' required><span id='cfmpwd_msg'></span><br>
    <label><h3>Country:</h3></label>
    <select class='form-control' name="country_code" onchange="checkMBL(document.forms[1].mobile.value)" required >
      <option value="+973" selected>Bahrain</option>
      <option value="+966">Saudi Arabia</option>
      <option value="+971">United Arab Emirates</option>
    </select><br>

    <label><h3>Contact No:</h3></label>
    <input class='form-control' type='text' name='mobile' placeholder="8 digits for Bahrain, 8-10 others" onkeyup="checkMBL(this.value)" size='10' required><span id='mobile_msg'></span><br>
    <label><h3>Address:</h3></label>
    <input class='form-control' type='text' name='address' placeholder="Flat 1 Bldg 100 Road 200 Block 300, Manama, Bahrain" onkeyup="checkAddr(this.value)" size='50' required><span id='addr_msg'></span><br>

    <input type='hidden' name='JSEnabled' value='false'>
    <input class='btn btn-lg btn-primary' type='submit' name='register_user' value='Register'>
  </form>
</br>
  <p>Already have an account? <b><a href="login_form.php">Sign in here.</a></b> </p>
 </div>
<?php

$error=null;
extract($_GET);
if ($error==2) {
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
