<?php

namespace App\Tests\Repository;

use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    use FixturesTrait;

    public function testCount(): void
    {
        self::bootKernel();
        $this->loadFixtures([UserFixtures::class]);
        $usersCount = self::$container->get(UserRepository::class)->count([]);
        $this->assertEquals(1, $usersCount);
    }
}
