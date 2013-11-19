<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 10:10 AM
 * 
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

abstract class BaseController extends AbstractActionController {

    protected $entityManager;


    public function setEntityManager(EntityManager $em) {
        $this->entityManager = $em;
        return $this;
    }

    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));//Doctrine\ORM\EntityManager
        }
        return $this->entityManager;
    }


}