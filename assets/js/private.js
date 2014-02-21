$(document).ready(function(){
	/*$( ".datepicker" ).datepicker();
	$('#ui-datepicker-div').appendTo('.calendar');*/
	function mainPrice(){
		/*$('.personalCount')*/
		$.ajax({
			url: "checkCurrentPrice.php",
			success: function(html){
		    	console.log(html);
		    	$('.personalCount').html(html+'<span class="devise">€</span>');
			}
		});
	}
	mainPrice();



	var panelX = 0;

	function menuPanel(){
		$('.startX').css({'opacity':'0'}); 
		$().css({'opacity':'0'});
		$('.addChoice').css({'display':'block'});
		setTimeout(function() {
			$('.startX').css({'display':'none'});
			$('.personalCount').css({'display':'none'});
			$('.addChoice').addClass( 'visible' );
		}, 400);   
	}

	function nextPanel(e){
		currentMenu = e;
		panelX++;
		console.log(currentMenu+" "+panelX);
		var prepreviousPanel = '.panel'+(panelX-2);
		var previousPanel = '.panel'+(panelX-1);
		var currentPanel = '.panel'+panelX;
		$(currentMenu+" "+prepreviousPanel).removeClass('bl-hide-current-work');
		$(currentMenu+" "+previousPanel).removeClass('bl-show-work').addClass('bl-hide-current-work');
		$(currentMenu+" "+currentPanel).addClass('bl-show-work');

	}
	function ajaxPost(){
		var addListe = $('.addListeForm select').find(":selected").text();
		var addName = $('.addName').val();
		var menu;
		if($('.addMontant').hasClass('montantOnMeDoit')){
			menu = '.onMeDoit';
			var addMontant = $('.addMontant').val();
		} else if($('.addMontant').hasClass('montantJeDois')){
			menu = '.jeDois';
			var addMontant = $('.addMontant').val();
			addMontant = addMontant - (addMontant*2);
		} else { console.log('fail'); }
		
		console.log('addMontant: '+addMontant);
		var datepicker = $('.datepicker').val();
		var addNote = $('.addNote').val();
		console.log('FinalSend');
		console.log(addListe);
		console.log(addName);
		console.log(addMontant);
		console.log(datepicker);
		console.log(addNote);
		$.ajax({
		    url: "functions.php",
		    type: "POST",
		    data: { addListe:addListe, addName:addName, addMontant:addMontant, datepicker:datepicker, addNote:addNote },
		    success: function(html) {
		    	/*console.log(html);*/
		    	mainPrice();
		    	$(menu+' .panel7 .success').html("Cette dette a bien été enregistrée");
		    	$.ajax({
		    	   url: "checkCurrentPrice.php",
		    	   success: function(html){
		    	      console.log(html);
		    	      if(html==''){
		    	         $('.containerTotal .montantTotalChiffre').html('0€');   
		    	      } else {
		    	         $('.containerTotal .montantTotalChiffre').html(html+'€');
		    	      }
		    	   }
		    	});

		    	$.ajax({
		    	   url: 'recapTotal.php',
		    	   cache: false,
		    	   success: function(html){
		    	      $('.containerTotal .recapTot').html(html);
		    	      /*$('.containerTotal .subMenuPerso .deleteMontant').addClass('deleteMontant_opened');*/
		    	      Hammer($('.containerTotal .subMenuPerso')).on("tap",function(e){
		    	         e.preventDefault();
		    	         console.log($(this).find($('.deleteMontant')));
		    	         if($(this).find($('.deleteMontant')).hasClass('deleteMontant_opened')){
		    	            $(this).find($('.deleteMontant')).removeClass('deleteMontant_opened');
		    	         } else {
		    	            $(this).find($('.deleteMontant')).addClass('deleteMontant_opened');
		    	         }
		    	      });
		    	      Hammer($('.containerTotal .subMenuPerso .deleteMontant')).on("tap",function(e){
		    	         e.preventDefault();
		    	            var id = $(this).attr('id');
		    	            id = id.substr(3,4);
		    	               $.ajax({
		    	                  url: "deleteRow.php",
		    	                  type: "POST",
		    	                  data: { id:id },
		    	                  success: function(html){
		    	                     console.log(html)
		    	                     if(html == 'ok'){
		    	                        /*$(this).parent().parent().fadeOut();*/
		    	                        $.ajax({
		    	                           url: "checkCurrentPrice.php",
		    	                           success: function(html){
		    	                              if(html==''){
		    	                                 $('.containerTotal .montantTotalChiffre').html('0€');   
		    	                              } else {
		    	                                 $('.containerTotal .montantTotalChiffre').html(html+'€');
		    	                              }
		    	                              
		    	                           }
		    	                        });
		    	                        recapTotal();
		    	                     } else {
		    	                        console.log('error: '+html);
		    	                     }
		    	                  }
		    	               });
		    	      });
		    	   },
		    	   error: function(XMLHttpRequest, textStatus, errorThrown){
		    	      alert(textStatus);
		    	   }
		    	});


		    	nextPanel(menu);
		    }
		});
	}


	Hammer($('.addChoice li')).on("tap",function(e){
		var addChoiceSelect = $(this).attr('class');
		var currentMenu;
		switch(addChoiceSelect){
			case 'onMeDoitMenu': 
				currentMenu = '.onMeDoit'; 
				$('.bl-panel-items').addClass('onMeDoit');
				/*$('.bl-panel-items h3').append(' onMeDoit');*/
				$('.addMontantForm .addMontant').addClass('montantOnMeDoit');
				break;
			case 'jeDoisMenu': 
				currentMenu = '.jeDois';
				$('.bl-panel-items').addClass('jeDois');
				/*$('.bl-panel-items h3').append(' jeDois');*/
				$('.addMontantForm .addMontant').addClass('montantJeDois');
				break;
			case 'activitesMenu': 
				currentMenu = '.activites';
				$('.bl-panel-items').addClass('onMeDoit');
				/*$('.bl-panel-items h3').append(' onMeDoit');*/
				$('.addMontantForm .addMontant').addClass('montantOnMeDoit');
				break;
		}
		$('.addChoice').removeClass('visible');
		setTimeout(function() {
			$('.addChoice').css({'display':'none'});
		}, 400);   
		
		nextPanel(currentMenu);
	});

	Hammer($('.startX')).on("tap",function(e){
		if ( $(this).hasClass("noClick") ) {
			e.preventDefault; // No spam clic during the animations
		} else {
			var elem = $(this);
			$(this).addClass("noClick");
			setTimeout(function() {
				elem.removeClass("noClick"); 
			}, 500);
			$('.startX').css({'opacity':'0'});
			$('.personalCount').css({'opacity':'0'});

			setTimeout(function() {
				$('.startX').css({'display':'none'});
				$('.personalCount').css({'display':'none'});
			}, 400); 
			panelX = 0;
			menuPanel(panelX);
		}
	});
	Hammer($('.nextStep')).on("tap",function(e){
		if ( $(this).hasClass("noClick") ) {
			e.preventDefault; // No spam clic during the animations
		} else {
			var elem = $(this);
			$(this).addClass("noClick");
			setTimeout(function() {
				elem.removeClass("noClick"); 
			}, 500);
			$('.addChoice').addClass( 'bl-show-work' );
			var currentMenu;
			var addChoiceSelect = $(this).parent().parent().parent().attr('class');
			switch(addChoiceSelect){
				case 'bl-panel-items onMeDoit': currentMenu = '.onMeDoit'; break;
				case 'bl-panel-items jeDois': currentMenu = '.jeDois'; break;
				case 'bl-panel-items activites': currentMenu = '.activites'; break;
			}
			nextPanel(currentMenu);
		}
	})
	/*Hammer($('.startX')).on("tap",function(){
		$('.panel1').addClass( 'bl-show-work' );
		nextPanel();
	});*/
	
	

	
	Hammer($('.back')).on("tap",function(e){
		var currentMenu;
		var addChoiceSelect = $(this).parent().parent().parent().attr('class');
		console.log(addChoiceSelect);
		switch(addChoiceSelect){
			case 'bl-panel-items onMeDoit': currentMenu = '.onMeDoit'; break;
			case 'bl-panel-items jeDois': currentMenu = '.jeDois'; break;
			case 'bl-panel-items activites': currentMenu = '.activites'; break;
		}

		var thisPanel = $(this).parent().parent().removeClass('bl-show-work').attr('class').substr(5,1);
		console.log('panel: '+thisPanel);
		$(currentMenu+' .panel'+(thisPanel-1)).removeClass('bl-hide-current-work').addClass('bl-show-work');
		$(currentMenu+' .panel'+(thisPanel-2)).addClass('bl-hide-current-work');
		if((thisPanel-1) < -1){ thisPanel = 0 };
		panelX = thisPanel - 1;
		if(panelX == 0){
			/*$('.startX').css({'opacity':'1'});*/
			$('.addChoice').css({'display':'block'});
			setTimeout(function() {
				$('.addChoice').addClass('visible');
			}, 400);   
			
			$('.bl-panel-items').removeClass('onMeDoit').removeClass('jeDois');
			/*$('.bl-panel-items h3').append(' onMeDoit');*/
			$('.addMontantForm .addMontant').removeClass('montantOnMeDoit').removeClass('montantJeDois');
		} if(panelX < 0){
				$('.addChoice').removeClass('visible');
			setTimeout(function() {
				$('.addChoice').css({'display':'none'});
			}, 400);   

			$('.startX').css({'opacity':'1'});
			$('.personalCount').css({'opacity':'1'});
			setTimeout(function() {
				$('.startX').css({'display':'block'});
				$('.personalCount').css({'display':'block'});
			}, 400); 
		}
	});

	Hammer($('.pass')).on("tap",function(e){
		e.preventDefault();
		var addListe = $('.addListe').val();
		var addListeSelected = $('.addListeForm select').val();
		var addName = $('.addName').val();
		var addMontant = $('.addMontant').val();
		var datepicker = $('.datepicker').val();
		var addNote = $('.addNote').val();
		if($(this).hasClass('addListeForm')){
			$.ajax({
				url: "checkListe.php",
				type: "POST",
				data: { addListe:addListe },
				success: function(html){
					if(html == 'ok'){
			    		$('.addListeForm .error').html('');
			    		$('.addListeForm select').append('<option value="'+addListe+'" selected >'+addListe+'</option>');
			    		$(".addListeForm select").val(addListe);
			    	} else {
			    		$('.addListeForm .error').html(html);
			    	}
				}
			});
		} else {
			nextPanel(currentMenu);	
		}
	});

	$('.bl-panel-items form').on('submit', function(e){
		e.preventDefault();
		console.log(e);
		var addListe = $('.addListe').val();
		var addListeSelected = $('.addListeForm select').val();
		var addName = $('.addName').val();
		var addMontant = $('.addMontant').val();
		var datepicker = $('.datepicker').val();
		var addNote = $('.addNote').val();
		console.log("addListe: "+addListeSelected);
		console.log("addName: "+addName);
		console.log("addMontant: "+addMontant);
		console.log("datepicker: "+datepicker);
		console.log("addNote: "+addNote);
		if($(this).hasClass('addListeForm')){
			$.ajax({
				url: "checkListe.php",
				type: "POST",
				data: { addListe:addListe },
				success: function(html){
					if(html == 'ok'){
			    		$('.addListeForm .error').html('');
			    		$('.addListeForm select').append('<option value="'+addListe+'" selected >'+addListe+'</option>');
			    		$(".addListeForm select").val(addListe);
			    	} else {
			    		$('.addListeForm .error').html(html);
			    	}
				}
			});
		} else {
			nextPanel(currentMenu);	
		}
		/*$('.recap').html('<table class="tableRecap"><tr><td>Liste</td><td>'+addListeSelected+'</td></tr><tr><td>Prenom</td><td>'+addName+'</td><tr><td>Montant</td><td>'+addMontant+'</td><tr><td>Date Échéance</td><td>'+datepicker+'</td><tr><td>Note</td><td>'+addNote+'</td></table>');
*/
		/*$('.recap').html('<table class="user"><tr><td class="user">'+addName+'</td></tr><tr><td class="UserMontantTotal">'+addMontant+'€</td></tr><tr class="recupInfos"><td class="liste nom">'+addListeSelected+' list</br><i class="fa fa-exclamation-triangle"><span class="returnDate"> '+datepicker+'</span></i></td><td class="note">'+addNote+'</td></table>');*/

		$('.recap').html('<ul class="listeContentRecup"><li>'+addName+'</li><li><span>+</span>'+addMontant+'€</li><li><span>List:</span> '+addListeSelected+'</li><li><span>Callback Date:</span> '+datepicker+'</li><li><span>Note:</span> <p>'+addNote+'</p></li></ul>');
	});



	Hammer($('.panel6 button')).on("tap",function(e){
		ajaxPost();
	});
	
	Hammer($('.btBackStart')).on("tap",function(e){
		$('.panel6').removeClass('bl-hide-current-work');
		$('.panel7').addClass('bl-hide-current-work').removeClass('bl-show-work').delay(200).removeClass('bl-hide-current-work');

		$('.startX').css({'opacity':'1'});
		$('.personalCount').css({'opacity':'1'});
		setTimeout(function() {
			$('.startX').css({'display':'block'});
			$('.personalCount').css({'display':'block'});
		}, 400); 

		$('.bl-panel-items').removeClass('onMeDoit').removeClass('jeDois');
		/*$('.bl-panel-items h3').append(' onMeDoit');*/
		$('.addMontantForm .addMontant').removeClass('montantOnMeDoit').removeClass('montantJeDois');
		$('.addName, .addMontant, .datepicker, .addNote').removeAttr('value');
		panelX = 0;
	});
/*

$('.recap').html('<table class="recapTableau"><tr><td>Liste</td><td>'+addListeSelected+'</td></tr><tr><td>Prenom</td><td>'+addName+'</td><tr><td>Montant</td><td>'+addMontant+'</td><tr><td>Date Échéance</td><td>'+datepicker+'</td><tr><td>Note</td><td>'+addNote+'</td></table>');*/





	/*$('.menu').click(function(e){
		if(($this).hasClass('opened')){
			$(this).removeClass('opened');	
		} else {
			$(this).addClass('opened');
		}	
	});*/

});