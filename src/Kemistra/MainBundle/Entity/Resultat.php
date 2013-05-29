<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;






/**
 * Resultat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\ResultatRepository")
 */
class Resultat
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(name="resultat", type="decimal", precision=5, scale=2)
     * @Assert\NotNull()
     */
    private $resultat;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Analyse", inversedBy="resultats")
     * @Assert\Valid()
     */
    private $analyse;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeResultat", inversedBy="resultats")
     * @Assert\Valid()
     */
    private $typeResultat;
    
    
    
    
    
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
     * Set resultat
     *
     * @param float $resultat
     * @return Resultat
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get resultat
     *
     * @return float 
     */
    public function getResultat()
    {
        return $this->resultat;
    }
    
    
    
    
    
    /**
     * Set analyse
     *
     * @param \Kemistra\MainBundle\Entity\Analyse $analyse
     * @return Resultat
     */
    public function setAnalyse(Analyse $analyse = null)
    {
        $this->analyse = $analyse;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get analyse
     *
     * @return \Kemistra\MainBundle\Entity\Analyse 
     */
    public function getAnalyse()
    {
        return $this->analyse;
    }
    
    
    
    
    
    /**
     * Set typeResultat
     *
     * @param \Kemistra\MainBundle\Entity\TypeResultat $typeResultat
     * @return Resultat
     */
    public function setTypeResultat(TypeResultat $typeResultat = null)
    {
        $this->typeResultat = $typeResultat;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get typeResultat
     *
     * @return \Kemistra\MainBundle\Entity\TypeResultat 
     */
    public function getTypeResultat()
    {
        return $this->typeResultat;
    }
}
