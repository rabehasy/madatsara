<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Event
{
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Api", inversedBy="events")
     * @ORM\JoinColumn(nullable=true)
     */
    private $api;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Thematic", inversedBy="events")
     */
    private $thematic;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Date", inversedBy="events")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", inversedBy="events")
     */
    private $artiste;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Media", inversedBy="events")
     */
    private $media;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Organisateur", inversedBy="events")
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Place", inversedBy="events")
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AccessType", inversedBy="events")
     */
    private $accessType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EventGroup", inversedBy="events")
     * @ORM\JoinTable(name="event_group_related")
     */
    private $eventGroup;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MemberEvent", cascade={"persist", "remove"})
     */
    private $memberEvent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Hour", inversedBy="events")
     */
    private $hour;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    public function __construct()
    {
        $this->thematic = new ArrayCollection();
        $this->date = new ArrayCollection();
        $this->artiste = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->organisateur = new ArrayCollection();
        $this->place = new ArrayCollection();
        $this->eventGroup = new ArrayCollection();
        $this->hour = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getApi(): ?Api
    {
        return $this->api;
    }

    public function setApi(?Api $api): self
    {
        $this->api = $api;

        return $this;
    }

    /**
     * @return Collection|Thematic[]
     */
    public function getThematic(): Collection
    {
        return $this->thematic;
    }

    public function addThematic(Thematic $thematic): self
    {
        if (!$this->thematic->contains($thematic)) {
            $this->thematic[] = $thematic;
        }

        return $this;
    }

    public function removeThematic(Thematic $thematic): self
    {
        if ($this->thematic->contains($thematic)) {
            $this->thematic->removeElement($thematic);
        }

        return $this;
    }

    /**
     * @return Collection|Date[]
     */
    public function getDate(): Collection
    {
        return $this->date;
    }

    public function addDate(Date $date): self
    {
        if (!$this->date->contains($date)) {
            $this->date[] = $date;
        }

        return $this;
    }

    public function removeDate(Date $date): self
    {
        if ($this->date->contains($date)) {
            $this->date->removeElement($date);
        }

        return $this;
    }

    /**
     * @return Collection|Artiste[]
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(Artiste $artiste): self
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste[] = $artiste;
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): self
    {
        if ($this->artiste->contains($artiste)) {
            $this->artiste->removeElement($artiste);
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
        }

        return $this;
    }

    /**
     * @return Collection|Organisateur[]
     */
    public function getOrganisateur(): Collection
    {
        return $this->organisateur;
    }

    public function addOrganisateur(Organisateur $organisateur): self
    {
        if (!$this->organisateur->contains($organisateur)) {
            $this->organisateur[] = $organisateur;
        }

        return $this;
    }

    public function removeOrganisateur(Organisateur $organisateur): self
    {
        if ($this->organisateur->contains($organisateur)) {
            $this->organisateur->removeElement($organisateur);
        }

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlace(): Collection
    {
        return $this->place;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->place->contains($place)) {
            $this->place[] = $place;
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->place->contains($place)) {
            $this->place->removeElement($place);
        }

        return $this;
    }

    public function getAccessType(): ?AccessType
    {
        return $this->accessType;
    }

    public function setAccessType(?AccessType $accessType): self
    {
        $this->accessType = $accessType;

        return $this;
    }

    /**
     * @return Collection|EventGroup[]
     */
    public function getEventGroup(): Collection
    {
        return $this->eventGroup;
    }

    public function addEventGroup(EventGroup $eventGroup): self
    {
        if (!$this->eventGroup->contains($eventGroup)) {
            $this->eventGroup[] = $eventGroup;
        }

        return $this;
    }

    public function removeEventGroup(EventGroup $eventGroup): self
    {
        if ($this->eventGroup->contains($eventGroup)) {
            $this->eventGroup->removeElement($eventGroup);
        }

        return $this;
    }

    public function getMemberEvent(): ?MemberEvent
    {
        return $this->memberEvent;
    }

    public function setMemberEvent(?MemberEvent $memberEvent): self
    {
        $this->memberEvent = $memberEvent;

        return $this;
    }

    /**
     * @return Collection|Hour[]
     */
    public function getHour(): Collection
    {
        return $this->hour;
    }

    public function addHour(Hour $hour): self
    {
        if (!$this->hour->contains($hour)) {
            $this->hour[] = $hour;
        }

        return $this;
    }

    public function removeHour(Hour $hour): self
    {
        if ($this->hour->contains($hour)) {
            $this->hour->removeElement($hour);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function PrePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function PreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
