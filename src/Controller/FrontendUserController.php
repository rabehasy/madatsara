<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendUserController extends AbstractController
{
    /**
     * @Route("/user", name="frontend_user")
     */
    public function index()
    {
        return $this->render('frontend/user/index.html.twig', [
            'controller_name' => 'FrontendUserController',
        ]);
    }
}
