<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backend", name="backend_accesstype_")
 */
class BackendAccesstypeController extends AbstractController
{
    /**
     * @Route("/accesstype", name="index")
     */
    public function index()
    {
        return $this->render('@backend/accesstype/index.html.twig', [
            'controller_name' => 'BackendAccesstypeController',
        ]);
    }
}
