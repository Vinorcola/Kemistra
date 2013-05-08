<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;





class UtiliseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeMateriel', null, array('label' => 'Type de matériel'))
            ->add('quantite', null, array('label' => 'Quantité'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\Utilise',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_utilisetype';
    }
}

