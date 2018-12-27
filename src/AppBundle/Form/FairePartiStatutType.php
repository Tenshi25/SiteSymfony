<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FairePartiStatutType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('groupe', EntityType::class, array(
            'class'=>'AppBundle\Entity\Groupe',
            'choice_label'=>'nom',
            'expanded'=> false,
            'multiple'=>false))
            ->add('personne', EntityType::class, array(
                'class'=>'AppBundle\Entity\Personne',
                'choice_label'=>'nom',
                'expanded'=> false,
                'multiple'=>false
            ))
            ->add('statut', EntityType::class, array(
                'class'=>'AppBundle\Entity\Statut',
                'choice_label'=>'nom',
                'expanded'=> false,
                'multiple'=>false
            ))
        ;
        //add('groupe')->add('personne')->add('statut');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FairePartiStatut'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_fairepartistatut';
    }


}
