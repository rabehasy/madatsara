<?php

namespace App\EventListener;

use App\Entity\Event;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use function Symfony\Component\String\u;

class EventActionsPersist
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function PrePersist(Event $event, LifecycleEventArgs $eventArgs)
    {
        // setSlug
        $this->setSlugName($event);
    }

    private function setSlugName(Event $event)
    {
        // Convert to slug
        $slug = $this->slugger->slug($event->getName());

        // lowercase
        $slug = u($slug)->lower();

        // Update slug property
        $event->setSlug($slug);
    }
}
