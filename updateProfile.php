<?php
  require("noCache.php");
  extract($_POST);
  //form submited and need to edit details

  session_start();
  if (!isset($_SESSION['userId']))
    header('location:login_form.php?error=1');
$sid=$_SESSION['userId'];

  $nameFlag=$emailFlag=$usernameFlag=$passwordFlag=$cnfmpasswordFlag=$mobileFlag=$addressFlag=$fileUploadFlag=false;
  $namePattern ='/^([a-z]+\s)*[a-z]+$/i';
  $mailPattern ='/^[a-zA-Z0-9._-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z.]{2,5}$/';
  $unamePattern='/^[a-z0-9]\w{4,19}$/i';
  $pwdPattern='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/';
  $addrPattern='/^(?=.*[a-z])([a-z0-9:,]{1,}\s?)*[a-z0-9]+$/i';
  if ($country_code=='+973') {
    $mobilePattern= '/^(32|33|34|35|36|37|38|39)[0-9]{6}$/';
    $country="Bahrain";
  }
  else if ($country_code=='+966') {
    $mobilePattern= '/^(54|56|57|58|59)[0-9]{6,8}$/';
    $country="Saudi Arabia";
  }
  else if($country_code=='+971') {
    $mobilePattern= '/^(50|52|54|55|56|58)[0-9]{6,8}$/';
    $country="United Arab Emirates";
  }
if(preg_match($namePattern, $name))
$nameFlag=true;
if(preg_match($addrPattern, $address1))
if(preg_match($addrPattern, $address2))
if(preg_match($addrPattern, $address3))
$addressFlag=true;

if(preg_match($mailPattern, $email)){
  $emailFlag=true;
}

if(preg_match($unamePattern, $username)){
  $usernameFlag=true;
}

if(preg_match($mobilePattern, $mobile)){
  $mobileFlag=true;
}

if (strlen($password)==0) {
  $passwordChanged=false;
}
else{
  if(preg_match($pwdPattern, $password))
  $passwordFlag=true;
  if(($password==$cnfm_password)&&preg_match($pwdPattern, $cnfm_password))
  $cnfmpasswordFlag=true;
  $passwordChanged=true;
}

if ($passwordChanged) {
  if (!($nameFlag&&$emailFlag&&$usernameFlag&&$passwordFlag&&$cnfmpasswordFlag&&$mobileFlag&&$addressFlag))
  //validation not done on client side and values!=pattern
  header('location:profile.php?error=2');
}
else { //dont check passwordfag if password not changed
  if (!($nameFlag&&$emailFlag&&$usernameFlag&&$mobileFlag&&$addressFlag))
  header('location:profile.php?error=2');
}
echo "line 65";
  if((($_FILES["picfile"][ "type"] == "image/gif")
  || ($_FILES["picfile"]["type"] == "image/jpeg")
  || ($_FILES["picfile"]["type"] == "image/png")
  || ($_FILES["picfile"]["type"] == "image/pjpeg"))
  && ($_FILES["picfile"]["size"] < 5000000)) {
      if($_FILES["picfile"]["error"] > 0){
        echo "Return Code:". $_FILES["picfile"]["error"]. "<br>";
        }
      else {
        echo "line 76";
        $fdetails=explode(".", $_FILES["picfile"]["name"]);
        $fext=end($fdetails) ;
        $fn="pic".$fdetails[0].time() .uniqid(rand()).".$fext";  //file name
        if (move_uploaded_file($_FILES["picfile"]["tmp_name"], "uploadedfiles/$fn" )) {
          //Stored in: uploadedfiles/$fn;
          //didnt enter img details into db yet
          $fileUploadFlag=true;
          echo "line 84";
        }
        else {
          $fileUploadFlag=false;
          echo "line88";
          header('location:profile.php?error=1');
        }
      }
  }
else
echo "Invalid file type or bigger than 100KB";
header('location:profile.php?error=1');

//need to insert into DB
  try{
  require('project_connection.php');
  $db->beginTransaction();
  if ($passwordChanged&&!$fileUploadFlag) { //only password
    $sql="UPDATE users SET USERNAME= :uname, PASSWORD=:hpwd, NAME=:name, CONTACT_NUM=:mobile,EMAIL=:email, COUNTRY=:country WHERE USER_ID= :sid";
    $conn = $db->prepare($sql);
    $h_password=password_hash($password,PASSWORD_DEFAULT);
    $conn->bindValue(':hpwd' , $h_password);
  }
  else if (!$passwordChanged&&$fileUploadFlag) { //only file
    $sql="UPDATE users SET USERNAME= :uname, NAME=:name, CONTACT_NUM=:mobile,EMAIL=:email, COUNTRY=:country, PROFILE_PIC=:pfp WHERE USER_ID= :sid";
    $conn = $db->prepare($sql);
    $conn->bindValue(':pfp', $fn);
    echo "line 110";
  }
  else if ($passwordChanged&&$fileUploadFlag) { //both password and file
    $sql="UPDATE users SET USERNAME= :uname, PASSWORD=:hpwd, NAME=:name, CONTACT_NUM=:mobile,EMAIL=:email, COUNTRY=:country, PROFILE_PIC=:pfp WHERE USER_ID= :sid";
    $conn = $db->prepare($sql);
    $h_password=password_hash($password,PASSWORD_DEFAULT);
    $conn->bindValue(':hpwd' , $h_password);
    $conn->bindValue(':pfp', $fn);
    echo "line 118";
  }
  else{ //neither password nor file
    $sql="UPDATE users SET USERNAME=:uname, NAME=:name, CONTACT_NUM=:mobile,EMAIL=:email, COUNTRY=:country WHERE USER_ID= :sid";
    $conn = $db->prepare($sql);
  }
  $conn->bindValue(':uname' , $username);
  $conn->bindValue(':name' , $name);
  $conn->bindValue(':mobile' , $mobile);
  $conn->bindValue(':email' , $email);
  $conn->bindValue(':country' , $country);
  $conn->bindValue(':sid' , $sid);
  $conn->execute();
  //adding addresses
  $sql="DELETE FROM addresses WHERE USER_ID=".$sid;
  $conn=$db->exec($sql);

  $sql="INSERT INTO addresses (USER_ID,ADDRESS) VALUES(:sid, :addr1)";
  $conn = $db->prepare($sql);
  $conn->bindValue(':sid' , $sid);
  $conn->bindValue(':addr1' , $address1);
  $conn->execute();
  $sql="INSERT INTO addresses (USER_ID,ADDRESS) VALUES(:sid, :addr2)";
  $conn = $db->prepare($sql);
  $conn->bindValue(':addr2' , $address2);
  $conn->bindValue(':sid' , $sid);
  $conn->execute();
  $sql="INSERT INTO addresses (USER_ID,ADDRESS) VALUES(:sid, :addr3)";
  $conn = $db->prepare($sql);
  $conn->bindValue(':addr3' , $address3);
  $conn->bindValue(':sid' , $sid);
  $conn->execute();

  $db->commit();
  if ($conn->rowCount()==0) {
    header('location:profile.php');
  }
  elseif ($conn->rowCount()==1) {
  header('location:profile.php');
  }
  }
  catch(PDOException $e){
    $db->rollBack();
    echo "error message:".$e->getMessage();
    //will show msg on reg_loginform.php with refreshing + error
    header('location:profile.php?error=3');

  }

  echo("if you see this then there's something wrong");
?>
