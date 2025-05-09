<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class StaffPermissionLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Staff::class, inversedBy: 'staffPermissionLinks')]
    private Staff $staff;

    #[ORM\ManyToOne(targetEntity: Permission::class, inversedBy: 'staffPermissionLinks')]
    private Permission $permission;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    public function getId(): int
    {
        return $this->id;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getPermission(): Permission
    {
        return $this->permission;
    }

    public function setPermission(Permission $permission): void
    {
        $this->permission = $permission;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}
