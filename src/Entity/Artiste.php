<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtisteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Artiste
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="artiste")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", inversedBy="artistes")
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", mappedBy="parent")
     */
    private $artistes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Media", inversedBy="artistes")
     */
    private $media;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->parent = new ArrayCollection();
        $this->artistes = new ArrayCollection();
        $this->media = new ArrayCollection();
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

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addArtiste($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }

    public function addParent(self $parent): self
    {
        if (!$this->parent->contains($parent)) {
            $this->parent[] = $parent;
        }

        return $this;
    }

    public function removeParent(self $parent): self
    {
        if ($this->parent->contains($parent)) {
            $this->parent->removeElement($parent);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(self $artiste): self
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes[] = $artiste;
            $artiste->addParent($this);
        }

        return $this;
    }

    public function removeArtiste(self $artiste): self
    {
        if ($this->artistes->contains($artiste)) {
            $this->artistes->removeElement($artiste);
            $artiste->removeParent($this);
        }

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
