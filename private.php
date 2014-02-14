<?php
session_start();
require('auth.php');

if(Auth::islog()){

	$liste = 'Mex';
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


} else {
	header('Location:index.php');
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

   	<!-- link href="styles.css" rel="stylesheet" -->
   	<link rel="stylesheet" href="assets/css/jquery-ui.css">
   	<link rel="stylesheet" href="assets/css/styles.css">
   	
   	<script src="assets/js/jquery.js"></script>
   	<script type="text/javascript" src="assets/js/jquery-ui.js"></script>
   	<script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
   	
   	<script src="assets/js/boxlayout.js"></script>
   	<script>
   		$(document).ready(function(){
			Boxlayout.init();
			$( "#datepicker" ).datepicker();
			$('#ui-datepicker-div').appendTo('.calendar');

			$('.bl-panel-items form').on('submit', function(e){
				e.preventDefault();	
				if($('.bl-panel-items form').hasClass('addNameForm')){
					console.log('great');
					var addName = $('#addName').val();
					$.ajax({
					    url: "checkName.php",
					    type: "POST",
					    data: { addName:addName },
					    success: function(html) {
					    	console.log(html);
					    }
					});
				}		
			});
			$('.panel5 h2').click(function(){
				var addName = $('#addName').val();
				var addMontant = $('#addMontant').val();
				var datepicker = $('#datepicker').val();
				var addNote = $('#addNote').val();
				console.log('FinalSend');
				console.log(addName);
				console.log(addMontant);
				console.log(datepicker);
				console.log(addNote);
				$.ajax({
				    url: "functions.php",
				    type: "POST",
				    data: { addName:addName, addMontant:addMontant, datepicker:datepicker, addNote:addNote },
				    success: function(html) {
				    	console.log(html);
				    }
				});
			});
   		});
			
  	</script>

</head>
<body>
		
	<div class="container">	
		<div id="bl-main" class="bl-main">
			<section id="bl-work-section">
				<div class="bl-box startX">
					<img src="assets/img/add_btn.png"/>
					<h2><span>Add</span> an account</h2>
				</div>
				
				<span class="bl-icon bl-icon-close"></span>
			</section>
			<div class="bl-panel-items" id="bl-panel-work-items">
				<div class="panel1">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h3><span>Q</span>ui ?</h3>
				   	<form method="POST" action="functions.php" class="addNameForm owe" >
				   		<label for="addName">Ajouter une personne</label>
			    		<input type="text" name="addName" id="addName" placeholder="nom de la personne" value="<?php if(isset($_POST['addName'])){ echo $_POST['addName']; } ?>" required />
			    		<input type="submit" value="Ajouter" />
			 			<div class="error"><?php if(isset($error_message_name)){ echo $error_message_name;} ?></div>
			    	</form>
			    	<div class="steps">1/4</div>
				</div>
				<div class="panel2">
					<div>
						<h3><span>M</span>ontant</h3>
			    		<form method="POST" action="functions.php" class="addMontantForm owe">
			    			<label for="addMontant">Combien ?</label>
			    			<input type="text" name="addMontant" id="addMontant" placeholder="combien ça coute" value="<?php if(isset($_POST['addMontant'])){ echo $_POST['addMontant']; } ?>" required />
			    			<input type="submit" value="Ajouter" />
			    			<div class="error"><?php if(isset($error_message_montant)){ echo $error_message_montant; } ?></div>
			    		</form>
			    		<div class="steps">2/4</div>
			        </div>
			    </div>
			    <div class="panel3">
			    	<div>
						<h3><span>D</span>ate d'écheance</h3>
						<form action="functions.php" method="POST" class="datepickerForm owe">
							<div class="calendar"></div>
							<input type="text" id="datepicker" id="datepicker" name="datepicker" value="<?php if(isset($_POST['datepicker'])){ echo $_POST['datepicker']; } ?>" />
							<input type="submit" value="INSERT DATE">
						</form>
						<div class="steps">3/4</div>
				    </div>
				</div>
				<div class="panel4">
					<div>
						<h3><span>N</span>ote</h3>
						<form action="functions.php" method="POST" class="addNoteForm owe">
							<label for="addNote">Note</label>
							<textarea name="addNote" id="addNote"></textarea>
							<input type="submit" value="Ajouter" />
						</form>
						<div class="steps">4/4</div>
				    </div>
				</div>


				<div class="panel5">
					<h2>Envoyer les infos</h2>
				</div>


				<!-- <div class="panel5">
					<div>
						<form method="POST" action="functions.php">
							<select>
							<?php
					    		/*$sql = "SELECT nomDeListe FROM listes WHERE createdBy = '".$pseudo."'";
					    		$req = $connexion->prepare($sql);
					    		$req->execute();
					    		$tableau = $req->fetchAll();
					    		$count = $req->rowCount();

					    		for($i = 1; $i <= $count; $i++){
					    			echo '<option value="'.$tableau[$i-1]['nomDeListe'].'">'.$tableau[$i-1]['nomDeListe'].'</option>';
					    		}*/
					    	?>
					    	</select>
					    	<input type="submit" value="Envoyer" />
					    </form>
				    </div>
				</div>
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