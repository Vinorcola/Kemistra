<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

use Kemistra\MainBundle\Entity\TypeAnalyse;
use Kemistra\MainBundle\Form\TypeAnalyseType;
use Doctrine\Common\Collections\ArrayCollection;





/**
 * TypeAnalyse controller.
 */
class TypeAnalyseController extends Controller
{
    /**
     * Affiche la liste des types d'analyses disponibles.
     * @Secure(roles="ROLE_USER")
     */
    public function indexAction()
    {
        // Récupération de la liste des types d'analyse.
        $typeAnalyses = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeAnalyse')->findAll();
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeAnalyse:index.html.twig',
                             array('typeAnalyses' => $typeAnalyses));
    }
    
    
    
    
    
    /**
     * Ajoute un nouveau type d'analyse.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function createAction(Request $request)
    {
        // Création de l'entité.
        $typeAnalyse  = new TypeAnalyse();
        
        
        // Enregistrement du formulaire.
        if ($this->saveTypeAnalyse($request, $typeAnalyse, $formulaire))
        {
            return $this->redirect($this->generateUrl('typeanalyse_show', array('id' => $typeAnalyse->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:TypeAnalyse:new.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'ajout d'un type d'analyse.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction()
    {
        // Création de l'entité et du formulaire
        $typeAnalyse = new TypeAnalyse();
        $formulaire = $this->createForm(new TypeAnalyseType(), $typeAnalyse);
        
        
        // Génération de la vue
        return $this->render('KemistraMainBundle:TypeAnalyse:new.html.twig',
                             array('formulaire'  => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Affiche les informations concernant un type d'analyse.
     * @Secure(roles="ROLE_USER")
     */
    public function showAction($id)
    {
        // Récupération du type d'analyse.
        $typeAnalyse = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeAnalyse')->getDetails($id);
        
        
        // Si le type d'analyse n'existe pas, génération d'une erreur 404.
        if (!$typeAnalyse)
        {
            throw $this->createNotFoundException('Impossible de trouver le type d\'analyse.');
        }
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeAnalyse:show.html.twig',
                             array('typeAnalyse' => $typeAnalyse));
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition d'un type d'analyse.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($id)
    {
        // Récupération du type d'analyse.
        $typeAnalyse = $this->getTypeAnalyse($id);
        
        
        // Création du formulaire.
        $formulaire = $this->createForm(new TypeAnalyseType(), $typeAnalyse);
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeAnalyse:edit.html.twig',
                             array('typeAnalyse' => $typeAnalyse,
                                   'formulaire'  => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite les informations d'un type d'analyse.
     * @Secure(roles="ROLE_ADMIN")
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération du type d'analyse.
        $typeAnalyse = $this->getTypeAnalyse($id);
        $typeAnalyse->setFichier();
        
        
        // Enregistrement du formulaire.
        if ($this->saveTypeAnalyse($request, $typeAnalyse, $formulaire))
        {
            return $this->redirect($this->generateUrl('typeanalyse_show', array('id' => $id)));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:TypeAnalyse:edit.html.twig',
                                 array('typeAnalyse' => $typeAnalyse,
                                       'formulaire'  => $formulaire->createView()));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère un type d'analyse depuis la base de données grâce à son id.
     */
    private function getTypeAnalyse($id)
    {
        // Récupération du type d'analyse.
        $typeAnalyse = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeAnalyse')->find($id);
        
        
        // Si le type d'analyse n'existe pas, génération d'une erreur 404.
        if (!$typeAnalyse)
        {
            throw $this->createNotFoundException('Impossible de trouver le type d\'analyse.');
        }
        
        
        // Renvoie du type d'analyse.
        return $typeAnalyse;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un type d'analyse dans la base de données.
     */
    private function saveTypeAnalyse(Request $request,
                                     $typeAnalyse,
                                     &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new TypeAnalyseType(), $typeAnalyse);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            
            // Enregistrement : il faut enregistrer l'analyse en tout premier pour générer l'id.
            
            // Récupération de la liste du matériel.
            $listeMateriel = new ArrayCollection($typeAnalyse->getUtilise()->getValues());
            
            // Persist du type d'analyse.
            $typeAnalyse->getUtilise()->clear();
            $em->persist($typeAnalyse);
            $em->flush();
            
            // On enregistre ensuite chaque matériel utilisé.
            foreach ($listeMateriel as $utilise)
            {
                $utilise->setTypeAnalyse($typeAnalyse);
                $em->persist($utilise);
            }
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
}
