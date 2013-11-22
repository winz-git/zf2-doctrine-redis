<?php
/**
 * ErrorCodesRepository.php
 * User: winston.c
 * Date: 22/11/13
 * Time: 10:46 AM
 */

namespace Application\Model\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class ErrorCodesRepository extends EntityRepository  {

    /**
     * @param int $offset
     * @param int $limit
     * @return Paginator
     */
    public function getPaginator($offset = 0, $limit = 20){
        $dql = "SELECT u FROM Application\Model\Entity\ErrorCodes u ORDER BY u.error_code_id ASC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($limit);
        $query->setFirstResult($offset);

        //cache
        //$query->useResultCache(true, 3600, 'error_codes');

        $paginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($query))
        );

        return $paginator;
    }

} 