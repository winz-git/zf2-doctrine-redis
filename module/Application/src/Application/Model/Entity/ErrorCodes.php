<?php

namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 * ErrorCodes
 *
 * @ORM\Table(name="ErrorCodes")
 * @ORM\Entity(repositoryClass="Application\Model\Entity\Repository\ErrorCodesRepository")
 */
class ErrorCodes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="error_code_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
      *
     */
    private $error_code_id;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $error_code;

    /**
     * @var
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var
     * @ORM\Column(type="string")
     */
    private $explanation;


    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $provider_id;


    /**
     * Get error_code_id
     *
     * @return integer 
     */
    public function getErrorCodeId()
    {
        return $this->error_code_id;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * @return int
     */
    public function getProviderId()
    {
        return $this->provider_id;
    }
}
