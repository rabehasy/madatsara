<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_thematic_")
 */
class BackendThematicController extends AbstractController
{
    /**
     * @Route("/thematic", name="index")
     */
    public function index()
    {
        return $this->render('backend/thematic/index.html.twig', [
            'controller_name' => 'BackendThematicController',
        ]);
    }
}
