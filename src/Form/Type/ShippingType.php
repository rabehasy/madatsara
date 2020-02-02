<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'abc' => 1,
                'def' => 4,
                'ghi' => 7,
                'jkl' => 10
            ]
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
