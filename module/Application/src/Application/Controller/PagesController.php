<?php
/**
 * PagesController.php
 * User: winston.c
 * Date: 05/12/13
 * Time: 4:29 PM
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;

use Application\Controller\BaseController;

class PagesController extends BaseController {

    public function termsAction() {
        //

        $view = new ViewModel();
        $view->setTemplate('application/static/terms');

        return $view;
    }

    public function privacyPolicyAction() {
        //
        $view = new ViewModel();
        $view->setTemplate('application/static/privacy-policy');

        return $view;
    }

    public function aboutAction() {
        //
        $view = new ViewModel();
        $view->setTemplate('application/static/about');

        return $view;
    }

    public function contactAction() {
        //
        $view = new ViewModel();
        $view->setTemplate('application/static/contact');

        return $view;
    }

} 