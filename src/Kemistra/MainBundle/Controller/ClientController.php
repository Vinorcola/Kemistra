<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kemistra\MainBundle\Entity\Client;
use Kemistra\MainBundle\Form\ClientType;
use Kemistra\MainBundle\Form\ClientProType;





/**
 * Client controller.
 *
 */
class ClientController extends Controller
{
    /**
     * Affiche la liste des clients.
     */
    public function indexAction()
    {
        // Récupération de la liste des clients.
        $repository = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Client');
        $clientsParticuliers = $repository->getListeParticuliers();
        $clientsProfessionnels = $repository->getListeProfessionels();
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Client:index.html.twig',
                             array('clientsParticuliers' => $clientsParticuliers,
                                   'clientsProfessionnels' => $clientsProfessionnels));
    }
    
    
    
    
    
    /**
     * Ajoute un nouvel client.
     */
    public function createAction(Request $request)
    {
        // Création de l'entité.
        $client  = new Client();
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveClient($request, $client, $formulaire))
        {
            return $this->redirect($this->generateUrl('client_show', array('id' => $client->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Client:new.html.twig',
                                 array('formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'ajout d'un nouvel client.
     */
    public function newAction()
    {
        // Création de l'entité et du formulaire.
        $client = new Client();
        $formulaire = $this->createForm(new ClientType(), $client);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Client:new.html.twig',
                             array('formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Affiche les informations concernant un client.
     */
    public function showAction($id)
    {
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Client:show.html.twig',
                             array('client' => $this->getClient($id)));
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition d'un client.
     */
    public function editAction($id)
    {
        // Récupération de l'client.
        $client = $this->getClient($id);
        
        
        
        // Création du formulaire.
        $formulaire = $this->createForm(new ClientType(), $client);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Client:edit.html.twig',
                             array('client'    => $client,
                                   'formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite les informations d'un client.
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération de l'client.
        $client = $this->getClient($id);
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveClient($request, $client, $formulaire))
        {
            return $this->redirect($this->generateUrl('client_show', array('id' => $client->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Client:edit.html.twig',
                                 array('client'    => $client,
                                       'formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    /**
     * Affiche le formulaire d'édition d'un client.
     */
    public function editProAction($id)
    {
        // Récupération de l'client.
        $client = $this->getClient($id);
        
        
        
        // Création du formulaire.
        $formulaire = $this->createForm(new ClientProType(), $client);
        
        
        
        // Génération de la vue.
        return $this->render('KemistraMainBundle:Client:editpro.html.twig',
                             array('client'    => $client,
                                   'formulaire' => $formulaire->createView()));
    }
    
    
    
    
    
    /**
     * Édite les informations d'un client.
     */
    public function updateProAction(Request $request, $id)
    {
        // Récupération de l'client.
        $client = $this->getClient($id);
        
        
        
        // Enregistrement du formulaire.
        if ($this->saveClientPro($request, $client, $formulaire))
        {
            return $this->redirect($this->generateUrl('client_show', array('id' => $client->getId())));
        }
        else
        {
            // Le formulaire est invalide. Nouvel affichage du formulaire.
            return $this->render('KemistraMainBundle:Client:editpro.html.twig',
                                 array('client'    => $client,
                                       'formulaire' => $formulaire->createView()));
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Récupère un client depuis la base de données grâce à son id.
     */
    private function getClient($id)
    {
        // Récupération de l'client.
        $client = $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Client')->find($id);
        
        
        // Si l'client n'existe pas, génération d'une erreur 404.
        if (!$client)
        {
            throw $this->createNotFoundException('Impossible de trouver le client.');
        }
        
        
        // Renvoie de l'client
        return $client;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un client dans la base de données.
     */
    private function saveClient(Request $request,
                                 $client,
                                 &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new ClientType(), $client);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // Recherche de la ville.
            $ville = $em->getRepository('KemistraMainBundle:Ville')
                        ->findOneBy(array('nom'        => $client->getVille()->getNom(),
                                          'codePostal' => $client->getVille()->getCodePostal()));
            
            if ($ville)
            {
                // Si la ville existe, on remplace celle saisie par l'utilisateur.
                $client->setVille($ville);
            }
            
            // On enregistre le type d'analyse dans la base de données.
            $em->persist($client);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
    
    
    
    
    
    /**
     * Tente de sauvegarder un client dans la base de données.
     */
    private function saveClientPro(Request $request,
                                    $client,
                                    &$formulaire)
    {
        // Création du formulaire.
        $formulaire = $this->createForm(new ClientProType(), $client);
        
        
        // Récupération des données POST depuis la requête.
        $formulaire->bind($request);
        
        
        // Vérification du formulaire.
        if ($formulaire->isValid())
        {
            // Récupération de l'EntityManager.
            $em = $this->getDoctrine()->getManager();
            
            // Recherche de la ville.
            $ville = $em->getRepository('KemistraMainBundle:Ville')
                        ->findOneBy(array('nom'        => $client->getVille()->getNom(),
                                          'codePostal' => $client->getVille()->getCodePostal()));
            
            if ($ville)
            {
                // Si la ville existe, on remplace celle saisie par l'utilisateur.
                $client->setVille($ville);
            }
            
            // On enregistre le type d'analyse dans la base de données.
            $em->persist($client);
            $em->flush();
            
            return true;
        }
        
        
        return false;
    }
}
