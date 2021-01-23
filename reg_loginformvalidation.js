var nameFlag=emailFlag=usernameFlag=passwordFlag=cnfmpasswordFlag=mobileFlag=addressFlag=false;
function checkFN(name) { //check full name
  var nameExp =/^([a-z]+\s)*[a-z]+$/i;
  if (name.length == 0) {
    msg = "";
    nameFlag = false;
  }
  else if (!nameExp.test(name)) {
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

function checkUN(uname,id) {  //check username
  var unameExp = /^[a-z0-9]\w{4,19}$/i;
  if (uname.length == 0) {
    msg = "";
    usernameFlag = false;
  }
  else if (!unameExp.test(uname)) {
    msg = "Invalid Username";
    color = "red";
    usernameFlag = false;
  }
  else {
    msg = "Valid Username";
    color = "green";
    usernameFlag = true;
    if (id=="reg_username_msg")
    ajaxexists(uname,"uname");
  }
  document.getElementById(id).style.color = color;
  document.getElementById(id).innerHTML = msg;
}

function checkPWD(pwd,id) { //check password

  var pwdExp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
  if (pwd.length == 0) {
    msg = "";
    passwordFlag = false;
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
  document.getElementById(id).style.color = color;
  document.getElementById(id).innerHTML = msg;
  if(id=="reg_pwd_msg")  //did this cus if user enters a valid passord after entering a valid comfirmation password
  confirmPWD(document.forms[1].cnfm_password.value);
}

function confirmPWD(cpassword) { //check 2nd password
  if (cpassword.length == 0) {
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
    var firstPwd = document.forms[1].password.value;
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
  if (document.forms[1].country_code.value=='+973') {
    var numExp= /^(17|32|33|34|35|36|37|38|39)[0-9]{6}$/;
  }
  else if (document.forms[1].country_code.value=='+966') {
    var numExp= /^(54|56|57|58|59)[0-9]{6,8}$/;
  }
  else if(document.forms[1].country_code.value=='+971') {
    var numExp= /^(50|52|54|55|56|58)[0-9]{6,8}$/;
  }
  if (mobile.length == 0) {
    msg = "";
    mobileFlag = false;
  }
  else if (!numExp.test(mobile)) {
    msg = "Invalid mobile number";
    color = "red";
    mobileFlag = false;
  }
  else {
    msg = "Valid mobile number";
    color = "green";
    mobileFlag = true;
    ajaxexists(mobile,"mobile");
  }
  document.getElementById('mobile_msg').style.color = color;
  document.getElementById('mobile_msg').innerHTML = msg;
}

function checkAddr(addr) { //check if address is a sentence
  var addrExp =/^(?=.*[a-z])([a-z0-9:,]{1,}\s?)*[a-z0-9]+$/i;
  if (addr.length == 0) {
    msg = "";
    addressFlag = false;
  }
  else if (!addrExp.test(addr)) {
    msg = "Invalid address";
    color = "red";
    addressFlag = false;
  }
  else {
    msg = "Valid address";
    color = "green";
    addressFlag = true;
  }
  document.getElementById('addr_msg').style.color = color;
  document.getElementById('addr_msg').innerHTML = msg;
}

function checkMAIL(mail) { //check mail format
  var mailExp =/^[a-zA-Z0-9._-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z.]{2,5}$/;
  if (mail.length == 0) {
    msg = "";
    emailFlag = false;
  }
  else if (!mailExp.test(mail)) {
    msg = "Invalid mail format";
    color = "red";
    emailFlag = false;
  }
  else {
    msg = "Valid mail";
    color = "green";
    emailFlag = true;
    ajaxexists(mail,"email");

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
  if (type=="uname" && result=="present") {
  document.getElementById('reg_username_msg').style.color ="red";
  document.getElementById('reg_username_msg').innerHTML ="Username already exists";
  usernameFlag=false;
}
else if(type=="email" && result=="present"){
document.getElementById('mail_msg').style.color ="red";
document.getElementById('mail_msg').innerHTML ="Email already registered";
emailFlag=false;
}
else if(type=="mobile" && result=="present"){
document.getElementById('mobile_msg').style.color ="red";
document.getElementById('mobile_msg').innerHTML ="Number already registered";
mobileFlag=false;
}
}

function checkRegistrationInputs(){
  document.forms[1].JSEnabled.value="TRUE";
  return (nameFlag&&usernameFlag&&passwordFlag&&cnfmpasswordFlag&&mobileFlag&&addressFlag&&emailFlag);
}

function checkLoginInputs(){
document.forms[1].JSEnabled.value="TRUE";
return (usernameFlag&&passwordFlag);
}
