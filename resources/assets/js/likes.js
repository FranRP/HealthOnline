$(".like").on('click', function(event) {
    event.preventDefault();
    var consulta = event.target.parentNode.parentNode.dataset['consulta'];
    var isLike = event.target.previousElementSibling == null ? true : false;
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            type: "POST",
            url: "/asignarLike",
            data:{_method:'post', _token:token, isLike: isLike, answerID: consulta},
            success: function(data) 
            {
                

              if (data[0] == 'actualiza') {

                if (data[1] == true) {
                    $(".answer-like-true-"+data[2]).css("color","#45bbce");
                    $(".answer-like-false-"+data[2]).css("color","black");
                } else {
                    $(".answer-like-true-"+data[2]).css("color","black");
                    $(".answer-like-false-"+data[2]).css("color","red");
                }

              } else if (data[0] == 'nuevo') {

                    if (data[1] == true) {
                        $(".answer-like-true-"+data[2]).css("color","#45bbce");
                    } else {
                        $(".answer-like-false-"+data[2]).css("color","red");
                    }

              } else {
                
                $(".answer-like-true-"+data[1]).css("color","black");
                $(".answer-like-false-"+data[1]).css("color","black");

              }
            },
            error: function()
            {
                //TODO controlar los errores
            }
        });
    
    
});