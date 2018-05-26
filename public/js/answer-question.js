$(document).ready(function() {
	$('.btn-responder').click(function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var url = form.attr('action');
        var token = $('meta[name="csrf-token"]').attr('content');
        console.log(url);

		if ($('.respuesta-consulta').val() != "")
		{
			$.post(url, form.serialize(), function(result) {
           		 console.log(result);
               location.reload();
      });

       	 	//recarga();
		} else {
      $(".alert-danger strong").html("¡Debes rellenar el campo de respuesta!");
      $(".alert-danger").fadeIn();
    }

       
        
    });

    $(".editar-question").click(function(){
       $(".question-edit").slideDown();
    });

    $(".editar-answer").click(function(){
       var answerID = $(this).attr("id");
       console.log(answerID);
       $("#"+answerID).slideDown();
    });



    $(".reportar-question").on('click', function(event) {
    event.preventDefault();
    questionID = $(this).attr('id');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            type: "POST",
            url: "/reportarQuestion",
            data:{_method:'post', _token:token, questionID: questionID},
            success: function(data) 
            {
              if (data == 'false') {
                $(".alert-report-question").removeClass("alert-success").addClass("alert-warning");
                $(".alert-report-question strong").html("Ya has reportado esta pregunta anteriormente, estamos trabajando en el reporte");
                $(".alert-report-question").slideDown();
                $(".alert-report-question").delay( 3000 ).slideUp( 600 );
              } else {
                $(".alert-report-question").removeClass("alert-warning").addClass("alert-success");
                $(".alert-report-question strong").html("Has realizado el report con éxito. Lo revisaremos lo antes posible");
                $(".alert-report-question").slideDown( 600 );
                $(".alert-report-question").delay( 3000 ).slideUp( 600 );
              }
            },
            error: function()
            {
                //TODO controlar los errores
            }
        });
    
    
    });

    $(".reportar-answer").on('click', function(event) {
    event.preventDefault();
    answerID = $(this).attr('id');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            type: "POST",
            url: "/reportarAnswer",
            data:{_method:'post', _token:token, answerID: answerID},
            success: function(data) 
            {
              if (data == 'false') {
                $(".alert-report-answer").removeClass("alert-success").addClass("alert-warning");
                $(".alert-report-answer strong").html("Ya has reportado esta respuesta anteriormente, estamos trabajando en el reporte");
                $(".alert-report-answer").slideDown();
                $(".alert-report-answer").delay( 3000 ).slideUp( 600 );
              } else {
                $(".alert-report-answer").removeClass("alert-warning").addClass("alert-success");
                $(".alert-report-answer strong").html("Has realizado el report con éxito. Lo revisaremos lo antes posible");
                $(".alert-report-answer").slideDown();
                $(".alert-report-answer").delay( 3000 ).slideUp( 600 );
              }
            },
            error: function()
            {
                //TODO controlar los errores
            }
        });
    
    
    });


    $(".btn-guardar").click(function(e){
      e.preventDefault();
      var userId = $(this).attr('id');
      var questionValue = $('#pregunta').val();
      var form = $(this).parents('form');
      var url = form.attr('action');
      var guardado = [userId, questionValue];
      var token = $('meta[name="csrf-token"]').attr('content');

      if(questionValue != ""){
        $.ajax({
          type: "put",
          url: url,
          data: {_method: 'put', _token:token, question:guardado},
          success: function (data) {
              $('.body-question').html(guardado[1]);
              $(".question-edit").fadeOut();
              $(".alert-fallo-edit").fadeOut();

          },
          error: function (data) {
              $('.alert-fallo-edit').html("Ha ocurrido algún error");
              $('.alert-fallo-edit').fadeIn();
              console.log('Error: No tienes permiso para realizar esta operación, no manipules el html.');
          }
        });

      } else {
        $('.alert-fallo-edit').html("No puedes dejar el cuerpo de la pregunta vacío");
        $('.alert-fallo-edit').fadeIn();
      }
    });


    $(".btn-guardar-answer").click(function(e){
      e.preventDefault();
      var userId = $(this).attr('id');
      var answerID = e.target.parentNode.parentNode.parentNode.dataset['respuesta'];
      var answerValue = $('#respuesta-'+answerID).val();
      var form = $(this).parents('form');
      var url = form.attr('action');
      var guardado = [userId, answerValue];
      var token = $('meta[name="csrf-token"]').attr('content');

      if(answerValue != ""){
        $.ajax({
          type: "put",
          url: url,
          data: {_method: 'put', _token:token, answer:guardado},
          success: function (data) {
              $("#"+data+"body").html(answerValue);
              $("#answer-"+data).slideUp();

          },
          error: function (data) {
              $('.alert-fallo-edit').html("Ha ocurrido algún error");
              $('.alert-fallo-edit').fadeIn();
              console.log('Error: No tienes permiso para realizar esta operación, no manipules el html.');
          }
        });

      } else {
        $('.alert-fallo-edit').html("No puedes dejar el cuerpo de la pregunta vacío");
        $('.alert-fallo-edit').fadeIn();
      }

      
    });


});