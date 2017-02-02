<?php namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\DispatchableInterface;
use Zend\View\Model\ViewModel;
use Application\Addons\JsonResponse;
use Application\Model\ModelCatalogo;
use Zend\Session\SessionManager;


class CatalogoController extends AbstractActionController

{

    public function __construct()
    {
        $this->respuesta= new JsonResponse();
        $this->catalogo = new ModelCatalogo();
        $this->sesion = new SessionManager();

    }
    //El index gestiona la interfaz de usuario
    public function indexAction()
    {
        $this->sesion->start();
        $this->sesion->start();
        if($_SESSION['user']) {

        }else{
            $this->redirect()->toRoute('login');
        }
    }
    //Este metodo caga la tabla que corresponde al usuario
    public function tablaAction(){
        $this->sesion->start();
        $id_tienda= $_SESSION['user']['id_tienda'];
        $catalogo=$this->catalogo->getTiendaCatalogo($id_tienda);
        $this->respuesta->datosJSON(10,10,$catalogo);
    }

    //Podemos metodos para guardar editar o modificar productos
    public function guardarProductoAction()
    {
        $data = $this->getRequest()->getPost('datos');
        $clave = $this->catalogo->obtenerProductos($data['clave_producto']);
        if ($clave) {
            $this->respuesta->mensaje("Esta clave ya existe",'error');

        } else {
            $this->catalogo->insertarProducto($data);
            $this->sesion->start();
            $data['id_tienda'] = $_SESSION['user']['id_tienda'];
            $this->catalogo->insertarExistencia($data);
            $this->respuesta->mensaje("Producto Insertado Correctamente",'correcto');
        }


    }
    //Este metodo es exclusivo para destruir la session.
    public function cerrarSessionAction(){
        $this->sesion->destroy();
        $this->redirect()->toRoute('login');
        $this->sesion->destroy();
    }
//Metdodo para agregar las existencias
    public function agregarAction(){
        $data = $this->getRequest()->getPost('datos');
        $existenciaDb = $this->catalogo->obtenerProductosId($data['id_producto']);
        $one=$existenciaDb[0]['existencias'];
        $two=$data['existencias'];
        $resultado=$one+$two;
        $bien=$this->catalogo->actalizarExistencia($resultado,$data['id_producto']);
        if($bien) {
            $this->respuesta->mensaje("!Se agregaron exisencias de prodctos¡", "correcto");
        }else{
            $this->respuesta->mensaje("!Error al agregar existencias¡", "error");

        }
    }
    //metodo para vender y reducir la existencia del producto
    public function venderAction(){
        $data = $this->getRequest()->getPost('datos');
        $existenciaDb = $this->catalogo->obtenerProductosId($data['id_producto']);
        $one=$existenciaDb[0]['existencias'];
        $two=$data['existencias'];
        $resultado=$one-$two;
        $bien=$this->catalogo->actalizarExistencia($resultado,$data['id_producto']);
        if($bien) {
            $this->respuesta->mensaje("!VEnta Exitosa¡", "correcto");
        }else{
            $this->respuesta->mensaje("!Error Al vender¡", "error");

        }
    }

}