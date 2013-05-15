<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\Analyse;
use Kemistra\MainBundle\Form\AnalyseType;

/**
 * Analyse controller.
 *
 */
class AnalyseController extends Controller
{
    /**
     * Affiche la liste des analyses.
     */
    public function indexAction()
    {
		// Récupération de la liste des analyses.
        $analyses = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Analyse')->findAll();

		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:index.html.twig', 
							array('analyses' => $analyses));
    }

    /**
     * Ajoute une nouvelle analyse.
     */
    public function createAction(Request $request)
    {
		// Création de l'entité.
        $analyse  = new Analyse();
		
		// Enregistrement du formulaire.
        if ($this->saveAnalyse($request, $analyse, $formulaire)) 
		{
            return $this->redirect($this->generateUrl('analyse_show', array('id' => $analyse->getId())));
        }
		else
		{
			// Le formulaire est invalide. Nouvel affichage du formulaire.
			return $this->render('KemistraMainBundle:Analyse:new.html.twig', 
								array('formulaire' => $formulaire->createView()));
		}
    }

    /**
     * Affiche le formulaire d'ajout d'une nouvelle analyse.
     */
    public function newAction()
    {
		// Création de l'entité et du formulaire.
        $analyse = new Analyse();
        $formulaire = $this->createForm(new AnalyseType(), $analyse);

		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:new.html.twig', 
							array('formulaire' => $formulaire->createView()));
    }

    /**
     * Affiche les informations concernant une analyse.
     */
    public function showAction($id)
    {
		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:show.html.twig', 
							array('analyse' => $this->getAnalyse($id)));
    }

    /**
     * Affiche le formulaire d'édition d'une analyse.
     */
    public function editAction($id)
    {
		// Récupération de l'analyse.
        $analyse = $this->getAnalyse($id);

		// Création du formulaire.
        $formulaire = $this->createForm(new AnalyseType(), $analyse);

		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:edit.html.twig', 
							array('analyse' 	 => $analyse,
								  'formulaire'   => $formulaire->createView()));
    }

    /**
     * Édite les informations d'une analyse.
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération de l'analyse.
        $analyse = $this->getAnalyse($id);
        
        // Enregistrement du formulaire.
        if ($this->saveAnalyse($request, $analyse, $formulaire))
        {
            return $this->redirect($this->generateUrl('analyse_show', array('id' => $analyse->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Analyse:edit.html.twig',
                                 array('analyse'    => $analyse,
                                       'formulaire' => $formulaire->createView()));
        }
    }

    /**
     * Récupère une analyse depuis la base de données grâce à son id.
     */
    private function getAnalyse($id)
    {
        // Récupération de l'analyse.
        $analyse = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Analyse')->find($id);
        
        // Si l'analyse n'existe pas, génération d'une erreur 404.
        if (!$analyse)
        {
            throw $this->createNotFoundException('Impossible de trouver l\'analyse.');
        }
         
        // Renvoie de l'analyse.
        return $analyse;
    }

    /**
     * Tente de sauvegarder une analyse dans la base de données.
     */
    private function saveAnalyse(Request $request,
                                 $analyse,
                                 &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new AnalyseType(), $analyse);
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // On enregistre le type d'analyse dans la base de données.
            $em->persist($analyse);
            $em->flush();
            
            return true;
        }

        return false;
    }
}
