<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_artiste_")
 */
class BackendArtisteController extends AbstractController
{
    /**
     * @Route("/artiste", name="index")
     */
    public function index()
    {
        return $this->render('backend/artiste/index.html.twig', [
            'controller_name' => 'BackendArtisteController',
        ]);
    }
}
