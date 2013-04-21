<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Caesar\UserBundle\Entity\SubscriptionRepository")
 * @ORM\Table(name="subscription"),
 */
class Subscription {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Caesar\ResourceBundle\Entity\Resource", inversedBy="subscriptions")
     * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     */
    private $resource;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="subscriptions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set resource
     *
     * @param \Caesar\ResourceBundle\Entity\Resource $resource
     * @return Subscription
     */
    public function setResource(\Caesar\ResourceBundle\Entity\Resource $resource = null)
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Get resource
     *
     * @return \Caesar\ResourceBundle\Entity\Resource 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set user
     *
     * @param \Caesar\UserBundle\Entity\User $user
     * @return Subscription
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