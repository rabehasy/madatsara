<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendDashboardController extends AbstractController
{
    /**
     * @Route("/backend/dashboard", name="backend_dashboard")
     */
    public function index()
    {
        return $this->render('@EasyAdmin/page/blank.html.twig', ['mavar' => __METHOD__ ]);
    }
}
