<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendSubscribenewsletterController extends AbstractController
{
    /**
     * @Route("/backend/subscribenewsletter", name="backend_subscribenewsletter")
     */
    public function index()
    {
        return $this->render('backend/subscribenewsletter/index.html.twig', [
            'controller_name' => 'BackendSubscribenewsletterController',
        ]);
    }
}
