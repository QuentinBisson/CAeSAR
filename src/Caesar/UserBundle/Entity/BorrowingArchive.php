<?php

namespace Caesar\UserBundle\Entity;

use Caesar\ResourceBundle\Entity\Resource;
use Caesar\UserBundle\Entity\Borrowing;
use Caesar\UserBundle\Entity\BorrowingArchive;
use Caesar\UserBundle\Entity\User;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Caesar\UserBundle\Entity\BorrowingArchiveRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="borrowingArchive"),
 */
class BorrowingArchive {

  /**
   * @var integer $id
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\ManyToOne(targetEntity="Caesar\ResourceBundle\Entity\Resource", inversedBy="borrowingArchives")
   * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
   */
  private $resource;

  /**
   * @ORM\ManyToOne(targetEntity="User", inversedBy="borrowingArchives")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  /**
   * @var date $borrowingDate
   *
   * @ORM\Column(name="borrowingDate", type="date")
   */
  private $borrowingDate;

  /**
   * @var date $returnDate
   *
   * @ORM\Column(name="returnDate", type="date")
   */
  private $returnDate;

  /** @ORM\PrePersist */
  public function onPrePersist() {
    $this->returnDate = new \DateTime("now");
  }

  public function getId() {
    return $this->id;
  }

  /**
   * Set borrowingDate
   *
   * @param DateTime $borrowingDate
   * @return Borrowing
   */
  public function setBorrowingDate($borrowingDate) {
    $this->borrowingDate = $borrowingDate;

    return $this;
  }

  /**
   * Get borrowingDate
   *
   * @return DateTime
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
  public function setResource(Resource $resource = null) {
    $this->resource = $resource;

    return $this;
  }

  /**
   * Get resource
   *
   * @return \Caesar\ResourceBundle\Resource
   */
  public function getResource() {
    return $this->resource;
  }

  /**
   * Set user
   *
   * @param User $user
   * @return Borrowing
   */
  public function setUser(User $user = null) {
    $this->user = $user;

    return $this;
  }

  /**
   * Get user
   *
   * @return User
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * Set returnDate
   *
   * @param DateTime $returnDate
   * @return BorrowingArchive
   */
  public function setReturnDate($returnDate) {
    $this->returnDate = $returnDate;

    return $this;
  }

  /**
   * Get returnDate
   *
   * @return DateTime
   */
  public function getReturnDate() {
    return $this->returnDate;
  }

}