<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Paginator\Adapter\Iterator;
use Zend\View\Model\ViewModel;

use Application\Controller\BaseController;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use Application\Model\Entity\ErrorCodes;

class IndexController extends BaseController
{


    public function indexAction()
    {
        $page = $this->params('id');
        $app_config = json_decode(json_encode($this->getServiceLocator()->get('config')));
        //var_dump($app_config->app_settings);
        $max = $app_config->app_settings->navigation->records_per_page;


        //-approach 1, WORKING
        //$repository = $this->getEntityManager()->getRepository('\Application\Model\Entity\ErrorCodes');
        //$result = $repository->createQueryBuilder('a')->getQuery()->getResult();
        //$qry = $repository->createQueryBuilder('a')->getQuery();

        //-approach 2, WORKING
//        $qry = $this->getEntityManager()->createQueryBuilder()
//                                        ->select('a')
//                                        ->from('\Application\Model\Entity\ErrorCodes', 'a')
//                                        ->where('a.error_code >=:error_code')
//                                        ->setParameter('error_code','12040002')
//                                        ->getQuery();

        //$result = $qry->getResult();

        //-approach 3,


        // how to cache the result
        //$qry->useResultCache(true, 3600, 'error_codes');
        //$result = $qry->getResult();



        //foreach($result as $key => $data){
        //   echo "result $key =" . print_r($data->getErrorCode(), true) . "\n" . PHP_EOL ;
        //}

        //using paginator
        // Create the paginator itself
//        $paginator = new Paginator(
//            new DoctrinePaginator(new ORMPaginator($qry))
//        );
//
//        $paginator
//            ->setCurrentPageNumber(1)
//            ->setItemCountPerPage(5);

        $view = new ViewModel();

        //-other way of using paginator
        //$results = $this->getEntityManager()->getRepository('Application\Model\Entity\ErrorCodes')->getPaginator(($page - 1) * 20, $max);
        $paginator = $this->getEntityManager()->getRepository('Application\Model\Entity\ErrorCodes')->getPaginator(($page - 1) * $max, $max);

        $paginator->setCurrentPageNumber($page);
       // $paginator->setItemCountPerPage(3); //default 10
        $paginator->setPageRange($app_config->app_settings->navigation->page_in_range);


        $view->setVariable('paginator', $paginator);
        $view->setVariable('page', $page);
        $view->setVariable('scrolling_style', $app_config->app_settings->navigation->scrolling_style);

        return $view;
    }


}
