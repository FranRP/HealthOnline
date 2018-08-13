$(document).ready(function() {
    $('.btn-delete').click(function(e){
        e.preventDefault();
        if ( ! confirm("¿Estas seguro de querer eliminar este registro?")){
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