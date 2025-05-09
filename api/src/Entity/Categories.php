<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    private ?Uuid $id;

    #[ORM\OneToOne(targetEntity: Colors::class)]
    #[ORM\JoinColumn(name: 'color', referencedColumnName: 'id', nullable: false)]
    private Colors $colors;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $status;
}