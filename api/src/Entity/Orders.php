<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(targetEntity: Customer::class, inversedBy: "order")]
    private Customer|null $customer =  null;

    #[ORM\OneToOne(targetEntity: Payment::class, inversedBy: "order")]
    private Payment|null $payment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private DateTimeImmutable $updatedAt;
}