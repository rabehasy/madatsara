<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendEventController extends AbstractController
{
    /**
     * @Route("/backend/event", name="backend_event")
     */
    public function index()
    {
        return $this->render('backend/event/index.html.twig', [
            'controller_name' => 'BackendEventController',
        ]);
    }
}
