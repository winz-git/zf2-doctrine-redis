<?php
/**
 * Stripe.php
 * User: winston.c
 * Date: 09/12/13
 * Time: 12:13 PM
 */

namespace Application\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin


class StripePlugin implements AbstractInterface {

    public function __toString()
    {
        //
        return 'This is my Stripe Plugin';
    }

} 