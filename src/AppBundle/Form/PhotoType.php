<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('CentreInteret', EntityType::class, array(
                'class'=>'AppBundle\Entity\CentreInteret',
                'choice_label'=>'titre',
                'expanded'=> false,
                'multiple'=>false
            ))
            ->add('file',FileType::class,array('label'=>'image(JPG)','data_class'=>null,'required'=> false))
        ->add('type', ChoiceType::class, array(
        'choices'  => array(
            'Photo de tête' => 'photoPreview',
            'Photo de galerie' => 'photo',
        )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Photo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_photo';
    }


}
