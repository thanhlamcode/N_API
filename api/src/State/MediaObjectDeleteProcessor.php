<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class MediaObjectDeleteProcessor implements ProcessorInterface
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data) {
            $products = $this->entityManager->getRepository(Product::class)
                ->findBy(['media' => $data]);

            foreach ($products as $product) {
                $product->setMedia(null); // Gỡ liên kết
                $this->entityManager->persist($product);
            }

            $this->entityManager->flush();

            $this->entityManager->remove($data);
            $this->entityManager->flush();
        }

        return null;
    }

}
