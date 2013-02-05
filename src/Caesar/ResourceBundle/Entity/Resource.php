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
     * @ORM\ManyToOne(targetEntity="Caesar\LocationBundle\Entity\Location", inversedBy="resources")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     * */
    private $location;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

}