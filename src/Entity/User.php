<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastloginAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $settings;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tokenSocialNetwork;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NickName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailSocialNetwork;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idSocialNetwork;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SocialNetwork", inversedBy="users")
     */
    private $socialNetwork;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MemberEvent", mappedBy="user")
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getDisabledAt(): ?\DateTimeInterface
    {
        return $this->disabledAt;
    }

    public function setDisabledAt(?\DateTimeInterface $disabledAt): self
    {
        $this->disabledAt = $disabledAt;

        return $this;
    }

    public function getLastloginAt(): ?\DateTimeInterface
    {
        return $this->lastloginAt;
    }

    public function setLastloginAt(?\DateTimeInterface $lastloginAt): self
    {
        $this->lastloginAt = $lastloginAt;

        return $this;
    }

    public function getSettings(): ?string
    {
        return $this->settings;
    }

    public function setSettings(?string $settings): self
    {
        $this->settings = $settings;

        return $this;
    }

    public function getTokenSocialNetwork(): ?string
    {
        return $this->tokenSocialNetwork;
    }

    public function setTokenSocialNetwork(?string $tokenSocialNetwork): self
    {
        $this->tokenSocialNetwork = $tokenSocialNetwork;

        return $this;
    }

    public function getNickName(): ?string
    {
        return $this->NickName;
    }

    public function setNickName(?string $NickName): self
    {
        $this->NickName = $NickName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getEmailSocialNetwork(): ?string
    {
        return $this->emailSocialNetwork;
    }

    public function setEmailSocialNetwork(?string $emailSocialNetwork): self
    {
        $this->emailSocialNetwork = $emailSocialNetwork;

        return $this;
    }

    public function getIdSocialNetwork(): ?string
    {
        return $this->idSocialNetwork;
    }

    public function setIdSocialNetwork(?string $idSocialNetwork): self
    {
        $this->idSocialNetwork = $idSocialNetwork;

        return $this;
    }

    public function getSocialNetwork(): ?SocialNetwork
    {
        return $this->socialNetwork;
    }

    public function setSocialNetwork(?SocialNetwork $socialNetwork): self
    {
        $this->socialNetwork = $socialNetwork;

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
            $memberEvent->setUser($this);
        }

        return $this;
    }

    public function removeMemberEvent(MemberEvent $memberEvent): self
    {
        if ($this->memberEvents->contains($memberEvent)) {
            $this->memberEvents->removeElement($memberEvent);
            // set the owning side to null (unless already changed)
            if ($memberEvent->getUser() === $this) {
                $memberEvent->setUser(null);
            }
        }

        return $this;
    }
}
