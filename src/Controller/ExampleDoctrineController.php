<?php

namespace App\Controller;

use App\Entity\Api;
use App\Entity\Artiste;
use App\Repository\ApiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/example/doctrine/show/{id}", name="example_doctrine_show")
     */
    // http://madatsara.localhost/example/doctrine/show/1
    public function show($id)
    {

        $api = $this->getDoctrine()->getRepository(Api::class)->find($id);

        return new Response('<body><p>' . $api->getName() . '</p></body>');
    }

    /**
     * @Route("/example/doctrine/show_other/{id}", name="example_doctrine_show_other")
     */
    // http://madatsara.localhost/example/doctrine/show_other/1
    public function show_other($id, ApiRepository $repository)
    {

        $api = $repository->find($id);

        return new Response('<body><p>show_other : ' . $api->getName() . '</p></body>');
    }

    /**
     * @Route("/example/paramconverterauto/{id}", name="example_paramconverterauto")
     */
    // http://madatsara.localhost/example/paramconverterauto/1
    public function paramconverter_auto(Api $api)
    {
        return new Response('<body><p>Name : ' . $api->getName() . '</p></body>');
    }

    /**
     * @Route("/example/paramconverterfindoneby/{name}", name="example_paramconverterfindoneby")
     */
    // http://madatsara.localhost/example/paramconverterfindoneby/ANDROID
    public function paramconverter_auto_findoneby(Api $api)
    {
        return new Response('<body><p>ID : ' . $api->getId() . '</p></body>');
    }

    /**
     * @Route("/example/paramconverterautoexpr/{api_id}", name="example_paramconverterautoexpr")
     * @Entity("api", expr="repository.find(api_id)")
     */
    // http://madatsara.localhost/example/paramconverterautoexpr/1
    public function paramconverter_auto_expr(Api $api)
    {
        return new Response('<body><p>Name : ' . $api->getName() . '</p></body>');
    }

    /**
     * @Route("/example/api/{id}/artiste/{artiste}", name="example_paramconverter_api_artiste")
     * @Entity("artiste", expr="repository.find(artiste)")
     */
    // http://madatsara.localhost/example/api/1/artiste/1
    public function paramconverter_api_artiste(Api $api, Artiste $artiste)
    {
        return new Response('<body><p>API : ' . $api->getName() . ' - ' . $artiste->getName() . '</p></body>');
    }
}
