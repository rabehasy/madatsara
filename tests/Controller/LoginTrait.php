<?php

namespace App\Tests\Controller;

trait LoginTrait
{
    public function getPathFixtures(): array
    {
        return [
            __DIR__.'/../fixtures/users.yaml',
            __DIR__.'/../fixtures/event.yaml',
            __DIR__.'/../fixtures/artiste.yaml',
            __DIR__.'/../fixtures/organisateur.yaml',
            __DIR__.'/../fixtures/place.yaml',
            __DIR__.'/../fixtures/thematic.yaml',
            __DIR__.'/../fixtures/access_type.yaml',
        ];
    }
}
