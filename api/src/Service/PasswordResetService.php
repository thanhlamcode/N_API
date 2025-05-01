<?php

namespace App\Service;

use App\Entity\PasswordResetToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class PasswordResetService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function createResetToken(string $email): PasswordResetToken
    {
        $token = Uuid::v4()->toRfc4122();
        $expiresAt = new \DateTimeImmutable('+1 hour');

        $resetToken = new PasswordResetToken($email, $token, $expiresAt);

        $this->em->persist($resetToken);
        $this->em->flush();

        return $resetToken;
    }
}
