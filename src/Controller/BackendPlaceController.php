<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendPlaceController extends AbstractController
{
    /**
     * @Route("/backend/place", name="backend_place")
     */
    public function index()
    {
        return $this->render('backend/place/index.html.twig', [
            'controller_name' => 'BackendPlaceController',
        ]);
    }
}
