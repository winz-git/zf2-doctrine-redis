<?php
/**
 * Authentication
 *
 * User: winston.c
 * Date: 20/11/13
 * Time: 11:42 AM
 */

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Authenticate extends InputFilterAwareInterface {

    public $id;
    public $username;
    public $password;
    public $remember_me;
    public $is_enabled = true;

    protected $inputFilter;

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id']))     ? $data['id']     : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->password  = (isset($data['password']))  ? $data['password']  : null;
        $this->remember_me  = (isset($data['remember_me']))  ? $data['remember_me']  : 0;
        $this->is_enabled  = (isset($data['is_enabled']))  ? $data['is_enabled']  : 0;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }


    public function getInputFilter(){
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();


            $inputFilter->add($factory->createInput(array(
                'name'     => 'username',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'password',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));


            $this->inputFilter = $inputFilter;


        }


        return $this->inputFilter;
    }

} 