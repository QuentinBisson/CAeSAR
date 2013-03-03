<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Caesar\UserBundle\Entity\ReservationRepository")
 * @ORM\Table(name="reservation"),
 */
class Reservation {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Caesar\ResourceBundle\Entity\Resource", inversedBy="reservations")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     */
    private $resource;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reservations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var date $reservationDate
     * 
     * @ORM\Column(name="reservationDate", type="date")
     */
    private $reservationDate;

    public function getId() {
        return $this->id;
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

    /**
     * Set reservationDate
     *
     * @param \DateTime $reservationDate
     * @return Reservation
     */
    public function setReservationDate($reservationDate)
    {
        $this->reservationDate = $reservationDate;
    
        return $this;
    }

    /**
     * Get reservationDate
     *
     * @return \DateTime 
     */
    public function getReservationDate()
    {
        return $this->reservationDate;
    }
}