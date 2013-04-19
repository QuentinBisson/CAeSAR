<?php

namespace Caesar\ShelfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Caesar\ShelfBundle\Entity\ShelfRepository")
 * @ORM\Table(name="shelf")
 * @UniqueEntity("name")
 */
class Shelf {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * 
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.shelf.name"
     * )
     */
    private $name;

    /**
     * @var string $description
     * 
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.shelf.description"
     * )
     */
    private $description;

    /**
     *
     * @var arrayCollection $resources
     * @ORM\OneToMany(targetEntity="Caesar\ResourceBundle\Entity\Resource", mappedBy="shelf")
     *
     */
    private $resources;

    function __construct() {
        $this->resources = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Shelf
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Shelf
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Add resources
     *
     * @param \Caesar\ResourceBundle\Entity\Resource $resources
     * @return Shelf
     */
    public function addResource(\Caesar\ResourceBundle\Entity\Resource $resources) {
        $this->resources[] = $resources;

        return $this;
    }

    /**
     * Remove resources
     *
     * @param \Caesar\ResourceBundle\Entity\Resource $resources
     */
    public function removeResource(\Caesar\ResourceBundle\Entity\Resource $resources) {
        $this->resources->removeElement($resources);
    }

    /**
     * Get resources
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResources() {
        return $this->resources;
    }

}