<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
    public function guessing()
    {
        $task = new Task();

        $form = $this->createFormBuilder($task)

            ->add('task')
            ->add('dueDate', null)
            ->add('save', SubmitType::class, ['label' => 'Add task'])
            ->getForm();

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
