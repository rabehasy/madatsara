<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendContactController extends AbstractController
{
    /**
     * @Route("/contacter-madatsara.html", name="frontend_contact")
     */
    public function index()
    {
        return $this->render('frontend/contact/index.html.twig', [
            'controller_name' => 'FrontendContactController',
        ]);
    }
}
