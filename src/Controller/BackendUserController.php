<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendUserController extends AbstractController
{
    /**
     * @Route("/backend/user", name="backend_user")
     */
    public function index()
    {
        return $this->render('backend/user/index.html.twig', [
            'controller_name' => 'BackendUserController',
        ]);
    }
}
