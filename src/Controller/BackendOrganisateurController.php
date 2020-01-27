<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_organisateur_")
 */
class BackendOrganisateurController extends AbstractController
{
    /**
     * @Route("/organisateur", name="index")
     */
    public function index()
    {
        return $this->render('@backend/organisateur/index.html.twig', [
            'controller_name' => 'BackendOrganisateurController',
        ]);
    }
}
