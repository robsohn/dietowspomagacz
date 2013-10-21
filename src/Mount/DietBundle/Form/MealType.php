<?php

namespace Mount\DietBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text',
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Nazwa', 'class' => 'form-control'
                    )
                )
            )
            ->add('type', null,
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Typ Posiłku', 'class' => 'form-control'
                    )
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mount\DietBundle\Entity\Meal\Meal'
        ));
    }

    public function getName()
    {
        return 'meal_form';
    }
}

