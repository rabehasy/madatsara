<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendDefaultController extends AbstractController
{
    /**
     * @Route("/backend/default", name="backend_default")
     */
    public function index()
    {
        return $this->render('backend/default/index.html.twig', [
            'controller_name' => 'BackendDefaultController',
        ]);
    }
}
