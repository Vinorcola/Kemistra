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
                                        'years' => range(date('Y') - 5, date('Y')),
                                        'widget' => 'single_text',
                                        'format' => 'dd/MM/yyy',
                                        'attr' => array('class' => 'calendrier')))
            ->add('employes', null, array('label' => 'Employés : ',
                                          'multiple' => true))
            ->add('resultats', 'collection', array('label' => 'Résultats : ',
                                                   'type' => new ResultatType(),
                                                   'allow_add' => true,
                                                   'allow_delete' => true))
            /*->add('consommables', 'collection', array('label' => 'Consommables : ',
                                                      'type' => new ConsommableType(),
                                                      'allow_add' => true,
                                                      'allow_delete' => true));*/
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
