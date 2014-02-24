<?php
session_start();
require('auth.php');

$pseudo = $_SESSION['Auth']['pseudo'];

	$addName = $_POST['addName'];
	$addMontant = $_POST['addMontant'];
	$addDate = $_POST['datepicker'];
	$addNote = $_POST['addNote'];
	$addListe = $_POST['addListe'];

	$addName = trim($addName);
	$addName = strip_tags($addName);
	$addName = addslashes($addName);

	$addMontant = trim($addMontant);
	$addMontant = addslashes($addMontant);

	$addDate = date("Y-m-d", strtotime($addDate));

	$addNote = strip_tags($addNote);
	$addNote = addslashes($addNote);




	// Vérifie si le nom existe déjà
	$sql = "SELECT prenom FROM friends WHERE prenom = '".$addName."' AND username = '".$pseudo."' AND liste = '".$addListe."'";
	try {
	    $req = $connexion->prepare($sql);
	    $req->execute();
	    /*$countPseudo = $req->rowCount($sql);*/
	    	$sql2 = "INSERT INTO friends (prenom, montant, created, liste, username, dateFin, note) VALUES ('".$addName."','".$addMontant."','".date("Y-m-d G:i:s")."','".$addListe."','".$pseudo."','".$addDate."','".$addNote."')";
	    	try {
	    		$req = $connexion->prepare($sql2);
	    		$req->execute();
	    		echo 'l\'ajout a bien été effectué';
	    	} catch(PDOException $e) {
	    		echo 'erreur: '.$e->getMessage();
	    	}
	
	} catch(PDOException $e) {
	   echo 'erreur: '.$e->getMessage();
	}


?>
