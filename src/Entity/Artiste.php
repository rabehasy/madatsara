<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtisteRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Artiste", inversedBy="artistes")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Artiste", mappedBy="parent")
     */
    private $artistes;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->artistes = new ArrayCollection();
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
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(self $artiste): self
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes[] = $artiste;
            $artiste->setParent($this);
        }

        return $this;
    }

    public function removeArtiste(self $artiste): self
    {
        if ($this->artistes->contains($artiste)) {
            $this->artistes->removeElement($artiste);
            // set the owning side to null (unless already changed)
            if ($artiste->getParent() === $this) {
                $artiste->setParent(null);
            }
        }

        return $this;
    }
}
