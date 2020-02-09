<?php

namespace App\Twig;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Twig\Extension\RuntimeExtensionInterface;

class AppWidget implements RuntimeExtensionInterface
{
    private $param;

    public function __construct(ContainerBagInterface $param)
    {
        $this->param = $param;
    }

    public function widgetRecaptcha()
    {

        $key = $this->param->get('service.google.recatcha.key');

        // recaptcha v2
        $html = <<<WIDGET
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="g-recaptcha" data-sitekey="${'key'}"></div>
WIDGET;

        // If empty key
        if ($key === '') {
            return '';
        }

        return $html;
    }



}
