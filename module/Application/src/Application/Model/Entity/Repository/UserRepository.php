<?php
/**
 * UserRepository
 *
 * User: winston.c
 * Date: 21/11/13
 * Time: 3:44 PM
 */

namespace Application\Model\Entity\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {

    public function getUsers($number = 10) {
        $dql = "SELECT u FROM Application\Model\Entity\User u ORDER BY u.id DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getResult();
    }

} 