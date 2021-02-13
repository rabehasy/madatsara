<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatbotController extends AbstractController
{
    /**
     * @Route("/chatbot", name="chatbot")
     */
    public function index(): Response
    {
        return $this->render('api/chatbot/index.html.twig', [
            'controller_name' => 'ChatbotController',
        ]);
    }
}
