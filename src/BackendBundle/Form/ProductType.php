<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use BackendBundle\Form\MotorType;
use BackendBundle\Form\EscType;
use BackendBundle\Form\BatteryType;
use BackendBundle\Form\BodyType;
use BackendBundle\Form\KitType;
use BackendBundle\Form\OilType;
use BackendBundle\Form\TiresType;


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
            ->add('picture', FileType::class)
            ->add('motor')
            ->add('esc')
            ->add('battery')
            ->add('body')
            ->add('kit')
            ->add('oil')
            ->add('tires')
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
