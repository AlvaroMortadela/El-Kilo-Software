<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\DispatchableInterface;
use Zend\View\Model\ViewModel;
use Application\Addons\JsonResponse;
use Application\Model\ModelCatalogo;
use Zend\Session\SessionManager;

class TiendasController extends AbstractActionController
{

    public function __construct()
    {
        $this->respuesta= new JsonResponse();
        $this->catalogo = new ModelCatalogo();
        $this->sesion = new SessionManager();
    }

    public function indexAction()
    {
        $this->sesion->start();
        if($_SESSION['user']) {

        }else{
            $this->redirect()->toRoute('login');
        }

    }
    public function serviciosAction(){
        echo "hoa mundo";
    }
    //Este metodo caga la tabla que corresponde al usuario
    public function tablaAction(){
        $this->sesion->start();
        $id_tienda= $_SESSION['user']['id_tienda'];
        $catalogo=$this->catalogo->getTiendaTotal($id_tienda);
        $this->respuesta->datosJSON(10,10,$catalogo);
    }


}