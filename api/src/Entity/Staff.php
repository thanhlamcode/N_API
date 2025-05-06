<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put(),
        new Delete()
    ],
    normalizationContext: ['groups' => ['staff:read']],
    denormalizationContext: ['groups' => ['staff:write']]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'name' => 'partial',
    'nickname' => 'partial',
    'code' => 'exact',
])]
#[ApiFilter(BooleanFilter::class, properties: [
    'activeStatus',
    'bookingStatus'
])]
#[ApiFilter(OrderFilter::class, properties: [
    'createdAt' => 'DESC'
], arguments: ['orderParameterName' => 'order'])]
#[ORM\Entity]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['staff:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['staff:read', 'staff:write'])]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['staff:read', 'staff:write'])]
    private ?string $avatar = null;

    #[ORM\Column(length: 255)]
    #[Groups(['staff:read', 'staff:write'])]
    private string $nickname;

    #[ORM\Column(length: 50, unique: true)]
    #[Groups(['staff:read', 'staff:write'])]
    private string $code;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['staff:read', 'staff:write'])]
    private bool $activeStatus = true;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['staff:read', 'staff:write'])]
    private bool $bookingStatus = true;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    #[Groups(['staff:read', 'staff:write'])]
    private ?float $commissionOrSalary = null;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['staff:read'])]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // Getter và Setter (có thể dùng make:entity để generate tự động)
    // ...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function isActiveStatus(): ?bool
    {
        return $this->activeStatus;
    }

    public function setActiveStatus(bool $activeStatus): static
    {
        $this->activeStatus = $activeStatus;

        return $this;
    }

    public function isBookingStatus(): ?bool
    {
        return $this->bookingStatus;
    }

    public function setBookingStatus(bool $bookingStatus): static
    {
        $this->bookingStatus = $bookingStatus;

        return $this;
    }

    public function getCommissionOrSalary(): ?string
    {
        return $this->commissionOrSalary;
    }

    public function setCommissionOrSalary(?string $commissionOrSalary): static
    {
        $this->commissionOrSalary = $commissionOrSalary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
