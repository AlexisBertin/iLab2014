<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
   <title>PHP | Membres</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
   <meta name="author" content="Alexis Bertin" />
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="apple-mobile-web-app-status-bar-style" content="translucent black">

   <!-- link href="styles.css" rel="stylesheet" -->
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="assets/css/jquery-ui.css">
   <link rel="stylesheet" href="assets/css/styles.css">
   <link rel="stylesheet" href="assets/fonts/css/font-awesome.css">

      
   <script type="text/javascript" src="assets/js/jquery.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
   <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
   <script type="text/javascript" src="assets/js/index.js"></script>

   <script type="text/javascript" src="assets/js/hammerjs/hammer.js"></script>
   <script type="text/javascript" src="assets/js/hammerjs/jquery.hammer-standalone.min.js"></script>
   
</head>
<body class="bodyIndex">

   <div id= "header">
      <img src="assets/img/burger_black.png"/>
      <h1><span>Owe</span>me</h1>
   </div> <!-- à mettre au-dessus du container pour fix -->
   

   <div class="content_menu">
      <ul class="basic" style="opacity:1">
         <li><a href="">Edit Profil</a></li>
         <li><a href="">My Accounts</a>
               <ul class="menu_hide">
               <li><a href="">Owes me</a></li>
               <li><a href="">I owe</a></li>
            </ul>
         </li>
      </ul> <!-- end basic -->

      <div class="signOut">
         <a href="">Sign out</a>
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
               <input type="text" name="pseudo" placeholder="USER"value="<?php if(isset($_POST['pseudo'])){ echo $_POST['pseudo']; } ?>" required /><br />
               <div class="error"><?php if(isset($error_pseudo)){ echo $error_pseudo; } ?></div>
               <input type="email" name="mail" placeholder="EMAIL"value="<?php if(isset($_POST['mail'])){ echo $_POST['mail']; } ?>" required /><br />
               <div class="error"><?php if(isset($error_mail)){ echo $error_mail; } ?></div>
               <input type="password" name="password" placeholder="PASSWORD" required /><br />
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
</body>
</html> 


<?php session_start();
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
