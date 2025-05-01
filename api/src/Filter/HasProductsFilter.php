<?php

// src/Filter/HasProductsFilter.php
namespace App\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyInfo\Type;
use ApiPlatform\MetaData\FilterInterface;
use ApiPlatform\Metadata\ApiFilter;

#[ApiFilter(HasProductsFilter::class)]
class HasProductsFilter extends AbstractFilter implements FilterInterface
{
    protected function filterProperty(
        string $property, $value, QueryBuilder $queryBuilder, string|\ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass = null, Operation|\ApiPlatform\Metadata\Operation|null $operation = null, array $context = []): void
    {
        if ($property !== 'hasProducts' || $value === null) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];

        if ($value === 'true') {
            $queryBuilder
                ->andWhere(sprintf('SIZE(%s.products) > 0', $alias));
        } elseif ($value === 'false') {
            $queryBuilder
                ->andWhere(sprintf('SIZE(%s.products) = 0', $alias));
        }
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'hasProducts' => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_BOOL,
                'required' => false,
                'swagger' => [
                    'description' => 'Filter categories by presence of products.',
                    'name' => 'hasProducts',
                    'type' => 'boolean',
                ],
            ],
        ];
    }
}
