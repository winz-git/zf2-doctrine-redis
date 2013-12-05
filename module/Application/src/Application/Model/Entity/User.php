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
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Application\Model\Entity\Repository\UserRepository")
 * @package Application\Model\Entity
 */
class User  {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    protected $user_id;


    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", nullable=true,  length=255, columnDefinition="varchar(255)")
     */
    protected $email;
    /**
     * @ORM\Column(type="string", nullable=true, length=50)
     */
    protected $display_name;

    /**
     * @ORM\Column(type="smallint", columnDefinition="smallint(6)")
     */
    protected $state;


    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername(){
        return $this->username;
    }

}