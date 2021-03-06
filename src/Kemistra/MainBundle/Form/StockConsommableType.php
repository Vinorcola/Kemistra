<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockConsommableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeConsommable', null, array('label' => 'Type de consommable : '))
            ->add('numeroLot', null, array('label' => 'Numéro de lot : '))
            ->add('quantiteAchetee', null, array('label' => 'Quantité achetée : '))
            ->add('quantiteRestante', null, array('label' => 'Quantité restante : '))
            ->add('datePeremption', null, array('label' => 'Date de péremption : ',
                                                'widget' => 'single_text',
                                                'format' => 'dd/MM/yyy',
                                                'attr' => array('class' => 'calendrier')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\StockConsommable'
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_stockconsommabletype';
    }
}
