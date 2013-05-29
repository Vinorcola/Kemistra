<?php

namespace Kemistra\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;





/**
 * Employe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kemistra\MainBundle\Entity\EmployeRepository")
 */
class Employe implements UserInterface, \Serializable
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
     * @ORM\Column(name="prenom", type="string", length=80)
     * @Assert\NotBlank()
     * @Assert\Length(min="3",
     *                max="80",
     *                minMessage="Le prénom doit faire au moins {{ limit }} caractères.",
     *                maxMessage="Le prénom doit faire au plus {{ limit }} caractères.")
     */
    private $prenom;
    
    
    
    /**
     * @ORM\Column(name="username", type="string", length=255, unique=TRUE)
     */
    private $username;
    
    
    
    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    
    
    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    
    
    
    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;
    
    
    
    /**
     * @ORM\Column(name="adresse", type="text")
     * @Assert\NotBlank()
     */
    private $adresse;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Ville", cascade={"persist"})
     * @Assert\Valid()
     */
    private $ville;
    
    
    
    /**
     * @ORM\Column(name="telephone", type="string", length=20)
     * @Assert\Regex("/^(\+33|0)[-. ]?[1-9]([-. ]?[0-9]){8}$/")
     */
    private $telephone;
    
    
    
    /**
     * @ORM\Column(name="email", type="string", length=80)
     * @Assert\Email()
     */
    private $email;
    
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Analyse", mappedBy="employes")
     * @Assert\Valid()
     */
    private $analyses;
    
    
    
    
    
    public function __construct()
    {
        $this->salt = "";
        $this->roles = array('ROLE_USER');
        $this->analyses = new ArrayCollection();
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
     * @return Employe
     */
    public function setNom($nom)
    {
        $this->nom = mb_strtoupper($nom, 'UTF-8');
        $this->username = $this->stripAccents(mb_strtolower($this->prenom . '.' . $this->nom, 'UTF-8'));
        
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
     * Set prenom
     *
     * @param string $prenom
     * @return Employe
     */
    public function setPrenom($prenom)
    {
        $this->prenom = ucfirst($prenom);
        $this->username = $this->stripAccents(mb_strtolower($this->prenom . '.' . $this->nom, 'UTF-8'));
        
        return $this;
    }
    
    
    
    
    
    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    
    
    
    
    
    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Employe
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    
    
    
    
    
    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Employe
     */
    public function setTelephone($telephone)
    {
        if (preg_match("#^(\+33|0)[-. ]?[1-9]([-. ]?[0-9]){8}$#", $telephone))
        {
            $telephone = 
            preg_replace("#^(\+33|0)[-. ]?([1-9])[-. ]?([0-9])[-. ]?([0-9])[-. ]?([0-9])[-. ]?([0-9])[-. ]?([0-9])[-. ]?([0-9])[-. ]?([0-9])[-. ]?([0-9])$#",
                         "0$2.$3$4.$5$6.$7$8.$9$10", $telephone);
        }
        
        $this->telephone = $telephone;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    
    
    
    
    
    /**
     * Set email
     *
     * @param string $email
     * @return Employe
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    
    
    
    
    /**
     * Set ville
     *
     * @param \Kemistra\MainBundle\Entity\Ville $ville
     * @return Employe
     */
    public function setVille(Ville $ville = null)
    {
        $this->ville = $ville;
    
        return $this;
    }
    
    
    
    
    
    /**
     * Get ville
     *
     * @return \Kemistra\MainBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
    }
    
    
    
    
    
    /**
     * Add analyses
     *
     * @param \Kemistra\MainBundle\Entity\Analyse $analyses
     * @return Employe
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
     * Set username
     *
     * @param string $username
     * @return Employe
     *
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }*/
    
    
    
    
    
    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    
    
    
    
    /**
     * Set password
     *
     * @param string $password
     * @return Employe
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
    
    
    
    
    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
    
    
    
    
    /**
     * Set salt
     *
     * @param string $salt
     * @return Employe
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
    
    
    
    
    
    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    
    
    
    
    /**
     * Set roles
     *
     * @param array $roles
     * @return Employe
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    
    
    
    
    
    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    
    
    
    
    
    public function eraseCredentials()
    {
        
    }
    
    
    
    
    
    public function serialize()
    {
        return serialize(array($this->id, $this->username));
    }
    
    
    
    
    
    private function stripAccents($string)
    {
        return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
                             'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
    
    
    
    
    
    public function unserialize($data)
    {
        $tab = unserialize($data);
        $this->id = $tab[0];
        $this->username = $tab[1];
    }
    
    
    
    
    
    public function __toString()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
