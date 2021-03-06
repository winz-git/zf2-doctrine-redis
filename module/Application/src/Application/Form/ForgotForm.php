<?php
/**
 * ForgotForm.php
 * User: winston.c
 * Date: 06/12/13
 * Time: 5:58 PM
 */

namespace Application\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class ForgotForm extends  AbstractForm {




    public function __construct($name = null, $options = array()) {

        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Email Recovery',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
        ));
        //
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'class' => 'btn btn-primary',
                'id' => 'submitbutton',
            ),
        ));

        $this->setInputFilter($this->createInputFilter());

    }

    public function createInputFilter()
    {
        $inputFilter = new InputFilter();


        // name Input
        $nameFilter = new Input('email');
        $nameFilter->setRequired(true);
        $nameFilter->getFilterChain()->attach(new StringTrim());
        $nameFilter->getFilterChain()->attach(new StripTags());
        $inputFilter->add($nameFilter);

        return $inputFilter;
    }


} 