<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * TypeResultat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\TypeResultatRepository")
 */
class TypeResultat
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(name="unite", type="string", length=20, nullable=TRUE)
     */
    private $unite;
    
    
    
    /**
     * @ORM\Column(name="information", type="text")
     * @Assert\NotBlank()
     */
    private $information;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="typeResultat")
     * @Assert\Valid()
     */
    private $resultats;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeAnalyse", inversedBy="typeResultats")
     * @Assert\Valid()
     */
    private $typeAnalyse;
    
    
    
    
    
    public function __construct()
    {
        $this->resultats = new ArrayCollection();
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
     * Set unite
     *
     * @param string $unite
     * @return TypeResultat
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get unite
     *
     * @return string 
     */
    public function getUnite()
    {
        return $this->unite;
    }
    
    
    
    
    
    /**
     * Set information
     *
     * @param string $information
     * @return TypeResultat
     */
    public function setInformation($information)
    {
        $this->information = $information;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }
    
    
    
    
    
    /**
     * Add resultats
     *
     * @param \Kemistra\MainBundle\Entity\Resultat $resultats
     * @return TypeResultat
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
     * @return TypeResultat
     */
    public function setTypeAnalyse(TypeAnalyse $typeAnalyse)
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
    
    
    
    
    
    public function __toString()
    {
        return $this->information;
    }
}
