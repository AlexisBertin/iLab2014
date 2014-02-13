<?php
session_start();
require('auth.php');


$_SESSION['datas'] = array(
	'addName'=>$addName,
	'addMontant'=>$addMontant,
	'datepicker'=>$addDate,
	'addNote'=>$addNote
)

// Ajouter une personne
	if(!empty($_POST) && isset($_POST['addName'])){
		$addName = $_POST['addName'];
		$addName = trim($addName);
		$addName = strip_tags($addName);
		$addName = addslashes($addName);
		$sql = "SELECT prenom FROM friends WHERE prenom = '".$addName."' AND username = '".$pseudo."' AND liste = '".$liste."'";
		try {
		    $req = $connexion->prepare($sql);
		    $req->execute();
		    $countPseudo = $req->rowCount($sql);
		    if($countPseudo > 0){
		    	$error_message_name = 'Vous utilisez déjà ce nom dans cette liste';
		    } else {
		    	$sql2 = "INSERT INTO friends (prenom, created, liste, username) VALUES ('".$addName."','".date("Y-m-d G:i:s")."','".$liste."','".$pseudo."')";
		    	try {
		    		$connexion->exec($sql2);
		    		echo 'Nouveau nom bien ajouté dans la base.';
		    	} catch(PDOException $e) {
		    		echo 'erreur: '.$e->getMessage();
		    	}
		    }
		    $_SESSION['addName'] = $addName;
		} catch(PDOException $e) {
		   echo 'erreur: '.$e->getMessage();
		}
	}




// Ajouter liste
	if(!empty($_POST) && isset($_POST['addListe'])){
		$addListe = $_POST['addListe'];
		$addListe = trim($addListe);
		$addListe = strip_tags($addListe);
		$addListe = addslashes($addListe);
		$sql = "SELECT nomDeListe FROM listes WHERE nomDeListe = '".$addListe."' AND createdBy = '".$pseudo."'";
		try {
		    $req = $connexion->prepare($sql);
		    $req->execute();
		    $countListes = $req->rowCount($sql);
		    if($countListes > 0){
		    	$error_message_liste = 'Vous utilisez déjà ce nom de liste';
		    } else {
		    	$sql2 = "INSERT INTO listes (nomDeListe, createdBy, created) VALUES ('".$addListe."','".$pseudo."','".date("Y-m-d G:i:s")."')";
		    	try {
		    		$connexion->exec($sql2);
		    		echo 'Nouvelle liste bien ajoutée dans la base.';
		    	} catch(PDOException $e) {
		    		echo 'erreur: '.$e->getMessage();
		    	}
		    }
		} catch(PDOException $e) {
		   echo 'erreur: '.$e->getMessage();
		}
	}
// Ajouter Montant
	if(!empty($_POST) && isset($_POST['addMontant']) && isset($_SESSION['addName'])){
		$addMontant = $_POST['addMontant'];
		$addMontant = trim($addMontant);
		$addMontant = strip_tags($addMontant);
		$addMontant = addslashes($addslashes);
		$sql3 = "UPDATE friends SET montant = '".$addMontant."' WHERE prenom = '".$_SESSION['addName']."' AND username = '".$pseudo."'";
		try { 
			$connexion->exec($sql3);
			echo 'Le montant a bien été mis à jour';
		} catch(PDOException $e){
			echo 'erreur: '.$e->getMessage();
		}

	} else if(isset($_POST['addMontant']) && !isset($_SESSION['addName'])){
		echo 'addName ne passe pas.';
	}


// Ajouter Date
	if(!empty($_POST) && isset($_POST['datepicker']) && isset($_SESSION['addName'])){
		$addOldDate = $_POST['datepicker'];
		/*$addOldDate = date_format($addDate, 'Y-m-d');*/
		$addDate = date("Y-m-d", strtotime($addOldDate));
		$sql = "UPDATE friends SET dateFin = '".$addDate."' WHERE prenom = '".$_SESSION['addName']."' AND username = '".$pseudo."'";
		try {
			$connexion->exec($sql);
			echo 'Date bien modifiée';
		} catch(PDOException $e){
			echo 'erreur: '.$e->getMessage();
		}
	}


// Ajouter Note
	if(!empty($_POST) && isset($_POST['addNote']) && isset($_SESSION['addName'])){
		$addNote = $_POST['addNote'];
		$addNote = strip_tags($addNote);
		$addNote = addslashes($addNote);
		$sql = "UPDATE friends SET note = '".$addNote."' WHERE prenom = '".$_SESSION['addName']."' AND username = '".$pseudo."'";
		try {
			$req = $connexion->prepare($sql);
			$req->execute();
			echo 'La note/commentaire a bien été mis à jour';
		} catch(PDOException $e){
			echo 'erreur: '.$e->getMessage();
		}
	}

?>
