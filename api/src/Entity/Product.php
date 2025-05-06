<?php

// src/Entity/Product.php
namespace App\Entity;

// src/Entity/Product.php
namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\MediaObjectDeleteProcessor;
use Doctrine\ORM\Mapping as ORM;

/**
 * A product entity.
 */
#[ORM\Entity]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Put(),
        new Delete(processor:  MediaObjectDeleteProcessor::class),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'name' => 'partial',        // Tìm gần đúng tên
    'description' => 'partial', // Tìm gần đúng mô tả
    'category.id' => 'exact',   // Tìm theo ID của category
])]
class Product
{
    /** The ID of the product. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    /** The name of the product. */
    #[ORM\Column]
    public string $name = '';

    /** The description of the product. */
    #[ORM\Column(type: 'text')]
    public string $description = '';

    /** The price of the product. */
    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $price = 0.0;

    /** The stock quantity of the product. */
    #[ORM\Column(type: 'integer')]
    public int $stockQuantity = 0;

    /** The category the product belongs to. */
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    public Category $category;

    /** The creation date of the product. */
    #[ORM\Column(type: 'datetime_immutable')]
    public \DateTimeImmutable $createdAt;

    /** The update date of the product. */
    #[ORM\Column(type: 'datetime_immutable')]
    public \DateTimeImmutable $updatedAt;

    /** The media object (image) of the product. */
    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?MediaObject $media = null;

    public function getMedia(): ?MediaObject
    {
        return $this->media;
    }

    public function setMedia(?MediaObject $media): self
    {
        $this->media = $media;
        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    // Getters and setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getStockQuantity(): int
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(int $stockQuantity): self
    {
        $this->stockQuantity = $stockQuantity;
        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
