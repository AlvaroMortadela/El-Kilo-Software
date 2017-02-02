
function tableFull () {

    function format ( d ) {
        console.log(d.matriz)
        if(d.matriz === "SI") {
            var matriz='<td>Matriz, Corporativo</td>'
        }else{
            var matriz='<td>Sucursal: '+d.id_tienda+'</td>'
        }
        // `d` is the original data object for the row
        return '<table class="table-striped">'+
            '<tr>'+
            '<td>Direccio:</td>'+
            '<td>'+d.ubicacion_tienda+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Número:</td>'+
            '<td>'+d.telefono_tienda+'</td>'+
            '</tr>'+
            '<tr>'+ matriz+
            '</tr>'+
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
            "url":"tiendas/tabla"
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

$( "table" ).on( "click", "#borrar-producto", function() {
});
$( "table" ).on( "click", "#editar-producto", function() {

});
/**
 * Created by josam on 02/02/2017.
 */
