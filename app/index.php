<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
   <title>OweMe</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title></title>
   <meta name="description" content="">
   <meta name="author" content="Alexis Bertin" />
   <meta name="HandheldFriendly" content="True">
   <meta name="MobileOptimized" content="320">
   <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
   <meta http-equiv="cleartype" content="on">

   <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/img/logo144.png">
   <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/img/logo114.png">
   <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/img/logo72.png">
   <link rel="apple-touch-icon-precomposed" href="assets/img/logo57.png">
   <link rel="shortcut icon" href="assets/img/logo144.png">
   <link rel="apple-touch-startup-image" href="splash-screen-320x460.png"/>
   <link rel="apple-touch-startup-image" href="splash-screen-640x920.png" />

   <!-- Tile icon for Win8 (144x144 + tile color) -->
   <meta name="msapplication-TileImage" content="assets/img/logo144.png">
   <meta name="msapplication-TileColor" content="#222222">

   <!-- For iOS web apps. Delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
   <meta name="apple-mobile-web-app-title" content="OweMe">
   
   <!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
   <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
   

   <!-- link href="styles.css" rel="stylesheet" -->
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="assets/css/jquery-ui.css">
   <link rel="stylesheet" href="assets/css/styles.css">
   <link rel="stylesheet" href="assets/fonts/css/font-awesome.css">
   <link rel="stylesheet" href="assets/css/normalize.css">
   
   <script type="text/javascript" src="assets/js/jquery.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
   <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
   <script type="text/javascript" src="assets/js/index.js"></script>

   <script type="text/javascript" src="assets/js/fastclick.js"></script>
   <script type="text/javascript" src="assets/js/helper.js"></script>
   <script type="text/javascript">
      $(function() {
          FastClick.attach(document.body);
      });
   </script>
   
   
</head>
<body ontouchmove="BlockMove(event);">

   <div id= "header">
      <img src="assets/img/burger_black.png"/>
      <h1><span>Owe</span>me</h1>
   </div> <!-- à mettre au-dessus du container pour fix -->
   

   <div class="content_menu">
      <ul class="basic" style="opacity:1">
         <li class="addCount"><a href="">Add a count</a></li>
         <li class="accounts"><a href="">My Accounts</a></li>
      </ul> <!-- end basic -->

      <div class="signOut">
         <a href="logout.php">Sign out</a>
      </div> <!-- end_sign -->
   </div> <!-- end content_menu -->


   <div class="containerLogin">
      <div class="content_connexion">
         <div class="blocLogin">
            <form class="connexion" action="" method="POST">
               <!-- <label for="pseudo">Pseudo</label> -->
               <input type="text" name="pseudo" class="pseudo" placeholder="USER" value="<?php if(isset($_POST['pseudo'])){ echo $_POST['pseudo']; } ?>" required /><br />
               <div class="error"><?php if(isset($error_pseudo)){ echo $error_pseudo; } ?></div>
               <!-- <label for="password">Password</label> -->
               <input type="password" name="password" class="password" placeholder="PASSWORD" required /><br />
               <div class="error"><?php if(isset($error_password)){ echo $error_password; } ?></div>

               <input type="submit" class="submit" value="Connection" />
               <div class="error"><?php if(isset($error_active)){ echo $error_active; } ?></div>            
            </form>
            <a class="sign" href="register.php">Register</a>
         </div>
         <div class="blocRegister">
            <h2 class="big_titles">Registration</h2>
            <form class="connexion registration" action="" method="POST">
               <div class="icon-ph"><i class="icon-envelope"></i></div>
               <input type="text" name="pseudo" class="pseudo" placeholder="USER"value="<?php if(isset($_POST['pseudo'])){ echo $_POST['pseudo']; } ?>" required /><br />
               <div class="error"><?php if(isset($error_pseudo)){ echo $error_pseudo; } ?></div>
               <input type="email" name="mail" class="mail" placeholder="EMAIL"value="<?php if(isset($_POST['mail'])){ echo $_POST['mail']; } ?>" required /><br />
               <div class="error"><?php if(isset($error_mail)){ echo $error_mail; } ?></div>
               <input type="password" name="password" class="password" placeholder="PASSWORD" required /><br />
               <div class="error"><?php if(isset($error_password)){ echo $error_password; } ?></div>

               <div class="errorRecap"></div>
               <input type="submit" value="Sign in" />
            </form> 
            <a class="signCancel" href="">Cancel</a>
         </div>
      </div>
      
   </div>
   <div class="container">

   </div>

   <div class="containerTotal">
      <div class="montantTot">
         <!-- <span>+</span> --><span class="montantTotalChiffre"></span>
      </div>
      <ul class="recapTot">
         <!-- <li>
            <ul class="subMenuPerso">
               <li>Alexis Bertin</li>
               <li>12/02/2013</li>
               <li>30 €</li>
               <li class="deleteMontant">Delete</li>
            </ul>
         </li>
         <li>
            <ul class="subMenuPerso">
               <li>Alexis Bertin</li>
               <li>12/02/2013</li>
               <li>100 €</li>
               <li class="deleteMontant">Delete</li>
            </ul>
         </li>
         <li>
            <ul class="subMenuPerso">
               <li>Alexis Bertin</li>
               <li>12/02/2013</li>
               <li>-300 €</li>
               <li class="deleteMontant">Delete</li>
            </ul>
         </li> -->
      </ul>
   </div>

   <div class="resizePage"><img src="assets/img/resizePage.png" alt="cadre image resize" /></div>
</body>
</html> 


<?php

session_start();
require('auth.php'); 

if(Auth::islog()){

   $pseudo = $_SESSION['Auth']['pseudo'];
?>
<script type="text/javascript">
   $.ajax({
      url: 'private.php',
      cache: false,
      success: function(html){
         $('.containerLogin').empty();
            $('.container').html(html).css({'opacity':'1'});
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
         alert(textStatus);
      }
   });
</script>
<?php
} else {
?>
<script type="text/javascript"> 
$('.containerLogin').css({'opacity':'1'});
</script>
<?php } ?>
