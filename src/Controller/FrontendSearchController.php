<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendSearchController extends AbstractController
{
    /**
     * @Route("/recherche.html", name="frontend_search")
     */
    public function index()
    {
        return $this->render('frontend/search/index.html.twig', [
            'controller_name' => 'FrontendSearchController',
        ]);
    }
}
