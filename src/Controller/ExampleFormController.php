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

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            return $this->redirectToRoute('frontend_default');
        }

        return $this->render('example_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
