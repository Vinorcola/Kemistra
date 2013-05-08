<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\TypeAnalyse;
use Kemistra\MainBundle\Form\TypeAnalyseType;





/**
 * TypeAnalyse controller.
 *
 */
class TypeAnalyseController extends Controller
{
    /**
     * Affiche la liste des types d'analyses disponibles.
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
     */
    public function showAction($id)
    {
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeAnalyse:show.html.twig',
                             array('typeAnalyse' => $this->getTypeAnalyse($id)));
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition d'un type d'analyse.
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
            $typeAnalyse->getUtilise()->clear();
            
            $em->persist($typeAnalyse);
            $em->flush();
            
            // On enregistre ensuite chaque matériel utilisé.
            foreach ($formulaire->get('utilise')->getData() as $utilise)
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
