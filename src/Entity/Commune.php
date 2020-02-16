<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuneRepository")
 */
class Commune
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
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="communes")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quartier", mappedBy="commune")
     */
    private $quartiers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Place", mappedBy="Commune")
     */
    private $places;

    public function __construct()
    {
        $this->quartiers = new ArrayCollection();
        $this->places = new ArrayCollection();
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

    public function getCountry(): ?int
    {
        return $this->country;
    }

    public function setCountry(?int $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Quartier[]
     */
    public function getQuartiers(): Collection
    {
        return $this->quartiers;
    }

    public function addQuartier(Quartier $quartier): self
    {
        if (!$this->quartiers->contains($quartier)) {
            $this->quartiers[] = $quartier;
            $quartier->setCommune($this);
        }

        return $this;
    }

    public function removeQuartier(Quartier $quartier): self
    {
        if ($this->quartiers->contains($quartier)) {
            $this->quartiers->removeElement($quartier);
            // set the owning side to null (unless already changed)
            if ($quartier->getCommune() === $this) {
                $quartier->setCommune(null);
            }
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
            $place->setCommune($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->places->contains($place)) {
            $this->places->removeElement($place);
            // set the owning side to null (unless already changed)
            if ($place->getCommune() === $this) {
                $place->setCommune(null);
            }
        }

        return $this;
    }
}
