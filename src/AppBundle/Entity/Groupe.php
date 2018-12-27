<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupeRepository")
 */
class Groupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="TypeGroupe", inversedBy="groups")
     * @ORM\JoinColumn(name="typeGroup_id", referencedColumnName="id")
     */
    private $typeGroup;

    /**
     * @return mixed
     */
    public function getTypeGroup()
    {
        return $this->typeGroup;
    }


    /**
     * @param mixed $typeGroup
     */
    public function setTypeGroup($typeGroup)
    {
        $this->typeGroup = $typeGroup;
    }



    /**
     * @ORM\OneToMany(targetEntity="FairePartiStatut", mappedBy="groupe")
     */
    private $personneStatuts;

    public function __construct()
    {
        $this->personneStatuts = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPersonneStatuts()
    {
        return $this->personneStatuts;
    }

    /**
     * @param mixed $personneStatuts
     */
    public function setPersonneStatuts($personneStatuts)
    {
        $this->personneStatuts = $personneStatuts;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Groupe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}

