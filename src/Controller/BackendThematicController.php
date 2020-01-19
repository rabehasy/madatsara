<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendThematicController extends AbstractController
{
    /**
     * @Route("/backend/thematic", name="backend_thematic")
     */
    public function index()
    {
        return $this->render('backend/thematic/index.html.twig', [
            'controller_name' => 'BackendThematicController',
        ]);
    }
}
