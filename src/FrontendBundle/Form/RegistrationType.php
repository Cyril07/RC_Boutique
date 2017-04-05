<?php

namespace FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder          
            ->add('name_firstname',null,array('label'=>"Nom et prénom"))
            ->add('address',null,array('label'=>"Adresse"))
            ->add('city',null,array('label'=>"Ville"))
            ->add('postal_code',null,array('label'=>"Code Postale"))
        ;        
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    
}