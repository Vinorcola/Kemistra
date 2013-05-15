<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;





class TypeMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('label' => 'Nom'))
            ->add('description', null, array('label' => 'Description',
                                             'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\TypeMateriel'
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_typematerieltype';
    }
}
