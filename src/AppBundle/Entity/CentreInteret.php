<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CentreInteret
 *
 * @ORM\Table(name="centre_interet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CentreInteretRepository")
 */
class CentreInteret
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="CategorieCentreInteret", inversedBy="CentresInterets")
     * @ORM\JoinColumn(name="Categorie_id", referencedColumnName="id")
     */
    private $Categorie;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="GroupCentresInterets")
     */
    private $Photos;
    public function __construct()
    {
        $this->Photos = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }

    /**
     * @param mixed $Categorie
     */
    public function setCategorie($Categorie)
    {
        $this->Categorie = $Categorie;
    }

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        return $this->Photos;
    }

    /**
     * @param mixed $Photos
     */
    public function setPhotos($Photos)
    {
        $this->Photos = $Photos;
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
     * Set titre
     *
     * @param string $titre
     *
     * @return CentreInteret
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CentreInteret
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

