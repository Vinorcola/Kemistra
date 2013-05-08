<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;





/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\TypeAnalyseRepository")
 * @ORM\HasLifecycleCallbacks
 */
class TypeAnalyse
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
     * @ORM\Column(name="dureeEstimee", type="time")
     */
    private $dureeEstimee;
    
    
    
    /**
     * @ORM\Column(name="nombreEmployeNecessaire", type="integer")
     * @Assert\Range(min="1",
     *               minMessage="Une analyse doit être faite par au moins un employé.")
     */
    private $nombreEmployeNecessaire;
    
    
    
    /**
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;
    
    
    
    /**
     * @ORM\Column(name="protocole", type="string", length=100)
     */
    private $protocole;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Analyse", mappedBy="typeAnalyse")
     * @Assert\Valid()
     */
    private $analyses;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="TypeResultat", mappedBy="typeAnalyse", cascade={"persist"})
     * @Assert\Valid()
     */
    private $typeResultats;
    
    
    
    /**
     * @ORM\ManyToMany(targetEntity="TypeConsommable")
     * @ORM\JoinTable("Consomme")
     * @Assert\Valid()
     */
    private $typeConsommables;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Utilise", mappedBy="typeAnalyse", cascade={"persist"})
     * @Assert\Valid()
     */
    private $utilise;
    
    
    
    
    
    public function __construct()
    {
        $this->analyses = new ArrayCollection();
        $this->typeResultats = new ArrayCollection();
        $this->typeConsommables = new ArrayCollection();
        $this->utilise = new ArrayCollection();
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
     * @return TypeAnalyse
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
     * Set dureeEstimee
     *
     * @param \DateTime $dureeEstimee
     * @return TypeAnalyse
     */
    public function setDureeEstimee($dureeEstimee)
    {
        $this->dureeEstimee = $dureeEstimee;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get dureeEstimee
     *
     * @return \DateTime 
     */
    public function getDureeEstimee()
    {
        return $this->dureeEstimee;
    }
    
    
    
    
    
    /**
     * Set nombreEmployeNecessaire
     *
     * @param integer $nombreEmployeNecessaire
     * @return TypeAnalyse
     */
    public function setNombreEmployeNecessaire($nombreEmployeNecessaire)
    {
        $this->nombreEmployeNecessaire = $nombreEmployeNecessaire;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get nombreEmployeNecessaire
     *
     * @return integer 
     */
    public function getNombreEmployeNecessaire()
    {
        return $this->nombreEmployeNecessaire;
    }
    
    
    
    
    
    /**
     * Set description
     *
     * @param string $description
     * @return TypeAnalyse
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
     * Set protocole
     *
     * @param string $protocole
     * @return TypeAnalyse
     */
    public function setProtocole($protocole)
    {
        $this->protocole = $protocole;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get protocole
     *
     * @return string 
     */
    public function getProtocole()
    {
        return $this->protocole;
    }
    
    
    
    
    
    /**
     * Add analyses
     *
     * @param \Kemistra\MainBundle\Entity\Analyse $analyses
     * @return TypeAnalyse
     */
    public function addAnalyse(Analyse $analyses)
    {
        $this->analyses[] = $analyses;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove analyses
     *
     * @param \Kemistra\MainBundle\Entity\Analyse $analyses
     */
    public function removeAnalyse(Analyse $analyses)
    {
        $this->analyses->removeElement($analyses);
    }
    
    
    
    
    
    /**
     * Get analyses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnalyses()
    {
        return $this->analyses;
    }
    
    
    
    
    
    /**
     * Add typeResultats
     *
     * @param \Kemistra\MainBundle\Entity\TypeResultat $typeResultats
     * @return TypeAnalyse
     */
    public function addTypeResultat(TypeResultat $typeResultats)
    {
        $typeResultats->setTypeAnalyse($this);
        $this->typeResultats[] = $typeResultats;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove typeResultats
     *
     * @param \Kemistra\MainBundle\Entity\TypeResultat $typeResultats
     */
    public function removeTypeResultat(TypeResultat $typeResultats)
    {
        $this->typeResultats->removeElement($typeResultats);
    }
    
    
    
    
    
    /**
     * Get typeResultats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypeResultats()
    {
        return $this->typeResultats;
    }
    
    
    
    
    
    /**
     * Add typeConsommables
     *
     * @param \Kemistra\MainBundle\Entity\TypeConsommable $typeConsommables
     * @return TypeAnalyse
     */
    public function addTypeConsommable(TypeConsommable $typeConsommables)
    {
        $this->typeConsommables[] = $typeConsommables;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Remove typeConsommables
     *
     * @param \Kemistra\MainBundle\Entity\TypeConsommable $typeConsommables
     */
    public function removeTypeConsommable(TypeConsommable $typeConsommables)
    {
        $this->typeConsommables->removeElement($typeConsommables);
    }
    
    
    
    
    
    /**
     * Get typeConsommables
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypeConsommables()
    {
        return $this->typeConsommables;
    }
    
    
    
    
    
    /**
     * Add utilise
     *
     * @param \Kemistra\MainBundle\Entity\Utilise $utilise
     * @return TypeAnalyse
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
    
    
    
    
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preperationId()
    {
        foreach ($this->typeResultats as $typeResultat)
        {
            if ($typeResultat !== null)
            {
                $typeResultat->setTypeAnalyse($this);
            }
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*
     * Méthodes et attributs nécessaires à l'upload du fichier.
     */
    
    
    /**
     * @Assert\File(mimeTypes = {"application/pdf", "application/x-pdf"},
     *              mimeTypesMessage = "Le fichier doit être de type PDF.")
     */
    private $fichier;///< Attribut conservant le fichier pour le formulaire.
    private $fichierASuppr;///< Attribut mémorisant le nom d'un ichier à supprimer.
    
    
    
    
    
    public function setFichier(UploadedFile $fichier = null)
    {
        if ($fichier !== null)
        {
            $this->fichier = $fichier;
            
            
            // Vérification de l'existance d'un fichier plus ancien.
            if ($this->protocole !== null)
            {
                $this->fichierASuppr = $this->protocole;
                $this->protocole = null;
            }
        }
        
        
        return $this;
    }
    
    
    
    
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prepareUpload()
    {
        // On vérifie qu'un fichier est uploadé.
        if ($this->fichier !== null)
        {
            $this->protocole = $this->fichier->getClientOriginalName();
        }
    }
    
    
    
    
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // On vérifie qu'un fichier est uploadé.
        if ($this->fichier !== null)
        {
            // On vérifie la présence d'un ancien fichier.
            if ($this->fichierASuppr !== null)
            {
                $ancienFichier = $this->getUploadRootDir() . '/' . $this->getId() . '-' . $this->getProtocole();
                
                if (file_exists($ancienFichier))
                {
                    unlink($ancienFichier);
                }
            }
            
            
            // On déplace le nouveau fichier dans le répertoire d'upload.
            $this->fichier->move($this->getUploadRootDir() . '/', $this->getId() . '-' . $this->getProtocole());
        }
    }
    
    
    
    
    
    /**
     * @ORM\PreRemove()
     */
    public function prepareRemove()
    {
        $this->fichierASuppr = $this->getUploadRootDir() . '/' . $this->getId() . '-' . $this->getProtocole();
    }
    
    
    
    
    
    /**
     * @ORM\PostRemove()
     */
    public function remove()
    {
        if (file_exists($this->fichierASuppr))
        {
            unlink($ancienFichier);
        }
    }
    
    
    
    
    
    public function getFichier()
    {
        return $this->fichier;
    }
    
    
    
    
    
    public function getUploadDir()
    {
        return 'uploads/protocoles';
    }
    
    
    
    
    
    private function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }
}
