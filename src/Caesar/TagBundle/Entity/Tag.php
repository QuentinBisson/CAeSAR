<?php

namespace Caesar\TagBundle\Entity;

use Caesar\ResourceBundle\Entity\Resource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Caesar\TagBundle\Entity\TagRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="tag")
 */
class Tag {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var  $codeBu
     * @ORM\Column(name="code", type="string",length=20, nullable=true)
     */
    private $code;

    /**
     * @var date $creationDate
     *
     * @ORM\Column(name="creationDate", type="date")
     */
    private $creationDate;

    /** @ORM\PrePersist */
    public function onPrePersist() {
        $this->creationDate = new DateTime("now");
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
     * Set code
     *
     * @param integer $code
     * @return Tag
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set creationDate
     *
     * @param DateTime $creationDate
     * @return Tag
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Set resource
     *
     * @param Resource $resource
     * @return Tag
     */
    public function setResource(Resource $resource = null) {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return Resource
     */
    public function getResource() {
        return $this->resource;
    }

}