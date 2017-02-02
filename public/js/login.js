/**
 * Created by josam on 31/01/2017.
 */
$( "body" ).on( "submit","#login-submit", function(evento) {
    evento.preventDefault();
    var url;
    url='login/login';
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        beforeSend: function(){
            //despues de envio
        },
        success: function(respuesta) {
            //Enviamos un mensaje de error
            if(respuesta.tipoMensaje == 'error'){
                swal("¡Ups!", "Datos Incorrectos", "error")
            }else{
                swal("¡Perfecto!", "Bienvenido"+" " + respuesta.mensaje, "success")
                $(location).attr('href','catalogo')
            }
        },
        error: function () {
            swal("¡Ups!", "Hubo un error en tu solicitud", "error")
        }
    });
});