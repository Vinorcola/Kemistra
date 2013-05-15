<?php

namespace Kemistra\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;





class TypeAnalyseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('label' => 'Nom : '))
            ->add('dureeEstimee', null, array('label' => 'Durée estimée : '))
            ->add('nombreEmployeNecessaire', null, array('label' => 'Nombre d\'employés nécessaires : '))
            ->add('description', null, array('label' => 'Description : '))
            ->add('fichier', 'file', array('label' => 'Protocole (.pdf) : ',
                                           'required' => false))
            ->add('typeResultats', 'collection', array('label' => 'Type de résultats : ',
                                                       'type' => new TypeResultatType(),
                                                       'allow_add' => true,
                                                       'allow_delete' => true))
            ->add('utilise', 'collection', array('label' => 'Matériel nécessaire : ',
                                                 'type' => new UtiliseType(),
                                                 'allow_add' => true,
                                                 'allow_delete' => true))
            ->add('typeConsommables')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kemistra\MainBundle\Entity\TypeAnalyse',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'kemistra_mainbundle_typeanalysetype';
    }
}
