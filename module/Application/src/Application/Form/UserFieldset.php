<?php
/**
 * UserFieldset.php
 * User: winston.c
 * Date: 05/12/13
 * Time: 11:45 AM
 */

namespace Application\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;


class UserFieldset extends Fieldset implements \Zend\ModuleManager\Feature\InputFilterProviderInterface{

    public function __construct()
    {
        parent::__construct('user');

        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new \Application\Model\Entity\User());

        $this->setLabel('User');

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Username'
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'options' => array(
                'label' => 'Please enter password',
            ),
            'attributes' => array(
                'required' => 'required'
            )
        ));
    }

    public function getInputFilterSpecification() {

        return array(
            'name' => array(
                'required' => true,
            ),
            'password' => array(
                'required' => true,
                'validators' => array(
                    array('name' => 'not_empty'),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 6
                        )
                    )
                )
            )
        );
    }

} 