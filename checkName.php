<?php
session_start();
require('auth.php');

$pseudo = $_SESSION['Auth']['pseudo'];

	$addName = $_POST['addName'];

	$addName = trim($addName);
	$addName = strip_tags($addName);
	$addName = addslashes($addName);

	$liste = 'Mex';

	// Vérifie si le nom existe déjà
	$sql = "SELECT prenom FROM friends WHERE prenom = '".$addName."' AND username = '".$pseudo."' AND liste = '".$liste."'";
	try {
	    $req = $connexion->prepare($sql);
	    $req->execute();
	    $countPseudo = $req->rowCount($sql);
	    if($countPseudo > 0){
	    	$error_message_name = 'Vous utilisez déjà ce nom dans cette liste';
	    } else {
	    	echo 'ok';
	    }
	} catch(PDOException $e) {
	   echo 'erreur: '.$e->getMessage();
	}





?>
