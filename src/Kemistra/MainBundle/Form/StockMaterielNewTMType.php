<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockMaterielNewTMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeMateriel', new TypeMaterielType(), array('label' => 'Type de matériel : '))
            ->add('quantite', null, array('label' => 'Quantité : '))
            ->add('dateAchat', null, array('label' => 'Date d\'achat : '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\StockMateriel',
            'cascase_validation' => true
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_stockmaterielnewtmtype';
    }
}
