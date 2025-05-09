<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid')]
    private ?Uuid $id = null;

    #[ORM\OneToOne(targetEntity: Colors::class)]
    #[ORM\JoinColumn(name: 'color', referencedColumnName: 'id', nullable: false)]
    private Colors $colors;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $status;

    #[ORM\OneToMany(targetEntity: Services::class, mappedBy: 'categories')]
    private Collection $services;


    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): void
    {
        $this->id = $id;
    }

    public function getColors(): Colors
    {
        return $this->colors;
    }

    public function setColors(Colors $colors): void
    {
        $this->colors = $colors;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}