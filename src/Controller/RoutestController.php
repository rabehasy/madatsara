<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class RoutestController extends AbstractController
{
    /**
     * @Route("/routest", name="routest_get", methods={"GET"})
     */
    public function methodsGet()
    {
        return new Response('<body><h2>' . __METHOD__. '</h2></body>');
    }

    /**
     * @Route("/routest", name="routest_post", methods={"POST"})
     */
    public function methodsPost()
    {
        return new Response('<body><h2>' . __METHOD__. '</h2></body>');
    }

    /**
     * @Route(
     *     "/routest/expression",
     *     name="routest_expression",
     *     condition="context.getMethod() in ['GET'] and request.headers.get('User-Agent') matches '/firefox/i'"
     *     )
     */
    public function methodsGetExpressionFirefox()
    {
        return new Response('<body><h2>' . __METHOD__. '</h2></body>');
    }

    /**
     * @Route("/routest/p/{param}", name="routest_param")
     */
    // http://madatsara.localhost/routest/p/pr
    public function routeWithParam(String $param)
    {
        return new Response('<body><h2>' . __METHOD__. ' -- param : "' . $param . '"</h2></body>');
    }

    /**
     * @Route("/routest/pg/{page}", requirements={"page": "\d+"})
     */
    // http://madatsara.localhost/routest/pg/5200
    public function routeWithParamInt(int $page)
    {
        return new Response('<body><h2>' . __METHOD__. ' -- page :  ' . $page . ' </h2></body>');
    }

    /**
     * @Route("/routest/pr/{page<\d+>}")
     */
    // http://madatsara.localhost/routest/pr/5200
    public function routeWithParamInlineRequirements(int $page)
    {
        return new Response('<body><h2>' . __METHOD__. ' -- page :  ' . $page . ' </h2></body>');
    }

    /**
     * @Route("/routest/op/{page<\d+>?}/{param2?}")
     */
    // http://madatsara.localhost/routest/op/2
    public function routeWithOptionnalParam(int $page = 5, $param2 = 'optionnal')
    {
        return new Response('<body><h2>' . __METHOD__. ' -- page :  ' . $page . ' </h2></body>');
    }

    /**
     * @Route("/routest/pc/{date}")
     * @ParamConverter("date", options={"format": "!Y-m-d"})
     */
    // http://madatsara.localhost/routest/pc/2020-01-15 ✅
    // http://madatsara.localhost/routest/pc/15-10-2020 ❌
    public function routeParamConverterDate(\DateTime $date)
    {
        return new Response('<body><h2>' . __METHOD__. ' -- date :  ' . $date->format('d-m-Y') . ' </h2></body>');
    }

    /**
     * @Route(
     *     "/routest/sp/{_locale}/s.{_format}",
     *     locale="en",
     *     format="json",
     *     requirements={
     *      "_locale": "en|mg",
     *      "_format": "json"
     *     }
     * )
     */
    // http://madatsara.localhost/routest/sp/en/s.json ✅
    // http://madatsara.localhost/routest/sp/mg/s.json ✅
    // http://madatsara.localhost/routest/sp/en/s.html ❌
    public function routeSpecialParam()
    {
        return new Response('<body><h2>' . __METHOD__. ' </h2></body>');
    }

    /**
     * @Route(
     *     "/routest/xp/{param}",
     *     defaults={"param", "toto", "title": "titre de la page"}
     * )
     */
    // http://madatsara.localhost/routest/xp/mg ✅
    public function routeExtraParam($param, $title)
    {
        return new Response('<body><h2>' . __METHOD__. ' - title: ' . $title . ' </h2></body>');
    }

    /**
     * @Route(
     *     "/routest/tk/{token}",
     *     requirements={"token": ".+"}
     * )
     */
    // http://madatsara.localhost/routest/tk/dfdfdf/sdsds/ ✅
    public function routeSlashcharacter($token)
    {
        return new Response('<body><h2>' . __METHOD__. ' - token: ' . $token . ' </h2></body>');
    }

    /**
     * @Route(
     *     "/routest/na/{param}",
     *     name="routest_nameparam"
     * )
     */
    public function getNameAndParams(Request $request, $param)
    {
        $routeName = $request->attributes->get('_route');
        $routeParams = $request->attributes->get('_route_params');
        $routeAll = $request->attributes->all();

        return new Response('<body><h2>' . __METHOD__. ' - routeName: ' . $routeName . ' - routeParams: ' . print_r($routeAll, true) . '  </h2></body>');
    }

    /**
     * @Route(
     *     "/",
     *     host="m.localho.st"
     * )
     */
    public function getNameAndParams(Request $request, $param)
    {
        $routeName = $request->attributes->get('_route');
        $routeParams = $request->attributes->get('_route_params');
        $routeAll = $request->attributes->all();

        return new Response('<body><h2>' . __METHOD__. ' - routeName: ' . $routeName . ' - routeParams: ' . print_r($routeAll, true) . '  </h2></body>');
    }
}
