<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Media
{
    use TimeableTrait;
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
    private $file;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="media")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Place", mappedBy="media")
     */
    private $places;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", mappedBy="media")
     */
    private $artistes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Organisateur", mappedBy="media")
     */
    private $organisateurs;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $main;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemberEvent", mappedBy="media")
     */
    private $memberEvents;

    public function __construct()
    {
        $this->places = new ArrayCollection();
        $this->artistes = new ArrayCollection();
        $this->organisateurs = new ArrayCollection();
        $this->memberEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function __toString()
    {
        return $this->getFile();
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addMedia($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeMedia($this);
        }

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->addMedia($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->places->contains($place)) {
            $this->places->removeElement($place);
            $place->removeMedia($this);
        }

        return $this;
    }

    /**
     * @return Collection|Artiste[]
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artiste $artiste): self
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes[] = $artiste;
            $artiste->addMedia($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): self
    {
        if ($this->artistes->contains($artiste)) {
            $this->artistes->removeElement($artiste);
            $artiste->removeMedia($this);
        }

        return $this;
    }

    /**
     * @return Collection|Organisateur[]
     */
    public function getOrganisateurs(): Collection
    {
        return $this->organisateurs;
    }

    public function addOrganisateur(Organisateur $organisateur): self
    {
        if (!$this->organisateurs->contains($organisateur)) {
            $this->organisateurs[] = $organisateur;
            $organisateur->addMedia($this);
        }

        return $this;
    }

    public function removeOrganisateur(Organisateur $organisateur): self
    {
        if ($this->organisateurs->contains($organisateur)) {
            $this->organisateurs->removeElement($organisateur);
            $organisateur->removeMedia($this);
        }

        return $this;
    }

    public function getMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(?bool $main): self
    {
        $this->main = $main;

        return $this;
    }

    /**
     * @return Collection|MemberEvent[]
     */
    public function getMemberEvents(): Collection
    {
        return $this->memberEvents;
    }

    public function addMemberEvent(MemberEvent $memberEvent): self
    {
        if (!$this->memberEvents->contains($memberEvent)) {
            $this->memberEvents[] = $memberEvent;
            $memberEvent->setMedia($this);
        }

        return $this;
    }

    public function removeMemberEvent(MemberEvent $memberEvent): self
    {
        if ($this->memberEvents->contains($memberEvent)) {
            $this->memberEvents->removeElement($memberEvent);
            // set the owning side to null (unless already changed)
            if ($memberEvent->getMedia() === $this) {
                $memberEvent->setMedia(null);
            }
        }

        return $this;
    }
}
