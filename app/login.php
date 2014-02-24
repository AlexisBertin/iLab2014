<?php

session_start();
require_once 'connexion.php';
if(!empty($_POST)){
   $pseudo = $_POST['pseudo'];
   $pseudo = strip_tags($pseudo);
   $password = $_POST['password'];
   $password = sha1($password);

   $sql = "SELECT username, password FROM users WHERE username = '".$pseudo."' AND password = '".$password."'";
   try {
      $req = $connexion->prepare($sql);
      $req->execute();
      $count = $req->rowCount($sql);
      
      if($count == 1){
         // Vérifier si l'user est activé
         $sql2 = "SELECT username, password, activer FROM users WHERE username = '".$pseudo."' AND password = '".$password."' AND activer = 1";
         $req2 = $connexion->prepare($sql2);
         $req2->execute();
         $active = $req2->rowCount($connexion);
         
         if($active == 1){
            $_SESSION['Auth'] = array(
               'pseudo' => $pseudo,
               'password' => $password
            );
            echo 'ok';
         } else {
            $error_active = 'Votre compte n\'est pas actif, vérifiez vos mails pour activer votre compte'; 
         }
      } else {
         $error_active = 'Utilisateur inconnu';
      }


   } catch(PDOException $e) {
      echo 'erreur: '.$e->getMessage();
   }
}
?>