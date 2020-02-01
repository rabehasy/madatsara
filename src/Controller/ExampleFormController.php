<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/example/form", name="example_form_")
 */
class ExampleFormController extends AbstractController
{
    /**
     * @Route("/simple", name="simple")
     */
    // http://madatsara.localhost/example/form/simple
    public function simple()
    {
        $task = new Task();

        $form = $this->createFormBuilder($task)
            ->setMethod('DELETE')
            ->setAction($this->generateUrl('example_form_simple'))

            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Add task'])
            ->getForm();

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/type", name="type")
     */
    // http://madatsara.localhost/example/form/type
    public function type(Request $request)
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task, [
            'method' => 'PUT',
            'action' => $this->generateUrl('example_form_type'),
            'required_due_date' => true
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            return $this->redirectToRoute('frontend_default');
        }

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/template", name="template")
     */
    // http://madatsara.localhost/example/form/template
    public function template(Request $request)
    {
        $task = new Task();
        $task->setTask('Overide template');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task, [
            'required_due_date' => true
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            return $this->redirectToRoute('frontend_default');
        }

        return $this->render('example_form/overideform.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/formfactory", name="formfactory")
     */
    // http://madatsara.localhost/example/form/formfactory
    public function formfactory(Request $request)
    {
        $task = new Task();
        $task->setTask('Overide template');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->get('form.factory')->createNamed('my_name', TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            return $this->redirectToRoute('frontend_default');
        }

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/guessing", name="guessing")
     */
    // http://madatsara.localhost/example/form/guessing
    public function guessing(Request $request)
    {
        $task = new Task();

        $form = $this->createFormBuilder($task)

            ->add('task')
            ->add('todo', null, ['attr' => ['maxlength' => 6]])
            ->add('dueDate', null)
            ->add('agreeTermsOfService', CheckboxType::class, ['mapped' => false])
            ->add('save', SubmitType::class, ['label' => 'Add task'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tos = $form->get('agreeTermsOfService')->getData();

            return new Response('<body><h1>Agree: ' . $tos . '</h1></body>');
        }

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/typereferences", name="typereferences")
     */
    // http://madatsara.localhost/example/form/typereferences
    public function typereferences(Request $request)
    {

        $collections = range('a', 'g');
        $form = $this->createFormBuilder()

            // Text  Fields
            ->add('TextTypeInheritOptions', TextType::class, [
                'label' => 'Champ avec Inherit options',
                'disabled' => true, // disabled attribute
                'help' => '<b>Texte aide</b>', // Help text
                'help_html' => true, // allow HTML tag inside help
                'help_attr' => [ // Help HTML attributes
                    'class' => 'class-aide'
                ],
                'row_attr' => [
                    'class' => 'group-row-text',
                    'id' => 'o785emlf'
                ],
                'attr' => [
                    'class' => 'input-text',
                    'data-id' => 'd-o785emlf'
                ],
                'data' => 'Valeur par defaut', // value of field
                'empty_data' => 'John Doe', // Value saved if field is null or blank
            ]) // <input type="text" name="form[TextTypeGuessing]">


            ->add('TextType', TextType::class) // <input type="text" name="form[TextType]">
            ->add('TextareaType', TextareaType::class) // <textarea name="form[TextareaType]">
            ->add('EmailType', EmailType::class) // <input type="email" name="form[EmailType]">
            ->add('IntegerType', IntegerType::class) // <input type="number" name="form[IntegerType]">
            ->add('MoneyType', MoneyType::class) // <div><label>Money type</label><div><div class="input-group-prepend"><span class="input-group-text">€ </span></div><input type="text" name="form[MoneyType]" />
            ->add('NumberType', NumberType::class) // <input type="text" name="form[NumberType]" />
            ->add('PasswordType', PasswordType::class) // <input type="password" name="form[PasswordType]" />
            ->add('PercentType', PercentType::class) // <input type="text" name="form[PercentType]" />
            ->add('SearchType', SearchType::class) // <input type="text" name="form[SearchType]" />
            ->add('UrlType', UrlType::class) // <input type="text" name="form[UrlType]" inputmode="url" />
            ->add('RangeType', RangeType::class) // <input type="range" name="form[RangeType]" />
            ->add('TelType', TelType::class) // <input type="tel" name="form[TelType]" />
            ->add('ColorType', ColorType::class) // <input type="color" name="form[ColorType]" />

            // Choice Fields
            ->add('ChoiceType', ChoiceType::class, [
                'choices' => $collections
            ]) //
            ->add('CountryType', CountryType::class) //
            ->add('LanguageType', LanguageType::class) //
            ->add('LocaleType', LocaleType::class) //
            ->add('TimezoneType', TimezoneType::class) //
            ->add('CurrencyType', CurrencyType::class) //

            // Date and Time Fields
            ->add('DateType', DateType::class) //
            ->add('DateIntervalType', DateIntervalType::class) //
            ->add('DateTimeType', DateTimeType::class) //
            ->add('TimeType', TimeType::class) //
            ->add('BirthdayType', BirthdayType::class) //
            ->add('WeekType', WeekType::class) //

            // Other Fields
            ->add('CheckboxType', CheckboxType::class)
            ->add('FileType', FileType::class)
            ->add('RadioType', ChoiceType::class, [
                'choices' => [
                    'May be' => null,
                    'Yes' => true,
                    'No' => false
                ],
                'expanded' => true
            ]) // radioType

            // Field groups
            ->add('collections', CollectionType::class, [
                'entry_type' => EmailType::class
            ])


            // Button Fields
            ->add('SubmitType', SubmitType::class)

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tos = $form->get('agreeTermsOfService')->getData();

            return new Response('<body><h1>Agree: ' . $tos . '</h1></body>');
        }

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}