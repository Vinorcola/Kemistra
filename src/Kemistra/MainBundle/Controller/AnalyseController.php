<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Kemistra\MainBundle\Entity\Analyse;
use Kemistra\MainBundle\Entity\Resultat;
use Kemistra\MainBundle\Form\AnalyseSelectType;
use Kemistra\MainBundle\Form\AnalyseType;





/**
 * Analyse controller.
 */
class AnalyseController extends Controller
{
    /**
     * Affiche la liste des analyses.
     * @Secure(roles="ROLE_USER")
     */
    public function indexAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            // Récupération de la liste de toutes analyses.
            $analyses = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Analyse')->getAll();
        }
        else
        {
            $analyses = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Analyse')->getAllByEmploye($this->getUser()->getId());
        }
        
		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:index.html.twig', 
				             array('analyses' => $analyses));
    }
    
    
    
    
    
    /**
     * Affiche le formulaire de sélection du type d'analyse.
     * @Secure(roles="ROLE_USER")
     */
    public function newAction()
    {
		// Création de l'entité.
        $analyse = new Analyse();
        
        
        // Création du formulaire
        $formulaire = $this->createForm(new AnalyseSelectType(), $analyse);
        
		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:new.html.twig', 
                             array('formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Ajoute une nouvelle analyse vide.
     * @Secure(roles="ROLE_USER")
     */
    public function createAction(Request $request)
    {
		// Création de l'entité.
        $analyse  = new Analyse();
		
		// Enregistrement du formulaire.
        if ($this->saveAnalyseSelect($request, $analyse, $formulaire)) 
		{
            return $this->redirect($this->generateUrl('analyse_edit', array('id' => $analyse->getId())));
        }
		else
		{
			// Le formulaire est invalide. Nouvel affichage du formulaire.
			return $this->render('KemistraMainBundle:Analyse:new.html.twig', 
                                 array('formulaire' => $formulaire->createView()));
		}
    }
    
    
    
    
    
    /**
     * Affiche les informations concernant une analyse.
     * @Secure(roles="ROLE_USER")
     */
    public function showAction($id)
    {
        // Récupération de l'analyse.
        $analyse = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Analyse')->getOneDetails($id);
        
        // Si l'analyse n'existe pas, génération d'une erreur 404.
        if (!$analyse)
        {
            throw $this->createNotFoundException('Impossible de trouver l\'analyse.');
        }
        
        
        $listeEmployes = $analyse->getEmployes();
        if (!in_array($this->getUser(), $listeEmployes->toArray()) && !$this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedHttpException('Vous n\'avez pas accès à cette analyse car vous n\'y avez pas participé.');
        }
        
		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:show.html.twig', 
                             array('analyse' => $analyse));
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition d'une analyse.
     * @Secure(roles="ROLE_USER")
     */
    public function editAction($id)
    {
		// Récupération de l'analyse.
        $analyse = $this->getAnalyse($id);
        
        // On vérifie que l'utilisateur à le droit de modifier l'analyse.
        $listeEmployes = $analyse->getEmployes();
        if (count($listeEmployes) == 0)
        {
            // Premier enregistrement.
            $analyse->addEmploye($this->getUser());
        }
        else if (!in_array($this->getUser(), $listeEmployes->toArray()) && !$this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedHttpException('Vous n\'avez pas accès à l\'édition de cette analyse car vous n\'y avez pas participé.');
        }
        
		// Création du formulaire.
        $formulaire = $this->createForm(new AnalyseType(), $analyse);
        
		// Génération de la vue.
        return $this->render('KemistraMainBundle:Analyse:edit.html.twig', 
                             array('analyse'    => $analyse,
                                   'formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite les informations d'une analyse.
     * @Secure(roles="ROLE_USER")
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
    
    
    
    
    
    /**
     * Tente de sauvegarder une analyse dans la base de données.
     */
    private function saveAnalyseSelect(Request $request,
                                       $analyse,
                                       &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new AnalyseSelectType(), $analyse);
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // Création des entités résultat.
            $typesResultats = $analyse->getTypeAnalyse()->getTypeResultats();
            foreach ($typesResultats as $typeResultat)
            {
                $resultat = new Resultat();
                $resultat->setResultat(0);
                $resultat->setAnalyse($analyse);
                $resultat->setTypeResultat($typeResultat);
                
                $em->persist($resultat);
            }
            
            // On enregistre le type d'analyse dans la base de données.
            $em->persist($analyse);
            $em->flush();
            
            return true;
        }
        
        return false;
    }
}
