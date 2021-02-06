<?php

namespace App\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Extension\RuntimeExtensionInterface;

/**
 * Class Route.
 */
class Route implements RuntimeExtensionInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router, UrlGeneratorInterface $urlGenerator)
    {
        $this->router = $router;
        $this->urlGenerator = $urlGenerator;
    }

    public function path(string $name, array $params = []): string
    {
        $routeExists = null !== $this->router->getRouteCollection()->get($name);

        // Route name if exists
        if ($routeExists) {
            return $this->urlGenerator->generate($name, $params);
        }

        return 'javascript:;';
    }
}
