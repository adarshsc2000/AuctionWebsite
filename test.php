<html>
<?php
//require('header.php');
echo "<br><br><br>";
session_start();
if (!isset($_SESSION['userId']))
  header('location:reg_loginform.php?error=1');
$sid=$_SESSION['userId'];
try{
  require('project_connection.php');
  $result= $db->prepare("SELECT * FROM users WHERE USER_ID= :id");
  $result->bindParam(':id' , $sid);
  $result->execute();
  $addrResult=$db->prepare("SELECT * FROM addresses WHERE USER_ID= :id");
  $addrResult->bindParam(':id' , $sid);
  $addrResult->execute();
  $userDetails= $result->fetch();
  $userAddrs=$addrResult->fetchAll();
  $username=$userDetails['USERNAME'];
  $password=$userDetails['PASSWORD'];
  $name=$userDetails['NAME'];
  $contact_num=$userDetails['CONTACT_NUM'];
  $email=$userDetails['EMAIL'];
  $country=$userDetails['COUNTRY'];
  $address=$userDetails['ADDRESS'];
  $profile_pic=$userDetails['PROFILE_PIC'];
  if ($userDetails['BUYER_RATING_COUNT']>0) {
    $buyer_rating=$userDetails['BUYER_RATING_SUM']/$userDetails['BUYER_RATING_COUNT'];
  }
  if ($userDetails['SELLER_RATING_COUNT']>0) {
    $seller_rating=$userDetails['SELLER_RATING_SUM']/$userDetails['SELLER_RATING_COUNT'];
  }
  $db =null;
  }
  catch(PDOException $e){
   echo "<script>alert('Error ".$e->getMessage()."\\nPlease refresh');</script>"; //paste in b/w ".$e->getMessage()."  to see errror

  }

?>
<head>
<link rel="stylesheet" href="css/profile.css">
  <script>
<?php
echo "username='".$username."'\n";
echo "password='".$password."'\n";
echo "name='".$name."'\n";
echo "contact_num='".$contact_num."'\n";
echo "email='".$email."'\n";
echo "country='".$country."'\n";
echo "address='".$address."'\n";
?>
MAX_FILE_SIZE=5000000;   //5MB
    var nameFlag=emailFlag=usernameFlag=passwordFlag=cnfmpasswordFlag=mobileFlag=addressFlag=fileUploadFlag=true; //true by default
    function checkFN(name1) { //check full name
      var nameExp =/^([a-z]{2,}\s)*[a-z]+$/i;
      if (name1.length == 0) {
        msg = "Enter name!";
        color = "red";
        nameFlag = false;
      }
      else if (!nameExp.test(name1)) {
        msg = "Invalid Name";
        color = "red";
        nameFlag = false;
      }
      else {
        msg = "Valid Name";
        color = "green";
        nameFlag = true;
      }
      document.getElementById('name_msg').style.color = color;
      document.getElementById('name_msg').innerHTML = msg;
    }

    function checkUN(uname) {  //check username
      var unameExp = /^[a-z0-9]\w{4,19}$/i;
      if (uname.length == 0) {
        msg = "Enter username!";
        color = "red";
        usernameFlag = false;
      }
      else if (!unameExp.test(uname)) {
        msg = "Invalid Username";
        color = "red";
        usernameFlag = false;
      }
      else {
        if (uname.toLowerCase()==username.toLowerCase()) {  //usernames cant be same eveb if they have different cases (upper/lower case)
          msg="";
          color="green";
        }
        else{
        msg = "Valid Username";
        color = "green";
        usernameFlag = true;
        ajaxexists(uname,"uname");
        }
      }
      document.getElementById('reg_username_msg').style.color = color;
      document.getElementById('reg_username_msg').innerHTML = msg;
    }

    function checkPWD(pwd) { //check password

      var pwdExp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
      if (pwd.length == 0) {
        msg = ""; //accepted to retain original values
        color = "red";
        passwordFlag = true;
      }
      else if (!pwdExp.test(pwd)) {
        msg = "Invalid password";
        color = "red";
        passwordFlag = false;
      }
      else {
        msg = "Valid password";
        color = "green";
        passwordFlag = true;
      }
      document.getElementById('reg_pwd_msg').style.color = color;
      document.getElementById('reg_pwd_msg').innerHTML = msg;
      confirmPWD(document.forms[0].cnfm_password.value);
    }

    function confirmPWD(cpassword) { //check 2nd password
      if ((cpassword.length == 0)&& (document.forms[0].password.value.length==0)) {
        msg = "";
        cnfmpasswordFlag = true;
      }
      else if (cpassword.length == 0) {
        msg = "";
        cnfmpasswordFlag = false;
      }
      else if (document.getElementById('reg_pwd_msg').innerHTML== 'Invalid password') {
        msg="enter valid password first";
        color="red";
        cnfmpasswordFlag=false;
      }
      else
      {
        var firstPwd = document.forms[0].password.value;

        if (firstPwd.length==0) {
          msg="";
          cnfmpasswordFlag=false;
          color="white"; //need to enter or gives not defined error
        }
        else if (cpassword!=firstPwd) {
          msg = "passwords don't match";
          color = "red";
          cnfmpasswordFlag = false;

        }
        else {
          msg = "they match";
          color = "green";
          cnfmpasswordFlag = true;
        }
      }
      document.getElementById('cfmpwd_msg').style.color = color;
      document.getElementById('cfmpwd_msg').innerHTML = msg;
    }

    function checkMBL(mobile) {  //check mobile num
      if (document.forms[0].country_code.value=='+973') {
        var numExp= /^(32|33|34|35|36|37|38|39)[0-9]{6}$/;
      }
      else if (document.forms[0].country_code.value=='+966') {
        var numExp= /^(54|56|57|58|59)[0-9]{6,8}$/;
      }
      else if(document.forms[0].country_code.value=='+971') {
        var numExp= /^(50|52|54|55|56|58)[0-9]{6,8}$/;
      }
      if (mobile.length == 0) {
        msg = "Need to enter a number!";
        color = "red";
        mobileFlag = false;
      }
      else if (!numExp.test(mobile)) {
        msg = "Invalid mobile number";
        color = "red";
        mobileFlag = false;
      }
      else {
        if (mobile==contact_num) {
          msg="";
          color="green";
        }
        else{
        msg = "Valid mobile number";
        color = "green";
        mobileFlag = true;
        ajaxexists(mobile,"mobile");
        }
      }
      document.getElementById('mobile_msg').style.color = color;
      document.getElementById('mobile_msg').innerHTML = msg;
    }

    function checkAddr(addr) { //check if address is a sentence
      var addrExp =/^(?=.*[a-z])([a-z0-9:,]{1,}\s?)*[a-z0-9]+$/i;
      if (addr.length == 0) {
        msg = "Need to add an address!";
        color = "red";
        addressFlag = false;
      }
      else if (!addrExp.test(addr)) {
        msg = "Invalid address";
        color = "red";
        addressFlag = false;
      }
      else {
        if (addr.toLowerCase()==address.toLowerCase()) {
          msg="";
          color="green";
        }
        else{
        msg = "Valid address";
        color = "green";
        addressFlag = true;
        }
      }
      document.getElementById('addr_msg').style.color = color;
      document.getElementById('addr_msg').innerHTML = msg;
    }

    function checkMAIL(mail) { //check mail format
      var mailExp =/^[a-zA-Z0-9._-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z.]{2,5}$/;
      if (mail.length == 0) {
        msg = "Need to add an email!";
        color = "red";
        emailFlag = false;
      }
      else if (!mailExp.test(mail)) {
        msg = "Invalid mail format";
        color = "red";
        emailFlag = false;
      }
      else {
        if (mail.toLowerCase()==email.toLowerCase()) {
          msg="";
          color="green";
        }
        else{
        msg = "Valid mail";
        color = "green";
        emailFlag = true;
        ajaxexists(mail,"email");
        }

      }
      document.getElementById('mail_msg').style.color = color;
      document.getElementById('mail_msg').innerHTML = msg;
    }

    function GetXmlHttpObject() {
      var xmlHttp=null;
      try
      {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
      }
      catch (e)
      {
        // Internet Explorer
        try
        { xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); }
        catch (e)
        { xmlHttp=new ActiveXObject("Microsoft.XMLHTTP"); }
      }
      return xmlHttp;
    }
    function ajaxexists(word,type){
    var xmlHttp= GetXmlHttpObject();
    if (xmlHttp==null) {
      alert("Your browser does not support AJAX!");
      return false;
    }

    var url="checkunameemailmobile.php"
    if (type=="uname")
      url=url+"?uname="+word;
    else if (type=="email")
    url=url+"?email="+word;
    else if (type=="mobile")
    url=url+"?mobile="+word;

    xmlHttp.onreadystatechange=function()
    {
      if(xmlHttp.readyState==4){
        ajax_checking=xmlHttp.responseText;
        reGajaxmsgs(word,type,ajax_checking);
      }
    }
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
    }

    function reGajaxmsgs(word, type, result){
      if (type=="uname" && result=="present" ) {
      document.getElementById('reg_username_msg').style.color ="red";
      document.getElementById('reg_username_msg').innerHTML ="Username already exists";
      usernameFlag=false;
    }
    else if(type=="email" && result=="present"){
    document.getElementById('mail_msg').style.color ="red";
    document.getElementById('mail_msg').innerHTML ="Email already registered";
    emailFlag=flag;
    }
    else if(type=="mobile" && result=="present"){
    document.getElementById('mobile_msg').style.color ="red";
    document.getElementById('mobile_msg').innerHTML ="Number already registered";
    mobileFlag=flag;
  }
  }

  function checkeditedInputs(){
      document.forms[0].JSEnabled.value="TRUE";
      return (nameFlag&&usernameFlag&&passwordFlag&&cnfmpasswordFlag&&mobileFlag&&addressFlag&&emailFlag);
    }
  </script>
</head>
<body>


<div class="container">
<div class="main-body">

<!-- Breadcrumb -->

<!-- /Breadcrumb -->

<div class="row gutters-sm">
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">
        <form onSubmit="return checkeditedInputs();" method='post' action='updateProfile.php'  enctype="multipart/form-data">
          <img src='uploadedfiles/<?php echo $profile_pic; ?> ' alt='profilepic' class="rounded-circle" width="150"><br>
          <div class="mt-3">
            <h4>John Doe</h4>
            <p class="text-secondary mb-1">Full Stack Developer</p>
            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
            <input type="file" name="picfile" id='fileUpload'><span>images<=5MB</span><br>
            <button class="btn btn-outline-primary">Message</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
          <span class="text-secondary">https://bootdey.com</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
          <span class="text-secondary">bootdey</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
          <span class="text-secondary">@bootdey</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
          <span class="text-secondary">bootdey</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
          <span class="text-secondary">bootdey</span>
        </li>
      </ul>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Full Name</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            Kenneth Valdez
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Email</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            fip@jukmuh.al
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Phone</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            (239) 816-9029
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Mobile</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            (320) 380-4539
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Address</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            Bay Area, San Francisco, CA
          </div>
        </div>
      </div>
    </div>
    <div class="row gutters-sm">
      <div class="col-sm-6 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
            <small>Web Design</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>Website Markup</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>One Page</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>Mobile Template</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>Backend API</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
            <small>Web Design</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>Website Markup</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>One Page</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>Mobile Template</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small>Backend API</small>
            <div class="progress mb-3" style="height: 5px">
              <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</body>
</html>
