<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Caesar\UserBundle\Entity\BorrowingRepository")
 * @ORM\Table(name="borrowing"),
 */
class Borrowing {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Caesar\ResourceBundle\Entity\Resource", inversedBy="borrowings")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     */
    private $resource;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="borrowings")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var date $borrowingDate
     * 
     * @ORM\Column(name="borrowingDate", type="date")
     */
    private $borrowingDate;

    public function getId() {
        return $this->id;
    }

    /**
     * Set borrowingDate
     *
     * @param \DateTime $borrowingDate
     * @return Borrowing
     */
    public function setBorrowingDate($borrowingDate) {
        $this->borrowingDate = $borrowingDate;

        return $this;
    }

    /**
     * Get borrowingDate
     *
     * @return \DateTime 
     */
    public function getBorrowingDate() {
        return $this->borrowingDate;
    }


    /**
     * Set resource
     *
     * @param \Caesar\ResourceBundle\Resource $resource
     * @return Borrowing
     */
    public function setResource(\Caesar\ResourceBundle\Entity\Resource $resource = null)
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Get resource
     *
     * @return \Caesar\ResourceBundle\Resource 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set user
     *
     * @param \Caesar\UserBundle\Entity\User $user
     * @return Borrowing
     */
    public function setUser(\Caesar\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Caesar\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}