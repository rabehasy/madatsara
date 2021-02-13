<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Status
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disabledAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemberEvent", mappedBy="Status")
     */
    private $memberEvents;

    public function __construct()
    {
        $this->memberEvents = new ArrayCollection();
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

    public function setCreatedAt(\DateTimeInterface $createdAt): self
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

    public function getDisabledAt(): ?\DateTimeInterface
    {
        return $this->disabledAt;
    }

    public function setDisabledAt(?\DateTimeInterface $disabledAt): self
    {
        $this->disabledAt = $disabledAt;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function PrePersist(): void
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function PreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
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
            $memberEvent->setStatus($this);
        }

        return $this;
    }

    public function removeMemberEvent(MemberEvent $memberEvent): self
    {
        if ($this->memberEvents->contains($memberEvent)) {
            $this->memberEvents->removeElement($memberEvent);
            // set the owning side to null (unless already changed)
            if ($memberEvent->getStatus() === $this) {
                $memberEvent->setStatus(null);
            }
        }

        return $this;
    }
}
