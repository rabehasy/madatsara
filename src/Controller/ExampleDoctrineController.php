<?php

namespace App\Controller;

use App\Entity\Api;
use App\Entity\Artiste;
use App\Entity\Event;
use App\Entity\FakeData;
use App\Form\Type\FakeDataType;
use App\Repository\ApiRepository;
use App\Repository\EventRepository;
use App\Repository\FakeDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/example/artiste/{artisteId}", name="example_paramconverter_option_id")
     * @ParamConverter("artiste", options={"id"="artisteId"})
     */
    // http://madatsara.localhost/example/artiste/1
    public function paramconverter_option_id(Artiste $artiste)
    {
        return new Response('<body><p>Artiste : ' . $artiste->getName() . '</p></body>');
    }

    /**
     * @Route("/example/paramconvertermapping/ap/{api}/ar/{artiste}", name="paramconverter_mapping")
     * @ParamConverter("api", options={"mapping": {"api": "name"}})
     * @ParamConverter("artiste", options={"mapping": {"artiste": "name"}})
     */
    // http://madatsara.localhost/example/paramconvertermapping/ap/ANDROID/ar/Bodo
    public function mapping_artisteapi(Api $api, Artiste $artiste)
    {
        return new Response('<body><p>API : ' . $api->getId() . ' - ' . $artiste->getId() . '</p></body>');
    }

    /**
     * @Route("/example/doctrine/crud/create", name="doctrine_crud_create")
     */
    // http://madatsara.localhost/example/doctrine/crud/create
    public function crud_create(Request $request, FakeDataRepository $fakeDataRepository)
    {


        $form = $this->createForm(FakeDataType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form['name']->getData();
            $description = $form['description']->getData();
            $age = $form['age']->getData();
            $hidden = $form['hidden']->getData();
            $creele = $form['creele']->getData();
            $data = [
                'name' => $name,
                'description' => $description,
                'age' => $age,
                'hidden' => $hidden,
                'creele' => $creele,
            ];

            $entityManager = $this->getDoctrine()->getManager();

            $fakeData = new FakeData();
            $fakeData->setName($name);
            $fakeData->setDescription($description);
            $fakeData->setAge($age);
            $fakeData->setHidden($hidden);
            $fakeData->setCreele($creele);

            // tell doctrine to save the API - no queries yet
            $entityManager->persist($fakeData);

            // executes the queries
            $entityManager->flush();

            // Create flash message
            $this->addFlash('notice', 'FakeData ' . $name . ' has been created');


            return $this->redirectToRoute('doctrine_crud_create');
        }

        $data = $fakeDataRepository->findAll();

        if ($request->query->get('age') > 0) {
            $age = $request->query->get('age');
//            $data = $fakeDataRepository->findAllGreatherThanAgeDQL($age);
//            $data = $fakeDataRepository->findAllGreatherThanAgeQueryBuilder($age);
            $data = $fakeDataRepository->findAllGreatherThanAgeSQL($age);
        }

        return $this->render('example_doctrine/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data,
        ]);
    }

    /**
     * @Route("/example/doctrine/crud/edit/{id}", name="doctrine_crud_edit")
     */
    // http://madatsara.localhost/example/doctrine/crud/edit/1
    public function crud_edit(Request $request, FakeData $fakeData)
    {


        $form = $this->createForm(FakeDataType::class, $fakeData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form['name']->getData();
            $description = $form['description']->getData();
            $age = $form['age']->getData();
            $hidden = $form['hidden']->getData();
            $creele = $form['creele']->getData();
            $data = [
                'name' => $name,
                'description' => $description,
                'age' => $age,
                'hidden' => $hidden,
                'creele' => $creele,
            ];

            $entityManager = $this->getDoctrine()->getManager();

            $fakeData->setName($name);
            $fakeData->setDescription($description);
            $fakeData->setAge($age);
            $fakeData->setHidden($hidden);
            $fakeData->setCreele($creele);

            $id = $fakeData->getId();

            // executes the queries
            $entityManager->flush();

            // Create flash message
            $this->addFlash('notice', 'FakeData ' . $name . ' (' . $id . ') has been updated');


            return $this->redirectToRoute('doctrine_crud_create');
        }

        return $this->render('example_doctrine/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/example/doctrine/crud/remove/{id}", name="doctrine_crud_remove")
     */
    // http://madatsara.localhost/example/doctrine/crud/remove/1
    public function crud_remove(FakeData $fakeData)
    {

            $entityManager = $this->getDoctrine()->getManager();

            $name = $fakeData->getName();
            $id = $fakeData->getId();

            $entityManager->remove($fakeData);

            // executes the queries
            $entityManager->flush();

            // Create flash message
            $this->addFlash('notice', 'FakeData ' . $name . ' (' . $id . ') has been removed');


            return $this->redirectToRoute('doctrine_crud_create');
    }

    /**
     * @Route("/example/doctrine/fetch_related_object", name="fetch_related_object")
     */
    // http://madatsara.localhost/example/doctrine/fetch_related_object
    public function fetch_related_object(EventRepository $eventRepository)
    {

        $event = $eventRepository->find(1);

        $apiName = $event->getApi()->getName();

        return new Response('<body>' . $apiName . '</body>');
    }

    /**
     * @Route("/example/doctrine/fetch_related_object_inverse", name="fetch_related_object_inverse")
     */
    // http://madatsara.localhost/example/doctrine/fetch_related_object_inverse
    public function fetch_related_object_inverse(ApiRepository $apiRepository)
    {

        $api = $apiRepository->find(1);

        $events = $api->getEvents();

        return new Response('<body>' . print_r($events[0]->getName(),true) . '</body>');
    }

    /**
     * @Route("/example/doctrine/fetch_related_object_onequery", name="fetch_related_object_onequery")
     */
    // http://madatsara.localhost/example/doctrine/fetch_related_object_onequery
    public function fetch_related_object_onequery(FakeDataRepository $fakeDataRepository)
    {

        $event = $fakeDataRepository->findOneByIdJoinedToApi(1);

        $api = $event->getApi();
        $apiName = $api->getName();

        return new Response('<body>' . $apiName . '</body>');
    }

    /**
     * @Route("/example/doctrine/event/persist", name="doctrine_event_persist")
     */
    // http://madatsara.localhost/example/doctrine/event/persist
    public function doctrine_event_persist(ApiRepository $apiRepository)
    {

            $arrData = [];

            // Create
            $entity = new Artiste();

            // Update
//            $entity = $apiRepository->find(3);
            $entity->setName('ajout de l\'artistééé');


            $entityManager = $this->getDoctrine()->getManager();

            // Create - tell doctrine to save the API - no queries yet
            $entityManager->persist($entity);

            // executes the queries
            $entityManager->flush();

            $arrData['name'] = $entity->getName();
            $arrData['slug'] = $entity->getSlug();

            $data = print_r($arrData,true);



        return new Response('<body>' . $data .  '</body>');
    }
}
