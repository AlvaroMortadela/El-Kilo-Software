$( "body" ).on( "submit","#producto", function(evento) {
    evento.preventDefault();
    var url;
    url='catalogo/guardarProducto';
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        beforeSend: function(){
            //despues de envio
        },
        success: function(respuesta) {


            if(respuesta.tipoMensaje == 'error'){
                swal("¡Ups!", respuesta.mensaje, "error")
            }else{
                swal("¡Perfecto!", respuesta.mensaje, "success")
            }
        },
        error: function () {
            swal("¡Ups!", respuesta.mensaje, "error")
        }
    });
});

function tableFull () {

    function format ( d ) {
        console.log(d.matriz)
        if(d.matriz === "SI") {
            var matriz='<td>Matriz, Corporativo</td>'
        }else{
            var matriz='<td>Sucursal: '+d.id_tienda+'</td>'
        }
        // `d` is the original data object for the row
        return '<div class="card__body alert--dark"  >'+
            '<form role="form" id="ad-existencia" method="post">'+
            '<input type="hidden" name="datos[id_producto]"class="form-control" value="'+d.id_producto+'" placeholder="Nombre del Producto">'+
            '<div class="form-group" >'+
            '<input type="number" name="datos[existencias]"class="form-control" placeholder="Introducir nueva existencia">'+
            '</div>'+
            '<button type="submit" class="btn btn-success" id="agregar-producto">Agregar Existencia</button>'+
            '</form>'+

            '<form role="form" id="sell" method="post">'+
            '<input type="hidden" name="datos[id_producto]"class="form-control" value="'+d.id_producto+'" placeholder="Nombre del Producto">'+
            '<div class="form-group" >'+
            '<h2><input type="number" name="datos[existencias]" class="form-control alert--dark" placeholder="Introducir Numero a vender"></h2>'+
            '</div>'+
        '<button type="submit" class="btn btn-primary" id="vender-producto">Vender</button>'+
                '</form>'+
            '</div>';
    }
    var table= $('#jsontable').DataTable({
        "ajax": {
            "dataType": 'json',
            "contentType": "application/json; charset=utf-8",
            "type": "POST",
            "processing": true,
            "serverSide": true,
            "url":"catalogo/tabla"
        },
        "columns": [

            { "data": "clave_producto" },
            { "data": "nombre_producto" },
            { "data": "nombre_tienda" },
            { "data": "precio_producto" },
            { "data": "existencias" }

        ],
        "createdRow": function ( row, data) {
            if (data) {
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
}

$( document ).ready(function() {
   tableFull()
});

$( "table" ).on( "submit", "#ad-existencia", function(evento) {
    evento.preventDefault();
    evento.preventDefault();
    var url;
    url='catalogo/agregar';
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
                swal("¡Perfecto!", respuesta.mensaje, "success")
                location.reload();
            }
        },
        error: function () {
            swal("¡Ups!", "Hubo un error en tu solicitud", "error")
        }
    });
});
$( "table" ).on( "submit", "#sell", function(evento) {
    evento.preventDefault();
    evento.preventDefault();
    var url;
    url='catalogo/vender';
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        beforeSend: function(){
            //despues de envio
        },
        success: function(respuesta) {


            if(respuesta.tipoMensaje == 'error'){
                swal("¡Ups!", "Error En la venta", "error")
            }else{
                swal("¡Perfecto!", respuesta.mensaje, "success")
                location.reload();
            }
        },
        error: function () {
            swal("¡Ups!", "Hubo un error en tu solicitud", "error")
        }
    });

});





