<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieCentreInteret
 *
 * @ORM\Table(name="categorie_centre_interet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieCentreInteretRepository")
 */
class CategorieCentreInteret
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
     * @ORM\Column(name="libCat", type="string", length=255)
     */
    private $libCat;
    /**
     * @ORM\OneToMany(targetEntity="CentreInteret", mappedBy="Categorie")
     */
    private $CentresInterets;
    public function __construct()
    {
        $this->CentresInterets = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCentresInterets()
    {
        return $this->CentresInterets;
    }

    /**
     * @param mixed $CentresInterets
     */
    public function setCentresInterets($CentresInterets)
    {
        $this->CentresInterets = $CentresInterets;
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
     * Set libCat
     *
     * @param string $libCat
     *
     * @return CategorieCentreInteret
     */
    public function setLibCat($libCat)
    {
        $this->libCat = $libCat;

        return $this;
    }

    /**
     * Get libCat
     *
     * @return string
     */
    public function getLibCat()
    {
        return $this->libCat;
    }
}

