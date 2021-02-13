<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/member", name="member_event")
 */
class MemberEventController extends AbstractController
{
    /**
     * @Route("/event", name="member_event_index")
     */
    public function index(): Response
    {
        return $this->render('member/event/index.html.twig', [
            'controller_name' => 'MemberEventController',
        ]);
    }
}
