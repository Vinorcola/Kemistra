<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnalyseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date', array('label' => 'Date : ',
                                        'years' => range(date('Y') - 5, date('Y'))))
            ->add('client', null, array('label' => 'Client : '))
            ->add('employes', null, array('label' => 'Employés : '))
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
        return 'kemistra_mainbundle_analysetype';
    }
}
