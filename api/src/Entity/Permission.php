<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Delete(),
        new Put()
    ],
    denormalizationContext: ['groups' => ['permission:write']],
)]
class Permission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToMany(targetEntity: StaffPermissionLink::class, mappedBy: 'permission', cascade: ['persist', 'remove'])]
    private Collection $staffPermissionLinks;


    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['permission:write'])]
    private string $permissionName;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPermissionName(): string
    {
        return $this->permissionName;
    }

    public function setPermissionName(string $permissionName): void
    {
        $this->permissionName = $permissionName;
    }
}
