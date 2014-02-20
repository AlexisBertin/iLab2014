<?php
session_start();
require('auth.php');

if(Auth::islog()){

	$pseudo = $_SESSION['Auth']['pseudo'];

/*	function deleteName($ligne){
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
	}*/

?>		
	
		<div id="bl-main" class="bl-main">
			<section id="bl-work-section">
				<div class="startX">
					<img src="assets/img/add_btn.png"/>
					<h2><span>Add</span> an account</h2>
						
				</div> <!-- end bl-box startX -->
				<div class="personalCount"></div>
				<span class="bl-icon bl-icon-close"></span>
			</section> <!-- end bl-work-section -->
			<div class="addChoice">
					<div class="quest_form">
						<div class="owe">
				    		<div class="back"><img src="assets/img/bck.png"/></div>
							<h3><span>Add</span> an account</h3>
							<ul>
								<li class="onMeDoitMenu">On me doit <img class="checked" src="assets/img/checked_icon.svg"/></li>
								<li class="jeDoisMenu">Je dois<img class="checked" src="assets/img/checked_icon.svg"/></li>
								<li class="activitesMenu">Activités<img class="checked" src="assets/img/checked_icon.svg"/></li>
							</ul>
						</div> <!-- end owe -->
						<div class="steps">1/6</div>
					</div> <!-- end quest_form -->
			</div> <!-- end AddChoice -->

			<div class="bl-panel-items">
				<div class="panel1">
           			<div class="quest_form">
			    		<div class="back"><img src="assets/img/bck.png"/></div>
						<h3><span>L</span>iste</h3>
						<form action="functions.php" method="POST" class="addListeForm owe">
							<div class="select">
								<!-- <p>Choose</p> -->
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
							</div>
						<input type="text" class="addListe" name="addListe" placeholder="Ajouter une nouvelle liste" value="<?php if(isset($_POST['addListe'])){ echo $_POST['addListe']; } ?>" required />
						<div class="error" style="font-style: bold; color: red;"></div>
						<input type="submit" value="Ajouter cette liste">
					</form>
					<div class="nextStep">Next</div>
					<div class="steps">2/6</div>
				  </div> <!-- end quest_form -->
			    </div> <!-- end panel1 -->

				<div class="panel2">
					<div class="quest_form">
						<div class="back"><img src="assets/img/bck.png"/></div>
							<h3><span>W</span>ho ?</h3>
					   	<form class="owe" method="POST" action="functions.php" class="addNameForm owe" >
				    		<input type="text" name="addName" class="addName" placeholder="Name" value="<?php if(isset($_POST['addName'])){ echo $_POST['addName']; } ?>" required />
				    		<div class="error" style="font-style: bold; color: red;"></div>
				    		<input type="submit" value="Next" />
				    	</form>
				    	<div class="steps">3/6</div>
				    </div> <!-- end quest_form -->
				</div>
				<div class="panel3">
					<div class = "quest_form">
						<div class="back"><img src="assets/img/bck.png"/></div>
							<h3><span>A</span>mount</h3>
			    		<form method="POST" action="functions.php" class="addMontantForm owe">
			    			<input type="number" name="addMontant" class="addMontant" placeholder="Amount" value="<?php if(isset($_POST['addMontant'])){ echo $_POST['addMontant']; } ?>" required />
			    			<input type="submit" value="Next"/>
			    			<div class="error"><?php if(isset($error_message_montant)){ echo $error_message_montant; } ?></div>
			    		</form>
			    		<div class="steps">4/6</div>
			        </div>
			    </div>
			    <div class="panel4">
			    	<div class = "quest_form">
			    		<div class="back"><img src="assets/img/bck.png"/></div>
							<h3><span>Due</span> date</h3>
						<form action="functions.php" method="POST" class="datepickerForm owe">
							<div class="calendar"></div>
							<input type="text" class="datepicker" name="datepicker" placeholder="" value="<?php if(isset($_POST['datepicker'])){ echo $_POST['datepicker']; } ?>" />
							<input type="submit" value="Next">
							<!-- <a href>Pass</a> -->
						</form>
						<div class="steps">5/6</div>
				    </div> <!-- end quest_form -->
				</div>
				<div class="panel5">
					<div class = "quest_form">
						<div class="back"><img src="assets/img/bck.png"/></div>
							<h3><span>N</span>ote</h3>
						<div class="line"></div>
						<div class="line"></div>
						<form action="functions.php" method="POST" class="addNoteForm owe">
							<textarea name="addNote" class="addNote"></textarea>
							<input type="submit" value="Next" />
							<a class="pass" href="">Pass</a>
						</form>
						<div class="steps">6/6</div>
						
				    </div> <!-- end quest_form -->
				</div>

				<div class="panel6">
					<div class="back"><img src="assets/img/bck.png"/></div>
					<h2>Summary</h2>
					<div class="contentRecup">
						<div class="recap"></div>
						<button type="button">Save</button>
					</div>
				</div>

				<div class="panel7">
					<div class = "quest_form">
						<div class='success'></div>
						<div class='btBackStart'><i class="fa fa-home"> Homepage</i></div>
					</div>
				</div>

			</div>


		</div> 	

	<script type="text/javascript" src="assets/js/private.js"></script>
	

<?php } else { ?>
	<script type="text/javascript">
		$('.container').html('');
	</script>
<?php }
?>