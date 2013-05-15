<?php

namespace Kemistra\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Kemistra\MainBundle\Entity\TypeMateriel;





class DonneesGlobales implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $d['entonnoirVerre'] = new TypeMateriel();
        $d['entonnoirVerre']->setNom('Entonoir de verre');
        
        $d['entonnoirPlastique'] = new TypeMateriel();
        $d['entonnoirPlastique']->setNom('Entonoir de plastique');
        
        $d['agitateur'] = new TypeMateriel();
        $d['agitateur']->setNom('Agitateur en verre');
        $d['agitateur']->setDescription('Petite baguette permettant d\'agiter le contenu liquide d\'un bécher.');
        
        $d['poireAspiration'] = new TypeMateriel();
        $d['poireAspiration']->setNom('Poire d\'aspiration');
        $d['poireAspiration']->setDescription('Permetant d\'aspirer un liquide dans une pipette.');
        
        $d['spatuleInox'] = new TypeMateriel();
        $d['spatuleInox']->setNom('Spatule en inox');
        $d['spatuleInox']->setDescription('Permettant de prélever une petite quantité de réactif solide (en poudre).');
        
        $d['agitateurMagnetique'] = new TypeMateriel();
        $d['agitateurMagnetique']->setNom('Agitateur magnétique');
        $d['agitateurMagnetique']->setDescription('Machine équipée d\'un aimant pouvant être mis en rotation. Combiné à un barreau aimanté, il permet de maintenir un milieu liquide en agitation.');
        
        $d['barreauAimante'] = new TypeMateriel();
        $d['barreauAimante']->setNom('Barreau aimanté');
        $d['barreauAimante']->setDescription('Petite barre aimantée étant utilisée avec un agitateur magnétique afin de maintenir un milieu liquide en agitation.');
        
        
        foreach ($d as$e)
        {
            $em->persist($e);
        }
        
        $em->flush();
    }
}
