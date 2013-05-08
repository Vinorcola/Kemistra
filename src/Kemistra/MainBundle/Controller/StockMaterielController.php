<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\StockMateriel;
use Kemistra\MainBundle\Form\StockMaterielType;
use Kemistra\MainBundle\Form\StockMaterielNewTMType;
use Kemistra\MainBundle\Form\QuantiteStockMaterielType;





/**
 * StockMateriel controller.
 *
 */
class StockMaterielController extends Controller
{
    /**
     * Affiche le formulaire d'ajout d'un matériel dans le stock.
     */
    public function newAction()
    {
        // Création de l'entité et du formulaire
        $stockMateriel = new StockMateriel();
        $formulaire = $this->createForm(new StockMaterielType(), $stockMateriel);
        
        
        // Génération de la vue
        return $this->render('KemistraMainBundle:StockMateriel:new.html.twig',
                             array('formulaire'  => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Ajoute un matériel dans le stock.
     */
    public function createAction(Request $request)
    {
        // Création de l'entité.
        $stockMateriel  = new StockMateriel();
        
        
        // Enregistrement du formulaire.
        if ($this->saveStockMateriel($request, $stockMateriel, $formulaire))
        {
            return $this->redirect($this->generateUrl('typemateriel_show', array('id' => $stockMateriel->getTypeMateriel()->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:StockMateriel:new.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'ajout d'un matériel de nouveau type dans le stock.
     */
    public function newTypeMaterielAction()
    {
        // Création de l'entité et du formulaire
        $stockMateriel = new StockMateriel();
        $formulaire = $this->createForm(new StockMaterielNewTMType(), $stockMateriel);
        
        
        // Génération de la vue
        return $this->render('KemistraMainBundle:StockMateriel:newTypeMateriel.html.twig',
                             array('formulaire'  => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Ajoute un matériel de nouveau type dans le stock.
     */
    public function createTypeMaterielAction(Request $request)
    {
        // Création de l'entité.
        $stockMateriel  = new StockMateriel();
        
        
        // Enregistrement du formulaire.
        if ($this->saveStockMaterielNewTM($request, $stockMateriel, $formulaire))
        {
            return $this->redirect($this->generateUrl('typemateriel_show', array('id' => $stockMateriel->getTypeMateriel()->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:StockMateriel:newTypeMateriel.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition de la quantité de matériel en stock.
     */
    public function editQuantiteAction($id)
    {
        // Récupération du matériel en stock.
        $stockMateriel = $this->getStockMateriel($id);
        
        
        
        // Création du formulaire.
        $formulaire = $this->createForm(new QuantiteStockMaterielType(), $stockMateriel);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:StockMateriel:edit.html.twig',
                             array('stockMateriel' => $stockMateriel,
                                   'formulaire'    => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite la quantité de matériel en stock.
     */
    public function updateQuantiteAction(Request $request, $id)
    {
        // Récupération de l'employé.
        $stockMateriel = $this->getStockMateriel($id);
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveQuantiteStockMateriel($request, $stockMateriel, $formulaire))
        {
            return $this->redirect($this->generateUrl('stockmateriel_show', array('id' => $stockMateriel->getTypeMateriel()->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:StockMateriel:edit.html.twig',
                                 array('stockMateriel' => $stockMateriel,
                                       'formulaire'    => $formulaire->createView()));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère la quantité en stock d'un matériel.
     */
    private function getStockMateriel($id)
    {
        // Récupération de matériel en stock.
        $stockMateriel = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:StockMateriel')->find($id);
        
        
        // Si le matériel n'existe pas, génération d'une erreur 404.
        if (!$stockMateriel)
        {
            throw $this->createNotFoundException('Impossible de trouver le matériel dans le stock.');
        }
        
        
        // Renvoie du matériel en stock.
        return $stockMateriel;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un matériel en stock dans la base de données.
     */
    private function saveStockMateriel(Request $request,
                                       $stockMateriel,
                                       &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new StockMaterielType(), $stockMateriel);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le matériel en stock dans la base de données.
            $em->persist($stockMateriel);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un matériel de nouveau type en stock dans la base de données.
     */
    private function saveStockMaterielNewTM(Request $request,
                                            $stockMateriel,
                                            &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new StockMaterielNewTMType(), $stockMateriel);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le matériel en stock dans la base de données.
            $em->persist($stockMateriel);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un matériel de nouveau type en stock dans la base de données.
     */
    private function saveQuantiteStockMateriel(Request $request,
                                               $stockMateriel,
                                               &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new QuantiteStockMaterielType(), $stockMateriel);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le matériel en stock dans la base de données.
            $em->persist($stockMateriel);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
}
