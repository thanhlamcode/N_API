<?php
// src/Entity/Category.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Filter\HasProductsFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * A category entity.
 */
#[ORM\Entity]
#[ApiResource]
#[ApiFilter(HasProductsFilter::class)]
//#[GetCollection(security: "is_granted('ROLE_USER')")]
#[GetCollection]
#[Get]
#[Post]
#[Put]
#[Patch]
class Category
{
    /** The ID of the category. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    /** The name of the category. */
    #[ORM\Column]
    public string $name = '';

    /** The description of the category. */
    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $description = null;

    /** The products related to this category. */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'category')]
    public iterable $products;

    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getProducts(): iterable
    {
        return $this->products;
    }

    public function setProducts(iterable $products): self
    {
        $this->products = $products;
        return $this;
    }
}
