<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendOrganisateurController extends AbstractController
{
    /**
     * @Route("/backend/organisateur", name="backend_organisateur")
     */
    public function index()
    {
        return $this->render('backend/organisateur/index.html.twig', [
            'controller_name' => 'BackendOrganisateurController',
        ]);
    }
}
