<?php

namespace App\DataFixtures;

use App\Entity\Translation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TranslationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $list = [
            'mg' => [
                'domain' => [
                    'menu.event' => 'Hetsika',
                    'menu.my_account' => 'Voatokana ho ahy',
                    'menu.twitter' => 'Twitter',
                    'menu.facebook' => 'Facebook',
                    'menu.youtube' => 'Youtube',
                    'menu.email' => 'E-mail',
                ],
            ],
            'fr' => [
                'domain' => [
                    'menu.event' => 'Evénements',
                    'menu.my_account' => 'Mon compte',
                    'menu.twitter' => 'Twitter',
                    'menu.facebook' => 'Facebook',
                    'menu.youtube' => 'Youtube',
                    'menu.email' => 'E-mail',
                ],
            ],
            'en' => [
                'domain' => [
                    'menu.event' => 'Events',
                    'menu.my_account' => 'My account',
                    'menu.twitter' => 'Twitter',
                    'menu.facebook' => 'Facebook',
                    'menu.youtube' => 'Youtube',
                    'menu.email' => 'E-mail',
                ],
            ],
        ];

        foreach ($list as $lang => $domain) {
            foreach ($domain as $keyDomain => $translations) {
                foreach ($translations as $key => $translation) {
                    $entity = new Translation();
                    $entity->setCreatedBy($this->getReference(UserFixtures::BOT_USER));
                    $entity->setKeytranslate($key);
                    $entity->setTranslation($translation);
                    $entity->setDomain('messages+intl-icu');
                    $entity->setLocale($lang);
                    $entity->setTranslationType($keyDomain);

                    $manager->persist($entity);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
