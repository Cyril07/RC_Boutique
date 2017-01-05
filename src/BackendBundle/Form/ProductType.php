<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use BackendBundle\Form\MotorType;
use BackendBundle\Form\EscType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref')
            ->add('price')
            ->add('lib')
            ->add('brand')
            ->add('category')
            ->add('secondCategory')
            ->add('motor')
            ->add('esc')
        ;
        //$builder->add('motor', MotorType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_product';
    }


}
