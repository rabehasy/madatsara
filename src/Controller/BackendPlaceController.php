<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_place_")
 */
class BackendPlaceController extends AbstractController
{
    /**
     * @Route("/place", name="index")
     */
    public function index()
    {
        return $this->render('@backend/place/index.html.twig', [
            'controller_name' => 'BackendPlaceController',
        ]);
    }
}
