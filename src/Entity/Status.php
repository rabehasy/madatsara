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
    use TimeableTrait;

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
