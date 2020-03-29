<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_event_")
 */
class BackendEventController extends EasyAdminController
{
    /**
     * @Route("/event", name="index")
     */
    public function index()
    {
        return $this->render('@backend/event/index.html.twig', [
            'controller_name' => 'BackendEventController',
        ]);
    }


    public function copyAction()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository(Event::class)->find($id);

        // TODO Copy entity

        // redirect to the 'list' view of the given entity ...
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
        ));
    }

    public function copyBatchAction(array $ids)
    {
        $class = $this->entity['class'];
        $em = $this->getDoctrine()->getManagerForClass($class);

        foreach ($ids as $id) {
            $user = $em->find($id);
//            $user->approve();
        }

        $this->em->flush();

        // don't return anything or redirect to any URL because it will be ignored
        // when a batch action finishes, user is redirected to the original page
    }
}
