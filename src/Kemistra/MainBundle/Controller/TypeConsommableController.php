<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

use Kemistra\MainBundle\Entity\TypeConsommable;





/**
 * TypeConsommable controller.
 */
class TypeConsommableController extends Controller
{
    /**
     * Affiche le stock de consommable disponible.
     * @Secure(roles="ROLE_USER")
     */
    public function indexAction()
    {
        // Récupération du stock de consommable disponible.
        $typeConsommables = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeConsommable')->getListeWithStock();
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeConsommable:index.html.twig',
                             array('typeConsommables' => $typeConsommables));
    }
    
    
    
    
    
    /**
     * Affiche les informations concernant un consommable en stock.
     * @Secure(roles="ROLE_USER")
     */
    public function showAction($id)
    {
        // Génération de la vue.
        return $this->render('KemistraMainBundle:TypeConsommable:show.html.twig',
                             array('typeConsommable' => $this->getTypeConsommable($id)));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère un type de consommable et son stock associé depuis la base de données grâce à son id.
     */
    private function getTypeConsommable($id)
    {
        // Récupération du type de consommable.
        $typeConsommable = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:TypeConsommable')->getWithStock($id);
        
        
        // Si le type de consommable n'existe pas, génération d'une erreur 404.
        if (!$typeConsommable)
        {
            throw $this->createNotFoundException('Impossible de trouver le type de consommable.');
        }
        
        
        // Renvoie du type de consommable.
        return $typeConsommable;
    }
}
