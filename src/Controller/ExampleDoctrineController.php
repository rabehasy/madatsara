<?php

namespace App\Controller;

use App\Entity\Api;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExampleDoctrineController extends AbstractController
{
    /**
     * @Route("/example/doctrine/save", name="example_doctrine")
     */
    // http://madatsara.localhost/example/doctrine/save
    public function index()
    {

        $entityManager = $this->getDoctrine()->getManager();

        $api = new Api();
        $api->setName('ANDROID');

        // tell doctrine to save the API - no queries yet
        $entityManager->persist($api);

        // executes the queries
        $entityManager->flush();

        return $this->render('example_doctrine/index.html.twig', [
            'controller_name' => 'ExampleDoctrineController',
        ]);
    }
}
