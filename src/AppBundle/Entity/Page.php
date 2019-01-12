<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre",type="string", length=255, nullable=true)
     */
    private $sousTitre1;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraphe1", type="text", nullable=true)
     */
    private $paragraphe1;

    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre2", type="string", length=255, nullable=true)
     */

    private $sousTitre2;


    /**
     * @var string
     *
     * @ORM\Column(name="paragraphe2", type="text", nullable=true)
     */
    private $paragraphe2;

    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre3", type="string", length=255, nullable=true)
     */
    private $sousTitre3;


    /**
     * @var string
     *
     * @ORM\Column(name="paragraphe3", type="text", nullable=true)
     */
    private $paragraphe3;

    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre4", type="text", nullable=true)
     */
    private $sousTitre4;


    /**
     * @var string
     *
     * @ORM\Column(name="paragraphe4", type="text", nullable=true)
     */
    private $paragraphe4;
    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre5", type="text", nullable=true)
     */
    private $sousTitre5;


    /**
     * @var string
     *
     * @ORM\Column(name="paragraphe5", type="text", nullable=true)
     */
    private $paragraphe5;
    /**
     * @var string
     *
     * @ORM\Column(name="sousTitre6", type="text", nullable=true)
     */
    private $sousTitre6;


    /**
     * @var string
     *
     * @ORM\Column(name="paragraphe6", type="text", nullable=true)
     */
    private $paragraphe6;
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
    private $ThemePage;

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
    public function getThemePage()
    {
        return $this->ThemePage;
    }

    /**
     * @param mixed $ThemePage
     */
    public function setThemePage($ThemePage)
    {
        $this->ThemePage = $ThemePage;
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

    /**
     * @return string
     */
    public function getSousTitre1()
    {
        return $this->sousTitre1;
    }

    /**
     * @param string $sousTitre1
     */
    public function setSousTitre1($sousTitre1)
    {
        $this->sousTitre1 = $sousTitre1;
    }

    /**
     * @return string
     */
    public function getParagraphe1()
    {
        return $this->paragraphe1;
    }

    /**
     * @param string $paragraphe1
     */
    public function setParagraphe1($paragraphe1)
    {
        $this->paragraphe1 = $paragraphe1;
    }

    /**
     * @return string
     */
    public function getSousTitre2()
    {
        return $this->sousTitre2;
    }

    /**
     * @param string $sousTitre2
     */
    public function setSousTitre2($sousTitre2)
    {
        $this->sousTitre2 = $sousTitre2;
    }

    /**
     * @return string
     */
    public function getParagraphe2()
    {
        return $this->paragraphe2;
    }

    /**
     * @param string $paragraphe2
     */
    public function setParagraphe2($paragraphe2)
    {
        $this->paragraphe2 = $paragraphe2;
    }

    /**
     * @return string
     */
    public function getSousTitre3()
    {
        return $this->sousTitre3;
    }

    /**
     * @param string $sousTitre3
     */
    public function setSousTitre3($sousTitre3)
    {
        $this->sousTitre3 = $sousTitre3;
    }

    /**
     * @return mixed
     */
    public function getParagraphe3()
    {
        return $this->paragraphe3;
    }

    /**
     * @param mixed $paragraphe3
     */
    public function setParagraphe3($paragraphe3)
    {
        $this->paragraphe3 = $paragraphe3;
    }

}

