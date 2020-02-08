<?php

namespace App\Form\Type;

use App\Entity\Task;
use App\Form\Tag3Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('task', TextType::class, [
                'help' => '<b> ❓ Aide à la saisie</b>', // Help text
                'help_html' => true, // allow HTML tag inside help
                'help_attr' => [ // Help HTML attributes
                    'class' => 'class-aide'
                ]
            ])
            ->add('todo', TextType::class, [
                'block_name' => 'my_todo_likedname'
            ])
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

            ->add('category', CategoryType::class)

            ->add('tags3', CollectionType::class, [
                'entry_type' => Tag3Type::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true
            ])



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
