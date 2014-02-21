<?php
	session_start();
	require('auth.php'); 

	if(Auth::islog()){

		$pseudo = $_SESSION['Auth']['pseudo'];
		$sql = "SELECT id, prenom, montant, created FROM friends WHERE username = '".$pseudo."' ORDER BY created DESC";
		try {
		   $req = $connexion->prepare($sql);
		   $req->execute();
		   $tableau = $req->fetchAll();
		   $count = $req->rowCount();
		} catch(PDOException $e){
		   echo 'erreur '.$e->getMessage();
		}
		for($i = 1; $i <= $count; $i++){
		   echo '<li><ul class="subMenuPerso"><li>'.$tableau[$i-1]['prenom'].'</li><li>'.$tableau[$i-1]['created'].'</li><li>'.$tableau[$i-1]['montant'].'€</li><li class="deleteMontant" id="del'.$tableau[$i-1]['id'].'">Delete</li></ul></li>';
		 
		}


		

	}
?>