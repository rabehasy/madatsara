<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendUserController extends AbstractController
{
    /**
     * @Route("/user", name="frontend_user")
     */
    public function index(): Response
    {
        return $this->render('frontend/user/index.html.twig', [
            'controller_name' => 'FrontendUserController',
        ]);
    }
}
