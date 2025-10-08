<?php

namespace App\Entity;

use App\Repository\CloudPhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CloudPhotoRepository::class)]
class CloudPhoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cloudPhotos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CloudBox $box = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBox(): ?CloudBox
    {
        return $this->box;
    }

    public function setBox(?CloudBox $box): static
    {
        $this->box = $box;

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->description ?: 'CloudPhoto #'.$this->id;
    }
}
