<?php

namespace App\Tests\Repository;

use App\DataFixtures\ClassroomFixtures;
use App\DataFixtures\TranslationFixtures;
use App\Entity\Translation;
use App\Repository\ClassroomRepository;
use App\Repository\SchoolTypeRepository;
use App\Repository\TranslationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TranslationRepositoryTest extends KernelTestCase
{
    use FixturesTrait;

    public function testCreatedAtNotNull(): void
    {
        self::bootKernel();
        $this->loadFixtures([TranslationFixtures::class]);
        $entity = self::$container->get(TranslationRepository::class)->findOneBy([
            'locale' => 'fr',
            'keytranslate' => 'menu.event',
        ]);

        $this->assertNotNull($entity->getCreatedAt());
    }

    public function testUpdatedAtNotNull(): void
    {
        self::bootKernel();

        /** @var Translation $entity */
        $entity = self::$container->get(TranslationRepository::class)->findOneBy([
            'locale' => 'fr',
            'keytranslate' => 'menu.event',
        ]);

        // Update data
        $entity->setKeytranslate('menu.event2');

        // flush
        self::$container->get(ManagerRegistry::class)->getManager()->flush();

        // Check if data is updated
        $this->assertNotNull($entity->getUpdatedAt());
    }
}
