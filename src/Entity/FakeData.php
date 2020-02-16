<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FakeDataRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class FakeData
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hidden;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creele;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHidden(): ?bool
    {
        return $this->hidden;
    }

    public function setHidden(?bool $hidden): self
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getCreele(): ?\DateTimeInterface
    {
        return $this->creele;
    }

    public function setCreele(?\DateTimeInterface $creele): self
    {
        $this->creele = $creele;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreelePrePersist()
    {
        $this->creele = new \DateTime();
    }

    /**
     * @ORM\PostPersist()
     */
    public function setCreelePostPersist()
    {
        $this->creele = new \DateTime('next month');
    }
}
