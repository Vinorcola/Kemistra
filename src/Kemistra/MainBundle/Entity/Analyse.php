<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;





/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\AnalyseRepository")
 */
class Analyse
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(name="date", type="date")
     * @Assert\Date()
     */
    private $date;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="analyses")
     * @Assert\Valid()
     */
    private $client;
    
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Employe", inversedBy="analyses")
     * @ORM\JoinTable("Realise")
     * @Assert\Valid()
     */
    private $employes;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="analyse")
     */
    private $resultats;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeAnalyse", inversedBy="analyes")
     */
    private $typeAnalyse;
    
    
    
    /**
     * Champs qui détermine la quantité de consommables utilisés.
     */
    private $consommables;
    
    
    
    
    
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->employes = new ArrayCollection();
        $this->resultats = new ArrayCollection();
        $this->consommables = new ArrayCollection();
    }
    
    
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    
    
    
    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Analyse
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    
    
    
    
    
    /**
     * Set client
     *
     * @param \Kemistra\MainBundle\Entity\Client $client
     * @return Analyse
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get client
     *
     * @return \Kemistra\MainBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
    
    
    
    
    
    /**
     * Add employes
     *
     * @param \Kemistra\MainBundle\Entity\Employe $employes
     * @return Analyse
     */
    public function addEmploye(Employe $employes)
    {
        $this->employes[] = $employes;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove employes
     *
     * @param \Kemistra\MainBundle\Entity\Employe $employes
     */
    public function removeEmploye(Employe $employes)
    {
        $this->employes->removeElement($employes);
    }
    
    
    
    
    
    /**
     * Get employes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployes()
    {
        return $this->employes;
    }
    
    
    
    
    
    /**
     * Add resultats
     *
     * @param \Kemistra\MainBundle\Entity\Resultat $resultats
     * @return Analyse
     */
    public function addResultat(Resultat $resultats)
    {
        $this->resultats[] = $resultats;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove resultats
     *
     * @param \Kemistra\MainBundle\Entity\Resultat $resultats
     */
    public function removeResultat(Resultat $resultats)
    {
        $this->resultats->removeElement($resultats);
    }
    
    
    
    
    
    /**
     * Get resultats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResultats()
    {
        return $this->resultats;
    }
    
    
    
    
    
    /**
     * Set typeAnalyse
     *
     * @param \Kemistra\MainBundle\Entity\TypeAnalyse $typeAnalyse
     * @return Analyse
     */
    public function setTypeAnalyse(TypeAnalyse $typeAnalyse = null)
    {
        $this->typeAnalyse = $typeAnalyse;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get typeAnalyse
     *
     * @return \Kemistra\MainBundle\Entity\TypeAnalyse 
     */
    public function getTypeAnalyse()
    {
        return $this->typeAnalyse;
    }
    
    
    
    
    
    /**
     * Add consommables
     *
     * @param integer $consommables
     * @return Analyse
     */
    public function addConsommable($consommables)
    {
        $this->consommables[] = $consommables;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove consommables
     *
     * @param integer $consommables
     */
    public function removeConsommable($consommables)
    {
        $this->consommables->removeElement($consommables);
    }
    
    
    
    
    
    /**
     * Get consommables
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConsommables()
    {
        return $this->consommables;
    }
}
