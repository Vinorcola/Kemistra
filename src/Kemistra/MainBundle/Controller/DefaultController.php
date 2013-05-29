<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;





class DefaultController extends Controller
{
    /**
     * Page d'accueil.
     */
    public function indexAction()
    {
        return $this->render('KemistraMainBundle:Default:index.html.twig');
    }
    
    
    
    
    
    /**
     * Page de login.
     */
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers la page d'accueil.
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            return $this->redirect($this->generate_url('homepage'));
        }
        
        $session = $request->getSession();
        
        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire.
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        return $this->render('KemistraMainBundle:Default:login.html.twig',
                             array('last_username' => $session->get(SecurityContext::LAST_USERNAME),
                                   'error'         => $error,
                                   'listeEmployes' => $this->getDoctrine()->getManager()->getRepository('KemistraMainBundle:Employe')->getAllForLogin()));
    }
}
