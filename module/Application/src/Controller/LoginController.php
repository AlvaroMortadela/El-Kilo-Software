<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\View\Model\ViewModel;
use Application\Model\ModelUsuario;
use Application\Addons\JsonResponse;
use Zend\Session\SessionManager;


class LoginController extends AbstractActionController
{
    public function __construct()
    {
        $this->respuesta= new JsonResponse();
        $this->sesion = new SessionManager();

    }

    public function indexAction()
    {


    }
    public function loginAction()
    {
        $received = $this->getRequest()->getPost('datos');
        $query= new ModelUsuario();
        $data=$query->getUser($received);
        if($data){
            $this->sesion->start();
            $_SESSION['true']='correcto';
            $_SESSION['user']=$data[0];
            $this->respuesta->mensaje($_SESSION['user']['nombre'],'correcto');
        }else{
            $this->respuesta->mensaje("Erro al autenticar", 'error');
            $this->sesion->start();
            $this->sesion->destroy();
        }
    }
}
