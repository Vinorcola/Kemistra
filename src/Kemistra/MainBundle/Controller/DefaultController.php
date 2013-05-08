<?php

namespace Kemistra\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KemistraMainBundle:Default:index.html.twig');
    }
}
