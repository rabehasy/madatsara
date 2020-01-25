<?php

namespace App\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class ExtraLoader extends Loader
{

    private $isLoaded = false;

    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     *
     * @throws \Exception If something went wrong
     */
    public function load($resource, string $type = null)
    {
        if (true === $this->isLoaded) {
            throw new \RuntimeException('Do not add the "customloader" loader twice');
        }

        $routeCollection = new RouteCollection();

        // prepare a new route
        $path = '/customloader/{parameter}';
        $defaults = [
            '_controller' => 'App\Controller\RoutestController::customloader',
        ];
        $requirements = [
            'parameter' => '\d+',
        ];
        $route = new Route($path, $defaults, $requirements);

        // add the new route to the route collection
        $routeName = 'customloaderRoute';
        $routeCollection->add($routeName, $route);

        $this->isLoaded = true;

        return $routeCollection;
    }

    /**
     * Returns whether this class supports the given resource.
     *
     * @param mixed $resource A resource
     *
     * @return bool True if this class supports the given resource, false otherwise
     */
    public function supports($resource, string $type = null)
    {
        return 'customloader' === $type;
    }
}
