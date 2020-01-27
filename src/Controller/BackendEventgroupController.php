<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_eventgroup_")
 */
class BackendEventgroupController extends AbstractController
{
    /**
     * @Route("/eventgroup", name="index")
     */
    public function index()
    {
        return $this->render('@backend/eventgroup/index.html.twig', [
            'controller_name' => 'BackendEventgroupController',
        ]);
    }
}
