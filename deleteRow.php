<?php
	session_start();
	require('auth.php'); 
	


		/*if(isset($_POST['id'] && !empty($_POST['id'])){*/
			$sql = "DELETE FROM friends WHERE id='".$_POST['id']."'";
			try {
			  $req = $connexion->prepare($sql);
			  $req->execute();
			  echo 'ok';
			} catch(PDOException $e){
			   echo 'erreur '.$e->getMessage();
			}
		/*}*/

	
?>