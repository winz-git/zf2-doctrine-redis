<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 11:23 AM
 * 
 */

namespace Application\Form;

use Application\Form\AbstractForm;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoginForm extends AbstractForm {

    public function init() {

       $this->add(array(
           'name' => 'user',
           'type' => 'Application\Form\UserFieldset'

       ));

        //$this->setInputFilter($this->createInputFilter());
    }

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
    }






}