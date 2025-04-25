<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
class RegisterController
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $username = $data['username'] ?? '';
        $plainPassword = $data['password'] ?? '';

        if (empty($username) || empty($plainPassword)) {
            return new JsonResponse(['error' => 'Missing username or password'], 400);
        }

        $user = new User();
        $user->setUsername($username);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $plainPassword)
        );

        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse(['message' => 'User registered successfully'], 201);
    }
}
