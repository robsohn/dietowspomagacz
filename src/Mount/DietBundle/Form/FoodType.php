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
            ->add(
                'name', 'text',
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Nazwa', 'class' => 'form-control'
                    )
                )
            )
            ->add('calories', 'number',
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Kalorie', 'class' => 'form-control'
                    )
                )
            )
            ->add('protein', 'number',
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Białka', 'class' => 'form-control'
                    )
                )
            )
            ->add('carbs', 'number',
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Węglowodany', 'class' => 'form-control'
                    )
                )
            )
            ->add('fat', 'number',
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Tłuszcze', 'class' => 'form-control'
                    )
                )
            )
            ->add('category', null,
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Kategoria', 'class' => 'form-control'
                    )
                )
            )
            ->add('servingSize', null,
                array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Porcja', 'class' => 'form-control'
                    )
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mount\DietBundle\Entity\Food\Food'
        ));
    }

    public function getName()
    {
        return 'mount_dietbundle_foodtype';
    }
}
