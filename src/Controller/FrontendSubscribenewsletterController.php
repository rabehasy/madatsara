<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendSubscribenewsletterController extends AbstractController
{
    /**
     * @Route("/inscription-newsletter.html", name="frontend_subscribenewsletter")
     */
    public function index()
    {
        return $this->render('frontend/subscribenewsletter/index.html.twig', [
            'controller_name' => 'FrontendSubscribenewsletterController',
        ]);
    }
}
