$(document).on('click', 'body', function () {
	if ($('#check-Profesional').prop('checked') ) {
        $('.profesion-form').slideDown();
        $('.localizacion-form').slideUp();
        $("#espec").prop('required',true);
        $("#local").prop('required',false);
        
    } 
    else if ($('#check-Clinica').prop('checked') ){
    	$('.profesion-form').slideDown();
    	$('.localizacion-form').slideDown();
    	$("#espec").prop('required',true);
    	$("#local").prop('required',true);

    	
    }
	else if ($('#check-Usuario').prop('checked') ) {
		$('.profesion-form').slideUp();
		$('.localizacion-form').slideUp()
		$("#espec").prop('required',false);
    	$("#local").prop('required',false);
        
    }
});


$( document ).ready(function() {
	if( $("#check-Profesional:checked").val() != null ){
    	$('.profesion-form').css('display','block');
    	$("#espec").prop('required',true);
	} else if ( $("#check-Clinica:checked").val() != null ){
    	$('.localizacion-form').css('display','block');
    	$('.profesion-form').css('display','block');
    	$("#espec").prop('required',true);
    	$("#local").prop('required',true);
	} else if ( $("#check-Usuario:checked").val() != null ){
    	$('.form-usuario').slideDown();
	}
});


(function($) {
  "use strict"; 

  
  

  
  $('.ver-mas, .saber-mas').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  
  $('body').scrollspy({
    target: '#mainNav',
    offset: 57
  });

  
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
      $(".logo-cabecera").attr("src","/images/corazon-logo-blue.png")
    } else {
      $("#mainNav").removeClass("navbar-shrink");
      $(".logo-cabecera").attr("src","/images/logo-corazon.png")
    }
  };
  
  navbarCollapse();
  
  $(window).scroll(navbarCollapse);

  
  window.sr = ScrollReveal();
  sr.reveal('.sr-icons', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
  }, 200);
  sr.reveal('.sr-button', {
    duration: 1000,
    delay: 200
  });
  sr.reveal('.sr-contact', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
  }, 300);
  sr.reveal('.timeline-panel', {
    duration: 600,
    scale: 0.3,
    distance: '0px',
    reset:true
  });
  sr.reveal('.respuestas-ind', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
  });

$(".ver-mas").click(function(){
    var x = $('.primer-bloque').position();
    x = x.top - 55;
    $("html, body").animate({scrollTop:x+"px"});
});

$(".saber-mas").click(function() {
    var x = $('section.segundo-bloque').position();
    x = x.top - 55;
    $("html, body").animate({scrollTop:x+"px"});
});

$(".footer-scroll-top").click(function() {
  $("html, body").animate({scrollTop:"0px"});
});


})(jQuery); 
