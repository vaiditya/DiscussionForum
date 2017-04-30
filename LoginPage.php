<?php
require 'connect.inc.php';

@$resume=$_COOKIE['resumetitlereset'];
@$var=$_SERVER['HTTP_REFERER'];
if(@$var=="http://localhost/logout.php"||@$var=="http://localhost/discussion.php"||(@$var=="http://localhost/resumediscussion.php?category=$resume"))
{
   //echo "expire bro";
   setcookie('log','time',time()-1000);
   @setcookie('un_which_is_loggedin',$un,time()-1000);
   @setcookie('resumetitlereset',$resumetitle,time()-1000);
}


@$un=htmlentities($_POST['username']);
@$pw=htmlentities($_POST['userpass']);

$query=" SELECT * FROM `forumlogin`";
$query_exe=mysql_query($query);

if(!empty($un)&&!empty($pw))
{
 while($each_row=mysql_fetch_assoc($query_exe))
{

  $username=$each_row['User_name'];
  $passw=$each_row['Password'];
  if($username==$un)
   { if($passw==$pw)
     {   setcookie('log','time',time()+1000);
         setcookie('un_which_is_loggedin',$un,time()+1000);
         header('Location: logout.php');
         unset($un);
         unset($pw);

     }
    }
   }

       echo '<script>alert("incorrect User ID or Password")</script>';

 }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>STD Forum | Login</title>
        <link rel="stylesheet" type="text/css" href="css/LoginStyle.css">
        <link rel="shortcut icon" href="images/logo1.png" type="image/png">
        <script src="javascript/LoginScript.js"></script>
    </head>
    <body>

        <div class="nav">
            <div class="image">
            <img src="images/logo1.png" alt="Logo">
            </div>
            <img src="images/divider.jpg" alt="|" id="divider">
            <h2>Student Teacher Discussion Forum</h2>
            <h4>Let's Talk | Feel Free to Speak</h4>
        </div>

        <p id="wc"><b>Welcome!</b></p>

        <div>
            <form>
            <center>
            <input type="text" id="warn" style="width:300px;"
                   name="warn" placeholder="Enter valid Credentials" disabled>
            </center>
            </form>
        </div>

        <div class="main">
        <form name="registrationForm" onsubmit="return validateLogin()" action="login.php" method="POST">
            <input type="text" name="username" id="un" placeholder="User ID">
            <input type="password" name="userpass" id="pw" placeholder="Password">
            <center>
            <input type="submit" class="button" value="Login">
            </center>
        </form>
        <center>
        <hr width=100%><font color="white"><b>-OR-</b></font>
        <hr width=100%>
        <a href="signup.php"><button class="button">Sign Up</button></a>
        </center>
        </div>
        
    </body>
</html>