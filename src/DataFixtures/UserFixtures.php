<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public const BOT_USER = 'BOT_USER';
    public const BOT_USERNAME = 'madatsara@gmail.com';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            self::BOT_USERNAME => 'test',
        ];

        foreach ($users as $login => $password) {
            $user = new User();
            $user->setEmail($login);
            $password = $this->encoder->encodePassword($user, $password);
            $user->setPassword($password);
            $user->setRoles([]);

            if (self::BOT_USERNAME === $login) {
                $this->addReference(self::BOT_USER, $user);
            }

            $manager->persist($user);

            $manager->flush();
        }
    }
}
