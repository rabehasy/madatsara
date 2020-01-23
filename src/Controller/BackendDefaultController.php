<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_default_")
 */
class BackendDefaultController extends AbstractController
{
    /**
     * @Route("/default", name="index")
     */
    public function index()
    {
        return $this->render('backend/default/index.html.twig', [
            'controller_name' => 'BackendDefaultController',
        ]);
    }
}
