<?php

namespace Kemistra\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Kemistra\MainBundle\Entity\TypeMateriel;





class DonneesGlobales implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        // Les types de matériel
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
        
        $d['becher_500'] = new TypeMateriel();
        $d['becher_500']->
        
        
        
        // Les types de consommables
        $d['seringue'] = new TypeConsommable();
        $d['seringue']->setNom('Seringue 20 mL');
        $d['seringue']->setDescription('Seringue à usage unique pour faire des prélèvements de liquide.');
        $d['seringue']->setUnite('Unité');
        
        $d['acide_sulf'] = new TypeConsommable();
        $d['acide_sulf']->setNom('Acide sulfurique à 80 %');
        $d['acide_sulf']->setDescription('Acide sulfurique hautement concentré. A diluer avant d''utiliser.');
        $d['acide_sulf']->setUnite('mL');
        
        $d['eau_oxygenee'] = new TypeConsommable();
        $d['eau_oxygenee']->setNom('Eau oxygénée');
        $d['eau_oxygenee']->setDescription('Eau oxygénée.');
        $d['eau_oxygenee']->setUnite('mL');
        
        $d['diiode15'] = new TypeConsommable();
        $d['diiode15']->setNom('Diiode à 15 %');
        $d['diiode15']->setDescription('Solution de diiode (I2) dosée à 15 %.');
        $d['diiode15']->setUnite('mL');
        
        $d[''] = new TypeConsommable();
        $d['diiode02']->setNom('Diiode à 0,02N');
        $d['diiode02']->setDescription('Solution de diiode (I2) dosée à 0,02N.');
        $d['diiode02']->setUnite('mL');
        
        
        
        // Les types d'analyses
        $d['so2_libre'] = new TypeAnalyse();
        $d['so2_libre']->setNom('Dosage du SO2 Libre');
        
        
        
        (, NULL, '00:15:00', 1, 'Dose la quantité de SO2 libre dans une solution alimentaire.', '/protocoles/dosage_so2_libre.pdf'),
('Dosage du SO2 Total', NULL, '00:30:00', 1, 'Dosage du SO Total présent dans un échantillon alimentaire.', '/protocoles/dosage_so2_total.pdf'),
('Dosage de l''acide tartrique par la méthode au vanadate', NULL, '01:20:00', 2, 'Dosage de la quantité d''acide tartrique dans une solution alimentaire.', '/protocoles/dosage_acide_tartrique_methode_vanadate.pdf'),
        
        
        
        
        
        
        
        
        
        foreach ($d as$e)
        {
            $em->persist($e);
        }
        
        $em->flush();
    }
}
