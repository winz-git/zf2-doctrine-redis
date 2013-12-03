<?php
/**
 * User.php
 * User: winston.c
 * Date: 03/12/13
 * Time: 10:48 AM
 */

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\DocumentRepository;


/**
 * Class User
 * @ODM\Document(
 *                              collection="user",
 *                              repositoryClass="Application\Model\Document\Repository\UserRepository"
 * )
 * @package Application\Model\Document
 */
class User
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $name;

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param field_type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

} 