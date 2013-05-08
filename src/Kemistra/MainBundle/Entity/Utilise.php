<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * Utilise
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\UtiliseRepository")
 */
class Utilise
{
    /**
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeAnalyse", inversedBy="utilise")
     * @ORM\Id
     * @Assert\Valid()
     */
    private $typeAnalyse;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeMateriel", inversedBy="utilise")
     * @ORM\Id
     * @Assert\Valid()
     */
    private $typeMateriel;
    
    
    
    
    
    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return Utilise
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
    
    
    
    
    
    /**
     * Set typeAnalyse
     *
     * @param \Kemistra\MainBundle\Entity\TypeAnalyse $typeAnalyse
     * @return Utilise
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
    
    
    
    
    
    /**
     * Set typeMateriel
     *
     * @param \Kemistra\MainBundle\Entity\TypeMateriel $typeMateriel
     * @return Utilise
     */
    public function setTypeMateriel(TypeMateriel $typeMateriel)
    {
        $this->typeMateriel = $typeMateriel;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get typeMateriel
     *
     * @return \Kemistra\MainBundle\Entity\TypeMateriel 
     */
    public function getTypeMateriel()
    {
        return $this->typeMateriel;
    }
}
