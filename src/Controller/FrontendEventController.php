<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendEventController extends AbstractController
{
    /**
     * @Route("/evenements.html", name="frontend_event_all")
     */
    public function index()
    {
        return $this->render('frontend/event/index.html.twig', [
            'controller_name' => __METHOD__,
        ]);
    }

    /**
     * @Route("/evenements-mois.html", name="frontend_event_month")
     */
    public function month()
    {
        return $this->render('frontend/event/index.html.twig', [
            'controller_name' => __METHOD__,
        ]);
    }

    /**
     * @Route("/evenements-mois.html", name="frontend_event_month")
     */
    public function month()
    {
        return $this->render('frontend/event/index.html.twig', [
            'controller_name' => __METHOD__,
        ]);
    }
}
