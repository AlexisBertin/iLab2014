$(document).ready(function(){
	$( ".datepicker" ).datepicker();
	$('#ui-datepicker-div').appendTo('.calendar');
	function mainPrice(){
		/*$('.personalCount')*/
		$.ajax({
			url: "checkCurrentPrice.php",
			success: function(html){
		    	console.log(html);
		    	$('.personalCount').html(html+" €");
			}
		});
	}
	mainPrice();



	var panelX = 0;

	function menuPanel(){
		$('.startX').css({'opacity':'0'}, function(e){ $(this).css({'display':'none'}); });
		$('.personalCount').css({'opacity':'0'}, function(e){ $(this).css({'display':'none'}); });
		$('.addChoice').addClass( 'visible' );
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
		    	nextPanel(menu);
		    }
		});
	}


	$('.addChoice li').click(function(e){
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
		nextPanel(currentMenu);
	});

	$('.startX').click(function(e){
		if ( $(this).hasClass("noClick") ) {
			e.preventDefault; // No spam clic during the animations
		} else {
			var elem = $(this);
			$(this).addClass("noClick");
			setTimeout(function() {
				elem.removeClass("noClick"); 
			}, 500);
			$('.startX').css({'opacity':'0'}, function(e){ $(this).css({'display':'none'}); });
			$('.personalCount').css({'opacity':'0'}, function(e){ $(this).css({'display':'none'}); });
			
			menuPanel();
		}
	});
	$('.nextStep').click(function(e){
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
	
	

	$('.back').click(function(e){
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
			$('.addChoice').addClass('visible');
			$('.bl-panel-items').removeClass('onMeDoit').removeClass('jeDois');
			/*$('.bl-panel-items h3').append(' onMeDoit');*/
			$('.addMontantForm .addMontant').removeClass('montantOnMeDoit').removeClass('montantJeDois');
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
		$('.recap').html('<div class="contentRecup"><table class="user"><tr><td class="user">'+addName+'</td></tr><tr><td class="UserMontantTotal">'+addMontant+'€</td></tr><tr class="recupInfos"><td class="liste nom">'+addListeSelected+' list</br><i class="fa fa-exclamation-triangle"><span class="returnDate"> '+datepicker+'</span></i></td><td class="note">'+addNote+'</td></table></div>');
	});


	$('.panel6 button').click(function(e){
		ajaxPost();
	});
	$('.btBackStart').click(function(){
		$('.panel6').removeClass('bl-hide-current-work');
		$('.panel7').addClass('bl-hide-current-work').removeClass('bl-show-work').delay(200).removeClass('bl-hide-current-work');
		$('.startX').css({'opacity':'1'}, function(e){ $(this).css({'display':'block'}); });
		$('.personalCount').css({'opacity':'1'}, function(e){ $(this).css({'display':'block'}); });
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