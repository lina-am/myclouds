<?php

namespace App\Entity;

use App\Repository\CloudBoxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CloudBoxRepository::class)]
class CloudBox
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $description = '';

    /**
     * @var Collection<int, CloudPhoto>
     */
    #[ORM\OneToMany(targetEntity: CloudPhoto::class, mappedBy: 'box')]
    private Collection $cloudPhotos;

    #[ORM\OneToOne(mappedBy: 'cloudBox', cascade: ['persist', 'remove'])]
    private ?Member $member = null;

    public function __construct()
    {
        $this->cloudPhotos = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, CloudPhoto>
     */
    public function getCloudPhotos(): Collection
    {
        return $this->cloudPhotos;
    }

    public function addCloudPhoto(CloudPhoto $cloudPhoto): static
    {
        if (!$this->cloudPhotos->contains($cloudPhoto)) {
            $this->cloudPhotos->add($cloudPhoto);
            $cloudPhoto->setBox($this);
        }

        return $this;
    }

    public function removeCloudPhoto(CloudPhoto $cloudPhoto): static
    {
        if ($this->cloudPhotos->removeElement($cloudPhoto)) {
            // set the owning side to null (unless already changed)
            if ($cloudPhoto->getBox() === $this) {
                $cloudPhoto->setBox(null);
            }
        }

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->description ?: 'CloudBox #'.$this->id;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): static
    {
        // unset the owning side of the relation if necessary
        if ($member === null && $this->member !== null) {
            $this->member->setCloudBox(null);
        }

        // set the owning side of the relation if necessary
        if ($member !== null && $member->getCloudBox() !== $this) {
            $member->setCloudBox($this);
        }

        $this->member = $member;

        return $this;
    }
}
