<?php

session_start();
require('auth.php'); 
require_once 'connexion.php';


if(!empty($_POST) && isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password'])){

   function is_valid_email($email){
      return filter_var($email, FILTER_VALIDATE_EMAIL);
      // return true or false
   }

   $pseudo = trim($_POST['pseudo']);
   $pseudo = strip_tags($pseudo);
   $pseudo = addslashes($pseudo);
   $mail = trim($_POST['mail']);
   $mail = strip_tags($mail);
   $token = sha1(uniqid(rand()));
   $password = trim($_POST['password']);
   $password = strip_tags($password);

   /*$sql = "SELECT username, password FROM users WHERE username = '".$pseudo."' AND password = '".$password."'";*/
   $sql = "SELECT username, password FROM users WHERE username = '".$pseudo."'";
   try {
      $req = $connexion->prepare($sql);
      $req->execute();
      $countPseudo = $req->rowCount($sql);
   } catch(PDOException $e) {
      echo 'erreur: '.$e->getMessage();
   }
   $sql = "SELECT username, mail FROM users WHERE mail = '".$mail."'";
   try {
      $req = $connexion->prepare($sql);
      $req->execute();
      $countMail = $req->rowCount($sql);
   } catch(PDOException $e) {
      echo 'erreur: '.$e->getMessage();
   }


   if(strlen($pseudo)>3 && is_valid_email($mail) == true && !empty($password) && $countPseudo == 0 && $countMail == 0){
   
      $password = sha1($password);

      $sql = "INSERT INTO users (username, mail, password, created, token) VALUES ('".$pseudo."', '".$mail."', '".$password."','".date("Y-m-d G:i:s")."', '".$token."')";
      try {
         $connexion->exec($sql);
         $body = 'Bonjour, veuillez activez votre compte en cliquant ici -> <a href="http://localhost/iLab2014/activate.php?token='.$token.'&email='.$mail.'">Activation du compte</a>';

             // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
              $entete  = 'MIME-Version: 1.0' . "\r\n";
              $entete .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              // En-têtes additionnels
              $entete .= 'From: OweMe - Activation <noreply@oweme.com>' . "\r\n";
            
            // Envoi du mail
            if (mail($mail, 'Activation: ',$body,$entete)){
               $reponse = 'Votre inscription a bien été enregistrée, un mail d\'activation vous a été envoyé. Merci !';
            } else {
               $reponse = 'Échec de l\'envoi de l\'email';
            };
            echo $reponse;

      }
      catch(PDOException $e) {
         echo 'erreur: '.$e->getMessage();
      }
      
   } else {
      if(!empty($_POST) && strlen($_POST['pseudo'])<4){
         /*$error_pseudo = 'Votre pseudo doit comporter au minimum 3 charactères !';*/
         echo 'Votre pseudo doit comporter au minimum 3 charactères !';
      } else if(!empty($_POST) && is_valid_email($mail) == false){
         /*$error_mail = 'Votre adresse e-mail n\'est pas valide !';*/
         echo 'Votre adresse e-mail n\'est pas valide !';
      } else if(!empty($_POST) && empty($password)){
         /*$error_password = 'Votre mot de pass n\'est pas valide';*/
         echo 'Votre mot de pass n\'est pas valide';
      } else if(!empty($_POST) && $countPseudo != 0 && $countMail != 0){
         /*$error_pseudo = 'Ce peudo est déjà utilisé.';
         $error_mail = 'Cette adresse e-mail est déjà utilisée';*/
         echo 'Ce peudo est déjà utilisé.';
         echo 'Cette adresse e-mail est déjà utilisée';
      } else if(!empty($_POST) && $countPseudo != 0 || $countMail != 0){
         if($countPseudo != 0){
            /*$error_pseudo = 'Ce peudo est déjà utilisé.';*/
            echo 'Ce peudo est déjà utilisé.';
         } else if($countMail != 0){
            /*$error_mail = 'Cette adresse e-mail est déjà utilisée';*/
            echo 'Cette adresse e-mail est déjà utilisée';
         }
      }
   }
   

   
} /*else { echo 'nope'; }*/


?>



        
         
   


