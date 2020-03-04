<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendDefaultController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="frontend_default",
     *     host="{domain}",
     *     defaults={"domain"="madatsara.localhost"},
     *     requirements={"domain"="madatsara.localhost|madatsara.com|dev.madatsara.com"}
     * )
     */
    public function index()
    {
        return $this->render('frontend/default/index.html.twig', [
            'controller_name' => __METHOD__,
        ]);
    }
}
