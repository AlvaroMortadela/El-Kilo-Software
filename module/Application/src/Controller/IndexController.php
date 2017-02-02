<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\ModelBuilder;

class IndexController extends AbstractActionController
{

    public function __construct()
    {
        $this->model= new ModelBuilder();
    }

    public function indexAction()
    {

            $this->redirect()->toRoute('login');

    }
    public function serviciosAction(){
        echo "hoa mundo";
    }

}
