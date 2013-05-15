<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\Resultat;
use Kemistra\MainBundle\Form\ResultatType;

/**
 * Resultat controller.
 *
 */
class ResultatController extends Controller
{
    /**
     * Affiche la liste des résultats.
     */
    public function indexAction()
    {
		// Récupération de la liste des résultats.
        $resultats = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Resultat')->findAll();

		// Génération de la vue.
        return $this->render('KemistraMainBundle:Resultat:index.html.twig', 
							array('resultat' => $resultats));
    }

    /**
     * Ajoute une nouveau résultat.
     */
    public function createAction(Request $request)
    {
		// Création de l'entité.
        $resultat  = new Resultat();
		
		// Enregistrement du formulaire.
        if ($this->saveAResultat($request, $resultat, $formulaire)) 
		{
            return $this->redirect($this->generateUrl('resultat_show', array('id' => $resultat->getId())));
        }
		else
		{
			// Le formulaire est invalide. Nouvel affichage du formulaire.
			return $this->render('KemistraMainBundle:Resultat:new.html.twig', 
								array('formulaire' => $formulaire->createView()));
		}
    }

    /**
     * Affiche le formulaire d'ajout d'un nouveau résultat.
     */
    public function newAction()
    {
		// Création de l'entité et du formulaire.
        $resultat = new Resultat();
        $formulaire = $this->createForm(new ResultatType(), $resultat);

		// Génération de la vue.
        return $this->render('KemistraMainBundle:Resultat:new.html.twig', 
							array('formulaire' => $formulaire->createView()));
    }

    /**
     * Affiche les informations concernant un résultat.
     */
    public function showAction($id)
    {
		// Génération de la vue.
        return $this->render('KemistraMainBundle:Resultat:show.html.twig', 
							array('resultat' => $this->getResultat($id)));
    }

    /**
     * Affiche le formulaire d'édition d'un résultat.
     */
    public function editAction($id)
    {
		// Récupération du résultat.
        $resultat = $this->getResultat($id);

		// Création du formulaire.
        $formulaire = $this->createForm(new ResultatType(), $resultat);

		// Génération de la vue.
        return $this->render('KemistraMainBundle:Resultat:edit.html.twig', 
							array('resultat' 	 => $resultat,
								  'formulaire'   => $formulaire->createView()));
    }

    /**
     * Édite les informations d'un résultat.
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération du résultat.
        $resultat = $this->getResultat($id);
        
        // Enregistrement du formulaire.
        if ($this->saveResultat($request, $resultat, $formulaire))
        {
            return $this->redirect($this->generateUrl('resultat_show', array('id' => $resultat->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Resultat:edit.html.twig',
                                 array('resultat'    => $resultat,
                                       'formulaire' => $formulaire->createView()));
        }
    }

    /**
     * Récupère un résultat depuis la base de données grâce à son id.
     */
    private function getResultat($id)
    {
        // Récupération du résultat.
        $resultat = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Resultat')->find($id);
        
        // Si le résultat n'existe pas, génération d'une erreur 404.
        if (!$resultat)
        {
            throw $this->createNotFoundException('Impossible de trouver le résultat.');
        }
         
        // Renvoie du résultat.
        return $resultat;
    }

    /**
     * Tente de sauvegarder un résultat dans la base de données.
     */
    private function saveResultat(Request $request,
                                 $resultat,
                                 &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new ResultatType(), $resultat);
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le type de résultat dans la base de données.
            $em->persist($resultat);
            $em->flush();
            
            return true;
        }

        return false;
    }
}
