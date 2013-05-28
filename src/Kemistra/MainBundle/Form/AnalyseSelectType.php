<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnalyseSelectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', null, array('label' => 'Client : '))
            ->add('typeAnalyse', null, array('label' => 'Type d\'analyse : '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\Analyse'
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_analyseselecttype';
    }
}
