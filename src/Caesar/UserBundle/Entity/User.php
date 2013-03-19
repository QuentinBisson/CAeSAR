<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * @ORM\Entity(repositoryClass="Caesar\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNCodeBU", columns={"codeBu"}),
 * @ORM\UniqueConstraint(name="UNUsername", columns={"username"})})
 *
 * @UniqueEntity("codeBu")
 * @UniqueEntity("username")
 */
class User implements UserInterface, EquatableInterface, \Serializable {

  /**
   * @var integer $id
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var int $codeBu
   *
   * @ORM\Column(name="codeBu", type="integer",length=10, unique=true)
   * @Assert\NotBlank()
   * @Assert\Regex("/^[0-9]*$/")
   */
  private $codeBu;

  /**
   * @var string $username
   *
   * @ORM\Column(name="username", type="string", length=100, unique=true)
   * @Assert\NotBlank()
   * @Assert\MinLength(
   *     limit=5,
   *     message="validation.assert.error.type.username"
   * )
   */
  private $username;

  /**
   * @var string $password
   *
   * @ORM\Column(name="password", type="string", length=100)
   * @Assert\MinLength(
   *     limit=8,
   *     message="validation.assert.error.type.password"
   * )
   */
  private $password;

  /**
   * @var string $plainPassword
   *
   * Il ne sera pas ajouté en base de données
   */
  private $plainPassword;

  /**
   * @var string $confirmPassword
   *
   * Il ne sera pas ajouté en base de données
   */
  protected $confirmPassword;

  /**
   * @var string $email
   *
   * @ORM\Column(name="email", type="string", length=100)
   * @Assert\NotBlank()
   * @Assert\Email()
   */
  private $email;

  /**
   * @var string $name
   *
   * @ORM\Column(name="name", type="string", length=60)
   * @Assert\NotBlank()
   *
   * @Assert\Regex(
   *     pattern="/\d/",
   *     match=false,
   *     message="Your name cannot contain a number"
   * )
   *
   */
  private $name;

  /**
   * @var string $firstname
   *
   * @ORM\Column(name="firstname", type="string", length=50)
   * @Assert\NotBlank()
   *
   * @Assert\Regex(
   *     pattern="/\d/",
   *     match=false,
   *     message="Your name cannot contain a number"
   * )
   */
  private $firstname;

  /**
   * @var string $role
   *
   * @ORM\Column(name="role", type="string", length=50)
   */
  private $role;

  /**
   * @ORM\OneToMany(targetEntity="Borrowing", mappedBy="user")
   */
  private $borrowings;

  /**
   * @ORM\OneToMany(targetEntity="Caesar\UserBundle\Entity\BorrowingArchive", mappedBy="user")
   */
  private $borrowingArchives;

  /**
   * @ORM\OneToMany(targetEntity="Caesar\UserBundle\Entity\Reservation", mappedBy="user")
   */
  private $reservations;

  function __construct() {
    $this->borrowings = new \Doctrine\Common\Collections\ArrayCollection();
    $this->borrowingArchives = new \Doctrine\Common\Collections\ArrayCollection();
    $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
  }

  public function getId() {
    return $this->id;
  }

  public function setCodeBu($codeBu) {
    $this->codeBu = $codeBu;

    return $this;
  }

  public function getCodeBu() {
    return $this->codeBu;
  }

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($u) {
    $this->username = $u;
    return $this;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($p) {
    $this->password = $p;
    return $this;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($n) {
    $this->name = $n;
    return $this;
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function setFirstname($f) {
    $this->firstname = $f;
    return $this;
  }

  public function getRole() {
    return $this->role;
  }

  public function setRole($role) {
    $this->role = $role;
    return $this;
  }

  public function getPlainPassword() {
    return $this->plainPassword;
  }

  public function setPlainPassword($plainPassword) {
    $this->plainPassword = $plainPassword;
    return $this;
  }

  public function getConfirmPassword() {
    return $this->confirmPassword;
  }

  public function setConfirmPassword($confirmPassword) {
    $this->confirmPassword = $confirmPassword;
  }

  /**
   * @Assert\True(message = "The password and confirmation password do not match")
   */
  public function isPasswordEqualToConfirmationPassword() {
    return ($this->plainPassword === $this->confirmPassword);
  }

  public function eraseCredentials() {

  }

  public function getRoles() {
    return array($this->role);
  }

  public function getSalt() {
    return '';
  }

  public function isEqualTo(UserInterface $user) {
    return $this->id === $user->getId();
  }

  /**
   * @see \Serializable::serialize()
   */
  public function serialize() {
    return serialize(array(
          $this->id,
      ));
  }

  /**
   * @see \Serializable::unserialize()
   */
  public function unserialize($serialized) {
    list (
      $this->id,
      ) = unserialize($serialized);
  }

  /**
   * Add borrowings
   *
   * @param \Caesar\UserBundle\Entity\Borrowing $borrowings
   * @return User
   */
  public function addBorrowing(\Caesar\UserBundle\Entity\Borrowing $borrowings) {
    $this->borrowings[] = $borrowings;

    return $this;
  }

  /**
   * Remove borrowings
   *
   * @param \Caesar\UserBundle\Entity\Borrowing $borrowings
   */
  public function removeBorrowing(\Caesar\UserBundle\Entity\Borrowing $borrowings) {
    $this->borrowings->removeElement($borrowings);
  }

  /**
   * Get borrowings
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getBorrowings() {
    return $this->borrowings;
  }

  /**
   * Add borrowingArchives
   *
   * @param \Caesar\UserBundle\Entity\BorrowingArchive $borrowingArchives
   * @return User
   */
  public function addBorrowingArchive(\Caesar\UserBundle\Entity\BorrowingArchive $borrowingArchives) {
    $this->borrowingArchives[] = $borrowingArchives;

    return $this;
  }

  /**
   * Remove borrowingArchives
   *
   * @param \Caesar\UserBundle\Entity\BorrowingArchive $borrowingArchives
   */
  public function removeBorrowingArchive(\Caesar\UserBundle\Entity\BorrowingArchive $borrowingArchives) {
    $this->borrowingArchives->removeElement($borrowingArchives);
  }

  /**
   * Get borrowingArchives
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getBorrowingArchives() {
    return $this->borrowingArchives;
  }

  /**
   * Add reservations
   *
   * @param \Caesar\UserBundle\Entity\Reservation $reservations
   * @return User
   */
  public function addReservation(\Caesar\UserBundle\Entity\Reservation $reservations) {
    $this->reservations[] = $reservations;

    return $this;
  }

  /**
   * Remove reservations
   *
   * @param \Caesar\UserBundle\Entity\Reservation $reservations
   */
  public function removeReservation(\Caesar\UserBundle\Entity\Reservation $reservations) {
    $this->reservations->removeElement($reservations);
  }

  /**
   * Get reservations
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getReservations() {
    return $this->reservations;
  }

}