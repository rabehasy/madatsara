<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
//            new TwigFilter('price', [AppRuntime::class, 'formatPrice'])
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('widget_recaptcha', [AppWidget::class, 'widgetRecaptcha'])
        ];
    }


}
