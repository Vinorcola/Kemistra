<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Kemistra\MainBundle\Entity\Employe;
use Kemistra\MainBundle\Form\EmployeType;





/**
 * Employe controller.
 */
class EmployeController extends Controller
{
    /**
     * Affiche la liste des employés.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        // Récupération de la liste des employés.
        $employes = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Employe')->getAll();
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Employe:index.html.twig',
                             array('employes' => $employes));
    }
    
    
    
    
    
    /**
     * Ajoute un nouvel employé.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        // Création de l'entité.
        $employe  = new Employe();
        $motDePasse = md5(rand(0, 10000).rand(0, 10000));
        $employe->setPassword(hash('sha256', $motDePasse));
        
        /*
         * A faire : envoi d'un mail à l'employé avec le mot de passe généré.
         */
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveEmploye($request, $employe, $formulaire))
        {
            return $this->redirect($this->generateUrl('employe_show', array('id' => $employe->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Employe:new.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'ajout d'un nouvel employé.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        // Création de l'entité et du formulaire.
        $employe = new Employe();
        $formulaire = $this->createForm(new EmployeType(), $employe);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Employe:new.html.twig',
                             array('formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Affiche les informations concernant un employé.
     * @Secure(roles="ROLE_USER")
     */
    public function showAction($id)
    {
        // Récupération de l'employé.
        $employe = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Employe')->getOneDetails($id);
        
        
        // Vérification de la sécurité.
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN') && $employe->getId() != $this->getUser()->getId())
        {
            throw new AccessDeniedHttpException('Vous n\'avez pas accès au profil des autres employés.');
        }
        
        
        // Si l'employé n'existe pas, génération d'une erreur 404.
        if (!$employe)
        {
            throw $this->createNotFoundException('Impossible de trouver l\'employé.');
        }
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Employe:show.html.twig',
                             array('employe' => $employe));
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition d'un employé.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        // Récupération de l'employé.
        $employe = $this->getEmploye($id);
        
        
        
        // Création du formulaire.
        $formulaire = $this->createForm(new EmployeType(), $employe);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Employe:edit.html.twig',
                             array('employe'    => $employe,
                                   'formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite les informations d'un employé.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération de l'employé.
        $employe = $this->getEmploye($id);
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveEmploye($request, $employe, $formulaire))
        {
            return $this->redirect($this->generateUrl('employe_show', array('id' => $employe->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Employe:edit.html.twig',
                                 array('employe'    => $employe,
                                       'formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère un employé depuis la base de données grâce à son id.
     */
    private function getEmploye($id)
    {
        // Récupération de l'employé.
        $employe = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Employe')->find($id);
        
        
        // Si l'employé n'existe pas, génération d'une erreur 404.
        if (!$employe)
        {
            throw $this->createNotFoundException('Impossible de trouver l\'employé.');
        }
        
        
        // Renvoie de l'employé
        return $employe;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un employé dans la base de données.
     */
    private function saveEmploye(Request $request,
                                 $employe,
                                 &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new EmployeType(), $employe);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // Recherche de la ville.
            $ville = $em->getRepository('KemistraMainBundle:Ville')
                        ->findOneBy(array('nom'        => $employe->getVille()->getNom(),
                                          'codePostal' => $employe->getVille()->getCodePostal()));
            
            if ($ville)
            {
                // Si la ville existe, on remplace celle saisie par l'utilisateur.
                $employe->setVille($ville);
            }
            
            // On enregistre le type d'analyse dans la base de données.
            $em->persist($employe);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
}
