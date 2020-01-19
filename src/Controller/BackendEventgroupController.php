<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendEventgroupController extends AbstractController
{
    /**
     * @Route("/backend/eventgroup", name="backend_eventgroup")
     */
    public function index()
    {
        return $this->render('backend/eventgroup/index.html.twig', [
            'controller_name' => 'BackendEventgroupController',
        ]);
    }
}
