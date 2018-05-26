var url = "http://localhost:8000/usuarios";

// eliminar el producto y eliminarlo de la lista

/*
$(document).on('click', '.delete-user', function () {
    var usuario_id = $(this).val();
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(usuario_id);
    $.ajax({
        type: "post",
        url: url + '/' + usuario_id,
        data: {_method: 'delete', _token:token},
        success: function (data) {
            $("#user" + usuario_id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
*/

$(document).ready(function() {
    $('.btn-delete').click(function(e){
        e.preventDefault();
        if ( ! confirm("¿Estas seguro de querer eliminar este usuario?")){
            return false;
        }

        var row = $(this).parents('tr');
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.post(url, form.serialize(), function(result) {
            row.fadeOut();
        });
    });
});