<?php

namespace Mount\DietBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('calories')
            ->add('fat')
            ->add('carbs')
            ->add('protein')
            ->add('category')
            ->add('servingSize')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mount\DietBundle\Entity\Food'
        ));
    }

    public function getName()
    {
        return 'mount_dietbundle_foodtype';
    }
}
