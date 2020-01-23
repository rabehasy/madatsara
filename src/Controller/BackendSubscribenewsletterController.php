<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_subscribenewsletter_")
 */
class BackendSubscribenewsletterController extends AbstractController
{
    /**
     * @Route("/subscribenewsletter", name="index")
     */
    public function index()
    {
        return $this->render('backend/subscribenewsletter/index.html.twig', [
            'controller_name' => 'BackendSubscribenewsletterController',
        ]);
    }
}
