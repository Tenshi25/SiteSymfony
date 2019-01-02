<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 */
class Page
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity="ThemePage", inversedBy="Page")
     * @ORM\JoinColumn(name="Theme_id", referencedColumnName="id")
     */
    private $Categorie;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="GroupPages")
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Page
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
     * @return Page
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
