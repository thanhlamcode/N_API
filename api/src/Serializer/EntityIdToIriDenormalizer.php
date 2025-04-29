<?php

namespace App\Serializer;

use ApiPlatform\Metadata\IriConverterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\PropertyInfo\PropertyInfoExtractorInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class EntityIdToIriDenormalizer implements DenormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.iri_converter')]
        private IriConverterInterface $iriConverter,

        #[Autowire(service: 'api_platform.serializer.normalizer.item')]
        private NormalizerInterface $normalizer,

        #[Autowire(service: 'property_info')]
        private PropertyInfoExtractorInterface $propertyInfoExtractor,

        private EntityManagerInterface $entityManager, // THÊM EntityManager
    ) {}

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return class_exists($type) && str_starts_with($type, 'App\\Entity\\');
    }

    public function denormalize($data, $type, $format = null, array $context = []): mixed
    {
        if (!is_array($data)) {
            return $this->normalizer->denormalize($data, $type, $format, $context);
        }

        foreach ($data as $property => $value) { // lặp qua từng field trong data
            if (is_numeric($value)) {
                $types = $this->propertyInfoExtractor->getTypes($type, $property);
                // trong $type (ví dụ Product::class), field $property (category) là loại gì?

                if ($types !== null) {
                    foreach ($types as $typeInfo) {
                        if (
                            $typeInfo->getBuiltinType() === 'object' &&
                            $typeInfo->getClassName() !== null &&
                            str_starts_with($typeInfo->getClassName(), 'App\\Entity\\')
                        ) {
                            $resourceClass = $typeInfo->getClassName();
                            $entity = $this->entityManager->find($resourceClass, (int)$value);

                            if ($entity) {
                                $data[$property] = $this->iriConverter->getIriFromResource($entity);
                            }
                        }
                    }
                }
            }
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            '*' => false,
        ];
    }
}
