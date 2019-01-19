<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="lienPhoto", type="string", length=255, nullable=true)
     * Assert\NotBlank(message="Ajouter une photo")
     * Assert\Image()
     */
    private $lienPhoto;

    /**
     * @ORM\ManyToOne(targetEntity="CentreInteret", inversedBy="Photos")
     * @ORM\JoinColumn(name="centreInteret_id", referencedColumnName="id")
     */
    private $CentreInteret;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="Photos")
     * @ORM\JoinColumn(name="GroupPages_id", referencedColumnName="id")
     */
    private $GroupPages;

    /*
    * @Assert\File(maxSize="500k")
    */
    public $file;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getCentreInteret()
    {
        return $this->CentreInteret;
    }

    /**
     * @param mixed $CentreInteret
     */
    public function setCentreInteret($CentreInteret)
    {
        $this->CentreInteret = $CentreInteret;
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
     * @return string
     */
    public function getLienPhoto()
    {
        return $this->lienPhoto;
    }

    /**
     * @param string $lienPhoto
     */
    public function setLienPhoto($lienPhoto)
    {
        $this->lienPhoto = $lienPhoto;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Photo
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
     * @return mixed
     */
    public function getGroupPages()
    {
        return $this->GroupPages;
    }

    /**
     * @param mixed $GroupPages
     */
    public function setGroupPages($GroupPages)
    {
        $this->GroupPages = $GroupPages;
    }

    public function getUploadWebpath()
    {
        return null===$this->lienPhoto ? null : $this->getUploadDir().'/'.$this->lienPhoto;
    }
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
    public function getUploadDir()
    {
        return 'uploads/photo';
    }

    public function uploadProfilePicture()
    {
        if($this->file != null){
            $fileName=$this->file->getClientOriginalName();
            try {

                $this->file->move($this->getUploadRootDir(), $fileName);
                $this->lienPhoto=$this->file->getClientOriginalName();
                $this->file=null;
            }catch (FileException $e) {

            }
        }



        /*
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $personne->setPhoto($fileName);
*/
    }
}

