<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\MediaObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MediaObjectProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private RequestStack $requestStack
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        // Nếu $data là null (do deserialize: false), thì tạo mới
        if (!$data instanceof MediaObject) {
            $data = new MediaObject();
        }

        $request = $this->requestStack->getCurrentRequest();
        $file = $request?->files->get('file');

        if ($file !== null) {
            $data->file = $file;
        }

        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }
}
