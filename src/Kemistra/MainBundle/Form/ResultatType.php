<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResultatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resultat', null, array('label' => 'Résultat : '))
            ->add('analyse', null, array('label' => 'Analyse : '))
            ->add('typeResultat', null, array('label' => 'Type de résultat : '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\Resultat'
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_resultattype';
    }
}
