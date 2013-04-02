<?php

namespace Caesar\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
    $this->creationDate = new \DateTime("now");
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
   * @param \DateTime $creationDate
   * @return Tag
   */
  public function setCreationDate($creationDate) {
    $this->creationDate = $creationDate;

    return $this;
  }

  /**
   * Get creationDate
   *
   * @return \DateTime
   */
  public function getCreationDate() {
    return $this->creationDate;
  }

  /**
   * Set resource
   *
   * @param \Caesar\ResourceBundle\Entity\Resource $resource
   * @return Tag
   */
  public function setResource(\Caesar\ResourceBundle\Entity\Resource $resource = null) {
    $this->resource = $resource;

    return $this;
  }

  /**
   * Get resource
   *
   * @return \Caesar\ResourceBundle\Entity\Resource
   */
  public function getResource() {
    return $this->resource;
  }

}