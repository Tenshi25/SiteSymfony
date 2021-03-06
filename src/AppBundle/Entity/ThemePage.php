<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ThemePage
 *
 * @ORM\Table(name="theme_page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ThemePageRepository")
 */
class ThemePage
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
     * @ORM\Column(name="libTheme", type="string", length=255)
     */
    private $libTheme;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="ThemePage")
     */
    private $Pages;
    public function __construct()
    {
        $this->Pages = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->Pages;
    }

    /**
     * @param mixed $Page
     */
    public function setPage($Pages)
    {
        $this->Pages = $Pages;
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
     * Set libTheme
     *
     * @param string $libTheme
     *
     * @return ThemePage
     */
    public function setLibTheme($libTheme)
    {
        $this->libTheme = $libTheme;

        return $this;
    }

    /**
     * Get libTheme
     *
     * @return string
     */
    public function getLibTheme()
    {
        return $this->libTheme;
    }
}

