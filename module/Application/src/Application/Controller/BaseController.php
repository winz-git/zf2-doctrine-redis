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
use Doctrine\ODM\MongoDB\DocumentManager;

abstract class BaseController extends AbstractActionController {

    protected $entityManager;

    protected $adapter;

    protected $documentManager;


    public function setDocumentManager(DocumentManager $dm) {
        $this->documentManager = $dm;
        return $this;
    }

    public function getDocumentManager() {
        if (null === $this->documentManager) {
            $this->setDocumentManager($this->getServiceLocator()->get('doctrine.documentmanager.odm_default'));
        }
        return $this->documentManager;
    }


    public function setEntityManager(EntityManager $em) {
        $this->entityManager = $em;
        return $this;
    }

    public function getEntityManager() {
        if (null === $this->entityManager) {
            $this->setEntityManager($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'));//Doctrine\ORM\EntityManager
        }
        return $this->entityManager;
    }

    public function getConfig(){
        return $this->getServiceLocator()->get('config');
    }

    public function getViewHelper(){
        return $this->getServiceLocator()->get('viewHelperManager');
    }

    public function getAdapter()
    {
        if (!$this->adapter) {
            $sm = $this->getServiceLocator();
            $this->adapter = $sm->get('Zend\Db\Adapter\Adapter');
        }
        return $this->adapter;
    }


}