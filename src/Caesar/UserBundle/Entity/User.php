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
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.user.codeBu"
     * )
     * @Assert\Regex(
     *  pattern="/^[0-9]*$/", 
     *  match=true, 
     *  message="validation.assert.error.type.regex.user.codeBu")
     */
    private $codeBu;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=100, unique=true)
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.user.username"
     * )
     * @Assert\MinLength(
     *     limit=5,
     *     message="validation.assert.error.type.user.username.below_five"
     * )
     */
    private $username;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.user.password"
     * )
     * @Assert\MinLength(
     *     limit=8,
     *     message="validation.assert.error.type.user.password.below_eight"
     * )
     */
    private $password;

    /**
     *
     * @var type Boolean used to know if a user is identified
     */
    private $identified;

    /**
     *
     * @var type Boolean used to know if a user is authentified
     */
    private $authentified;

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
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.user.email"
     * )
     * @Assert\Email(
     *   message="validation.assert.error.type.user.email.invalid"
     * )
     */
    private $email;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=60)
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.user.name"
     * )     
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="validation.assert.error.type.regex.user.name"
     * )
     *
     */
    private $name;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=50)
     * @Assert\NotBlank(
     *  message="validation.assert.error.type.not_empty.user.firstname"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="validation.assert.error.type.regex.user.firstname"
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
        $this->identified = false;
        $this->authentified = false;
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
     * @Assert\True(message = "validation.assert.error.type.user.password.dont_match")
     */
    public function isPasswordEqualToConfirmationPassword() {
        return ($this->plainPassword === $this->confirmPassword);
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        $roles = array($this->role);
        if ($this->isIdentified()) {
            array_push($roles, $this->role . "_IDENTIFIED");
        }
        if ($this->isAuthentified()) {
            array_push($roles, $this->role . "_AUTHENTIFIED");
        }
        return $roles;
    }

    public function isIdentified() {
        return $this->identified;
    }

    public function setIdentified($identified) {
        $this->identified = $identified;
    }

    public function isAuthentified() {
        return $this->authentified;
    }

    public function setAuthentified($authentified) {
        $this->authentified = $authentified;
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
        $array = array();
        if (isset($this->id)) {
            array_push($array, $this->id);
        }
        if (isset($this->username)) {
            array_push($array, $this->username);
        }
        if (isset($this->password)) {
            array_push($array, $this->password);
        }
        return serialize($array);
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($data) {
        $array = unserialize($data);
        $size = count($array);
        if ($size >= 1) {
            $this->id = $array[0];
            if ($size >= 2) {
                $this->username = $array[1];
                if ($size >= 3) {
                    $this->password = $array[2];
                }
            }
        }
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

    public function getUserDescription() {
        return $this->name . ' ' . $this->firstname . '(' . $this->email . ')';
    }

}
