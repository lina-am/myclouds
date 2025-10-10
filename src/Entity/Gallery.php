<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $description = null;
    
    #[ORM\Column]
    private ?bool $published = null;
    
    #[ORM\ManyToOne(inversedBy: 'galleries')]
    private ?Member $creator = null;
    
    /**
     * @var Collection<int, CloudPhoto>
     */
    #[ORM\ManyToMany(targetEntity: CloudPhoto::class, inversedBy: 'galleries')]
    #[ORM\JoinTable(name: 'gallery_photo')]
    private Collection $photos;
    
    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }
    
    public function getId(): ?int { return $this->id; }
    
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): static { $this->description = $description; return $this; }
    
    public function isPublished(): ?bool { return $this->published; }
    public function setPublished(bool $published): static { $this->published = $published; return $this; }
    
    public function getCreator(): ?Member { return $this->creator; }
    public function setCreator(?Member $creator): static { $this->creator = $creator; return $this; }
    
    /** @return Collection<int, CloudPhoto> */
    public function getPhotos(): Collection { return $this->photos; }
    
    public function addPhoto(CloudPhoto $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            // synchronise le côté inverse
            $photo->addGallery($this);
        }
        return $this;
    }
    
    public function removePhoto(CloudPhoto $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // synchronise le côté inverse
            $photo->removeGallery($this);
        }
        return $this;
    }
}