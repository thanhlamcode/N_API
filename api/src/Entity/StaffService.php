<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ApiResource]
class StaffService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ManyToOne(targetEntity: Staff::class, inversedBy: 'staffService')]
    #[ORM\JoinColumn(name: 'staff_id', referencedColumnName: 'id', nullable: false)]
    private Staff $staff;

    #[ManyToOne(targetEntity: Services::class, inversedBy: 'staffService')]
    #[ORM\JoinColumn(name: 'service_id', referencedColumnName: 'id', nullable: false)]
    private Services $services;

    #[ORM\Column(type: 'boolean')]
    private bool $status;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getStaff(): Staff
    {
        return $this->staff;
    }

    public function setStaff(Staff $staff): void
    {
        $this->staff = $staff;
    }

    public function getServices(): Services
    {
        return $this->services;
    }

    public function setServices(Services $services): void
    {
        $this->services = $services;
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