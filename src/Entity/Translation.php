<?php

namespace App\Entity;

use App\Loader\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 */
class Translation implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"group:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read"})
     * @Assert\NotBlank()
     */
    private $domain;

    /**
     * @ORM\Column(type="string", length=2)
     * @Groups({"group:read"})
     * @Assert\NotBlank()
     */
    private $locale;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"group:read"})
     * @Assert\NotBlank()
     */
    private $keytranslate;

    /**
     * @ORM\Column(type="text")
     * @Groups({"group:read"})
     * @Assert\NotBlank()
     */
    private $translation;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Groups({"group:read"})
     */
    private $translationType;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="translations")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
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

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getKeytranslate(): ?string
    {
        return $this->keytranslate;
    }

    public function setKeytranslate(string $keytranslate): self
    {
        $this->keytranslate = $keytranslate;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): self
    {
        $this->translation = $translation;

        return $this;
    }

    public function getTranslationType(): ?string
    {
        return $this->translationType;
    }

    public function setTranslationType(?string $translationType): self
    {
        $this->translationType = $translationType;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->getTranslation();
    }

    public function setName(?string $name): ?self
    {
        return $this->setTranslation($name);
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
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

    public function load(array $params): EntityInterface
    {
        return $this;
    }
}
