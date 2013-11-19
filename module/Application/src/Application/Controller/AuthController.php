<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 11:45 AM
 * 
 */

namespace Application\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;


class AuthController extends BaseController {

    public function indexAction(){

        $form = new \Application\Form\Login();

        return new ViewModel(array('form' => $form));
    }
}