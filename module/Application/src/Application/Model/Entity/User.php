<?php
/**
 *
 * User: winston.c
 * Date: 07/11/13
 * Time: 12:08 PM
 * 
 */

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;


/**
 * Class User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Application\Model\Entity\Repository\UserRepository")
 * @package Application\Model\Entity
 */
class User  {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=20, unique=true, nullable=false)
     */
    protected $user_name;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime", nullable=false, columnDefinition="datetime")
     */
    protected $createDate;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_login;

    /**
     * @ORM\Column(type="boolean", columnDefinition="boolean default false")
     */
    protected $is_deleted;

    /**
     * @ORM\Column(type="boolean", columnDefinition="boolean default false")
     */
    protected $is_disabled;


    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    public function getUserName(){
        return $this->user_name;
    }

}