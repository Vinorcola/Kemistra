<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * TypeConsommable
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\TypeConsommableRepository")
 */
class TypeConsommable
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
     * @ORM\Column(name="unite", type="string", length=10)
     * @Assert\NotBlank()
     */
    private $unite;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="StockConsommable", mappedBy="typeConsommable")
     * @Assert\Valid()
     */
    private $stockConsommables;
    
    
    
    
    
    public function __construct()
    {
        $this->stockConsommables = new ArrayCollection;
        $this->utilise = new ArrayCollection;
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
     * @return TypeConsommable
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
     * @return TypeConsommable
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
     * Set unite
     *
     * @param string $unite
     * @return TypeConsommable
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
     * Add stockConsommables
     *
     * @param \Kemistra\MainBundle\Entity\StockConsommable $stockConsommables
     * @return TypeConsommable
     */
    public function addStockConsommable(StockConsommable $stockConsommables)
    {
        $this->stockConsommables[] = $stockConsommables;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove stockConsommables
     *
     * @param \Kemistra\MainBundle\Entity\StockConsommable $stockConsommables
     */
    public function removeStockConsommable(StockConsommable $stockConsommables)
    {
        $this->stockConsommables->removeElement($stockConsommables);
    }
    
    
    
    
    
    /**
     * Get stockConsommables
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStockConsommables()
    {
        return $this->stockConsommables;
    }
    
    
    
    
    
    /**
     * Add utilise
     *
     * @param \Kemistra\MainBundle\Entity\Utilise $utilise
     * @return TypeConsommable
     */
    public function addUtilise(Utilise $utilise)
    {
        $this->utilise[] = $utilise;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove utilise
     *
     * @param \Kemistra\MainBundle\Entity\Utilise $utilise
     */
    public function removeUtilise(Utilise $utilise)
    {
        $this->utilise->removeElement($utilise);
    }
    
    
    
    
    
    /**
     * Get utilise
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilise()
    {
        return $this->utilise;
    }
    
    
    
    
    
    public function __toString()
    {
        return $this->nom;
    }
}
