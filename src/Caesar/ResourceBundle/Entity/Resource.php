<?php

namespace Caesar\ResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Caesar\ResourceBundle\Entity\ResourceRepository")
 * @ORM\Table(name="resource")
 * @UniqueEntity("nom")
 */
class Resource {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Caesar\ShelfBundle\Entity\Shelf", inversedBy="resources")
     * @ORM\JoinColumn(name="shelf_id", referencedColumnName="id")
     * */
    private $shelf;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set shelf
     *
     * @param \Caesar\ShelfBundle\Entity\Shelf $shelf
     * @return Resource
     */
    public function setShelf(\Caesar\ShelfBundle\Entity\Shelf $shelf = null)
    {
        $this->shelf = $shelf;
    
        return $this;
    }

    /**
     * Get shelf
     *
     * @return \Caesar\ShelfBundle\Entity\Shelf 
     */
    public function getShelf()
    {
        return $this->shelf;
    }
}