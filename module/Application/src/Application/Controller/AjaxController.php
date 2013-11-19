<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 10:04 AM
 * 
 */

namespace Application\Controller;


use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class AjaxController extends BaseController {

    protected $viewModel;

    public function indexAction(){

        $this->viewModel = new ViewModel( array(
                'response' => \Zend\Json\Json::encode(array('params1'=>1,'params2'=>2))
            )
        );
        $this->viewModel->setTemplate('application/ajax/response');
        $this->viewModel->setTerminal(true);

        return $this->viewModel;
    }




}