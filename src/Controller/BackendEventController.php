<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_event_")
 */
class BackendEventController extends AbstractController
{
    /**
     * @Route("/event", name="index")
     */
    public function index()
    {
        return $this->render('backend/event/index.html.twig', [
            'controller_name' => 'BackendEventController',
        ]);
    }
}
