<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendDefaultController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="frontend_default"
     * )
     */
    public function index(): Response
    {
        return $this->render('frontend/default/index.html.twig', [
            'controller_name' => __METHOD__,
        ]);
    }
}
