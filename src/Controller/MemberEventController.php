<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberEventController extends AbstractController
{
    /**
     * @Route("/member/event", name="member_event")
     */
    public function index()
    {
        return $this->render('member/event/index.html.twig', [
            'controller_name' => 'MemberEventController',
        ]);
    }
}
