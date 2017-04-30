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
        <h4>Let's Talk | Feel Free to Speak</h4>
    </div>

<?php
  require 'connect.inc.php';

  if(@$_COOKIE['log'])
  {
  $loggeduser=$_COOKIE['un_which_is_loggedin'];
  @$titlewithspace= strtolower(htmlentities($_POST['title']));
  @$title=preg_replace('/\s+/','_',$titlewithspace);
  @$description= htmlentities($_POST['description']) ;

  $timestamp=time()-473100000;

  $query=" SELECT * FROM `forumtitles`";
  $query_exe=mysql_query($query);


while($each_row=mysql_fetch_assoc($query_exe))
{

  $titlename=$each_row['Title'];
  if(!empty($title)&&($titlename==$title))
  {

   echo '<script>alert("already exist")</script>';
    unset($title);
  }
}
if(!empty($title))
{
  $insert_query=" INSERT INTO `forumtitles` VALUES ('$loggeduser','$title','$description','$timestamp','','')";
   $insert_exe=mysql_query($insert_query);

    $query=mysql_query("CREATE TABLE $title (username VARCHAR(32),messages VARCHAR(256),priority int(1),SUPPORT int(1),DENY int(1))");

   setcookie('titlename',$title,time()+1000000);

   }
    echo '
        <center>
            <button class="button1" id="newdisc" onclick="showModal()">New Discussion</button>
        </center>

        <form class="newdisc" id="disctitle" action="logout.php" method="POST">
        <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" name="title" id="title" placeholder="What it is about? (limit: 32 characters)" maxlength="32">
            </div>
            <div class="modal-body">
                <textarea id="description" placeholder="A little Description! (limit: 256 characters)" maxlength="256" name="description"></textarea>
            </div>
            <div class="modal-footer">
                <input type="reset" class="button1" id="cancel" value="Cancel">
                <input type="submit" class="button1" id="post" value="Post">
            </div>
        </div>
        </div>
        </form>
        <br>
        <div>
            <div class="headtrend" id="ht">
                Trending Discussions
            </div>
            <div class="trending" id="trend">';

            $querytrending=" SELECT * FROM `forumtitles` ORDER BY `Support` DESC ";
    $query_exe=mysql_query($querytrending);


    while($each_row=mysql_fetch_assoc($query_exe))
   {

         $titlename=$each_row['Title'];
         echo '<a id="resume" href="resumediscussion.php?category='.$titlename.'"><button class="resumeb">'.$titlename.'</button></a>';

   }
          echo ' </div>';
         echo'
            <div class="headlatest" id="hl">
                Latest Discussions
            </div>
            <div class="latest" id="latest">';

    $querylatest=" SELECT * FROM `forumtitles` ORDER BY `Time` DESC ";
    $query_exe=mysql_query($querylatest);


    while($each_row=mysql_fetch_assoc($query_exe))
   {

         $titlename=$each_row['Title'];
         echo '<a id="resume" href="resumediscussion.php?category='.$titlename.'"><button class="resumeb">'.$titlename.'</button></a>';
   }
     echo'</div>
    </body>';
}
 else
{
   echo 'session expired  <br><a href=login.php>login</a>';
}
?>