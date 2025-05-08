<?php

// src/Entity/User.php
namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\RegisterController;
use App\DTO\ResetPasswordRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'users')]  // Đổi tên bảng thành 'users'
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/user/register',
            controller: RegisterController::class,
        ),
        new Post(
            uriTemplate: '/user/reset-password',
            status: 202,
            input: ResetPasswordRequest::class,
            output: false,
            messenger: 'input'
        ),
        new GetCollection(),
        new Get()
    ],
    normalizationContext: ['groups' => ['user:read']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Groups(['user:read'])]
    private string $username;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'json')]
    #[Groups(['user:read'])]
    private array $roles = ['ROLE_USER'];

    #[ORM\OneToMany(targetEntity: Transactions::class, mappedBy: 'user')]
    #[Groups(['user:read'])]
    #[MaxDepth(1)]
    private Collection $transactions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Nếu có thông tin nhạy cảm trong User, xóa ở đây
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }
}
