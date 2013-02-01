<?php

namespace Caesar\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Caesar\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="UNCodeBU", columns={"codeBu"}),
 * @ORM\UniqueConstraint(name="UNLogin", columns={"login"})})
 * 
 * @UniqueEntity("codeBu")
 * @UniqueEntity("login")
 */
class User {

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
     * @Assert\Type(type="integer", message="La valeur {{ value }} n'est pas un type {{ type }} valide."))
     */
    private $codeBu;

    /**
     * @var string $login
     * 
     * @ORM\Column(name="login", type="string", length=100, unique=true)
     * @Assert\NotBlank()
     */
    private $login;

    /**
     * @var string $motDePasse
     * 
     * @ORM\Column(name="motDePasse", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $motDePasse;

    /**
     * @var string $confirmMotDePasse
     * 
     * Il ne sera pas ajouté en base de données
     */
    protected $confirmMotDePasse;

    /**
     * @var string $email
     * 
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string $nom
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
    private $nom;

    /**
     * @var string $prenom
     * 
     * @ORM\Column(name="prenom", type="string", length=50)
     * @Assert\NotBlank()
     * 
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private $prenom;

    /**
     * @var string $role
     * 
     * @ORM\Column(name="role", type="string", length=50)
     */
    private $role;

    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    /**
     * Set codeBu
     *
     * @param integer $codeBu
     * @return User
     */
    public function setCodeBu($codeBu) {
        $this->codeBu = $codeBu;

        return $this;
    }

    /**
     * Get codeBu
     *
     * @return integer 
     */
    public function getCodeBu() {
        return $this->codeBu;
    }

    public function getConfirmMotDePasse() {
        return $this->confirmMotDePasse;
    }

    public function setConfirmMotDePasse($confirmMotDePasse) {
        $this->confirmMotDePasse = $confirmMotDePasse;
    }

    /**
     * @Assert\True(message = "The password and confirmation password do not match")
     */
    public function isPasswordEqualToConfirmationPassword() {
        return ($this->motDePasse === $this->confirmMotDePasse);
    }

}