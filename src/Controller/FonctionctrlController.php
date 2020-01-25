<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FonctionctrlController extends AbstractController
{
    /**
     * @Route("/fonctionctrl", name="fonctionctrl")
     */
    public function errorpage()
    {
        throw $this->createNotFoundException('Not exists');

        return $this->render('fonctionctrl/index.html.twig', [
            'controller_name' => 'FonctionctrlController',
        ]);
    }
}
