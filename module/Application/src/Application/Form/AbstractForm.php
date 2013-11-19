<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 11:15 AM
 * 
 */

namespace Application\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form as ZendForm;

/**
 * Class AbstractForm
 * @package Application\Form
 */
abstract class AbstractForm extends ZendForm implements ObjectManagerAwareInterface {

    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;

        return $this;
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }
}