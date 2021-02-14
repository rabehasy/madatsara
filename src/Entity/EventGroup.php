<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventGroupRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class EventGroup
{
    use TimeableTrait;
    use SluggableTrait;
    use EventRelatedTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isParent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="eventGroup")
     */
    private $events;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventGroup", inversedBy="eventGroups")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventGroup", mappedBy="parent")
     */
    private $eventGroups;

    public function __construct()
    {
        $this->eventGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getIsParent(): ?bool
    {
        return $this->isParent;
    }

    public function setIsParent(bool $isParent): self
    {
        $this->isParent = $isParent;

        return $this;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addEventGroup($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeEventGroup($this);
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEventGroups(): Collection
    {
        return $this->eventGroups;
    }

    public function addEventGroup(self $eventGroup): self
    {
        if (!$this->eventGroups->contains($eventGroup)) {
            $this->eventGroups[] = $eventGroup;
            $eventGroup->setParent($this);
        }

        return $this;
    }

    public function removeEventGroup(self $eventGroup): self
    {
        if ($this->eventGroups->contains($eventGroup)) {
            $this->eventGroups->removeElement($eventGroup);
            // set the owning side to null (unless already changed)
            if ($eventGroup->getParent() === $this) {
                $eventGroup->setParent(null);
            }
        }

        return $this;
    }
}
