<?php
session_start();
require('auth.php');

if(Auth::islog()){

	$pseudo = $_SESSION['Auth']['pseudo'];

	function deleteName($ligne){
		global $connexion;
		$sql = "DELETE FROM friends WHERE id='".$ligne."'";
		try {
			$connexion->exec($sql);
			echo 'supprimé';	
		} catch(PDOException $e) {
			echo 'erreur: '.$e->getMessage();
		}
	}
	if(isset($_GET['tab']) && $_GET['del'] == true){
		deleteName($_GET['tab']);
	}

?>
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
   	<title>PHP | Membres</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
   	<meta name="author" content="Alexis Bertin" />
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">

   	<!-- link href="styles.css" rel="stylesheet" -->
   	<link rel="stylesheet" href="assets/css/jquery-ui.css">
   	<link rel="stylesheet" href="assets/css/styles.css">
   	<link rel="stylesheet" href="assets/fonts/css/font-awesome.css">
   	
   	<script type="text/javascript" src="assets/js/jquery.js"></script>
   	<script type="text/javascript" src="assets/js/jquery-ui.js"></script>
   	<script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
   	
   	<script type="text/javascript" src="assets/js/hammerjs/hammer.js"></script>
	<script type="text/javascript" src="assets/js/hammerjs/jquery.hammer-standalone.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>

</head>
<body>
		
	<div class="container">	
		<div id="bl-main" class="bl-main">
			<section id="bl-work-section">
				<div id="header">
					<a href="menu.html"><img src="assets/img/burger_black.png"/></a>
					<h1><a href="index.php" src="logo.png" ><span</span>me</a></h1>
	           	</div>
				<div class="startX">
					<img src="assets/img/add_btn.png"/>
					<h2><span>Add</span> an account</h2>
					<div class="personalCount"></div>
				</div>
				<span class="bl-icon bl-icon-close"></span>
			</section>
			<div class="addChoice">
				<ul>
					<li class="onMeDoitMenu">On me doit</li>
					<li class="jeDoisMenu">Je dois</li>
					<li class="activitesMenu">Activités</li>
				</ul>
				<div class="steps">1/6</div>
			</div>
			<div class="bl-panel-items onMeDoit">
			    <div class="panel1">
			    	<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>L</span>iste OnMeDoit</h3>
					<form action="functions.php" method="POST" class="addListeForm">
						<select>
							<?php
					    		$sql = "SELECT nomDeListe FROM listes WHERE createdBy = '".$pseudo."'";
					    		try {
					    			$req = $connexion->prepare($sql);
					    			$req->execute();
					    			$tableau = $req->fetchAll();
					    			$count = $req->rowCount();
					    		} catch(PDOException $e){
					    			echo 'erreur '.$e->getMessage();
					    		}
					    		for($i = 1; $i <= $count; $i++){
					    			echo '<option value="'.$tableau[$i-1]['nomDeListe'].'">'.$tableau[$i-1]['nomDeListe'].'</option>';
					    		}
					    	?>
					    </select>
						<input type="text" class="addListe" name="addListe" placeholder="Ajouter une nouvelle liste" value="<?php if(isset($_POST['addListe'])){ echo $_POST['addListe']; } ?>" required />
						<div class="error" style="font-style: bold; color: red;"></div>
						<input type="submit" value="Ajouter cette liste">
					</form>
					<div class="nextStep">Étape suivante</div>
					<div class="steps">2/6</div>
			    </div>
				<div class="panel2">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>Q</span>ui ?</h3>
				   	<form method="POST" action="" class="addNameForm" >
				   		<label for="addName">Ajouter une personne</label>
			    		<input type="text" name="addName" class="addName" placeholder="nom de la personne" value="<?php if(isset($_POST['addName'])){ echo $_POST['addName']; } ?>" required />
			    		<div class="error" style="font-style: bold; color: red;"></div>
			    		<input type="submit" value="Ajouter" />
			    	</form>
			    	<div class="steps">3/6</div>
				</div>
				<div class="panel3">
					<div class="back"><img src="assets/img/bck.png"/></div>		
					<h3><span>M</span>ontant</h3>
			    	<form method="POST" action="" class="addMontantForm">
			   			<label for="addMontant">Combien ?</label>
			   			<input type="number" name="addMontant" class="montantOnMeDoit addMontant" placeholder="combien ça coute" value="<?php if(isset($_POST['addMontant'])){ echo $_POST['addMontant']; } ?>" required />
			   			<input type="submit" value="Ajouter" />
			   			<div class="error"><?php if(isset($error_message_montant)){ echo $error_message_montant; } ?></div>
		    		</form>
			    	<div class="steps">4/6</div>
			    </div>
			    <div class="panel4">
			    	<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>D</span>ate d'écheance</h3>
					<form action="" method="POST" class="datepickerForm">
						<div class="calendar"></div>
						<input type="text" class="datepicker" name="datepicker" value="<?php if(isset($_POST['datepicker'])){ echo $_POST['datepicker']; } ?>" />
						<input type="submit" value="Ajouter cette date" />
					</form>
					<div class="steps">5/6</div>
				</div>
				<div class="panel5">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>N</span>ote</h3>
					<form action="" method="POST" class="addNoteForm">
						<label for="addNote">Note</label>
						<textarea name="addNote" class="addNote"></textarea>
						<input type="submit" value="Ajouter" />
					</form>
					<div class="steps">6/6</div>
				</div>

				<div class="panel6">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h2>Récupitulatif</h2>
					<div class="recap"></div>
					<button type="button">Enregistrer</button>
				</div>

				<div class="panel7">
					<div class='success'></div>
					<div class='btBackStart'>Retour à l'accueil</div>
				</div>


				<!-- 
				<div class="panel6">
					<div>
						<ul>
						<?php
							/*$sql2 = "SELECT prenom, montant, liste, id FROM friends WHERE username = '".$pseudo."'";

							$req2 = $connexion->prepare($sql2);
							$req2->execute();
							$tableau = $req2->fetchAll();
							$count = $req2->rowCount();

							for ($i = 1; $i <= $count; $i++) {
							    echo '<li>';
							    for($x = 0; $x <= 2; $x++){
							    	echo '<span class="case">'.$tableau[$i-1][$x].'</span>';
							    }
							    echo '<a class="del" style="margin-left: 10px;" href="?tab='.$tableau[$i-1]['id'].'&del=true">X</a>';
							    echo '</li>';
							}*/

						?>
						</ul>
				    </div>
				</div>
				<div class="panel7">
					<div>
						<a href="logout.php">Se déconnecter</a>
					</div>
				</div> -->
				<!-- <nav>
					<span class="bl-next-work">&gt; Next Project</span>
					<span class="bl-icon bl-icon-close"></span>
				</nav> -->
			</div>


			<div class="bl-panel-items jeDois">
			    <div class="panel1">
			    	<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>L</span>iste jeDois</h3>
					<form action="functions.php" method="POST" class="addListeForm">
						<select>
							<?php
					    		$sql = "SELECT nomDeListe FROM listes WHERE createdBy = '".$pseudo."'";
					    		try {
					    			$req = $connexion->prepare($sql);
					    			$req->execute();
					    			$tableau = $req->fetchAll();
					    			$count = $req->rowCount();
					    		} catch(PDOException $e){
					    			echo 'erreur '.$e->getMessage();
					    		}
					    		for($i = 1; $i <= $count; $i++){
					    			echo '<option value="'.$tableau[$i-1]['nomDeListe'].'">'.$tableau[$i-1]['nomDeListe'].'</option>';
					    		}
					    	?>
					    </select>
						<input type="text" class="addListe" name="addListe" placeholder="Ajouter une nouvelle liste" value="<?php if(isset($_POST['addListe'])){ echo $_POST['addListe']; } ?>" required />
						<div class="error" style="font-style: bold; color: red;"></div>
						<input type="submit" value="Ajouter cette liste">
					</form>
					<div class="nextStep">Étape suivante</div>
					<div class="steps">2/6</div>
			    </div>
				<div class="panel2">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>Q</span>ui ?</h3>
				   	<form method="POST" action="" class="addNameForm" >
				   		<label for="addName">Ajouter une personne</label>
			    		<input type="text" name="addName" class="addName" placeholder="nom de la personne" value="<?php if(isset($_POST['addName'])){ echo $_POST['addName']; } ?>" required />
			    		<div class="error" style="font-style: bold; color: red;"></div>
			    		<input type="submit" value="Ajouter" />
			    	</form>
			    	<div class="steps">3/6</div>
				</div>
				<div class="panel3">
					<div class="back"><img src="assets/img/bck.png"/></div>		
					<h3><span>M</span>ontant</h3>
			    	<form method="POST" action="" class="addMontantForm">
			   			<label for="addMontant">Combien ?</label>
			   			<input type="number" name="addMontant" class="montantJeDois addMontant" placeholder="combien ça coute" value="<?php if(isset($_POST['addMontant'])){ echo $_POST['addMontant']; } ?>" required />
			   			<input type="submit" value="Ajouter" />
			   			<div class="error"><?php if(isset($error_message_montant)){ echo $error_message_montant; } ?></div>
		    		</form>
			    	<div class="steps">4/6</div>
			    </div>
			    <div class="panel4">
			    	<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>D</span>ate d'écheance</h3>
					<form action="" method="POST" class="datepickerForm">
						<div class="calendar"></div>
						<input type="text" class="datepicker" name="datepicker" value="<?php if(isset($_POST['datepicker'])){ echo $_POST['datepicker']; } ?>" />
						<input type="submit" value="Ajouter cette date" />
					</form>
					<div class="steps">5/6</div>
				</div>
				<div class="panel5">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>N</span>ote</h3>
					<form action="" method="POST" class="addNoteForm">
						<label for="addNote">Note</label>
						<textarea name="addNote" class="addNote"></textarea>
						<input type="submit" value="Ajouter" />
					</form>
					<div class="steps">6/6</div>
				</div>

				<div class="panel6">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h2>Récupitulatif</h2>
					<div class="recap"></div>
					<button type="button">Enregistrer</button>
				</div>

				<div class="panel7">
					<div class='success'></div>
					<div class='btBackStart'>Retour à l'accueil</div>
				</div>


				<!-- 
				<div class="panel6">
					<div>
						<ul>
						<?php
							/*$sql2 = "SELECT prenom, montant, liste, id FROM friends WHERE username = '".$pseudo."'";

							$req2 = $connexion->prepare($sql2);
							$req2->execute();
							$tableau = $req2->fetchAll();
							$count = $req2->rowCount();

							for ($i = 1; $i <= $count; $i++) {
							    echo '<li>';
							    for($x = 0; $x <= 2; $x++){
							    	echo '<span class="case">'.$tableau[$i-1][$x].'</span>';
							    }
							    echo '<a class="del" style="margin-left: 10px;" href="?tab='.$tableau[$i-1]['id'].'&del=true">X</a>';
							    echo '</li>';
							}*/

						?>
						</ul>
				    </div>
				</div>
				<div class="panel7">
					<div>
						<a href="logout.php">Se déconnecter</a>
					</div>
				</div> -->
				<!-- <nav>
					<span class="bl-next-work">&gt; Next Project</span>
					<span class="bl-icon bl-icon-close"></span>
				</nav> -->
			</div>
		</div>
	</div>
	


	    	

	
</body>
</html> 

<?php

} else {
	header('Location:index.php');
}
?>