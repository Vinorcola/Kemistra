<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('label' => 'Nom'))
            ->add('prenom', null, array('label' => 'Prénom'))
            ->add('adresse', null, array('label' => 'Adresse'))
            ->add('telephone', null, array('label' => 'Téléphone'))
            ->add('email', null, array('label' => 'Email'))
            ->add('ville', new VilleType(), array('label' => ' '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Kemistra\MainBundle\Entity\Employe',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_employetype';
    }
}
