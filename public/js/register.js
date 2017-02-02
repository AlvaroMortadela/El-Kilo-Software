/**
 * Created by Josué Saúl Martínez
 */
$( "body" ).on( "submit","#hola", function(evento) {
    evento.preventDefault();
    var url;
    url='register/guardar';
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        beforeSend: function(){
            //despues de envio
        },
        success: function(respuesta) {


            if(respuesta.tipoMensaje == 'error'){
                swal("¡Ups!", "Error en el envío", "error")
            }else{
                swal("¡Perfecto!", "Tu peticion ha sido enviada correctamente!", "success")
            }
        },
            error: function () {
                swal("¡Ups!", "Hubo un error en tu solicitud", "error")
            }
    });
});
$(function () {

    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.nombre+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.a_paterno+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
            '</tr>'+
            '</table>';
    }
    var table= $('#jsontable').DataTable({
        "ajax": {
            "dataType": 'json',
            "contentType": "application/json; charset=utf-8",
            "type": "POST",
            "processing": true,
            "serverSide": true,
            "url":"register/tabla"
        },
        "columns": [
            { "data": "nombre" },
            { "data": "a_paterno" },
            { "data": "a_materno" }

        ],
        "createdRow": function ( row, data) {
            if (data.a_paterno === "Martinez") {
                $(row).addClass('details-control');
            }
        }
    });
    $('tbody').on('click', 'tr.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

});

