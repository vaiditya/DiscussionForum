
<?php
 require 'connect.inc.php';
 //htmlsignupcall()
    //echo'
    //';



$username='default';

@$first=$_POST['fname'];
@$last=$_POST['lname'];
@$user=$_POST['uname'];
@$pass=$_POST['pw'];
@$otp=$_POST['otp'];

$query=" SELECT * FROM `forumlogin`";
$query_exe=mysql_query($query);


while($each_row=mysql_fetch_assoc($query_exe))
{

  $username=$each_row['User_name'];
  if(!empty($user)&&($username==$user))
  {
    echo '<script>alert("user:'.$user.' already exist")</script>';
    $username.' already exists<br>';
    unset($user);
  }
}
if(!empty($user)&&($otp==="vc_ag_ak"))
{
$insert_query=" INSERT INTO `forumlogin` VALUES ('','".mysql_real_escape_string($first)."','".mysql_real_escape_string($last)."','".mysql_real_escape_string($user)."','".mysql_real_escape_string($pass)."','1')";
$insert_exe=mysql_query($insert_query);
echo 'new username has been created as '.'<strong>'.$user.'</strong><br>';
}
else if (!empty($user))
{
$insert_query=" INSERT INTO `forumlogin` VALUES ('','".mysql_real_escape_string($first)."','".mysql_real_escape_string($last)."','".mysql_real_escape_string($user)."','".mysql_real_escape_string($pass)."','0')";
$insert_exe=mysql_query($insert_query);
header('Location: login1.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>STD Forum | Signup</title>
        <link rel="stylesheet" type="text/css" href="css/SignupStyle.css">
        <link rel="shortcut icon" type="image/png" href="images/logo1.png">
        <script src="javascript/SignupScript.js"></script>
    </head>
    <body>

        <div class="nav">
            <div class="img">
            <img src="images/logo1.png" alt="Logo">
            </div>
            <img src="images/divider.jpg" alt="|" id="divider">
            <h2>Student Teacher Discussion Forum</h2>
            <h4>Lets Talk | Feel Free to Speak</h4>
        </div>

        <p><b>Lets get started!</b></p>
        <div class="mainSignup">
        <form name="registrationForm" id="form" onsubmit="return validateForm()" action="signup.php" method="POST">
        <input type="text" name="fname" id="fname" placeholder="First Name">
        <input type="text" name="lname" id="lname" placeholder="Last Name">
        <input type="text" id="name" class="hidden" style="width:99%;"
               name="name" placeholder="Your name should Not contain numbers" disabled>
        <input type="text" id="name1" class="hidden" style="width:99%;"
               name="name1" placeholder="Enter valid Name" disabled>

        <input type="text" name="email" id="em" placeholder="e-Mail ID">
        <input type="text" id="email" class="hidden" style="width:99%;"
               name="email" placeholder="Enter valid e-Mail ID" disabled>

        <input type="text" name="phone" id="mob" placeholder="Mobile Number">
        <input type="text" id="phone" class="hidden" style="width:99%;"
               name="phone" placeholder="Enter valid 10 digit Mobile Number" disabled>

        <input type="text" name="uname" id="uid" placeholder="Create user ID">
        <input type="text" id="uid1" class="hidden" style="width:99%;"
               name="uid1" placeholder="Enter Valid User ID" disabled>

        <input type="password" name="pw" id="pass" placeholder="Password">
        <input type="password" name="repass" id="repass" placeholder="Retype Password">
        <input type="password" id="pass1" class="hidden" style="width:99%;"
               name="pass1" placeholder="Passwords do not Match" disabled>
        <input type="text" id="pass2" class="hidden" style="width:99%;"
               name="pass1" placeholder="Enter a valid Password" disabled>

        <input type="button" id="select1" class="button1" value="Student" onclick="showHide1()">
        <input type="button" id="select2" class="button1" value="Teacher" onclick="showHide2()">
        <input type="password" id="sel1" class="hidden1" style="width:99%;" name="spin" placeholder="Enter S-PIN">
        <input type="password" id="sel2" class="hidden1" style="width:99%;" name="otp" placeholder="Enter T-PIN">
        <input type="text" id="pin" class="hidden" style="width:99%;"
               name="pin" placeholder="Enter your PIN by selecting an option above" disabled>
        <center>
        <input type="submit" class="button" value="Register" onclick="hideAll()">
        <input type="reset" class="button" value="Reset" onclick="hideAll()">
        </center>
        </form>
        </div>

    </body>
</html>