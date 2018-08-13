$('.btn-preguntar').click(function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var url = form.attr('action');
        

		if (($('#destinatario').val() != "") && ($('#asunto').val() != "") && ($('#body').val() != ""))
		{
			$.post(url, form.serialize(), function(result) {
				
        var nhijos = $('.mensajes-enviados .correo-ind').length;
        
        var URLactual = window.location.host;
           		 if (result == 'false') {
           		 	$(".alert-destinatario strong").html("No se ha encontrado el destinatario");
           		 	$(".alert-destinatario").slideDown();
           		 	$(".alert-destinatario").delay( 2000 ).slideUp( 600 );
           		 } else if (result == 'same-nick') {
           		 	$(".alert-destinatario strong").html("No puedes enviarte mensajes a ti mismo");
           		 	$(".alert-destinatario").slideDown();
           		 	$(".alert-destinatario").delay( 2000 ).slideUp( 600 );
           		 } else {
           		 	$(".alert-destinatario").slideUp();
           		 	$(".alert-exito").slideDown();
           		 	$(".alert-exito").delay( 2000 ).slideUp( 600 );
                if (nhijos == 5) {
                  if ($(".mensajes-enviados ul.pagination").length) {
                    if($(".mensajes-enviados .pagination .page-item.active span").html() == 1) {
                      $("div.correo-ind").last().remove();
                    }
                    
                  } else {
                    $("div.correo-ind").last().remove();
                    $(".mensajes-enviados").append('<ul class="pagination"><li class="page-item disabled"><span class="page-link">&lsaquo;</span></li><li class="page-item active"><span class="page-link">1</span></li><li class="page-item"><a class="page-link" href="http://'+URLactual+'/correos?enviados=2">2</a></li><li class="page-item"><a class="page-link" href="http://'+URLactual+'/correos?enviados=2" rel="next">&rsaquo;</a></li></ul>');
                  }
                  
                }
                if (($(".mensajes-enviados .pagination .page-item.active span").html() == 1) || ($(".mensajes-enviados ul.pagination").length == 0) ) {
                    $(".sin-registro").remove();
                    $(".mensajes-enviados").prepend('<div class="correo-ind"><h5>Destinatario: <a href="http://'+URLactual+'/usuarios/'+result[1][0].id+'">'+$('#destinatario').val()+'</a></h5><p>Fecha:'+result[2].created_at+'</p><p>Asunto: <a style="cursor:pointer;" class="asunto-message" data-toggle="modal" data-target="#modal'+result[2].id+'" role="button">'+result[2].asunto+'</a></p><p><span style="font-weight: bold;">Mensaje: </span>'+result[2].body+'</p><div class="modal fade" id="modal'+result[2].id+'"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">'+result[2].asunto+'</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body">'+result[2].body+'</div></div></div></div><hr style="max-width: inherit !important;"></div>');
                    $('#destinatario').val("");$('#asunto').val("");$('#body').val("");
                }
           		  
               }
       	 	});

		} else {
			if ($('#destinatario').val() == "") {
				$('.alerta-destinatario').slideDown();
			} if ($('#asunto').val() == "") {
				$('.alerta-asunto').slideDown();
			} if ($('#body').val() == "" ) {
				$('.alerta-body').slideDown();
			}
			
		}

    
    });



$(".btn-enviar-mensaje").click(function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var url = form.attr('action');

        if ( ($("#asunto").val() != "") && ($("#body").val() != "") ) {

            $.post(url, form.serialize(), function(result) {
              $('#destinatario').val("");$('#asunto').val("");$('#body').val("");
              $(".asunto-danger").css("background-color","#15a4bb");
              $(".cuerpo-danger").css("background-color","#15a4bb");
              $(".alert-mensaje-enviado-perfil").slideDown();
              $(".alert-mensaje-enviado-perfil").delay( 3000 ).slideUp( 600 );
            });

        } else {

          if ($("#asunto").val() == "") {

            $(".asunto-danger").css("background-color","#b70202");

          } if ($("#body").val() == "") {

            $(".cuerpo-danger").css("background-color","#b70202");

          }
        }

        
});