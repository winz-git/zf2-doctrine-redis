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
use Application\Form\LoginForm;
use Zend\Http\Request;
use Zend\View\Model\ViewModel;
use Application\Model\Entity\User;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM;


class AuthController extends BaseController {

    public function indexAction(){

        $users = $this->getEntityManager()->getRepository('Application\Model\Entity\User')->getUsers();

        $form = new LoginForm();
        $mode = "test";

        //assign hydrator
        $hydrator = new DoctrineHydrator($this->getEntityManager(), '\Application\Model\Entity\User');
        $form->setHydrator($hydrator)->setObject(new User());

        //$form->bind($users);
        $request = $this->getRequest();
        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                if($mode == "add") {
                    $this->getEntityManager()->persist($users);
                    $msg = 'insert';
                } else {
                    $msg = 'update';
                }
                $this->getEntityManager()->flush();

                $this->FlashMessenger()->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
                   ->addMessage($msg);
                return $this->redirect()->toRoute('');
            }
        }


        return array(
            'form' => $form,
        );
    }

    public function registerAction() {
        //
    }

    public function loginAction() {
        //
    }
}