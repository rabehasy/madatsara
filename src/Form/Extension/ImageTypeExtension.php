<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageTypeExtension extends AbstractTypeExtension
{

    /**
     * Gets the extended types.
     *
     * @return string[]
     */
    public static function getExtendedTypes(): iterable
    {
        return [FileType::class];
    }
}
