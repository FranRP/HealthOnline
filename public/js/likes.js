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
              console.log(data);
            },
            error: function()
            {
                //TODO controlar los errores
            }
        });
    
    
});