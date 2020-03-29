<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Routing\Annotation\Route;

class BackendDashboardController extends EasyAdminController
{
    /**
     * @Route("/backend/dashboard", name="backend_dashboard")
     */
    public function index()
    {
        return $this->render('@EasyAdmin/page/blank.html.twig', ['mavar' => __METHOD__ ]);
    }
}
