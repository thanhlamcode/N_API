<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

#[ApiResource]
#[ORM\Entity]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $serviceName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $description;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $durationHours = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $durationMinutes = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private float $price;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $supplyShare;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'services')]
    #[ORM\JoinColumn(name: 'categories_id', referencedColumnName: 'id', nullable: false)]
    private Categories $categories;

    #[ORM\Column(type: "boolean", nullable: true)]
    private bool $visibility = true;

    #[ORM\Column(type: "boolean", nullable: true)]
    private bool $showOnGoCheckin = true;

    #[ORM\Column(type: "boolean", nullable: true)]
    private bool $showOnPOS = true;

    #[ORM\OneToOne(targetEntity: MediaObject::class)]
    #[JoinColumn(name: 'media_id', referencedColumnName: 'id', nullable: false)]
    private MediaObject $mediaObject;

    #[ORM\OneToMany(targetEntity: StaffService::class, mappedBy: 'services', cascade: ['persist', 'remove'])]
    private Collection $staffService;

    public function getId(): int
    {
        return $this->id;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function setServiceName(string $serviceName): void
    {
        $this->serviceName = $serviceName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDurationHours(): ?int
    {
        return $this->durationHours;
    }

    public function setDurationHours(?int $durationHours): void
    {
        $this->durationHours = $durationHours;
    }

    public function getDurationMinutes(): ?int
    {
        return $this->durationMinutes;
    }

    public function setDurationMinutes(?int $durationMinutes): void
    {
        $this->durationMinutes = $durationMinutes;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getSupplyShare(): string
    {
        return $this->supplyShare;
    }

    public function setSupplyShare(string $supplyShare): void
    {
        $this->supplyShare = $supplyShare;
    }

    public function getCategories(): Categories
    {
        return $this->categories;
    }

    public function setCategories(Categories $categories): void
    {
        $this->categories = $categories;
    }

    public function isVisibility(): bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): void
    {
        $this->visibility = $visibility;
    }

    public function isShowOnGoCheckin(): bool
    {
        return $this->showOnGoCheckin;
    }

    public function setShowOnGoCheckin(bool $showOnGoCheckin): void
    {
        $this->showOnGoCheckin = $showOnGoCheckin;
    }

    public function isShowOnPOS(): bool
    {
        return $this->showOnPOS;
    }

    public function setShowOnPOS(bool $showOnPOS): void
    {
        $this->showOnPOS = $showOnPOS;
    }

    public function getMediaObject(): MediaObject
    {
        return $this->mediaObject;
    }

    public function setMediaObject(MediaObject $mediaObject): void
    {
        $this->mediaObject = $mediaObject;
    }
}