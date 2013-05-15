<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\TypeMateriel;





/**
 * TypeMateriel controller.
 *
 */
class TypeMaterielController extends Controller
{
    /**
     * Affiche le stock de matériel disponible.
     */
    public function indexAction()
    {
        // Récupération du stock de matériel disponible.
        $typeMateriels = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeMateriel')->getListeWithStock();
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeMateriel:index.html.twig',
                             array('typeMateriels' => $typeMateriels));
    }
    
    
    
    
    
    /**
     * Affiche les informations concernant un matériel en stock.
     */
    public function showAction($id)
    {
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeMateriel:show.html.twig',
                             array('typeMateriel' => $this->getTypeMateriel($id)));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère un type de matériel et son stock associé depuis la base de données grâce à son id.
     */
    private function getTypeMateriel($id)
    {
        // Récupération du type de matériel.
        $typeMateriel = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeMateriel')->getWithStock($id);
        
        
        // Si le type de matériel n'existe pas, génération d'une erreur 404.
        if (!$typeMateriel)
        {
            throw $this->createNotFoundException('Impossible de trouver le type de matériel.');
        }
        
        
        // Renvoie du type de matériel.
        return $typeMateriel;
    }
}
