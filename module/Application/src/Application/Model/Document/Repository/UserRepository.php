<?php
/**
 * UserRepository.php
 * User: winston.c
 * Date: 03/12/13
 * Time: 12:08 PM
 */

namespace Application\Model\Document\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;

class UserRepository extends DocumentRepository {

    public function findAllUsers($number = 10) {
        return $this->createQueryBuilder()
                      ->select('name')
                      ->limit($number)
                      ->getQuery()
                      ->execute();

    }
} 