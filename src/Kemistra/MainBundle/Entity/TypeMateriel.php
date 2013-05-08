<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * TypeMateriel
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\TypeMaterielRepository")
 */
class TypeMateriel
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    
    /**
     * @ORM\Column(name="nom", type="string", length=80)
     * @Assert\NotBlank()
     * @Assert\Length(min="3",
     *                max="80",
     *                minMessage="Le nom doit faire au moins {{ limit }} caractères.",
     *                maxMessage="Le nom doit faire au plus {{ limit }} caractères.")
     */
    private $nom;
    
    
    
    /**
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="StockMateriel", mappedBy="typeMateriel")
     * @Assert\Valid()
     */
    private $stockMateriel;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Utilise", mappedBy="typeMateriel")
     * @Assert\Valid()
     */
    private $utilise;
    
    
    
    
    
    public function __construct()
    {
        $this->stockMateriel = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return TypeMateriel
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    
    
    
    
    /**
     * Set description
     *
     * @param string $description
     * @return TypeMateriel
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    
    
    
    
    /**
     * Add stockMateriel
     *
     * @param \Kemistra\MainBundle\Entity\StockMateriel $stockMateriel
     * @return TypeMateriel
     */
    public function addStockMateriel(StockMateriel $stockMateriel)
    {
        $this->stockMateriel[] = $stockMateriel;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove stockMateriel
     *
     * @param \Kemistra\MainBundle\Entity\StockMateriel $stockMateriel
     */
    public function removeStockMateriel(StockMateriel $stockMateriel)
    {
        $this->stockMateriel->removeElement($stockMateriel);
    }
    
    
    
    
    
    /**
     * Get stockMateriel
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStockMateriel()
    {
        return $this->stockMateriel;
    }
    
    
    
    
    
    public function __toString()
    {
        return $this->nom;
    }
}
