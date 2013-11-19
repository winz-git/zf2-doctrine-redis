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

class Login extends AbstractForm {

    public function init() {
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $name = new Element\Text('name');
        $name->setOptions( array('label' => 'Kategoriebezeichnung'));
        $this->add($name);

        $this->add(array(
            'name' => 'parent',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => "übergeordnete Kategorie",
                'empty_option'    => '',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Application\Model\Entity\Category',
                'property' => 'name',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        $this->setInputFilter($this->createInputFilter());
    }

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
    }



}