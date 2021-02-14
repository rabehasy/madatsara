<?php

namespace App\Entity;

trait SluggableTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

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
