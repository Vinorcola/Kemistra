<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * StockMateriel
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\StockMaterielRepository")
 */
class StockMateriel
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(name="quantite", type="integer")
     * @Assert\NotNull()
     */
    private $quantite;
    
    
    
    /**
     * @ORM\Column(name="dateAchat", type="date")
     */
    private $dateAchat;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeMateriel", inversedBy="stockMateriel", cascade={"persist"})
     * @Assert\Valid()
     */
    private $typeMateriel;
    
    
    
    
    
    public function __construct()
    {
        $this->dateAchat = new \DateTime();
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
     * Set quantite
     *
     * @param integer $quantite
     * @return StockMateriel
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
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     * @return StockMateriel
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get dateAchat
     *
     * @return \DateTime 
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }
    
    
    
    
    
    /**
     * Set typeMateriel
     *
     * @param \Kemistra\MainBundle\Entity\TypeMateriel $typeMateriel
     * @return StockMateriel
     */
    public function setTypeMateriel(\Kemistra\MainBundle\Entity\TypeMateriel $typeMateriel = null)
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
