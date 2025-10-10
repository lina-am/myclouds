<?php

namespace App\Entity;

use App\Repository\CloudPhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CloudPhotoRepository::class)]
class CloudPhoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $description = '';

    #[ORM\ManyToOne(inversedBy: 'cloudPhotos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CloudBox $box = null;

    /**
     * @var Collection<int, Gallery>
     */
    #[ORM\ManyToMany(targetEntity: Gallery::class, mappedBy: 'photos')]
    private Collection $galleries;

    public function __construct()
    {
        $this->galleries = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): static { $this->description = $description; return $this; }

    public function getBox(): ?CloudBox { return $this->box; }
    public function setBox(?CloudBox $box): static { $this->box = $box; return $this; }

    public function __toString(): string
    {
        return $this->description ?: 'CloudPhoto #'.$this->id;
    }

    /** @return Collection<int, Gallery> */
    public function getGalleries(): Collection { return $this->galleries; }

    public function addGallery(Gallery $gallery): static
    {
        if (!$this->galleries->contains($gallery)) {
            $this->galleries->add($gallery);
            // NE PAS ajouter $gallery->addPhoto($this) ici
            // (c’est déjà fait côté owning lors de l’ajout normal)
        }
        return $this;
    }

    public function removeGallery(Gallery $gallery): static
    {
        if ($this->galleries->removeElement($gallery)) {
            // idem, la synchro inverse se fait côté owning
        }
        return $this;
    }
}