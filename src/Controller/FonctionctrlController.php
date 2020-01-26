<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

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


}
