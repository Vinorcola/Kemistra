<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeResultatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('unite', null, array('label' => 'Unité : ',
                                       'required' => false))
            ->add('information', null, array('label' => 'Information concernant le résultat : '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\TypeResultat',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_typeresultattype';
    }
}
