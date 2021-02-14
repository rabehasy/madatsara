<?php

namespace App\EventListener;

use App\Entity\Event;
use Symfony\Component\String\Slugger\SluggerInterface;
use function Symfony\Component\String\u;

class EventActionsPersist
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function PrePersist(Event $event): void
    {
        // setSlug
        $this->setSlugName($event);
    }

    private function setSlugName(Event $event): void
    {
        // Convert to slug
        $slug = $this->slugger->slug($event->getName());

        // lowercase
        $slug = u($slug)->lower();

        // Update slug property
        $event->setSlug($slug);
    }
}
