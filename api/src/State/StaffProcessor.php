<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Staff;
use Doctrine\ORM\EntityManagerInterface;

final class StaffProcessor implements ProcessorInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Staff
    {
        if (!$data instanceof Staff) {
            throw new \InvalidArgumentException('Expected Staff entity');
        }

        foreach ($data->getStaffPermissionLinks() as $link) {
            $link->setStaff($data);
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}
