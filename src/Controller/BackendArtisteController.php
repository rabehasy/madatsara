<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendArtisteController extends AbstractController
{
    /**
     * @Route("/backend/artiste", name="backend_artiste")
     */
    public function index()
    {
        return $this->render('backend/artiste/index.html.twig', [
            'controller_name' => 'BackendArtisteController',
        ]);
    }
}
