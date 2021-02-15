<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FrontendControllerTest extends WebTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    private function openUrl(string $url, string $method = 'GET'): void
    {
        $client = static::createClient();
        $client->request($method, $url);
    }

    public function provideUrls(): array
    {
        return [
            ['/'], // Home
            ['/evenements.html'], // Event
        ];
    }

    /**
     * @dataProvider provideUrls
     */
    public function testResponse200(string $url): void
    {
        $this->openUrl($url);

        // HTTP/1.1 200 OK
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
