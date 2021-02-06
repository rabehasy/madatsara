<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class TreeviewExtension.
 */
class RouteExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('path',
                [Route::class, 'path']
            ),
        ];
    }
}
