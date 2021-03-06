<?php namespace Application\Addons;


class JsonResponse{

    /* tipoMensaje:CORRECTO,ERROR,ADVERTENCIA,INFORMACION,CONFIRMACION
    */
    static function mensaje($mensaje,$tipoMensaje="CORRECTO",$estatus=200){
        $data = array();
        $data['estatus'] = $estatus;
        $data['mensaje']=$mensaje;
        $data['tipoRespuesta']='MENSAJE';
        $data['tipoMensaje']=$tipoMensaje;
        echo json_encode($data);
        header('Content-type: application/json');
        exit();
    }
    static function mensajeDatosAdicionales($mensaje,$datosAdicionales,$tipoMensaje="CORRECTO",$estatus=200){
        $data = array();
        $data['estatus'] = $estatus;
        $data['mensaje']=$mensaje;
        $data['tipoRespuesta']='MENSAJE';
        $data['tipoMensaje']=$tipoMensaje;
        $data["datosAdicionales"]=$datosAdicionales;
        echo json_encode($data,JSON_NUMERIC_CHECK);
        header('Content-type: application/json');
        exit();
    }

    static function mensajes($mensajes,$tipoMensaje="CORRECTO",$estatus=200){
        $data = array();
        $data['estatus'] = $estatus;
        $data['mensajes']=$mensajes;
        $data['tipoRespuesta']='MENSAJES';
        $data['tipoMensaje']=$tipoMensaje;
        echo json_encode($data);
        header('Content-type: application/json');
        exit();
    }

    static function datosJSON($draw,$total,$data=array()){
        $json_data = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval( $total ),
            "recordsFiltered" => intval( $total ),
            "data"            => $data,
            "estatus"          => 200,
            "tipoRespuesta"          => "DATOS"
        );
        echo json_encode($json_data);
        exit();
    }

    static function redireccion($url,$estatus=200){
        $data = array();
        $data['estatus'] = $estatus;
        $data['url']=$url;
        $data['tipoRespuesta']='REDIRECCION';
        header('Content-type: application/json');
        echo json_encode($data);
        if($estatus==408){
            die();
        }else{exit();}
    }


}