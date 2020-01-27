<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_user_")
 */
class BackendUserController extends AbstractController
{
    /**
     * @Route("/user", name="index")
     */
    public function index()
    {
        return $this->render('@backend/user/index.html.twig', [
            'controller_name' => 'BackendUserController',
        ]);
    }
}
