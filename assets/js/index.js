window.addEventListener("load",function() {
  // Set a timeout...
  setTimeout(function(){
     // Hide the address bar!
     window.scrollTo(0, 1);
  }, 0);
});

$(document).ready(function(){
   // Menu
   $('#header').click(function(){
      if($('.content_menu').hasClass('content_menu_opened')){
         $('.content_menu').delay(200).removeClass('content_menu_opened');
         $('.container').css({'opacity':'1'});
         $('#header').css({'background':'#fff'});
         $('#header h1').css({'color':'#3d3d3d'});
      } else {
         $('.content_menu').addClass('content_menu_opened');
         $('.container').css({'opacity':'0'});
         $('#header').css({'background':'#fb2b69'});
         $('#header h1').css({'color':'#fff'});
      }
   });

   $('.content_menu .basic a').click(function(e){
      e.preventDefault();
      $('.content_menu').delay(200).removeClass('content_menu_opened');
      $('#header').css({'background':'#fff'});
      $('#header h1').css({'color':'#3d3d3d'});
      if($(this).parent().hasClass('addCount')){
         $('.containerTotal').removeClass('containerTotal_opened');
      } else if ($(this).parent().hasClass('accounts')){
         $('.containerTotal').addClass('containerTotal_opened');
      }
      
      
      $('.container').css({'opacity':'1'});
      
      
   });

  

function recapTotal(){
   $.ajax({
      url: 'recapTotal.php',
      cache: false,
      success: function(html){
         $('.containerTotal .recapTot').html(html);
         /*$('.containerTotal .subMenuPerso .deleteMontant').addClass('deleteMontant_opened');*/
         $('.containerTotal .subMenuPerso').click(function(e){
            e.preventDefault();
            /*console.log($(this).find($('.deleteMontant')));*/
            if($(this).find($('.deleteMontant')).hasClass('deleteMontant_opened')){
               $(this).find($('.deleteMontant')).removeClass('deleteMontant_opened');
            } else {
               $(this).find($('.deleteMontant')).addClass('deleteMontant_opened');
            }
         });
         $('.containerTotal .subMenuPerso .deleteMontant').click(function(e){
            e.preventDefault();
               var id = $(this).attr('id');
               id = id.substr(3,4);
                  $.ajax({
                     url: "deleteRow.php",
                     type: "POST",
                     data: { id:id },
                     success: function(html){
                        /*console.log(html)*/
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
                           /*console.log('error: '+html);*/
                        }
                     }
                  });
         });
      },
      error: function(XMLHttpRequest, textStatus, errorThrown){
         alert(textStatus);
      }
   });
};
recapTotal();



   $.ajax({
      url: "checkCurrentPrice.php",
      success: function(html){
         /*console.log(html);*/
         if(html==''){
            $('.containerTotal .montantTotalChiffre').html('0€');   
         } else {
            $('.containerTotal .montantTotalChiffre').html(html+'€');
         }
      }
   });






   function BlockMove(event) {
      event.preventDefault() ;
   }




   $('.content_connexion .blocLogin .sign').click(function(e){
      e.preventDefault();
      $('.containerLogin .content_connexion .blocLogin').css({'opacity':'0','z-index':'-1'});
      $('.containerLogin .content_connexion .blocRegister').css({'display':'block'});
      setTimeout(function() {
         $('.containerLogin .content_connexion .blocLogin').css({'display':'none'});
         $('.containerLogin .content_connexion .blocRegister').css({'opacity':'1','z-index':'10'});
      }, 400);   
   });
   $('.signCancel').click(function(e){
      e.preventDefault();
      $('.containerLogin .content_connexion .blocRegister').css({'opacity':'0','z-index':'-1'});
      $('.containerLogin .content_connexion .blocLogin').css({'display':'block'});
      setTimeout(function() {
         $('.containerLogin .content_connexion .blocRegister').css({'display':'none'});
         $('.containerLogin .content_connexion .blocLogin').css({'opacity':'1','z-index':'10'});
      }, 400);
   });


   $('.content_connexion .connexion').on('submit', function(e){
      e.preventDefault();
         var pseudo = $('.pseudo').val();
         var password = $('.password').val();
            $.ajax({
               url: "login.php",
               type: "POST",
               data: { pseudo:pseudo, password:password },
               success: function(html){
                  /*console.log(html)*/
                  if(html == 'ok'){
                     $.ajax({
                        url: 'private.php',
                        cache: false,
                        success: function(html){
                           $('.containerLogin').fadeOut(function(){
                              $('.containerLogin').css({'opacity':'0','z-index':'-1'});
                              $('.container').html(html).css({'display':'block'});
                              setTimeout(function(){
                                 $('.container').css({'opacity':'1','z-index':'10'});
                                 $('.containerLogin').css({'display':'none'});
                              },400);
                              
                           });
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                           alert(textStatus);
                        }
                     });
                  } else {
                     $('.submit .error').html(html);
                  }
               }
            });
   });
   $('.registration').on('submit',function(e){
      e.preventDefault();
      var pseudo = $('.pseudo').val();
      var mail = $('.mail').val();
      var password = $('.password').val();
      $.ajax({
         url: "register.php",
         type: "POST",
         data: { pseudo:pseudo, mail:mail, password:password },
         success: function(html){
            /*console.log(html);*/
            $('.errorRecap').html(html);
            // back button
         },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            alert(textStatus);
         }
      });
   });
   
});