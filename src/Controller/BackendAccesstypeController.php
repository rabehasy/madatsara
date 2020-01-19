<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackendAccesstypeController extends AbstractController
{
    /**
     * @Route("/backend/accesstype", name="backend_accesstype")
     */
    public function index()
    {
        return $this->render('backend/accesstype/index.html.twig', [
            'controller_name' => 'BackendAccesstypeController',
        ]);
    }
}
