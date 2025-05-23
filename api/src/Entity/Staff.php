<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\StaffProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(
            processor: StaffProcessor::class
        ),
        new Put(),
        new Delete(),
    ]
)]
#[ORM\Entity]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 3)]
    private string $code;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nickname;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: 'Cellphone cannot be blank.')]
    #[Assert\Regex(
        pattern: '/^\+?[0-9]{9,15}$/',
        message: 'Please enter a valid cellphone number.'
    )]
    private string $cellphone;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Email cannot be blank.')]
    #[Assert\Email(message: 'Please enter a valid email address.')]
    private string $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $color = null;

    #[ORM\OneToMany(targetEntity: StaffPermissionLink::class, mappedBy: 'staff', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $staffPermissionLinks;

    #[ORM\Column(type: 'boolean')]
    private bool $bookingStaff = false;

    #[ORM\Column(type: 'boolean')]
    private bool $activeStatus = true;

    #[ORM\OneToOne(targetEntity: MediaObject::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'media_object_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?MediaObject $avatar = null;

    #[ORM\OneToMany(targetEntity: StaffService::class, mappedBy: 'staff', cascade: ['persist', 'remove'])]
    private Collection $staffService;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    public function setCellphone(string $cellphone): void
    {
        $this->cellphone = $cellphone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getStaffPermissionLinks(): Collection
    {
        return $this->staffPermissionLinks;
    }

    public function setStaffPermissionLinks(iterable $staffPermissionLinks): void
    {
        $this->staffPermissionLinks = new ArrayCollection();
        foreach ($staffPermissionLinks as $link) {
            $this->staffPermissionLinks->add($link);
        }
    }

    public function isBookingStaff(): bool
    {
        return $this->bookingStaff;
    }

    public function setBookingStaff(bool $bookingStaff): void
    {
        $this->bookingStaff = $bookingStaff;
    }

    public function isActiveStatus(): bool
    {
        return $this->activeStatus;
    }

    public function setActiveStatus(bool $activeStatus): void
    {
        $this->activeStatus = $activeStatus;
    }
}
