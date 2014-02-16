$(document).ready(function(){
	$( "#datepicker" ).datepicker();
	$('#ui-datepicker-div').appendTo('.calendar');

	var panelX = 0;

	function nextPanel(){
		panelX++;
		if(panelX < 1){ panelX = 0 }
		else if(panelX > 0){
			$('.startX').fadeOut();
		}
		var prepreviousPanel = '.panel'+(panelX-2);
		var previousPanel = '.panel'+(panelX-1);
		var currentPanel = '.panel'+panelX;
		$(prepreviousPanel).removeClass('bl-hide-current-work');
		$(previousPanel).removeClass('bl-show-work').addClass('bl-hide-current-work');
		$(currentPanel).addClass('bl-show-work');
	}
	function ajaxPost(){
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
		    	/*console.log(html);*/
		    	nextPanel();
		    	$('.onMeDoit .panel6 .success').html("Cette dette a bien été enregistrée");
		    }
		});
	}

	
	$('.startX').click(function(){ 
		$('#panel1').addClass( 'bl-show-work' );
		nextPanel();
	});
	/*Hammer($('.startX')).on("tap",function(){
		$('#panel1').addClass( 'bl-show-work' );
		nextPanel();
	});*/

	$('.back').click(function(e){
		var thisPanel = $(this).parent().removeClass('bl-show-work').attr('class').substr(5,1);
		console.log(thisPanel);
		$('.panel'+(thisPanel-1)).removeClass('bl-hide-current-work').addClass('bl-show-work');
		$('.panel'+(thisPanel-2)).addClass('bl-hide-current-work');
		if((thisPanel-1) < -1){ thisPanel = 0 };
		panelX = thisPanel-1;
		if(panelX == 0){ $('.startX').fadeIn(); }
	});

	
	$('.bl-panel-items form').on('submit', function(e){
		e.preventDefault();
		var addName = $('#addName').val();
		var addMontant = $('#addMontant').val();
		var datepicker = $('#datepicker').val();
		var addNote = $('#addNote').val();

		if($(this).hasClass('addNameForm')){
			$.ajax({
			    url: "checkName.php",
			    type: "POST",
			    data: { addName:addName },
			    success: function(html) {
			    	if(html == 'ok'){
			    		$('.addNameForm .error').html('');
			    		nextPanel();
			    	} else {
			    		$('.addNameForm .error').html(html);
			    	}
			    }
			});
		} else {
			nextPanel();	
		}
		$('.onMeDoit .recap').html("<table><tr><td>Prenom</td><td>"+addName+"</td><tr><td>Montant</td><td>"+addMontant+"</td><tr><td>Date Échéance</td><td>"+datepicker+"</td><tr><td>Note</td><td>"+addNote+"</td></table>");
	});


	$('.panel5 button').click(function(){
		ajaxPost();
	});
	$('.btBackStart').click(function(){
		$('.panel5').removeClass('bl-hide-current-work');
		$('.panel6').addClass('bl-hide-current-work').removeClass('bl-show-work').delay(200).removeClass('bl-hide-current-work');
		$('.startX').fadeIn();
		panelX = 0;
	});

});