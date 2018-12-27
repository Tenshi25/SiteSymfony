<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * FairePartiStatut
 *
 * @ORM\Table(name="faire_parti_statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FairePartiStatutRepository")
 */
class FairePartiStatut
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Groupe", inversedBy="personneStatuts")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="Personne", inversedBy="groupsStatut")
     * @ORM\JoinColumn(name="personne_id", referencedColumnName="id")
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="Statut", inversedBy="personneGroups")
     * @ORM\JoinColumn(name="statut_id", referencedColumnName="id")
     */
    private $statut;

    /**
     * @return mixed
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * @param mixed $groupe
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;
    }

    /**
     * @return mixed
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @param mixed $personne
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
    
}

