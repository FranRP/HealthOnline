$(document).on('click', 'body', function () {
	if ($('#check-Profesional').prop('checked') ) {
        $('.profesion-form').fadeIn();
        $('.localizacion-form').fadeOut();
        $("#espec").prop('required',true);
        $("#local").prop('required',false);
        console.log($('#check-Profesional').attr('value'));
    } 
    else if ($('#check-Clinica').prop('checked') ){
    	$('.profesion-form').fadeIn();
    	$('.localizacion-form').fadeIn();
    	$("#espec").prop('required',true);
    	$("#local").prop('required',true);

    	console.log($('#check-Clinica').attr('value'));
    }
	else if ($('#check-Usuario').prop('checked') ) {
		$('.profesion-form').fadeOut();
		$('.localizacion-form').fadeOut()
		$("#espec").prop('required',false);
    	$("#local").prop('required',false);
        console.log($('#check-Usuario').attr('value'));
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
    	$('.form-usuario').fadeIn();
	}
});


(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  

  // Closes responsive menu when a scroll trigger link is clicked
  $('.ver-mas, .saber-mas').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 57
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Scroll reveal calls
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


})(jQuery); // End of use strict
