<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BaseController;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class IndexController extends BaseController
{


    public function indexAction()
    {

        //-approach 1, WORKING
        $repository = $this->getEntityManager()->getRepository('\Application\Model\Entity\ErrorCodes');
        //$result = $repository->createQueryBuilder('a')->getQuery()->getResult();
        $qry = $repository->createQueryBuilder('a')->getQuery();

        //-approach 2, WORKING
//        $qry = $this->getEntityManager()->createQueryBuilder()
//                                        ->select('a')
//                                        ->from('\Application\Model\Entity\ErrorCodes', 'a')
//                                        ->where('a.error_code >=:error_code')
//                                        ->setParameter('error_code','12040002')
//                                        ->getQuery();

        //$result = $qry->getResult();

        // how to cache the result
        $qry->useResultCache(true, 3600, 'error_codes');
        $result = $qry->getResult();



        //foreach($result as $key => $data){
        //   echo "result $key =" . print_r($data->getErrorCode(), true) . "\n" . PHP_EOL ;
        //}

        //using paginator
        // Create the paginator itself
        $paginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($qry))
        );

        $paginator
            ->setCurrentPageNumber(1)
            ->setItemCountPerPage(5);



        return new ViewModel(array('result' => $result, 'paginator'=>$paginator));
    }

}
