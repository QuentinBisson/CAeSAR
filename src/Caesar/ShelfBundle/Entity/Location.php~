<?php

namespace Caesar\LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Caesar\LocationBundle\Entity\LocationRepository")
 * @ORM\Table(name="location")
 * @UniqueEntity("nom")
 */
class Location {

    /**
     * @var integer $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string $nom
     * 
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string $description
     * 
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $description;

}