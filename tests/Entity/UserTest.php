<?php

namespace App\Tests\Entity;

use App\Entity\Profile;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends kernelTestCase
{
    public function getEntity(): User
    {
        $user = new User();
        $user->setEmail('madatsara2@gmail.com');
        $user->setPassword('blabla');

        return $user;
    }

    public function assertHasErrors(User $user, int $errorCount = 0): void
    {
        self::bootKernel();
        $error = self::$container->get('validator')->validate($user);
        $this->assertCount($errorCount, $error);
    }

    public function testValid(): void
    {
        $user = $this->getEntity();
        $this->assertHasErrors($user, 0);
    }

    public function testInvalidEmail(): void
    {
        $user = $this->getEntity();
        // doit etre un email
        $user->setEmail('miary');

        $this->assertHasErrors($user, 1);
    }
}
