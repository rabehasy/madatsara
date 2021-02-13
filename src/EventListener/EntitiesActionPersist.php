<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use function Symfony\Component\String\u;

class EntitiesActionPersist
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function PrePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        $class = get_class($entity);

        $entityToSlug = false;
        switch ($class) {
            case "App\Entity\Event":
            case "App\Entity\Artiste":
            case "App\Entity\Organisateur":
            case "App\Entity\Place":
            case "App\Entity\Commune":
            case "App\Entity\Region":
            case "App\Entity\Quartier":
            case "App\Entity\Thematic":
                $entityToSlug = true;
                break;
        }

        if (!$entityToSlug) {
            return;
        }

        if (is_null($entity->getName())) {
            return;
        }

        // setSlug
        $this->setSlugName($entity);
    }

    /**
     * @param mixed $entity
     */
    private function setSlugName($entity): void
    {
        // Convert to slug
        $slug = $this->slugger->slug($entity->getName());

        // lowercase
        $slug = u($slug)->lower();

        // Update slug property
        $entity->setSlug($slug);
    }
}
