<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

class EntitiesTranslationPersist
{
    public $kernel;
    public $fs;

    public function __construct(KernelInterface $kernel, Filesystem $fs)
    {
        $this->kernel = $kernel;
        $this->fs = $fs;
    }

    /**
     * DOMAIN = 2 / ENTITY = 1.
     */
    const ENTITY_TYPE = 'domain';

    /**
     * After Created.
     */
    public function postPersist(LifecycleEventArgs $args): bool
    {
        return $this->update($args);
    }

    /**
     * After Updated.
     */
    public function postUpdate(LifecycleEventArgs $args): bool
    {
        return $this->update($args);
    }

    /**
     * Remove all files inside /var/cache/translations.
     */
    private function clearCacheTranslations(): bool
    {
        $realCacheDir = $this->kernel->getContainer()->getParameter('kernel.cache_dir');

        foreach (glob($realCacheDir.'/translations/catalogue.*') as $file) {
            $this->fs->remove($file);
        }

        return true;
    }

    private function update(LifecycleEventArgs $args): bool
    {
        $update = false;

        $entity = $args->getObject();

        $class = get_class($entity);
        switch ($class) {
            case "App\Entity\Translation":
                $update = true;
                break;
        }

        if (!$update) {
            return false;
        }

        // entity ID
        $translationType = $entity->getTranslationType();

        // Do only if type is entity
        if (self::ENTITY_TYPE === $translationType) {
            // Remove all files inside /var/cache/translations
            $this->clearCacheTranslations();

            return false;
        }

        // Persist and flush
        $args->getObjectManager()->persist($entity);
        $args->getObjectManager()->flush();

        return true;
    }
}
