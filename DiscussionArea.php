<head>
      <meta charset="UTF-8">
      <title>STD Forum | Home</title>
      <link rel="stylesheet" type="text/css" href="css/HomeStyle.css">
      <link rel="shortcut icon" href="images/logo1.png" type="image/png">
      <script src="javascript/HomeScript.js"></script>
</head>
<body>
  <div class="nav" id="nav">
  <div class="image">
  <img src="images/logo1.png" alt="Logo">
  </div>
  <img src="images/divider.jpg" alt="|" id="divider">
  <a href="login.php"><button class="button1" id="logout">Logout</button></a>
  <h2>Student Teacher Discussion Forum</h2>
  <h4>Lets Talk | Feel Free to Speak</h4>
</div>

<?php

require 'connect.inc.php';

  if(@$_COOKIE['log'])
{

  if(!empty($_POST['message1']))
 {
  @$message1=htmlentities($_POST['message1']);
  echo $message1;
 }
else
 {
  unset($_POST['message1']);
  unset($message1);
  echo "msg deleted";
 }
  @$uname_msging=$_COOKIE['un_which_is_loggedin'];
  $resumetitle=$_GET['category'];

  setcookie('resumetitlereset',$resumetitle,time()+1000);

  $author=mysql_query("SELECT * FROM `forumlogin`");

while($eachrow=mysql_fetch_assoc($author))
{
  $uname=$eachrow['User_name'] ;
  $ath=$eachrow['Athority'];
  if($uname==$uname_msging)
  {
     $authority=$ath;
     break;
  }
}

 //echo $authority." is the authority of usr";
 if(@$authority==1)
 {
    $priority=1;
     //echo "authority check done with auth 1 ";
  }
  else
  {
    $priority=0;
     //echo "authority check done with 0";
  }

if(!empty($_POST['message1']))
 {
 @$querymsg="INSERT INTO $resumetitle VALUES('$uname_msging','".mysql_real_escape_string($message1)."','$priority','','')";
 $exe=mysql_query($querymsg);
 $message1=null;
 $_POST['message1']=null;
 }

 
 echo'
        <div class="headdisc">
            Discussion Area <br>
        </div>
        <div class="discuss" id="disc">
        <div class="topic">
        '.$resumetitle.'
        </div>';
        
echo '<div class="usercomment1">'.$uname_msging.'  :</div>';

 echo  '<form action="resumediscussion.php?category='. $resumetitle.'" method="POST">
       <textarea name="message1" id="comments" placeholder="Say something about it!"></textarea>

        <input type="submit" class="button2" name="msgsend" value="Comment"> </form> ';

if(@$flag==1)
        {
          echo '<input type="submit" class="button1" disabled name="support" value="Up Vote">
               <input type="submit" class="button1" disabled name="deny" value="Down Vote">';
        }
 else
        {
          echo '<div id="c1"><form action="resumediscussion.php?category='. $resumetitle.'" method="POST">
                <input type="submit" id="uv" class="button1" name="support" value="Up Vote">
               <input type="submit" id="dv" class="button1" name="deny" value="Down Vote"></form></div>';
         }
         //echo '</div> ';


$query="SELECT * FROM $resumetitle";
@$query_exe=mysql_query($query);

  echo '
  <div class="comment">';
while($each_row=mysql_fetch_assoc($query_exe))
{

  @$username=$each_row['username'];
  $msg=$each_row['messages'];
  $s=$each_row['SUPPORT'];
  $d=$each_row['DENY'];

  echo '
  <div class="usercomment">'.$username.'  :</div>
  <div class="ucomment">'.$msg.'</div>';
  if ($uname_msging==$username)
   {if($s==1||$d==1)
       $flag=1;
   }


}
echo '</div>';

 $supportquery=mysql_query("SELECT * FROM `forumtitles`");
 while($each=mysql_fetch_assoc($supportquery))
 {
   $title=$each['Title'];
   if($resumetitle==$title)
    {
     $supp=$each['Support'];
     $deny=$each['Denies'];
     break;
    }
 }


if(@$_POST['support'])
 {


           $supp++;
          // echo "no. of support=".$supp."<br>";
           mysql_query("UPDATE `forumtitles` SET `Support`='$supp' WHERE `Title`='$resumetitle'");

          mysql_query("UPDATE $resumetitle SET `SUPPORT`='1' WHERE `username`='$uname_msging'");

           $flag=1;

  }
else if(@$_POST['deny'])
  {      $deny++;
           //echo "no. of deny=".$deny."<br>";
           mysql_query("UPDATE `forumtitles` SET `Denies`='$deny' WHERE `Title`='$resumetitle'");

            mysql_query("UPDATE $resumetitle SET `DENY`='1' WHERE `username`='$uname_msging'");

           $flag=1;

  }
}
else
{
   echo 'session expired  <br><a href=login.php>login</a>';
}
?>