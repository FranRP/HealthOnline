$(document).ready(function() {
	$('.btn-preguntar').click(function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var url = form.attr('action');

        
		if ((($('.pregunta-slide').val() != "") && ($('.titulo-slide').val() != "")) || (($('.pregunta-normal').val() != "") && ($('.titulo-normal').val() != "")))
		{
			$.post(url, form.serialize(), function(result) {
           		 $('.pregunta-slide').val("");$('.titulo-slide').val("");$('.pregunta-normal').val("");$('.titulo-normal').val("");
       	 	});
          $('.formulario-consulta-movil label:nth-child(3)').css('background-color','#45bbce');
          $('.formulario-consulta-desktop label:nth-child(3)').css('background-color','#d1ecf1');
          $('.formulario-consulta-movil label:nth-child(1)').css('background-color','#45bbce');
          $('.formulario-consulta-desktop label:nth-child(1)').css('background-color','#d1ecf1');
          $('.formulario-consulta-desktop label:nth-child(3)').css('color','black');
          $('.formulario-consulta-desktop label:nth-child(1)').css('color','black');
       	 	recarga();
		} else {
			if ($('#pregunta').val() == "") {
				$('.formulario-consulta-movil label:nth-child(3)').css('background-color','rgb(183, 2, 2)');
        $('.formulario-consulta-desktop label:nth-child(3)').css('background-color','rgb(183, 2, 2)');
        $('.formulario-consulta-desktop label:nth-child(3)').css('color','white');
			} if ($('#titulo').val() == "") {
				$('.formulario-consulta-movil label:nth-child(1)').css('background-color','rgb(183, 2, 2)');
        $('.formulario-consulta-desktop label:nth-child(1)').css('background-color','rgb(183, 2, 2)');
        $('.formulario-consulta-desktop label:nth-child(1)').css('color','white');
			}
			
		}

    
    });

});


$("#orden-filtro").change(function() {
	var orden = $("#orden-filtro").val();
	
	$.get('filtrarOrden', { orden: orden}, function(data){
    
		$('.scroll-block').empty();
		
		var URLactual = window.location.host;
		if(data.response == true)
           {              	
               for(datos in data.questions)
               {
                if (data.questions[datos].user != null) {
                  $('.scroll-block').append('<div class="container-consultas"><div class="consulta-ind-img"><img src="/uploads/'+data.questions[datos].user.avatar+'" style="width:60px; margin-right: 15px; height:64px;float:left;border-radius:50%;" alt=""></div><div class="consulta-ind"><h3><a href="http://'+URLactual+'/usuarios/'+data.questions[datos].user.id+'">'+data.questions[datos].user.name+'</a></h3><div><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div></div></div>');
                } else {
                  $('.scroll-block').append('<div class="container-consultas"><div class="consulta-ind-img"><img src="/uploads/default_avatar.png" style="width:60px; margin-right: 15px; height:64px;float:left;border-radius:50%;" alt=""></div><div class="consulta-ind"><h3 style="color:red;">Usuario eliminado</h3><div><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div></div></div>');
                }
                  getFirstId = data.questions[0].id;
                  getLastId = data.questions[datos].id;
               }
           } else {
              getFirstId = 0;
              getLastId = 0;
           }
        $(".lastId").attr("id",getLastId);
        $(".firstId").attr("id",getFirstId);
        moreQuestions = true;

	});

	
});


function recarga() {
	var idprueba = $(".firstId").attr("id");
  if (idprueba == undefined) {
    idprueba = 0;
  }
  
	var orden = $("#orden-filtro").val();
	$.get('recargaPreguntas', { firstId: idprueba}, function(data){

		var URLactual = window.location.host;

		if((data.response == true) && (orden == 'desc'))
           {              	
               for(datos in data.questions)
               {
                if (data.questions[datos].user != null) {
                  $('.scroll-block').prepend('<div class="container-consultas"><div class="consulta-ind-img"><img src="/uploads/'+data.questions[datos].user.avatar+'" style="width:60px; margin-right: 15px; height:64px;float:left;border-radius:50%;" alt=""></div><div class="consulta-ind"><h3><a href="http://'+URLactual+'/usuarios/'+data.questions[datos].user.id+'">'+data.questions[datos].user.name+'</a></h3><div><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div></div></div>');
                } else {
                  $('.scroll-block').prepend('<div class="container-consultas"><div class="consulta-ind-img"><img src="/uploads/default_avatar.png" style="width:60px; margin-right: 15px; height:64px;float:left;border-radius:50%;" alt=""></div><div class="consulta-ind"><h3 style="color:red;">Usuario eliminado</h3><div><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div></div></div>');
                }

                  getFirstId = data.questions[datos].id;
               }
           } else {
           		if(moreQuestions == false) {
           			moreQuestions = true;
           			$('.alert.alert-warning.center').remove();
           		}
           }

        $(".firstId").attr("id",getFirstId);

	});
}



var moreQuestions,
    scroll = null;

var loaderGifActive = false
 

function loadMore()
{
    var id = $(".lastId").attr("id"), 
        getLastId, 
        html = "";
    

    if (id == undefined) {
      moreQuestions = false;
      clearTimeout(scroll);
      $(".before").html("");
      $(".scroll-block").append("<div data-alert class='alert alert-warning center'>Ya no hay más consultas</div>"); 
    }

    var orden = $("#orden-filtro").val();
    
 
    if (id) 
    {
        $.ajax({
            type: "GET",
            url: "/peticionScroll",
            data: {lastId: id, orden: orden},
            success: function(data) 
            {
            	var URLactual = window.location.host;
            	
             
                if(data.response == true)
                {              	
                for(datos in data.questions)
                {
                  if (data.questions[datos].user != null) {
                   $('.scroll-block').append('<div class="container-consultas"><div class="consulta-ind-img"><img src="/uploads/'+data.questions[datos].user.avatar+'" style="width:60px; margin-right: 15px; height:64px;float:left;border-radius:50%;" alt=""></div><div class="consulta-ind"><h3><a href="http://'+URLactual+'/usuarios/'+data.questions[datos].user.id+'">'+data.questions[datos].user.name+'</a></h3><div><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div></div></div>');
                  } else {
                   $('.scroll-block').append('<div class="container-consultas"><div class="consulta-ind-img"><img src="/uploads/default_avatar.png" style="width:60px; margin-right: 15px; height:64px;float:left;border-radius:50%;" alt=""></div><div class="consulta-ind"><h3 style="color:red;">Usuario eliminado</h3><div><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div></div></div>');
                  }

                   getLastId = data.questions[datos].id;
                }
                   moreQuestions = true;
            }
               else
               {
                    
                    moreQuestions = false;
                 $(".scroll-block").append("<div data-alert class='alert alert-warning center'>Ya no hay más consultas</div>");  
            }
                $(".lastId").attr("id",getLastId);
                $(".before").html("");
 
            },
            error: function()
            {
                //TODO controlar los errores
            }
        });
    }
}
 

$(window).on('scroll',function() 
{
  
    
    if(moreQuestions !== false)
    {
        
        
        if (scroll) 
        {
            clearTimeout(scroll); 
        }
        var footerH = $("footer").height() + 50;
        
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - footerH)
        {
        	$(".before").html("<img style='width:50px; height:50px' src='/images/cargando.gif'/>");
            scroll = setTimeout(function() 
            {
                scroll = null; 
                loadMore();
            }, 1000);
        }
    }
})


$('.alterna').click(function(e){
    var slideout=document.getElementById("slideout");
    var slideout_inner=document.getElementById("slideout_inner");

    if (slideout.style.right!="285px"){
        slideout.style.right="285px";
        slideout_inner.style.right=0;
    } else {
        slideout.style.right=0;
        slideout_inner.style.right="-285px";
    }
});



