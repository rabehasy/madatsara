<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostalAdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Adress1', TextType::class)
            ->add('Adress2', TextType::class)
            ->add('City', TextType::class)
            ->add('ZipCode', TextType::class);

        if (true === $options['is_extended_address']) {
            $builder->add('Adress3', TextType::class);
        }

        if (null !== $options['allowed_states']) {
            $builder->add('State', ChoiceType::class, [
                'choices' => $options['allowed_states'],
            ]);
        } else {
            $builder->add('State', TextType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       // define options
        $resolver->setDefaults([
            'allowed_states' => null,
            'is_extended_address' => false
        ]);

        // Validate options
        $resolver->setAllowedTypes('allowed_states', ['null', 'string', 'array']);
        $resolver->setAllowedTypes('is_extended_address', 'bool');

        // Normalize - convert values to array if its not array
        $resolver->setNormalizer('allowed_states', static function (Options $options, $states) {
            if (null === $states) {
                return $states;
            }

            if (is_string($states)) {
                $states = (array) $states;
            }

            return array_combine(array_values($states), array_values($states));
        });
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['isExtendedAddress'] = $options['is_extended_address'];
    }
}
