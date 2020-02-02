<?php

namespace App\Form\Type;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class TaskType extends AbstractType
{
    private $transformer;

    public function __construct()
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'required_due_date' => false,
            'csrf_field_name' => '_token',
            'csrf_field_id' => 'task_item'

        ]);

        $resolver->addAllowedTypes('required_due_date', 'bool');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', TextType::class)
            ->add('todo')
            ->add('dueDate', DateType::class, ['required' => $options['required_due_date']])

            // File
            ->add('filepdf', FileType::class, [
                'required' => false,
                'label' => 'Document (PDF)',
                'mapped' => false,

                // Constraints unmapped field
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document'
                    ])
                ]
            ])

            ->add('tags', TextType::class)

            ->add(
                $builder->create('tags2', TextType::class)
                ->addModelTransformer(new CallbackTransformer(
                    function ($tagsAsArray) {
                        return !empty($tagsAsArray) ? implode(',', $tagsAsArray) : '';
                    },
                    function ($tagsAsString) {
                        return explode(',',$tagsAsString);
                    }
                ))
            )



            ->add('save', SubmitType::class, ['label'=>'Add task']);

        $builder->get('tags')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    return !empty($tagsAsArray) ? implode(',', $tagsAsArray) : '';
                },
                function ($tagsAsString) {
                    return explode(',',$tagsAsString);
                }
            ));
    }
}
