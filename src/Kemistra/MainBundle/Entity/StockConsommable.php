<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * StockConsommable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\StockConsommableRepository")
 */
class StockConsommable
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(name="numeroLot", type="string", length=80)
     * @Assert\NotBlank()
     * @Assert\Length(min="3",
     *                max="80",
     *                minMessage="Le numéro de lot doit faire au moins {{ limit }} caractères.",
     *                maxMessage="Le numéro de lot doit faire au plus {{ limit }} caractères.")
     */
    private $numeroLot;
    
    
    
    /**
     * @ORM\Column(name="quantiteAchetee", type="integer")
     * @Assert\NotNull()
     */
    private $quantiteAchetee;
    
    
    
    /**
     * @ORM\Column(name="quantiteRestante", type="integer")
     * @Assert\NotNull()
     */
    private $quantiteRestante;
    
    
    
    /**
     * @ORM\Column(name="datePeremption", type="date")
     */
    private $datePeremption;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeConsommable", inversedBy="stockConsommables", cascade={"persist"})
     * @Assert\Valid()
     */
    private $typeConsommable;
    
    
    
    
    
    public function __construct()
    {
        $this->datePeremption = new \DateTime();
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
     * Set numeroLot
     *
     * @param string $numeroLot
     * @return StockConsommable
     */
    public function setNumeroLot($numeroLot)
    {
        $this->numeroLot = $numeroLot;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get numeroLot
     *
     * @return string 
     */
    public function getNumeroLot()
    {
        return $this->numeroLot;
    }
    
    
    
    
    
    /**
     * Set quantiteAchetee
     *
     * @param integer $quantiteAchetee
     * @return StockConsommable
     */
    public function setQuantiteAchetee($quantiteAchetee)
    {
        $this->quantiteAchetee = $quantiteAchetee;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get quantiteAchetee
     *
     * @return integer 
     */
    public function getQuantiteAchetee()
    {
        return $this->quantiteAchetee;
    }
    
    
    
    
    
    /**
     * Set quantiteRestante
     *
     * @param integer $quantiteRestante
     * @return StockConsommable
     */
    public function setQuantiteRestante($quantiteRestante)
    {
        $this->quantiteRestante = $quantiteRestante;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get quantiteRestante
     *
     * @return integer 
     */
    public function getQuantiteRestante()
    {
        return $this->quantiteRestante;
    }
    
    
    
    
    
    /**
     * Set datePeremption
     *
     * @param \DateTime $datePeremption
     * @return StockConsommable
     */
    public function setDatePeremption($datePeremption)
    {
        $this->datePeremption = $datePeremption;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get datePeremption
     *
     * @return \DateTime 
     */
    public function getDatePeremption()
    {
        return $this->datePeremption;
    }
    
    
    
    
    
    /**
     * Set typeConsommable
     *
     * @param \Kemistra\MainBundle\Entity\TypeConsommable $typeConsommable
     * @return StockConsommable
     */
    public function setTypeConsommable(TypeConsommable $typeConsommable = null)
    {
        $this->typeConsommable = $typeConsommable;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get typeConsommable
     *
     * @return \Kemistra\MainBundle\Entity\TypeConsommable 
     */
    public function getTypeConsommable()
    {
        return $this->typeConsommable;
    }
}
