<?php

// src/Entity/PasswordResetToken.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PasswordResetToken
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    public string $email;

    #[ORM\Column(unique: true)]
    public string $token;

    #[ORM\Column]
    public \DateTimeImmutable $expiresAt;

    public function __construct(string $email, string $token, \DateTimeImmutable $expiresAt)
    {
        $this->email = $email;
        $this->token = $token;
        $this->expiresAt = $expiresAt;
    }
}
