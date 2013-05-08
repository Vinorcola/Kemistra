<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\StockConsommable;
use Kemistra\MainBundle\Form\StockConsommableType;
use Kemistra\MainBundle\Form\StockConsommableNewTCType;
use Kemistra\MainBundle\Form\QuantiteStockConsommableType;





/**
 * StockConsommable controller.
 *
 */
class StockConsommableController extends Controller
{
    /**
     * Affiche le formulaire d'ajout d'un consommable dans le stock.
     */
    public function newAction()
    {
        // Création de l'entité et du formulaire
        $stockConsommable = new StockConsommable();
        $formulaire = $this->createForm(new StockConsommableType(), $stockConsommable);
        
        
        // Génération de la vue
        return $this->render('KemistraMainBundle:StockConsommable:new.html.twig',
                             array('formulaire'  => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Ajoute un consommable dans le stock.
     */
    public function createAction(Request $request)
    {
        // Création de l'entité.
        $stockConsommable  = new StockConsommable();
        
        
        // Enregistrement du formulaire.
        if ($this->saveStockConsommable($request, $stockConsommable, $formulaire))
        {
            return $this->redirect($this->generateUrl('typeconsommable_show', array('id' => $stockConsommable->getTypeConsommable()->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:StockConsommable:new.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'ajout d'un consommable de nouveau type dans le stock.
     */
    public function newTypeConsommableAction()
    {
        // Création de l'entité et du formulaire
        $stockConsommable = new StockConsommable();
        $formulaire = $this->createForm(new StockConsommableNewTCType(), $stockConsommable);
        
        
        // Génération de la vue
        return $this->render('KemistraMainBundle:StockConsommable:newTypeConsommable.html.twig',
                             array('formulaire'  => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Ajoute un consommable de nouveau type dans le stock.
     */
    public function createTypeConsommableAction(Request $request)
    {
        // Création de l'entité.
        $stockConsommable  = new StockConsommable();
        
        
        // Enregistrement du formulaire.
        if ($this->saveStockConsommableNewTC($request, $stockConsommable, $formulaire))
        {
            return $this->redirect($this->generateUrl('typeconsommable_show', array('id' => $stockConsommable->getTypeConsommable()->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:StockConsommable:newTypeConsommable.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition de la quantité de consommable en stock.
     */
    public function editQuantiteAction($id)
    {
        // Récupération du consommable en stock.
        $stockConsommable = $this->getStockConsommable($id);
        
        
        
        // Création du formulaire.
        $formulaire = $this->createForm(new QuantiteStockConsommableType(), $stockConsommable);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:StockConsommable:edit.html.twig',
                             array('stockConsommable' => $stockConsommable,
                                   'formulaire'    => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite la quantité de consommable en stock.
     */
    public function updateQuantiteAction(Request $request, $id)
    {
        // Récupération de l'employé.
        $stockConsommable = $this->getStockConsommable($id);
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveQuantiteStockConsommable($request, $stockConsommable, $formulaire))
        {
            return $this->redirect($this->generateUrl('stockconsommable_show', array('id' => $stockConsommable->getTypeConsommable()->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:StockConsommable:edit.html.twig',
                                 array('stockConsommable' => $stockConsommable,
                                       'formulaire'    => $formulaire->createView()));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère la quantité en stock d'un consommable.
     */
    private function getStockConsommable($id)
    {
        // Récupération de consommable en stock.
        $stockConsommable = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:StockConsommable')->find($id);
        
        
        // Si le consommable n'existe pas, génération d'une erreur 404.
        if (!$stockConsommable)
        {
            throw $this->createNotFoundException('Impossible de trouver le consommable dans le stock.');
        }
        
        
        // Renvoie du consommable en stock.
        return $stockConsommable;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un consommable en stock dans la base de données.
     */
    private function saveStockConsommable(Request $request,
                                       $stockConsommable,
                                       &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new StockConsommableType(), $stockConsommable);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le consommable en stock dans la base de données.
            $em->persist($stockConsommable);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un consommable de nouveau type en stock dans la base de données.
     */
    private function saveStockConsommableNewTC(Request $request,
                                            $stockConsommable,
                                            &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new StockConsommableNewTCType(), $stockConsommable);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le consommable en stock dans la base de données.
            $em->persist($stockConsommable);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un consommable de nouveau type en stock dans la base de données.
     */
    private function saveQuantiteStockConsommable(Request $request,
                                               $stockConsommable,
                                               &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new QuantiteStockConsommableType(), $stockConsommable);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le consommable en stock dans la base de données.
            $em->persist($stockConsommable);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
}
