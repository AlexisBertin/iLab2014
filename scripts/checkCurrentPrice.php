<?php
	session_start();
	require('auth.php');

	$pseudo = $_SESSION['Auth']['pseudo'];

	$sql = "SELECT SUM(montant) as prix_total FROM friends WHERE username = '".$pseudo."'";
	try {
		$req = $connexion->prepare($sql);
		$req->execute();
		$req->fetch();
		print_r($req);
	} catch(PDOException $e) {
		echo 'erreur: '.$e->getMessage();
	}

?>
