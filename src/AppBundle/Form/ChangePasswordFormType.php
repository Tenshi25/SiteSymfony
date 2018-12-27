<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('change', 'submit', array(
            'label' => 'password.update.Mettre à jour',
            'translation_domain' => 'FOSUserBundle',
            'attr' => array(
                'class' => 'btn btn-primary'
            )
        ));
    }

    public function getName()
    {
        return 'me_user_change_password';
    }
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ChangePasswordFormType ';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }




}
