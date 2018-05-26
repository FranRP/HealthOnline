$(document).ready(function() {
	$('.btn-preguntar').click(function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var url = form.attr('action');

        console.log($('#pregunta').val());
		if (($('#pregunta').val() != "") && ($('#titulo').val() != ""))
		{
			$.post(url, form.serialize(), function(result) {
           		 console.log('funciona');
       	 	});

       	 	recarga();
		} else {
			if ($('#pregunta').val() == "") {
				$('.alerta-pregunta').css('display','block');
			} if ($('#titulo').val() == "") {
				$('.alerta-titulo').css('display','block');
			}
			
		}

    
    });

});


$("#orden-filtro").change(function() {
	var orden = $("#orden-filtro").val();
	console.log('Este es el orden escogido, fijarse: '+orden);
	$.get('filtrarOrden', { orden: orden}, function(data){
		$('.scroll-block').empty();
		console.log(data);
		var URLactual = window.location.host;
		if(data.response == true)
           {              	
               for(datos in data.questions)
               {
               	  console.log(data.questions[datos].id);
                  $('.scroll-block').append('<div style="padding:10px; border:1px solid black; margin-bottom:10px"><h3><a href="http://'+URLactual+'/usuarios/'+data.questions[datos].user.id+'">'+data.questions[datos].user.name+'</a></h3><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div>');
                  getFirstId = data.questions[0].id;
                  getLastId = data.questions[datos].id;
               }
           }
        $(".lastId").attr("id",getLastId);
        $(".firstId").attr("id",getFirstId);
        moreQuestions = true;

	});

	console.log($("#orden-filtro").val());
});


function recarga() {
	var idprueba = $(".firstId").attr("id");
	var orden = $("#orden-filtro").val();
	$.get('recargaPreguntas', { firstId: idprueba}, function(data){

		var URLactual = window.location.host;

		if((data.response == true) && (orden == 'desc'))
           {              	
               for(datos in data.questions)
               {
               	  console.log(data.questions);
                  $('.scroll-block').prepend('<div style="padding:10px; border:1px solid black; margin-bottom:10px"><h3><a href="http://'+URLactual+'/usuarios/'+data.questions[datos].user.id+'">'+data.questions[datos].user.name+'</a></h3><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div>');
                  getFirstId = data.questions[datos].id;
               }
           } else {
           		if(moreQuestions == false) {
           			moreQuestions = true;
           			$('.alert.alert-info.center').remove();
           		}
           }

        $(".firstId").attr("id",getFirstId);
        console.log('esta es la primera id '+$(".firstId").attr("id",getFirstId));
	});
}




/////////////////////////////////////////////////////////////////7

var moreQuestions, //controlamos si hay posts
    scroll = null;//evitamos que el evento scroll se disparé múltiples veces

var loaderGifActive = false
 
//creamos una función para llamarla en el evento del scroll
function loadMore()
{
    var id = $(".lastId").attr("id"), 
        getLastId, 
        html = "";
    console.log('Esta es la id a mirar '+id);

    var orden = $("#orden-filtro").val();
    console.log('Este es el orden a mirar '+orden);
 
    if (id) 
    {
        $.ajax({
            type: "GET",
            url: "/peticionScroll",
            data: {lastId: id, orden: orden},
            success: function(data) 
            {
            	var URLactual = window.location.host;
            	console.log(URLactual);
            	console.log('mira esto');
            	console.log(data);
             
                if(data.response == true)
                {              	
                for(datos in data.questions)
                {
                   console.log(data.questions);
                   $('.scroll-block').append('<div style="padding:10px; border:1px solid black; margin-bottom:10px"><h3><a href="http://'+URLactual+'/usuarios/'+data.questions[datos].user.id+'">'+data.questions[datos].user.name+'</a></h3><h4><a href="http://'+URLactual+'/preguntas/'+data.questions[datos].id+'">'+data.questions[datos].title+'</a></h4><p>'+data.questions[datos].body+'</p></div>');
                   getLastId = data.questions[datos].id;
                }
                   moreQuestions = true;
            }
               else
               {
                    //ya no hay más posts que mostrar
                    moreQuestions = false;
                 $(".scroll-block").append("<div data-alert class='alert alert-info center'>Ya no hay más posts</div>");  
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
 
//actuamos en en evento del scroll
$(window).on('scroll',function() 
{
  
    //si hay más posts
    if(moreQuestions !== false)
    {
        
        //si scroll es distinto de null
        if (scroll) 
        {
            clearTimeout(scroll); //limpiamos la petición anterior de scroll
        }
        var footerH = $("footer").height() + 50;
        //si el scroll ha llegado al final lanzamos la función loadMore()
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - footerH)
        {
        	$(".before").html("<img style='width:50px; height:50px' src='/images/cargando.gif'/>");
            scroll = setTimeout(function() 
            {
                scroll = null;  //lanzamos de nuevo el scroll
                loadMore();
            }, 1000);
        }
    }
})

//setInterval(function(){ peticionAjax() }, 5000);
