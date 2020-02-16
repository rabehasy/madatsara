<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use function Symfony\Component\String\u;

/**
 * @Route("/fonctionctrl", name="fonctionctrl_")
 */
class FonctionctrlController extends AbstractController
{
    /**
     * @Route("/errorpage", name="errorpage")
     */
    // http://madatsara.localhost/fonctionctrl/errorpage
    public function errorpage()
    {
        throw $this->createNotFoundException('Not exists');

        return $this->render('fonctionctrl/index.html.twig', [
            'controller_name' => 'FonctionctrlController',
        ]);
    }

    /**
     * @Route("/request", name="requestget")
     */
    // http://madatsara.localhost/fonctionctrl/request
    public function requestget(Request $request)
    {
        $ret = implode('<br>', [
            '$_GET[page]: ' . $request->query->get('page', 10)
        ]);
        return new Response('<body>' . $ret . '</body>');

    }

    /**
     * @Route("/session", name="requestget")
     */
    // http://madatsara.localhost/fonctionctrl/session
    public function sessionget(SessionInterface $session)
    {

        $session->set('name', 'miary');

        $ret = implode('<br>', [
            '$_SESSION[name]: ' . $session->get('name')
        ]);
        return new Response('<body>' . $ret . '</body>');

    }

    /**
     * @Route("/flashmessages", name="flashmessages")
     */
    // http://madatsara.localhost/fonctionctrl/flashmessages
    public function showflash(Request $request)
    {

        if ($request->query->get('flash')) {

            // set flash
            $this->addFlash(
                'notice',
                'Ok flash message declenché'
            );

            // redirect
            return $this->redirectToRoute('fonctionctrl_flashmessages');

        }
        return $this->render('fonctionctrl/index.html.twig');

    }

    /**
     * @Route("/getparameter", name="getparameter")
     */
    // http://madatsara.localhost/fonctionctrl/getparameter
    public function parameter()
    {


        $ret = implode('<br>', [
            'parameter "kernel.project_dir": ' . $this->getparameter('kernel.project_dir') // /var/www/madatsara.com/symfony5.1
        ]);
        return new Response('<body>' . $ret . '</body>');

    }

    /**
     * @Route("/responsejson", name="responsejson")
     */
    // http://madatsara.localhost/fonctionctrl/responsejson
    public function responsejson()
    {


        $ret =  [
            'parameter "kernel.project_dir": ' . $this->getparameter('kernel.project_dir') // /var/www/madatsara.com/symfony5.1
        ] ;
        return $this->json($ret); // ["parameter \u0022kernel.project_dir\u0022: \/var\/www\/madatsara.com\/symfony5.1"]

    }

    /**
     * @Route("/forward-contact", name="forward")
     */
    // http://madatsara.localhost/fonctionctrl/forward-contact
    public function setForward()
    {


        return $this->forward(
            'App\Controller\FrontendContactController::index',
            []
        );
    }

    /**
     * @Route("/dump-twig", name="dump_twig")
     */
    // http://madatsara.localhost/fonctionctrl/dump-twig
    public function dumpTwig()
    {


        return $this->render('fonctionctrl/dump_twig.html.twig');
    }


    /**
     * @Route("/slug", name="slug_example")
     */
    // http://madatsara.localhost/fonctionctrl/slug
    public function slugexample(SluggerInterface $slugger)
    {

        $texteSlugifie = $slugger->slug("Nouvel an des DJS&nbsp;Présentée par Takariva.com pour commencer l'année 2013 en beauté&nbsp;HAP");

        $texteSlugifie = u($texteSlugifie)->lower();

        return new Response('<body>' . $texteSlugifie . '</body>');
    }

}
